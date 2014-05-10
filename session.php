<?php
/*  Copyright (C) <2014>  <Fohlen> <fohlen@einhufer.info>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>
 */

// Store temporary sessions 
$sessions = array();
 
// What to do on request?
function on_request($json = null) {
	if(!is_null($json)) {
		//Update specific parts
		$id = $json['id'];
		$sessions[$id]['lastseen'] = time(); 
		
		return $sessions[$id];
	} else {
		$session = array();
		
		$session['id'] = sha1(uniqid()); //Create a new unique session id
		$session['lastseen'] = time(); //Create a last seen unix timestampt
		$sessions[$session['id']] = $session; //Store session
		
		return $session;
	}
}

//Read json from post data
$json = json_decode($_POST['json']);

if (!empty($json))  {
	json_encode(on_request($json));
} else {
	json_decode(on_request());
}
?>
