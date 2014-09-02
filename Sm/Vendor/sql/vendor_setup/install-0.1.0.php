<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 8/27/14
 * Time: 12:53 PM
 */
$installer = $this;
$installer = Mage::getResourceModel('customer/setup','customer_setup');
//echo "<pre>";
//var_dump($installer);
//die('die runed');

$installer->startSetup();

$installer->addEntityType('sm_vendor', array(
    //entity_mode is the URI you'd pass into a Mage::getModel() call
    'entity_model'    => 'vendor/eavvendor',

    //table refers to the resource URI complexworld/eavblogpost
    //<complexworld_resource>...<eavblogpost><table>eavblog_posts</table>
    'table'           =>'vendor/eavvendor',
));
$installer->createEntityTables(
    $this->getTable('vendor/eavvendor')
);
//$installer2 = Mage::getResourceModel('customer/setup','customer_setup');
$this->addAttribute('sm_vendor', 'vd_name', array(
    'type'              => 'varchar',
    'label'             => 'Vendor Name',
    'input'             => 'text',
    'required'          => 'true',
));
$this->addAttribute('sm_vendor', 'vd_logo', array(
    'type'              => 'varchar',
    'label'             => 'Vendor Logo',
    'input'             => 'text',
    'required'          => 'true',
));
$this->addAttribute('sm_vendor', 'vd_paypal', array(
    'type'              => 'varchar',
    'label'             => 'Vendor Paypal',
    'input'             => 'text',
    'required'          => 'true',
));
$installer->endSetup();
