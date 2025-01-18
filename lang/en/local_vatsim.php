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
 * Languages configuration for the local_vatsim plugin.
 *
 * @package   local_vatsim
 * @copyright VATSIM Inc.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['pluginname'] = 'VATSIM Moodle Integrations';

$string['apiurl'] = 'P0 webhook URL';
$string['apiurl_desc'] = 'This sets the URL to send P0 grading events to.';

$string['apikey'] = 'P0 webhook secret';
$string['apikey_desc'] = 'This sets the secret key to use when sending data to the webhook.';

$string['quizid'] = 'P0 quiz ID';
$string['quizid_desc'] = 'This specifies which quiz to observe for grading events.';
