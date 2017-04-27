<?php

namespace common\models;

use yii\behaviors\BlameableBehavior;

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
class UserCamera extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'user_camera';
    }

    public function behaviors() {
        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => 'user_id',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['camera_brand_id'], 'required'],
            [['user_id', 'camera_brand_id'], 'integer'],
            [['camera_brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => CameraBrand::className(), 'targetAttribute' => ['camera_brand_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'user_id' => 'Użytkownik',
            'camera_brand_id' => 'Marka aparatu',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCameraBrand() {
        return $this->hasOne(CameraBrand::className(), ['id' => 'camera_brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function saveUserCamera($user, array $cameraBrads) {
        self::deleteAll(array('user_id' => $user));
        foreach ($cameraBrads as $cameraBrad) {
            $model = new UserCamera();
            $model->user_id = $user;
            $model->camera_brand_id = $cameraBrad;
            $model->save(false);
        }
    }

}
