<?php


defined('MOODLE_INTERNAL') || die();

$capabilities = array(
 
    'mod/induction:addinstance' => array(
        'riskbitmask' => RISK_XSS,
        'captype' => 'write',
        'contextlevel' => CONTEXT_COURSE,
        'archetypes' => array(
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        ),
        'clonepermissionsfrom' => 'moodle/course:manageactivities'
    ),

    'mod/induction:myaddinstance' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => array()
    ),

    'mod/induction:view' => array(
    'captype' => 'read',
    'contextlevel' => CONTEXT_MODULE,
    'archetypes' => array(
        'guest' => CAP_ALLOW,
        'student' => CAP_ALLOW,
        'teacher' => CAP_ALLOW,
        'editingteacher' => CAP_ALLOW,
        'manager' => CAP_ALLOW
        ),

    )
);
     
