<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "event_has_user".
 *
 * @property integer $id
 * @property integer $event_id
 * @property integer $user_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $update_at
 *
 * @property Event $event
 * @property User $user
 */
class EventHasUser extends \yii\db\ActiveRecord {
    const STATUS_EVENT_REQUEST = 0;
    const STATUS_EVENT_CONFIRM = 1;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'event_has_user';
    }

    public function behaviors() {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'update_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function getStatusLabel() {
        return [
            self::STATUS_EVENT_REQUEST => "Zaproszono na wydarzenie",
            self::STATUS_EVENT_CONFIRM => "Bierze udział w wydarzeniu",
        ];
    }

    public function showStatusLabel() {
        $labels = self::getStatusLabel();
        return $labels[$this->status];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['event_id', 'user_id', 'status'], 'required'],
            [['event_id', 'user_id', 'status'], 'integer'],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'event_id' => 'Wydarzenie',
            'user_id' => 'Użytkownik',
            'status' => 'Status',
            'created_at' => 'Utworzono',
            'update_at' => 'Aktualizowano',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent() {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return EventHasUserQuery
     */
    public static function find() {
        return new EventHasUserQuery(get_called_class());
    }

    /**
     * @return bool
     */
    public function isConfirmed() {
        return $this->status === EventHasUser::STATUS_EVENT_CONFIRM;
    }

    /**
     * @return bool
     */
    public function isInvited() {
        return $this->status === EventHasUser::STATUS_EVENT_REQUEST;
    }

    public function addUserToEvent($event, array $users) {
        //   self::deleteAll(array('event_id' => $event));
        foreach ($users as $user) {
            $eventHasUser = EventHasUser::find()
                ->forEvent($event)
                ->forUser($user)
                ->one();
            if (!$eventHasUser) {
                $model = new EventHasUser();
                $model->event_id = $event;
                $model->user_id = $user;
                $model->status = EventHasUser::STATUS_EVENT_REQUEST;
                $model->save(false);
            }

        }
    }

    public static function joinToEvent($event, $user) {
        $eventHasUser = EventHasUser::find()
            ->forEvent($event)
            ->forUser($user)
            ->request()
            ->one();

        if (!$eventHasUser) {
            $model = new EventHasUser();
            $model->event_id = $event;
            $model->user_id = $user;
            $model->status = EventHasUser::STATUS_EVENT_CONFIRM;
            $model->save();
        } else {
            $eventHasUser->status = EventHasUser::STATUS_EVENT_CONFIRM;
            $eventHasUser->save();
        }

    }

    public static function confirm($event, $user) {
        $eventHasUser = EventHasUser::find()
            ->forEvent($event)
            ->forUser($user)
            ->request()
            ->one();

        if ($eventHasUser) {
            $eventHasUser->status = EventHasUser::STATUS_EVENT_CONFIRM;
            $eventHasUser->save();
        }
    }

    public static function reject($event, $user) {
        $eventHasUser = EventHasUser::find()
            ->forEvent($event)
            ->forUser($user)
            ->request()
            ->one();

        if ($eventHasUser) {
            $eventHasUser->delete();
        }
    }

    public static function remove($event, $user) {
        $eventHasUser = EventHasUser::find()
            ->forEvent($event)
            ->forUser($user)
            ->confirmed()
            ->one();

        if ($eventHasUser) {
            $eventHasUser->delete();
        }
    }

}
