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
 * Plugin settings for the local_[pluginname] plugin.
 *
 * @package   local_[pluginname]
 * @copyright Year, You Name <your@email.address>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/local/vatsim/lib.php');


if ($hassiteconfig) {

    // Create the new settings page
    // - in a local plugin this is not defined as standard, so normal $settings->methods will throw an error as
    // $settings will be null
    $settings = new admin_settingpage('local_vatsim', 'VATSIM API Helper');

    // Create
    $ADMIN->add('localplugins', $settings);

    // Add a setting field to the settings for this page
    $settings->add(new admin_setting_configtext(
    // This is the reference you will use to your configuration
        'local_vatsim/apiurl',

        // This is the friendly title for the config, which will be displayed
        'API URL for P0 Upgrades',

        // This is helper text for this config field
        'This is to set the URL for the http request for P0 Upgrades',

        // This is the default value
        "",

        // This is the type of Parameter this config is
        PARAM_TEXT
    ));

    $settings->add(new admin_setting_configtext(
    // This is the reference you will use to your configuration
        'local_vatsim/courseid',

        // This is the friendly title for the config, which will be displayed
        'Course ID for P0 Upgrades',

        // This is helper text for this config field
        'This is to set the Course ID for the http request for P0 Upgrades',

        // This is the default value
        "",

        // This is the type of Parameter this config is
        PARAM_TEXT
    ));
}