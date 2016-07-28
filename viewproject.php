<?php
session_name("evypms");
session_start();
if (!isset($_SESSION["theuser"])) {
	header("Location: login.php");
}
function getCompleteType($type) {
	switch ($type) {
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
	$query = "SELECT projects.*, users.Name as ClientName, (SELECT SUM(task_resources.Used * resources.Price) as ActualCost FROM `task_resources` INNER JOIN resources ON task_resources.ResourceID=resources.ResourceID WHERE ProjectID=projects.ProjectID) as ActualCost, (SELECT SUM(task_resources.Quantity * resources.Price) as ProgrammedCost FROM `task_resources` INNER JOIN resources ON task_resources.ResourceID=resources.ResourceID WHERE ProjectID=projects.ProjectID) as ProgrammedCost FROM projects INNER JOIN users ON projects.UserID=users.UserID WHERE ProjectID='".$mysqli->real_escape_string($_GET["pid"])."'";
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
<script src="js/drawChart2.js"></script>
<script src="js/jquery.fn.gantt.js"></script>
<script src="js/jquery.bootstrap-touchspin.js"></script>
<link href="js/prettify/prettify.min.css" rel="stylesheet" type="text/css">
<script src="js/prettify/prettify.min.js"></script>
<link href="css/gantt.css" type="text/css" rel="stylesheet" />
<script src="js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
<!--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>-->
<link rel="stylesheet" href="js/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="js/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
<style>
#adddays, #actadditemqty{
width: 50px;
}
.fn-gantt *,
.fn-gantt *:after,
.fn-gantt *:before {
    -webkit-box-sizing: content-box;
    -moz-box-sizing: content-box;
    box-sizing: content-box;
}
.notif_table, th td {
   border-top-style:solid;
   border-bottom-style:solid;
   border-width:1px;
   border-color:#c6c6c6;
   font-size:12px;
   padding:5px;
   cursor:pointer;
}
.coloredtr:nth-child(even) {background-color: #d9edf7}
.coloredtr:nth-child(odd) {background-color: #f4f7f9}
.row_activity {border-top: 1px solid #929292}
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
.inside_menu_bar {
    position:relative;
    list-style-type: none;
    margin: 0;
    padding: 0;
    background-color: #378B2E;
    overflow:hidden;
}

.inside_menu_bar li {
    float: left;
}

.inside_menu_bar li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

/* Change the link color to #111 (black) on hover */
.inside_menu_bar li a:hover {
    background-color: #5FAE57;
    cursor:pointer;
}

.inside_menu_bar .selected {
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
           .add_col_task_name{
                width: 20%;
            }
            .add_col_days, .add_col_action{
                width: 4%;
            }
            .add_col_start_date, .add_col_end_date{
                width: 10%;
            }
            .add_col_manpower, .add_col_material{
                width: 23%;
            }
            .add_col_equipment{
                width: 10%;
            }
            .add_row_task.selected{
                background-color: #ecffe6;
            }
<?php if($_SESSION["theuser"]['Type'] == 'client'){?>
#act_list .project_table thead tr th:nth-child(6),#act_list  .project_table thead tr th:nth-child(2),#act_list  .project_table thead tr th:nth-child(3),
#act_list .project_table thead tr th:nth-child(4),#act_list  .project_table thead tr th:nth-child(5){
    display:none;
}
#act_list .project_table tbody tr td:nth-child(6),#act_list  .project_table tbody tr td:nth-child(2),#act_list  .project_table tbody tr td:nth-child(3),
#act_list .project_table tbody tr td:nth-child(4),#act_list  .project_table tbody tr td:nth-child(5){
    display:none;
}
#activities .project_table tbody tr td:nth-child(5),#activities .project_table thead tr th:nth-child(5) , 
#activities .project_table tbody tr td:nth-child(6),#activities .project_table thead tr th:nth-child(6){
    display:none;
}
<?php }?>

#resourcescont .project_table thead{
    color:#30abe7;
    cursor: pointer;
}

</style>
</head>
<body>
<nav style="position:relative;">
<nav style="position:relative;height:50px;background-color: #378B2E;">
    <?php require 'menu.php'?>
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

<div style="padding-left:2%;padding-right:2%;margin-top:20px;">
<div style="width:100%;background-color:#ffffff;border-style:solid;border-width:1px;border-color:#c6c6c6;">
<div class="row" style="margin:10px;">
<div class="col-md-6" style="margin:0px;padding:0px;">

<div style="border-style:solid;border-color:#c6c6c6;border-width:1px;padding:10px;">
<span style="font-size:18px;font-weight:lighter;">Project Information</span>
<hr style="margin-top:5px;margin-bottom:5px;"/>
<table style="width:100%;" class="table_form">
<tr>
<td>Project Name:</td><td id="prjnameindicator" style="color:gray;"><?php echo $project["Name"];?></td>
</tr>
<tr>
<td>Start Date:</td><td id="prjstartdateindicator" rawdate="<?php echo $project["StartDate"];?>" style="color:gray;"><?php echo FormalDateTime($project["StartDate"])[0];?></td>
</tr>
<tr>
<td>End Date:</td><td id="prjenddateindicator" rawdate="<?php echo $project["EndDate"];?>" style="color:gray;"><?php echo FormalDateTime($project["EndDate"])[0];?></td>
</tr>
<tr>
<td>Client Name:</td><td id="prjclientnameindicator" clientid="<?php echo $project["UserID"];?>" style="color:gray;"><?php echo $project["ClientName"];?></td>
</tr>
<tr>
<td>Progress:</td><td id="progressindicator" style="color:gray;"><?php echo round($project["Progress"]);?>%</td>
</tr>
<tr>
<td>Status:</td><td id="statusindicator" style="color:gray;"><?php echo ($project["Status"] == "1" ? "Completed" : "In Progress");?></td>
</tr>
<tr>
<td>Programmed Cost:</td><td id="programmedcostindicator" style="color:gray;">Php. <?php echo ($project["ProgrammedCost"] > 0 ? $project["ProgrammedCost"] : "0.00");?></td>
</tr>
<tr>
<td>Actual Cost:</td><td id="actualcostindicator" style="color:gray;">Php. <?php echo ($project["ProgrammedCost"] > 0 ? $project["ActualCost"] : "0.00");?></td>
</tr>
</table>
</div>

<div style="margin-top:5px;border-style:solid;border-color:#c6c6c6;border-width:1px;padding:10px;">
<span style="font-size:18px;font-weight:lighter;">Project Options</span>
<hr style="margin-top:5px;margin-bottom:5px;"/>
<button class="btn btn-sm btn-success" onclick="printReport()" style="margin-left:10px;" ><span class="glyphicon glyphicon-plus"></span> Print Report</button>
<button id="delprojbtn" class="btn btn-sm btn-danger" style="margin-left:10px;" ><span class="glyphicon glyphicon-plus"></span> Delete Project</button>
<button class="btn btn-sm btn-warning" id="sendreqbtn" style="margin-left:10px;display:none;" ><span class="glyphicon glyphicon-envelope"></span> Modification Request</button>
</div>
</div>
<div class="col-md-6" style="margin:0px;padding:0px;padding-left:10px;">
<div style="width:100%;border-style:solid;border-color:#c6c6c6;border-width:1px;padding:10px;">
<span style="font-size:18px;font-weight:lighter;">Project Progress</span>
<hr style="margin-top:5px;margin-bottom:5px;"/>
<canvas id="myChart" style="width:100%;"></canvas>
</div>
</div>
</div>
<nav style="margin:5px;">
<ul class="inside_menu_bar" style="border-radius:5px;">
<li id="commentsbtn" class="selected"><a>Comments</a></li>
<li id="controlmonitoringbtn"><a>Controlling Monitoring</a></li>
<li id="activitiesbtn"><a>Activities</a></li>
<li id="ganttpreviewbtn"><a>Gantt Chart</a></li>
<li id="filesbtn"><a>Files</a></li>
<li id="resourcesbtn"><a>Resources</a></li>
</nav>
</div>

<div id="comments" style="margin-top:10px;width:100%;padding:5px;background-color:#ffffff;border-style:solid;border-width:1px;border-color:#c6c6c6;">
<span style="font-size:18px;font-weight:lighter;">Project Comments</span>
<hr style="margin-top:5px;margin-bottom:5px;"/>
	<div id="comment_template" style="display:none;">
	<div style="display:table;margin-top:10px;">
		<div style="display:table-row">
			<div style="display:table-cell;vertical-align:top;">
				<!--<img src="http://www.fashatude.com/static/fashatude/img/user_icon.png" style="width:50px;height:50px;border-style:solid;border-color:#c6c6c6;" />-->
			</div>
			<div style="display:table-cell;vertical-align:top;padding-left:5px;width:110px;">
				<label style="margin-bottom:0px;color:green;font-size:12px;">%username%</label>
				<span style="display:block;font-size:11px;color:gray;margin-top:0px;">%date%</span>
				<span style="display:block;font-size:11px;color:gray;margin-top:0px;">%time%</span>
			</div>
			<div style="display:table-cell;vertical-align:middle;padding-left:5px;">
				<p style="font-size:12px;margin:0;padding:0;text-align:justify;">%commentdata%</p>
			</div>
		</div>
	</div>
	</div>
<div id="comments_area" style="height:400px;overflow-y:scroll;">

</div>
	<div id="thecommentbox" style="display:table;margin-top:10px;">
	<div style="width:100%;display:table-row;">
	<div style="display:table-cell;vertical-align:top;">
	<img src="http://www.fashatude.com/static/fashatude/img/user_icon.png" style="width:50px;height:50px;border-style:solid;border-color:#c6c6c6;" />
	</div>
	<div style="display:table-cell;vertical-align:top;padding-left:5px;width:100%;">
	<textarea id="newcommentarea" style="padding:3px;width:100%;border-style:solid;border-color:#c6c6c6;border-width:1px;resize:none;min-height:50px;max-height:150px;outline:none;" placeholder="Write a comment..."></textarea>
	</div>
	</div>
	</div>
</div>

<div id="control_monitor" style="display:none;min-height:300px;margin-top:10px;width:100%;padding:5px;background-color:#ffffff;border-style:solid;border-width:1px;border-color:#c6c6c6;">
<span style="font-size:18px;font-weight:lighter;text-align:center;display:block;width:100%;">Controlling Monitoring</span>
<hr style="margin-top:5px;margin-bottom:5px;"/>
<span style="font-size:18px;font-weight:lighter;">Project Information</span>
<hr style="margin-top:5px;margin-bottom:5px;"/>
<table style="width:100%;" class="table_form">
<tr class='coloredtr'>
<td>Project Name:</td><td id="prjnameindicator2" style="color:gray;"><?php echo $project["Name"];?></td>
</tr>
<tr class='coloredtr'>
<td>Start Date:</td><td id="prjstartdateindicator2" rawdate="<?php echo $project["StartDate"];?>" style="color:gray;"><?php echo FormalDateTime($project["StartDate"])[0];?></td>
</tr>
<tr class='coloredtr'>
<td>End Date:</td><td id="prjenddateindicator2" rawdate="<?php echo $project["EndDate"];?>" style="color:gray;"><?php echo FormalDateTime($project["EndDate"])[0];?></td>
</tr>
<tr class='coloredtr'>
<td>Client Name:</td><td id="prjclientnameindicator2" clientid="<?php echo $project["UserID"];?>" style="color:gray;"><?php echo $project["ClientName"];?></td>
</tr>
<tr class='coloredtr'>
<td>Progress:</td><td id="progressindicator2" style="color:gray;"><?php echo round($project["Progress"]);?>%</td>
</tr>
<tr class='coloredtr'>
<td>Status:</td><td id="statusindicator2" style="color:gray;"><?php echo ($project["Status"] == "1" ? "Completed" : "In Progress");?></td>
</tr>
<tr class='coloredtr'>
<td>Location:</td><td id="locationindicator" style="color:gray;"><?php echo $project["Location"];?></td>
</tr>
<tr class='coloredtr'>
<?php
$lotSize = $project['LotSize'] . ' Square Meters';
if ($project['LotSize'] == 'others'){
    $lotSize =  $project['OtherSize'];
}
?>
<td>Lot Size:</td><td id="statusindicator2" style="color:gray;"><?php echo $lotSize;?></td>
</tr>
<tr class='coloredtr'>
<td >Programmed Cost:</td><td id="programmedcostindicator2" style="color:gray;"></td>
</tr>
<tr class='coloredtr'>
<td>Actual Cost:</td><td id="actualcostindicator2" style="color:gray;"></td>
</tr>
</table>

	<div id="act_list" style="margin-top:5px;">
	</div>
</div>

<div id="gantt_preview" style="display:none;margin-top:10px;width:100%;padding:5px;background-color:#ffffff;border-style:solid;border-width:1px;border-color:#c6c6c6;">
<span style="font-size:18px;font-weight:lighter;">Gantt Preview</span>
<hr style="margin-top:5px;margin-bottom:5px;"/>
<div id="chart_div" style="width:100%;"></div>
</div>

<div id="activities" style="position:relative;display:none;margin-top:10px;width:100%;padding:5px;background-color:#ffffff;border-style:solid;border-width:1px;border-color:#c6c6c6;min-height:300px;">
<span style="font-size:18px;font-weight:lighter;">Project Activities</span><button id="addactbtnm" class="btn btn-sm btn-warning " style="margin-left:10px;" onclick="addAct()"><span class="glyphicon glyphicon-plus"></span> Add Activity</button>
<hr style="margin-top:5px;margin-bottom:5px;"/>
<table class="project_table" style="width:100%;">
<thead>
<tr>
<th>Activity/Task</th>
<th>Duration</th>
<th>Start Date</th>
<th>End Date</th>
<th>Total Item Price</th>
<th>Options</th>
</tr>
</thead>
<tbody id="activityview">
</tbody>
</table>
<div style="width:100%;text-align:right;padding-left:10px;padding-right:10px;">
<div style="display:inline-block;margin-top:10px;margin-bottom:10px;padding:10px;border-style:solid;border-color:#c6c6c6;border-width:1px;box-shadow:0px 0px 3px black;">Total Price: <span id="totalpriceview" style="color:gray;">Php. 1000</span></div>
</div>
</div>

<div id="projectfiles" style="display:none;margin-top:10px;width:100%;padding:5px;background-color:#ffffff;border-style:solid;border-width:1px;border-color:#c6c6c6;min-height:300px;">
<span style="font-size:18px;font-weight:lighter;">Project Files</span><button id="addfilesbtnm" class="btn btn-sm btn-warning" style="margin-left:10px;" onclick="addFile()"><span class="glyphicon glyphicon-plus"></span> Add Files</button>
<hr style="margin-top:5px;margin-bottom:5px;"/>
<table class="project_table" style="width:100%;">
<thead>
<tr>
<th>File Name</th>
<th>Size</th>
<th>Type</th>
<th>Uploaded Date</th>
<th>Options</th>
</tr>
</thead>
<tbody id="filesview">
</tbody>
</table>
</div>

<div id="resourcescont" style="display:none;margin-top:10px;width:100%;padding:5px;background-color:#ffffff;border-style:solid;border-width:1px;border-color:#c6c6c6;min-height:300px;">
<span style="font-size:18px;font-weight:lighter;"><?php echo $project["Name"];?> <span id="overallresourcesprice" style="font-size:12px;color:gray;font-weight:normal;">Php. 1,000</span></span>
<hr style="margin-top:5px;margin-bottom:5px;"/>
<table class="project_table" style="width:100%;">
<thead>
<tr>
    <th><span class ="glyphicon glyphicon-chevron-down"> </span>Resource Name</th>
<th>Quantity</th>
<th>Price</th>
</tr>
</thead>
<tbody id="allresourcestbl">
</tbody>
</table>
<div id="currentacts"></div>
</div>

</div>

        <div class="modal fade" id="addActivityModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document" style="width:80%; max-height: 80%;overflow:auto; ">
                <div class="modal-content" style="overflow:hidden">
                    <div class="modal-header" style="background-color:#55AA55;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="color:white;"><span id="theModalTask">- - -</span></h4>
                    </div>
                    <input type="hidden" id="temporaryid" value="0"/>
                    <input type="hidden" id="hiddenactivityid" value="0"/>
                    
                    <div class="modal-body">
                        <table class="form_table">
                            <tr>
                                <td><label>Activity Name:</label></td><td style="padding-left:5px;"><input id="actname" type="text" style="width:250px;" /></td>
                            </tr>
                        </table>
                       <hr style="margin-top:5px;margin-bottom:5px;"/>
                        <table class="table_form task_form" style="display:none;"> 
                            <tr>
                                <td><label>Task Name:</label></td><td style="padding-left:5px;"><input id="addtaskname" type="text" style="width:250px;" /></td>
                                <td><label>Days:</label></td><td style="padding-left:5px;"><input id="adddays" type="text" /></td>
                            </tr>
                            <tr>
                                <td><label>Parent Task:</label></td><td><select id="addparent"  style="margin-left:5px;width:250px;"></select></td>
                                
                            </tr>
                            <tr>
                                <td><label>Start Date:</label></td><td style="padding-left:5px;"><input id="addstartdate" type="text" style="width:250px;" readonly="readonly"/></td>
                                <td><label>End Date:</label></td><td style="padding-left:5px;"><input id="addenddate" type="text" style="width:250px;" /></td>
                            </tr>
                            <tr>
                                <td><input id="addnotify" type="checkbox"/><label for="addnotify" >Notify Client</label></td>
                            </tr>
                            <tr id="tdnotify" style="display:none;">
                                <td colspan="6">
<textarea rows="10" cols="100" id="addmessage">

</textarea>
                                </td>
                            </tr>
                            <tr style="display:none;">
                                <td colspan="6">
<textarea rows="10" cols="100" id="addmessagetemplate">
Good day %clientNameHolder%,

Please be reminded that your presence is required to be at %locationHolder% on %startDateHolder% for the %taskNameHolder% Task.

Thank you and looking forward to seeing you.

<?php echo getCompleteType($_SESSION["theuser"]['Type'])?>

<?php echo $_SESSION["theuser"]['Name']?>
</textarea>
                                </td>
                            </tr>
                        </table>
                        <input type="hidden" id="addhiddenid"/>
                        <input type="hidden" id="addeditid"/>
                        <button type="button" id="addtaskbutton" data-mode="none" class="btn btn-success btn-sm">Add Task</button>
                        <button id="canceltaskbutton" class="btn btn-danger task_form btn-sm" style="display:none;">Cancel</button>
                        <hr style="margin-top:5px;margin-bottom:5px;"/>
                        <span style="font-size:18px;font-weight:lighter;">Activity Tasks</span>
                        <hr style="margin-top:5px;margin-bottom:5px;"/>
                        <table class="project_table add_task_table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th class = 'add_col_task_name'>Task Name</th>
                                    <th class = 'add_col_days'>Days</th>
                                    <th class = 'add_col_start_date'>Start Date</th>
                                    <th class = 'add_col_end_date'>End Date</th>
                                    <th class = 'add_col_manpower'>Manpower</th>
                                    <th class = 'add_col_material'>Materials</th>
                                    <th class = 'add_col_equipment'>Equipment</th>
                                    <th class = 'add_col_action'></th>
                                </tr>
                            </thead>
                            <tbody id="addtasktable">
                            </tbody>
                        </table>
                        <div style="margin-top:20px;">
                            <span style="font-size:18px;font-weight:lighter;">Add Items</span>
                            <table class="project_table" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th class = 'add_col_action'></th>
                                    </tr>
                                </thead>
                                <tbody id="addprjitms">
                                </tbody>
                            </table>
                            <hr style="margin-top:5px;margin-bottom:5px;"/>
                            <table class="table_form">
                                <tr>
                                    <td><label>Item Name:</label></td><td><select id="actadditem" style="width:200px;margin-left:5px;"><option value="">-- Select Item --</option></select></td>
                                </tr>
                                <tr>
                                    <td><label>Quantity:</label></td><td><input id="actadditemqty" type="text"/></td>
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

<div class="modal fade" id="ganttModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width:80%;">
    <div class="modal-content" style="overflow:hidden">
      <div class="modal-header" style="background-color:#55AA55;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" style="color:white;"><span>Simulate Gantt</span></h4>
      </div>
      <div class="modal-body">
      		<h4 style="color:gray;">Original Gantt</h4>
      		<div id="gantt_orig" style="width:100%;"></div>
      		<h4 style="color:gray;">Simulated Gantt</h4>
      		<div id="gantt_sim" style="width:100%;"></div>
		</div>
      <div class="modal-footer">
        <button id="closesim" type="button" class="btn btn-success">Close</button>
      </div>
    </div>
  </div>
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
      	<td><label>Subject:</label></td><td><input id="subjectmsg" type="text" style="width:100%;" /></td>
      	</tr>
      	<tr>
      	<td><label>Message:</label></td><td><textarea id="themsg" type="text" style="width:100%;height:200px;resize:none;margin-top:10px;border-color:#c6c6c6;border-width:1px;border-style:solid;"></textarea></td>
      	</tr>
      	</table>
		</div>
      <div class="modal-footer">
      	<button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
        <button id="sendreq" type="button" class="btn btn-success">Send</button>
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
        <a id="okbtn" type="button" class="btn btn-success" style="border-radius:0px;" data-dismiss="modal" >OK</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="overflow:hidden">
      <div class="modal-header" style="background-color:#55AA55;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" style="color:white;" id="myModalLabel">Upload Project File</h4>
      </div>
      <div class="modal-body">
        <div id="uploaderror" class="alert alert-danger" style="border-radius:0px;font-size:12px;display:none;"></div>
        <form id="uploadForm" onsubmit="return false;">
        <table class="form_table" style="width:100%;">
        <tr>
            <td style="padding-top:0px;">
        <label style="color:gray;">Type:</label>
        <input type="text" id="fileType" name="type" placeholder="(Auto Generated)" style="padding-left:5px;padding-right:5px;width:100%;border-style:solid;border-color:#c6c6c6;border-width:1px;border-radius:0px;" readonly/>
            </td>
        </tr>
        </table>
        <table style="width:100%;margin-top:10px;">
         <tr>
            <td style="width:50px;"><button id="choosefile" class="btn btn-primary btn-sm" style="border-radius:0px;">FILE</button></td>
            <td><input id="filename" name="filename" type="text" placeholder="Please choose a file..." style="padding-left:5px;padding-right:5px;color:gray;width:100%;border-style:solid;border-color:#c6c6c6;border-width:1px;border-radius:0px;" readonly/></td>
        </tr>
        </table>
        </form>
        <input id="theFile" type="file" style="visibility:hidden;height:0px;width:0px;" />
      </div>
      <div class="modal-footer">
        <button onclick="clearuploadfields();" style="border-radius:0px;" class="btn btn-default">Cancel</button>
        <button id="uploadnow" style="border-radius:0px;" class="btn btn-success">Upload File</button>
      </div>
    </div>
  </div>
</div>


<footer>
<p style="text-align:center;">&copy; 2016 E.V.Y. Corporation</p>
</footer>
</body>
<script>
ProjectID = '<?php echo $project["ProjectID"];?>';
</script>
<script src="js/viewproj.js"></script>
<script>
<?php
 $completed = round($project["Progress"]);
 $inprogress = 100 - $completed;
 echo "updatePie(".$inprogress.", ".$completed.");"
?>
</script>
</html>