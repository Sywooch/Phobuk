<?php
namespace common\widgets\InvitationButton;

use common\models\Friendship;
use Yii;
use yii\base\Widget;
use yii\data\ActiveDataProvider;

/**
 * Created by PhpStorm.
 * User: ewa
 * Date: 4/23/17
 * Time: 11:28 AM
 */
class InvitationButton extends Widget {


    public function init() {
        parent::init();
    }

    public function run() {

        $friendship = new ActiveDataProvider();
        $friendship->query = Friendship::find()
            ->where('friend_two = :currentUserId', [
                'currentUserId' => Yii::$app->user->identity->id])
            ->waiting()
            ->orderBy([
                'created_at' => SORT_DESC,
            ]);

        return $this->render('_invitationButton', ['friendship' => $friendship]);
    }
}