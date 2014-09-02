<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 8/25/14
 * Time: 10:13 AM
 */
class Training_Sinhvien_Model_Resource_Sinhvien_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract{

    protected function _construct()
    {
        $this->_init('training_sinhvien/sinhvien');
    }
}