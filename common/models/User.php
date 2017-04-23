<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $level
 * @property integer $created_at
 * @property integer $update_at
 * @property string $password write-only password
 *
 * @property string $text
 * @property integer $city_id
 * @property integer $avatar
 *
 * @property Camera[] $cameras
 * @property Comment[] $comments
 * @property Photo[] $photos
 * @property Post[] $posts
 * @property City $city
 * @property Photo $photoAvatar
 * @property UserHasPhotoType[] $userHasPhotoTypes
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    const LEVEL_UNPROFESSIONAL = 0;
    const LEVEL_PROFESSIONAL = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    public static function getLevelsLabels()
    {
        return [
            self::LEVEL_UNPROFESSIONAL => "Amator",
            self::LEVEL_PROFESSIONAL => "Profesjonalista",
        ];
    }


    public function getLevelLabel()
    {
        $labels = self::getLevelsLabels();
        return $labels[$this->level];
    }

    public static function getStatusLabels() {
        return [
            self::STATUS_ACTIVE => "Aktywny",
            self::STATUS_DELETED => "Usunięty",
        ];
    }

    public function getStatusLabel() {
        $status = self::getStatusLabels();
        return $status[$this->status];
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

        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['avatar', 'status', 'level', 'city_id'], 'integer'],
            [['username', 'email', 'level'], 'required'],
            [['text'], 'string'],
            [['first_name', 'last_name', 'username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['avatar'], 'exist', 'skipOnError' => true, 'targetClass' => Photo::className(), 'targetAttribute' => ['avatar' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'username' => 'Nazwa użytkownika',
            'first_name' => 'Imię',
            'last_name' => 'Nazwisko',
            'level' => 'Typ fotografa',
            'password' => 'Hasło',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Utworzono',
            'update_at' => 'Zaktualizowano',
            'text' => 'Opis użytkownika',
            'avatar' => 'Avatar',
            'city_id' => 'Miasto',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByLevel($level)
    {
        return static::findOne(['level' => $level, 'status' => self::STATUS_ACTIVE]);
    }
    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }


    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return true;// Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;

    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getUsername()
    {
        return '@' . $this->username;
    }

    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }


    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['user_id' => 'id']);
    }

    public function getPhotos()
    {
        return $this->hasMany(Photo::className(), ['user_id' => 'id']);
    }

    public function getFriendshipsOne() {
        return $this->hasMany(Friendship::className(), ['friend_one' => 'id']);
    }

    public function getFriendshipsTwo() {
        return $this->hasMany(Friendship::className(), ['friend_two' => 'id']);
    }

    public function getPhotoAvatar() {
        return $this->hasOne(Photo::className(), ['id' => 'avatar']);
    }

    public function getPhotoTypes() {
        return $this->hasMany(PhotoType::className(), ['id' => 'photo_type_id'])
            ->viaTable('user_has_photo_type', ['user_id' => 'id']);
    }

    public function getUserHasPhotoTypes() {
        return $this->hasMany(UserHasPhotoType::className(), ['user_id' => 'id']);
    }


}
