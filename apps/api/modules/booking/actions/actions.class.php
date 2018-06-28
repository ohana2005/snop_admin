<?php

/**
 * booking actions.
 *
 * @package    cms
 * @subpackage booking
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class bookingActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */

    public function executeCreate(sfWebRequest $request)
    {


        $data = json_decode(file_get_contents('php://input'), true);


        $Hotel = Q::f('Hotel', $data['hotel']['id']);
        if(!$Hotel || $Hotel->apihash != $data['hotel']['apihash']){
            return $this->errorResponse('Hotel is invalid');
        }

        $RoomCategory = Q::f('RoomCategory', $data['order']['room_category_id']);
        if(!$RoomCategory || $RoomCategory->hotel_id != $Hotel->id){
            return $this->errorResponse('Room category is invalid');
        }
        $Package = Q::f('Package', $data['order']['package_id']);
        if(!$Package || $Package->hotel_id != $Hotel->id){
            return $this->errorResponse('Room category is invalid');
        }

        $Room = $RoomCategory->findFreeRoom($data['search']['arr'], $data['search']['dep']);
        if(!$Room){
            return $this->errorResponse("No free rooms for the period {$data['search']['arr']}, {$data['search']['dep']}", 2);
        }


        $Booking = new Booking;
        $bookingData = ['hotel_id' => $Hotel->id];
        foreach ($data['guest'] as $key => $value) {
            $bookingData['guest_' . $key] = $value;
        }

        $search_map = ['arr' => 'date_arrival', 'dep' => 'date_departure', 'a' => 'adults', 'c' => 'children', 'n' => 'nights'];
        foreach ($search_map as $key => $sec_key) {
            $bookingData[$sec_key] = $data['search'][$key];
        }

        $bookingData['summary'] = serialize($data['summary']);
        $bookingData['price'] = $data['order']['price'];
        $Booking->fromArray($bookingData);
        $Booking->hash = sha1($Hotel->id . microtime() . $bookingData['guest_name']);
        $Booking->save();

        $BookingRoom = new BookingRoom;
        $BookingRoom->fromArray(
            [
                'hotel_id' => $Hotel->id,
                'booking_id' => $Booking->id,
                'room_category_id' => $RoomCategory->id,
                'room_id' => $Room->id,
                'room_category_name' => $RoomCategory->name,
                'room_number' => $Room->number
            ]
        );
        $BookingRoom->save();

        $BookingPackage = new BookingPackage();
        $BookingPackage->fromArray([
            'booking_id' => $Booking->id,
            'hotel_id' => $Hotel->id,
            'package_id' => $Package->id,
            'package_name' => $Package->name
        ]);
        $BookingPackage->save();


        $Room->createBookingOccupancy($Booking);


        $this->getResponse()->setContentType('application/json');
        return $this->renderText(json_encode([
            'type' => 'success',
            'bookingId' => $Booking->id,
            'bookingHash' => $Booking->hash
        ]));
    }

    public function errorResponse($message, $errorcode = 1){
        $this->getResponse()->setContentType('application/json');
        return $this->renderText(json_encode([
            'type' => 'error',
            'errorcode' => $errorcode,
            'message' => $message
        ]));
    }
}
