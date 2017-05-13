<?php
namespace frontend\controllers;

use common\models\LoginForm;
use common\models\Photo;
use frontend\models\ContactForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use Yii;
use yii\base\InvalidParamException;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller {
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        if (!Yii::$app->user->isGuest) {

            $user_id = Yii::$app->user->identity->id;

            $rawSQL = "select * from (select 'photo' as 'type', p.id, photo, title,'' as 'text', user_id, p.created_at, category_id, f.friend_one, f.friend_two, f.status from photo p 
JOIN friendship f ON (f.friend_one = p.user_id AND f.friend_two =$user_id OR f.friend_two = p.user_id AND f.friend_one =$user_id)WHERE f.status =1 
UNION 
select 'post' as 'type', d.id, d.photo_id, d.title, text, d.user_id, d.created_at, '', f.friend_one, f.friend_two, f.status from post d 
JOIN friendship f ON (f.friend_one = d.user_id AND f.friend_two =$user_id OR f.friend_two = d.user_id AND f.friend_one =$user_id)WHERE f.status =1 ) phopost
 ORDER BY created_at DESC";

            $countSQL = "select count(*) from (select 'photo' as 'type', p.id, photo, title,'' as 'text', user_id, p.created_at, category_id, f.friend_one, f.friend_two, f.status from photo p 
JOIN friendship f ON (f.friend_one = p.user_id AND f.friend_two =$user_id OR f.friend_two = p.user_id AND f.friend_one =$user_id)WHERE f.status =1 
UNION 
select 'post' as 'type', d.id, d.photo_id, d.title, text, d.user_id, d.created_at, '', f.friend_one, f.friend_two, f.status from post d 
JOIN friendship f ON (f.friend_one = d.user_id AND f.friend_two =$user_id OR f.friend_two = d.user_id AND f.friend_one =$user_id)WHERE f.status =1 ) phopost
 ORDER BY created_at DESC";


            $count = Yii::$app->db->createCommand($countSQL)->queryScalar();

            $dataProvider = new SqlDataProvider([
                'sql' => $rawSQL,
                'totalCount' => $count,
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]);

            /** @var Photo $photoAvatar */
            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);
        } else {
            $model = new LoginForm();
            return $this->render('about', [
                'model' => $model]);
        }

    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout() {

        $model = new LoginForm();
        return $this->render('about', [
            'model' => $model
        ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
