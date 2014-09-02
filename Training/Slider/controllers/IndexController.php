<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 8/19/14
 * Time: 3:36 PM
 */
class Training_Slider_IndexController extends Mage_Core_Controller_Front_Action{
    public function indexAction(){
        // echo __METHOD__;
        $model = Mage::getModel('training_slider/slider');
        echo "<pre>";
        var_dump($model);
        die();
        $this->loadLayout();
//        $lay = $this->getLayout()->getUpdate()->getHandles();
//        echo "<pre>";
//        echo implode("\n\t",$lay);
        // echo $this->getLayout()->getUpdate()->asString();
//        echo $this->getLayout()->getBlock('content');
//        return false;
        $this->renderLayout();

    } // end indexAction
    public function insertAction(){
        echo __METHOD__;
    }
} // end class