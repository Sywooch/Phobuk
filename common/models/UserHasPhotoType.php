<?php

namespace common\models;

/**
 * This is the model class for table "user_has_photo_type".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $photo_type_id
 *
 * @property PhotoType $photoType
 * @property User $user
 */
class UserHasPhotoType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_has_photo_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'photo_type_id'], 'required'],
            [['user_id', 'photo_type_id'], 'integer'],
            [['photo_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhotoType::className(), 'targetAttribute' => ['photo_type_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'photo_type_id' => 'Photo Type ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoType()
    {
        return $this->hasOne(PhotoType::className(), ['id' => 'photo_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
