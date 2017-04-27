<?php

namespace common\models;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "camera_brand".
 *
 * @property integer $id
 * @property string $name
 *
 * @property UserCamera[] $userCameras
 * @property User[] $users
 */
class CameraBrand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'camera_brand';
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
            'name' => 'Nazwa marki aparatu',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCameras()
    {
        return $this->hasMany(UserCamera::className(), ['camera_brand_id' => 'id']);
    }

    public function getUsers() {
        $this->hasMany(User::className(), ['id' => 'user_id'])
            ->viaTable('user_camera', ['camera_brand_id' => 'id']);
    }

    public static function getAllCameraBrands() {
        $cameraBrands = self::find()->orderBy('name')->asArray()->all();
        $items = ArrayHelper::map($cameraBrands, 'id', 'name');
        return $items;
    }
}
