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
 * @package    local_booking
 * @author     Mustafa Hajjar (mustafahajjar@gmail.com)
 * @category   event
 * @copyright  BAVirtual.co.uk © 2021
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_vatsim;
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/local/vatsim/lib.php');

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
        $courseid = $event->courseid;
        $studentid = $event->relateduserid;
        $exerciseid = $event->contextinstanceid;


        $configcourseid = get_config('local/vatsim', 'courseid');
        $url = get_config('local/vatsim', 'apiurl');

        var_dump($courseid, $studentid, $exerciseid, $configcourseid, $url);
        die("die");

//        if($courseid == 2) {
            $data = array(
              'content' => "$courseid"
            );

            $json_data = json_encode($data);
            $header = array(
              'Content-Type: application/json',
              'Accept: application/json',
            );
            $options = array(
                'RETURNTRANSFER' => 1,
                'HEADER' => 0,
                'FAILONERROR' => 1,
            );
            $curl = new \curl();
            $curl->setHeader($header);
            $get = $curl->post("https://discord.com/api/webhooks/1313084662155055144/KcVyRWf9bSa_oYZoRFNHEe3nk1db_RUzlARI2xs8thvP6CZBkPcPDVFxQTUp5wSGPJY9", $json_data, $options);
            $result = json_decode($get);
            echo $result;
//        }
    }
}
