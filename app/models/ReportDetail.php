<?php
class ReportDetail extends \Phalcon\Mvc\Model
{
    public function initialize()
    {
        $this->setConnectionService('db');
    }

    public function getSource()
    {
        return "report_detail";
    }
}
