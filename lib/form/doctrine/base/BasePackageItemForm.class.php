<?php

/**
 * PackageItem form base class.
 * sfDoctrineFormGenerator 
 * @method PackageItem getObject() Returns the current form's model object
 *
 * @package    cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
   
   
   
 
abstract class BasePackageItemForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
       
            
            
              'id'            => new sfWidgetFormInputHidden(),
      
        
        
       
            
            
              'hotel_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hotel'), 'add_empty' => false)),
      
        
        
       
            
            
              'name'          => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'per_period'    => new sfWidgetFormChoice(array('choices' => array('day' => 'day', 'booking' => 'booking'))),
      
        
        
       
            
            
              'per_person'    => new sfWidgetFormChoice(array('choices' => array('room' => 'room', 'person' => 'person', 'adult' => 'adult', 'child' => 'child'))),
      
        
        
       
            
            
              'is_discount'   => new sfWidgetFormInputCheckbox(),
      
        
        
      'packages_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Package')),
    ));

    $this->setValidators(array(
            
              'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
                  
              'hotel_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Hotel'))),
                  
              'name'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
                  
              'per_period'    => new sfValidatorChoice(array('choices' => array(0 => 'day', 1 => 'booking'), 'required' => false)),
                  
              'per_person'    => new sfValidatorChoice(array('choices' => array(0 => 'room', 1 => 'person', 2 => 'adult', 3 => 'child'), 'required' => false)),
                  
              'is_discount'   => new sfValidatorBoolean(array('required' => false)),
            'packages_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Package', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('package_item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
    
           
           
     
         
  }

  public function getModelName()
  {
    return 'PackageItem';
  }
    public function updateObject($values = null)
    {
        $object = parent::updateObject($values);
                return $object;
    }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();
    foreach($this->embeddedTextBlocks as $block_name){
        $TextBlock = Q::c('TextBlock', 'b')
            ->where('b.special_mark = ?', $block_name)
            ->fetchOne();
        if($TextBlock){
            $this->setDefault($block_name, $TextBlock->text);
        }
    }    
        if (isset($this->widgetSchema['packages_list']))
    {
      $this->setDefault('packages_list', $this->object->Packages->getPrimaryKeys());
    }

  }
  
  public function savePackagesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['packages_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Packages->getPrimaryKeys();
    $values = $this->getValue('packages_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Packages', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Packages', array_values($link));
    }
  }

  
  

  protected function doSave($con = null)
  {
    
    $this->savePackagesList($con);
        
    
    parent::doSave($con);
    
    foreach($this->embeddedTextBlocks as $block_name){
        $TextBlock = Q::c('TextBlock', 'b')
            ->where('b.special_mark = ?', $block_name)
            ->fetchOne();
        if($TextBlock){
            $TextBlock->text = $this->values[$block_name];
            $TextBlock->save();
        }
    }
  }



}
