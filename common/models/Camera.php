<?php

namespace common\models;

/**
 * This is the model class for table "camera".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $camera_brand_id
 *
 * @property CameraBrand $cameraBrand
 * @property User $user
 */
class Camera extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'camera';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'camera_brand_id'], 'required'],
            [['user_id', 'camera_brand_id'], 'integer'],
            [['camera_brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => CameraBrand::className(), 'targetAttribute' => ['camera_brand_id' => 'id']],
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
            'camera_brand_id' => 'Camera Brand ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCameraBrand()
    {
        return $this->hasOne(CameraBrand::className(), ['id' => 'camera_brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
