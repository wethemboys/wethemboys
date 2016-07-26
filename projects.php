<?php
session_name("evypms");
session_start();
if (!isset($_SESSION["theuser"])) {
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>E.V.Y Project Management System</title>
<link href="bootstrap-3.3.6-dist/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<script src="js/jquery.min.js"></script>
</head>
<style>
.coloredtr:nth-child(even) {background-color: #d9edf7}
.coloredtr:nth-child(odd) {background-color: #f4f7f9}
.project_table > tbody > tr > td {
   padding:3px;
}

.project_table th {
   padding:3px;
   font-size:14px;
}

.project_table > tbody > tr:hover {
	background-color:#efefef;
}

.project_table > tbody > tr {
	cursor:pointer;
	border-bottom-style:solid;
	border-width:1px;
	border-color:#c6c6c6;
}

.project_table > thead > th {
	width:20%;
}

.project_table > tbody > tr > td {
	width:20%;
}

.menu_bar {
	position:relative;
    list-style-type: none;
    margin: 0;
    padding: 0;
    background-color: #378B2E;
}

.menu_bar li {
	position:relative;
    float: left;
}

.menu_bar li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

/* Change the link color to #111 (black) on hover */
.menu_bar li a:hover {
    background-color: #5FAE57;
}

.menu_bar .selected {
	background-color: #5FAE57;
}
body, html {
	background-color:#efefef;
	height:100%;
}
footer {
	color:white;
	border-top-style:solid;
	border-width:5px;
	border-color:#5FAE57;
	height:100px;
	margin-top:20px;
	width:100%;
	background-color:#378B2E;
	margin-bottom:0px;
	padding:10px;
}
.menu_options td {
	text-align:center;
	font-size:12px;
	padding:3px;
}
.menu_options td:hover {
	background-color:#efefef;
	cursor:pointer;
}
.menu_options a {
	text-decoration:none;
	color:#111;
}
.btn {
	border-radius:0px !important;
}

.menu_bar li:hover .sub_menu{
	display:block;
}

.menu_bar .sub_menu {
	position:absolute;
	top:50;
	left:0;
	z-index:9999;
	color:white;
	display:none;
	padding:2px;
	background-color: #378B2E;
	list-style-type:none;
	width:200px;
	font-size:12px;
}

.menu_bar .sub_menu > li {
	width:100%;
}

.menu_bar .sub_menu > li > a{
	text-align:left;
}
</style>
<body>
<nav style="position:relative;height:50px;background-color: #378B2E;">
<?php require 'menu.php'?>
<div id="mmE" style="z-index:99999;display:none;position:absolute;right:10px;top:50px;border-style:solid;border-width:1px;border-color:#c6c6c6;box-shadow:0px 0px 3px #c6c6c6;padding:5px;min-height:100px;position:absolute;width:200px;background-color:white;">
	<div style="display:table;width:100%;">
	<div style="display:table-cell;"><img src="https://tracker.moodle.org/secure/attachment/30912/f3.png" style="width:50px;height:50px;border-style:solid;border-color:#c6c6c6;border-width:1px;" /></div>
	<div style="display:table-cell;vertical-align:top;"><span id="uname_display" style="font-weight:bold;display:block;">Marvin Gaye</span><span id="usr_type" style="display:block;font-size:12px;font-weight:bold;color:gray;">Administrator</span></div>
	</div>

	<table style="width:100%;margin-top:10px;" class="menu_options">
	<tr><td><a style="cursor:pointer;">Settings</a></td></tr>
	<tr><td><a id="logout_btn" style="cursor:pointer;">Sign Out</a></td></tr>
	</table>
	</div>
</nav>

<div style="padding-left:50px;padding-right:50px;margin-top:20px;height:80%;">
		<div style="position:relative;height:100px;margin-top:10px;width:100%;padding:5px;background-color:#ffffff;border-style:solid;border-width:1px;border-color:#c6c6c6;">
		<h4 style="text-align:center;font-weight:normal;margin-top:5px;"><span class="glyphicon glyphicon-import"></span> View Projects<span id="projectof" style="display:none;font-size:12px;color:gray;">(Projects of: Gian Pogi)</span></h4>
		<hr style="margin-top:5px;margin-bottom:5px;"/>
		<div style="position:absolute;left:5px;"><a id="addprojectbtn" href="addproject.php" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add Project</a></div>
		<div style="position:absolute;right:5px;"><input type="text" id="projsearch" style="width:150px;height:32px;margin-right:5px;outline-width:0px;" placeholder="Search Projects..." /><button class="btn btn-warning btn-sm">Search</button></div>
		</div>

		<div style="height:calc(100% - 100px);background-color:#ffffff;margin-top:10px;border-style:solid;border-color:#c6c6c6;border-width:1px;">
		<table class="project_table" style="width:100%;background-color:#efefef;">
			<tr>
				<td>Project Name</td>
				<td>Start Date</td>
				<td>End Date</td>
				<td>Status</td>
				<td>Progress</td>
			</tr>
		</table>
		<div style="overflow-y:auto;width:100%;height:calc(100% - 30px);">
		<table class="project_table" style="width:100%;background-color:#ffffff;">
			<tbody id="prj_cont">
			</tbody>
		</table>
		</div>
		</div>
</div>

<footer>
<p style="text-align:center;">&copy; 2016 E.V.Y. Corporation</p>
</footer>

</body>
<script>
$("#mn_optbtn").on("click", function (evt) {
	theBtn = $(evt.target);
	theMenu = $("#mmE");
	if (theMenu.css("display") == "none") {
		theBtn.css("background-color", "#5FAE57");
		theMenu.css("display", "block");
	} else {
		theMenu.css("display", "none");
		theBtn.css("background-color", "");
	}
});

function getCompleteType(type) {
	switch (type) {
		case "admin":
			return "Administrator";
		break;

		case "engineer":
			return "Project Engineer";
		break;

		case "architect":
			return "Project Architect";
		break;

		case "client":
			return "Client";
		break;
	}
}

var QueryString = function () {
      var query_string = {};
      var query = window.location.search.substring(1);
      var vars = query.split("&");
      for (var i=0;i<vars.length;i++) {
        var pair = vars[i].split("=");
            // If first entry with this name
        if (typeof query_string[pair[0]] === "undefined") {
          query_string[pair[0]] = decodeURIComponent(pair[1]);
            // If second entry with this name
        } else if (typeof query_string[pair[0]] === "string") {
          var arr = [ query_string[pair[0]],decodeURIComponent(pair[1]) ];
          query_string[pair[0]] = arr;
            // If third or later entry with this name
        } else {
          query_string[pair[0]].push(decodeURIComponent(pair[1]));
        }
      } 
        return query_string;
    }();

 pMode = QueryString.m;
 switch (pMode) {
 	case "inprogress":
 	break;

 	case "completed":
 	break;

 	default:
 		pMode = "inprogress";
 	break;
 }

xhr = new XMLHttpRequest();
xhr.open("POST", "backend.php");
xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
xhrd = {
	"do":"getuserinfo"
}
xhr.send(JSON.stringify(xhrd));
xhr.onload = function() {
	user = JSON.parse(xhr.responseText);
	$("#usr_menu_disp").html(user["Name"]);
	$("#uname_display").html(user["Name"]);
	$("#usr_type").html(getCompleteType(user["Type"]));
	if (user["Type"] == "client") {
		$("#addprojectbtn").css("display", "none");
		$("#projectof").html("(Projects of: " + user["Name"] + ")").css("display", "block");
		$("#clientsbtn").css("display", "none");
		$("#resourcesbtn").css("display", "none");
	} else {
		$("#projectof").html("(All Projects)").css("display", "block");
	}
	loadtheprojects();
}

$("#logout_btn").on("click", function() {
	xhr = new XMLHttpRequest();
	xhr.open("POST", "backend.php");
	xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
	xhrd = {
		"do":"logoutuser"
	}
	xhr.send(JSON.stringify(xhrd));
	xhr.onload = function() {
		location.href = "login.php";	
	}
});

function FormalDateTime(datetime) {
    months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    datetime = datetime.split(" ");
    date = datetime[0];
    time = datetime[1];
    datesplit = date.split("-");
    datestring = months[parseInt(datesplit[1]) - 1] + " " + datesplit[2] + ", " + datesplit[0];
    timesplit = time.split(":");
    if (parseInt(timesplit[0]) > 12) {
        lvl = "PM";
        hh = parseInt(timesplit[0]) - 12;
    } else {
        lvl = "AM";
        hh = timesplit[0];
        if (hh == 0) {
            hh = "12";
        }
    }
    timestring = hh + ":" + timesplit[1] + " " + lvl;
    return Array(datestring, timestring);
}

function gotoproj(prjid) {
	location.href = "viewproject.php?pid="+prjid;
}

$("#projsearch").on("keyup", function() {
	sq = {
		"do":"list_projects",
    	"mode":pMode,
    	"search":$("#projsearch").val()
	}
	xhr = new XMLHttpRequest();
    xhr.open("POST", "backend.php");
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhr.send(JSON.stringify(sq));
    xhr.onload = function () {
    	prj_tbl = $("#prj_cont");
    	prj_tbl.html("");
    	projects = JSON.parse(xhr.responseText);
    	for (i = 0; i < projects.length; i++) {
    		prj_tplate = "<tr onclick=\"gotoproj('%prjid%')\"><td>%prjname%</td><td>%startdate%</td><td>%enddate%</td><td>%status%</td><td><div><div style='margin:0;' class='progress'><div class='progress-bar progress-bar-success' style='width:%width%;color:black;'>%complete_text% Complete</div></div></td></tr>";
    		prj_tplate = prj_tplate.replace("%prjid%", projects[i]["ProjectID"]);
    		prj_tplate = prj_tplate.replace("%prjname%", projects[i]["Name"]);
    		prj_tplate = prj_tplate.replace("%startdate%", FormalDateTime(projects[i]["StartDate"])[0]);
    		prj_tplate = prj_tplate.replace("%enddate%", FormalDateTime(projects[i]["EndDate"])[0]);
    		if (projects[i]["Status"] == "0" || projects[i]["Status"] == 0) {
    			prj_tplate = prj_tplate.replace("%status%", "In Progress");
    		} else {
    			prj_tplate = prj_tplate.replace("%status%", "Completed");
    		}
    		if (projects[i]["Progress"] == "") {
    			prj_tplate = prj_tplate.replace("%complete_text%", "0%");
    			prj_tplate = prj_tplate.replace("%width%", "0%");
    		} else {
    			prj_tplate = prj_tplate.replace("%complete_text%", Math.round(projects[i]["Progress"])+"%");
    			prj_tplate = prj_tplate.replace("%width%", Math.round(projects[i]["Progress"])+"%");
    		}
    		prj_tbl.append(prj_tplate);
    	}
    }
});

function loadtheprojects() {
	// load all the projects
	xhr = new XMLHttpRequest();
    xhr.open("POST", "backend.php");
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhr_do = {
    	"do":"list_projects",
    	"mode":pMode
    };
    xhr.send(JSON.stringify(xhr_do));
    xhr.onload = function () {
    	prj_tbl = $("#prj_cont");
    	prj_tbl.html("");
    	projects = JSON.parse(xhr.responseText);
    	for (i = 0; i < projects.length; i++) {
    		prj_tplate = "<tr class='coloredtr' onclick=\"gotoproj('%prjid%')\"><td>%prjname%</td><td>%startdate%</td><td>%enddate%</td><td>%status%</td><td><div><div style='margin:0;' class='progress'><div class='progress-bar progress-bar-success' style='width:%width%;color:black;'>%complete_text% Complete</div></div></td></tr>";
    		prj_tplate = prj_tplate.replace("%prjid%", projects[i]["ProjectID"]);
    		prj_tplate = prj_tplate.replace("%prjname%", projects[i]["Name"]);
    		prj_tplate = prj_tplate.replace("%startdate%", FormalDateTime(projects[i]["StartDate"])[0]);
    		prj_tplate = prj_tplate.replace("%enddate%", FormalDateTime(projects[i]["EndDate"])[0]);
    		if (projects[i]["Status"] == "0" || projects[i]["Status"] == 0) {
    			prj_tplate = prj_tplate.replace("%status%", "In Progress");
    		} else {
    			prj_tplate = prj_tplate.replace("%status%", "Completed");
    		}
    		if (projects[i]["Progress"] == "") {
    			prj_tplate = prj_tplate.replace("%complete_text%", "0%");
    			prj_tplate = prj_tplate.replace("%width%", "0%");
    		} else {
    			prj_tplate = prj_tplate.replace("%complete_text%", Math.round(projects[i]["Progress"])+"%");
    			prj_tplate = prj_tplate.replace("%width%", Math.round(projects[i]["Progress"])+"%");
    		}
    		prj_tbl.append(prj_tplate);
    	}
    }
}
</script>
</html>