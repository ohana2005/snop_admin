<?php

/**
 * Package form.
 sfDoctrineFormGenerator *
 * @package    cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PackageForm extends BasePackageForm
{
  public function configure()
  {
      $this->widgetSchema['package_items_list']->setOption('expanded', true);
  }
}
