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
        <script src="js/addproject.js"></script>
        <script src="js/drawChart.js"></script>
        <script src="js/project.js"></script>
        <script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
        <script src="js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
        <script src="js/jquery.fn.gantt.js"></script>
        <script src="js/jquery.bootstrap-touchspin.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.css" rel="stylesheet" type="text/css">
        <script src="http://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.js"></script>
        <link href="css/gantt.css" type="text/css" rel="stylesheet" />

        <style>
            #adddays, #actadditemqty{
                width: 50px;
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
            .fn-gantt *,
            .fn-gantt *:after,
            .fn-gantt *:before {
                -webkit-box-sizing: content-box;
                -moz-box-sizing: content-box;
                box-sizing: content-box;
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
            .row_activity{
                border-top: 1px #c6c6c6 solid;
            }
            .col_activity{
                width: 9%;
            }
            .col_task_name{
                width: 10%;
            }
            .col_days{
                width: 5%;
            }
            .col_start_date, .col_end_date{
                width: 8%;
            }
            .col_manpower, .col_material{
                width: 30%;
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
                width: 28%;
            }
            .add_row_task.selected{
                background-color: #ecffe6;
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
                        <td><label>Project Location:</label></td><td><input id="prjlocation" type="text" style="width:200px;margin-left:5px;" /></td>
                    </tr>
                    <tr>
                        <td><label>Start Date:</label></td><td><input id="prjstartdate" type="text" style="width:200px;margin-left:5px;" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td><label>End Date:</label></td><td><input id="prjenddate" type="text" style="width:200px;margin-left:5px;" /></td>
                    </tr>
                    <tr>
                        <td><label>Client:</label></td><td><select id="prjclient" type="text" style="margin-left:5px;width:200px;"><option value="">-- Select Client --</option></select></td>
                    </tr>
                    <tr>
                        <td><label>Project Type:</label></td><td><select id="prjtype" type="text" style="margin-left:5px;width:200px;">
                                <option value="">-- Select Project Type --</option>
                                <option value="1storeybuilding">1 Storey Building</option>
                                <option value="2storeybuilding">2 Storey Building</option>
                                <option value="3storeybuilding">3 Storey Building</option>
                            </select></td>
                    </tr>
                    <input type="text" id="hiddenactivityid" value="0"/>
                </table>
            </div>

            <div style="margin-top:10px;width:100%;padding:5px;background-color:#ffffff;border-style:solid;border-width:1px;border-color:#c6c6c6;min-height:300px;">
                <span style="font-size:18px;font-weight:lighter;">Project Activities</span>
                <button class="btn btn-sm btn-warning" style="margin-left:10px;" id="addActivityButton"><span class="glyphicon glyphicon-plus"></span> Add Activity</button>
                <hr style="margin-top:5px;margin-bottom:5px;"/>
                <table class="project_table" id="main_project_table" style="width:100%;">
                    <thead>
                        <tr>
                            <th class = 'col_activity'>Activity</th>
                            <th class = 'col_task_name'>Task Name</th>
                            <th class = 'col_days'>Days</th>
                            <th class = 'col_start_date'>Start Date</th>
                            <th class = 'col_end_date'>End Date</th>
                            <th class = 'col_manpower'>Manpower</th>
                            <th class = 'col_material'>Materials</th>
                        </tr>
                    </thead>
                    <tbody id="activityview">
                    </tbody>
                </table>
            </div>

            <div style="margin-top:10px;width:100%;padding:5px;background-color:#ffffff;border-style:solid;border-width:1px;border-color:#c6c6c6;">
                <span style="font-size:18px;font-weight:lighter;">Gantt Preview</span>
                <hr style="margin-top:5px;margin-bottom:5px;"/>
                <div id="chart_div" ></div>
            </div>

            <div style="width:100%;padding:5px;background-color:#ffffff;border-style:solid;border-color:#c6c6c6;border-width:1px;margin-top:10px;">
                <button id="addprjbtn" class="btn btn-success">Add Project</button><button class="btn btn-danger" style="margin-left:5px;">Cancel</button>
            </div>

        </div>

        <footer>
            <p style="text-align:center;">&copy; 2016 E.V.Y. Corporation</p>
        </footer>

        <!-- this is for the project only -->

<!--        <div class="modal fade" id="addActModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
        </div>-->

        <div class="modal fade" id="addActivityModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document" style="width:80%; max-height: 80%;overflow:auto; ">
                <div class="modal-content" style="overflow:hidden">
                    <div class="modal-header" style="background-color:#55AA55;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="color:white;"><span id="theModalTask">- - -</span></h4>
                    </div>
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
                                <td><label>Start Date:</label></td><td style="padding-left:5px;"><input id="addstartdate" type="text" style="width:250px;" readonly="readonly"/></td>
                                <td><label>End Date:</label></td><td style="padding-left:5px;"><input id="addenddate" type="text" style="width:250px;" /></td>
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
    </body>
</html>