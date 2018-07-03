<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CmsFilter
 *
 * @author Алекс
 */
class CmsFilter2 extends sfFilter {

    public function execute($chain) {
        $user = sfContext::getInstance()->getUser();

        if($user->isAuthenticated()) {
            if (!$user->isSuper()) {
                $Hotel = $user->getGuardUser()->getHotel();
                $user->setCulture($Hotel->admin_lang);
            } else {
                $user->setCulture('en');
            }
        }
        $chain->execute($chain);
    }

}
