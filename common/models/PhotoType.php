<?php

namespace common\models;

/**
 * This is the model class for table "photo_type".
 *
 * @property integer $id
 * @property string $name
 *
 * @property UserHasPhotoType[] $userHasPhotoTypes
 */
class PhotoType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photo_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasPhotoTypes()
    {
        return $this->hasMany(UserHasPhotoType::className(), ['photo_type_id' => 'id']);
    }
}
