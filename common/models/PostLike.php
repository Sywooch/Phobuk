<?php

namespace common\models;

/**
 * This is the model class for table "post_like".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $user_id
 *
 * @property Post $post
 * @property User $user
 */
class PostLike extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'post_like';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['post_id', 'user_id'], 'required'],
            [['post_id', 'user_id'], 'integer'],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'post_id' => 'Post',
            'user_id' => 'Użytkownik',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost() {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @param $post
     * @param $user
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function currentUserLike($post, $user) {
        return PostLike::find()
            ->where('post_id = :id', [
                'id' => $post
            ])
            ->andWhere('user_id = :user', [
                'user' => $user
            ])
            ->one();
    }

    /**
     * @param $post
     * @param $user
     */
    public static function saveLike($post, $user) {
        $postLike = new PostLike();
        $postLike->user_id = $user;
        $postLike->post_id = $post;
        $postLike->save();
    }

    /**
     * @return string
     */
    public static function LikeAcceptStatus() {
        return ' Lubisz to! ';
    }

    /**
     * @return string
     */
    public static function NonLikeStatus() {
        return ' Lubię to! ';
    }
}
