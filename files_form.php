<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



require_once("{$CFG->libdir}/formslib.php");



 
class newfiles_form extends moodleform {
    //Lucius - En definition definimos la estructura de nuestro formulario.
    //Lucius - La funcion definition() está definida en la clase moodleform del archivo formslib.php
    function definition() {
        global $DB;

        $mform=& $this->_form;
        

        
         
  
        $mform->addElement('header','displayinfo', 'Adjuntar formatos', null, false);

        $options = array(
            'QDoc' => 'QDoc',
            'Qprocess' => 'Qprocess',
            'Plataforma E-Learning' => 'Plataforma E-Learning'
        );
        
        $mform->addElement('hidden', 'idinstance');
        $mform->addElement('hidden', 'courseid');
        $mform->addElement('hidden','idind','0');


         // Adding the standard "name" field.
        $mform->addElement('text', 'filename', 'Nombre del Archivo', 'maxlength="80"');
        $mform ->setType ('filename' , PARAM_RAW);                    // Establecer el tipo de elemento 
        $mform->addRule('filename', null, 'required', null, 'client'); 

        
        $select = $mform->addElement('select', 'ubicacion', 'Ubicacion del Archivo', $options);
        $select->setSelected('1');
        $mform->addRule('ubicacion', null, 'required', null, 'client');



        $this->add_action_buttons();
      

// Add standard buttons.
        
    }
}