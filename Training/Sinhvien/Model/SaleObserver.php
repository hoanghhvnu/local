<?php
/**
 * Created by PhpStorm.
 * User: luoi
 * Date: 8/15/14
 * Time: 9:52 AM
 */
class Training_Sinhvien_Model_SaleObserver{


    /**
     * @param $observer
     */


    public function editPriceCategory($observer){
        $products = $observer->getCollection();
        $MyCustomPrice = 100;
        foreach($products as $product){
            $product->setFinalPrice($MyCustomPrice);
//            $product->setData('final_price',$MyCustomPrice);
        }
    } // end editPriceCategory()

    public function editPriceDetail($observer){
        $product = $observer->getProduct();
//        $OldPrice = $product->getFinalPrice();
//        echo $OldPrice;
//        die();

        $OldPrice = 100;
        $IncreasePercent = 0.25;
        $product->setFinalPrice($OldPrice + $OldPrice * $IncreasePercent);
    } // end editPriceDetail

    public function editCart(Varien_Event_Observer $observer){
        $item = $observer->getQuoteItem();
//        $product = $observer->getProduct();
        if ($item->getParentItem()) {
            $item = $item->getParentItem();
        }
//        $OldPrice = $product->getFinalPrice();
        $OldPrice = $item->getProduct()->getFinalPrice();
//        $OldPrice = 125;
//        echo $OldPrice;
//        die();

        $IncreasePercent = 0.05;
        $specialPrice = $OldPrice + $OldPrice * $IncreasePercent;
//        if ($specialPrice > 0) {
//            $item->setCustomPrice($specialPrice);
//        }
        $item->setOriginalCustomPrice($specialPrice);
        $item->getProduct()->setIsSuperMode(true);
    } // end editCart()
}