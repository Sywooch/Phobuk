<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "friendship".
 *
 * @property integer $id
 * @property integer $friend_one
 * @property integer $friend_two
 * @property integer $status
 * @property integer $created_at
 *
 * @property User $friendOne
 * @property User $friendTwo
 */
class Friendship extends \yii\db\ActiveRecord
{

    const STATUS_FRIEND_REQUEST = 0;
    const STATUS_CONFIRM_FRIENDS = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'friendship';
    }

    public static function getStatusLabel()
    {
        return [
            self::STATUS_FRIEND_REQUEST => "Zaproszono do znajomych",
            self::STATUS_CONFIRM_FRIENDS => "Znajomi",
        ];
    }

    public function showStatusLabel()
    {
        $labels = self::getStatusLabel();
        return $labels[$this->status];
    }


    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['friend_one', 'friend_two', 'status'], 'required'],
            [['friend_one', 'friend_two', 'status'], 'integer'],
            [['friend_one'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['friend_one' => 'id']],
            [['friend_two'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['friend_two' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'friend_one' => 'Friend One',
            'friend_two' => 'Friend Two',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFriendOne()
    {
        return $this->hasOne(User::className(), ['id' => 'friend_one']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFriendTwo()
    {
        return $this->hasOne(User::className(), ['id' => 'friend_two']);
    }

    /**
     * @return FriendshipQuery
     */
    public static function find()
    {
        return new FriendshipQuery(get_called_class());
    }

    public function isConfirmed() {
        return $this->status === Friendship::STATUS_CONFIRM_FRIENDS;
    }

    public function isInvited($id) {
        return $this->friend_two === $id;
    }


}
