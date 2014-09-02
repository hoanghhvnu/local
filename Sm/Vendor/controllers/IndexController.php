<?php
class Sm_Vendor_IndexController extends Mage_core_Controller_Front_Action{
    protected $_CustomerModelClass = 'customer/customer';
    protected $_ProductModelClass = 'catalog/product';

	public function indexAction(){
        $this->_checkIfLoggedIn();
        $this->_checkAsVendor();
	} // end indexAction()


    public function vendorinfoAction(){
        echo __METHOD__;
        $params = $this->getRequest()->getParams();
        if(isset($params['btnsubmit'])){
            $this->_setVendorInfo();
        }
        $session = Mage::getSingleton('customer/session', array('name'=>'frontend'));
        $CustomerId = $session->getId();
        $VendorInfo = Mage::getModel($this->_CustomerModelClass)->load($CustomerId);
        $Vendor = array();
        $Vendor['vendor_name'] = $VendorInfo->getVendorName();
        $Vendor['vendor_logo'] = $VendorInfo->getVendorLogo();
        $Vendor['vendor_paypal'] = $VendorInfo->getVendorPaypal();
        Mage::register('VendorInfo', $Vendor);



        $this->loadLayout();
        $this->renderLayout();
    }


    public function listVendorAction(){
        $vendors = Mage::getModel($this->_CustomerModelClass)->getCollection()
        ->AddAttributeToSelect('*');
        $ArrayVendor = array();
        $i = 0;
        foreach($vendors as $VendorInfo){
            if($VendorInfo->getVendorName() != ''){
//                echo "id: " . $vendor->getId();
//                echo "Vendor Name: " . $vendor->getVendorName() . "<br/>";
//                echo "Vendor Logo: " . $vendor->getVendorLogo() . "<br/>";
//                echo "Vendor Paypal: " . $vendor->getVendorPaypal() . "<br/>";
                $ArrayVendor[$i]['vendor_name'] = $VendorInfo->getVendorName();
                $ArrayVendor[$i]['vendor_logo'] = $VendorInfo->getVendorLogo();
                $ArrayVendor[$i++]['vendor_paypal'] = $VendorInfo->getVendorPaypal();
            } // end if $vendorInfo
        } // end foreach
//        echo "<pre>";
//        var_dump($ArrayVendor);
//        die();
        Mage::register('ArrayVendor',$ArrayVendor);
        $this->loadLayout();
        $this->renderLayout();
    } // end method listVendorAction()
    /**
     * Add vendor
     */
    public function registervendorAction(){

        $this->_setVendorInfo();
        $this->loadLayout();
        $this->renderLayout();
    } // end registerVendorAction()

    protected function _checkAsVendor(){
        $session = Mage::getSingleton('customer/session', array('name'=>'frontend'));
        $CustomerId = $session->getId();
        $VendorInfo = Mage::getModel($this->_CustomerModelClass)->load($CustomerId);
        if( $VendorInfo->getVendorName() != ''){
            // print Vendor information
            $this->_redirect( 'vendor/index/vendorinfo');
        } else{
            // print form to registor as vendor
            $this->_redirect('vendor/index/registervendor');
        }
    } // end method checkAsVendor()

    protected function _checkIfLoggedIn(){
        $session = Mage::getSingleton('customer/session', array('name'=>'frontend'));

        // check if customer logged in
        if( ! $session->isLoggedIn()){
            echo "You don't have permission to access this page. You must login as customer to use this feature<br/>";
            echo "<a href='http://localhost/magento2/customer/account/login/'>Login</a>";
            die();

        } // end if
    } // end checkIfLoggedIn()

    protected function _setVendorInfo(){
        $params = $this->getRequest()->getParams();
        $session = Mage::getSingleton('customer/session', array('name'=>'frontend'));
        if( ! empty($params)){
            if(isset($params['btnsubmit'])){
                $CustomerId = $VendorName = $VendorLogo = $VendorPaypal = '';
                if($session->isLoggedIn()){
                    $CustomerId = $session->getId();
                }
                if($params['vd_name'] !== ''){
                    $VendorName = $params['vd_name'];
                }
                if($params['vd_paypal'] !== ''){
                    $VendorPaypal = $params['vd_paypal'];
                }
                $Logo = $_FILES['vd_logo'];
                if($Logo['error'] === 0){
                    $VendorLogo = $Logo['name'];
                }

//                if($CustomerId && $VendorName && $VendorLogo && $VendorPaypal){
//                    $Customer = Mage::getModel($this->_CustomerModelClass);
                    $Customer = Mage::getModel($this->_CustomerModelClass)->load($CustomerId);

                    if($Logo['error'] === 0){
                        $fileName = $VendorLogo;

                        $uploader       = new Varien_File_Uploader('vd_logo');
                        $uploader->setAllowedExtensions(array('png', 'jpg')); //allowed extensions
                        $uploader->setAllowRenameFiles(false);
                        $uploader->setFilesDispersion(false);
                        $path = Mage::getBaseDir('media') . DS . 'import/vendor';
                        $uploader->save($path . DS, $fileName );

                        $Customer->setVendorLogo($VendorLogo);
                    }


                    $Customer->setVendorName($VendorName);

                    $Customer->setVendorPaypal($VendorPaypal);
                    $Customer->setCustomerType('vendor');
                    $Customer->save();
                    return TRUE;
//                } // end if not empty
            } // end if btnsubmit
        } // end if $param
        return FALSE;
    } // end setVendorInfo
} // end class
// end fileS