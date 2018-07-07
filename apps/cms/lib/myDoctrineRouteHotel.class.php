<?php

/**
 * Created by PhpStorm.
 * User: alexradyuk
 * Date: 1/24/18
 * Time: 12:46
 */
class myDoctrineRouteHotel extends sfDoctrineRoute{

    public function getObject() {
        $object = parent::getObject();
        $hotel_id = sfContext::getInstance()->getUser()->getHotelId();
        if($hotel_id != $object->hotel_id){
            throw new sfError404Exception(sprintf('The %s object[%s] is not available for current hotel[%s]', $this->options['model'], $object->getId(), $hotel_id));
        }

        return $object;

    }

}
{

}