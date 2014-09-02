<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 8/18/14
 * Time: 8:13 AM
 */

$installer = $this;
$installer->startSetup();
$installer->createEntityTables(
    $this->getTable('training_student/eavblogpost')
);
$installer->addEntityType('training_student_eavblogpost', array(
    //entity_mode is the URI you'd pass into a Mage::getModel() call
    'entity_model'    => 'training_student/eavblogpost',

    //table refers to the resource URI complexworld/eavblogpost
    //<complexworld_resource>...<eavblogpost><table>eavblog_posts</table>
    'table'           =>'training_student/eavblogpost',
));
$installer->endSetup();