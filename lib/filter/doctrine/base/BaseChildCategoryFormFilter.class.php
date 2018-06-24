<?php

/**
 * ChildCategory filter form base class.
 *
 * @package    cms
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseChildCategoryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'hotel_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hotel'), 'add_empty' => true)),
      'name'     => new sfWidgetFormFilterInput(),
      'age'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'hotel_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Hotel'), 'column' => 'id')),
      'name'     => new sfValidatorPass(array('required' => false)),
      'age'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('child_category_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();
    $this->widgetSchema->setFormFormatterName('_Base');    

    parent::setup();
  }

  public function getModelName()
  {
    return 'ChildCategory';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'hotel_id' => 'ForeignKey',
      'name'     => 'Text',
      'age'      => 'Number',
    );
  }
}
