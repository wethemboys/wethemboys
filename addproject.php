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
<script src="js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
<!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
<style>
.notif_table, th td {
   border-top-style:solid;
   border-bottom-style:solid;
   border-width:1px;
   border-color:#c6c6c6;
   font-size:12px;
   padding:5px;
   cursor:pointer;
}

.project_table > tbody > tr > td {
	padding:5px;
}

.project_table > tbody > tr:hover {
	background-color:#efefef;
	cursor:pointer;
}

.project_table th {
	font-size:14px;
}

.menu_bar {
	position:relative;
    list-style-type: none;
    margin: 0;
    padding: 0;
    background-color: #378B2E;
    overflow:hidden;
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

.menu_options tr {
	border-style:solid;
	border-width:1px;
	border-color:#c6c6c6;
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
.table_form td {
	padding:3px;
}

label {
	font-weight:normal;
}

.form_table td {
	padding-top:2px;
	padding-bottom:2px;
}
</style>
</head>
<body>
<nav style="position:relative;">
<ul class="menu_bar">
<li><a href="index.php">Home</a></li>
<li class="selected"><a href="projects.php">Projects</a></li>
<li><a href="resources.php">Resources</a></li>
<li><a href="clients.php">Clients</a></li>
<li style="position:absolute;right:10px;"><a id="mn_optbtn" style="outline-width:0px;cursor:pointer"><span class="glyphicon glyphicon-menu-hamburger" style="margin-right:5px;"></span> <span id="usr_menu_disp">Marvin Gaye</span></a></li>
</ul>
<div id="mmE" style="z-index:99999;display:none;position:absolute;right:10px;border-style:solid;border-width:1px;border-color:#c6c6c6;box-shadow:0px 0px 3px #c6c6c6;padding:5px;min-height:100px;position:absolute;width:200px;background-color:white;">
	<div style="display:table;width:100%;">
	<div style="display:table-cell;"><img src="https://tracker.moodle.org/secure/attachment/30912/f3.png" style="width:50px;height:50px;border-style:solid;border-color:#c6c6c6;border-width:1px;" /></div>
	<div style="display:table-cell;vertical-align:top;"><span id="uname_display" style="font-weight:bold;display:block;">Marvin Gaye</span><span id="usr_type" style="display:block;font-size:12px;font-weight:bold;color:gray;">Administrator</span></div>
	</div>

	<table style="width:100%;margin-top:10px;" class="menu_options">
	<tr><td><a id="logout_btn" style="cursor:pointer;">Sign Out</a></td></tr>
	</table>
	</div>
</nav>

<div style="padding-left:50px;padding-right:50px;margin-top:20px;">
<div style="width:100%;padding:5px;background-color:#ffffff;border-style:solid;border-color:#c6c6c6;border-width:1px;margin-bottom:10px;">
<h4 style="text-align:center;font-weight:normal;"><span class="glyphicon glyphicon-import"></span> Add New Project</h4>
</div>
<div style="width:100%;padding:5px;background-color:#ffffff;border-style:solid;border-width:1px;border-color:#c6c6c6;">
<span style="font-size:18px;font-weight:lighter;">Basic Information</span>
<hr style="margin-top:5px;margin-bottom:5px;"/>
<table class="table_form">
<tr>
<td><label>Project Name:</label></td><td><input id="prjname" type="text" style="width:200px;margin-left:5px;" /></td>
</tr>
<tr>
<td><label>Start Date:</label></td><td><input id="prjstartdate" type="text" style="width:200px;margin-left:5px;" /></td>
</tr>
<tr>
<td><label>End Date:</label></td><td><input id="prjenddate" type="text" style="width:200px;margin-left:5px;" /></td>
</tr>
<tr>
<td><label>Client:</label></td><td><select id="prjclient" type="text" style="margin-left:5px;width:200px;"><option value="">-- Select Client --</option></select></td>
</tr>
</table>
</div>

<div style="margin-top:10px;width:100%;padding:5px;background-color:#ffffff;border-style:solid;border-width:1px;border-color:#c6c6c6;min-height:300px;">
<span style="font-size:18px;font-weight:lighter;">Project Activities</span><button class="btn btn-sm btn-warning" style="margin-left:10px;" onclick="addAct()"><span class="glyphicon glyphicon-plus"></span> Add Activity</button>
<hr style="margin-top:5px;margin-bottom:5px;"/>
<table class="project_table" style="width:100%;">
<thead>
<tr>
<th>Activity</th>
<th>Duration</th>
<th>Start Date</th>
<th>End Date</th>
<th>Options</th>
</tr>
</thead>
<tbody id="activityview">
</tbody>
</table>
</div>

<div style="margin-top:10px;width:100%;padding:5px;background-color:#ffffff;border-style:solid;border-width:1px;border-color:#c6c6c6;">
<span style="font-size:18px;font-weight:lighter;">Gantt Preview</span>
<hr style="margin-top:5px;margin-bottom:5px;"/>
<div id="chart_div" style="width:100%;min-height:300px;"></div>
</div>

<div style="width:100%;padding:5px;background-color:#ffffff;border-style:solid;border-color:#c6c6c6;border-width:1px;margin-top:10px;">
<button id="addprjbtn" class="btn btn-success">Add Project</button><button class="btn btn-danger" style="margin-left:5px;">Cancel</button>
</div>

</div>

<footer>
<p style="text-align:center;">&copy; 2016 E.V.Y. Corporation</p>
</footer>

<!-- this is for the project only -->

<div class="modal fade" id="addActModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width:80%;">
    <div class="modal-content" style="overflow:hidden">
      <div class="modal-header" style="background-color:#55AA55;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" style="color:white;"><span id="theModalTask">- - -</span></h4>
      </div>
      <div class="modal-body">
      <span style="font-size:18px;font-weight:lighter;">Basic Information</span>
		<hr style="margin-top:5px;margin-bottom:5px;"/>
    	<table class="form_table">
    	<tr>
    	<td><label>Activity Name:</label></td><td style="padding-left:5px;"><input id="actname" type="text" style="width:250px;" /></td>
    	</tr>
    	<tr>
    	<td><label>Start Date:</label></td><td style="padding-left:5px;"><input id="actstartdate" type="text" style="width:250px;" /></td>
    	</tr>
    	<tr>
    	<td><label>End Date:</label></td><td style="padding-left:5px;"><input id="actenddate" type="text" style="width:250px;" /></td>
    	</tr>
    	<tr>
    	<td></td><td style="padding-left:5px;"><input type="checkbox" id="actcneeded" value="1" style="margin-right:3px;" />Notify Client</td>
    	</tr>
    	</table>
    	<br />
    	<span style="font-size:18px;font-weight:lighter;">Activity Items</span>
		<hr style="margin-top:5px;margin-bottom:5px;"/>
		<table class="project_table" style="width:100%;">
<thead>
<tr>
<th>Item Name</th>
<th>Quantity</th>
<th>Price</th>
<th>Options</th>
</tr>
</thead>
<tbody id="addprjitms">
</tbody>
</table>
		<div style="margin-top:20px;">
		<span style="font-size:18px;font-weight:lighter;">Add Items</span>
		<hr style="margin-top:5px;margin-bottom:5px;"/>
		<div style="padding:10px;width:50%;margin:0 auto;height:90px;border-style:solid;border-color:#c6c6c6;border-width:1px;margin-bottom:10px;box-shadow:0px 0px 3px black;">
			<p id="itmname" style="text-align:center;">- - -</p>
			<table style="margin:0 auto;">
			<tr>
			<td>Price per Unit:</td>
			<td style="padding-left:5px;color:gray;">Php. <span id="itmprice">- - -</span></td>
			</tr>
			</table>
		</div>
		<table class="table_form">
<tr>
<td><label>Item Name:</label></td><td><select id="actadditem" style="width:200px;margin-left:5px;"><option value="">-- Select Item --</option></select></td>
</tr>
<tr>
<td><label>Quantity:</label></td><td><input id="actadditemqty" type="text" style="width:200px;margin-left:5px;" /></td>
</tr>
</table>
</div>
<button type="button" id="addactitmbtn" class="btn btn-success btn-sm">Add Item</button>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button id="addactbtn" type="button" class="btn btn-success">Add Activity</button>
      </div>
    </div>
  </div>
</div>

 <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="overflow:hidden">
      <div class="modal-header" style="background-color:#D46A6A;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="errorTitle" style="color:white;">Project not Added</h4>
      </div>
      <div class="modal-body">
        <p id="errorMessage" style="font-size:12px;">Please fill up all the required fields. (all fields are required)</p>
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-danger" style="border-radius:0px;" data-dismiss="modal" >OK</a>
      </div>
    </div>
  </div>
</div>

 <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="overflow:hidden">
      <div class="modal-header" style="background-color:#55AA55;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="errorTitle" style="color:white;">Project Added</h4>
      </div>
      <div class="modal-body">
        <p id="errorMessage" style="font-size:12px;">Project successfully added.</p>
      </div>
      <div class="modal-footer">
        <a type="button" href="projects.php" class="btn btn-success" style="border-radius:0px;">OK</a>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
$("#actstartdate").datepicker({dateFormat:'yy-mm-dd'});
$("#actenddate").datepicker({dateFormat:'yy-mm-dd'});
$("#prjstartdate").datepicker({dateFormat:'yy-mm-dd'});
$("#prjenddate").datepicker({dateFormat:'yy-mm-dd'});

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
	getclients();
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

function showError(title, message) {
	$("#errorTitle").html(title);
	$("#errorMessage").html(message);
	$("#errorModal").modal("show");
}

function getclients() {
	// load some datas
	xhr = new XMLHttpRequest();
	xhr.open("POST", "backend.php");
	xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
	xhr.send(JSON.stringify({"do":"list_clients"}));
	xhr.onload = function() {
		clients = JSON.parse(xhr.responseText);
		clientsview = $("#prjclient");
		for (i = 0; i < clients.length; i++) {
			cc = "<option value='"+clients[i]["UserID"]+"'>"+clients[i]["Name"]+"</option>";
			clientsview.append(cc);
		}
		getResources();
	}
}

function getResources() {
	xhr = new XMLHttpRequest();
	xhr.open("POST", "backend.php");
	xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
	xhr.send(JSON.stringify({"do":"list_resources"}));
	xhr.onload = function() {
		resources = JSON.parse(xhr.responseText);
		resourcesview = $("#itemaddselect");
		for (i = 0; i < resources.length; i++) {
			cc = "<option price='"+resources[i]["Price"]+"' value='"+resources[i]["ResourceID"]+"'>"+resources[i]["Name"]+"</option>";
			resourcesview.append(cc);
		}
		resourcesview = $("#actadditem");
		for (i = 0; i < resources.length; i++) {
			cc = "<option price='"+resources[i]["Price"]+"' value='"+resources[i]["ResourceID"]+"'>"+resources[i]["Name"]+"</option>";
			resourcesview.append(cc);
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

$("#actadditem").on("change", function(event) {
	itmName = $("#itmname");
	itmPrice = $("#itmprice");
	theSelect = event.target;
	if (theSelect.selectedIndex > 0) {
		itmName.html(theSelect.options[theSelect.selectedIndex].text);
		itmPrice.html($(theSelect.options[theSelect.selectedIndex]).attr("price"));
	} else {
		itmName.html("- - -");
		itmPrice.html("- - -");
	}
});

function addAct() {
	actItemListCnt = 0;
	ActItemList = [];
	$("#actname").val("");
	$("#actstartdate").val("");
	$("#actenddate").val("");
	$("#addprjitms").html("");
	$("#itmname").html("- - -");
	$("#itmprice").html("- - -");
	modalMode = "add";
	$("#theModalTask").html("Add Activity");
	$("#addactbtn").html("Add Activity");
	$("#addActModal").modal("show");
}

function getResourceInfo(resourceid) {
	theSelect = document.getElementById("actadditem");
	for (var i = 0; i < theSelect.options.length; i++) {
		if (theSelect.options[i].value == resourceid) {
			itemName = $(theSelect.options[i]).html();
			itemPrice = $(theSelect.options[i]).attr("price");
			return [itemName, itemPrice];
		}
	}
	return null;
}

function getDaysBetweenDates(d0, d1) {

  var msPerDay = 8.64e7;

  // Copy dates so don't mess them up
  var x0 = new Date(d0);
  var x1 = new Date(d1);

  // Set to noon - avoid DST errors
  x0.setHours(12,0,0);
  x1.setHours(12,0,0);

  // Round to remove daylight saving errors
  return Math.round( (x1 - x0) / msPerDay );
}

function editAct(actid) {
	CURactID = parseInt(actid.target.parentNode.parentNode.id.replace("%actRow%", ""));
	$("#actname").val("");
	$("#actstartdate").val("");
	$("#actenddate").val("");
	$("#addprjitms").html("");
	modalMode = "edit";
	ActItemList = ActList[CURactID]["items"];
	actItemListCnt = ActItemList.length;
	for (i = 0; i < ActItemList.length; i++) {
			itemInfo = getResourceInfo(ActItemList[i]["resourceid"]);
			itemTemplate = '<tr id="%itemrowid%"><td>%itemname%</td><td>%itemqty%</td><td>%itemprice%</td><td><button onclick="prjitemdel(event)" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Delete Item</button></td></tr>';
			itemTemplate = itemTemplate.replace("%itemrowid%", i+"actItmRowID");
			itemTemplate = itemTemplate.replace("%itemname%", itemInfo[0]);
			itemTemplate = itemTemplate.replace("%itemqty%", ActItemList[i]["quantity"]);
			itemTemplate = itemTemplate.replace("%itemprice%", "Php. " + (parseInt(itemInfo[1]) * parseInt(ActItemList[i]["quantity"])));
			itemTemplate = itemTemplate.replace("%itemrid%", i+"actItmRID");
			$("#addprjitms").append(itemTemplate);
	}
	$("#actname").val(ActList[CURactID]["name"]);
	$("#actstartdate").val(ActList[CURactID]["startdate"]);
	$("#actenddate").val(ActList[CURactID]["enddate"]);
	if (ActList[CURactID]["clientneeded"] == "0") {
		document.getElementById("actcneeded").checked = false;
	} else {
		document.getElementById("actcneeded").checked = true;
	}
	$("#theModalTask").html("Edit Activity");
	$("#addactbtn").html("Edit Activity");
	$("#itmname").html("- - -");
	$("#itmprice").html("- - -");
	$("#addActModal").modal("show");
}

$("#additmtoactbtn").on("click", function() {
	ActList[CurrentActID]["items"] = ItemList;
	ItemListCnt = 0;
	ItemList = [];
	$("#addItemModal").modal("hide");
});

actCount = 0;
ActList = [];
ActItemList = [];
$("#addactbtn").on("click", function() {
	actAddName = $("#actname").val();
	actStartDate = $("#actstartdate").val();
	actEndDate = $("#actenddate").val();
	if (actAddName !== "" && actStartDate !== "" && actEndDate !== "") {
		if (modalMode == "add") {
			theActivity = '<tr id="%rowid%"><td>%actname%</td><td>%days% Days</td><td>%startdate%</td><td>%enddate%</td><td><button onclick="editAct(event)" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-plus"></span> Edit Activity/Items</button> <button onclick="deleteAct(event)" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Delete Activity</button></td></tr>';
			theActivity = theActivity.replace("%rowid%", actCount+"actRow").replace("%actname%", actAddName).replace("%days%", getDaysBetweenDates(actStartDate, actEndDate)).replace("%startdate%", FormalDateTime(actStartDate + " 0:00:00")[0]).replace("%enddate%", FormalDateTime(actEndDate + " 0:00:00")[0]);
			$("#activityview").append(theActivity);
			ActList[actCount] = {};
			if (document.getElementById("actcneeded").checked) {
				ActList[actCount]["clientneeded"] = "1";
			} else {
				ActList[actCount]["clientneeded"] = "0";
			}
			ActList[actCount]["name"] = actAddName;
			ActList[actCount]["startdate"] = actStartDate;
			ActList[actCount]["enddate"] = actEndDate;
			ActList[actCount]["items"] = [];
			if (ActItemList.length > 0) {
				ActList[actCount]["items"] = ActItemList;
			}
			actCount++;
			actItemListCnt = 0;
			ActItemList = [];
		} else {
			theActivity = '<td>%actname%</td><td>%days%</td><td>%startdate%</td><td>%enddate%</td><td><button onclick="editAct(event)" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-plus"></span> Edit Activity/Items</button> <button onclick="deleteAct(event)" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Delete Activity</button></td>';
			theActivity = theActivity.replace("%actname%", actAddName).replace("%days%", getDaysBetweenDates(actStartDate, actEndDate)).replace("%startdate%", FormalDateTime(actStartDate + " 0:00:00")[0]).replace("%enddate%", FormalDateTime(actEndDate + " 0:00:00")[0]);
			$("#"+CURactID+"actRow").html(theActivity);
			ActList[CURactID] = {};
			if (document.getElementById("actcneeded").checked) {
				ActList[CURactID]["clientneeded"] = "1";
			} else {
				ActList[CURactID]["clientneeded"] = "0";
			}
			ActList[CURactID]["name"] = actAddName;
			ActList[CURactID]["startdate"] = actStartDate;
			ActList[CURactID]["enddate"] = actEndDate;
			ActList[CURactID]["items"] = [];
			if (ActItemList.length > 0) {
				ActList[CURactID]["items"] = ActItemList;
			}
			actItemListCnt = 0;
			ActItemList = [];
		}
		$("#addActModal").modal("hide");
		drawChart();
	} else {
		showError("Activity not Added", "Please fill up all the required fields for your activity. (all fields are required)");
	}
});

function prjitemdel(theItem) {
	theItemID = parseInt(theItem.target.parentNode.parentNode.id.replace("actItmRowID", ""));
	ActItemList = ActItemList.remove(theItemID);
	actItemListCnt--;
	eAC = 0;
	$("#addprjitms").children("tr").each(function() {
		this.id = eAC+"actItmRowID";
		eAC++;
	});
	$(theItem.target.parentNode.parentNode).remove();
	drawChart();
}

actItemListCnt = 0;
$("#addactitmbtn").on("click", function() {
	actAddItem = $("#actadditem");
	actAddItemQty = $("#actadditemqty");
	if (actAddItem.val() !== "" || actAddItemQty.val() !== "") {
		itemTemplate = '<tr id="%itemrowid%"><td>%itemname%</td><td>%itemqty%</td><td>%itemprice%</td><td><button onclick="prjitemdel(event)" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Delete Item</button></td></tr>';
		itemTemplate = itemTemplate.replace("%itemrowid%", actItemListCnt+"actItmRowID");
		itemTemplate = itemTemplate.replace("%itemname%", actAddItem.find(":selected").text());
		itemTemplate = itemTemplate.replace("%itemqty%", actAddItemQty.val());
		itemTemplate = itemTemplate.replace("%itemprice%", "Php. " + (parseInt(actAddItem.find(":selected").attr("price")) * parseInt(actAddItemQty.val())));
		itemTemplate = itemTemplate.replace("%itemrid%", actItemListCnt+"actItmRID");
		$("#addprjitms").append(itemTemplate);
		ActItemList[actItemListCnt] = {};
		ActItemList[actItemListCnt]["resourceid"] = actAddItem.val();
		ActItemList[actItemListCnt]["quantity"] = actAddItemQty.val();
		actItemListCnt++;
		actAddItem.val("");
		actAddItemQty.val("");
	} else {
		showError("Item not Added", "Please select the item and the desired quantity.");
	}
});

function getFields() {
	// Main Projects Variable
	projectName = $("#prjname").val();
	projectStartDate = $("#prjstartdate").val();
	projectEndDate = $("#prjenddate").val();

	// Add Item Modal
	itemAddSelect = $("#itemaddselect").val();
	itemAddQty = $("#itemaddqty").val();

	// Add Activity Modal
	actAddName = $("#actname").val();
	actStartDate = $("#actenddate").val();
	actEndDate = $("#actenddate").val();
	actAddItem = $("#actadditem").val();
	actAddItemQty = $("#actadditemqty").val();

	actTableTemplate = '<tr id="%rowid%"><td>%actname%</td><td>%days%</td><td>%startdate%</td><td>%enddate%</td><td><button class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-plus" onclick="addItems(%itmrowid%)"></span> Add Items</button></td><td>Php. 1,000</td><td><button onclick="deleteItem(event)" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Delete Activity</button></td></tr>';

	$("#activityview").html(actTableTemplate);
}

Array.prototype.remove = function(index) {
	rArray = [];
	c  = 0;
	for (i = 0; i < this.length; i++) {
		if (index !== i) {
			rArray[c] = this[i];
			c++;
		}
	}
	return rArray;
}

function deleteAct(actid) {
	RowID = actid.target.parentNode.parentNode.id;
	AcID = RowID.replace("actRow", "");
	$("#"+RowID).remove();
	ActList = ActList.remove(parseInt(AcID));
	actCount--;
	eaC = 0;
	$("#activityview").children("tr").each(function() {
		this.id = eaC+"actRow";
		eaC++;
	});
}

$("#addprjbtn").on("click", function() {
	sendJSON = {};
	projectName = $("#prjname").val();
	projectStartDate = $("#prjstartdate").val();
	projectEndDate = $("#prjenddate").val();
	projectClient = $("#prjclient").val();

	if (projectName !== "" && projectStartDate !== "" && projectEndDate !== "" && projectClient !== "") {
		sendJSON = {};
		sendJSON["do"] = "add_project";
		sendJSON["name"] = projectName;
		sendJSON["startdate"] = projectStartDate;
		sendJSON["enddate"] = projectEndDate;
		sendJSON["userid"] = projectClient;
		sendJSON["activities"] = ActList;
		xhr = new XMLHttpRequest();
		xhr.open("POST", "backend.php");
		xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
		xhr.send(JSON.stringify(sendJSON));
		xhr.onload = function() {
			addRes = JSON.parse(xhr.responseText);
			if (addRes["success"]) {
				$("#successModal").modal("show");
			} else {
				showError("Project not Added", "Server Error: Please try again later.");
			}
		}

	} else {
		showError("Project not Added", "Please fill up all the fields. (all fields are required)");
	}

});

 $("#prjname, #prjstartdate, #prjenddate").on("change", function() {
 	drawChart();
 });
</script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['gantt']});
    google.charts.setOnLoadCallback(drawChart);

    function daysToMilliseconds(days) {
      return days * 24 * 60 * 60 * 1000;
    }

    function drawChart() {
	    if ($("#prjname").val() !== "" && $("#prjstartdate").val() !== "" && $("#prjenddate").val() !== "") {
		      var data = new google.visualization.DataTable();
		      data.addColumn('string', 'Task ID');
		      data.addColumn('string', 'Task Name');
		      data.addColumn('date', 'Start Date');
		      data.addColumn('date', 'End Date');
		      data.addColumn('number', 'Duration');
		      data.addColumn('number', 'Percent Complete');
		      data.addColumn('string', 'Dependencies');

		      theRow = [];
		      mainRow = [
		      	"mainproj",
		  		"[Project] " + $("#prjname").val(),
		  		new Date($("#prjstartdate").val()),
		  		new Date($("#prjenddate").val()),
		  		parseInt(getDaysBetweenDates($("#prjstartdate").val(), $("#prjenddate").val())),
		  		0,
		  		null
		      ];
		      theRow.push(mainRow);
		      for (var c = 0; c < ActList.length; c++) {
		      	theRow.push([
		      		c+"act",
		      		"[Activity] " + ActList[c]["name"],
		      		new Date(ActList[c]["startdate"]),
		      		new Date(ActList[c]["enddate"]),
		      		parseInt(getDaysBetweenDates(ActList[c]["startdate"], ActList[c]["enddate"])),
		      		0,
		      		null
		      	]);
		      }
		      data.addRows(theRow);

		      var options = {
		      	 height: 275
		      };

		      var chart = new google.visualization.Gantt(document.getElementById('chart_div'));

		      chart.draw(data, options);
	    }
    }
</script>
</body>
</html>