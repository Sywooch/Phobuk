<?php

namespace common\models;

/**
 * This is the model class for table "photo_like".
 *
 * @property integer $id
 * @property integer $photo_id
 * @property integer $user_id
 *
 * @property Photo $photo
 * @property User $user
 */
class PhotoLike extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'photo_like';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['photo_id', 'user_id'], 'required'],
            [['photo_id', 'user_id'], 'integer'],
            [['photo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Photo::className(), 'targetAttribute' => ['photo_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'photo_id' => 'Zdjęcie',
            'user_id' => 'Użytkownik',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhoto() {
        return $this->hasOne(Photo::className(), ['id' => 'photo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @param $photo
     * @param $user
     */
    public static function saveLike($photo, $user) {
        $photoLike = new PhotoLike();
        $photoLike->user_id = $user;
        $photoLike->photo_id = $photo;
        $photoLike->save();
    }

    /**
     * @param $photo
     * @param $user
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function currentUserLike($photo, $user) {
        return PhotoLike::find()
            ->where('photo_id = :id', [
                'id' => $photo
            ])
            ->andWhere('user_id = :user', [
                'user' => $user
            ])
            ->one();

    }

    /**
     * @return string
     */
    public static function LikeAcceptStatus() {
        return ' Lubisz to! ';
    }

    /**
     * @return string
     */
    public static function NonLikeStatus() {
        return ' Lubię to! ';
    }
}
