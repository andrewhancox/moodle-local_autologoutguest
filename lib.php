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
 * @package local_autologoutguest
 * @author Andrew Hancox <andrewdchancox@googlemail.com>
 * @author Open Source Learning <enquiries@opensourcelearning.co.uk>
 * @link https://opensourcelearning.co.uk
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @copyright 2024, Andrew Hancox
 */

function local_autologoutguest_after_config() {
    global $SESSION;

    $localautologoutguestwantsurl = optional_param('local_autologoutguest_wantsurl', '', PARAM_URL);

    if (!empty($localautologoutguestwantsurl)) {
        $SESSION->wantsurl = $localautologoutguestwantsurl;
    }

    if (
        (!isloggedin() || isguestuser())
        &&
        !isset($SESSION->local_autologoutguest_wantsurl)
    ) {
        $SESSION->local_autologoutguest_wantsurl = qualified_me();
    }
}

function local_autologoutguest_after_require_login() {
    local_autologoutguest_checkandredirect();
}

function local_autologoutguest_before_http_headers() {
    local_autologoutguest_checkandredirect();
}

function local_autologoutguest_checkandredirect() {
    global $COURSE, $SESSION, $SITE, $DB;

    if (
        !isloggedin()
        || empty($COURSE)
        || empty($SITE)
        || $COURSE->id == $SITE->id
        || !isguestuser()
        || $DB->record_exists('enrol', ['enrol' => 'guest', 'status' => 0, 'courseid' => $COURSE->id])
        || empty(get_config('local_autologoutguest', 'enable'))
    ) {
        return;
    }

    $wantsurl = $SESSION->local_autologoutguest_wantsurl ?? $SESSION->wantsurl ?? null;

    require_logout();

    $loginurl = new moodle_url(get_login_url());

    if (!empty($wantsurl)) {
        $loginurl->param('local_autologoutguest_wantsurl', $wantsurl);
    }

    redirect($loginurl);
}
