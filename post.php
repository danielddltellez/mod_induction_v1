<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Prints an instance of mod_induction.
 *
 * @package     mod_induction
 * @copyright   2019 Danie daniel.delaluz@triplei.mx
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(__DIR__.'/../../config.php');
require_once('induci_form.php');

global $DB, $OUTPUT, $PAGE, $USER;

// Check for all required variables.
$courseid = required_param('courseid', PARAM_INT);
$idinstance = required_param('idinstance', PARAM_INT); 
// Next look for optional variables.
$id = optional_param('idmod', 0, PARAM_INT);
 
if (!$course = $DB->get_record('course', array('id' => $courseid))) {
    print_error('invalidcourse', 'induction', $courseid);
}
 
require_login($course);

$PAGE->set_url('/mod/induction/view.php', array('id' => $id));
$PAGE->set_pagelayout('standard');



$courseurl = new moodle_url('/mod/induction/view.php', array('id' => $id));
/*
echo $idinstance;
echo $courseid;
echo $id;

*/

$inductionform = new newinduction_form();
$toform['idinstance'] = $idinstance;
$toform['courseid'] = $courseid;
$toform['idmod'] = $id;
$toform['userid'] = $USER->id;
$inductionform->set_data($toform);


//Form processing and displaying is done here
if ($inductionform->is_cancelled()) {

  redirect($courseurl);


    //Handle form cancel operation, if cancel button is present on form
} else if ($fromform = $inductionform->get_data()) {
  //In this case you process validated data. $mform->get_data() returns data posted in form.
  global $DB;

  
  //
  $result = $DB->get_records_sql("select u.id as iduser,
  concat(firstname,' ',lastname) as nombre,
  u.department as departamento,
  (select mf2.data from mdl_user_info_data mf2 where mf2.userid=u.id and mf2.fieldid=2) as nombrejefe,
  (select mf3.data from mdl_user_info_data mf3 where mf3.userid=u.id and mf3.fieldid=3) as puesto,
  (select mf4.data from mdl_user_info_data mf4 where mf4.userid=u.id and mf4.fieldid=4) as fechaingreso,
  (select mf5.data from mdl_user_info_data mf5 where mf5.userid=u.id and mf5.fieldid=7) as numeroempleado
  from mdl_user u
  join mdl_user_info_data md ON md.userid = u.id
  join mdl_user_info_field mf ON mf.id=md.fieldid
  where md.data like '".$fromform->noempleado."'and mf.id=7", array());

if($result == null){

   echo ('No existe numero de empleado');
   redirect($courseurl);
}else{

  foreach ($result as $valor) {
 $idusuario = $valor->iduser;
 $nombreusuario = $valor->nombre;
 $departamentosuario = $valor->departamento;
 $jefeusuario = $valor->nombrejefe;
 $puestousuario = $valor->puesto;
 $ingresousuario = $valor->fechaingreso;
 }
 
 $record1 = new stdClass();
 $record1-> userid  = $fromform->userid;
 $record1-> idinstance  = $fromform->idinstance;
 $record1-> courseid  = $fromform->courseid;
 $record1-> idmod  = $fromform->idmod;
 $record1-> idtrabajador  = $idusuario;
 $record1-> nameempleado  = $nombreusuario;
 $record1-> noempleado  = $fromform->noempleado;
 $record1-> puestoempleado  = $puestousuario;
 $record1-> fechaingreso  =  $ingresousuario;
 $record1-> idjefedirecto = $fromform->idjefedirecto;
 $record1-> jefedirecto  = $jefeusuario;
 $record1-> departamento  = $departamentosuario;

 $lastinsertid = $DB->insert_record('induction_issues', $record1);
            
 redirect($courseurl);

}

} else {
  // this branch is executed if the form is submitted but the data doesn't validate and the form should be redisplayed
  // or on the first display of the form.
	 $site = get_site();
    echo $OUTPUT->header();
    
  //Set default data (if any)
  $inductionform->set_data($toform);
  //displays the form
  $inductionform->display(); 
  echo $OUTPUT->footer();
}












