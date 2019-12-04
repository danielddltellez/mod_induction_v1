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
require_once(__DIR__.'/lib.php');

global $DB, $OUTPUT, $PAGE, $USER;

$courseid = required_param('courseid', PARAM_INT);
$idinstance = required_param('idinstance', PARAM_INT); 
// Next look for optional variables.
$id = optional_param('id', 0, PARAM_INT);
 
if (!$course = $DB->get_record('course', array('id' => $courseid))) {
    print_error('invalidcourse', 'induction', $courseid);
}
 
require_login($course);

$PAGE->set_url('/mod/induction/viewact.php', array('id' => $id));
$PAGE->set_pagelayout('standard');


echo $OUTPUT->header();


/* tabla cursos activos*/
echo ('<div style="padding: 1px;"></div>');
$sql="select * from mdl_induction_issues where courseid='".$courseid."' and idinstance='".$idinstance."' and id='".$id."'";
$viewactivity = $DB->get_records_sql($sql, array());  

mod_induction_view_activity($viewactivity);

echo ('<div style="padding: 25px;"></div>');

/* tabla nueva actividad*/
/*
$button = new single_button(new moodle_url('/mod/induction/activity.php', array('courseid' => $courseid, 'idinstance'=>$idinstance, 'idind'=>$id)),'Nueva inducción al puesto', $buttonadd, 'get');
$button->class = 'singlebutton forumaddnew';
$button->formid = 'newdiscussionform';
echo $OUTPUT->render($button);

echo ('<div style="padding: 1px;"></div>');

$qsql="select id, idind, idinstance, courseid, nameactivity, status, DATE_FORMAT(FROM_UNIXTIME(date),'%Y-%m-%d') as fecha, date as fecha2  from mdl_induction_activity where courseid='".$courseid."' and idinstance='".$idinstance."' and idind='".$id."'";
$viewnewactivity = $DB->get_records_sql($qsql, array()); 

mod_induction_view_newactivity($viewnewactivity);
*/
/* tabla area*/
//echo ('<div style="padding: 25px;"></div>');
$button = new single_button(new moodle_url('/mod/induction/area.php', array('courseid' => $courseid, 'idinstance'=>$idinstance, 'idind'=>$id)),'Agregar nuevo', $buttonadd, 'get');
$button->class = 'singlebutton forumaddnew';
$button->formid = 'newdiscussionform';
if(user_has_role_assignment($USER->id, 4)){ 
echo $OUTPUT->render($button);
}

echo ('<div style="padding: 1px;"></div>');


$asql="select *  from mdl_induction_area where courseid='".$courseid."' and idinstance='".$idinstance."' and idind='".$id."'";
$viewnewarea = $DB->get_records_sql($asql, array()); 
mod_induction_view_newarea($viewnewarea);

echo ('<div style="padding: 15px;"></div>');
/* tabla funciones*/

$esql="select id, idind, idinstance, courseid, namefunction, estatus, DATE_FORMAT(FROM_UNIXTIME(date),'%Y-%m-%d') as fechafunc, date as fechafunc2   from mdl_induction_functions where courseid='".$courseid."' and idinstance='".$idinstance."' and idind='".$id."'";
$viewnewfunction = $DB->get_records_sql($esql, array()); 

$countesql="select count(id) as 'count'  from mdl_induction_functions where courseid='".$courseid."' and idinstance='".$idinstance."' and idind='".$id."'";
$countnewfunction = $DB->get_records_sql($countesql, array()); 
foreach($countnewfunction as $valuecount){

      $valorconfunc = $valuecount->count;
    if($valorconfunc >= 6){


    }else{

        $button = new single_button(new moodle_url('/mod/induction/funct.php', array('courseid' => $courseid, 'idinstance'=>$idinstance, 'idind'=>$id)),'Agregar nuevo', $buttonadd, 'get');
        $button->class = 'singlebutton forumaddnew';
        $button->formid = 'newdiscussionform';
        if(user_has_role_assignment($USER->id, 4)){ 
        echo $OUTPUT->render($button);
        }


    }
}
echo ('<p style="text-aling:center;">*Ingresa las funciones y/o actividades correspondientes al perfil del colaborador en orden prioritario.</p>');
echo ('<div style="padding: 1px;"></div>');

mod_induction_view_newfunction($viewnewfunction);

echo ('<div style="padding: 15px;"></div>');
/* Tabla procesos */
$psql="select id, idind, idinstance, courseid, nameprocesses, estatus, DATE_FORMAT(FROM_UNIXTIME(date),'%Y-%m-%d') as fechapro, date as fechapro2   from mdl_induction_processes where courseid='".$courseid."' and idinstance='".$idinstance."' and idind='".$id."'";
$viewnewprocesses = $DB->get_records_sql($psql, array()); 

$button = new single_button(new moodle_url('/mod/induction/processes.php', array('courseid' => $courseid, 'idinstance'=>$idinstance, 'idind'=>$id)),'Agregar nuevo', $buttonadd, 'get');
$button->class = 'singlebutton forumaddnew';
$button->formid = 'newdiscussionform';
if(user_has_role_assignment($USER->id, 4)){ 
echo $OUTPUT->render($button);
}
echo ('<p style="text-aling:center;">*Ingresa los procesos y/o procedimientos correspondientes al perfil del colaborador. Recuerda que un proceso es una serie de pasos a seguir para llegar a un objetivo, por lo cual, cada una de las entradas debe contar con los pasos necesarios para cumplir con el proceso mencionado.</p>');
echo ('<div style="padding: 1px;"></div>');

mod_induction_view_newprocesses($viewnewprocesses);

echo ('<div style="padding: 15px;"></div>');
/*tabla objetivo */
/*
$osql="select * from mdl_induction_objetivo where courseid='".$courseid."' and idinstance='".$idinstance."' and idind='".$id."'";
$viewnewobjetivo = $DB->get_records_sql($osql, array()); 

$button = new single_button(new moodle_url('/mod/induction/objetivos.php', array('courseid' => $courseid, 'idinstance'=>$idinstance, 'idind'=>$id)),'Nuevo objetivo', $buttonadd, 'get');
$button->class = 'singlebutton forumaddnew';
$button->formid = 'newdiscussionform';
echo $OUTPUT->render($button);

echo ('<div style="padding: 1px;"></div>');

mod_induction_view_newobjetivo($viewnewobjetivo);

echo ('<div style="padding: 25px;"></div>');
*/
/*Tabla objetivos */
$fsql="select id, idind, idinstance, courseid, filename, ubicacion  from mdl_induction_files where courseid='".$courseid."' and idinstance='".$idinstance."' and idind='".$id."'";
$viewnewfile = $DB->get_records_sql($fsql, array()); 

$button = new single_button(new moodle_url('/mod/induction/files.php', array('courseid' => $courseid, 'idinstance'=>$idinstance, 'idind'=>$id)),'Agregar nuevo', $buttonadd, 'get');
$button->class = 'singlebutton forumaddnew';
$button->formid = 'newdiscussionform';
if(user_has_role_assignment($USER->id, 4)){ 
echo $OUTPUT->render($button);
}
echo ('<p style="text-aling:center;">*Ingresa los archivos de uso contante dentro del perfil del colaborador.</p>');
echo ('<div style="padding: 1px;"></div>');

mod_induction_view_newfile($viewnewfile);




if(user_has_role_assignment($USER->id, 4)){ 
echo ('<div style="padding: 15px;"></div>');
echo('<center><input style="background" type="button" id="btn" value="Imprimir Inducción" onclick="printDiv();"></center>');
echo ('<div style="padding: 15px;"></div>');
}else if(user_has_role_assignment($USER->id, 5)){ 
    echo ('<div style="padding: 15px;"></div>');
    echo('<center><button style="background" type="button" ><a class="btn btn-success" data-toggle="modal" href="#validar'.$id.'">Validar formato</a></button></center>');
    echo ('<div style="padding: 15px;"></div>');

    echo   '<div class="modal fade" id="validar'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Validar formato</h4></center>
            </div>
            <div class="modal-body">    
                <p class="text-center">¿Esta seguro de validar el formato?</p>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                <a href="validar_formato.php?id='.$id.'" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>Borrar</a>
            </div>

        </div>
    </div>
    </div>
    ';
}else{
    
}
echo ('<div style="padding: 15px;"></div>');
$button = new single_button(new moodle_url('/mod/induction/view.php', array('id' => '5381')),'REGRESAR', $buttonadd, 'get');
$button->class = 'singlebutton forumaddnew';
$button->formid = 'newdiscussionform';
echo $OUTPUT->render($button);




echo $OUTPUT->footer();

?>
<script>


function printDiv() {
     var contenido= document.getElementById('region-main').innerHTML;
     var contenidoOriginal= document.body.innerHTML;
     
     document.body.innerHTML = contenido;
     window.print();
     document.body.innerHTML = contenidoOriginal;
     location.reload(true);
}

</script>
