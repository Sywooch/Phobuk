<?php

namespace common\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $text
 * @property string $title
 * @property integer $user_id
 * @property integer $photo_id
 * @property string $created_at
 * @property string $update_at
 * @property PostHasCategory[] $postHasCategories
 * @property PostComment[] $postComments
 * @property Category[] $categories
 * @property Photo $photo
 * @property User $user
 * @property PostLike[] $postLikes
 */
class Post extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'post';
    }

    public function behaviors() {
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

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['text'], 'required'],
            [['text', 'title'], 'string'],
            [['user_id', 'photo_id'], 'integer'],
            [['created_at', 'update_at', 'categories_ids', 'categories'], 'safe'],
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
            'text' => 'Treść',
            'user_id' => 'Użytkownik',
            'photo_id' => 'Zdjęcie',
            'created_at' => 'Data utworzenia',
            'update_at' => 'Data aktualizacji',
            'title' => 'Tytuł',
            'categories_ids' => 'Kategorie',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */

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

    public function getPostComments() {
        return $this->hasMany(PostComment::className(), ['post_id' => 'id']);
    }

    public function getPostHasCategories() {
        return $this->hasMany(PostHasCategory::className(), ['post_id' => 'id']);
    }

    public function getCategories() {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
            ->viaTable('post_has_category', ['post_id' => 'id']);
    }

    public $categories_ids;


    public function loadCategories() {

        foreach ($this->categories as $category) {
            $this->categories_ids[] = $category->id;
        }
        return $this;
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getPostLikes() {
        return $this->hasMany(PostLike::className(), ['post_id' => 'id']);
    }
}
