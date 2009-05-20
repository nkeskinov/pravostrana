/**
 * UploadProgressMeter.js - Upload progress Meter javascript code
 *
 * Copyright (C) 2005  Joshua Eichorn  This program is free software; you can
 * redistribute it and/or modify it under the terms of the GNU General Public
 * License as published by the Free Software Foundation; either version 2 of
 * the License, or (at your option) any later version.  This program is
 * distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE.  See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 *
 *
 * @author       Joshua Eichorn <josh@bluga.net>
 * @copyright    Joshua Eichorn (c)2005
 * @link         http://bluga.net/projects/upload_progress_meter
 * @version      0.1
 */

/**
 * Global list of ids that were updating progress for
 */
var UploadProgressMeter_list = new Object();

/**
 * List of Currently Active ids
 */
var UploadProgressMeter_active = new Object();

/**
 * Currently Active count
 */
var UploadProgressMeter_count = 0;

/**
 * Update interval for progress bars
 */
var UploadProgressMeter_interval = 2000;

/**
 * ID of the current interval
 */
var UploadProgressMeter_intervalId = false;

/**
 * Remote proxy object
 */
var UploadProgressMeter_remote = false;

/**
 * Handling starting up all progress bars when a form submits
 */
function UploadProgressMeter_Start(form) {
	// get an array of all the ids that need to be started, were only looking in the current form
	
	var idsToStart = new Array();

	var divs = form.getElementsByTagName('div');

	for(var i = 0; i < divs.length; i++) {
		var id = divs[i].id;
		if (UploadProgressMeter_list[id]) {
			UploadProgressMeter_count++;
			UploadProgressMeter_active[id] = UploadProgressMeter_list[id];
			UploadProgressMeter_EnableProgress(id);
		}
	}

	if (!UploadProgressMeter_intervalId) {
		UploadProgressMeter_intervalId = setInterval(UploadProgressMeter_Update,UploadProgressMeter_interval);
	}
}

/**
 * Register a file input by id
 */
function UploadProgressMeter_Register(progressId,identifier) {
	UploadProgressMeter_list[progressId] = identifier;
}

/**
 * Shows a progress bar and sets it to 0
 */
function UploadProgressMeter_EnableProgress(progress_id) {
	var progress = document.getElementById(progress_id);
	progress.style.display = 'block';
	progress.percent = 0;
	progress.message = "Connecting";

	progress.update = function() { this.getFirstDivByClass('bar').style.width = this.percent+'%'; this.getFirstDivByClass('message').innerHTML = this. message; }

	progress.getFirstDivByClass = function(className) {
		var nodes = this.getElementsByTagName('div');
		for(var i = 0; i < nodes.length; i++) {
			if (nodes[i].className == className) {
				return nodes[i];
			}
		}
	}

	progress.update();
}

/**
 * Update the progress bars of all the current bars
 */
function UploadProgressMeter_Update() {
	if (UploadProgressMeter_count == 0) {
		clearInterval(UploadProgressMeter_intervalId);
		UploadProgressMeter_intervalId = false;
		return;
	}

	if (UploadProgressMeter_remote == false) {
		var callback = {
			get_status: function(result) {
				for(var prop in result) {
					if (prop != "toString") {
						document.getElementById(prop).percent = result[prop].percent;
						document.getElementById(prop).message = result[prop].message;
						document.getElementById(prop).update();

						if (document.getElementById(prop).percent == 100) {
							UploadProgressMeter_count--;
							delete UploadProgressMeter_active[prop];
						}
					}
				}
			}
		}
		UploadProgressMeter_remote = new uploadprogressmeterstatus(callback);
	}

	UploadProgressMeter_remote.get_status(UploadProgressMeter_active);
}
