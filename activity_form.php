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
        $options = array(
            'FINALIZADO' => 'FINALIZADO',
            'NO FINALIZADO' => 'NO FINALIZADO'
        );
        

        
         
        $mform->addElement('header','displayinfo', 'Nueva induccion', null, false);

        
        $actividades = array(
            'CÓDIGO DE VESTIMENTA' => 'CÓDIGO DE VESTIMENTA',
            'ESTRUCTURA TRIPLEI VS MI PUESTO' => 'ESTRUCTURA TRIPLEI VS MI PUESTO',
            'HORARIOS' => 'HORARIOS',
            'POLÍTICAS DE ASISTENCIA' => 'POLÍTICAS DE ASISTENCIA',
            'REGLAMENTO INTERNO' => 'REGLAMENTO INTERNO'


        );
        $mform->addElement('hidden', 'idinstance');
        $mform->addElement('hidden', 'courseid');
        $mform->addElement('hidden','idind','0');


        /*
        $mform->addElement('text', 'nameactivity', 'Nombre de la actividad');
        $mform ->setType ('nameactivity' , PARAM_RAW);                    // Establecer el tipo de elemento 
        $mform->addRule('nameactivity', null, 'required', null, 'client'); */

        $select = $mform->addElement('select', 'nameactivity', 'Nombre de la actividad', $actividades);
        $select->setSelected('1');
        $mform->addRule('nameactivity', null, 'required', null, 'client');

        $select = $mform->addElement('select', 'status', 'Estatus', $options);
        $select->setSelected('1');
        $mform->addRule('status', null, 'required', null, 'client');

 
        // add date_time selector
        $mform->addElement('date_selector', 'date', 'Fecha');

        $this->add_action_buttons();
      

// Add standard buttons.
        
    }
}