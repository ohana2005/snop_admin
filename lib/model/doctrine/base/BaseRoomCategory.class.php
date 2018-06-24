<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('RoomCategory', 'doctrine');

/**
 * BaseRoomCategory
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $hotel_id
 * @property string $name
 * @property string $description
 * @property integer $adults
 * @property integer $children
 * @property integer $min_persons
 * @property integer $max_persons
 * @property boolean $is_active
 * @property Hotel $Hotel
 * @property Doctrine_Collection $Gallery
 * @property Doctrine_Collection $Rooms
 * @property Doctrine_Collection $PriceItems
 * 
 * @method integer             getHotelId()     Returns the current record's "hotel_id" value
 * @method string              getName()        Returns the current record's "name" value
 * @method string              getDescription() Returns the current record's "description" value
 * @method integer             getAdults()      Returns the current record's "adults" value
 * @method integer             getChildren()    Returns the current record's "children" value
 * @method integer             getMinPersons()  Returns the current record's "min_persons" value
 * @method integer             getMaxPersons()  Returns the current record's "max_persons" value
 * @method boolean             getIsActive()    Returns the current record's "is_active" value
 * @method Hotel               getHotel()       Returns the current record's "Hotel" value
 * @method Doctrine_Collection getGallery()     Returns the current record's "Gallery" collection
 * @method Doctrine_Collection getRooms()       Returns the current record's "Rooms" collection
 * @method Doctrine_Collection getPriceItems()  Returns the current record's "PriceItems" collection
 * @method RoomCategory        setHotelId()     Sets the current record's "hotel_id" value
 * @method RoomCategory        setName()        Sets the current record's "name" value
 * @method RoomCategory        setDescription() Sets the current record's "description" value
 * @method RoomCategory        setAdults()      Sets the current record's "adults" value
 * @method RoomCategory        setChildren()    Sets the current record's "children" value
 * @method RoomCategory        setMinPersons()  Sets the current record's "min_persons" value
 * @method RoomCategory        setMaxPersons()  Sets the current record's "max_persons" value
 * @method RoomCategory        setIsActive()    Sets the current record's "is_active" value
 * @method RoomCategory        setHotel()       Sets the current record's "Hotel" value
 * @method RoomCategory        setGallery()     Sets the current record's "Gallery" collection
 * @method RoomCategory        setRooms()       Sets the current record's "Rooms" collection
 * @method RoomCategory        setPriceItems()  Sets the current record's "PriceItems" collection
 * 
 * @package    cms
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRoomCategory extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('room_category');
        $this->hasColumn('hotel_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('description', 'string', null, array(
             'type' => 'string',
             'length' => '',
             ));
        $this->hasColumn('adults', 'integer', 2, array(
             'type' => 'integer',
             'unsigned' => true,
             'notnull' => true,
             'length' => 2,
             ));
        $this->hasColumn('children', 'integer', 2, array(
             'type' => 'integer',
             'unsigned' => true,
             'default' => 0,
             'length' => 2,
             ));
        $this->hasColumn('min_persons', 'integer', 2, array(
             'type' => 'integer',
             'unsigned' => true,
             'notnull' => true,
             'length' => 2,
             ));
        $this->hasColumn('max_persons', 'integer', 2, array(
             'type' => 'integer',
             'unsigned' => true,
             'notnull' => true,
             'length' => 2,
             ));
        $this->hasColumn('is_active', 'boolean', null, array(
             'type' => 'boolean',
             'default' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Hotel', array(
             'local' => 'hotel_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('RoomGallery as Gallery', array(
             'local' => 'id',
             'foreign' => 'room_category_id'));

        $this->hasMany('Room as Rooms', array(
             'local' => 'id',
             'foreign' => 'room_category_id'));

        $this->hasMany('PriceItem as PriceItems', array(
             'local' => 'id',
             'foreign' => 'room_category_id'));
    }
}