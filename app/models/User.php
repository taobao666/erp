<?php

class User extends \Phalcon\Mvc\Model
{
    public function initialize()
    {
        $this->setConnectionService('db');
    }

    public function getSource()
    {
        return "user";
    }
}
