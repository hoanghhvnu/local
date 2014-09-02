<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 8/25/14
 * Time: 10:23 AM
 */
class Training_Sinhvien_Block_Sinhvien extends Mage_Core_Block_Template{
    public function getSinhvien($id=''){
        $sinhvien = Mage::getSingleton('training_sinhvien/sinhvien');
        if($id === ''){
            $sinhvien = Mage::getSingleton('training_sinhvien/sinhvien')->getCollection();

////                array(
//                    array('sv_id',array('eq'=>'4')),
//                    array('sv_email',array('eq'=>'vietdq@smartosc.com'))
////                )
//            );//->getSelect();
        } else{
            $sinhvien = $sinhvien->load($id)->getData();
        }
        return $sinhvien;
    } // end getSinhvien()
} // end class