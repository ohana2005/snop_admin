<?php

/**
 * Created by PhpStorm.
 * User: alexradyuk
 * Date: 6/20/18
 * Time: 11:56
 */
class ChildCategoryFormHotel extends ChildCategoryForm
{
    public function configure()
    {
        parent::configure(); // TODO: Change the autogenerated stub
        unset($this['hotel_id']);
    }

    public function updateObject($values = null)
    {
        $this->getObject()->hotel_id = $this->getUser()->getHotelId();
        return parent::updateObject($values); // TODO: Change the autogenerated stub
    }
}