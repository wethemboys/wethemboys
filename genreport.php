<?php
session_name("evypms");
session_start();
if (!isset($_SESSION["theuser"])) {
	header("Location: login.php");
}

function FormalDateTime($datetime) {
	$rawdate = explode(" ", $datetime);
	$date = $rawdate[0];
	$time = $rawdate[1];
	$months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	$thetime = explode(":", $time);
	$thedate = explode("-", $date);
	if (intval($thetime[0]) >= 12) {
		$hour = $thetime[0] - 12;
		$ampm = "PM";
	} else {
		$hour = $thetime[0];
		$ampm = "AM";
	}
	if ($hour == 0) {
		$hour = 12;
	}
	return [$months[(intval($thedate[1]) - 1)] . " " . intval($thedate[2]) . ", " . intval($thedate[0]), $hour . ":" . intval($thetime[1]) . " " . $ampm];
}

if (isset($_GET["pid"]) && !empty($_GET["pid"])) {
	$mysqli = new mysqli("localhost", "root", "", "evypms");
	$query = "SELECT projects.*, users.Name as ClientName, (SELECT SUM(activities_resources.Used * resources.Price) as ActualCost FROM `activities_resources` INNER JOIN resources ON activities_resources.ResourceID=resources.ResourceID WHERE ProjectID=projects.ProjectID) as ActualCost, (SELECT SUM(activities_resources.Quantity * resources.Price) as ProgrammedCost FROM `activities_resources` INNER JOIN resources ON activities_resources.ResourceID=resources.ResourceID WHERE ProjectID=projects.ProjectID) as ProgrammedCost FROM projects INNER JOIN users ON projects.UserID=users.UserID WHERE ProjectID='".$mysqli->real_escape_string($_GET["pid"])."'";
	$qq = $mysqli->query($query);
	if ($qq->num_rows > 0) {
		$project = $qq->fetch_assoc();
	} else {
		die();
	}
} else {
	die();
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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
    cursor:pointer;
}

.menu_bar .selected {
	background-color: #5FAE57;
}
body, html {
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
<div id="control_monitor" style="width:100%;padding:20px;">
<span style="font-size:18px;font-weight:lighter;text-align:center;display:block;width:100%;">Controlling Monitoring</span>
<hr style="margin-top:5px;margin-bottom:5px;"/>
<span style="font-size:18px;font-weight:lighter;">Project Information</span>
<hr style="margin-top:5px;margin-bottom:5px;"/>
<table style="width:100%;" class="table_form">
<tr>
<td>Project Name:</td><td id="prjnameindicator2" style="color:gray;"><?php echo $project["Name"];?></td>
</tr>
<tr>
<td>Start Date:</td><td id="prjstartdateindicator2" rawdate="<?php echo $project["StartDate"];?>" style="color:gray;"><?php echo FormalDateTime($project["StartDate"])[0];?></td>
</tr>
<tr>
<td>End Date:</td><td id="prjenddateindicator2" rawdate="<?php echo $project["EndDate"];?>" style="color:gray;"><?php echo FormalDateTime($project["EndDate"])[0];?></td>
</tr>
<tr>
<td>Client Name:</td><td id="prjclientnameindicator2" clientid="<?php echo $project["UserID"];?>" style="color:gray;"><?php echo $project["ClientName"];?></td>
</tr>
<tr>
<td>Progress:</td><td id="progressindicator2" style="color:gray;"><?php echo round($project["Progress"]);?>%</td>
</tr>
<tr>
<td>Status:</td><td id="statusindicator2" style="color:gray;"><?php echo ($project["Status"] == "1" ? "Completed" : "In Progress");?></td>
</tr>
<tr>
<td>Programmed Cost:</td><td id="programmedcostindicator2" style="color:gray;"></td>
</tr>
<tr>
<td>Actual Cost:</td><td id="actualcostindicator2" style="color:gray;"></td>
</tr>
</table>

<div id="act_list" style="margin-top:5px;">
</div>
</div>
</body>
<script>
ProjectID = <?php echo $_GET["pid"];?>;

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
function controls() {
	xhr = new XMLHttpRequest();
	xhr.open("POST", "backend.php");
	xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
	xhr.send(JSON.stringify({
		"do":"getproject",
		"projectid":ProjectID
	}));
        selected = false ;
        if($("#control_monitor").find('.ui-state-active').length >0){
            selectedId = $("#control_monitor").find('.ui-state-active').attr('taskid');
//            selectedIdArray = selectedId.split("-");
            selected =selectedId;
        }
	xhr.onload = function() {
		proj = JSON.parse(xhr.responseText);
		$("#prjnameindicator2").html(proj["Name"]);
		$("#prjstartdateindicator2").html(FormalDateTime(proj["StartDate"])[0]);
		$("#prjenddateindicator2").html(FormalDateTime(proj["EndDate"])[0]);
		$("#prjclientnameindicator2").html(proj["ClientName"]);
		if (proj["Progress"] !== "") {
			$("#progressindicator2").html(Math.round(parseInt(proj["Progress"])) + "%");
		} else {
			$("#progressindicator2").html("0%");
		}
		if (proj["Status"] == "0" || proj["Status"] == 0) {
			$("#statusindicator2").html("In Progress");
		} else {
			$("#statusindicator2").html("Completed");
		}
		if (proj["ActualCost"] !== null && proj["ActualCost"] !== "0") {
			$("#actualcostindicator2").html("Php. " + proj["ActualCost"]);
		} else {
			$("#actualcostindicator2").html("Php. 0.00");
		}
		if (proj["ProgrammedCost"] !== null && proj["ProgrammedCost"] !== "0") {
			$("#programmedcostindicator2").html("Php. " + proj["ProgrammedCost"]);
		} else {
			$("#programmedcostindicator2").html("Php. 0.00");
		}
                $("#act_list").remove();
                $("#control_monitor").append("<div id='act_list'></div>")
		$("#").html("");
		for (var a = 0; a < proj["activities"].length; a++) {
                    tBlex = '<h3 taskid="'+proj["activities"][a]["TaskID"]+'"><span style="font-size:18px;font-weight:lighter;display:block;">%header% <span style="font-size:12px;">%actprice%</span></span></h3><div class="activity_task"><hr style="margin-top:5px;margin-bottom:5px;"/><table class="form_table" style="min-width:300px;"><tr><td>Task Name:</td><td style="color:gray;">%actname%</td></tr><tr><td>Start Date:</td><td style="color:gray;">%startdate%</td></tr><tr><td>End Date:</td><td style="color:gray;">%enddate%</td></tr><tr><td>Programmed Cost:</td><td style="color:gray;">%pcost%</td></tr><tr><td>Actual Cost:</td><td style="color:gray;">%acost%</td></tr><tr><td>Status:</td><td style="color:gray;">%astatus%</td></tr></table><h4 style="text-align:center;font-weight:lighter">Task Resources</h4><table class="project_table" style="width:100%;"><thead><tr><th>Resource Name</th><th>Original Quantity<span style="color:red;font-size:10px;font-weight:normal;">/outsource</span></th><th>Updated Quantity</th><th>Used</th><th>Remaining</th></tr></thead><tbody>%tbldata%</tbody></table></div>';
			//tBlex = '<h3><span style="font-size:18px;font-weight:lighter;display:block;">%header% <span style="font-size:12px;">%actprice%</span></span></h3><div class="activity_task"><hr style="margin-top:5px;margin-bottom:5px;"/><table class="form_table" style="min-width:300px;"><tr><td>Task Name:</td><td style="color:gray;">%actname%</td></tr><tr><td>Start Date:</td><td style="color:gray;">%startdate%</td></tr><tr><td>End Date:</td><td style="color:gray;">%enddate%</td></tr><tr><td>Programmed Cost:</td><td style="color:gray;">%pcost%</td></tr><tr><td>Actual Cost:</td><td style="color:gray;">%acost%</td></tr><tr><td>Status:</td><td style="color:gray;">%astatus%</td></tr></table><h4 style="text-align:center;font-weight:lighter">Task Resources</h4><table class="project_table" style="width:100%;"><thead><tr><th>Resource Name</th><th>Quantity</th><th>Used</th><th>Remaining</th><th>Cost</th><th>Actual Cost</th></tr></thead><tbody>%tbldata%</tbody></table></div>';
                      //  tBlex = '<div class="activity_task"><span style="margin-top:5px;padding-top:15px;border-top:3px #787878 solid;font-size:18px;font-weight:lighter;display:block;">%header% <span style="font-size:12px;color:gray;">%actprice%</span></span><hr style="margin-top:5px;margin-bottom:5px;"/><table class="form_table" style="min-width:300px;"><tr><td>Task Name:</td><td style="color:gray;">%actname%</td></tr><tr><td>Start Date:</td><td style="color:gray;">%startdate%</td></tr><tr><td>End Date:</td><td style="color:gray;">%enddate%</td></tr><tr><td>Programmed Cost:</td><td style="color:gray;">%pcost%</td></tr><tr><td>Actual Cost:</td><td style="color:gray;">%acost%</td></tr><tr><td>Status:</td><td style="color:gray;">%astatus%</td></tr></table><h4 style="text-align:center;font-weight:lighter">Task Resources</h4><table class="project_table" style="width:100%;"><thead><tr><th>Resource Name</th><th>Quantity</th><th>Used</th><th>Remaining</th><th>Cost</th><th>Actual Cost</th></tr></thead><tbody>%tbldata%</tbody></table></div>';
			if(parseInt(proj["activities"][a]["AdditionalDays"]) == 0 ){
                            additionalDays = '';
                        }else{
                            additionalDays = '<tr><td>Additional Days </td><td>'+proj["activities"][a]["AdditionalDays"]+' </td></tr>';
                        }
                        
                        tBlex = tBlex.replace("%header%",proj["activities"][a]["Activity"] +' - '+proj["activities"][a]["Name"]);
			tBlex = tBlex.replace("%actname%", proj["activities"][a]["Name"]);
			tBlex = tBlex.replace("%startdate%", FormalDateTime(proj["activities"][a]["StartDate"])[0]);
			tBlex = tBlex.replace("%enddate%", FormalDateTime(proj["activities"][a]["EndDate"])[0] +additionalDays);
                        if(proj["activities"][a]["Done"]== 1 ){
                            status =  'Done'
                        }else{
                            console.log(proj["activities"][a]["StartDate"]);
                            status = 'In Progress'
                            if(new Date() > new Date(proj["activities"][a]["StartDate"]))
                            {
                                //status = status + '<tr><td><button class="btn btn-sm btn-success addAdditionalMaterial" data-taskid="'+proj["activities"][a]["TaskID"] +'"><span class="glyphicon glyphicon-plus"></span>Add Additonal Materials</button></td></tr>';
                            }
                        }
                        
                        tBlex = tBlex.replace("%astatus%", status);
                        
			if (proj["activities"][a]["ProgrammedCost"] !== null && proj["activities"][a]["ProgrammedCost"] !== "0") {
				tBlex = tBlex.replace("%pcost%", "Php. " + proj["activities"][a]["ProgrammedCost"]);
			} else {
				tBlex = tBlex.replace("%pcost%", "Php. 0.00");
			}
			if (proj["activities"][a]["ActualCost"] !== null && proj["activities"][a]["ActualCost"] !== "0") {
				tBlex = tBlex.replace("%acost%", "Php. " + proj["activities"][a]["ActualCost"]);
			} else {
				tBlex = tBlex.replace("%acost%", "Php. 0.00");
			}
			ActPrice = 0;
			bLejx = "";
			for (var b = 0; b < proj["activities"][a]["resources"].length; b++) {
                                bLej = "<tr class='coloredtr'><td>%name%</td><td>%qty%</td><td>%updatedqty%</td><td>%used%</td><td>%remaining%</td></tr>";
				//bLej = "<tr class='coloredtr'><td>%name%</td><td>%qty%</td><td>%used%</td><td>%remaining%</td><td>%pcost%</td><td>%acost%</td></tr>";
				if(proj["activities"][a]["resources"][b]["ResourceType"] == 'manpower'){
                                    used = '-';
                                    remaining = '-';
                                }else{
                                    used = proj["activities"][a]["resources"][b]["Used"];
                                    remaining = proj["activities"][a]["resources"][b]["Remaining"];
                                }
                                bLej = bLej.replace("%name%", proj["activities"][a]["resources"][b]["ResourceName"]);
				bLej = bLej.replace("%qty%", proj["activities"][a]["resources"][b]["QuantityText"]);
                                bLej = bLej.replace("%updatedqty%", proj["activities"][a]["resources"][b]["AddedQuantity"]);
//                                bLej = bLej.replace("%qty%",quantity);
				bLej = bLej.replace("%remaining%", remaining);
				bLej = bLej.replace("%used%",used);
				thePrice = parseInt(proj["activities"][a]["resources"][b]["ResourcePrice"]) * parseInt(proj["activities"][a]["resources"][b]["Quantity"]);
//				bLej = bLej.replace("%pcost%", "Php. " + thePrice);
//				bLej = bLej.replace("%acost%", "Php. " + parseInt(proj["activities"][a]["resources"][b]["ResourcePrice"]) * parseInt(proj["activities"][a]["resources"][b]["Used"]));
				
				bLejx += bLej;
			}
			tBlex = tBlex.replace("%tbldata%", bLejx);
			tBlex = tBlex.replace("%actprice%", "Php. " + ActPrice);
			$("#act_list").append(tBlex);
		
                additional_html= '';
		for (var e= 0; e < proj["activities"][a]["additional"].length; e++) {
                    if( proj["activities"][a]["additional"].length ){
                         additional_html = '<table class="table_form" style="width:100%; border-top:1px #343434 solid;"><tr style="font-weight: bold;"><td style="width:50%;">Additional Material</td><td style="width:25%";>Quantity</td><td style="width:25%;">Additional Cost</td>';
                    }
                    for (var f= 0; f < proj["activities"][a]["additional"][e]["items"].length; f++) {
                        additional_html =additional_html + '<tr class="coloredtr"><td>'+ proj["activities"][a]["additional"][e]["items"][f]["ResourceName"]+'</td><td>'+ proj["activities"][a]["additional"][e]["items"][f]["Quantity"]+'</td><td>'+ proj["activities"][a]["additional"][e]["items"][f]["ResourcePrice"]+'</td>';
                    }
                    if( proj["activities"][a]["additional"].length ){
                        additional_html =additional_html + "<tr style='font-weight: bold;'><td colspan=3>Reason</td></tr>";
                        additional_html =additional_html + "<tr><td colspan=3>"+proj["activities"][a]["additional"][e]["Reason"]+"</td></tr>";
                        $("#act_list .activity_task:last").append(additional_html);
                    }
		}

            }
//            $("#act_list").accordion({heightStyle: "content"});
//            if(selected){
//                $("#act_list").find('h3[taskid="'+selectedId+'"]').trigger('click');
//            }
	}
}
controls();
</script>
</html>