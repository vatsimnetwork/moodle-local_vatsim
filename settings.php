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
 * Plugin admin settings.
 *
 * @package   local_vatsim
 * @copyright VATSIM Inc.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_vatsim', 'VATSIM');

    if ($ADMIN->fulltree) {
        $settings->add(new admin_setting_configtext(
            'local_vatsim/apiurl',
            new lang_string('apiurl', 'local_vatsim'),
            new lang_string('apiurl_desc', 'local_vatsim'),
            '',
            PARAM_TEXT
        ));

        $settings->add(new admin_setting_configtext(
            'local_vatsim/quizid',
            new lang_string('quizid', 'local_vatsim'),
            new lang_string('quizid_desc', 'local_vatsim'),
            '',
            PARAM_INT
        ));
    }

    $ADMIN->add('localplugins', $settings);
}
