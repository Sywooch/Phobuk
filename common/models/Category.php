<?php

namespace common\models;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Photo[] $photos
 * @property PostHasCategory[] $postHasCategories
 */
class Category extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Nazwa',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotos() {
        return $this->hasMany(Photo::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */


    public function getPostHasCategories() {
        return $this->hasMany(PostHasCategory::className(), ['category_id' => 'id']);
    }

    public function getPosts() {
        return $this->hasMany(Post::className(), ['id' => 'post_id'])
            ->viaTable('post_has_category', ['category_id' => 'id']);
    }

    public static function getAllCategories() {
        $categories = self::find()->orderBy('name')->asArray()->all();
        $items = ArrayHelper::map($categories, 'id', 'name');
        return $items;
    }
}
