<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



require_once("{$CFG->libdir}/formslib.php");



 
class newarea_form extends moodleform {
    //Lucius - En definition definimos la estructura de nuestro formulario.
    //Lucius - La funcion definition() está definida en la clase moodleform del archivo formslib.php
    function definition() {
        global $DB;

        $mform=& $this->_form;
        

        
         
        $mform->addElement('header','displayinfo', 'Agregar area', null, false);

        $options = array(
            'N/A' => 'N/A',
            'ADMINISTRACIÓN' => 'ADMINISTRACIÓN',
            'OPERACIONES' => 'OPERACIONES',
            'DIRECCION GENERAL' => 'DIRECCION GENERAL'

        );
        $mform->addElement('hidden', 'idinstance');
        $mform->addElement('hidden', 'courseid');
        $mform->addElement('hidden','idind','0');


        /*
        $mform->addElement('text', 'namearea', 'Nombre del area');
        $mform ->setType ('namearea' , PARAM_RAW);                    // Establecer el tipo de elemento 
        $mform->addRule('namearea', null, 'required', null, 'client'); */


        $select = $mform->addElement('select', 'namearea', 'Nombre del area', $options);
        $select->setSelected('1');
        $mform->addRule('namearea', null, 'required', null, 'client');

        
        // Adding the standard "name" field.
        $mform->addElement('textarea', 'description', 'Descripción', 'maxlength="650"', 'wrap="virtual" rows="20" cols="50"');
        $mform ->setType ('description' , PARAM_RAW);
                           // Establecer el tipo de elemento 
        $mform->addRule('description', null, 'required', null, 'client'); 

        $this->add_action_buttons();
      

// Add standard buttons.
        
    }
}