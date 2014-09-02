<?php

    class Training_Demo1_Block_User extends Mage_Core_Block_Template
    {
        public function _prepareLayout()
        {
            return parent::_prepareLayout();
        }

        /**
         * @return mixed
         *
         */
        public function getName()
        {
           $userArr = array();
           $userArr[] = array("name","email","age");
           return $userArr;
        }
    }
?>