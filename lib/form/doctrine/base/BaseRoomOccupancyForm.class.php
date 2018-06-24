<?php

/**
 * RoomOccupancy form base class.
 * sfDoctrineFormGenerator 
 * @method RoomOccupancy getObject() Returns the current form's model object
 *
 * @package    cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
   
   
   
 
abstract class BaseRoomOccupancyForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
       
            
            
              'id'                       => new sfWidgetFormInputHidden(),
      
        
        
       
            
            
              'hotel_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hotel'), 'add_empty' => false)),
      
        
        
       
            
            
              'room_occupancy_entity_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RoomOccupancyEntity'), 'add_empty' => true)),
      
        
        
       
            
            
              'room_id'                  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Room'), 'add_empty' => false)),
      
        
        
       
            
            
              'booking_id'               => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'info'                     => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'date'                     => new sfWidgetFormDate(),
      
        
        
       
            
            
              'is_arrival'               => new sfWidgetFormInputCheckbox(),
      
        
        
       
            
            
              'is_departure'             => new sfWidgetFormInputCheckbox(),
      
        
        
       
            
            
              'is_occupied'              => new sfWidgetFormInputCheckbox(),
      
        
        
       
            
            
              'is_closed'                => new sfWidgetFormInputCheckbox(),
      
        
        
    ));

    $this->setValidators(array(
            
              'id'                       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
                  
              'hotel_id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Hotel'))),
                  
              'room_occupancy_entity_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RoomOccupancyEntity'), 'required' => false)),
                  
              'room_id'                  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Room'))),
                  
              'booking_id'               => new sfValidatorInteger(array('required' => false)),
                  
              'info'                     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
                  
              'date'                     => new sfValidatorDate(),
                  
              'is_arrival'               => new sfValidatorBoolean(array('required' => false)),
                  
              'is_departure'             => new sfValidatorBoolean(array('required' => false)),
                  
              'is_occupied'              => new sfValidatorBoolean(array('required' => false)),
                  
              'is_closed'                => new sfValidatorBoolean(array('required' => false)),
          ));

    $this->widgetSchema->setNameFormat('room_occupancy[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
    
           
           
     
         
  }

  public function getModelName()
  {
    return 'RoomOccupancy';
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
