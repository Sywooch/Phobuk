<?php
namespace common\widgets\InvitationButton;

use common\models\EventHasUser;
use common\models\Friendship;
use Yii;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;

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
        $user = Yii::$app->user->identity->getId();

        $friendship = new ActiveDataProvider();
        $friendship->query = Friendship::find()
            ->where('friend_two = :currentUserId', [
                'currentUserId' => $user])
            ->waiting()
            ->orderBy([
                'created_at' => SORT_DESC,
            ]);
        $event = new ActiveDataProvider();
        $event->query = EventHasUser::find()
            ->forUser($user)
            ->request()
            ->orderBy([
                'created_at' => SORT_DESC,
            ]);
        $friendshipRequest = Friendship::STATUS_FRIEND_REQUEST;
        $eventRequest = EventHasUser::STATUS_EVENT_REQUEST;

        $rawSQL = "select * from (select 'friendship' as 'type', f.id, f.status,f.friend_one ,f.friend_two as 'user_id', f.created_at, '' as 'event_id' from friendship f  WHERE (f.status=$friendshipRequest AND f.friend_two = $user)
UNION 
select 'event_has_user' as 'type', e.id, e.status, '', e.user_id, e.created_at, e.event_id from event_has_user e WHERE (e.status=$eventRequest AND e.user_id = $user)) 
friendevent
 ORDER BY created_at DESC";

        $countSQL = "select count(*) from (select 'friendship' as 'type', f.id, f.status,f.friend_one ,f.friend_two as 'user_id', f.created_at, '' as 'event_id' from friendship f  WHERE (f.status=$friendshipRequest AND f.friend_two = $user)
UNION 
select 'event_has_user' as 'type', e.id, e.status, '', e.user_id, e.created_at, e.event_id from event_has_user e WHERE (e.status=$eventRequest AND e.user_id = $user)) 
friendevent
 ORDER BY created_at DESC";

        $count = Yii::$app->db->createCommand($countSQL)->queryScalar();

        $dataProvider = new SqlDataProvider([
            'sql' => $rawSQL,
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('_invitationButton', [
            'friendship' => $friendship,
            'event' => $event,
            'dataProvider' => $dataProvider,
            'count' => $count
        ]);
    }
}