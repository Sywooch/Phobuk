<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * This is the model class for table "photo".
 *
 * @property integer $id
 * @property string $photo
 * @property string $title
 * @property integer $user_id
 * @property integer $category_id
 * @property string $created_at
 * @property string $update_at
 *
 * @property PhotoComment[] $photoComments
 * @property Category $category
 * @property User $user
 * @property User[] $users
 * @property Post[] $posts
 */
class Photo extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photo';
    }

    /**
     * @inheritdoc
     */

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'update_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_at'],
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

    public function rules()
    {
        return [
            [['user_id', 'category_id'], 'integer'],
            [['created_at', 'update_at'], 'safe'],
            [['photo', 'title'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }


    public function upload()
    {
        /** @var User $user */
        $user = Yii::$app->user->identity;
        if ($this->validate()) {
            $filePath = 'uploads/' . $user->username . '/';
            if (!is_dir($filePath)) {
                FileHelper::createDirectory($filePath);
            };
            $fullFileName = $filePath . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs($fullFileName);
            $this->imageFile = null;
            $this->photo = $fullFileName;
            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'photo' => 'Zdjęcie',
            'title' => 'Tytuł',
            'user_id' => 'Użytkownik',
            'category_id' => 'Kategoria',
            'created_at' => 'Data utworzenia',
            'update_at' => 'Data aktualizacji',
            'imageFile' => 'Zdjęcie',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotoComments()
    {
        return $this->hasMany(PhotoComment::className(), ['photo_id' => 'id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['photo_id' => 'id']);
    }

    public function getGalleries()
    {
        return $this->hasMany(Gallery::className(), ['id' => 'gallery_id'])
            ->viaTable('photo_in_gallery', ['photo_id' => 'id']);
    }

    public function getPhotoAvatars() {
        return $this->hasMany(User::className(), ['avatar' => 'id']);
    }

    public static function imageList($filenames) {
        $imageList = [];
        foreach ($filenames as $id => $path) {
            $imageList[$id] = Html::img('/' . $path, ['class' => ' img-responsive avatar-listFriend photo-radio thumbnail ']);


        }
        return $imageList;
    }
}
