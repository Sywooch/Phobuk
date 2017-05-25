<?php

namespace frontend\controllers;

use common\models\Event;
use common\models\EventHasUser;
use common\models\EventSearch;
use common\models\User;
use DateTime;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends Controller {
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Event models.
     * @return mixed
     */
    public function actionIndex() {

        $query = Event::find()
            ->orderBy([
                'date' => SORT_DESC,
            ]);
        $eventList = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'eventList' => $eventList,

        ]);
    }

    /**
     * Displays a single Event model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $userRequestList = new ActiveDataProvider();
        $userRequestList->query = EventHasUser::find()
            ->forEvent($id)
            ->request()
            ->orderBy([
                'created_at' => SORT_DESC,
            ]);

        $userConfirmedList = new ActiveDataProvider();
        $userConfirmedList->query = EventHasUser::find()
            ->forEvent($id)
            ->confirmed()
            ->orderBy([
                'update_at' => SORT_DESC,
            ]);


        $isParticipant = EventHasUser::find()
            ->forEvent($id)
            ->forUser(Yii::$app->user->getId())
            ->one();

        $daysToEvent = null;

        $currentDate = new DateTime('now');
        $eventDate = new DateTime(Event::findOne($id)->date);
        $interval = date_diff($currentDate, $eventDate);
        if ($interval->days == 0) {
            $daysToEvent = 'Wydarzenie jest dzisiaj';
        } elseif ($currentDate < $eventDate) {
            $daysToEvent = 'Wydarzenie odbędzie się za ' . $interval->days . ' dni';
        } else($currentDate > $eventDate){
        $daysToEvent = 'Wydarzenie minione'
        };

        return $this->render('view', [
            'model' => $this->findModel($id),
            'userRequestList' => $userRequestList,
            'userConfirmedList' => $userConfirmedList,
            'isParticipant' => $isParticipant,
            'daysToEvent' => $daysToEvent
        ]);
    }

    public function actionUser($id) {

        if ($id) {
            $query = User::find();

            $query->where('id = :id_param', [
                'id_param' => $id
            ]);
            $user = $query->one();
        } else {
            $user = Yii::$app->user->identity;
        }
        if (!$user) {
            throw new NotFoundHttpException("Nie istnieje użytkownik o id = " . $id);
        }

        $queryConfirmed = Event::find()
            ->joinWith('users')
            ->where('user_id = :id', ['id' => $user->getId()])
            ->andWhere('event_has_user.status =1')
            ->orderBy([
                'date' => SORT_DESC,
            ]);


        $eventConfirmedList = new ActiveDataProvider([
            'query' => $queryConfirmed,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $queryRequest = Event::find()
            ->joinWith('users')
            ->where('user_id = :id', ['id' => $id])
            ->andWhere('event_has_user.status =0')
            ->orderBy([
                'date' => SORT_DESC,
            ]);


        $eventRequestList = new ActiveDataProvider([
            'query' => $queryRequest,
        ]);
        return $this->render('userEvent', [
            'eventConfirmedList' => $eventConfirmedList,
            'eventRequestList' => $eventRequestList,
            'user' => $id
        ]);
    }

    /**
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Event();

        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {
                if ($model->users_ids != null) {
                    $eventHasUser = new EventHasUser();
                    $eventHasUser->addUserToEvent($model->id, $model->users_ids);
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->renderAjax('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing Event model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id)->loadUsers();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $eventHasUser = new EventHasUser();
                $eventHasUser->addUserToEvent($model->id, $model->users_ids);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);

    }

    public function actionJoinToEvent($id) {
        EventHasUser::joinToEvent($id, Yii::$app->user->getId());
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionConfirm($id) {
        EventHasUser::confirm($id, Yii::$app->user->getId());
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionReject($id) {
        EventHasUser::reject($id, Yii::$app->user->getId());
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionRemove($id) {
        EventHasUser::remove($id, Yii::$app->user->getId());
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Deletes an existing Event model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
