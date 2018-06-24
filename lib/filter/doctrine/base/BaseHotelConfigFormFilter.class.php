<?php

/**
 * HotelConfig filter form base class.
 *
 * @package    cms
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseHotelConfigFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'hotel_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hotel'), 'add_empty' => true)),
      'keyname'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'section'  => new sfWidgetFormFilterInput(),
      'datatype' => new sfWidgetFormFilterInput(),
      'label'    => new sfWidgetFormFilterInput(),
      'value'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'hotel_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Hotel'), 'column' => 'id')),
      'keyname'  => new sfValidatorPass(array('required' => false)),
      'section'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'datatype' => new sfValidatorPass(array('required' => false)),
      'label'    => new sfValidatorPass(array('required' => false)),
      'value'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('hotel_config_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();
    $this->widgetSchema->setFormFormatterName('_Base');    

    parent::setup();
  }

  public function getModelName()
  {
    return 'HotelConfig';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'hotel_id' => 'ForeignKey',
      'keyname'  => 'Text',
      'section'  => 'Number',
      'datatype' => 'Text',
      'label'    => 'Text',
      'value'    => 'Text',
    );
  }
}
