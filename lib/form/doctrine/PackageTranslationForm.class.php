<?php

/**
 * PackageTranslation form.
 sfDoctrineFormGenerator *
 * @package    cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PackageTranslationForm extends BasePackageTranslationForm
{
  public function configure()
  {
      $this->validatorSchema['name']->setOption('required', false);
  }
}
