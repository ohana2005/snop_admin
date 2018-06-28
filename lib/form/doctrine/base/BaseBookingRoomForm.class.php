<?php

/**
 * BookingRoom form base class.
 * sfDoctrineFormGenerator 
 * @method BookingRoom getObject() Returns the current form's model object
 *
 * @package    cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
   
   
   
 
abstract class BaseBookingRoomForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
       
            
            
              'id'                 => new sfWidgetFormInputHidden(),
      
        
        
       
            
            
              'hotel_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Hotel'), 'add_empty' => false)),
      
        
        
       
            
            
              'booking_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Booking'), 'add_empty' => false)),
      
        
        
       
            
            
              'room_category_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RoomCategory'), 'add_empty' => true)),
      
        
        
       
            
            
              'room_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Room'), 'add_empty' => true)),
      
        
        
       
            
            
              'room_category_name' => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'room_number'        => new sfWidgetFormInputText(),
      
        
        
       
            
            
              'price'              => new sfWidgetFormInputText(),
      
        
        
    ));

    $this->setValidators(array(
            
              'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
                  
              'hotel_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Hotel'))),
                  
              'booking_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Booking'))),
                  
              'room_category_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RoomCategory'), 'required' => false)),
                  
              'room_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Room'), 'required' => false)),
                  
              'room_category_name' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
                  
              'room_number'        => new sfValidatorString(array('max_length' => 32, 'required' => false)),
                  
              'price'              => new sfValidatorNumber(array('required' => false)),
          ));

    $this->widgetSchema->setNameFormat('booking_room[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
    
           
           
     
         
  }

  public function getModelName()
  {
    return 'BookingRoom';
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
