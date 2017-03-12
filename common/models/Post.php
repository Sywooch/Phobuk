<?php

namespace common\models;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $text
 * @property integer $user_id
 * @property integer $category_id
 * @property integer $photo_id
 * @property string $created_at
 * @property string $update_at
 *
 * @property Comment[] $comments
 * @property Category $category
 * @property Photo $photo
 * @property User $user
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'user_id', 'created_at', 'update_at'], 'required'],
            [['text'], 'string'],
            [['user_id', 'category_id', 'photo_id'], 'integer'],
            [['created_at', 'update_at'], 'safe'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['photo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Photo::className(), 'targetAttribute' => ['photo_id' => 'id']],
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
            'text' => 'Treść',
            'user_id' => 'Użytkownik',
            'category_id' => 'Kategoria',
            'photo_id' => 'Zdjęcie',
            'created_at' => 'Data utworzenia',
            'update_at' => 'Data aktualizacji',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
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
    public function getPhoto()
    {
        return $this->hasOne(Photo::className(), ['id' => 'photo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
