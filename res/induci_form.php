<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



require_once("{$CFG->libdir}/formslib.php");



 
class newinduction_form extends moodleform {
    //Lucius - En definition definimos la estructura de nuestro formulario.
    //Lucius - La funcion definition() está definida en la clase moodleform del archivo formslib.php
    function definition() {
        global $DB;

        $mform=& $this->_form;
        

        $sql="SELECT us.id as 'idusuario', CONCAT(us.firstname,' ', us.lastname) as 'nombre'
              FROM {user} us
              ORDER BY us.id ASC";

        $cats = $DB->get_records_sql($sql, array(0));

        $options = array();
        foreach($cats as $cat){
            $options[$cat->idusuario]=$cat->nombre;
        }
        
         
        $mform->addElement('header','displayinfo', 'Nueva induccion', null, false);
        $mform->addElement('hidden', 'userid');
        $mform->addElement('hidden', 'idinstance');
        $mform->addElement('hidden', 'courseid');
        $mform->addElement('hidden','idmod','0');

        $mform->addElement('text', 'noempleado', 'Numero de empleado');
        $mform -> setType ('noempleado' , PARAM_RAW);                    // Establecer el tipo de elemento 
        $mform->addRule('noempleado', null, 'required', null, 'client'); 


        // Adding the standard "name" field.
        $mform->addElement('text', 'nameempleado', 'Nombre del empleado');
        $mform ->setType ('nameempleado' , PARAM_RAW);                    // Establecer el tipo de elemento 
        $mform->addRule('nameempleado', null, 'required', null, 'client'); 

/*




        $mform->addElement('text', 'puestoempleado','Puesto');
        $mform -> setType ('puestoempleado' , PARAM_RAW);                    // Establecer el tipo de elemento 
        $mform->addRule('puestoempleado', null, 'required', null, 'client'); 

 
        // add date_time selector
        $mform->addElement('date_selector', 'fechaingreso', 'Fecha de Ingreso');

        $select = $mform->addElement('select', 'jefedirecto', 'Jeje directo', $options);
        $select->setSelected('1');
        $mform->addRule('jefedirecto', null, 'required', null, 'client');

        $mform->addElement('text', 'departamento', 'Departamento');
        $mform -> setType ('departamento' , PARAM_RAW);
        $mform->addRule('departamento', null, 'required', null, 'client');                     // Establecer el tipo de elemento 
       
        $mform->addElement('selectyesno', 'valid', 'tipotrabajador','Tipo de Trabajador');
        $mform->setDefault('valid', 1);
        $mform->addRule('valid', null, 'required', null, 'client');
         // hidden elements
        */
   

       
 



        

        $this->add_action_buttons();
      

// Add standard buttons.
        
    }
}