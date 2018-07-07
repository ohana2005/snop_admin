<?php

/**
 * Created by PhpStorm.
 * User: alexradyuk
 * Date: 6/19/18
 * Time: 22:02
 */
class PackageItemFormHotel extends PackageItemForm
{
    public function configure()
    {
        parent::configure();
        unset($this['hotel_id']);

        $this->hotelize('packages_list', 'Package', true);
    }

    public function updateObject($values = null)
    {
        $this->getObject()->hotel_id = $this->getUser()->getHotelId();
        return parent::updateObject($values);
    }
}