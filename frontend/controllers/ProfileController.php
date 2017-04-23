<?php

namespace frontend\controllers;

use common\models\Friendship;
use common\models\Photo;
use common\models\User;
use common\models\UserHasPhotoType;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\NotFoundHttpException;


class ProfileController extends \yii\web\Controller {


    public function actionIndex($id) {
        $this->layout = 'main-profile';


        /** @var User $user */
        $user = null;

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
            throw new NotFoundHttpException("User not exists");
        }

        $photoDataProvider = new ActiveDataProvider();
        $photoDataProvider->query = Photo::find()
            ->where('user_id = :userID', [
                'userID' => $user->getId()])
            ->orderBy([
                'created_at' => SORT_DESC,
            ]);
        $count = $query = (new Query())
            ->from('photo')
            ->where('user_id = :userID', [
                'userID' => $user->getId()])
            ->count();

        $friendship = Friendship::find()
            ->forUsers(Yii::$app->user->identity->getId(), $id)
            ->one();

        /** @var Photo $photoAvatar */
        return $this->render('index', [
            'user' => $user,
            'city' => $user->city,
            'avatar' => $user->photoAvatar,
            'photoDataProvider' => $photoDataProvider,
            'isCurrentUser' => $user->getId() === Yii::$app->user->identity->getId(),
            'count' => $count,
            'friendship' => $friendship

        ]);


    }


    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {

        $model = $this->findModel($id);


        /*  $photoType = Yii::$app->request->post('user')['photoTypes'];
          $photoTypeModel = PhotoType::findAll($photoType);*/

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $userHasPhotoType = new UserHasPhotoType();

            /*=$userHasPhotoType = new UserHasPhotoType();
            $userHasPhotoType->savePhotoTypes($model->id, $model->photo_type_ids);*/

            return $this->redirect('/profile');

        }
        return $this->render('update', [
            'model' => $model,


        ]);
    }


    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}




