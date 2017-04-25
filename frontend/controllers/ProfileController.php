<?php

namespace frontend\controllers;

use common\models\Friendship;
use common\models\Photo;
use common\models\User;
use common\models\UserHasPhotoType;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
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

        $userId = $user->getId();
        $rawSQL = "select * from (select 'photo' as 'type', p.id, photo, title,'' as 'text', user_id, created_at, category_id from photo p
UNION 
select 'post' as 'type', d.id, d.photo_id, d.title, text, d.user_id, d.created_at, '' from post d
) phopost
WHERE user_id = $userId ORDER BY created_at DESC";

        $countSQL = "select count(*) from (select 'photo' as 'type', p.id, photo, title,'', user_id, created_at, category_id from photo p
UNION
 select 'post' as 'type', d.id, d.photo_id, d.title, text, d.user_id, d.created_at, '' from post d
) phopost
WHERE user_id = $userId ORDER BY created_at DESC";

        $count = Yii::$app->db->createCommand($countSQL)->queryScalar();

        $dataProvider = new SqlDataProvider([
            'sql' => $rawSQL,
            'totalCount' => $count
        ]);


        /** @var Photo $photoAvatar */
        return $this->render('index', [
            'user' => $user,
            'city' => $user->city,
            'avatar' => $user->photoAvatar,
            'photoDataProvider' => $photoDataProvider,
            'dataProvider' => $dataProvider,
            'isCurrentUser' => $user->getId() === Yii::$app->user->identity->getId(),
            'count' => $count,
            'friendship' => $friendship,


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




