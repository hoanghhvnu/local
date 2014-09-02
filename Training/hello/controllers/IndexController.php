<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 8/13/14
 * Time: 10:34 AM
 */
class training_hello_IndexController extends Mage_Core_Controller_Front_Action{
    public function indexAction(){
        $name = isset($_GET['name']) ? $_GET['name'] : '';

        echo 'hello ' . $name;
    }
}