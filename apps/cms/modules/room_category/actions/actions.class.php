<?php

require_once dirname(__FILE__).'/../lib/room_categoryGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/room_categoryGeneratorHelper.class.php';

/**
 * room_category actions.
 *
 * @package    cms
 * @subpackage room_category
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class room_categoryActions extends autoRoom_categoryActions
{
    public function executeOccupancy(sfWebRequest $request) {
        $this->RoomCategory = $this->getRoute()->getObject();

        $dates = $this->getUser()->getAttribute('room_category_datesFilter', array());
        $this->date_from = !empty($dates['date_from']) ? $dates['date_from'] : date('Y-m-d');
        $this->date_to = !empty($dates['date_to']) ? $dates['date_to'] : date('Y-m-d', time() + 60 * 60 * 24 * 365);
        foreach($this->RoomCategory->getRooms() as $Room){
            $Room->loadOccupancy($this->date_from, $this->date_to);
        }
        $period = P::createDateRangeArray($this->date_from, $this->date_to);
        $this->period = P::createPrintablePeriod($period);

    }


    public function executeFilterDates(sfWebRequest $request){
        $dates = array(
            'date_from' => date('Y-m-d', strtotime($request->getParameter('date_from'))),
            'date_to' => date('Y-m-d', strtotime($request->getParameter('date_to'))),
        );
        $this->getUser()->setAttribute('room_category_datesFilter', $dates);
        return $this->redirect($request->getReferer());
    }



    public function executePrices(sfWebRequest $request) {
        $dates = $this->getUser()->getAttribute('room_category_datesFilter', array());
        $this->date_from = !empty($dates['date_from']) ? $dates['date_from'] : date('Y-m-d');
        $this->date_to = !empty($dates['date_to']) ? $dates['date_to'] : date('Y-m-d', time() + 60 * 60 * 24 * 365);

        $period = P::createDateRangeArray($this->date_from, $this->date_to);
        $this->period = P::createPrintablePeriod($period);

        $this->RoomCategories = Q::c('RoomCategory', 'rc')
            ->where('rc.hotel_id = ?', $this->getUser()->getHotelId())
            ->execute()
            ;
        foreach($this->RoomCategories as $Cat){
            $Cat->loadPrices($this->date_from, $this->date_to);
        }
    }

    public function executeSetPrice(sfWebRequest $request){
        if($request->isMethod('post')){
            $price = $request->getParameter('price');
            foreach($request->getParameter('dates') as $date){
                $q = Q::c('PriceItem', 'i')
                    ->where('i.room_category_id = ?', $request->getParameter('item_id'))
                    ->andWhere('i.price_item_type = ?', 1)
                    ->andWhere('i.date = ?', $date)
                    ;
                $priceItem = $q->fetchOne();
                if(!$priceItem){
                    $priceItem = new PriceItem;
                    $priceItem->fromArray(array(
                        'room_category_id' => $request->getParameter('item_id'),
                        'date' => $date,
                        'price_item_type' => 1,
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


    public function executeAddOccupancy(sfWebRequest $request) {
        $this->dates = $request->getParameter('dates');
        $this->Room = Q::f('Room', $request->getParameter('roomid'));
        $this->typeid = $request->getParameter('typeid');
        $this->forward404Unless($this->Room && $this->getUser()->isMyHotel($this->Room));
        $this->checkDates($this->dates, $this->Room->id);

        if($request->getParameter('save')){
            $occ = $request->getParameter('occ');
            $info = '';
            if(in_array($this->typeid, array(RoomOccupancyEntity::OCC_RESERVATION, RoomOccupancyEntity::OCC_OFFER))){
                $info = $occ['first_name'] . ' ' . $occ['last_name'];
            }else if($this->typeid = RoomOccupancyEntity::OCC_LASTMINUTE){
                $info = 'Last minute offer';
            }
            $ROE = new RoomOccupancyEntity;
            $ROE->fromArray(array(
                'hotel_id' => $this->getUser()->getHotelId(),
                'name' => $info,
                'typeid' => $this->typeid
            ));
            $ROE->save();

            foreach($this->dates as $i => $date){
                $RO = new RoomOccupancy();
                $RO->fromArray(array(
                    'date' => $date,
                    'hotel_id' => $this->getUser()->getHotelId(),
                    'room_id' => $this->Room->id,
                    'room_occupancy_entity_id' => $ROE->id
                ));
                if(!$i){
                    $RO->is_arrival = 1;
                }else if($i == count($this->dates) - 1){
                    $RO->is_departure = 1;
                }else{
                    $RO->is_occupied = 1;
                }
                $RO->save();
            }

            switch ($this->typeid){
                case RoomOccupancyEntity::OCC_OFFER:
                    // create offer here
                    break;

                case RoomOccupancyEntity::OCC_LASTMINUTE:
                    // create last minute here
                    break;
            }
            $array = array('reload' => 1);
            $this->getResponse()->setContentType('application/json');
            return $this->renderText(json_encode($array));
        }
    }
    public function executeCloseRoom(sfWebRequest $request) {

    }
    public function executeAddOffer(sfWebRequest $request) {

    }
    public function executeAddLastminute(sfWebRequest $request) {

    }

    public function executeDeleteOccupancy(sfWebRequest $request) {
        $this->entityId = $request->getParameter('entityId');
        if($request->isMethod('post')){
            $Ent = Q::f('RoomOccupancyEntity', $this->entityId);
            $this->forward404Unless($Ent && $this->getUser()->isMyHotel($Ent));
            foreach($Ent->getRoomOccupancyRecords() as $Rec){
                $Rec->delete();
            }
            $Ent->delete();
            $array = array('reload' => 1);
            $this->getResponse()->setContentType('application/json');
            return $this->renderText(json_encode($array));
        }
    }

    protected function checkDates($dates){

    }

}
