<?php

/**
 * HotelConfigTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class HotelConfigTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object HotelConfigTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('HotelConfig');
    }

    public function tmListHotel(Doctrine_Query $q) {
        $a = $q->getRootAlias();
        $q->andWhere("$a.hotel_id = ?", sfContext::getInstance()->getUser()->getHotelId());
        return $q;
    }
}