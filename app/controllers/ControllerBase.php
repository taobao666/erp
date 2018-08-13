<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public $user;
    public function initialize()
    {
        $this->checkLogin();

    }

    //登录
    public function checkLogin()
    {
        $route      = \Phalcon\DI::getDefault()->get("route");
        $controller = strtolower($route->getControllerName());
        if ($controller == "login") {
            return true;
        }

        $this->user = $this->cookies->get('name')->getValue();
        //$msg  = "具体错误：您未登陆";
        if (!empty($this->user)) {
            $this->view->setVar('user', $this->user);
            return true;
        } else {
            $this->redirect('login/index');
        }
    }

    //跳转
    public function redirect($url)
    {
        $response = new Phalcon\Http\Response();
        $response->redirect($url);
        $response->send();
    }
}
