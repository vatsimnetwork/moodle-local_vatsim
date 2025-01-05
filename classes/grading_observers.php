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
 * @package   local_vatsim
 * @category  event
 * @copyright VATSIM Inc.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_vatsim;

defined('MOODLE_INTERNAL') || die();

class grading_observers {
    /**
     * A submission has been graded.
     *
     * @param \mod\assign\submission_graded $event The event.
     * @return bool
     */
    public static function submission_graded($event) {
        global $CFG;

        $configquizid = get_config('local_vatsim', 'quizid');
        $quiz = $event->get_record_snapshot('quiz', $event->other['quizid']);

        if ($quiz->id != $configquizid) {
            return true;
        }

        $student = \core_user::get_user($event->relateduserid);

        $attempts = $event->get_record_snapshot('quiz_attempts', $event->objectid);
        $maxgrade = (float) $quiz->sumgrades;
        $grade = $attempts->sumgrades / $maxgrade * 100;

        $curl = new \curl();

        $url = get_config('local_vatsim', 'apiurl');
        $curl->setHeader('X-API-Key: ' . $CFG->vatsim_api_key ?? '');

        $curl->post($url, [
            'cid' => $student->idnumber ?: $student->username,
            'grade' => $grade,
        ]);

        if ($curl->info['http_code'] != 200) {
            return false;
        }

        return true;
    }
}
