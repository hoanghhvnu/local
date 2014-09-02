<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 8/21/14
 * Time: 12:50 PM
 */
class Training_Slider_Model_Observer{
    const FLAG_SHOW_CONFIG = 'showConfig';
    const FLAG_SHOW_CONFIG_FORMAT = 'showConfigFormat';

    private $request;

    public function logCompiledLayout($o)
    {
        echo __METHOD__;
        echo 'hoang';
        $lay = $o->getLayout()->getUpdate()->getHandles();
//        echo $lay;
        $info = sprintf("%s",implode("\n\t",$lay));
        echo $info;
//        var_dump(implode("\n\t",$lay));

        die();

//        echo "<pre>";
//        echo "<textarea>";
//        var_dump($lay);
//        echo "</textarea>";
        $req  = Mage::app()->getRequest();
//        echo "<pre>";
//        var_dump($o->getLayout()->getUpdate()->asString());
//        $info = sprintf(
//            "\nRequest: %s\nFull Action Name: %s_%s_%s\nHandles:\n\t%s\nUpdate XML:\n%s",
//            $req->getRouteName(),
//            $req->getRequestedRouteName(),      //full action name 1/3
//            $req->getRequestedControllerName(), //full action name 2/3
//            $req->getRequestedActionName(),     //full action name 3/3
////            implode("\n\t",$o->getLayout()->getUpdate()->getHandles()),
////            $o->getLayout()->getUpdate()->asString()
//        );
//        echo $info;
        // Force logging to var/log/layout.log
        Mage::log($info, Zend_Log::INFO, 'layout.log', true);
//        return FALSE;
    }
    public function checkForConfigRequest($observer) {
        echo __METHOD__;
        echo Mage::app()->getConfig()->getNode()->asXML();
//        die();
        $this->request = $observer->getEvent()->getData('front')->getRequest();
        if($this->request->{self::FLAG_SHOW_CONFIG} === 'true'){
            $this->setHeader();
            $this->outputConfig();
        }
    }

    private function setHeader() {
        $format = isset($this->request->{self::FLAG_SHOW_CONFIG_FORMAT}) ?
            $this->request->{self::FLAG_SHOW_CONFIG_FORMAT} : 'xml';
        switch($format){
            case 'text':
                header("Content-Type: text/plain");
                break;
            default:
                header("Content-Type: text/xml");
        }
    }

    public function myevent($observer){
        echo 'this is data from my event';
        $observer=$observer->getName();
        $observer->setNumber('09043940');
//        var_dump($observer->getNumber());
        echo '<br/>end observer';
    }

    private function outputConfig() {
        die(Mage::app()->getConfig()->getNode()->asXML());
    }
} // end class