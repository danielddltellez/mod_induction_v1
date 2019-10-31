
<?php
require_once '../../config.php';
if ($CFG->forcelogin) {
    require_login();
}

global $USER, $DB, $COURSE;

$id = $_GET['id'];

$record1 = new stdClass();
$record1-> id = $id;
$record1-> namearea  = $_POST['namearea'];

$DB->update_record('induction_area', $record1, $bulk=false);

header("Location:".$_SERVER['HTTP_REFERER']);
?>