<?php

namespace common\models;

/**
 * This is the model class for table "gallery".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $user_id
 * @property integer $category_id
 * @property string $title
 *
 * @property Category $category
 * @property User $user
 * @property PhotoInGallery[] $photoInGalleries
 */
class Gallery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'user_id', 'category_id'], 'integer'],
            [['user_id', 'title'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'type' => 'Type',
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoInGalleries()
    {
        return $this->hasMany(PhotoInGallery::className(), ['gallery_id' => 'id']);
    }


    public function getPhotos()
    {
        $this->hasMany(Photo::className(), ['id' => 'photo_id'])
            ->viaTable('photo_in_gallery', ['gallery_id' => 'id']);

    }
}
