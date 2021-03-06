<?php

/**
 * PackageItem2ChildCategory form base class.
 * sfDoctrineFormGenerator 
 * @method PackageItem2ChildCategory getObject() Returns the current form's model object
 *
 * @package    cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
   
   
   
 
abstract class BasePackageItem2ChildCategoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
       
            
            
              'package_item_id'   => new sfWidgetFormInputHidden(),
      
        
        
       
            
            
              'child_category_id' => new sfWidgetFormInputHidden(),
      
        
        
    ));

    $this->setValidators(array(
            
              'package_item_id'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('package_item_id')), 'empty_value' => $this->getObject()->get('package_item_id'), 'required' => false)),
                  
              'child_category_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('child_category_id')), 'empty_value' => $this->getObject()->get('child_category_id'), 'required' => false)),
          ));

    $this->widgetSchema->setNameFormat('package_item2_child_category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
    
           
           
     
         
  }

  public function getModelName()
  {
    return 'PackageItem2ChildCategory';
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
      }
  

  protected function doSave($con = null)
  {
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
