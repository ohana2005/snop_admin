<?php

/**
 * Created by PhpStorm.
 * User: alexradyuk
 * Date: 6/18/18
 * Time: 14:32
 */
class RoomFormHotel extends RoomForm
{
    public function configure()
    {
        parent::configure();
        unset($this['hotel_id']);
    }

    public function updateObject($values = null)
    {
        $this->getObject()->hotel_id = $this->getUser()->getHotelId();
        return parent::updateObject($values);
    }
}