<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TextBlockFormAdmin
 *
 * @author Администратор
 */
class TextBlockFormAdmin extends BaseTextBlockForm{
    
    public function configure() {


        $this->embedI18n(array('en', 'ru'));

        $this->useFields(['en', 'ru']);
        /*
        $this->noEditor(array('text'));
        */
    }
    
}
