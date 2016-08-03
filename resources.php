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
<script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
</head>
<style>
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
	width:33.3%;
}

.project_table > tbody > tr > td {
	width:33.3%;
}

.form_table td {
	padding-top:2px;
	padding-bottom:2px;
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

.menu_bar li a:hover {
    background-color: #5FAE57;
}

.menu_bar .selected {
	background-color: #5FAE57;
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
	<tr><td><a id="logout_btn" style="cursor:pointer;">Sign Out</a></td></tr>
	</table>
	</div>
</nav>

<div style="padding-left:50px;padding-right:50px;margin-top:20px;height:80%;">
		<div style="position:relative;height:90px;margin-top:10px;width:100%;padding:5px;background-color:#ffffff;border-style:solid;border-width:1px;border-color:#c6c6c6;">
		<h4 style="text-align:center;font-weight:normal;margin-top:5px;"><span class="glyphicon glyphicon-import"></span> View Resources</h4>
		<hr style="margin-top:5px;margin-bottom:5px;"/>
		<div style="position:absolute;left:5px;"><a id="add_resourcesbtn" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add Resources</a></div>
		<div style="position:absolute;right:5px;"><input id="searchr" type="text" style="width:150px;height:32px;margin-right:5px;outline-width:0px;" placeholder="Search Resources..." /><button class="btn btn-warning btn-sm">Search</button></div>
		</div>

		<div style="height:calc(100% - 100px);background-color:#ffffff;margin-top:10px;border-style:solid;border-color:#c6c6c6;border-width:1px;">
		<table class="project_table" style="width:100%;background-color:#efefef;">
			<tr>
				<td>Resource Name</td>
				<td>Price</td>
				<td>Type</td>
			</tr>
		</table>
		<div style="overflow-y:auto;width:100%;height:calc(100% - 30px);">
		<table class="project_table" style="width:100%;background-color:#ffffff;">
			<tbody id="resources_cont">
			</tbody>
		</table>
		</div>
		</div>
</div>

<footer>
<p style="text-align:center;">&copy; 2016 E.V.Y. Corporation</p>
</footer>

 <div class="modal fade" id="addResource" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="overflow:hidden">
      <div class="modal-header" style="background-color:#55AA55;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="mdlTitle" style="color:white;">Add Resource</h4>
      </div>
      <div class="modal-body">
      <div id="addError" class="alert alert-danger" style="border-radius:0px;display:none;"><b>Error:</b> Please fill up all the required fields.</div>
      	<form id="addResourceForm">
      	<table class="form_table" style="width:100%;">
      		<tr>
      		<td><label>Resource Name:</label></td><td><input style="width:250px;" name="name" type="text" /></td>
      		</tr>
      		<tr>
      		<td><label>Price per Unit:</label></td><td><input style="width:250px;" name="price" type="text" /></td>
      		</tr>
      		<tr>
      		<td><label>Type:</label></td><td><input style="width:250px;" name="type" type="text" /></td>
      		</tr>
      	</table>
      	</form>
      </div>
      <div class="modal-footer">
      	<a id="delresourcebtn" type="button" class="btn btn-danger" style="border-radius:0px;display:none;">Delete Resource</a>
        <a id="addresourcebtn" type="button" class="btn btn-success" style="border-radius:0px;">Add Resource</a>
      </div>
    </div>
  </div>
</div>

 <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="overflow:hidden">
      <div class="modal-header" style="background-color:#55AA55;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="errorTitle" style="color:white;">Resource Added</h4>
      </div>
      <div class="modal-body">
        <p id="errorMessage" style="font-size:12px;">Resource successfully added.</p>
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-success" style="border-radius:0px;" data-dismiss="modal" >OK</a>
      </div>
    </div>
  </div>
</div>

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
	reloadData();
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


function showOk(title, message) {
	$("#errorTitle").html(title);
	$("#errorMessage").html(message);
	$("#successModal").modal("show");
}

$("#add_resourcesbtn").on("click", function() {
	modalMode = "add";
	$("#mdlTitle").html("Add Resource");
	$("#addresourcebtn").html("Add Resource");
	$("#addResource").modal("show");
});

function editResource(theRow) {
    console.log(theRow);
	modalMode = "edit";
	$("#mdlTitle").html("Edit Resource");
	$("#addresourcebtn").html("Edit Resource");
	CURresID = $(theRow).data('resid');
//	var theRow = document.getElementById(theRow+"res");
	var theForm = document.getElementById("addResourceForm");
        console.log(theRow);
	for (i = 0; i < $(theRow).find('td').length; i++) {
            console.log($(theRow).find("td:eq('"+i+"')"));
		theForm[i].value = $(theRow).find("td:eq('"+i+"')").data('value');
	}
	$("#addResource").modal("show");
}

function reloadData() {
	xhr = new XMLHttpRequest();
	xhr.open("POST", "backend.php");
	xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
	xhr_do = {
		"do":"list_resources"
	}
	xhr.send(JSON.stringify(xhr_do));
	xhr.onload = function() {
		resources = JSON.parse(xhr.responseText);
		theCont = $("#resources_cont");
		theCont.html("");
		for (i = 0; i < resources.length; i++) {
			trt = "<tr id='%resourceid%res' data-resid=\"%rid%\" onclick=\"editResource(this)\"><td>%name%</td><td>Php. %price%</td><td>%type%</td></tr>";
			trt = trt.replace("%resourceid%", resources[i]["ResourceID"]);
			trt = trt.replace("%rid%", resources[i]["ResourceID"]);
			trt = trt.replace("%name%", resources[i]["Name"]);
			trt = trt.replace("%price%", resources[i]["Price"]);
                        if( resources[i]["Type"]=='manpower' || resources[i]["Type"]=='equipment'){
                            	trt = trt.replace("%type%", resources[i]["Type"]+resources[i]["outsource"]);
                        }
                        else{
                            	trt = trt.replace("%type%", resources[i]["Type"]);
                        }
		
			theCont.append(trt);
                        $("#resources_cont").find('tr:last').find('td:eq(0)').data('value',resources[i]["Name"]);
                        $("#resources_cont").find('tr:last').find('td:eq(1)').data('value',resources[i]["Price"]);
                        $("#resources_cont").find('tr:last').find('td:eq(2)').data('value',resources[i]["Type"]);
		}
	}
}

$("#searchr").on("keydown", function() {
	xhr = new XMLHttpRequest();
	xhr.open("POST", "backend.php");
	xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
	xhr_do = {
		"do":"list_resources",
		"search":$("#searchr").val()
	}
	xhr.send(JSON.stringify(xhr_do));
	xhr.onload = function() {
		resources = JSON.parse(xhr.responseText);
		theCont = $("#resources_cont");
		theCont.html("");
		for (i = 0; i < resources.length; i++) {
			trt = "<tr id='%resourceid%res' onclick=\"editResource(this)\"><td>%name%</td><td>Php. %price%</td><td>%type%</td></tr>";
			trt = trt.replace("%resourceid%", resources[i]["ResourceID"]);
			trt = trt.replace("%rid%", resources[i]["ResourceID"]);
			trt = trt.replace("%name%", resources[i]["Name"]);
			trt = trt.replace("%price%", resources[i]["Price"]);
			      if( resources[i]["Type"]=='manpower' || resources[i]["Type"]=='equipment'){
                            	trt = trt.replace("%type%", resources[i]["Type"]+resources[i]["outsource"]);
                        }
                        else{
                            	trt = trt.replace("%type%", resources[i]["Type"]);
                        }
			theCont.append(trt);
		}
	}
});

$("#addresourcebtn").on("click", function() {
	theForm = document.getElementById("addResourceForm");
	submitForm = true;
	theJSON = {};
	if (modalMode == "edit") {
		theJSON["do"] = "edit_resource";
		theJSON["resourceid"] = CURresID;
	} else {
		theJSON["do"] = "add_resource";
	}
	for (i = 0; i < theForm.length; i++) {
		if (theForm[i].value.length <= 0) {
			submitForm = false;
			break;
		} else {
			theJSON[theForm[i].name] = theForm[i].value;
		}
	}

	if (submitForm) {
		// submit the form.
		xhr = new XMLHttpRequest();
		xhr.open("POST", "backend.php");
		xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
		xhr.send(JSON.stringify(theJSON));
		xhr.onload = function() {
			ssE = JSON.parse(xhr.responseText);
			if (ssE["success"]) {
				for (i = 0; i < theForm.length; i++) {
					theForm[i].value = "";
				}
				reloadData();
				$("#addResource").modal("hide");
				if (modalMode == "add") {
					showOk("Resource Added", "Resource successfully added.");
				} else {
					showOk("Resource Edited", "Resource successfully edited.");
				}
			}
		}
	} else {
		$("#addError").css("display", "block");
	}
});
</script>
</html>