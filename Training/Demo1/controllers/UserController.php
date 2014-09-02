<?php
/**
 * Created by PhpStorm.
 * User: KHOI
 * Date: 7/30/14
 * Time: 10:17 AM
 */
class Training_Demo1_UserController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
//        echo __METHOD__;
        $this->loadLayout();
        $this->renderLayout();
    }

    public function createNewUserAction() {
        $blogpost = Mage::getModel('demo1/demo1model');

        $blogpost->setTitle('Code Post!');
        $blogpost->setPost('This post was created from code!');
        $blogpost->setCreatedAt(now());
        $blogpost->save();
        echo 'Post with ID ' . $blogpost->getId() . ' created.';
        $this->showAllBlogPostsAction();

    }
}