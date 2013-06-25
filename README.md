# jSlate

jSlate enables you to setup dashboards for displaying data easily.  
A dashboard consists of widgets. Widgets are just javascript and can do anything.  
A number of templates for widgets are provided to get you started.  
jSlate provides a php proxy so the widgets can request data from off-site locations.

# Installation

install LAMP

enable mod_rewrite

run app/config/schema/jSlate.sql

checkout to /var/www/jslate/

edit app/config/database.php to match your settings

open up localhost/jslate/users/add

Add a user

Go to localhost/jslate and login

# Known issues

The templates using proxy.php expect jslate to run on the root, i.e. localhost/

If you are running in a subfolder you'll need to adjust the reference to /proxy.php to jslate/proxy.php

# Licensing

jSlate is free software: you can redistribute it and/or modify  
it under the terms of the GNU General Public License as published by  
the Free Software Foundation, either version 3 of the License, or  
(at your option) any later version.  

jSlate is distributed in the hope that it will be useful,  
but WITHOUT ANY WARRANTY; without even the implied warranty of  
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the  
GNU General Public License for more details.  

You should have received a copy of the GNU General Public License  
along with jSlate.  If not, see <http://www.gnu.org/licenses/>.