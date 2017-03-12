<?php
namespace frontend\models;

use common\models\User;
use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $level;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Ta nazwa użytkownika jest już zajęta. '],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['first_name', 'string', 'min' => 2, 'max' => 255],
            ['last_name', 'string', 'min' => 2, 'max' => 255],


            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Ten email jest już zajęty.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['level', 'required', 'message' => 'Musisz wybrac poziom'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Nazwa uzytkownika',
            'first_name' => 'Imię',
            'last_name' => 'Nazwisko',
            'level' => 'Typ fotografa',
            'password' => 'Hasło',


        ];
    }


    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->first_name = $this->first_name;
            $user->last_name = $this->last_name;
            $user->email = $this->email;
            $user->level = $this->level;
            $user->setPassword($this->password);
            $user->generateAuthKey();


            if ($user->save()) {
                $auth = Yii::$app->authManager;
                $userRole = $auth->getRole('user');
                $auth->assign($userRole, $user->getId());

                return $user;
            }
        }

        return null;
    }
}
