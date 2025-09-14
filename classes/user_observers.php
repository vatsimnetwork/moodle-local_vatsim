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
 * User observers.
 *
 * @package   local_vatsim
 * @category  event
 * @copyright VATSIM Inc.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_vatsim;

defined('MOODLE_INTERNAL') || die();

class user_observers {
    /**
     * A user has been created.
     *
     * @param \core\event\user_created $event The event.
     * @return bool
     */
    public static function user_created($event) {
        return self::upsert_user_idnumber($event->objectid);
    }

    /**
     * A user has been updated.
     *
     * @param \core\event\user_updated $event The event.
     * @return bool
     */
    public static function user_updated($event) {
        return self::upsert_user_idnumber($event->objectid);
    }

    private static function upsert_user_idnumber($userid) {
        $user = \core_user::get_user($userid);

        if (filter_var($user->username, FILTER_VALIDATE_INT) === false) {
            return true;
        }

        if ($user->username == $user->idnumber) {
            return true;
        }

        $user->idnumber = $user->username;

        \user_update_user($user, false, false);

        return true;
    }
}
