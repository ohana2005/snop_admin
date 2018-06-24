<?php

/**
 * PriceItem filter form base class.
 *
 * @package    cms
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePriceItemFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'price_item_type'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'hotel_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hotel'), 'add_empty' => true)),
      'date'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'price'            => new sfWidgetFormFilterInput(),
      'room_category_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RoomCategory'), 'add_empty' => true)),
      'package_item_id'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'price_item_type'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'hotel_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Hotel'), 'column' => 'id')),
      'date'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'price'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'room_category_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RoomCategory'), 'column' => 'id')),
      'package_item_id'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('price_item_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();
    $this->widgetSchema->setFormFormatterName('_Base');    

    parent::setup();
  }

  public function getModelName()
  {
    return 'PriceItem';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'price_item_type'  => 'Number',
      'hotel_id'         => 'ForeignKey',
      'date'             => 'Date',
      'price'            => 'Number',
      'room_category_id' => 'ForeignKey',
      'package_item_id'  => 'Number',
    );
  }
}
