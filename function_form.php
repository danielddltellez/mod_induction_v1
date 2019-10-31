<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



require_once("{$CFG->libdir}/formslib.php");



 
class newfunction_form extends moodleform {
    //Lucius - En definition definimos la estructura de nuestro formulario.
    //Lucius - La funcion definition() está definida en la clase moodleform del archivo formslib.php
    function definition() {
        global $DB;

        $mform=& $this->_form;
        

        
         
        $mform->addElement('header','displayinfo', 'Nueva Función', null, false);
        $options = array(
            'NO FINALIZADO' => 'NO FINALIZADO',
            'FINALIZADO' => 'FINALIZADO'
        );
        
        $mform->addElement('hidden', 'idinstance');
        $mform->addElement('hidden', 'courseid');
        $mform->addElement('hidden','idind','0');


        // Adding the standard "name" field.
        $mform->addElement('textarea', 'namefunction', 'Función', 'maxlength="650"', 'wrap="virtual" rows="20" cols="50"');
        $mform ->setType ('namefunction' , PARAM_RAW);
                           // Establecer el tipo de elemento 
        $mform->addRule('namefunction', null, 'required', null, 'client'); 

        /*
        $select = $mform->addElement('select', 'porcentaje', 'Valor a otorgar', $options);
        $select->setSelected('1');
        $mform->addRule('porcentaje', null, 'required', null, 'client');
        */

        $select = $mform->addElement('select', 'estatus', 'Estatus', $options);
        $select->setSelected('1');
        $mform->addRule('estatus', null, 'required', null, 'client');

 
        // add date_time selector
        $mform->addElement('date_selector', 'date', 'Fecha');
        
       

        $this->add_action_buttons();
      

// Add standard buttons.
        
    }
}