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
 * Library of interface functions and constants.
 *
 * @package     mod_induction
 * @copyright   2019 Danie daniel.delaluz@triplei.mx
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Return if the plugin supports $feature.
 *
 * @param string $feature Constant representing the feature.
 * @return true | null True if the feature is supported, null otherwise.
 */
function mod_induction_supports($feature) {
    switch ($feature) {
        case FEATURE_GRADE_HAS_GRADE:
            return true;
        case FEATURE_MOD_INTRO:
            return true;
        default:
            return null;
    }
}

/**
 * Saves a new instance of the mod_induction into the database.
 *
 * Given an object containing all the necessary data, (defined by the form
 * in mod_form.php) this function will create a new instance and return the id
 * number of the instance.
 *
 * @param object $moduleinduction An object from the form.
 * @param mod_induction_mod_form $mform The form.
 * @return int The id of the newly inserted record.
 */
function induction_add_instance($moduleinduction, $mform = null) {
    global $DB;

    //$moduleinduction->timecreated = time();

    $id = $DB->insert_record('induction', $moduleinduction);

    return $id;
}

/**
 * Updates an instance of the mod_induction in the database.
 *
 * Given an object containing all the necessary data (defined in mod_form.php),
 * this function will update an existing instance with new data.
 *
 * @param object $moduleinduction An object from the form in mod_form.php.
 * @param mod_induction_mod_form $mform The form.
 * @return bool True if successful, false otherwise.
 */
function induction_update_instance($moduleinduction, $mform = null) {
    global $DB;

    //$moduleinduction->timemodified = time();
    $moduleinduction->timecreated = time();
    $moduleinduction->timemodified = $moduleinduction->timecreated;
    $moduleinduction->id = $moduleinduction->instance;
    
    return $DB->update_record('induction', $moduleinduction);
}

/**
 * Removes an instance of the mod_induction from the database.
 *
 * @param int $id Id of the module instance.
 * @return bool True if successful, false on failure.
 */
function induction_delete_instance($id) {
    global $DB;

    $exists = $DB->get_record('induction', array('id' => $id));
    if (!$exists) {
        return false;
    }

    $DB->delete_records('induction', array('id' => $id));

    return true;
}


function mod_induction_print_activity($viewinduction, $return = 0){
     global $OUTPUT, $USER, $DB, $CFG;

        $display .= html_writer::start_tag('div', array('class' => 'divTable inductiontable'));
        $display .= html_writer::start_tag('div', array('class' => 'divTableHeading'));
        $display .= html_writer::start_tag('div', array('class' => 'divTableRow'));

        $display .= html_writer::start_tag('div', array('class' => 'divTableHead'));
        $display .= clean_text('<strong>Nombre</strong>');
        $display .= html_writer::end_tag('div');
        $display .= html_writer::start_tag('div', array('class' => 'divTableHead'));
        $display .= clean_text('<strong>Puesto</strong>');
        $display .= html_writer::end_tag('div');
        /*$display .= html_writer::start_tag('div', array('class' => 'divTableHead'));
        $display .= clean_text('<strong>Fecha de inicio</strong>');
        $display .= html_writer::end_tag('div');*/
        $display .= html_writer::start_tag('div', array('class' => 'divTableHead'));
        $display .= clean_text('<strong>Departamento</strong>');
        $display .= html_writer::end_tag('div');
        $display .= html_writer::start_tag('div', array('class' => 'divTableHead'));
        $display .= clean_text('<strong>Jefe directo</strong>');
        $display .= html_writer::end_tag('div');
        $display .= html_writer::start_tag('div', array('class' => 'divTableHead'));
        $display .= clean_text('<strong>No. de empleado</strong>');
        $display .= html_writer::end_tag('div');
        $display .= html_writer::start_tag('div', array('class' => 'divTableHead'));
        $display .= clean_text('<strong>Estatus</strong>');
        $display .= html_writer::end_tag('div');
        $display .= html_writer::start_tag('div', array('class' => 'divTableHead'));
        $display .= clean_text('<strong>Acciones</strong>');
        $display .= html_writer::end_tag('div');
        $display .= html_writer::end_tag('div');
        $display .= html_writer::end_tag('div');
        $display .= html_writer::start_tag('div', array('class' => 'divTableBody'));
        foreach ($viewinduction as $value) {
            $display .= html_writer::start_tag('div', array('class' => 'divTableRow'));

            $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
            $display .= clean_text($value->nameempleado);
            $display .= html_writer::end_tag('div');
            $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
            $display .= clean_text($value->puestoempleado);
            $display .= html_writer::end_tag('div');
            $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
            $display .= clean_text($value->departamento);
            $display .= html_writer::end_tag('div');
            $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
            $display .= clean_text($value->jefedirecto);
            $display .= html_writer::end_tag('div');
            $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
            $display .= clean_text($value->noempleado);
            $display .= html_writer::end_tag('div');
            $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
            if($value->status==0){
                $display .= clean_text('Sin validar');
            }else if($value->status==1){
                $display .= clean_text('Validado');
            }else{
                $display .= clean_text('registro erroneo');
            }
            $display .= html_writer::end_tag('div');

            $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
            $display .= html_writer::start_tag('a',array('class' => 'btn btn-success','href' => ''.$CFG->wwwroot.'/mod/induction/viewact.php?courseid='.$value->courseid.'&idinstance='.$value->idinstance.'&id='.$value->id.''));
            $display .= html_writer::start_tag('em', array('class' => 'fa fa-pencil'));
            $display .= html_writer::end_tag('em');
            $display .= html_writer::end_tag('a');
            if(user_has_role_assignment($USER->id, 4)){ 
            $display .= html_writer::start_tag('a',array('class' => 'btn btn-danger', 'data-toggle'=>'modal', 'href' => '#delete'.$value->id.''));
            $display .= html_writer::start_tag('em', array('class' => 'fa fa-trash'));
            $display .= html_writer::end_tag('em');
            $display .= html_writer::end_tag('a');
            }
            include('modaleditview.php');
            $display .= html_writer::end_tag('div');


            $display .= html_writer::end_tag('div');
       
        }
       $display .= html_writer::end_tag('div');
       $display .= html_writer::end_tag('div');
       if($return) {
        return $display;
        } else {
        echo $display;
        }
}

function mod_induction_view_activity($viewactivity, $return = 0){
    global $OUTPUT, $USER, $DB, $CFG;


        /*Header y datos*/

       $display .= html_writer::start_tag('div', array('class' => 'induction-container'));
       $display .= html_writer::start_tag('div', array('class' => 'induction-container-1'));
       $display .= html_writer::empty_tag('img', array('src' => 'https://e-learning.triplei.mx/2546-TripleI0419/mod/induction/images/logo.png'));
       $display .= html_writer::end_tag('div');
       $display .= html_writer::start_tag('div', array('class' => 'induction-container-2'));
       $display .= html_writer:: tag('h3','Formato de Inducción al Puesto');
       $display .= html_writer::end_tag('div');
       $display .= html_writer::end_tag('div');
       $display .= html_writer::start_tag('div', array('class' => 'induction-space'));
       $display .= html_writer::end_tag('div');
       $display .= html_writer::start_tag('div', array('class' => 'induction-container'));
       foreach ($viewactivity as $values) {
       $display .= html_writer::start_tag('div', array('class' => 'induction-cont-1'));
       $display .= html_writer::start_tag('p');
       $display .= clean_text('Nombre: ', $values->nameempleado);
       $display .= clean_text($values->nameempleado);
       $display .= html_writer::end_tag('p');
       $display .= html_writer::start_tag('p');
       $display .= clean_text('Puesto: ');
       $display .= clean_text($values->puestoempleado);
       $display .= html_writer::end_tag('p');
       $display .= html_writer::start_tag('p');
       $display .= clean_text('Jefe directo: ');
       $display .= clean_text( $values->jefedirecto);
       $display .= html_writer::end_tag('p');
       $display .= html_writer::end_tag('div');
       $display .= html_writer::start_tag('div', array('class' => 'induction-cont-1'));
       $display .= html_writer::start_tag('p');
       $display .= clean_text('No. De empleado: ');
       $display .= clean_text($values->noempleado);
       $display .= html_writer::end_tag('p');
       $display .= html_writer::start_tag('p');
       $display .= clean_text('Fecha de ingreso: ');
       $display .= clean_text($values->fechaingreso);
       $display .= html_writer::end_tag('p');
       $display .= html_writer::start_tag('p');
       $display .= clean_text('Departamento: ');
       $display .= clean_text($values->departamento);
       $display .= html_writer::end_tag('p');
       include('modaleditactivity.php');
       $display .= html_writer::end_tag('div');
    }
       $display .= html_writer::end_tag('div');


        /*Tabla cursos*/
       $display .= html_writer::start_tag('div', array('class' => 'divTable inductiontable'));

       $display .= html_writer::start_tag('div', array('class' => 'divTableHeading'));
       $display .= html_writer::start_tag('div', array('class' => 'divTableRow'));

       $display .= html_writer::start_tag('div', array('class' => 'divTableHead','style'=> 'width: 33.3%;'));
       $display .= clean_text('<strong>Actividad</strong>');
       $display .= html_writer::end_tag('div');
       $display .= html_writer::start_tag('div', array('class' => 'divTableHead','style'=> 'width: 33.3%;'));
       $display .= clean_text('<strong>Estatus</strong>');
       $display .= html_writer::end_tag('div');
       $display .= html_writer::start_tag('div', array('class' => 'divTableHead','style'=> 'width: 33.3%;'));
       $display .= clean_text('<strong>Fecha</strong>');
       $display .= html_writer::end_tag('div');
      

       $display .= html_writer::end_tag('div');
       $display .= html_writer::end_tag('div');
       $esql="select c.id AS 'courseid', c.fullname AS 'coursename',
       IFNULL((SELECT COUNT(cmm.id) FROM mdl_course_modules_completion cmm JOIN mdl_course_modules mcm ON mcm.id = cmm.coursemoduleid WHERE cmm.userid = u.id AND mcm.course = c.id AND mcm.visible = 1),0) AS 'activitiescompleted',
       IFNULL((SELECT COUNT(cmc.id) FROM mdl_course_modules cmc WHERE cmc.course = c.id AND cmc.completion IN (1 , 2) AND cmc.visible = 1), 0) AS 'activitiesassigned',
       (SELECT IF(activitiesassigned != 0,(SELECT IF(activitiescompleted = activitiesassigned,'Finalizado','No finalizado')),'n/a')) AS 'estatus',
       IFNULL(CONCAT(ROUND((SELECT (IFNULL((SELECT SUM(gg.finalgrade) FROM mdl_grade_grades AS gg JOIN mdl_grade_items AS gi ON gi.id = gg.itemid WHERE gg.itemid = gi.id AND gi.courseid = c.id AND gi.itemtype = 'mod' AND gg.userid = u.id GROUP BY u.id , c.id), 0) / (SELECT SUM(gi.grademax) FROM mdl_grade_items AS gi JOIN mdl_grade_grades AS gg ON gi.id = gg.itemid WHERE gg.itemid = gi.id AND gi.courseid = c.id AND gi.itemtype = 'mod' AND gg.userid = u.id AND gg.finalgrade IS NOT NULL GROUP BY u.id , c.id)) * 100), 0), '%'), 'n/a') AS 'Quality of Work to Date',
       (SELECT IF('activitiesassigned' != '0', CONCAT(IFNULL(ROUND(((SELECT  gg.finalgrade / gi.grademax FROM mdl_grade_items AS gi JOIN mdl_grade_grades AS gg ON gg.itemid = gi.id WHERE gi.courseid = c.id AND gg.userid = u.id AND gi.itemtype = 'course') * 10),2), '0'), ' '), 'n/a')) AS 'FinalScore', DATE_FORMAT(FROM_UNIXTIME(ue.timestart), '%d-%m-%y') AS fecha
   FROM mdl_user u
           JOIN mdl_user_enrolments ue ON ue.userid = u.id
           JOIN mdl_enrol e ON e.id = ue.enrolid
           JOIN mdl_course c ON c.id = e.courseid
           JOIN mdl_course_categories cc ON cc.id = c.category
           JOIN mdl_context AS ctx ON ctx.instanceid = c.id
           JOIN mdl_role_assignments AS ra ON ra.contextid = ctx.id
           JOIN mdl_role AS r ON r.id = e.roleid
   WHERE ra.userid = u.id AND ctx.instanceid = c.id AND ra.roleid = '5' AND u.id = '".$values->idtrabajador."' AND cc.id=32
   GROUP BY u.id , c.id , u.lastname , u.firstname , c.fullname , ue.timestart";
       $completeactivity = $DB->get_records_sql($esql, array());  
       $display .= html_writer::start_tag('div');
        $display .= clean_text('<strong>CURSOS</strong>');
        $display .= html_writer::end_tag('div');
       $display .= html_writer::start_tag('div', array('class' => 'divTableBody'));
       foreach ($completeactivity as $valores) {
           $display .= html_writer::start_tag('div', array('class' => 'divTableRow'));
           $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
           $display .= clean_text($valores->coursename);
           $display .= html_writer::end_tag('div');
           $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
           $display .= clean_text($valores->estatus);
           $display .= html_writer::end_tag('div');
           $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
           $display .= clean_text($valores->fecha);
           $display .= html_writer::end_tag('div');
           
           $display .= html_writer::end_tag('div');
      
       }
      $display .= html_writer::end_tag('div');
      $display .= html_writer::end_tag('div');

      


      if($return) {
       return $display;
       } else {
       echo $display;
       }
}

function mod_induction_view_newactivity($viewnewactivity, $return = 0){
    global $OUTPUT, $USER, $DB, $CFG;
    $display .= html_writer::start_tag('div', array('class' => 'divTable inductiontable'));
    $display .= html_writer::start_tag('div', array('class' => 'divTableHeading'));
    $display .= html_writer::start_tag('div', array('class' => 'divTableRow'));
    $display .= html_writer::start_tag('div', array('class' => 'divTableHead','style'=> 'width: 33%;'));
    $display .= clean_text('<strong>Actividad</strong>');
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableHead','style'=> 'width: 33%;'));
    $display .= clean_text('<strong>Estatus</strong>');
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableHead','style'=> 'width: 24%;'));
    $display .= clean_text('<strong>Fecha</strong>');
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableHead acciones','style'=> 'width: 10%;'));
    $display .= clean_text('<strong>Acciones</strong>');
    $display .= html_writer::end_tag('div');
    $display .= html_writer::end_tag('div');
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div');
    $display .= clean_text('<strong>Mi Puesto</strong>');
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableBody'));
    foreach ($viewnewactivity as $nuevosvalores) {
    $display .= html_writer::start_tag('div', array('class' => 'divTableRow'));
    $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
    $display .= clean_text($nuevosvalores->nameactivity);
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
    $display .= clean_text($nuevosvalores->status);
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
    $display .= clean_text($nuevosvalores->fecha);
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableCell acciones'));
    $display .= html_writer::start_tag('a',array('class' => 'btn btn-success', 'data-toggle'=>'modal','href' => '#edit_activity'.$nuevosvalores->id.''));
    $display .= html_writer::start_tag('em', array('class' => 'fa fa-pencil'));
    $display .= html_writer::end_tag('em');
    $display .= html_writer::end_tag('a');
    $display .= html_writer::start_tag('a',array('class' => 'btn btn-danger', 'data-toggle'=>'modal', 'href' => '#delete'.$nuevosvalores->id.''));
    $display .= html_writer::start_tag('em', array('class' => 'fa fa-trash'));
    $display .= html_writer::end_tag('em');
    $display .= html_writer::end_tag('a');
    include('modaleditactivity.php');
    $display .= html_writer::end_tag('div');
    $display .= html_writer::end_tag('div');
    }
    $display .= html_writer::end_tag('div');
    $display .= html_writer::end_tag('div');


    if($return) {
        return $display;
        } else {
        echo $display;
        }
}

function mod_induction_view_newfunction($viewnewfunction, $return = 0){
    global $OUTPUT, $USER, $DB, $CFG;
    $display .= html_writer::start_tag('div', array('class' => 'divTable inductiontable'));
    $display .= html_writer::start_tag('div', array('class' => 'divTableHeading'));
    $display .= html_writer::start_tag('div', array('class' => 'divTableRow'));
    $display .= html_writer::start_tag('div', array('class' => 'divTableHead','style'=> 'width: 33%;'));
    $display .= clean_text('<strong>Funciones | Actividades</strong>');
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableHead','style'=> 'width: 33%;'));
    $display .= clean_text('<strong>Estatus</strong>');
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableHead','style'=> 'width: 24%;'));
    $display .= clean_text('<strong>Fecha</strong>');
    $display .= html_writer::end_tag('div');
    if(user_has_role_assignment($USER->id, 4)){ 
    $display .= html_writer::start_tag('div', array('class' => 'divTableHead acciones','style'=> 'width: 10%;'));
    $display .= clean_text('<strong>Acciones</strong>');
    $display .= html_writer::end_tag('div');
    }
    $display .= html_writer::end_tag('div');
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableBody'));
    foreach ($viewnewfunction as $valoresf) {
    $display .= html_writer::start_tag('div', array('class' => 'divTableRow'));
    $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
    $display .= clean_text($valoresf->namefunction);
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
    $display .= clean_text($valoresf->estatus);
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
    $display .= clean_text($valoresf->fechafunc);
    $display .= html_writer::end_tag('div');
    if(user_has_role_assignment($USER->id, 4)){ 
    $display .= html_writer::start_tag('div', array('class' => 'divTableCell acciones'));
    $display .= html_writer::start_tag('a',array('class' => 'btn btn-success', 'data-toggle'=>'modal','href' => '#edit_function'.$valoresf->id.''));
    $display .= html_writer::start_tag('em', array('class' => 'fa fa-pencil'));
    $display .= html_writer::end_tag('em');
    $display .= html_writer::end_tag('a');
    $display .= html_writer::start_tag('a',array('class' => 'btn btn-danger', 'data-toggle'=>'modal', 'href' => '#deletef'.$valoresf->id.''));
    $display .= html_writer::start_tag('em', array('class' => 'fa fa-trash'));
    $display .= html_writer::end_tag('em');
    $display .= html_writer::end_tag('a');
    include('modaleditfunction.php');
    $display .= html_writer::end_tag('div');
    }
    $display .= html_writer::end_tag('div');
    }
    $display .= html_writer::end_tag('div');
    $display .= html_writer::end_tag('div');


    if($return) {
        return $display;
        } else {
        echo $display;
        }
}

function mod_induction_view_newprocesses($viewnewprocesses, $return = 0){
    global $OUTPUT, $USER, $DB, $CFG;
    $display .= html_writer::start_tag('div', array('class' => 'divTable inductiontable'));
    $display .= html_writer::start_tag('div', array('class' => 'divTableHeading'));
    $display .= html_writer::start_tag('div', array('class' => 'divTableRow'));
    $display .= html_writer::start_tag('div', array('class' => 'divTableHead','style'=> 'width: 33%;'));
    $display .= clean_text('<strong>Procesos | Procedimientos de mi puesto</strong>');
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableHead','style'=> 'width: 33%;'));
    $display .= clean_text('<strong>Estatus</strong>');
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableHead','style'=> 'width: 24%;'));
    $display .= clean_text('<strong>Fecha</strong>');
    $display .= html_writer::end_tag('div');
    if(user_has_role_assignment($USER->id, 4)){ 
    $display .= html_writer::start_tag('div', array('class' => 'divTableHead acciones','style'=> 'width: 10%;'));
    $display .= clean_text('<strong>Acciones</strong>');
    $display .= html_writer::end_tag('div');
    }
    $display .= html_writer::end_tag('div');
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableBody'));
    foreach ($viewnewprocesses as $valoresp) {
    $display .= html_writer::start_tag('div', array('class' => 'divTableRow'));
    $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
    $display .= clean_text($valoresp->nameprocesses);
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
    $display .= clean_text($valoresp->estatus);
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
    $display .= clean_text($valoresp->fechapro);
    $display .= html_writer::end_tag('div');
    if(user_has_role_assignment($USER->id, 4)){ 
    $display .= html_writer::start_tag('div', array('class' => 'divTableCell acciones'));
    $display .= html_writer::start_tag('a',array('class' => 'btn btn-success', 'data-toggle'=>'modal','href' => '#edit_processes'.$valoresp->id.''));
    $display .= html_writer::start_tag('em', array('class' => 'fa fa-pencil'));
    $display .= html_writer::end_tag('em');
    $display .= html_writer::end_tag('a');
    $display .= html_writer::start_tag('a',array('class' => 'btn btn-danger', 'data-toggle'=>'modal', 'href' => '#deletep'.$valoresp->id.''));
    $display .= html_writer::start_tag('em', array('class' => 'fa fa-trash'));
    $display .= html_writer::end_tag('em');
    $display .= html_writer::end_tag('a');
    include('modaleditprocesses.php');
    $display .= html_writer::end_tag('div');
    }
    $display .= html_writer::end_tag('div');
    }
    $display .= html_writer::end_tag('div');
    $display .= html_writer::end_tag('div');


    if($return) {
        return $display;
        } else {
        echo $display;
        }
}

function mod_induction_view_newarea($viewnewarea, $return = 0){
    global $OUTPUT, $USER, $DB, $CFG;
    $display .= html_writer::start_tag('div', array('class' => 'divTable inductiontable','style'=> 'width: 66%;'));
    $display .= html_writer::start_tag('div', array('class' => 'divTableHeading'));
    $display .= html_writer::start_tag('div', array('class' => 'divTableRow'));
    $display .= html_writer::start_tag('div', array('class' => 'divTableHead','style'=> 'width: 30%;'));
    $display .= clean_text('<strong>Áreas funcionales con  las que tienen mayor comunicación</strong>');
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableHead','style'=> 'width: 60%;'));
    $display .= clean_text('<strong>Descripción</strong>');
    $display .= html_writer::end_tag('div');
    if(user_has_role_assignment($USER->id, 4)){ 
    $display .= html_writer::start_tag('div', array('class' => 'divTableHead acciones','style'=> 'width: 10%;'));
    $display .= clean_text('<strong>Acciones</strong>');
    $display .= html_writer::end_tag('div');
    }
    $display .= html_writer::end_tag('div');
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableBody'));
    foreach ($viewnewarea as $valoresa) {
    $display .= html_writer::start_tag('div', array('class' => 'divTableRow'));
    $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
    $display .= clean_text($valoresa->namearea);
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
    $display .= clean_text($valoresa->description);
    $display .= html_writer::end_tag('div');
    if(user_has_role_assignment($USER->id, 4)){ 
    $display .= html_writer::start_tag('div', array('class' => 'divTableCell acciones'));
    $display .= html_writer::start_tag('a',array('class' => 'btn btn-success', 'data-toggle'=>'modal','href' => '#edit_area'.$valoresa->id.''));
    $display .= html_writer::start_tag('em', array('class' => 'fa fa-pencil'));
    $display .= html_writer::end_tag('em');
    $display .= html_writer::end_tag('a');
    $display .= html_writer::start_tag('a',array('class' => 'btn btn-danger', 'data-toggle'=>'modal', 'href' => '#deletea'.$valoresa->id.''));
    $display .= html_writer::start_tag('em', array('class' => 'fa fa-trash'));
    $display .= html_writer::end_tag('em');
    $display .= html_writer::end_tag('a');
    include('modaleditarea.php');
    $display .= html_writer::end_tag('div');
    }
    $display .= html_writer::end_tag('div');
    }
    $display .= html_writer::end_tag('div');
    $display .= html_writer::end_tag('div');


    if($return) {
        return $display;
        } else {
        echo $display;
        }
}

function mod_induction_view_newfile($viewnewfile, $return = 0){
    global $OUTPUT, $USER, $DB, $CFG;
    $display .= html_writer::start_tag('div', array('class' => 'divTable inductiontable','style'=> 'width: 66%;'));
    $display .= html_writer::start_tag('div', array('class' => 'divTableHeading'));
    $display .= html_writer::start_tag('div', array('class' => 'divTableRow'));
    $display .= html_writer::start_tag('div', array('class' => 'divTableHead','style'=> 'width: 50%;'));
    $display .= clean_text('<strong>Nombre del archivo</strong>');
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableHead','style'=> 'width: 35%;'));
    $display .= clean_text('<strong>Ubicacion del archivo</strong>');
    $display .= html_writer::end_tag('div');
    if(user_has_role_assignment($USER->id, 4)){ 
    $display .= html_writer::start_tag('div', array('class' => 'divTableHead acciones','style'=> 'width: 15%;'));
    $display .= clean_text('<strong>Acciones</strong>');
    $display .= html_writer::end_tag('div');
    }
    $display .= html_writer::end_tag('div');
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableBody'));
    foreach ($viewnewfile as $valoresfi) {
    $display .= html_writer::start_tag('div', array('class' => 'divTableRow'));
    $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
    $display .= clean_text($valoresfi->filename);
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
    $display .= clean_text($valoresfi->ubicacion);
    $display .= html_writer::end_tag('div');
    if(user_has_role_assignment($USER->id, 4)){ 
    $display .= html_writer::start_tag('div', array('class' => 'divTableCell acciones'));
    $display .= html_writer::start_tag('a',array('class' => 'btn btn-success', 'data-toggle'=>'modal','href' => '#edit_files'.$valoresfi->id.''));
    $display .= html_writer::start_tag('em', array('class' => 'fa fa-pencil'));
    $display .= html_writer::end_tag('em');
    $display .= html_writer::end_tag('a');
    $display .= html_writer::start_tag('a',array('class' => 'btn btn-danger', 'data-toggle'=>'modal', 'href' => '#deletefi'.$valoresfi->id.''));
    $display .= html_writer::start_tag('em', array('class' => 'fa fa-trash'));
    $display .= html_writer::end_tag('em');
    $display .= html_writer::end_tag('a');
    include('modaleditfiles.php');
    $display .= html_writer::end_tag('div');
    }
    $display .= html_writer::end_tag('div');
    }
    $display .= html_writer::end_tag('div');
    $display .= html_writer::end_tag('div');


    if($return) {
        return $display;
        } else {
        echo $display;
        }
}

function mod_induction_view_newobjetivo($viewnewobjetivo, $return = 0){
    global $OUTPUT, $USER, $DB, $CFG;
    $display .= html_writer::start_tag('div', array('class' => 'divTable inductiontable'));
    $display .= html_writer::start_tag('div', array('class' => 'divTableHeading'));
    $display .= html_writer::start_tag('div', array('class' => 'divTableRow'));
    $display .= html_writer::start_tag('div', array('class' => 'divTableHead','style'=> 'width: 33%;'));
    $display .= clean_text('<strong>Objetivos para evaluación de desempeño</strong>');
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableHead','style'=> 'width: 19%;'));
    $display .= clean_text('<strong>Valor esperado sobre 100</strong>');
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableHead','style'=> 'width: 19%;'));
    $display .= clean_text('<strong>Avance</strong>');
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableHead','style'=> 'width: 19%;'));
    $display .= clean_text('<strong>Final</strong>');
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableHead acciones','style'=> 'width: 10%;'));
    $display .= clean_text('<strong>Acciones</strong>');
    $display .= html_writer::end_tag('div');
    $display .= html_writer::end_tag('div');
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableBody'));
    foreach ($viewnewobjetivo as $valoresobj) {
    $display .= html_writer::start_tag('div', array('class' => 'divTableRow'));
    $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
    $display .= clean_text($valoresobj->nameobjetivo);
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
    $display .= clean_text($valoresobj->valorobjetivo);
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
    $display .= clean_text($valoresobj->avanceobjetivo);
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableCell'));
    $display .= clean_text($valoresobj->finalobjetivo);
    $display .= html_writer::end_tag('div');
    $display .= html_writer::start_tag('div', array('class' => 'divTableCell acciones'));
    $display .= html_writer::start_tag('a',array('class' => 'btn btn-success', 'data-toggle'=>'modal','href' => '#edit_objetivo'.$valoresobj->id.''));
    $display .= html_writer::start_tag('em', array('class' => 'fa fa-pencil'));
    $display .= html_writer::end_tag('em');
    $display .= html_writer::end_tag('a');
    $display .= html_writer::start_tag('a',array('class' => 'btn btn-danger', 'data-toggle'=>'modal', 'href' => '#deleteobj'.$valoresobj->id.''));
    $display .= html_writer::start_tag('em', array('class' => 'fa fa-trash'));
    $display .= html_writer::end_tag('em');
    $display .= html_writer::end_tag('a');
    include('modaleditobjetivos.php');
    $display .= html_writer::end_tag('div');
    $display .= html_writer::end_tag('div');
    }
    $display .= html_writer::end_tag('div');
    $display .= html_writer::end_tag('div');


    if($return) {
        return $display;
        } else {
        echo $display;
        }
}



