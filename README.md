# local_autologoutguest #

There is a usability black hole in Moodle:
1. A site has autologinguest
2. A user visits a course with guest enrolment enabled
3. The user is auto logged in as guest - they have no knowledge of this happening
4. The user now visits a course that does not have guest enrolment enabled
5. The user becomes confused, they do not understand the concept of having logged in as a guest, they have an account they have not logged in with but do not understand the process of logging out and in again
They contact support...

This plugin intervenes at stage 4 - the user is silently logged out of the guest account and redirected to the login screen.


## Installing via uploaded ZIP file ##

1. Log in to your Moodle site as an admin and go to _Site administration >
   Plugins > Install plugins_.
2. Upload the ZIP file with the plugin code. You should only be prompted to add
   extra details if your plugin type is not automatically detected.
3. Check the plugin validation report and finish the installation.
4. Next go to Site Aministration > Plugins > Local plugins > Auto logout guest and check 'Enable'

## Installing manually ##

The plugin can be also installed by putting the contents of this directory to

    {your/moodle/dirroot}/local

Afterwards, log in to your Moodle site as an admin and go to _Site administration >
Notifications_ to complete the installation.

Alternatively, you can run

    $ php admin/cli/upgrade.php

to complete the installation from the command line.

Next go to Site Aministration > Plugins > Local plugins > Auto logout guest and check 'Enable'

## License ##

2024 Andrew Hancox <andrewdchancox@googlemail.com>

This program is free software: you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation, either version 3 of the License, or (at your option) any later
version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with
this program.  If not, see <https://www.gnu.org/licenses/>.
