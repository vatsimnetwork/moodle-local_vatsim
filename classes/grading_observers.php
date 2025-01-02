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
 * Grading observers.
 *
 * @package    local_vatsim
 * @author     Eric Steiner (e.steiner@vatsim.net)
 * @category   event
 * @copyright  VATSIM Inc © 2024
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_vatsim;

defined('MOODLE_INTERNAL') || die();


/**
 * Group observers class to listen to graded assignments
 * for clearing previously posted student availability.
 *
 * @package    local_booking
 * @author     Mustafa Hajjar (mustafahajjar@gmail.com)
 * @category   event handler
 * @copyright  BAVirtual.co.uk © 2021
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */



class grading_observers {
    /**
     * A submission has been graded.
     *
     * @param \mode\assign\submission_graded $event The event.
     * @return void
     */
    public static function submission_graded($event) {
        global $CFG;
        $configquizid = get_config('local_vatsim', 'quizid');
        $quiz = $event->get_record_snapshot('quiz', $event->other['quizid']);
        if($quiz->{'id'} == $configquizid) {

            $url = get_config('local_vatsim', 'apiurl');
            $studentid = $event->relateduserid;
            $student = \core_user::get_user($studentid);
            $attempts = $event->get_record_snapshot('quiz_attempts', $event->objectid);

            $maxGrade = (float) $quiz->{'sumgrades'};
            $grade = $attempts->{'sumgrades'} / $maxGrade  * 100;

            if(strlen($student->{'idnumber'}) != 0){
                $data = array(
                  'cid' => $student->{'idnumber'},
                  'grade' => "$grade"

                );
            } else {
                $data = array(
                    'cid' => $student->{'idnumber'},
                    'grade' => "$grade"
                );
            }
            $json_data = json_encode($data);
            $header = array(
              'Content-Type: application/json',
              'Accept: application/json',
               'X-API-KEY: ' . $CFG->vatsim_api_key ?? null
            );
            $options = array(
                'RETURNTRANSFER' => 1,
                'HEADER' => 0,
                'FAILONERROR' => 1,
            );
            $curl = new \curl();
            $curl->setHeader($header);
            $get = $curl->post($url, $json_data, $options);
            $result = json_decode($get);
            echo $result;
        }
    }
}
