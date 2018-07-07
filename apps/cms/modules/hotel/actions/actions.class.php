<?php

require_once dirname(__FILE__).'/../lib/hotelGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/hotelGeneratorHelper.class.php';

/**
 * hotel actions.
 *
 * @package    cms
 * @subpackage hotel
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class hotelActions extends autoHotelActions
{

    public function executeAdmin(sfWebRequest $request) {
        $this->Hotel = Q::f('Hotel', $request->getParameter('id'));
        $this->forward404Unless($this->Hotel);
        ;
        $this->User = $this->Hotel->getAdmin();
        $this->form = new sfGuardUserFormHotelAdmin($this->User, array('Hotel' => $this->Hotel));
//        $this->form->setHotel($this->Hotel);

        if($request->isMethod('post')){
            $this->form->bind($request->getParameter($this->form->getName()));
            if($this->form->isValid()){
                $this->form->save();

                $this->getUser()->setFlash('notice', T::__('Data saved'));
                return $this->redirect('hotel/index');
            }
        }
    }

    public function executeLoginAs(sfWebRequest $request){
        $this->Hotel = $this->getRoute()->getObject();

        if(!$this->Hotel->admin_id){
            return $this->redirect('hotel/admin?id=' . $this->Hotel->id);
        }
        $this->getUser()->loginAs($this->Hotel->getAdmin());

        return $this->redirect('dashboard/index');
    }

    public function executeGetscript(sfWebRequest $request)
    {
        $this->Hotel = $this->getRoute()->getObject();

        $this->url = "http://" . BOOKING_HOST . '/widget/' . $this->Hotel->slug . '/en/load';
    }
}
