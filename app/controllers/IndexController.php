<?php

class IndexController extends ControllerBase
{

    /**
     * 报告列表
     */
    public function indexAction()
    {

        $listArr = ReportList::find(
            array(
                'limit' => "100",
                'order' => "id desc",
            )
        )->toArray();
//        print_r($list);die();
        $this->view->setVar('listArr', $listArr);

    }

    /**
     * 详情
     */
    public function detailAction()
    {

        $id  = $this->request->getQuery('id', 'int', 0);

        $obj = ReportList::findFirst(
            array(
                'conditions' => "id = :id:",
                'bind' => array('id' => $id)
            )
        );
        $info = is_object($obj) ? $obj->toArray() : array();

        //总计耗时
        $totalTime = 0;

        $detail = ReportDetail::find(
            array(
                'conditions' => "rid = :rid:",
                'bind' => array('rid' => $id),
                'order' => "id asc",
            )
        )->toArray();
        //按clsName重新整理数据
        $temp = array();
        if (is_array($detail) && !empty($detail)) {
            foreach ($detail as $key => $value) {
                $k = $value['clsName'];
                if (!isset($temp[$k])) {
                    $temp[$k] = array(
                        'clsName' => $k,
                        'clsDesc' => $value['clsDesc'],
                        'total' => 0,
                        'passNum' => 0,
                        'failNum' => 0,
                        'errorNum' => 0,
                        'spendTime' => 0,
                        'list' => array(),
                    );
                }
                $temp[$k]['total']++;
                if ($value['type']==0) {
                    $temp[$k]['passNum']++;
                } elseif($value['type']==1) {
                    $temp[$k]['failNum']++;
                } elseif($value['type']==2) {
                    $temp[$k]['errorNum']++;
                }
                $temp[$k]['spendTime'] += $value['spendTime'];
                $temp[$k]['list'][] = $value;
                $totalTime += $value['spendTime'];
            }
        }
        $detail = $temp;
//        print_r($detail);die();
        $this->view->setVar('info', $info);
        $this->view->setVar('detail', $detail);
        $this->view->setVar('totalTime', $totalTime);
    }

}
