<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 8/13/14
 * Time: 2:46 PM
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();
$installer->run("
    CREATE TABLE `{$installer->getTable('training_sinhvien/sinhvien')}` (

      `sv_id` int(11) NOT NULL auto_increment,
      `sv_name` text,
      `sv_email` text,
      `sv_address` text,
      `sv_phone` text,
      `sv_gender` tinyint(1),
      PRIMARY KEY  (`sv_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");
$installer->endSetup();