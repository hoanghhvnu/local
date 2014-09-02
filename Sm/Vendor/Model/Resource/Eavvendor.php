<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 8/27/14
 * Time: 11:58 AM
 */
class Sm_Vendor_Model_Resource_Eavvendor extends Mage_Eav_Model_Entity_Abstract
{
    protected function _construct()
    {
        $resource = Mage::getSingleton('core/resource');
        $this->setType('sm_vendor');
        $this->setConnection(
            $resource->getConnection('vendor_read'),
            $resource->getConnection('vendor_write')
        );
    }
}