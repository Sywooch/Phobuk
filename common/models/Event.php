<?php

namespace common\models;

use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property integer $organizer
 * @property string $date
 * @property integer $city_id
 *
 * @property City $city
 * @property User $eventOrganizer
 * @property User[] $users
 * @property EventHasUser[] $eventHasUsers
 */
class Event extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'event';
    }

    public function behaviors() {
        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'organizer',
                'updatedByAttribute' => 'organizer',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'text', 'date', 'city_id'], 'required'],
            [['text'], 'string'],
            [['organizer', 'city_id'], 'integer'],
            [['date', 'users_ids', 'users'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['organizer'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['organizer' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'title' => 'Tytuł',
            'text' => 'Opis',
            'organizer' => 'Organizator',
            'date' => 'Data',
            'city_id' => 'Miasto',
            'users_ids' => 'Uczestnicy',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity() {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventOrganizer() {
        return $this->hasOne(User::className(), ['id' => 'organizer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventHasUsers() {
        return $this->hasMany(EventHasUser::className(), ['event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers() {
        return $this->hasMany(User::className(), ['id' => 'user_id'])
            ->viaTable('event_has_user', ['event_id' => 'id']);
    }

    public $users_ids;


    public function loadUsers() {

        foreach ($this->users as $user) {
            $this->users_ids[] = $user->id;
        }
        return $this;
    }
}
