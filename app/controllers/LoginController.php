<?php

class LoginController extends ControllerBase
{

    public function initialize()
    {
        parent::initialize();

//        $this->view->setLayout('login');
        $this->view->setMainView('login');
    }

    /**
     * 登录
     */
    public function indexAction()
    {
        if($this->request->isPost()) {
            $name   = $this->request->getPost('name');
            $passwd = $this->request->getPost('passwd');

            $userObj = \User::findFirst(
                array(
                    'conditions' => "name = :name:",
                    'bind' => array('name' => $name)
                )
            );
            if (is_object($userObj)) {
                if (md5(md5($passwd).$userObj->salt) == $userObj->passwd) {
                    $this->cookies->set('name', $userObj->name, time() + 7 * 86400);
                    $this->redirect("index/index");
                } else {
                    $this->view->setVar('errMsg', '密码错误');
                }
            } else {
                $this->view->setVar('errMsg', '账号不存在');
            }
        }
    }

    /**
     * 退出
     */
    public function logoutAction()
    {
        $this->cookies->set('name', '', time() + 7 * 86400);
        $this->redirect("login/index");
    }
}