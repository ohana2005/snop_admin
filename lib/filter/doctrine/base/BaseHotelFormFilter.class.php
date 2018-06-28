<?php

/**
 * Hotel filter form base class.
 *
 * @package    cms
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseHotelFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'admin_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Admin'), 'add_empty' => true)),
      'name'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'apihash'  => new sfWidgetFormFilterInput(),
      'slug'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'admin_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Admin'), 'column' => 'id')),
      'name'     => new sfValidatorPass(array('required' => false)),
      'apihash'  => new sfValidatorPass(array('required' => false)),
      'slug'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('hotel_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();
    $this->widgetSchema->setFormFormatterName('_Base');    

    parent::setup();
  }

  public function getModelName()
  {
    return 'Hotel';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'admin_id' => 'ForeignKey',
      'name'     => 'Text',
      'apihash'  => 'Text',
      'slug'     => 'Text',
    );
  }
}
