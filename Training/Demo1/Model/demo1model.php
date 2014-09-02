<?php
/**
 * Created by PhpStorm.
 * User: KHOI
 * Date: 8/1/14
 * Time: 4:01 PM
 */
class Training_Demo1_Model_demo1model extends Mage_Core_Model_Abstract
{
    const ENTITY        = 'catalog_product';

    protected function _construct()
    {
        $this->_init('demo1/demo1model');
    }

    public function testlist()
    {
        //return __METHOD__;
        $products = Mage::getModel('catalog/product')->getCollection();
        $products->addAttributeToSelect('name');
        return $products;
    }
}