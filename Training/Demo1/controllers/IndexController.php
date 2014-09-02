<?php
/**
 * Created by PhpStorm.
 * User: KHOI
 * Date: 7/31/14
 * Time: 10:33 AM
 */
class Training_Demo1_IndexController extends  Mage_Core_Controller_Front_Action
{
    public function  indexAction()
    {
//        echo __METHOD__;
        $this->loadLayout();
        $this->renderLayout();
    }
    public function testAction()
    {
        echo __METHOD__;
    }
}