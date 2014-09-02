<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 8/27/14
 * Time: 10:58 PM
 */
class Sm_Vendor_Model_Resource_Eavvendor_Collection extends Mage_Eav_Model_Entity_Collection_Abstract{
    protected function _construct()
    {
        $this->_init('vendor/eavvendor');
    }
}