<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 8/28/14
 * Time: 11:13 AM
// */

$installer = Mage::getResourceModel('customer/setup','customer_setup');
$installer->startSetup();
$installer->addAttribute('customer', 'customer_type', array(
    'type'              => 'varchar',
    'label'             => 'Customer type',
    'input'             => 'text',
    'required'          => 'false',
));
$installer->addAttribute('customer', 'vendor_name', array(
    'type'              => 'varchar',
    'label'             => 'Customer type',
    'input'             => 'text',
    'required'          => 'false',

));
$installer->addAttribute('customer', 'vendor_logo', array(
    'type'              => 'varchar',
    'label'             => 'Customer type',
    'input'             => 'text',
    'required'          => 'false',
));
$installer->addAttribute('customer', 'vendor_paypal', array(
    'type'              => 'varchar',
    'label'             => 'Customer type',
    'input'             => 'text',
    'required'          => 'false',
));


$installer->endSetup();

$installer2 = Mage::getResourceModel('catalog/setup','catalog_setup');
$installer2->startSetup();
$installer2->addAttribute('catalog_product', 'vendor_customer_id', array(
    'type'              => 'int',
    'label'             => 'Vendor Customer Id',
    'input'             => 'text',
    'required'          => 'false',
));
$installer2->endSetup();