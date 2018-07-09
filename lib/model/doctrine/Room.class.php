<?php

/**
 * Room
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    cms
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Room extends BaseRoom
{

    protected $_occupancy = [];
    protected $_currentOccupancyDescription;
    public function loadOccupancy($from, $to) {
        $q = Q::c('RoomOccupancy', 'o')
            ->innerJoin('o.RoomOccupancyEntity e')
            ->where('o.room_id = ?', $this->id)
            ->andWhere('o.date BETWEEN ? AND ?', array($from, $to))
            ->orderBy('o.date, o.is_departure desc')
            ->setHydrationMode(Doctrine::HYDRATE_ARRAY)
            ;

        $occupancy = $q->execute();

        foreach($occupancy as $ro){
            if(!isset($this->_occupancy[$ro['date']])){
                $this->_occupancy[$ro['date']] = array();
            }
            $ro['cssClass'] = $this->getOccupancyCssClass($ro);
            $ro['info'] = $ro['RoomOccupancyEntity']['name'];
            $ro['info2'] = $ro['RoomOccupancyEntity']['description'];
            $this->_occupancy[$ro['date']][] = $ro;
        }
    }
    public function getOccupancy($date){
        return isset($this->_occupancy[$date]) ? $this->_occupancy[$date] : null;
    }

    public function getOccupancyCssClass($ro){
        $class = '';
        foreach(array('arrival', 'departure', 'occupied', 'closed') as $val){
            if($ro['is_' . $val]){
                $class .= 'occupancy-' . $val;
            }
        }
        $types = array('1' => 'booking', '2' => 'reservation', '3' => 'lastminute', '4' => 'offer');
        foreach($types as $i => $cls){
            if($ro['RoomOccupancyEntity']['typeid'] == $i){
                $class .= ' occupancy-' . $cls;
            }
        }
        return $class;
    }

    public function isFree($arrivalDate, $departureDate){
        $this->_occupancy = [];
        $this->loadOccupancy($arrivalDate, $departureDate);
        if(empty($this->_occupancy)){
            return true;
        }
        foreach($this->_occupancy as $date => $roArray){
            foreach($roArray as $ro) {
                if ($date == $arrivalDate && $ro['is_departure']) {
                    continue 2;
                }
                if ($date == $departureDate && $ro['is_arrival']) {
                    continue 2;
                }
                $this->_currentOccupancyDescription = $ro['info'] . "\n" . $ro['info2'];
                return false;
            }
        }
        return true;
    }

    public function getCurrentOccupancyDescription(){
        return $this->_currentOccupancyDescription;
    }

    public function createBookingOccupancy(Booking $Booking)
    {
        $roe = new RoomOccupancyEntity();
        $roe->fromArray([
            'hotel_id' => $this->hotel_id,
            'booking_id' => $Booking->id,
            'typeid' => RoomOccupancyEntity::OCC_BOOKING,
            'name' => $Booking->guest_name,
            'description' => $Booking->guest_email . '/' . $Booking->guest_telephone
        ]);
        $roe->save();

        $dates = P::createDateRangeArray($Booking->date_arrival, $Booking->date_departure);

        foreach($dates as $date){
            $ro = new RoomOccupancy();
            $ro->fromArray([
                'hotel_id' => $this->hotel_id,
                'room_occupancy_entity_id' => $roe->id,
                'booking_id' => $Booking->id,
                'date' => $date,
                'room_id' => $this->id
            ]);
            if($date == $Booking->date_departure){
                $ro->is_departure = true;
            }elseif($date == $Booking->date_arrival){
                $ro->is_arrival = true;
            }else{
                $ro->is_occupied = true;
            }
            $ro->save();
        }
    }
}
