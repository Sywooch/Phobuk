<?php

namespace common\models;

/**
 * This is the model class for table "photo_in_gallery".
 *
 * @property integer $id
 * @property integer $photo_id
 * @property integer $gallery_id
 *
 * @property Gallery $gallery
 * @property Photo $photo
 */
class PhotoInGallery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photo_in_gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['photo_id', 'gallery_id'], 'required'],
            [['photo_id', 'gallery_id'], 'integer'],
            [['gallery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gallery::className(), 'targetAttribute' => ['gallery_id' => 'id']],
            [['photo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Photo::className(), 'targetAttribute' => ['photo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'photo_id' => 'Photo ID',
            'gallery_id' => 'Gallery ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGallery()
    {
        return $this->hasOne(Gallery::className(), ['id' => 'gallery_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhoto()
    {
        return $this->hasOne(Photo::className(), ['id' => 'photo_id']);
    }
}
