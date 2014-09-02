<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 8/17/14
 * Time: 9:48 PM
 */
class Training_Sinhvien_Model_Resource_Blogpost extends Mage_Core_Model_Resource_Db_Abstract{
    protected function _construct()
    {
        $this->_init('training_sinhvien/blogpost', 'blogpost_id');
    }
} // end class