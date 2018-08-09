<?php

class ReportList extends \Phalcon\Mvc\Model
{
    public function initialize()
    {
        $this->setConnectionService('db');
    }

    public function getSource()
    {
        return "report_list";
    }
}
