<?php

/**
 * RoomGallery filter form.
 *
 * @package    cms
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RoomGalleryFormFilter extends BaseRoomGalleryFormFilter
{
  public function configure()
  {
      $this->hotelize('room_category_id', 'RoomCategory', true)
          ->setOption('add_empty', false)
          ;
  }
}
