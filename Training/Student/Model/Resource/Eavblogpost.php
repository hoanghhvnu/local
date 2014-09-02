<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 8/18/14
 * Time: 7:53 AM
 */
class Training_Student_Model_Resource_Eavblogpost extends Mage_Eav_Model_Entity_Abstract{
    protected function _construct()
    {
        $resource = Mage::getSingleton('core/resource');
        $this->setType('training_student_eavblogpost');
        $this->setConnection(
            $resource->getConnection('training_student_read'),
            $resource->getConnection('training_student_write')
        );
    }
}