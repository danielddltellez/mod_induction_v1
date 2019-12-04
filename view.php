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

// Course_module ID, or
$id = optional_param('id', 0, PARAM_INT);

// ... module instance id.
$i  = optional_param('i', 0, PARAM_INT);
$viewpage = optional_param('viewpage', false, PARAM_BOOL);

$page = optional_param('page', 0, PARAM_INT);
$perpage = optional_param('perpage', 5, PARAM_INT);
$start = $page * $perpage;


//Define 

if ($id) {
    $cm             = get_coursemodule_from_id('induction', $id, 0, false, MUST_EXIST);
    $course         = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
    $moduleinduction = $DB->get_record('induction', array('id' => $cm->instance), '*', MUST_EXIST);
} else if ($i) {
    $moduleinduction = $DB->get_record('induction', array('id' => $n), '*', MUST_EXIST);
    $course         = $DB->get_record('course', array('id' => $moduleinduction->course), '*', MUST_EXIST);
    $cm             = get_coursemodule_from_instance('induction', $moduleinduction->id, $course->id, false, MUST_EXIST);
} else {
    print_error(get_string('missingidandcmid', mod_induction));
}

require_login($course, true, $cm);

$modulecontext = context_module::instance($cm->id);
$baseurl = $CFG->wwwroot . '/mod/induction/view.php?&id='.$cm->id;
$PAGE->set_url('/mod/induction/view.php', array('id' => $cm->id));
$PAGE->set_title(format_string($moduleinduction->name));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_context($modulecontext);



echo $OUTPUT->header();
/*echo ($id);
echo ($cm->course);
echo ($cm->instance);
echo $USER->id;*/


if (user_has_role_assignment($USER->id, 1) || is_siteadmin()){
$button = new single_button(new moodle_url('/mod/induction/post.php', array('courseid' => $cm->course, 'idinstance'=>$cm->instance, 'idmod'=>$id)),'Nueva inducción', $buttonadd, 'get');
$button->class = 'buttoninduction';
$button->formid = 'newinduction';
echo $OUTPUT->render($button);
}

if(user_has_role_assignment($USER->id, 1) || is_siteadmin()){
    $sql="select * from mdl_induction_issues where courseid='".$cm->course."' and idinstance='".$cm->instance."'";  
}elseif(user_has_role_assignment($USER->id, 4)){ 

    $sql="select * from mdl_induction_issues where courseid='".$cm->course."' and idinstance='".$cm->instance."' and idjefedirecto='".$USER->id."'";  

}elseif(user_has_role_assignment($USER->id, 5)){

    $sql="select * from mdl_induction_issues where courseid='".$cm->course."' and idinstance='".$cm->instance."' and idtrabajador='".$USER->id."'";  
}else{

    echo 'No cuentas con informacion';
}
$viewinduction = $DB->get_records_sql($sql, array());
$totalcount = count($viewinduction);
if ($start > count($viewinduction)) {
    $page = 0;
    $start = 0;
   }
   $viewinduction = array_slice($viewinduction, $start, $perpage, true);
    $pagingbar = new paging_bar($totalcount, $page, $perpage, $baseurl);
    echo $OUTPUT->render($pagingbar);
    print '<br>';


//print_r ($viewinduction);

mod_induction_print_activity($viewinduction);

    $pagingbar = new paging_bar($totalcount, $page, $perpage, $baseurl);
    echo $OUTPUT->render($pagingbar);
        
echo $OUTPUT->footer();
