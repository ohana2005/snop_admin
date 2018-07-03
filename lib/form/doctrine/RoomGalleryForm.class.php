<?php

/**
 * RoomGallery form.
 sfDoctrineFormGenerator *
 * @package    cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RoomGalleryForm extends BaseRoomGalleryForm
{
  public function configure()
  {
      $this->hotelize('room_category_id', 'RoomCategory', true)
          ->setOption('add_empty', false)
      ;
  }
}
