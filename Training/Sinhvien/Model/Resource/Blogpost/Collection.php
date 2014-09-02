<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 8/17/14
 * Time: 10:26 PM
 */
class Training_Sinhvien_Model_Resource_Blogpost_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {
    protected function _construct()
    {
        $this->_init('training_sinhvien/blogpost');
    }
}