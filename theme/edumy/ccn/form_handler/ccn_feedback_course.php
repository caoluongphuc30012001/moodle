<?php
/*
@ccnRef: @
*/

require_once('../../../../config.php');

defined('MOODLE_INTERNAL') || die();

global $CFG, $DB;

$course     = required_param('course', PARAM_INT);
$message     = required_param('message', PARAM_TEXT);

if (!$course = $DB->get_record("course", array("id" => $course))) {
    print_error("Course ID not found");
}

require_login($course, false);
if (!$context = get_context_instance(CONTEXT_COURSE, $course->id)) {
    print_error('nocontext');
}

require_capability('block/cocoon_course_rating:rate', $context);
global $USER, $COURSE;

if ($form = data_submitted()) {
    // $sql = "
    //     INSERT INTO {theme_edumy_coursefeedback}(course,user,message) VALUES()
    // ";
    $DB->insert_record('theme_edumy_coursefeedback', array('course' => $COURSE->id, 'user' => $USER->id, 'message' => $message));


    // $sql = "INSERT INTO {theme_edumy_coursefeedback}(course,user,message) VALUES(?,?,?)";
    // $DB->excute($sql,array($COURSE->id,$USER->id,$message));
    redirect($CFG->wwwroot . '/course/view.php?id=' . $COURSE->id, "Tạo mới thành công", null, \core\output\notification::NOTIFY_SUCCESS);
}
