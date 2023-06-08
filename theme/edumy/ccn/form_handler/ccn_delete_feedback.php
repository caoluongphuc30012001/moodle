<?php
/*
@ccnRef: @
*/

require_once('../../../../config.php');

defined('MOODLE_INTERNAL') || die();

global $CFG, $DB;

$course     = required_param('course', PARAM_INT);
$userid     = required_param('userid', PARAM_INT);
$id         = required_param('id', PARAM_INT);

if (!$course = $DB->get_record("course", array("id" => $course))) {
    print_error("Course ID not found");
}

require_login($course, false);
if (!$context = get_context_instance(CONTEXT_COURSE, $course->id)) {
    print_error('nocontext');
}

require_capability('block/cocoon_course_rating:rate', $context);
global $USER, $COURSE;

if ($form = data_submitted()) {global $USER,$DB;
    if($userid==$USER->id){
      $DB->delete_records('theme_edumy_coursefeedback',['id'=>$id]);
    }
    redirect($CFG->wwwroot . '/course/view.php?id=' . $COURSE->id, "Xóa thành công", null, \core\output\notification::NOTIFY_SUCCESS);
}
