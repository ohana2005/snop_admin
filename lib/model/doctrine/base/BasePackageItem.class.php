<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('PackageItem', 'doctrine');

/**
 * BasePackageItem
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $hotel_id
 * @property string $name
 * @property enum $per_period
 * @property enum $per_person
 * @property boolean $is_discount
 * @property Hotel $Hotel
 * @property Doctrine_Collection $Packages
 * @property Doctrine_Collection $PackageItem2Package
 * @property Doctrine_Collection $PackageItem2ChildCategory
 * 
 * @method integer             getHotelId()                   Returns the current record's "hotel_id" value
 * @method string              getName()                      Returns the current record's "name" value
 * @method enum                getPerPeriod()                 Returns the current record's "per_period" value
 * @method enum                getPerPerson()                 Returns the current record's "per_person" value
 * @method boolean             getIsDiscount()                Returns the current record's "is_discount" value
 * @method Hotel               getHotel()                     Returns the current record's "Hotel" value
 * @method Doctrine_Collection getPackages()                  Returns the current record's "Packages" collection
 * @method Doctrine_Collection getPackageItem2Package()       Returns the current record's "PackageItem2Package" collection
 * @method Doctrine_Collection getPackageItem2ChildCategory() Returns the current record's "PackageItem2ChildCategory" collection
 * @method PackageItem         setHotelId()                   Sets the current record's "hotel_id" value
 * @method PackageItem         setName()                      Sets the current record's "name" value
 * @method PackageItem         setPerPeriod()                 Sets the current record's "per_period" value
 * @method PackageItem         setPerPerson()                 Sets the current record's "per_person" value
 * @method PackageItem         setIsDiscount()                Sets the current record's "is_discount" value
 * @method PackageItem         setHotel()                     Sets the current record's "Hotel" value
 * @method PackageItem         setPackages()                  Sets the current record's "Packages" collection
 * @method PackageItem         setPackageItem2Package()       Sets the current record's "PackageItem2Package" collection
 * @method PackageItem         setPackageItem2ChildCategory() Sets the current record's "PackageItem2ChildCategory" collection
 * 
 * @package    cms
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePackageItem extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('package_item');
        $this->hasColumn('hotel_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('per_period', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'day',
              1 => 'booking',
             ),
             ));
        $this->hasColumn('per_person', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'room',
              1 => 'person',
              2 => 'adult',
              3 => 'child',
             ),
             ));
        $this->hasColumn('is_discount', 'boolean', null, array(
             'type' => 'boolean',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Hotel', array(
             'local' => 'hotel_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('Package as Packages', array(
             'refClass' => 'PackageItem2Package',
             'local' => 'package_item_id',
             'foreign' => 'package_id'));

        $this->hasMany('PackageItem2Package', array(
             'local' => 'id',
             'foreign' => 'package_item_id'));

        $this->hasMany('PackageItem2ChildCategory', array(
             'local' => 'id',
             'foreign' => 'package_item_id'));
    }
}