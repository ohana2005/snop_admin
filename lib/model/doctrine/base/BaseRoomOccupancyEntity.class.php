<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('RoomOccupancyEntity', 'doctrine');

/**
 * BaseRoomOccupancyEntity
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $hotel_id
 * @property integer $booking_id
 * @property integer $typeid
 * @property string $name
 * @property string $description
 * @property Hotel $Hotel
 * @property Booking $Booking
 * @property Doctrine_Collection $RoomOccupancyRecords
 * 
 * @method integer             getHotelId()              Returns the current record's "hotel_id" value
 * @method integer             getBookingId()            Returns the current record's "booking_id" value
 * @method integer             getTypeid()               Returns the current record's "typeid" value
 * @method string              getName()                 Returns the current record's "name" value
 * @method string              getDescription()          Returns the current record's "description" value
 * @method Hotel               getHotel()                Returns the current record's "Hotel" value
 * @method Booking             getBooking()              Returns the current record's "Booking" value
 * @method Doctrine_Collection getRoomOccupancyRecords() Returns the current record's "RoomOccupancyRecords" collection
 * @method RoomOccupancyEntity setHotelId()              Sets the current record's "hotel_id" value
 * @method RoomOccupancyEntity setBookingId()            Sets the current record's "booking_id" value
 * @method RoomOccupancyEntity setTypeid()               Sets the current record's "typeid" value
 * @method RoomOccupancyEntity setName()                 Sets the current record's "name" value
 * @method RoomOccupancyEntity setDescription()          Sets the current record's "description" value
 * @method RoomOccupancyEntity setHotel()                Sets the current record's "Hotel" value
 * @method RoomOccupancyEntity setBooking()              Sets the current record's "Booking" value
 * @method RoomOccupancyEntity setRoomOccupancyRecords() Sets the current record's "RoomOccupancyRecords" collection
 * 
 * @package    cms
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRoomOccupancyEntity extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('room_occupancy_entity');
        $this->hasColumn('hotel_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('booking_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('typeid', 'integer', 1, array(
             'type' => 'integer',
             'unsigned' => true,
             'length' => 1,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('description', 'string', null, array(
             'type' => 'string',
             'length' => '',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Hotel', array(
             'local' => 'hotel_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Booking', array(
             'local' => 'booking_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('RoomOccupancy as RoomOccupancyRecords', array(
             'local' => 'id',
             'foreign' => 'room_occupancy_entity_id'));
    }
}