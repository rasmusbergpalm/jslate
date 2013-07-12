[![Build Status](https://travis-ci.org/rasmusbergpalm/jslate.png?branch=master)](https://travis-ci.org/rasmusbergpalm/jslate)

# jSlate

jSlate enables you to setup dashboards for displaying data easily.  
A dashboard consists of widgets. Widgets are html/javascript and can do anything.  
A number of templates for widgets are provided to get you started.  
jSlate provides a php proxy so the widgets can request data from off-site locations.

# Installation

 - Install LAMP (ensure mod_rewrite is enabled)
 - Download jslate to your web directory (e.g. /jslate)
 - Edit app/config/database.php to match your settings
 - Ensure app/tmp folder is writeable by user and webserver
 - Run: ```app/Console/cake migrate```
 - Open up localhost/jslate/users/add
 - Add a user
 - Go to localhost/jslate and login

# Note if upgrading
 If you already have jSlate installed and have run migrate_new_edit.sql, then you should do the following:

 - Move all SQL files in app/Config/Schema/migrations to another folder
 - Run: ```app/Console/cake migrate```
 - Manually add '20130629132807-initial' and '20130629132829-html-widgets' to the __migrations table
 - Move the SQL files back
 - You can now safely run ```cake migrate``` in the future.

# Licensing

Copyright (C) 2013 Rasmus Berg Palm

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
