<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



require_once("{$CFG->libdir}/formslib.php");



 
class newactivity_form extends moodleform {
    //Lucius - En definition definimos la estructura de nuestro formulario.
    //Lucius - La funcion definition() está definida en la clase moodleform del archivo formslib.php
    function definition() {
        global $DB;

        $mform=& $this->_form;

        $mform->addElement('header','displayinfo', 'Nuevo objetivo', null, false);

        

        $mform->addElement('hidden', 'idinstance');
        $mform->addElement('hidden', 'courseid');
        $mform->addElement('hidden','idind','0');


        
        $mform->addElement('text', 'nameobjetivo', 'Nombre del objetivo', 'maxlength="80"');
        $mform ->setType ('nameobjetivo' , PARAM_RAW);                    // Establecer el tipo de elemento 
        $mform->addRule('nameobjetivo', null, 'required', null, 'client');
        $mform->addElement('text', 'valorobjetivo', 'Valor sobre 100');
        $mform ->setType ('valorobjetivo' , PARAM_RAW);
        $mform->addRule('valorobjetivo', null, 'numeric', null, 'client');
        $mform->addRule('valorobjetivo', null, 'nonzero', null, 'client');
        $mform->addRule('valorobjetivo', null, 'nopunctuation', null, 'client');                    // Establecer el tipo de elemento 
        $mform->addRule('valorobjetivo', null, 'required', null, 'client');
        $mform->addElement('text', 'avanceobjetivo', 'Avance');
        $mform ->setType ('avanceobjetivo' , PARAM_RAW);
        $mform->addRule('avanceobjetivo', null, 'numeric', null, 'client');
        $mform->addRule('avanceobjetivo', null, 'nopunctuation', null, 'client');                     // Establecer el tipo de elemento 
        
        $mform->addElement('text', 'finalobjetivo', 'Final');
        $mform ->setType ('finalobjetivo' , PARAM_RAW);
        $mform->addRule('finalobjetivo', null, 'numeric', null, 'client');
        $mform->addRule('finalobjetivo', null, 'nopunctuation', null, 'client');                     // Establecer el tipo de elemento 
        

        
        $this->add_action_buttons();
      

// Add standard buttons.
        
    }
}