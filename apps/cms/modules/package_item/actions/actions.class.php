<?php

require_once dirname(__FILE__).'/../lib/package_itemGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/package_itemGeneratorHelper.class.php';

/**
 * package_item actions.
 *
 * @package    cms
 * @subpackage package_item
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class package_itemActions extends autoPackage_itemActions
{
    public function executeFilterDates(sfWebRequest $request){
        $dates = array(
            'date_from' => date('Y-m-d', strtotime($request->getParameter('date_from'))),
            'date_to' => date('Y-m-d', strtotime($request->getParameter('date_to'))),
        );
        $this->getUser()->setAttribute('package_item_datesFilter', $dates);
        return $this->redirect($request->getReferer());
    }

    public function executePrices(sfWebRequest $request) {
        $dates = $this->getUser()->getAttribute('package_item_datesFilter', array());
        $this->date_from = !empty($dates['date_from']) ? $dates['date_from'] : date('Y-m-d');
        $this->date_to = !empty($dates['date_to']) ? $dates['date_to'] : date('Y-m-d', time() + 60 * 60 * 24 * 365);

        $period = P::createDateRangeArray($this->date_from, $this->date_to);
        $this->period = P::createPrintablePeriod($period);

        $this->PackageItems = Q::c('PackageItem', 'rc')
            ->where('rc.hotel_id = ?', $this->getUser()->getHotelId())
            ->execute()
        ;
        foreach($this->PackageItems as $pi){
            $pi->loadPrices($this->date_from, $this->date_to);
        }
    }

    public function executeSetPrice(sfWebRequest $request){
        if($request->isMethod('post')){
            $price = $request->getParameter('price');
            foreach($request->getParameter('dates') as $date){
                $q = Q::c('PriceItem', 'i')
                    ->where('i.package_item_id = ?', $request->getParameter('item_id'))
                    ->andWhere('i.price_item_type = ?', 2)
                    ->andWhere('i.date = ?', $date)
                ;
                $priceItem = $q->fetchOne();
                if(!$priceItem){
                    $priceItem = new PriceItem;
                    $priceItem->fromArray(array(
                        'package_item_id' => $request->getParameter('item_id'),
                        'date' => $date,
                        'price_item_type' => 2,
                        'hotel_id' => $this->getUser()->getHotelId()
                    ));
                }
                $priceItem->price = $price;
                $priceItem->save();
            }
            $array = array('close' => 1);
            $this->getResponse()->setContentType('application/json');
            return $this->renderText(json_encode($array));
        }
    }
}
