<?php
namespace common\models;

use Yii;
use yii\base\Model;
use backend\models\admin\Admin;
use backend\models\admin\AdminRole;
use frontend\models\Frontenduser;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $got_user = $this->getUser();
            if (intval($got_user->is_verified) > 0 ){
                    $login_result = Yii::$app->user->login($got_user, $this->rememberMe ? 3600 * 24 * 30 : 0);
                     $session = Yii::$app->session;
                     $userid = $this->getUser()->__get("id");
                     $sysuser = Frontenduser::findOne(["id" => $userid]);
                     $session->set('user_id', $sysuser->id);
                     $session->set('user_type', $sysuser->user_type);
                     $session->set('user_authkey', $sysuser->auth_key);
                     if ($sysuser->user_type == "Developer"){
                        $session->set('dev_token', $sysuser->dev_token);
                     }

                     return $login_result;
            }else{
                    Yii::$app->getSession()->setFlash('error', 'Cannot log you in. Your email is not yet verified.');
                    return false;
            }


        } else {
            Yii::$app->getSession()->setFlash('error', 'Something went wrong.');
                    
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }
        return $this->_user;
    }

    public function loginAdmin()
    {
      if ($this->validate() && User::isUserAdmin($this->username)) {
        $res = Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        //** set admin user to session
        $user_id = Yii::$app->user->id;
        $admin_user = Admin::find()
        ->where(["userid" => $user_id])
        ->one();
        $session = Yii::$app->session;
        $session->set('myroleid', $admin_user->role_id);
        $session->set('admin_id', $admin_user->admin_id);
        //** get role access pages
        if ($this->username == "admin"){
                $session->set('page_permissions', "*");
        }else{
            $admin_user_role = AdminRole::find("page_permissions")->where(["role_id" => $admin_user->role_id])->one();
            $session->set('page_permissions', explode(",",$admin_user_role->page_permissions));
        }

        return true;
      } else {
        return false;
      }
    }             
    
    public function loginMobileOperator(){
        if ($this->validate()) {
            $got_user = $this->getUser();
            if ($got_user->user_type != "Operator"){
                return "NOT_AN_OPERATOR";
            }
            if (intval($got_user->is_verified) == 0){
                return "NOT_VERIFIED";
            }
            if (intval($got_user->is_verified) > 0 ){
                return $got_user;
            }
        }else{
            return "ACCESS_DENIED";
        }
    }
    

    public function loginMobileDriver(){
        if ($this->validate()) {
            $got_user = $this->getUser();
            if ($got_user->user_type != "Driver"){
                return "NOT_A_DRIVER";
            }
            if (intval($got_user->is_verified) == 0){
                return "NOT_VERIFIED";
            }
            if (intval($got_user->is_verified) > 0 ){
                return $got_user;
            }
        }else{
            return "ACCESS_DENIED";
        }
    }

    public function resetPassword($password)
    {
        $user = $this->getUser();
        $user->removePasswordResetToken();
        $user->password_hash = Yii::$app->security->generatePasswordHash($password);
        return $user->save();
    }
}
