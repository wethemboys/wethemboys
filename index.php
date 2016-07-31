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
<link href="js/jquery-ui-1.11.4.custom/jquery-ui.css" type="text/css" rel="stylesheet" />
<script src="js/jquery.min.js"></script>
<script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<script src="js/Chart.js"></script>
<script src="js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
<style>
#notif_table th, #notif_table td {
   border-top-style:solid;
   border-bottom-style:solid;
   border-width:1px;
   border-color:#c6c6c6;
   font-size:12px;
   padding:5px;
   cursor:pointer;
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
.btn {
	border-radius:0px !important;
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

.menu_bar {
	position:relative;
    list-style-type: none;
    margin: 0;
    padding: 0;
    background-color: #378B2E;
}

.menu_bar li {
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
</style>
</head>
<body>
<nav style="position:relative;height:50px;background-color: #378B2E;">
<?php require 'menu.php'?>
<div id="mmE" style="z-index:99999;display:none;position:absolute;right:10px;top:50px;border-style:solid;border-width:1px;border-color:#c6c6c6;box-shadow:0px 0px 3px #c6c6c6;padding:5px;min-height:100px;position:absolute;width:200px;background-color:white;">
	<div style="display:table;width:100%;">
	<div style="display:table-cell;"><img src="https://tracker.moodle.org/secure/attachment/30912/f3.png" style="width:50px;height:50px;border-style:solid;border-color:#c6c6c6;border-width:1px;" /></div>
	<div style="display:table-cell;vertical-align:top;"><span id="uname_display" style="font-weight:bold;display:block;">Marvin Gaye</span><span id="usr_type" style="display:block;font-size:12px;font-weight:bold;color:gray;">Administrator</span></div>
	</div>

	<table style="width:100%;margin-top:10px;" class="menu_options">
	<tr><td><a id="logout_btn" style="cursor:pointer;">Sign Out</a></td></tr>
	</table>
	</div>
</nav>
			<h5 style="text-align:center;"><span class="glyphicon glyphicon-bell"></span> Notifications:</h5>
			<div style="width:100%;min-height:75%;background-color:white;padding:5px;border-style:solid;border-color:#c6c6c6;border-width:1px;">
			<table id="notif_table" style="width:100%;background-color:white;font-size:12px;">
			</table>
			</div>


<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="overflow:hidden">
      <div class="modal-header" style="background-color:#55AA55;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" style="color:white;"><span>Modification Request</span></h4>
      </div>
      <div class="modal-body">
      	<table style="width:100%;">
      	<tr>
      	<td><label>Subject:</label></td><td><input id="subjectmsg" type="text" style="width:100%;" readonly/></td>
      	</tr>
      	<tr>
      	<td><label>Message:</label></td><td><textarea id="themsg" type="text" style="width:100%;height:200px;resize:none;margin-top:10px;border-color:#c6c6c6;border-width:1px;border-style:solid;" readonly></textarea></td>
      	</tr>
      	</table>
		</div>
      <div class="modal-footer">
      	<button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
      </div>
    </div>
  </div>
</div>

 <div class="modal fade" id="okModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="overflow:hidden">
      <div class="modal-header" style="background-color:#55AA55;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="okTitle" style="color:white;">Project not Added</h4>
      </div>
      <div class="modal-body">
        <p id="okMessage" style="font-size:12px;">Please fill up all the required fields. (all fields are required)</p>
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-success" style="border-radius:0px;" data-dismiss="modal" >OK</a>
      </div>
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

function getResourceInfo(resourceid) {
	for (var i = 0; i < resources.length; i++) {
		if (resources[i]["ResourceID"] == resourceid) {
			return resources[i];
		}
	}
	return null;
}

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
                
		case "manager":
			return "Project Manager";
		break;

		case "client":
			return "Client";
		break;
	}
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
		$("#clientsbtn").css("display", "none");
		$("#resourcesbtn").css("display", "none");
	}
	getnotifications();
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

function delnotif(cool) {
	bc = parseInt(cool.target.parentNode.parentNode.getAttribute("notifindex"));
	xhr = new XMLHttpRequest();
	xhr.open("POST", "backend.php");
	xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
	xhrd = {
		"do":"del_notif",
		"notificationid":notifs[bc]["NotificationID"]
	}
	xhr.send(JSON.stringify(xhrd));
	xhr.onload = function() {
		$(cool.target.parentNode.parentNode).remove();
		showOk("Notification Deleted", "Notification Deleted Successfully");
	}
}

function showOk(title, message) {
	$("#okTitle").html(title);
	$("#okMessage").html(message);
	$("#okModal").modal("show");
}

function viewmessage(bitch) {
	bc = parseInt(bitch.target.parentNode.parentNode.getAttribute("notifindex"));
	message = JSON.parse(notifs[bc]["RequestData"]);
	$("#subjectmsg").val(message["subject"]);
	$("#themsg").val(message["message"]);
	$("#requestModal").modal("show");
}

function getnotifications() {
	xhr = new XMLHttpRequest();
	xhr.open("POST", "backend.php");
	xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
	xhr.send(JSON.stringify({
		"do":"get_notifications"
	}));
	xhr.onload = function() {
		notifs = JSON.parse(xhr.responseText);
                console.log(notifs);
		$("#notif_table").html("");
		for (i = 0; i < notifs.length; i++) {
			if (user["Type"] !== "client") {
				notif_tmp = '<tr notifindex="%notifindex%"><td>%message%<br /><span style="color:gray;">%datetime%</span><span onclick="delnotif(event)" style="margin-left:3px;color:red">Delete</span></td></tr>';
                                delayed_tmp = '<tr notifindex="%notifindex%"><td>%message%<br /><span style="color:gray;">%datetime%</span><span style="margin-left:3px;color:red"><a href="%urldays%">Add Days</a></span><span style="margin-left:3px;color:red"><a href="%urlmanpower%">Add Manpower</a></span><span onclick="delnotif(event)" style="margin-left:3px;color:red">Delete</span></td></tr>';
			} else {
				notif_tmp = '<tr notifindex="%notifindex%"><td>%message%<br /><span style="color:gray;">%datetime%</span></td></tr>';	
			}


			minfo = JSON.parse(notifs[i]["RequestData"]);
                        console.log(minfo);
			switch (notifs[i]["Type"]) {
				case "late_activity":
					notif_tmp = notif_tmp.replace("%message%", "Task: <b>"+minfo["ActivityName"]+"</b> on Project: <b>"+minfo["ProjectName"]+"</b> has been delayed by <b>"+minfo["DelayDays"]+" Days</b>");
				break
                                
				case "late_task":
                                        urldays = 'viewproject.php?pid='+notifs[i]["ProjectID"]+'&taskid='+notifs[i]["TaskID"]+'&action=days';
                                        urlmanpower = 'viewproject.php?pid='+notifs[i]["ProjectID"]+'&taskid='+notifs[i]["TaskID"]+'&action=manpower';
					delayed_tmp = delayed_tmp.replace("%message%", "Task: <b>"+minfo["TaskName"]+"</b> on Project: <b>"+minfo["ProjectName"]+"</b> has been delayed by <b>"+minfo["DelayDays"]+" Days</b>");
                                        delayed_tmp = delayed_tmp.replace("%urldays%",urldays);
                                        notif_tmp = delayed_tmp.replace("%urlmanpower%",urlmanpower);
				break;
ID
				case "advance_activity":
					notif_tmp = notif_tmp.replace("%message%", "Task: <b>"+minfo["ActivityName"]+"</b> on Project: <b>"+minfo["ProjectName"]+"</b> is advanced by <b>"+minfo["AdvanceDays"]+" Days</b>");
				break;

				case "client_needed":
					notif_tmp = notif_tmp.replace("%message%", "<b>You</b> are needed on Activity: <b>"+minfo["TaskName"]+"</b> on Project: <b>"+minfo["ProjectName"]+"</b> 2 days from now.%message%");
                                        if(minfo["Message"] !== null)
                                        {notif_tmp = notif_tmp.replace("%message%","<br/> " +minfo["Message"].replace(/\n/g,'<br/>'));}
                                        else
                                            {notif_tmp = notif_tmp.replace("%message%", "");}
				break;

				case "change_request":
					notif_tmp = notif_tmp.replace("%message%", "<b>"+notifs[i]["Username"]+"</b> requested a modification request on Project: <b>"+minfo["ProjectName"]+"</b>. <button onclick='viewmessage(event)' class='btn btn-xs btn-success'>View Request</button>");
				break;

				case "paymentstart":
					notif_tmp = notif_tmp.replace("%message%", "Please pay starting 10% for the Project: <b>"+minfo["ProjectName"]+"</b>.");
				break;

				case "paymentend":
					notif_tmp = notif_tmp.replace("%message%", "Please pay the remaining 90% for the Project: <b>"+minfo["ProjectName"]+"</b>.");
				break;


				default:
					notif_tmp = notif_tmp.replace("%message%", "<b>"+notifs[i]["Username"]+"</b> has created a project modification");
				break;
			}
			notif_tmp = notif_tmp.replace("%notifindex%", i);
			notif_tmp = notif_tmp.replace("%name%", notifs[i]["Username"]);
			theDateTime = FormalDateTime(notifs[i]["TimeStamp"]);
			notif_tmp = notif_tmp.replace("%datetime%", theDateTime[0] + " | " + theDateTime[1]);
			$("#notif_table").append(notif_tmp);
		}
	}
}


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

</script>
</html>