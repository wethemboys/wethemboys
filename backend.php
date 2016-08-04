<?php
	// PROJECT MANAGEMENT SYSTEM
	// VERSION 1.0
        error_reporting(0);
// LOGIN CHECK
session_name('evypms');
session_start();
header("Content-Type: text/json");

//
//$mysqli = new mysqli("localhost", "root", "", "evypms");
//$return = updatePercentage(1 ,2 );
//echo '<pre>';updatePercentage
//    print_r($return);
//echo '</pre>';
//die();
//die();
function dexit($errorcode) {
	die(json_encode(array("success"=>false,"error"=>$errorcode)));
}

if (!isset($_SESSION["login"]) || empty($_SESSION["login"]) ||  $_SESSION["login"] !== true) {
	// user not login
	dexit("1");
}

$mysqli = new mysqli("localhost", "root", "", "evypms");

function is_json($input) {
    $input = trim($input);
    if (substr($input,0,1)!='{' OR substr($input,-1,1)!='}')
        return false;
    return is_array(@json_decode($input, true));
}

function insertsql($table, $columns, $values) {
	global $mysqli;
	$query = "INSERT INTO ".$table." (";
	$colcount = count($columns);
	for ($i = 0; $i < $colcount; $i++) {
		$query .= $columns[$i].", ";
	}
	$query = substr($query, 0, -2).") VALUES (";
	$valcount = count($values);
	for ($i = 0; $i < $valcount; $i++) {
		$query .= "'".$mysqli->real_escape_string($values[$i])."', ";
	}
	return substr($query, 0, -2).")";
}
function get_manpower_if_outsource($resourceid,$startdate,$enddate,$taskresid,$qty){
    	global $mysqli;
                $setMax = true;
		$query = "select task.Done, task_resources.TaskResId,task_resources.Quantity,task.StartDate,task.EndDate
                    ,(select Quantity from resources where resources.ResourceID ='".$resourceid."' )as `Max`
from task_resources left join task on task_resources.TaskId = task.TaskID 
where task_resources.ResourceID ='".$resourceid."' 
AND '".$startdate."' BETWEEN task.StartDate AND task.EndDate
AND '".$enddate."' BETWEEN task.StartDate AND task.EndDate
AND task.Done != 1
order by task_resources.TaskResId asc";
		$qq = $mysqli->query($query);
		if ($qq->num_rows > 0) {
			
			while ($row = $qq->fetch_assoc()) {

                            if($setMax){
                                $max = $row['Max'];
                                $setMax=false;
                            }
                            
				if($taskresid == $row['TaskResId'])
                                    break;
                                $max = $max - $row['Quantity'];
			}
                        if($max >= $qty){
                            return  $qty ;
                        }
                        if($max <= 0){
                            $quantity = $max - $qty;
                        }else{
                            $quantity = $qty - $max ;
                        }
                        $quantity = $quantity < 0 ? 0 : $quantity;
                        $outsource =$qty- $quantity ;
                        $outsource = $outsource < 0 ? 0 : $outsource;
                        return $quantity . '/ <span style="color:red;" > ' . $outsource .'</span>';
		} else {
			return  $qty ;
		}
}
function updatesql($table, $columns, $values, $where) {
	global $mysqli;
	$query = "UPDATE ".$table." SET ";
	$colcount = count($columns);
	for ($i = 0; $i < $colcount; $i++) {
		$query .= $columns[$i]."='".$mysqli->real_escape_string($values[$i])."', ";
	}
	$query = substr($query, 0, -2);
	return $query . " WHERE ".$where[0]."='".$mysqli->real_escape_string($where[1])."'";
}
function updatePercentage($projectid, $activityid = 0){

    $return['project'] = updatePercentageProject($projectid );
    $return['activity'] =[];
    $return['activity'] = updatePercentageActivity($projectid, $activityid);
    
    return $return;
}
function updatePercentageProject($projectid) {
	global $mysqli;
	$totaldays = $mysqli->query("select count(*) TotalTask from task where ProjectID ='".$mysqli->real_escape_string($projectid)."'");
        if ($totaldays->num_rows > 0) {
		$totaldays = $totaldays->fetch_assoc();
		$totaldays = $totaldays["TotalTask"];
	}
        if($totaldays !=0){
            $daysDone = $mysqli->query("select count(*) TotalTaskDone  from task where ProjectID ='".$mysqli->real_escape_string($projectid)."'  and Done =1");
            if ($daysDone->num_rows > 0) {
                    $daysDone = $daysDone->fetch_assoc();
                    $progress = $daysDone["TotalTaskDone"] / $totaldays * 100;
                    if ($progress == 100) {
                            $query = "UPDATE projects SET Status=1, Progress='100' WHERE ProjectID='".$mysqli->real_escape_string($projectid)."'";
                    } else {
                            $query = "UPDATE projects SET Status=0, Progress='".$mysqli->real_escape_string($progress)."' WHERE ProjectID='".$mysqli->real_escape_string($projectid)."'";
                    }
                    $mysqli->query($query);
            }
            else{
                $query = "UPDATE projects SET Status=0, Progress='0' WHERE ProjectID='".$mysqli->real_escape_string($projectid)."'";
                $mysqli->query($query);
            }
        }
        $query = "select Name, Progress from projects WHERE ProjectID='".$mysqli->real_escape_string($projectid)."'";
	$returnquery=$mysqli->query($query);

        $return = $returnquery->fetch_assoc();
	return $return;
}

function updatePercentageActivity($projectid, $activityid) {
	global $mysqli;
	$totaldays = $mysqli->query("select count(*) TotalTask  from task where ActivityID ='".$mysqli->real_escape_string($activityid)."'");
        if ($totaldays->num_rows > 0) {
		$totaldaysassoc = $totaldays->fetch_assoc();
		$totaldays = $totaldaysassoc["TotalTask"];
	}
        if($totaldays !=0){
            $daysDone = $mysqli->query("select count(*) TotalTaskDone  from task where ActivityID ='".$mysqli->real_escape_string($activityid)."'  and Done =1");
            if ($daysDone->num_rows > 0) {
                    $daysDone = $daysDone->fetch_assoc();
                    $progress = $daysDone["TotalTaskDone"] / $totaldays * 100;
                    if ($progress == 100) {
                            $query = "UPDATE activities SET Done=1, Progress='100' WHERE ActivityID='".$mysqli->real_escape_string($activityid)."'";
                    } else {
                            $query = "UPDATE activities SET Done=0, Progress='".$mysqli->real_escape_string($progress)."' WHERE ActivityID='".$mysqli->real_escape_string($activityid)."'";
                    }
                    $mysqli->query($query);

            }
            else{
                $query = "UPDATE activity SET Done=0, Progress='0' WHERE ActivityID='".$mysqli->real_escape_string($activityid)."'";
                $mysqli->query($query);
            }
        }
        $return =[];
        $query = "select Name, Progress from activities WHERE ProjectID='".$mysqli->real_escape_string($projectid)."'";
	$returnquery=$mysqli->query($query);

        while ($qqRow = $returnquery->fetch_assoc()) {
            array_push($return, $qqRow);
        }
	return $return;
}

function updateEndDate($taskId, $startdate) {
	global $mysqli;
	$task = $mysqli->query("select *  from task where Parent ='".$mysqli->real_escape_string($taskId)."'");
        while ($row = $task->fetch_assoc()) {
		$query = "UPDATE task set StartDate=ADDDATE(date('".$startdate."') , 1 ),EndDate=ADDDATE(date('".$startdate."') , Days ) where TaskID=  '".$row['TaskID']."'";
		$mysqli->query($query);
                
		$query = "SELECT DATE_FORMAT(EndDate,'%Y-%m-%d') EndDate,TaskId from task WHERE Parent='".$mysqli->real_escape_string($taskId)."'";
		$qq = $mysqli->query($query);
		if ($qq->num_rows > 0) {
                        while ($qqRow = $qq->fetch_assoc()) {
                            updateEndDate($qqRow["TaskId"], $qqRow["EndDate"]);
                        }
		}
        }
}

$jsr = file_get_contents("php://input");
if (!is_json($jsr)) {
	// not json
	dexit(0);
}
$jsr = json_decode($jsr, true);
if (!isset($jsr["do"]) || empty($jsr["do"])) {
	// no instructions
	dexit(0);
}

switch($jsr["do"]) {
	case "add_project":
            
            $activities = json_decode($jsr['activities']);
            $temporary_id = array();
		if (!isset($jsr["name"]) || empty($jsr["name"]) || !isset($jsr["userid"]) || empty($jsr["userid"]) || !isset($jsr["startdate"]) || empty($jsr["startdate"]) || !isset($jsr["enddate"]) || empty($jsr["enddate"])) {
			dexit(1);
		}
		$query = insertsql("projects", 
                        array("Name", "StartDate", "EndDate", "UserID", "Status","Location","ProjectType","LotSize","OtherSize"), 
                        array($jsr["name"], $jsr["startdate"], $jsr["enddate"], $jsr["userid"], 0,$jsr["location"],$jsr["type"],$jsr["size"],$jsr["othersize"]));
		$mysqli->query($query);
		$pid = $mysqli->insert_id;
                foreach($activities as $activity)
                {
                    $query = insertsql("activities", array("ProjectID", "Name", "StartDate", "EndDate", "Weight", "ClientNeeded"), array($pid, $activity->name, $activity->startdate, $activity->enddate, 0, 0));
                    $mysqli->query($query);
                    $actid = $mysqli->insert_id;
                    foreach ($activity->tasks as $tasks)
                    {
                        $parent = '';
                        if(isset($temporary_id[$tasks->parentid])){
                            $parent = $temporary_id[$tasks->parentid];
                        }
                        $query = insertsql("task", 
                                array("ProjectID","ActivityID", "Name", "StartDate", "EndDate","PreStartDate", "PreEndDate", "Days","Parent", "ClientNeeded","Message"),
                                array($pid,$actid, $tasks->label, $tasks->from, $tasks->to,$tasks->from, $tasks->to, $tasks->days, $parent,  $tasks->notify,$tasks->message));
                        $mysqli->query($query);
                        $taskid = $mysqli->insert_id;
                        $temporary_id[$tasks->temporaryid] = $taskid;
                        
                        $resources_array = array_merge($tasks->manpower,$tasks->material,$tasks->equipment);
                        foreach($resources_array as $resources)
                        {
                            $query = insertsql("task_resources",
                                    array("ProjectID", "TaskId", "ResourceID", "Quantity", "Remaining"),
                                        array($pid,$taskid, $resources->id, $resources->quantity,$resources->quantity));
                            $mysqli->query($query);
                        }
                    }
                }
		die(json_encode(array("success"=>true)));
	break;

	case "edit_project":
		if (!isset($jsr["projectid"]) || empty($jsr["projectid"]) || !isset($jsr["name"]) || empty($jsr["name"]) || !isset($jsr["userid"]) || empty($jsr["userid"]) || !clientExist($jsr["clientid"]) || !isset($jsr["startdate"]) || empty($jsr["startdate"]) || !isset($jsr["enddate"]) || empty($jsr["enddate"])) {
			dexit(1);
		}

		if ($_SESSION["theuser"]["Type"] !== "admin") {
			$query = insertsql("notifications", array("UserID", "Type", "RequestData", "ToUser"), array($_SESSION["theuser"]["UserID"], $jsr["do"], json_encode($jsr), "0"));
			$mysqli->query($query);
		}

		$query = updatesql("projects", array("Name", "StartDate", "EndDate", "UserID"), array($jsr["name"], $jsr["startdate"], $jsr["enddate"], $jsr["userid"]), array("ProjectID", $jsr["projectid"]));
		$mysqli->query($query);
		die(json_encode(array("success"=>true)));
	break;
        
	case "edit_project":
		if (!isset($jsr["projectid"]) || empty($jsr["projectid"]) || !isset($jsr["name"]) || empty($jsr["name"]) || !isset($jsr["userid"]) || empty($jsr["userid"]) || !clientExist($jsr["clientid"]) || !isset($jsr["startdate"]) || empty($jsr["startdate"]) || !isset($jsr["enddate"]) || empty($jsr["enddate"])) {
			dexit(1);
		}

		if ($_SESSION["theuser"]["Type"] !== "admin") {
			$query = insertsql("notifications", array("UserID", "Type", "RequestData", "ToUser"), array($_SESSION["theuser"]["UserID"], $jsr["do"], json_encode($jsr), "0"));
			$mysqli->query($query);
		}

		$query = updatesql("projects", array("Name", "StartDate", "EndDate", "UserID"), array($jsr["name"], $jsr["startdate"], $jsr["enddate"], $jsr["userid"]), array("ProjectID", $jsr["projectid"]));
		$mysqli->query($query);
		die(json_encode(array("success"=>true)));
	break;
        
	case "addfile":
		if (!isset($jsr["filename"]) || empty($jsr["filename"]) || !isset($jsr["type"]) || empty($jsr["type"]) || !isset($jsr["projectid"]) || empty($jsr["projectid"]) || !isset($jsr["file"]) || empty($jsr["file"])) {
			die(json_encode(array("success"=>false)));
		}
		$ftype = explode(".", $jsr["filename"]);
		$ftype = $ftype[(count($ftype) - 1)];
		$filex = base64_decode(preg_replace('#data:[^;]+/[^;]+;base64,#', '', $jsr["file"]));
		$filename = uniqid().uniqid($_SESSION["theuser"]["UserID"]) . "." . $ftype;
		if (!file_put_contents("projectfiles/" . $filename, $filex)) {
			die(json_encode(array("success"=>false)));
		}
		$theFile = $mysqli->real_escape_string($filename);
		$query = "INSERT INTO files (ProjectID, Name, Type, FileName, UserID) VALUES ('".$mysqli->real_escape_string($jsr["projectid"])."',  '".$mysqli->real_escape_string($jsr["filename"])."', '".$mysqli->real_escape_string($jsr["type"])."', '".$theFile."', '".$_SESSION["theuser"]["UserID"]."')";
		$mysqli->query($query);
		$query = "SELECT * FROM files WHERE FileID='".$mysqli->insert_id."'";
		$filequery = $mysqli->query($query)->fetch_assoc();
		foreach ($filequery as $key=>$value) {
			$fileret[$key] = $value;
		}
		$fileret["success"] = true;
		die(json_encode($fileret));
	break;

	case "delete_project":
		if (!isset($jsr["projectid"]) || empty($jsr["projectid"])) {
			dexit(1);
		}
		$query = "DELETE FROM projects WHERE ProjectID='".$mysqli->real_escape_string($jsr["projectid"])."'";
		$mysqli->query($query);
		$query = "DELETE FROM activities WHERE ProjectID='".$mysqli->real_escape_string($jsr["projectid"])."'";
		$mysqli->query($query);
		$query = "DELETE FROM activities_resources WHERE ProjectID='".$mysqli->real_escape_string($jsr["projectid"])."'";
		$mysqli->query($query);
		$query = "DELETE FROM files WHERE ProjectID='".$mysqli->real_escape_string($jsr["projectid"])."'";
		$mysqli->query($query);
		$query = "DELETE FROM comments WHERE ProjectID='".$mysqli->real_escape_string($jsr["projectid"])."'";
                $mysqli->query($query);
		$query = "DELETE FROM notifications WHERE ProjectID='".$mysqli->real_escape_string($jsr["projectid"])."'";
                $mysqli->query($query);
		$query = "DELETE FROM task WHERE ProjectID='".$mysqli->real_escape_string($jsr["projectid"])."'";
                $mysqli->query($query);
		$query = "DELETE FROM task_resources WHERE ProjectID='".$mysqli->real_escape_string($jsr["projectid"])."'";
		$mysqli->query($query);
		die(json_encode(array("success"=>true)));
	break;

	case "getproject":
		if (!isset($jsr["projectid"]) || empty($jsr["projectid"])) {
			dexit(1);
		}
		$query = "SELECT projects.*, users.Name as ClientName, (SELECT SUM(task_resources.Used * resources.Price) as ActualCost FROM `task_resources` INNER JOIN resources ON task_resources.ResourceID=resources.ResourceID WHERE ProjectID=projects.ProjectID) as ActualCost, (SELECT SUM(task_resources.Quantity * resources.Price) as ProgrammedCost FROM `task_resources` INNER JOIN resources ON task_resources.ResourceID=resources.ResourceID WHERE ProjectID=projects.ProjectID) as ProgrammedCost FROM projects INNER JOIN users ON projects.UserID=users.UserID WHERE ProjectID='".$mysqli->real_escape_string($jsr["projectid"])."'";
		$qq = $mysqli->query($query);
		if ($qq->num_rows > 0) {
			$project = $qq->fetch_assoc();
			$project["activities"] = array();
			$query = "SELECT task.*,activities.name Activity, (SELECT SUM(task_resources.Used * resources.Price) as ActualCost FROM `task_resources` INNER JOIN resources ON task_resources.ResourceID=resources.ResourceID WHERE task_resources.TaskID=task.TaskID) as ActualCost, (SELECT SUM(task_resources.Quantity * resources.Price) FROM task_resources INNER JOIN resources ON task_resources.ResourceID=resources.ResourceID WHERE task_resources.TaskID=task.TaskID) as ProgrammedCost FROM task LEFT JOIN activities on task.ActivityID =activities.ActivityID WHERE task.ProjectID='".$mysqli->real_escape_string($project["ProjectID"])."'";
			$qq = $mysqli->query($query);
			if ($qq->num_rows > 0) {
				$c = 0;
				while ($activity = $qq->fetch_assoc()) {
					$project["activities"][$c] = $activity;
					$query = "SELECT task_resources.*,IFNULL((Select t.Quantity from task_resources t where t.TaskID='".$activity["TaskID"]."'  and t.Additional = 1 and t.ResourceID = task_resources.ResourceID),'-') AddedQuantity ,resources.Name as ResourceName, resources.Type as ResourceType,resources.Price as ResourcePrice FROM `task_resources` INNER JOIN resources ON task_resources.ResourceID=resources.ResourceID WHERE TaskID='".$mysqli->real_escape_string($activity["TaskID"])."'  and Additional != 1 ";
					$project["activities"][$c]["resources"] = array();
					$qqd = $mysqli->query($query);
					if ($qqd->num_rows > 0) {
						$d = 0;
						while ($res = $qqd->fetch_assoc()) {

                                                        if($res['ResourceType'] == 'manpower'){
                                                            $res['QuantityText'] = get_manpower_if_outsource($res['ResourceID'],$activity["StartDate"],$activity["EndDate"],$res['TaskResID'],$res['Quantity']);
//                                                            echo '<pre>';
//                                                            print_r($res['QuantityText'] );
//                                                            echo '</pre>';
//                                                  
                                                        }else{
                                                            $res['QuantityText'] =$res['Quantity'] ;
                                                        }
							$project["activities"][$c]["resources"][$d] = $res;
							$d++;
						}
					}
                                        $project["activities"][$c]["additional"] = array();
                                        $query = "select Reason,TaskAddID,TaskID from task_resources_additional where TaskID = '".$mysqli->real_escape_string($activity["TaskID"])."'";
                                        $taskadd = $mysqli->query($query);
                                        if ($qq->num_rows > 0) {
                                                $d = 0;
                                                while ($taskaddrow = $taskadd->fetch_assoc()) {
                                                    $project["activities"][$c]["additional"][$d] = $taskaddrow;
                                                    $query = "SELECT task_resources.*,task_resources_additional.Reason,resources.Type as ResourceType, resources.Name as ResourceName, resources.Price as ResourcePrice FROM `task_resources_additional` INNER JOIN task_resources ON task_resources_additional.TaskAddID=task_resources.TaskAddID INNER JOIN resources ON task_resources.ResourceID=resources.ResourceID WHERE task_resources_additional.TaskAddID='".$taskaddrow["TaskAddID"]."' ";
                                                    
                                                    $qqd = $mysqli->query($query);
                                                    $project["activities"][$c]["additional"][$d]["items"] = array();
                                                    if ($qqd->num_rows > 0) {
                                                            $e = 0;
                                                            while ($res = $qqd->fetch_assoc()) {
                                                                     $project["activities"][$c]["additional"][$d]["items"][$e] = $res;
                                                                    $e++;
                                                            }
                                                    }
                                                    $d++;
                                                }
                                        
                                        }
				$c++;
				}
			} 
			die(json_encode($project, JSON_PRETTY_PRINT));
		} else {
			dexit(1);
		}
	break;

	case "list_files":
		$query = "SELECT files.*, users.Name as UploaderName FROM files INNER JOIN users ON users.UserID=files.UserID where ProjectId= '".$mysqli->real_escape_string($jsr["projectid"])."'";
		$ff = $mysqli->query($query);
		if ($ff->num_rows > 0) {
			$files = array();
			$f = 0;
			while ($file = $ff->fetch_assoc()) {
				foreach ($file as $key=>$value) {
					$files[$f][$key] = $value;
				}
				$files[$f]["Size"] = filesize("projectfiles/".$file["Filename"]);
				$f++;
			}
			die(json_encode($files));
		} else {
			die("[]");
		}
	break;

	case "delete_file":
		if (!isset($jsr["fileid"]) || empty($jsr["fileid"])) {
			dexit(1);
		}
		$query = "SELECT * FROM files WHERE FileID='".$mysqli->real_escape_string($jsr["fileid"])."'";
		$qq = $mysqli->query($query);
		if ($qq->num_rows > 0) {
			$file = $qq->fetch_assoc();
			$query = "DELETE FROM files WHERE FileID='".$mysqli->real_escape_string($jsr["fileid"])."'";
			$mysqli->query($query);
			unlink("projectfiles/".$file["Filename"]);
			die(json_encode(array("success"=>true)));
		} else {
			dexit(2);
		}
	break;

	case "get_current_activity":
		if (!isset($jsr["projectid"]) || empty($jsr["projectid"])) {
			dexit(1);
		}
		$query = "SELECT * FROM task WHERE CURDATE() >= StartDate AND ProjectID='".$mysqli->real_escape_string($jsr["projectid"])."'";
		$qqx = $mysqli->query($query);
		if ($qqx->num_rows > 0) {
			$c = 0;
			while ($acts = $qqx->fetch_assoc()) {
				$curact[$c] = $acts;
				$curact[$c]["resources"] = array();
				$query = "SELECT task_resources.*, resources.Name as ResourceName, resources.Price as ResourcePrice FROM task_resources INNER JOIN resources ON resources.ResourceID=task_resources.ResourceID WHERE TaskID='".$curact[$c]["TaskID"]."' and resources.Type != 'manpower'";
				$qq = $mysqli->query($query);
				if ($qq->num_rows > 0) {
					$x = 0;
					while ($resource = $qq->fetch_assoc()) {
						foreach ($resource as $key=>$value) {
							$curact[$c]["resources"][$x][$key] = $value;
						}
						$x++;
					}
				}
				$c++;
			}
			die(json_encode($curact));
		} else {
			die("[]");
		}
	break;

	case "list_project_resources":
		if (!isset($jsr["projectid"]) || empty($jsr["projectid"])) {
			dexit(1);
		}

		$query = "SELECT rtable.*, QuantityTotal * ResourcePrice as PriceTotal FROM (SELECT task_resources.*, resources.Name as ResourceName, resources.Type as ResourceType, SUM(task_resources.Quantity) as QuantityTotal, resources.Price as ResourcePrice FROM task_resources INNER JOIN resources ON task_resources.ResourceID=resources.ResourceID WHERE ProjectID='".$mysqli->real_escape_string($jsr["projectid"])."' GROUP BY ResourceID) as rtable order by ResourceType, ResourceName";
		$prj = $mysqli->query($query);
		if ($prj->num_rows > 0) {
			$resources = array();
			$r = 0;
			while ($resource = $prj->fetch_assoc()) {

                            if($resource['ResourceType']=='material'){
				foreach ($resource as $key=>$value) {
                                    $resources[$r][$key] = $value;	
				}
				$r++;
                            }
			}
			die(json_encode($resources));
		} else {
			die("[]");
		}
	break;

	case "edit_activity":
		if (!isset($jsr["activityid"]) || empty($jsr["activityid"]) || !isset($jsr["name"]) || empty($jsr["name"]) || !isset($jsr["startdate"]) || empty($jsr["startdate"]) || !isset($jsr["enddate"]) || empty($jsr["enddate"]) || !isset($jsr["clientneeded"])) {
			dexit(1);
		}

		$theproject = $mysqli->query("SELECT activities.*, projects.Name as ProjectName FROM activities INNER JOIN projects ON activities.ProjectID=projects.ProjectID WHERE ActivityID='".$mysqli->real_escape_string($jsr["activityid"])."'")->fetch_assoc();
		$pid = $theproject["ProjectID"];
		if ($_SESSION["theuser"]["Type"] !== "admin") {
			$jsr["projectname"] = $theproject["ProjectName"];
			$query = insertsql("notifications", array("UserID", "Type", "RequestData", "ToUser"), array($_SESSION["theuser"]["UserID"], $jsr["do"], json_encode($jsr), "0"));
			$mysqli->query($query);
		}

		$query = updatesql("activities", array("Name", "StartDate", "EndDate", "ClientNeeded"), array($jsr["name"], $jsr["startdate"], $jsr["enddate"], $jsr["clientneeded"]), array("ActivityID", $jsr["activityid"]));
		$mysqli->query($query);
		if (isset($jsr["items"])) {
			// items to add
			if (isset($jsr["items"]["add"]) && is_array($jsr["items"]["add"])) {
				for ($i = 0; $i < count($jsr["items"]["add"]); $i++) {
					if (isset($jsr["items"]["add"][$i]["resourceid"]) && !empty($jsr["items"]["add"][$i]["resourceid"]) && isset($jsr["items"]["add"][$i]["quantity"]) && !empty($jsr["items"]["add"][$i]["quantity"]) && isset($jsr["items"]["add"][$i]["type"])) {

						$ff = $mysqli->query("SELECT * FROM activities_resources WHERE ResourceID='".$jsr["items"]["add"][$i]["resourceid"]."' AND ActivityID='".$jsr["activityid"]."' AND Type='".$jsr["items"]["add"][$i]["type"]."'");
						if ($ff->num_rows > 0) {
							$ff = $ff->fetch_assoc();
							$query = updatesql("activities_resources", array("ProjectID", "ActivityID", "ResourceID", "Type", "Quantity", "Used", "Remaining"), array($pid, $jsr["activityid"], $jsr["items"]["add"][$i]["resourceid"], $jsr["items"]["add"][$i]["type"], ($jsr["items"]["add"][$i]["quantity"] + $ff["Quantity"]), "0", $jsr["items"]["add"][$i]["quantity"]), array("ActResID", $ff["ActResID"]));
							$mysqli->query($query);
						} else {
							$query = insertsql("activities_resources", array("ProjectID", "ActivityID", "ResourceID", "Type", "Quantity", "Used", "Remaining"), array($pid, $jsr["activityid"], $jsr["items"]["add"][$i]["resourceid"], $jsr["items"]["add"][$i]["type"], $jsr["items"]["add"][$i]["quantity"], "0", $jsr["items"]["add"][$i]["quantity"]));
							$mysqli->query($query);
						}
					}
				}
			}

			// items to delete
			if (isset($jsr["items"]["delete"]) && is_array($jsr["items"]["delete"])) {
				for ($i = 0; $i < count($jsr["items"]["delete"]); $i++) {
					$query = "DELETE FROM activities_resources WHERE ActResID='".$mysqli->real_escape_string($jsr["items"]["delete"][$i])."'";
					$mysqli->query($query);
				}
			}
		}
		die(json_encode(array("success"=>true)));
	break;
        
	case "task_done":
		if (!isset($jsr["taskid"]) || empty($jsr["taskid"])) {
			dexit(1);
		}
		if ($_SESSION["theuser"]["Type"] !== "admin") {
			$query = insertsql("notifications", array("UserID", "Type", "RequestData", "ToUser"), array($_SESSION["theuser"]["UserID"], $jsr["do"], json_encode($jsr), "0"));
			$mysqli->query($query);
		}

		$query = "SELECT task.*,datediff(curdate(), task.StartDate) + 1 ActualDays, projects.Name as ProjectName, projects.UserID as ClientID, projects.UserID as ClientID, DATEDIFF(task.StartDate, CURDATE()) as AdvanceDays FROM task INNER JOIN projects ON projects.ProjectID=task.ProjectID WHERE TaskID='".$mysqli->real_escape_string($jsr["taskid"])."'";
		$qq = $mysqli->query($query);
		if ($qq->num_rows > 0) {
			$theAct = $qq->fetch_assoc();
                        
			if ($theAct["Done"] == 0 || $theAct["Done"] == "0") {
				$query = "UPDATE task SET Done=1,ActualEndDate = curdate(),ActualDays=  DATEDIFF(curdate(),StartDate ) +1 WHERE TaskID='".$mysqli->real_escape_string($jsr["taskid"])."'";
			} else {
				$query = "UPDATE task SET Done=0 WHERE TaskID='".$mysqli->real_escape_string($jsr["taskid"])."'";
			}
                        $daysDiff = (int) $theAct['ActualDays'] - (int) $theAct['Days'];

			if ( $daysDiff < 0) {
//				$kiss = array("ActivityName"=>$theAct["Name"], "ProjectName"=>$theAct["ProjectName"], "AdvanceDays"=> abs($daysDiff));
//				$mysqli->query(insertsql("notifications", array("UserID", "Type", "RequestData", "ToUser", "ProjectID", "TaskID"), array("0", "advance_activity", json_encode($kiss), "0", $theAct["ProjectID"], $jsr["taskid"])));
//				$mysqli->query(insertsql("notifications", array("UserID", "Type", "RequestData", "ToUser", "ProjectID", "TaskID"), array("0", "advance_activity", json_encode($kiss), $theAct["ClientID"], $theAct["ProjectID"],$jsr["taskid"])));
			}
                        elseif( $daysDiff > 3) {
//				$kiss = array("ActivityName"=>$theAct["Name"], "ProjectName"=>$theAct["ProjectName"], "DelayDays"=> $daysDiff - 3);
//				$mysqli->query(insertsql("notifications", array("UserID", "Type", "RequestData", "ToUser", "ProjectID", "TaskID"), array("0", "late_activity", json_encode($kiss), "0", $theAct["ProjectID"],$jsr["taskid"])));
//				$mysqli->query(insertsql("notifications", array("UserID", "Type", "RequestDagta", "ToUser", "ProjectID", "TaskID"), array("0", "late_activity", json_encode($kiss), $theAct["ClientID"], $theAct["ProjectID"], $jsr["taskid"])));
			}
     
			$mysqli->query($query);
                        updateEndDate($jsr["taskid"], date('Y-m-d'));
                        $query = "update projects set EndDate = (select max(EndDate) from task where ProjectID =".$theAct["ProjectID"].")  where ProjectID =".$theAct["ProjectID"];
                        $mysqli->query($query);
			$progress = updatePercentage($theAct["ProjectID"],$theAct["ActivityID"]);
			die(json_encode(array("success"=>true, "progress"=>$progress)));
		} else {
			dexit(1);
		}
	break;
        case "add_days_task":
		if (!isset($jsr["taskid"]) || empty($jsr["taskid"])) {
			dexit(1);
		}

                $query = "UPDATE task SET AdditionalDays= AdditionalDays + ". $jsr["days"]. ",EndDate = date('".$jsr["enddate"]."') WHERE TaskID='".$mysqli->real_escape_string($jsr["taskid"])."'";

                $mysqli->query($query);
                
                updateEndDate($jsr["taskid"], $jsr["enddate"]);
                
                $query = "update projects set EndDate = (select max(EndDate) from task where ProjectID =".$theAct["ProjectID"].")  where ProjectID =".$theAct["ProjectID"];
                $mysqli->query($query);
                
                die(json_encode(array("success"=>true)));

	break;
	case "activity_done":
		if (!isset($jsr["activityid"]) || empty($jsr["activityid"])) {
			dexit(1);
		}
		if ($_SESSION["theuser"]["Type"] !== "admin") {
			$query = insertsql("notifications", array("UserID", "Type", "RequestData", "ToUser"), array($_SESSION["theuser"]["UserID"], $jsr["do"], json_encode($jsr), "0"));
			$mysqli->query($query);
		}

		$query = "SELECT activities.*, projects.Name as ProjectName, projects.UserID as ClientID, projects.UserID as ClientID, DATEDIFF(activities.StartDate, CURDATE()) as AdvanceDays FROM activities INNER JOIN projects ON projects.ProjectID=activities.ProjectID WHERE ActivityID='".$mysqli->real_escape_string($jsr["activityid"])."'";
		$qq = $mysqli->query($query);
		if ($qq->num_rows > 0) {
			$theAct = $qq->fetch_assoc();
			if ($theAct["Done"] == 0 || $theAct["Done"] == "0") {
				$query = "UPDATE activities SET Done=1 WHERE ActivityID='".$mysqli->real_escape_string($jsr["activityid"])."'";
			} else {
				$query = "UPDATE activities SET Done=0 WHERE ActivityID='".$mysqli->real_escape_string($jsr["activityid"])."'";
			}

//			if ((int) $theAct["AdvanceDays"] > 0) {
//				$kiss = array("ActivityName"=>$theAct["Name"], "ProjectName"=>$theAct["ProjectName"], "AdvanceDays"=>$theAct["AdvanceDays"]);
//				$mysqli->query(insertsql("notifications", array("UserID", "Type", "RequestData", "ToUser", "ProjectID", "ActivityID"), array("0", "advance_activity", json_encode($kiss), "0", $theAct["ProjectID"], $theAct["ActivityID"])));
//				$mysqli->query(insertsql("notifications", array("UserID", "Type", "RequestData", "ToUser", "ProjectID", "ActivityID"), array("0", "advance_activity", json_encode($kiss), $theAct["ClientID"], $theAct["ProjectID"], $theAct["ActivityID"])));
//			}

			$mysqli->query($query);
			$progress = updatePercentage($theAct["ProjectID"],$theAct["ActivityID"]);
			die(json_encode(array("success"=>true, "progress"=>$progress)));
		} else {
			dexit(1);
		}
	break;

        case "add_activity": 
		if (!isset($jsr["projectid"]) || empty($jsr["projectid"]) ) {
			dexit(1);
		}
                $pid = $jsr["projectid"];
                $activity = json_decode($jsr['activities']);
 
//		if ($_SESSION["theuser"]["Type"] !== "admin") {
//			$query = insertsql("notifications", array("UserID", "Type", "RequestData", "ToUser"), array($_SESSION["theuser"]["UserID"], $jsr["do"], json_encode($jsr), "0"));
//			$mysqli->query($query);
//		}


                    $query = insertsql("activities", array("ProjectID", "Name"), array($pid, $activity->name));
                    $mysqli->query($query);
                    $actid = $mysqli->insert_id;
                    foreach ($activity->tasks as $tasks)
                    {
                        $query = insertsql("task", 
                                array("ProjectID","ActivityID", "Name", "StartDate", "EndDate","PreStartDate", "PreEndDate", "Days","Parent", "ClientNeeded"),
                                array($pid,$actid, $tasks->label, $tasks->from, $tasks->to,$tasks->from, $tasks->to, $tasks->days, $tasks->parentid,  $tasks->notify));
                        $mysqli->query($query);
                        $taskid = $mysqli->insert_id;
                        
                        $resources_array = array_merge($tasks->manpower,$tasks->material,$tasks->equipment);
                        foreach($resources_array as $resources)
                        {
                            $query = insertsql("task_resources",
                                    array("ProjectID", "TaskId", "ResourceID", "Quantity", "Remaining"),
                                        array($pid,$taskid, $resources->id, $resources->quantity,$resources->quantity));
                            $mysqli->query($query);
                        }
                    }

		$progress = updatePercentage($jsr["projectid"],$actid);
		die(json_encode(array("success"=>true, "progress"=>$progress)));
	break;

	case "delete_activity":
		if (!isset($jsr["activityid"]) || empty($jsr["activityid"])) {
			dexit(1);
		}

		if ($_SESSION["theuser"]["Type"] !== "admin") {
			$query = insertsql("notifications", array("UserID", "Type", "RequestData", "ToUser"), array($_SESSION["theuser"]["UserID"], $jsr["do"], json_encode($jsr), "0"));
			$mysqli->query($query);
		}

		$query = "SELECT * FROM activities WHERE ActivityID='".$mysqli->real_escape_string($jsr["activityid"])."'";
		$qq = $mysqli->query($query);
		if ($qq->num_rows > 0) {
			$pid = $qq->fetch_assoc()["ProjectID"];
			$queries[0] = "DELETE FROM activities_resources WHERE ActivityID='".$mysqli->real_escape_string($jsr["activityid"])."'";
			$queries[1] = "DELETE FROM activities WHERE ActivityID='".$mysqli->real_escape_string($jsr["activityid"])."'";
			foreach ($queries as $query) {
				$mysqli->query($query);
			}
			$progress = updatePercentage($pid);
			die(json_encode(array("success"=>true, "progress"=>$progress)));
		} else {
			dexit(1);
		}
	break;

	case "sendreq":
		if (!isset($jsr["projectid"]) || empty($jsr["projectid"]) || !isset($jsr["subject"]) || empty($jsr["subject"]) || !isset($jsr["message"]) || empty($jsr["message"])) {
			dexit(1);
		}
		$kiss = array("ProjectName"=>$mysqli->query("SELECT * FROM projects WHERE ProjectID='".$mysqli->real_escape_string($jsr["projectid"])."'")->fetch_assoc()["Name"], "subject"=>$jsr["subject"], "message"=>$jsr["message"]);
		$mysqli->query(insertsql("notifications", array("UserID", "Type", "RequestData", "ToUser", "ProjectID"), array($_SESSION["theuser"]["UserID"], "change_request", json_encode($kiss), "0", $jsr["projectid"])));
		die(json_encode(array("success"=>true)));
	break;

	case "del_notif":
		if (!isset($jsr["notificationid"]) || empty($jsr["notificationid"])) {
			dexit(1);
		}
		$query = "SELECT * FROM notifications WHERE NotificationID='".$mysqli->real_escape_string($jsr["notificationid"])."'";
		$qq = $mysqli->query($query);
		if ($qq->num_rows > 0) {
			$notif = $qq->fetch_assoc();
			if ($notif["Type"] == "paymentstart" || $notif["Type"] == "paymentend") {
				$query = "DELETE FROM notifications WHERE Type='".$notif["Type"]."' AND ProjectID='".$notif["ProjectID"]."'";
				$mysqli->query($query);
			} else {
				$query = "DELETE FROM notifications WHERE NotificationID='".$mysqli->real_escape_string($notif["NotificationID"])."'";
				$mysqli->query($query);
				die(json_encode(array("success"=>false)));
			}
		}
		dexit(1);
	break;

	case "get_notifications":

		// late notifications
		$query = "SELECT task.*, DATEDIFF(CURDATE(), task.EndDate) -3 as DelayDays , projects.UserID as ClientID, projects.Name as ProjectName FROM task INNER JOIN projects ON task.ProjectID=projects.ProjectID WHERE Done=0 AND CURDATE() > ADDDATE(task.EndDate,3) order by ProjectID";
		$qq = $mysqli->query($query);
		if ($qq->num_rows > 0) {
			while ($cake = $qq->fetch_assoc()) {
				$mysqli->query("DELETE FROM notifications WHERE Type='late_task' AND TaskID='".$mysqli->real_escape_string($cake["TaskID"])."' AND ProjectID='".$mysqli->real_escape_string($cake["ProjectID"])."'");
				$kiss = array("TaskName"=>$cake["Name"], "ProjectName"=>$cake["ProjectName"], "DelayDays"=>$cake["DelayDays"]);
				$mysqli->query(insertsql("notifications", array("UserID", "Type", "RequestData", "ToUser", "ProjectID", "TaskID"), array("0", "late_task", json_encode($kiss), "0", $cake["ProjectID"], $cake["TaskID"])));
				$mysqli->query(insertsql("notifications", array("UserID", "Type", "RequestData", "ToUser", "ProjectID", "TaskID"), array("0", "late_task", json_encode($kiss), $cake["ClientID"], $cake["ProjectID"], $cake["TaskID"])));
			}
		}
                


		// late notifications
		$query = "SELECT task.*, DATEDIFF(CURDATE(), task.EndDate) as DelayDays,
 projects.UserID as ClientID, projects.Name as ProjectName FROM task 
 INNER JOIN projects ON task.ProjectID=projects.ProjectID 
 WHERE Done=0 AND CURDATE() = ADDDATE(task.EndDate,3)  order by ProjectID";
		$qq = $mysqli->query($query);
		if ($qq->num_rows > 0) {
			while ($cake = $qq->fetch_assoc()) {
				$mysqli->query("DELETE FROM notifications WHERE Type='late_finish' AND TaskID='".$mysqli->real_escape_string($cake["TaskID"])."' AND ProjectID='".$mysqli->real_escape_string($cake["ProjectID"])."'");
				$kiss = array("TaskName"=>$cake["Name"], "ProjectName"=>$cake["ProjectName"], "DelayDays"=>$cake["DelayDays"]);
				$mysqli->query(insertsql("notifications", array("UserID", "Type", "RequestData", "ToUser", "ProjectID", "TaskID"), array("0", "late_finish", json_encode($kiss), "0", $cake["ProjectID"], $cake["TaskID"])));
				$mysqli->query(insertsql("notifications", array("UserID", "Type", "RequestData", "ToUser", "ProjectID", "TaskID"), array("0", "late_finish", json_encode($kiss), $cake["ClientID"], $cake["ProjectID"], $cake["TaskID"])));
			}
		}                
//
//		// payment notification
//		$query = "SELECT * FROM projects WHERE DateDiff(StartDate, CURDATE()) = 7";
//		$qq = $mysqli->query($query);
//		if ($qq->num_rows > 0) {
//			while ($cake = $qq->fetch_assoc()) {
//				$ths = $mysqli->query("SELECT * FROM notifications WHERE ProjectID='".$mysqli->real_escape_string($cake["ProjectID"])."' AND Type='paymentstart'");
//				if ($ths->num_rows <= 0) {
//					$kiss = array("ProjectName"=>$cake["Name"]);
//					$mysqli->query(insertsql("notifications", array("UserID", "Type", "RequestData", "ToUser", "ProjectID"), array("0", "paymentstart", json_encode($kiss), $cake["UserID"], $cake["ProjectID"])));
//					$mysqli->query(insertsql("notifications", array("UserID", "Type", "RequestData", "ToUser", "ProjectID"), array("0", "paymentstart", json_encode($kiss), "0", $cake["ProjectID"])));
//				}
//			}
//		}
//
//		$query = "SELECT * FROM projects WHERE DateDiff(EndDate, CURDATE()) = 7";
//		$qq = $mysqli->query($query);
//		if ($qq->num_rows > 0) {
//			while ($cake = $qq->fetch_assoc()) {
//				$ths = $mysqli->query("SELECT * FROM notifications WHERE ProjectID='".$mysqli->real_escape_string($cake["ProjectID"])."' AND Type='paymentend'");
//				if ($ths->num_rows <= 0) {
//					$kiss = array("ProjectName"=>$cake["Name"]);
//					$mysqli->query(insertsql("notifications", array("UserID", "Type", "RequestData", "ToUser", "ProjectID"), array("0", "paymentend", json_encode($kiss), $cake["UserID"], $cake["ProjectID"])));
//					$mysqli->query(insertsql("notifications", array("UserID", "Type", "RequestData", "ToUser", "ProjectID"), array("0", "paymentend", json_encode($kiss), "0", $cake["ProjectID"])));
//				}
//			}
//		}

		// client needed notifications
		$query = "SELECT task.*, projects.UserID as ClientID, projects.Name as ProjectName FROM task INNER JOIN projects ON task.ProjectID=projects.ProjectID WHERE Done=0 AND ClientNeeded=1 AND DateDiff(task.StartDate, CURDATE()) = 2";
		$qq = $mysqli->query($query);
		if ($qq->num_rows > 0) {
			while ($cake = $qq->fetch_assoc()) {

				$mysqli->query("DELETE FROM notifications WHERE Type='client_needed' AND TaskID='".$mysqli->real_escape_string($cake["TaskID"])."' AND ProjectID='".$mysqli->real_escape_string($cake["ProjectID"])."'");
				$kiss = array("TaskName"=>$cake["Name"], "ProjectName"=>$cake["ProjectName"],"Message"=>$cake["Message"]);
				$mysqli->query(insertsql("notifications", array("UserID", "Type", "RequestData", "ToUser", "ProjectID", "TaskID"), array("0", "client_needed", json_encode($kiss), $cake["ClientID"], $cake["ProjectID"], $cake["TaskID"])));
			}
		}
		if ($_SESSION["theuser"]["Type"] == "admin" || $_SESSION["theuser"]["Type"] == "manager" || $_SESSION["theuser"]["Type"] == "engineer" || $_SESSION["theuser"]["Type"] == "architect") {
			$query = "SELECT notifications.*, users.Name as Username FROM notifications LEFT JOIN users ON notifications.UserID=users.UserID WHERE ToUser='0' order by ProjectID";
		} else {
			$query = "SELECT notifications.*, users.Name as Username FROM notifications LEFT JOIN users ON notifications.UserID=users.UserID WHERE ToUser='".$_SESSION["theuser"]["UserID"]."'  order by ProjectID";
		}
		$qq = $mysqli->query($query);
		if ($qq->num_rows > 0) {
			$n = 0;
			$notifications = array();
			while ($notification = $qq->fetch_assoc()) {
				if ($notification["UserID"] !== $_SESSION["theuser"]["UserID"]) {
					$notifications[$n] = $notification;
					$n++;
				}
			}
			die(json_encode($notifications));
		} else {
			die("[]");
		}
	break;

	case "update_used_resource":
		if (!isset($jsr["taskresid"]) || empty($jsr["taskresid"]) || !isset($jsr["use"]) || empty($jsr["use"])) {
			dexit(1);
		}

		if ($_SESSION["theuser"]["Type"] !== "admin") {
			$query = insertsql("notifications", array("UserID", "Type", "RequestData", "ToUser"), array($_SESSION["theuser"]["UserID"], $jsr["do"], json_encode($jsr), "0"));
			$mysqli->query($query);
		}

		$query = "SELECT * FROM task_resources WHERE TaskResID='".$mysqli->real_escape_string($jsr["taskresid"])."'";
		$qq = $mysqli->query($query);
		if ($qq->num_rows > 0) {
			$theR = $qq->fetch_assoc();
			$quantity = (int) $theR["Quantity"];
			$use = (int) $jsr["use"];
			if ($use <= $quantity) {
				$remaining = $quantity - $use;
				$query = "UPDATE task_resources SET Used='".$mysqli->real_escape_string($use)."', Remaining='".$mysqli->real_escape_string($remaining)."' WHERE TaskResID='".$mysqli->real_escape_string($jsr["taskresid"])."'";
				$mysqli->query($query);
				die(json_encode(array("success"=>true,"quantity"=>$quantity,"used"=>$use,"remaining"=>$remaining)));
			} else {
				dexit(4);
			}
		} else {
			dexit(3);
		}
	break;

	case "get_activities":
		if (!isset($jsr["projectid"]) || empty($jsr["projectid"])) {
			dexit(1);
		}
		$query = "SELECT activities.Name Activity,task.* FROM task left join activities on task.ActivityID = activities.ActivityID WHERE task.ProjectID='".$mysqli->real_escape_string($jsr["projectid"])."'";
		$qq = $mysqli->query($query);
		if ($qq->num_rows > 0) {
			$activities = array();
			$c = 0;
			while ($activity = $qq->fetch_assoc()) {
				foreach ($activity as $key=>$value) {
					$activities[$c][$key] = $value;
				}
				$query = "SELECT SUM(task_resources.Quantity * resources.Price) as TotalPrice FROM task_resources INNER JOIN resources ON task_resources.ResourceID=resources.ResourceID WHERE TaskID='".$mysqli->real_escape_string($activity["TaskID"])."'";
				$itt = $mysqli->query($query);
				if ($itt->num_rows > 0) {
					$activities[$c]["TotalPrice"] = $itt->fetch_assoc()["TotalPrice"];
				} else {
					$activites[$c]["TotalPrice"] = "0";
				}
				$c++;
			}
			die(json_encode($activities));
		} else {
			die("[]");
		}
	break;

	case "get_activity":
		if (!isset($jsr["activityid"]) || empty($jsr["activityid"])) {
			dexit(1);
		}
		$query = "SELECT * FROM activities WHERE ActivityID='".$mysqli->real_escape_string($jsr["activityid"])."'";
		$activity = $mysqli->query($query)->fetch_assoc();
		$query = "SELECT activities_resources.*, resources.Name as ResourceName, resources.Price as ResourcePrice FROM `activities_resources` INNER JOIN resources ON activities_resources.ResourceID=resources.ResourceID WHERE ActivityID='".$mysqli->real_escape_string($jsr["activityid"])."'";
		$qq = $mysqli->query($query);
		$activity["items"] = [];
		if ($qq->num_rows > 0) {
			$c = 0;
			while ($item = $qq->fetch_assoc()) {
				foreach ($item as $key=>$value) {
					$activity["items"][$c][$key] = $value;
				}
				$c++;
			}
		}
		die(json_encode($activity));
	break;

	case "add_activity_resource":
		if (!isset($jsr["activityid"]) || empty($jsr["activityid"]) || !isset($jsr["resourceid"]) || empty($jsr["resourceid"]) || !isset($jsr["quantity"]) || empty($jsr["quantity"])) {
			dexit(1);
		}
		$pid = $mysqli->query("SELECT ProjectID FROM activities WHERE ActivityID='".$mysqli->real_escape_string($jsr["activityid"])."'")->fetch_assoc()["ProjectID"];
		$query = insertsql("activities_resources", array("ProjectID", "ActivityID", "ResourceID", "Quantity"), array($pid, $jsr["activityid"], $jsr["resourceid"], $jsr["quantity"]));
		$mysqli->query($query);
		die(json_encode(array("success"=>true)));
	break;

	case "add_resource":
		if (!isset($jsr["name"]) || empty($jsr["name"]) || !isset($jsr["price"]) || empty($jsr["price"]) || !isset($jsr["type"]) || empty($jsr["type"])) {
			dexit(1);
		}
		$query = insertsql("resources", array("Name", "Price", "Type"), array($jsr["name"], $jsr["price"], $jsr["type"]));
		$mysqli->query($query);
		die(json_encode(array("success"=>true)));
	break;

	case "edit_resource":
		if (!isset($jsr["resourceid"]) || empty($jsr["resourceid"]) || !isset($jsr["name"]) || empty($jsr["name"]) || !isset($jsr["price"]) || empty($jsr["price"]) || !isset($jsr["type"]) || empty($jsr["type"])) {
			dexit(1);
		}
		$query = updatesql("resources", array("Name", "Price", "Type"), array($jsr["name"], $jsr["price"], $jsr["type"]), array("ResourceID", $jsr["resourceid"]));
		$mysqli->query($query);
		die(json_encode(array("success"=>true)));
	break;

	case "list_projects":
		if (!isset($jsr["mode"]) || empty($jsr["mode"])) {
			$stat = " Status=0 ";
		} else {
			switch ($jsr["mode"]) {
				case "inprogress":
					$stat = " Status=0 ";
				break;

				case "completed":
					$stat = " Status=1 ";
				break;

				default:
					$stat = " Status=0 ";
				break;
			}
		}

		if (!isset($jsr["search"]) || empty($jsr["search"])) {
			$search = "";
		} else {
			$search = "AND projects.Name LIKE '%".$mysqli->real_escape_string($jsr["search"])."%' ";
		}

		if ($_SESSION["theuser"]["Type"] == "client") {
			$query = "SELECT projects.*, users.Name as ClientName FROM projects INNER JOIN users ON projects.UserID=users.UserID WHERE projects.UserID='".$mysqli->real_escape_string($_SESSION["theuser"]["UserID"])."' AND".$stat.$search."ORDER BY Name DESC";
		} else {
			$query = "SELECT projects.*, users.Name as ClientName FROM projects INNER JOIN users ON projects.UserID=users.UserID WHERE".$stat.$search."ORDER BY Name DESC";
		}
		$qq = $mysqli->query($query);
		if ($qq->num_rows > 0) {
			$projects = array();
			$c = 0;
			while ($project = $qq->fetch_assoc()) {
				foreach ($project as $key=>$value) {
					$projects[$c][$key] = $value;
				}
				$c++;
			}
			die(json_encode($projects));
		} else {
			die("[]");
		}
	break;

	case "add_user":
		if (!isset($jsr["name"]) || empty($jsr["name"]) || !isset($jsr["username"]) || empty($jsr["username"]) || !isset($jsr["password"]) || empty($jsr["password"]) || !isset($jsr["type"]) || empty($jsr["type"])) {
			dexit(1);
		}
		$query = insertsql("users", array("Name", "Username", "Password", "Type"), array($jsr["name"], $jsr["username"], hash("ripemd160", $jsr["password"]), $jsr["type"]));
		$mysqli->query($query);
		die(json_encode(array("success"=>true)));
	break;

	case "edit_user":
		if (!isset($jsr["userid"]) || empty($jsr["userid"]) || !isset($jsr["name"]) || empty($jsr["name"]) || !isset($jsr["username"]) || empty($jsr["username"]) || !isset($jsr["password"]) || empty($jsr["password"]) || !isset($jsr["type"]) || empty($jsr["type"])) {
			dexit(1);
		}
		$query = updatesql("users", array("Name", "Username", "Password", "Type"), array($jsr["name"], $jsr["username"], hash("ripemd160", $jsr["password"]), $jsr["type"]), array("UserID", $jsr["userid"]));
		$mysqli->query($query);
		die(json_encode(array("success"=>true)));
	break;

	case "list_users":
		if (!isset($jsr["search"]) || empty($jsr["search"])) {
			$search = " ";
		} else {
			$search = " WHERE Name LIKE '%".$mysqli->real_escape_string($jsr["search"])."%' ";
		}
		$query = "SELECT * FROM users".$search."ORDER BY Name DESC";
		$qq = $mysqli->query($query);
		if ($qq->num_rows > 0) {
			$c = 0;
			$clients = array();
			while ($client = $qq->fetch_assoc()) {
				foreach($client as $key=>$value) {
					if ($key !== "Password") {
						$clients[$c][$key] = $value;
					}
				}
				$c++;
			}
			die(json_encode($clients));
		} else {
			die("[]");
		}
	break;

	case "list_clients":
		$query = "SELECT * FROM users WHERE Type='client' ORDER BY Name DESC";
		$qq = $mysqli->query($query);
		if ($qq->num_rows > 0) {
			$c = 0;
			$clients = array();
			while ($client = $qq->fetch_assoc()) {
				foreach($client as $key=>$value) {
					if ($key !== "Password") {
						$clients[$c][$key] = $value;
					}
				}
				$c++;
			}
			die(json_encode($clients));
		} else {
			die("[]");
		}
	break;

	case "list_resources":
		if (!isset($jsr["search"]) || empty($jsr["search"])) {
			$search = " ";
		} else {
			$search = " WHERE Name LIKE '%".$mysqli->real_escape_string($jsr["search"])."%' ";
		}
		$query = "SELECT * FROM resources".$search."ORDER BY Name DESC";
		$qq = $mysqli->query($query);
		if ($qq->num_rows > 0) {
			$resources = array();
			$c = 0;
			while ($resource = $qq->fetch_assoc()) {

                                    if($resource['Type']=='manpower' || $resource['Type']=='equipment'){
                                      $query=   "select IFNULL(SUM(task_resources.Quantity),0) as Taken
                                          ,(select Quantity from resources where resources.ResourceID ='".$resource['ResourceID']."' )as `Max`
from task_resources left join task on task_resources.TaskId = task.TaskID 
where task_resources.ResourceID ='".$resource['ResourceID']."' 
AND curdate() BETWEEN task.StartDate AND task.EndDate
AND curdate() BETWEEN task.StartDate AND task.EndDate
AND task.Done != 1
order by task_resources.TaskResId asc";
                                      
$qqq = $mysqli->query($query);
		if ($qqq->num_rows > 0) {
                        while ($row = $qqq->fetch_assoc()) {
                            
                            if($row['Taken']>$row['Max']){
                                $outsource =  ' <span>'.$row['Max'].' - ('.$row['Max'].'/<span style="color:red;">'. abs($row['Max'] - $row['Taken']).'</span>)</span>';
                            }else{
                                $outsource= ' <span>'.$row['Max'].' - ('.$row['Taken'].'/<span style="color:red;">0</span>)</span> ';
                            }
                            $resource['outsource']=$outsource;
                        }
                }
                                    }
//				foreach ($resource as $key=>$value) {
//
//					$resources[$c][$key] = $value;
//				}
                                array_push($resources,$resource);
				$c++;
			}
			die(json_encode($resources));
		} else {
			die("[]");
		}
	break;
	case "list_resources":
		if (!isset($jsr["search"]) || empty($jsr["search"])) {
			$search = " ";
		} else {
			$search = " WHERE Name LIKE '%".$mysqli->real_escape_string($jsr["search"])."%' ";
		}
		$query = "SELECT * FROM resources".$search."ORDER BY Name DESC";
		$qq = $mysqli->query($query);
		if ($qq->num_rows > 0) {
			$resources = array();
			$c = 0;
			while ($resource = $qq->fetch_assoc()) {
				foreach ($resource as $key=>$value) {
					$resources[$c][$key] = $value;
				}
				$c++;
			}
			die(json_encode($resources));
		} else {
			die("[]");
		}
	break;
        case "add_manpower_task":

                foreach($jsr['manpower'] as $manpower){
                    $query = "SELECT * FROM task_resources WHERE TaskID = '".$mysqli->real_escape_string($jsr["taskid"])."' and ResourceID =  '".$mysqli->real_escape_string($manpower["id"])."'";
                    $qq = $mysqli->query($query);
                    if ($qq->num_rows > 0) {
                        $query = "UPDATE task_resources SET Quantity=Quantity + ".$manpower['quantity'].", Remaining=Remaining + ".$manpower['quantity']." WHERE TaskID = '".$mysqli->real_escape_string($jsr["taskid"])."' and ResourceID =  '".$mysqli->real_escape_string($manpower["id"])."'";
                        $mysqli->query($query);
                    }
                    else
                    {
                        $query = insertsql("task_resources",
                                    array("ProjectID", "TaskId", "ResourceID", "Quantity", "Remaining"),
                                        array($jsr["projectid"],$jsr["taskid"], $manpower["id"],$manpower["quantity"],$manpower["quantity"]));
                            $mysqli->query($query);
                    }
                }
                die(json_encode(array("success"=>true)));
	break;        
        case "add_material_task":
                 $query = insertsql("task_resources_additional",
                    array( "TaskID", "Reason"),
                    array($jsr['taskid'],$jsr['reason']));
                $mysqli->query($query);
                $addid = $mysqli->insert_id;
                foreach($jsr['material'] as $material)
                {
                    $query = insertsql("task_resources",
                            array("ProjectID", "TaskId", "ResourceID", "Quantity", "Remaining","Additional","TaskAddID"),
                                array($jsr['projectid'],$jsr['taskid'], $material['id'], $material['quantity'], $material['quantity'],1,$addid));
                    $mysqli->query($query);
                }
                 die(json_encode(array("success"=>true)));
	break;
	case "get_manpower":
                $search = " WHERE Type LIKE 'manpower' ";
		$query = "SELECT * FROM resources".$search."ORDER BY Name DESC";

		$qq = $mysqli->query($query);
		if ($qq->num_rows > 0) {
			$resources = array();
			$c = 0;
			while ($resource = $qq->fetch_assoc()) {
				foreach ($resource as $key=>$value) {
					$resources[$c][$key] = $value;
				}
				$c++;
			}
			die(json_encode($resources));
		} else {
			die("[]");
		}
	break;	
        case "get_manpower_if_outsource":
	break;
	case "get_materials":
                $search = " where ResourceID in (select ResourceID from task_resources where TaskID=".$jsr['taskid']."  AND ( (((Remaining / Quantity) * 100 ) < 21) or (Quantity <5 AND Remaining =1) )  )  ";
		$query = "SELECT * FROM resources".$search."  AND `Type`= 'material' ORDER BY Name DESC";
             
		$qq = $mysqli->query($query);
		if ($qq->num_rows > 0) {
			$resources = array();
			$c = 0;
			while ($resource = $qq->fetch_assoc()) {
				foreach ($resource as $key=>$value) {
					$resources[$c][$key] = $value;
				}
				$c++;
			}
			die(json_encode($resources));
		} else {
			die("[]");
		}
	break;
	case "getprojectprogress":
		if (!isset($jsr["projectid"]) || empty($jsr["projectid"])) {
			$search = " ";
		} 			
                $progress = updatePercentage($jsr["projectid"]);
		die(json_encode(array("success"=>true, "progress"=>$progress)));
	break;
	case "add_comment":
		if (!isset($jsr["projectid"]) || empty($jsr["projectid"]) || !isset($jsr["commentdata"]) || empty($jsr["commentdata"])) {
			dexit(1);
		}
		$query = insertsql("notifications", array("UserID", "Type", "RequestData", "ToUser"), array($_SESSION["theuser"]["UserID"], $jsr["do"], json_encode($jsr), "0"));
		$mysqli->query($query);
		$query = insertsql("notifications", array("UserID", "Type", "RequestData", "ToUser"), array($_SESSION["theuser"]["UserID"], $jsr["do"], json_encode($jsr), $mysqli->query("SELECT * FROM projects WHERE ProjectID='".$mysqli->real_escape_string($jsr["projectid"])."'")->fetch_assoc()["UserID"]));
		$mysqli->query($query);
		$query = insertsql("comments", array("ProjectID", "UserID", "Data"), array($jsr["projectid"], $_SESSION["theuser"]["UserID"], $jsr["commentdata"]));
		$mysqli->query($query);
		die(json_encode(array("success"=>true)));
	break;

	case "get_comments":
		if (!isset($jsr["projectid"]) || empty($jsr["projectid"])) {
			dexit(1);
		}
		$query = "SELECT comments.*, users.Name as ClientName FROM comments INNER JOIN users ON comments.UserID=users.UserID WHERE ProjectID='".$mysqli->real_escape_string($jsr["projectid"])."' ORDER BY TimeStamp ASC";
		$qq = $mysqli->query($query);
		if ($qq->num_rows > 0) {
			$comments = array();
			$c = 0;
			while ($comment = $qq->fetch_assoc()) {
				foreach ($comment as $key=>$value) {
					$comments[$c][$key] = $value;
				}
				$c++;
			}
			die(json_encode($comments));
		} else {
			die("[]");
		}
	break;

	case "getuserinfo":
		die(json_encode($_SESSION["theuser"]));
	break;

	case "logoutuser":
		session_unset();
		session_destroy();
		die(json_encode(array("success"=>true)));
	break;

	default:
		dexit(2);
	break;
}
?>