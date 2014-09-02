<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 8/13/14
 * Time: 4:32 PM
 */
class Training_Student_IndexController extends Mage_Core_Controller_Front_Action{
    public function indexAction(){
        echo __METHOD__;
        $this->loadLayout();
        $this->renderLayout();

    }
    public function modelAction(){
        $blogpost = Mage::getModel('training_student/eavblogpost');
        echo get_class($blogpost);
//        echo __METHOD__;
    }// end testModelAction
}