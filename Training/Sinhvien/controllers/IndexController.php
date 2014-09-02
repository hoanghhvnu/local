<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 8/13/14
 * Time: 3:08 PM
 */
class Training_Sinhvien_IndexController
    extends Mage_Core_Controller_Front_Action{
    private $_error = array();
    private $_ModelClass = 'training_sinhvien/sinhvien';

    public function indexAction(){
        $test = new Varien_Object();
        echo "<pre>";
        $test->setName('hoang');
        $test->setNumber('00000');
//        var_dump($test);
        $array = array('some'=>$test);
//        var_dump($array);
        $a = $array['some'];
        var_dump($a);
//        die();

        echo "<pre>";
//        var_dump($test);
        echo 'before dispathc';
//        $test = array('name'=>'hoang');
//        Mage::dispatchEvent('hoanghuyhoang',array('name'=>$test));
        $a->setTitle('title');
        var_dump($test);
        die();
        $sv = Mage::getModel($this->_ModelClass);
        $sv->load(1);

        $this->loadLayout();
        $this->renderLayout();
    } // end indexAction

    public function insertAction(){
        $param = $this->getRequest()->getParams();
        if( ! isset($param['gender'])){
            $param['gender'] = '';
        }
//        $param = $this->_cleanInput($param);
        if(isset($param['btnSubmit'])){
            $valid = $this->_isValidInput($param);
            if($valid === TRUE){
                $sinhvien = Mage::getSingleton($this->_ModelClass);
                $sinhvien->setSvName($param['name']);
                $sinhvien->setSvEmail($param['email']);
                $sinhvien->setSvAddress($param['address']);
                $sinhvien->setSvPhone($param['phone']);
                $sinhvien->setSvGender($param['gender']);
                $sinhvien->save();
                $this->_redirect('sinhvien/index/index');
            } else{
                Mage::register('entered', $param);
            }
        } // end if isset
        $this->loadLayout();
        $this->renderLayout();
    } // end insertAction

    public function updateAction(){
        $param = $this->getRequest()->getParams();

        if( ! isset($param['gender'])){
            $param['gender'] = '';
        }
//        $param = $this->_cleanInput($param);
        Mage::register('sv_update_id', $param['id']);

        if(isset($param['btnSubmit'])){
            $valid = $this->_isValidInput($param,$param['id']);
            if($valid === TRUE){
                $sinhvien = Mage::getSingleton($this->_ModelClass);
                $sinhvien->load($param['id']);
                $sinhvien->setSvName($param['name']);
                $sinhvien->setSvEmail($param['email']);
                $sinhvien->setSvAddress($param['address']);
                $sinhvien->setSvPhone($param['phone']);
                $sinhvien->setSvGender($param['gender']);
                $sinhvien->save();
                $this->_redirect('sinhvien/index/index');
            } else{
                Mage::register('enteredUpdate', $param);
            } // end if $valid
        } // ind if issetSubmit
        $this->loadLayout();
        $this->renderLayout();
    } // end updateAction


    public function deleteAction(){
        $param = $this->getRequest()->getParams();
        $sinhvien = Mage::getSingleton($this->_ModelClass);
        $sinhvien->load($param['id']);
        $sinhvien->delete();
        $this->_redirect('sinhvien/index/index');
    } // end deleteAction()

    /**
     * triming input
     * @param null $input
     * @return array|bool|null|string
     */
    protected function _cleanInput($input=null){
        if(is_null($input)){
            return FALSE;
        }else{
            if(gettype($input) === 'array' ){
                if( empty($input)){
                    return $input;
                }else{
                    $Cleaned = array();
                    foreach($input as $key => $value){
                        $Cleaned[$key] = trim($value);
                    }
                    return $Cleaned;
                } // end if empty
            } else{
                $input = trim($input);
                return $input;
            } // end else gettype
        } // end else not null
    } // end _cleanInput()

    /**
     * check if all element in array not empty
     * @param array $inputArray
     * @return bool
     */
    protected function _isAllNotEmpty($inputArray = array()){
        $flag = TRUE;
        if(! empty($inputArray)){
            $this->_cleanInput($inputArray);
            foreach($inputArray as $key => $value){
                if($this->_isEmpty($value) === TRUE){
                    $this->_error[$key] = "Không được bỏ trống!";
                    $flag = FALSE;
                }
            }
            if( ! empty($this->_error) ){
                Mage::register('error',$this->_error);
            }
        } // end if ! empty
        return $flag;
    } // end _isAllNotEmpty

    /**
     * check if Input Form is final valid
     * @param array $inputArray
     * @param string $id
     * @return bool
     */
    protected function _isValidInput($inputArray=array(),$id = ''){
        $valid = TRUE;
        if( ! empty($inputArray)){
            $inputArray = $this->_cleanInput($inputArray);
            if( ! $this->_isAllNotEmpty($inputArray)){
                $valid = FALSE;
            }
            if(( ! isset($this->_error['email'])) && ! $this->_isEmail($inputArray['email'])){
                $valid = FALSE;
                $this->_error['email'] = 'Email không đúng định dạng!';
            } else{
                if( $this->_isExist($inputArray['email'],$id) ){
                    $valid = FALSE;
                    $this->_error['email'] = "Email đã tồn tại, vui lòng chọn email khác!";
                }
            }
            if(( ! isset($this->_error['phone'])) && ! $this->_isPhone($inputArray['phone'])){
                $valid = FALSE;
                $this->_error['phone'] = 'Số điện thoại không đúng định dạng!';
            }

            Mage::unregister('error');
            Mage::register('error', $this->_error);


        } else{
            $valid = FALSE;
        }
        return $valid;

    } // end _isValidInput

    /**
     * Check if a field is empty
     * @param string $field
     * @return bool
     */
    protected function _isEmpty($input){
        if(is_null($input)){
            return TRUE;
        } else{
            $input = $this->_cleanInput($input);
            if(gettype($input) === 'array'){
                if( empty($input)){
                    return TRUE;
                }
            } else{
                if($input === ''){
                    return TRUE;
                }
            }
            return FALSE;
        } // end if is_null
    } // end _isEmpty()

    /**
     * Check if Email is valid syntax
     * @param string $email
     * @return bool
     */
    protected function _isEmail($email=''){
        $email = $this->_cleanInput($email);
        if($this->_isEmpty($email)) return FALSE;
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            return TRUE;
        }
        return FALSE;
    } // end _isEmail

    /**
     * Check if phone is valid syntax
     * @param string $phone
     * @return bool
     */
    protected function _isPhone($phone=''){
        $phone = $this->_cleanInput($phone);
        $FirstChar = substr($phone,0,1);
        $Remain = substr($phone,1);
        if( ! ctype_digit($Remain) ) return FALSE;
        $len = strlen($phone);
        switch($FirstChar){
            case '+':
                if($len < 11 || $len > 12){
                    return FALSE;
                }
                break;
            case '0':
                if($len < 9 || $len > 10){
                    return FALSE;
                }
                break;
            default:
                return FALSE;
        } // end switch
        return TRUE;
    } // end _isPhone

    /**
     * check if email already exist in database
     * @param string $email
     * @param string $id
     * @return bool
     */
    protected function _isExist($email='',$id=''){
        $email = $this->_cleanInput($email);
        if($this->_isEmpty($email)){
            return FALSE;
        } else{
            $sinhvien = Mage::getSingleton($this->_ModelClass)->getCollection();

            $emailArray = array();
            foreach($sinhvien as $key => $value){
                $emailArray[$key] = $value['sv_email'];
            }

            if($id === ''){ // check when insert
                $result = $sinhvien->addFieldToFilter('sv_email',array('eq'=>$email))->getData();
            } else{ // check when update
                $result = $sinhvien->addFieldToFilter('sv_email',array('eq'=>$email))
                    ->addFieldToFilter('sv_id',array('neq'=>$id))
                    ->getData();
            } // end if $id == ''
            if( ! $this->_isEmpty($result)){
                return TRUE;
            } // end if isEmpty
        } // end else if
        return FALSE;
    } // end _isExist
}// end class Training_Sinhvien_IndexController
// end file IndexController