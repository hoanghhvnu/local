<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 8/18/14
 * Time: 3:37 PM
 */
class Training_Weblog_IndexController extends Mage_Core_Controller_Front_Action{
    public function indexAction(){
//        echo 'setup';
        $this->loadLayout();
//        $this->getLayout('header');
        $LogoBlock = $this->getLayout()
            ->createBlock('training_weblog/demo','logo')
            ->setTemplate('weblog/logo.phtml');
//        $this->getLayout()->getBlock('content')->append($LogoBlock);
//        $this->getLayout()->unsetBlock('right');
        $this->renderLayout();
    }

    public function modlayoutAction(){
        $this->loadLayout();
        $NewBlockD = $this->getLayout()
            ->createBlock('training_weblog/demo','divd')
            ->setTemplate('weblog/d.phtml');
        $this->getLayout()->getBlock('left')->append($NewBlockD);
        $this->renderLayout();
    }
    public function layout3columnsAction(){
        $this->loadLayout();
        $this->renderLayout();
    }
}