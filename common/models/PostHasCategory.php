<?php

namespace common\models;

/**
 * This is the model class for table "post_has_category".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $category_id
 *
 * @property Category $category
 * @property Post $post
 */
class PostHasCategory extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'post_has_category';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['post_id', 'category_id'], 'required'],
            [['post_id', 'category_id'], 'integer'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory() {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost() {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    public function savePostHasCategory($post, array $categories) {
        self::deleteAll(array('post_id' => $post));
        foreach ($categories as $category) {
            $model = new PostHasCategory();
            $model->post_id = $post;
            $model->category_id = $category;
            $model->save(false);
        }

    }
}
