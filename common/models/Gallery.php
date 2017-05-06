<?php

namespace common\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "gallery".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $user_id
 * @property integer $category_id
 * @property string $title
 * @property string $created_at
 * @property Photo[] $photos
 * @property Category $category
 * @property User $user
 * @property PhotoInGallery[] $photoInGalleries
 */
class Gallery extends \yii\db\ActiveRecord
{
    const TYPE_PRIVATE = 0;
    const TYPE_PUBLIC = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery';
    }

    public static function getTypeLabels() {
        return [
            self::TYPE_PRIVATE => "Prywatna",
            self::TYPE_PUBLIC => "Publiczna",
        ];
    }

    public function behaviors() {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
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
    public function rules()
    {
        return [
            [['type', 'user_id'], 'integer'],
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['created_at', 'photos_ids', 'photos'], 'safe'],
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
            'type' => 'Rodzaj galerii',
            'user_id' => 'Użytkownik',
            'title' => 'Tytuł',
            'created_at' => 'Data utworzenia',
            'photos_ids' => 'Zdjęcia'
        ];
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
        return $this->hasMany(Photo::className(), ['id' => 'photo_id'])
            ->viaTable('photo_in_gallery', ['gallery_id' => 'id']);

    }

    public $photos_ids;


    public function loadPhotos() {

        foreach ($this->photos as $photo) {
            $this->photos_ids[] = $photo->id;
        }
        return $this;
    }
}
