$("#actstartdate").datepicker({dateFormat:'yy-mm-dd'});
$("#actenddate").datepicker({dateFormat:'yy-mm-dd'});
$("#prjstartdate").datepicker({dateFormat:'yy-mm-dd'});
$("#prjenddate").datepicker({dateFormat:'yy-mm-dd'});
    $("#prjenddate").datepicker('disable');
    
    $("#addstartdate").datepicker({dateFormat: 'yy-mm-dd', minDate: 0});
    $("#addenddate").datepicker({dateFormat: 'yy-mm-dd', minDate: 0});
    $("#addenddate").datepicker('disable');
    $("#adddays").TouchSpin();
    $("#actadditemqty").TouchSpin({"min":1});
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
		if (user["UserID"] !== $("#prjclientnameindicator").attr("clientid")) {
			$("#thecommentbox").css("display", "none");
		}
		$("#addactbtnm").css("display", "none");
		$("#addfilesbtnm").css("display", "none");
		$("#addprojectbtn").css("display", "none");
		$("#clientsbtn").css("display", "none");
		$("#resourcesbtn").css("display", "none");
		$("#resourcesbtnx").css("display", "none");
		$("#sendreqbtn").css("display", "inline");
		$("#delprojbtn").css("display", "none");
	}
	getcomments();
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

$("#delprojbtn").on("click", function() {
	xhr = new XMLHttpRequest();
	xhr.open("POST", "backend.php");
	xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
	xhrd = {
		"do":"delete_project",
		"projectid":ProjectID
	}
	xhr.send(JSON.stringify(xhrd));
	xhr.onload = function() {
		showOk("Project Deleted", "Project successfully deleted.");
		$("#okbtn").on("click", function() {
			location.href="projects.php";	
		});
	}
});

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

$("#sendreq").on("click", function() {
	subject = $("#subjectmsg").val();
	message = $("#themsg").val();
	if (subject !== "" && message !== "") {
		xhr = new XMLHttpRequest();
		xhr.open("POST", "backend.php");
		xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
		xhrd = {
			"do":"sendreq",
			"subject":subject,
			"message":message,
			"projectid":ProjectID
		}
		xhr.send(JSON.stringify(xhrd));
		xhr.onload = function() {
			$("#requestModal").modal("hide");
			showOk("Message Sent", "Modification Request successfully sent.");
		}
	} else {
		showError("Sending Failed", "Please fill up all the forms");
	}
});

$("#sendreqbtn").on("click", function() {
	$("#requestModal").modal("show");
});

function addFile() {
	$("#fileModal").modal("show");
}

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

    function getResources() {
        xhr = new XMLHttpRequest();
        xhr.open("POST", "backend.php");
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.send(JSON.stringify({"do": "list_resources"}));
        xhr.onload = function () {
            resources = JSON.parse(xhr.responseText);
            resourcesview = $("#itemaddselect");
            for (i = 0; i < resources.length; i++) {
                cc = "<option data-name='" + resources[i]["Name"] + "' type='" + resources[i]["Type"] + "' price='" + resources[i]["Price"] + "' value='" + resources[i]["ResourceID"] + "'>" + resources[i]["Name"] + "("+resources[i]["Price"]+")</option>";
                resourcesview.append(cc);
            }
            resourcesview = $("#actadditem");
            for (i = 0; i < resources.length; i++) {
                cc = "<option data-name='" + resources[i]["Name"] + "' type='" + resources[i]["Type"] + "' price='" + resources[i]["Price"] + "' value='" + resources[i]["ResourceID"] + "'>" + resources[i]["Name"] + "("+resources[i]["Price"]+")</option>";
                resourcesview.append(cc);
            }
        };
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

function printReport()
  {
    myWindow=window.open('genreport.php?pid='+ProjectID,'Print Report','width=1024,height=768');
    myWindow.focus();
  }

  function calculateTotal() {
  	prjitms = document.getElementById("addprjitms");
  	prjadds = document.getElementById("addprjadds");
  	prj1 = 0;
  	prj2 = 0;
  	for (var i = 0; i < prjitms.childNodes.length; i++) {
  		prj1 += parseInt(prjitms.childNodes[i].childNodes[2].innerHTML.replace("Php. ", ""));
  	}
  	$("#act1total").html("Php. " + prj1);
  	for (var i = 0; i < prjadds.childNodes.length; i++) {
  		prj2 += parseInt(prjadds.childNodes[i].childNodes[2].innerHTML.replace("Php. ", ""));
  	}
  	$("#act2total").html("Php. " + prj2);
  }

    function addAct() {
        actItemListCnt = 0;
        ActItemList = [];
        $("#actname").val("");
        $("#actstartdate").val("");
        $("#actenddate").val("");
        $("#addprjitms").html("");
        $("#addtasktable").html("");
        $("#itmname").html("- - -");
        $("#itmprice").html("- - -");
        modalMode = "add";
        $("#addActivityModal").find("#theModalTask").html("Add Activity");
        $("#addActivityModal").find("#addactbtn").html("Add Activity");
        $("#addActivityModal").modal("show");
//        $("#addActivityModal").find("#addhiddenid").val(0);
    }

function editAct(actt) {
	ActModalMode = "edit";
	EditOperations = {};
	EditOperations["delete"] = [];
	EditOperations["add"] = [];
	CurrentActivityID = actt.target.parentNode.parentNode.getAttribute("actid");
	CurrentActivityRow = actt.target.parentNode.parentNode;
	xhr = new XMLHttpRequest();
	xhr.open("POST", "backend.php");
	xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
	xhrd = {
		"do":"get_activity",
		"activityid":CurrentActivityID
	}
	xhr.send(JSON.stringify(xhrd));
	xhr.onload = function() {
		theAct = JSON.parse(xhr.responseText);
		$("#actname").val(theAct["Name"]);
		$("#actstartdate").val(theAct["StartDate"].split(" ")[0]);
		$("#actenddate").val(theAct["EndDate"].split(" ")[0]);
		$("#theModalTask").html("Edit Activity");
		$("#addactbtn").html("Edit Activity");
		$("#addprjitms").html("");
		$("#addprjadds").html("");
		if (theAct["ClientNeeded"] == "0" || theAct["ClientNeeded"] == 0) {
			document.getElementById("actcneeded").checked = false;
		} else {
			document.getElementById("actcneeded").checked = true;
		}
		for (i = 0; i < theAct["items"].length; i++) {
			itemTemplate = '<tr itemid="%itemrowid%" realrowid="%rowid%"><td>%itemname%</td><td>%itemqty%</td><td>%itemprice%</td><td><button onclick="prjitemdel(event)" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Delete Item</button></td></tr>';
			itemTemplate = itemTemplate.replace("%itemrowid%", theAct["items"][i]["ActResID"]);
			itemTemplate = itemTemplate.replace("%rowid%", i);
			itemTemplate = itemTemplate.replace("%itemname%", theAct["items"][i]["ResourceName"]);
			itemTemplate = itemTemplate.replace("%itemqty%", theAct["items"][i]["Quantity"]);
			itemTemplate = itemTemplate.replace("%itemprice%", "Php. " + (parseInt(theAct["items"][i]["ResourcePrice"]) * parseInt(theAct["items"][i]["Quantity"])));
			if (theAct["items"][i]["Type"] == "0") {
				$("#addprjitms").append(itemTemplate);
			} else if (theAct["items"][i]["Type"] == "1") {
				$("#addprjadds").append(itemTemplate);
			}
		}
		calculateTotal();
		$("#addActModal").modal("show");
	}
}

$("#addactbtna").on("click", function() {
if ($("#actname").val() !== "" && $("#actstartdate").val() !== "" && $("#actenddate").val() !== "") {
	if (ActModalMode == "add") {
		// add code here.
			jsr = {
				"do":"add_activity",
				"projectid":ProjectID,
				"name":$("#actname").val(),
				"startdate":$("#actstartdate").val(),
				"enddate":$("#actenddate").val(),
				"items":AddActItems
			}
			if (document.getElementById("actcneeded").checked) {
				jsr["clientneeded"] = "1";
			} else {
				jsr["clientneeded"] = "0";
			}
            xhr = new XMLHttpRequest();
            xhr.open("POST", "backend.php");
            xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
			xhr.send(JSON.stringify(jsr));
			xhr.onload = function() {
				xx = JSON.parse(xhr.responseText);
				if (xx["success"]) {
					$("#progressindicator").html(Math.round(xx["progress"]) + "%");
					if (xx["progress"] == "100" || xx["progress"] == 100) {
						$("#statusindicator").html("Completed");
                } else {
						$("#statusindicator").html("In Progress");
                }
					var completed = Math.round(xx["progress"]);
					var inprogress = 100 - completed;
					updatePie(inprogress, completed);
					$("#addActModal").modal("hide");
					showOk("Activity Added", "The activity is successfully added.");
					getactivities();
            }
			}
	} else if (ActModalMode == "edit") {
		// edit code here.
			jsr = {
				"do":"edit_activity",
				"activityid":CurrentActivityID,
				"name":$("#actname").val(),
				"startdate":$("#actstartdate").val(),
				"enddate":$("#actenddate").val(),
				"items":EditOperations
			}
			if (document.getElementById("actcneeded").checked) {
				jsr["clientneeded"] = "1";
	} else {
				jsr["clientneeded"] = "0";
			}
			xhr = new XMLHttpRequest();
			xhr.open("POST", "backend.php");
			xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
			xhr.send(JSON.stringify(jsr));
			xhr.onload = function() {
				xx = JSON.parse(xhr.responseText);
				if (xx["success"]) {
					$("#addActModal").modal("hide");
					showOk("Activity Edited", "The activity is successfully edited.");
					getactivities();
				}
			}
		}
	} else {
		showError("Activity not Added", "Please fill up all the forms.");
	}
});

function showError(title, message) {
	$("#errorTitle").html(title);
	$("#errorMessage").html(message);
	$("#errorModal").modal("show");
}

function showOk(title, message) {
	$("#okTitle").html(title);
	$("#okMessage").html(message);
	$("#okModal").modal("show");
}

    $("#addactitmbtn").on("click", function () {
        if($('.add_row_task.selected').length == 0 ){
            showError("Item not Added", "Please select task.");
            return false;
        }
        actAddItem = $("#actadditem");
        resourceid = actAddItem.find(":selected").val();
        actAddItemQty = $("#actadditemqty");
        if (actAddItem.val() != "" && actAddItemQty.val() != "") {
            if($("#actItmRowID" + resourceid).length > 0){
                parameters = $("#actItmRowID" + resourceid).data('parameters');
                totalprice = (parseInt(actAddItem.find(":selected").attr("price")) * parseInt(actAddItemQty.val()));
                jsonObject = {
                        "id":resourceid ,
                        "name":actAddItem.find(":selected").data("name"),
                        "type":actAddItem.find(":selected").attr("type"),
                        "quantity":parseInt(actAddItemQty.val()) +parseInt(parameters.quantity) ,
                        "totalprice":totalprice + parseInt(parameters.totalprice),
                        "price": actAddItem.find(":selected").attr("price")};
                itemTemplate = '<td>%itemname%</td><td>%itemqty%</td><td>%itemprice%</td><td><button class="btn btn-xs deleteitembutton"><span class="glyphicon glyphicon-remove"></span></button></td>';
                itemTemplate = itemTemplate.replace("%itemname%", jsonObject.name);
                itemTemplate = itemTemplate.replace("%itemqty%", jsonObject.quantity);
                itemTemplate = itemTemplate.replace("%itemprice%", "Php. " + jsonObject.totalprice);
                $("#actItmRowID" + resourceid).html(itemTemplate);
                actAddItem.val("");
                actAddItemQty.val("");
                $("#actItmRowID" + resourceid).data('parameters',jsonObject);
            }
            else{
                totalprice = (parseInt(actAddItem.find(":selected").attr("price")) * parseInt(actAddItemQty.val()));
                jsonObject = {
                    "id":resourceid ,
                    "name":actAddItem.find(":selected").data("name"),
                    "type":actAddItem.find(":selected").attr("type"),
                    "quantity":actAddItemQty.val(),
                    "totalprice":totalprice,
                    "price": actAddItem.find(":selected").attr("price")};
                itemTemplate = '<tr id="%itemrowid%" class="actItemRow"><td>%itemname%</td><td>%itemqty%</td><td>%itemprice%</td><td><button class="deleteitembutton btn btn-xs"><span class="glyphicon glyphicon-remove"></span></button></td></tr>';
                itemTemplate = itemTemplate.replace("%itemrowid%", "actItmRowID" +resourceid);
                itemTemplate = itemTemplate.replace("%itemname%", actAddItem.find(":selected").data("name"));
                itemTemplate = itemTemplate.replace("%itemqty%", actAddItemQty.val());
                itemTemplate = itemTemplate.replace("%itemprice%", "Php. " + totalprice);
                $("#addprjitms").append(itemTemplate);
                actAddItem.val("");
                actAddItemQty.val("");console.log(jsonObject);
                $("#actItmRowID" + resourceid).data('parameters',jsonObject);
            }
            updateItemColumn();
        } else {
            showError("Item not Added", "Please select the item and the desired quantity.");
        }
    });

$("#addactaddbtn").on("click", function() {
	actAddItem = $("#actadditem");
	actAddItemQty = $("#actadditemqty");
	if (actAddItem.val() !== "" || actAddItemQty.val() !== "") {
		if (ActModalMode == "add") {
			// check for existing resource..
			var selected = actAddItem.val();
			var existing = false;

			for (var i = 0; i < AddActItems.length; i++) {
				if (AddActItems[i]["resourceid"] == selected && AddActItems[i]["type"] == "1") {
					existing = true;
					AddActItems[i]["quantity"] = parseInt(AddActItems[i]["quantity"]) + parseInt(actAddItemQty.val());
					itemTemplate = '<td>%itemname%</td><td>%itemqty%</td><td>%itemprice%</td><td><button onclick="prjitemdel(event)" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Delete Item</button></td>';
					itemTemplate = itemTemplate.replace("%itemname%", actAddItem.find(":selected").text());
					itemTemplate = itemTemplate.replace("%itemqty%", AddActItems[i]["quantity"]);
					itemTemplate = itemTemplate.replace("%itemprice%", "Php. " + (parseInt(actAddItem.find(":selected").attr("price")) * parseInt(AddActItems[i]["quantity"])));
					$("tr[newid='"+i+"']").html(itemTemplate);
					break;
				}
			}

			if (!existing) {
				itemTemplate = '<tr newid="%itemrowid%"><td>%itemname%</td><td>%itemqty%</td><td>%itemprice%</td><td><button onclick="prjitemdel(event)" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Delete Item</button></td></tr>';
				itemTemplate = itemTemplate.replace("%itemrowid%", AddActItems.length);
				itemTemplate = itemTemplate.replace("%itemname%", actAddItem.find(":selected").text());
				itemTemplate = itemTemplate.replace("%itemqty%", actAddItemQty.val());
				itemTemplate = itemTemplate.replace("%itemprice%", "Php. " + (parseInt(actAddItem.find(":selected").attr("price")) * parseInt(actAddItemQty.val())));
				$("#addprjadds").append(itemTemplate);
				AddActItems.push({
					"resourceid":actAddItem.val(),
					"quantity":actAddItemQty.val(),
					"type":"1"
				});
			}
			actAddItem.val("");
			actAddItemQty.val("");
		} else if (ActModalMode == "edit") {
			// check for existing resource..
			var selected = actAddItem.val();
			var existing = false;
			for (var i = 0; i < theAct["items"].length; i++) {
				if (theAct["items"][i]["ResourceID"] == selected && theAct["items"][i]["Type"] == "1") {
					existing = true;
					var newTotal = parseInt(theAct["items"][i]["Quantity"]) + parseInt(actAddItemQty.val());
					itemTemplate = '<td>%itemname%</td><td>%itemqty%</td><td>%itemprice%</td><td><button onclick="prjitemdel(event)" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Delete Item</button></td>';
					itemTemplate = itemTemplate.replace("%itemname%", actAddItem.find(":selected").text());
					itemTemplate = itemTemplate.replace("%itemqty%", newTotal);
					itemTemplate = itemTemplate.replace("%itemprice%", "Php. " + (parseInt(actAddItem.find(":selected").attr("price")) * newTotal));
					$("tr[realrowid='"+i+"']").html(itemTemplate);
					break;
				}
			}

			for (var i = 0; i < EditOperations["add"].length; i++) {
				if (EditOperations["add"][i]["resourceid"] == selected && EditOperations["add"][i]["type"] == "1") {
					existing = true;
					var newTotal = parseInt(EditOperations["add"][i]["quantity"]) + parseInt(actAddItemQty.val());
					itemTemplate = '<td>%itemname%</td><td>%itemqty%</td><td>%itemprice%</td><td><button onclick="prjitemdel(event)" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Delete Item</button></td>';
					itemTemplate = itemTemplate.replace("%itemname%", actAddItem.find(":selected").text());
					itemTemplate = itemTemplate.replace("%itemqty%", newTotal);
					itemTemplate = itemTemplate.replace("%itemprice%", "Php. " + (parseInt(actAddItem.find(":selected").attr("price")) * newTotal));
					$("tr[newid='"+i+"']").html(itemTemplate);
					break;
				}
			}

			if (!existing) {
				itemTemplate = '<tr newid="%itemrowid%"><td>%itemname%</td><td>%itemqty%</td><td>%itemprice%</td><td><button onclick="prjitemdel(event)" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Delete Item</button></td></tr>';
				itemTemplate = itemTemplate.replace("%itemrowid%", EditOperations["add"].length);
				itemTemplate = itemTemplate.replace("%itemname%", actAddItem.find(":selected").text());
				itemTemplate = itemTemplate.replace("%itemqty%", actAddItemQty.val());
				itemTemplate = itemTemplate.replace("%itemprice%", "Php. " + (parseInt(actAddItem.find(":selected").attr("price")) * parseInt(actAddItemQty.val())));
				$("#addprjadds").append(itemTemplate);
			}
			EditOperations["add"].push({
				"resourceid":actAddItem.val(),
				"quantity":actAddItemQty.val(),
				"type":"1"
			});
			actAddItem.val("");
			actAddItemQty.val("");
		}
		calculateTotal();
	} else {
		showError("Item not Added", "Please select the item and the desired quantity.");
	}
});

Array.prototype.remove = function(index) {
	var rArray = [];
	var c  = 0;
	for (var i = 0; i < this.length; i++) {
		if (index !== i) {
			rArray[c] = this[i];
			c++;
		}
	}
	return rArray;
}

function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Byte';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

function getfiles() {
	xhr = new XMLHttpRequest();
	xhr.open("POST", "backend.php");
	xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
	jsr = {
		"do":"list_files",
		"projectid":ProjectID
	}
	xhr.send(JSON.stringify(jsr));
	xhr.onload = function() {
		$("#filesview").html("");
		files = JSON.parse(xhr.responseText);
		for (i = 0; i < files.length; i++) {
			if (user["Type"] == "client") {
				fileTemplate = "<tr fileid='%fileid%'><td>%filename%</td><td>%size%</td><td>%type%</td><td>%uploadeddate%</td><td>%viewimage%<a href='%downloadlink%' class='btn btn-success btn-sm'>Download File</a></td></tr>";
			} else {
				fileTemplate = "<tr fileid='%fileid%'><td>%filename%</td><td>%size%</td><td>%type%</td><td>%uploadeddate%</td><td>%viewimage%<a href='%downloadlink%' class='btn btn-success btn-sm'>Download File</a><button onclick='deletefile(event)' class='btn btn-danger btn-sm' style='margin-left:3px;'>Delete File</button></td></tr>";
			}
			fileTemplate = fileTemplate.replace("%filename%", files[i]["Name"]);
			fileTemplate = fileTemplate.replace("%size%", bytesToSize(files[i]["Size"]));
			datetime = FormalDateTime(files[i]["TimeStamp"]);
			fileTemplate = fileTemplate.replace("%uploadeddate%", datetime[0] + " " + datetime[1]);
			fileTemplate = fileTemplate.replace("%type%", files[i]["Type"]);
			if (files[i]["Type"].indexOf("image") > -1) {
				fileTemplate = fileTemplate.replace("%viewimage%", "<a class='fancybox btn btn-sm btn-warning' style='margin-right:3px;' href='projectfiles/"+files[i]["Filename"]+"'>View Image</a>");
			} else {
				fileTemplate = fileTemplate.replace("%viewimage%", "");
			}
			fileTemplate = fileTemplate.replace("%downloadlink%", "download.php?fileid=" + files[i]["FileID"]);
			fileTemplate = fileTemplate.replace("%fileid%", files[i]["FileID"]);
			$("#filesview").append(fileTemplate);
		}
		$(".fancybox").fancybox();
	}
}

function deletefile(theRow) {
	theRow = theRow.target.parentNode.parentNode;
	fileID = theRow.getAttribute("fileid");
	xhr = new XMLHttpRequest();
	xhr.open("POST", "backend.php");
	xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
	jsr = {
		"do":"delete_file",
		"fileid":fileID
	}
	xhr.send(JSON.stringify(jsr));
	xhr.onload = function() {
		showOk("File Deleted", "File Successfully Deleted.");
		theRow.parentNode.removeChild(theRow);
	}
}

function prjitemdel(theitm) {
	theItem = theitm.target.parentNode.parentNode;
	if (ActModalMode == "add") {
		AddActItems = AddActItems.remove(parseInt(theItem.getAttribute("newid")));
		theItem.parentNode.removeChild(theItem);
	} else if (ActModalMode == "edit") {
		theItemID = theitm.target.parentNode.parentNode.getAttribute("itemid");
		if (theItemID !== null) {
			EditOperations["delete"].push(theItemID);
			theItem.parentNode.removeChild(theItem);
		} else {
			EditOperations["add"] = EditOperations["add"].remove(parseInt(theItem.getAttribute("newid")));
			theItem.parentNode.removeChild(theItem);
		}
	}
	calculateTotal();
}

function updatePie(one, two) {
	var ctx = document.getElementById("myChart");
	var data = {
	    labels: [
	        "In Progress ("+one+"%)",
	        "Complete ("+two+"%)"
	    ],
	    datasets: [
	        {
	            data: [one, two],
	            backgroundColor: [
	                "#FF6384",
	                "#36A2EB"
	            ],
	            hoverBackgroundColor: [
	                "#FF6384",
	                "#36A2EB"
	            ]
	        }]
	};
	var myPieChart = new Chart(ctx,{
	    type: 'pie',
	    data: data
	});
}

function unselectall() {
	$("#commentsbtn").removeClass("selected");
	$("#controlmonitoringbtn").removeClass("selected");
	$("#activitiesbtn").removeClass("selected");
	$("#ganttpreviewbtn").removeClass("selected");
	$("#filesbtn").removeClass("selected");
	$("#resourcesbtn").removeClass("selected");

	$("#comments").css("display", "none");
	$("#control_monitor").css("display", "none");
	$("#activities").css("display", "none");
	$("#gantt_preview").css("display", "none");
	$("#projectfiles").css("display", "none");
	$("#resourcescont").css("display", "none");
}

$("#newcommentarea").on("keypress, keyup, keydown", function(event) {
	if (event.which == 13 && event.target.value.length > 0) {
		xhr = new XMLHttpRequest();
		xhr.open("POST", "backend.php");
		xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
		xhrd = {
			"do":"add_comment",
			"projectid":ProjectID,
			"commentdata":event.target.value
		}
		xhr.send(JSON.stringify(xhrd));
		xhr.onload = function() {
			theNow = FormalDateTime(new Date().toISOString().slice(0, 19).replace('T', ' '));
			cmt = $("#comment_template").html();
			cmt = cmt.replace("%username%", user["Name"]);
			cmt = cmt.replace("%date%", theNow[0]);
			cmt = cmt.replace("%time%", theNow[1]);
			cmt = cmt.replace("%commentdata%", event.target.value);
			$("#comments_area").append(cmt);
			$(event.target).val("");
			return false;
		}
	} else {
		event.target.style.height = "50px";
    	event.target.style.height = (event.target.scrollHeight)+"px";
	}
});

function getcomments() {
	xhr = new XMLHttpRequest();
	xhr.open("POST", "backend.php");
	xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
	xhrd = {
		"do":"get_comments",
		"projectid":ProjectID
	}
	xhr.send(JSON.stringify(xhrd));
	xhr.onload = function() {
		comments = JSON.parse(xhr.responseText);
		$("#comments_area").html("");
		for (i = 0; i < comments.length; i++) {
			theDate = FormalDateTime(comments[i]["TimeStamp"]);
			cmt = $("#comment_template").html();
			cmt = cmt.replace("%username%", comments[i]["ClientName"]);
			cmt = cmt.replace("%date%", theDate[0]);
			cmt = cmt.replace("%time%", theDate[1]);
			cmt = cmt.replace("%commentdata%", comments[i]["Data"]);
			$("#comments_area").append(cmt);
		}
		getResources();
	}
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

$("#choosefile").on("click", function() {
    $("#theFile").click();
});

$("#theFile").on("change", function(evt) {
    $("#filename").val(evt.target.files.item(0).name);
    $("#fileType").val(evt.target.files[0].type);
});

function clearuploadfields() {
    $("#fileType").val("");
    $("#filename").val("");
    $("#theFile").val("");
    $("#fileModal").modal("hide");
}

function uploadnow(evt) {
    upload = true;
    uploadForm = document.getElementById("uploadForm");
    if ($("#theFile").val() == "" || $("#filename").val() == "") {
        upload = false;
    }
    if (upload) {
        $("#uploaderror").css("display", "none");
        $(evt.target).prop("disabled", true);
        $(evt.target).html("<img src='images/ajax-loader.gif' /> Uploading...");

        theReq = {
            "do":"addfile",
            "projectid":ProjectID,
            "filename":$("#filename").val(),
            "type":uploadForm[0].value
        };
        if (FileReader) {
          var fr = new FileReader();
          fr.onload = function () {
            theReq["file"] = fr.result;
            xmlhttp = new XMLHttpRequest();
            xmlhttp.open("POST", "backend.php");
            xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xmlhttp.send(JSON.stringify(theReq));
            xmlhttp.onload = function() {
                xx = JSON.parse(xmlhttp.responseText);
                if (xx["success"]) {
                    $("#uploaderror").css("display", "none");
                    $(evt.target).prop("disabled", false);
                    $(evt.target).html("Close");
                    $(evt.target).off("click");
                    $(evt.target).on("click", function() {
                        $("#uploaderror").removeClass("alert-success");
                        $("#uploaderror").addClass("alert-danger");
                        $("#uploaderror").css("display", "none");
                        clearuploadfields();
                        $("#fileModal").modal("hide");
                        $(evt.target).html("Upload File");
                        getfiles();
                        $(evt.target).off("click");
                        $(evt.target).on("click", function(evt) {
                            uploadnow(evt);
                        });
                    });
                    $("#uploaderror").removeClass("alert-danger");
                    $("#uploaderror").addClass("alert-success");
                    $("#uploaderror").html("<b>Success:</b> File Successfully Uploaded. Please press the OK button to close window.");
                    $("#uploaderror").css("display", "block");
                } else {
                    $(evt.target).html("Upload File");
                    $(evt.target).prop("disabled", false);
                    $("#uploaderror").css("display", "block");
                    $("#uploaderror").html("<b>Error:</b> There is something wrong with the server. Please try again later.");
                }
            }
          }
          fr.readAsDataURL(document.getElementById("theFile").files[0]);
        } else {
            alert("File Upload not possible.");
        }
    } else {
        $("#uploaderror").css("display", "block");
        $("#uploaderror").html("<b>Error:</b> Please choose a file to upload and be sure to fill up all the forms.");
    }
}

$("#uploadnow").on("click", function(evt) {
    uploadnow(evt);
});


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

function deleteAct(theActt) {
	theRow = theActt.target.parentNode.parentNode;
	theActID = theRow.getAttribute("actid");
	xhr = new XMLHttpRequest();
	xhr.open("POST", "backend.php");
	xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
	xhrd = {
		"do":"delete_activity",
		"activityid":theActID
	}
	xhr.send(JSON.stringify(xhrd));
	xhr.onload = function() {
		delres = JSON.parse(xhr.responseText);
		if (delres["success"]) {
			$("#progressindicator").html(Math.round(delres["progress"]) + "%");
			if (delres["progress"] == "100" || delres["progress"] == 100) {
				$("#statusindicator").html("Completed");
			} else {
				$("#statusindicator").html("In Progress");
			}
			var completed = Math.round(delres["progress"]);
			var inprogress = 100 - completed;
			updatePie(inprogress, completed);
			theRow.parentNode.removeChild(theRow);
			showOk("Activity Deleted", "The Activity was deleted successfully");
		}
	}
}

function getactivities() {
	xhr = new XMLHttpRequest();
	xhr.open("POST", "backend.php");
	xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
	xhrd = {
		"do":"get_activities",
		"projectid":ProjectID
	}
	xhr.send(JSON.stringify(xhrd));
	xhr.onload = function() {
		ActTotalPrice = 0;
		activities = JSON.parse(xhr.responseText);
		$("#activityview").html("");
		ogags = false;
                doneArray = [];
                activityheader = '';
		for (i = 0; i < activities.length; i++) {
                        if(activities[i]["Done"] == 1){
                            doneArray.push(activities[i]["TaskID"]);
                        }
                        if(activityheader != activities[i]["Activity"])
                        {
                            parameters = {"name":activities[i]["Activity"]};
                            $("#activityview").append('<tr actid="'+activities[i]["ActivityID"]+'" class=" coloredtr row_activity activity_'+activities[i]["ActivityID"]+'"><td colspan="6" style ="font-weight:bold;">'+activities[i]["Activity"]+'</td></tr>');
                            $("#activityview").find('tr:last').data('parameters',JSON.stringify(parameters));
                            activityheader = activities[i]["Activity"];
                        }
//			if (user["Type"] == "client") {
				theActivity = '<tr taskid="%taskid%" class="coloredtr activity_'+activities[i]["ActivityID"]+' row_task"><td style="padding-left: 20px;">%actname%</td><td>%days% Day/s</td><td>%startdate%</td><td>%enddate%</td><td>Php. %totalprice%</td><td><input onchange="checkState(event)" class="doneCheckbox" type="checkbox" style="margin-left:5px;margin-right:3px;" %checked%/>Done</td></tr>';
//			} else {
//				theActivity = '<tr actid="%actid%"><td>%actname%</td><td>%days% Day/s</td><td>%startdate%</td><td>%enddate%</td><td>Php. %totalprice%</td><td><button onclick="editAct(event)" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-plus"></span> Edit Activity/Items</button> <button onclick="deleteAct(event)" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Delete Activity</button><input onchange="checkState(event)" type="checkbox" style="margin-left:5px;margin-right:3px;" %checked%/>Done</td></tr>';
//			}
			theActivity = theActivity.replace("%taskid%", activities[i]["TaskID"]).replace("%actname%", activities[i]["Name"]).replace("%days%", activities[i]["Days"] ).replace("%startdate%", FormalDateTime(activities[i]["StartDate"])[0]);
                        endDate = (activities[i]["ActualEndDate"] != '0000-00-00 00:00:00') ? activities[i]["ActualEndDate"]:activities[i]["EndDate"];
 
                        theActivity = theActivity.replace("%enddate%", FormalDateTime(endDate)[0]);
			if (activities[i]["TotalPrice"] !== null) {
				theActivity = theActivity.replace("%totalprice%", activities[i]["TotalPrice"]);
				ActTotalPrice += parseInt(activities[i]["TotalPrice"]);
			} else {
				theActivity = theActivity.replace("%totalprice%", "0");
			}
			if ((activities[i]["Done"] == "0" || activities[i]["Done"] == 0) && !ogags) {
				theActivity = theActivity.replace("%checked%", "");
			}else if (activities[i]["Done"] == "1" || activities[i]["Done"] == 1) {
				theActivity = theActivity.replace("%checked%", "checked disabled");
			}else if ((activities[i]["Done"] == "0" || activities[i]["Done"] == 0) && activities[i]["Parent"] == 0) {
				theActivity = theActivity.replace("%checked%", "");
			}else if ((activities[i]["Done"] == "0" || activities[i]["Done"] == 0) && $.inArray( activities[i]["Parent"], doneArray ) != -1) {
				theActivity = theActivity.replace("%checked%", "");
			}else{
                            theActivity = theActivity.replace("%checked%", "disabled");
                        }
                        ogags = true;
                        parameters = {
                            "from":activities[i]["StartDate"].substring(0,10),
                            "to":activities[i]["EndDate"].substring(0,10),
                            "actualTo":activities[i]["ActualEndDate"].substring(0,10),
                            "label":activities[i]["Name"],
                            "activity":"Earthworks",
                            "days":activities[i]["Days"],
                            "actualDays":activities[i]["ActualDays"],
                            "temporaryid":activities[i]["TaskID"],
                            "parent":activities[i]["Parent"],
                            };
			$("#activityview").append(theActivity);
                        $('#temporaryid').val(activities[i]["TaskID"]);
                        $("#hiddenactivityid").val( parseInt(activities[i]["ActivityID"]) + 1);
                        $("#activityview").find('tr:last').data('parameters',JSON.stringify(parameters));
		}
		$("#totalpriceview").html("Php. " + ActTotalPrice);
		drawChart();
	}
}

$("#simgantt").on("click", function() {
	if ($("#actname").val() !== "" && $("#actstartdate").val() !== "" && $("#actenddate").val() !== "") {
		$("#addActModal").modal("hide");
		$("#ganttModal").on("shown.bs.modal", function() {
			loadsimgantt();
		});
		$("#ganttModal").modal("show");
	}
});

$("#closesim").on("click", function() {
	$("#ganttModal").modal("hide");
	$("#addActModal").modal("show");
});

CurrentActivityID = 0;
function loadsimgantt() {
	xhr = new XMLHttpRequest();
	xhr.open("POST", "backend.php");
	xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
	xhrd = {
		"do":"get_activities",
		"projectid":ProjectID
	}
	xhr.send(JSON.stringify(xhrd));
	xhr.onload = function() {
		theActivities = JSON.parse(xhr.responseText);
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
		  		"[Project] " + $("#prjnameindicator").html(),
		  		new Date($("#prjstartdateindicator").attr("rawdate").split(" ")[0]),
		  		new Date($("#prjenddateindicator").attr("rawdate").split(" ")[0]),
		  		parseInt(getDaysBetweenDates($("#prjstartdateindicator").attr("rawdate").split(" ")[0], $("#prjenddateindicator").attr("rawdate").split(" ")[0])),
		  		0,
		  		null
		      ];
		      theRow.push(mainRow);
		      for (var c = 0; c < theActivities.length; c++) {
		      	theRow.push([
		      		c+"act",
		      		"[Activity] " + theActivities[c]["Name"],
		      		new Date(theActivities[c]["StartDate"].split(" ")[0]),
		      		new Date(theActivities[c]["EndDate"].split(" ")[0]),
		      		parseInt(getDaysBetweenDates(theActivities[c]["StartDate"].split(" ")[0], theActivities[c]["EndDate"].split(" ")[0])),
		      		0,
		      		null
		      	]);
		      }
		      data.addRows(theRow);

		      var options = {
		      	 height: 100 + (50 * theActivities.length)
		      	};

		      var chart = new google.visualization.Gantt(document.getElementById('gantt_orig'));
		      chart.draw(data, options);



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
		  		"[Project] " + $("#prjnameindicator").html(),
		  		new Date($("#prjstartdateindicator").attr("rawdate").split(" ")[0]),
		  		new Date($("#prjenddateindicator").attr("rawdate").split(" ")[0]),
		  		parseInt(getDaysBetweenDates($("#prjstartdateindicator").attr("rawdate").split(" ")[0], $("#prjenddateindicator").attr("rawdate").split(" ")[0])),
		  		0,
		  		null
		      ];
		      theRow.push(mainRow);
		      for (var c = 0; c < theActivities.length; c++) {
		      	if (CurrentActivityID !== theActivities[c]["ActivityID"]) {
			      	theRow.push([
			      		c+"act",
			      		"[Activity] " + theActivities[c]["Name"],
			      		new Date(theActivities[c]["StartDate"].split(" ")[0]),
			      		new Date(theActivities[c]["EndDate"].split(" ")[0]),
			      		parseInt(getDaysBetweenDates(theActivities[c]["StartDate"].split(" ")[0], theActivities[c]["EndDate"].split(" ")[0])),
			      		0,
			      		null
			      	]);
		      	} else {
		      		theRow.push([
			      		c+"act",
			      		"[Activity] " + $("#actname").val(),
			      		new Date($("#actstartdate").val()),
			      		new Date($("#actenddate").val()),
			      		parseInt(getDaysBetweenDates($("#actstartdate").val(), $("#actenddate").val())),
			      		0,
			      		null
			      	]);
		      	}
		      }

		      if (ActModalMode == "add") {
		      	theRow.push([
		      		c+"act",
		      		"[Activity] " + $("#actname").val(),
		      		new Date($("#actstartdate").val()),
		      		new Date($("#actenddate").val()),
		      		parseInt(getDaysBetweenDates($("#actstartdate").val(), $("#actenddate").val())),
		      		0,
		      		null
			     ]);
		      }

		      data.addRows(theRow);

		      var options = {
		      	 height: 100 + (50 * theActivities.length)
		      	};

		      var chart = new google.visualization.Gantt(document.getElementById('gantt_sim'));
		      chart.draw(data, options);
	}
}

//  	google.charts.load('current', {'packages':['gantt']});
    // google.charts.setOnLoadCallback(drawChart);

    function daysToMilliseconds(days) {
      return days * 24 * 60 * 60 * 1000;
    }

    function drawChart2(theActivities) {
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
		  		"[Project] " + $("#prjnameindicator").html(),
		  		new Date($("#prjstartdateindicator").attr("rawdate").split(" ")[0]),
		  		new Date($("#prjenddateindicator").attr("rawdate").split(" ")[0]),
		  		parseInt(getDaysBetweenDates($("#prjstartdateindicator").attr("rawdate").split(" ")[0], $("#prjenddateindicator").attr("rawdate").split(" ")[0])),
		  		0,
		  		null
		      ];
		      theRow.push(mainRow);
		      for (var c = 0; c < theActivities.length; c++) {
		      	theRow.push([
		      		c+"act",
		      		"[Activity] " + theActivities[c]["Name"],
		      		new Date(theActivities[c]["StartDate"].split(" ")[0]),
		      		new Date(theActivities[c]["EndDate"].split(" ")[0]),
		      		parseInt(getDaysBetweenDates(theActivities[c]["StartDate"].split(" ")[0], theActivities[c]["EndDate"].split(" ")[0])),
		      		0,
		      		null
		      	]);
		      }
		      data.addRows(theRow);

		      var options = {
		      	 height: 100 + (40 * theActivities.length)
		      	};

		      var chart = new google.visualization.Gantt(document.getElementById('gantt_div'));
		      chart.draw(data, options);
	    }
    }
$(document).on("change" ,".doneCheckbox",function() {
    params = JSON.parse($(this).closest('.row_task').data('parameters'));
	xhr = new XMLHttpRequest();
	xhr.open("POST", "backend.php");
	xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
	jsr = {
		"do":"task_done",
		"taskid":params.temporaryid
	}
	xhr.send(JSON.stringify(jsr));
	xhr.onload = function() {
		theCheck = JSON.parse(xhr.responseText);
		if (user["Type"] == "client") {
			showOk("Edit Request Sent", "Change Request successfully sent.");
			theRowx.target.value = "";
		} else {
			$("#progressindicator").html(Math.round(theCheck["progress"]) + "%");
			if (theCheck["progress"] == "100" || theCheck["progress"] == 100) {
				$("#statusindicator").html("Completed");
			} else {
				$("#statusindicator").html("In Progress");
			}
			var completed = Math.round(theCheck["progress"]);
			var inprogress = 100 - completed;
			updatePie(inprogress, completed);
			getactivities();
		}
	}
});

$(document).on("change" ,".editused",function() {

//	tActResID = theRow.getAttribute("actresid");
	theRow = $(this).closest('tr');
        ActResId = $(this).closest('tr').attr('actresid');
        theQuantity = $(this).closest('tr').find('td:eq(1)').html();
	if (parseInt($(this).val()) <= parseInt(theQuantity)) {
		xhr = new XMLHttpRequest();
		xhr.open("POST", "backend.php");
		xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
		xhr.send(JSON.stringify({
			"do":"update_used_resource",
			"taskresid":ActResId,
			"use":$(this).val()
		}));
		xhr.onload = function() {
			eEe = JSON.parse(xhr.responseText);
			if (eEe["success"]) {
				$("#edituseModal").modal("hide");
				if (user["Type"] == "client") {
					showOk("Edit Request Sent", "Change Request successfully sent.");
					$(this).val('');
				} else {
					tblPlate = "<td>%name%</td><td>%quantity%</td><td><input placeholder='%used%' style='width:100px;border-style:solid;border-color:#c6c6c6;border-width:1px;' onchange='editused(event)' /></td><td>%remaining%</td>";
					tblPlate = tblPlate.replace("%name%",  $(theRow).find('tr:eq(0)').html());
					tblPlate = tblPlate.replace("%quantity%", theQuantity);
					tblPlate = tblPlate.replace("%used%", eEe["used"]);
					tblPlate = tblPlate.replace("%remaining%", eEe["remaining"]);
                                        $(theRow).html(tblPlate)
				}
			} 
		}
	} else {
		showError("Edit Error", "Used Quantity must be less than the Real Quantity");
	}
});
function editused(theRowx) {
//    
//	theRow = theRowx.target.parentNode.parentNode;
//	tActResID = theRow.getAttribute("actresid");
//	theQuantity = theRow.childNodes[1].innerHTML;
//	if (parseInt(theRowx.target.value) <= parseInt(theQuantity)) {
//		xhr = new XMLHttpRequest();
//		xhr.open("POST", "backend.php");
//		xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
//		xhr.send(JSON.stringify({
//			"do":"update_used_resource",
//			"actresid":tActResID,
//			"use":theRowx.target.value
//		}));
//		xhr.onload = function() {
//			eEe = JSON.parse(xhr.responseText);
//			if (eEe["success"]) {
//				$("#edituseModal").modal("hide");
//				if (user["Type"] == "client") {
//					showOk("Edit Request Sent", "Change Request successfully sent.");
//					theRowx.target.value = "";
//				} else {
//					tblPlate = "<td>%name%</td><td>%quantity%</td><td><input placeholder='%used%' style='width:100px;border-style:solid;border-color:#c6c6c6;border-width:1px;' onchange='editused(event)' /></td><td>%remaining%</td>";
//					tblPlate = tblPlate.replace("%name%", theRow.childNodes[0].innerHTML);
//					tblPlate = tblPlate.replace("%quantity%", theQuantity);
//					tblPlate = tblPlate.replace("%used%", eEe["used"]);
//					tblPlate = tblPlate.replace("%remaining%", eEe["remaining"]);
//					theRow.innerHTML = tblPlate;
//				}
//			} else {
//				alert("Tangina there is a problem!");
//			}
//		}
//	} else {
//		showError("Edit Error", "Used Quantity must be less than the Real Quantity");
//	}
}

function getcurrentactivity() {
	xhr = new XMLHttpRequest();
	xhr.open("POST", "backend.php");
	xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
	xhr.send(JSON.stringify({
		"do":"get_current_activity",
		"projectid":ProjectID
	}));
	xhr.onload = function() {
		tActivity = JSON.parse(xhr.responseText);
		theCont = $("#currentacts");
		theCont.html("");
		for (var i = 0; i < tActivity.length; i++) {
			mmT = "<span style=\"font-size:18px;font-weight:lighter;display:block;margin-top:3px;\">Current Task: <span style=\"font-size:12px;color:gray;font-weight:normal;\">%theactivityname%<\/span><\/span>\r\n<hr style=\"margin-top:5px;margin-bottom:5px;\"\/>\r\n<table class=\"project_table\" style=\"width:100%;border-bottom:1px solid #929292;\">\r\n<thead>\r\n<tr>\r\n<th style=\"width:40%\">Resource Name<\/th>\r\n<th style=\"width:20%\">Quantity<\/th>\r\n<th style=\"width:20%\">Used<\/th>\r\n<th style=\"width:20%\">Remaining<\/th>\r\n<\/tr>\r\n<\/thead>\r\n<tbody>\r\n%tdata%\r\n<\/tbody>\r\n<\/table>";
			nnT = "";
			for (var j = 0; j < tActivity[i]["resources"].length; j++) {
				if (user["Type"] == "client") {
					tblPlate = "<tr actresid='%actresid%' class='coloredtr'><td>%name%</td><td>%quantity%</td><td>%used%</td><td>%remaining%</td></tr>";
				} else {
					tblPlate = "<tr actresid='%actresid%' class='coloredtr'><td>%name%</td><td>%quantity%</td><td><input placeholder='%used%' style='width:100px;border-style:solid;border-color:#c6c6c6;border-width:1px;' class='editused' onchange='editused(event)' /></td><td>%remaining%</td></tr>";
				}
				tblPlate = tblPlate.replace("%actresid%", tActivity[i]["resources"][j]["TaskResID"]);
				tblPlate = tblPlate.replace("%name%", tActivity[i]["resources"][j]["ResourceName"]);
				tblPlate = tblPlate.replace("%quantity%", tActivity[i]["resources"][j]["Quantity"]);
				tblPlate = tblPlate.replace("%used%", tActivity[i]["resources"][j]["Used"]);
				tblPlate = tblPlate.replace("%remaining%", tActivity[i]["resources"][j]["Remaining"]);
				nnT += tblPlate;
			}
			mmT = mmT.replace("%theactivityname%", tActivity[i]["Name"]);
			mmT = mmT.replace("%tdata%", nnT);
			theCont.append(mmT);
		}
	}
}

function getallresources() {
	theTbl = $("#allresourcestbl");
	xhr = new XMLHttpRequest();
	xhr.open("POST", "backend.php");
	xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
	xhr.send(JSON.stringify({
		"do":"list_project_resources",
		"projectid":ProjectID
	}));
	xhr.onload = function() {
		theResources = JSON.parse(xhr.responseText);
		theTbl.html("");
		tPrice = 0;
		for (var i = 0; i < theResources.length; i++) {
			tblPlate = "<tr class='coloredtr'><td>%name%</td><td>%quantity%</td><td>%price%</td></tr>";
			tblPlate = tblPlate.replace("%name%", theResources[i]["ResourceName"]);
			tblPlate = tblPlate.replace("%quantity%", theResources[i]["QuantityTotal"]);
			tblPlate = tblPlate.replace("%price%", "Php. " + theResources[i]["PriceTotal"]);
			theTbl.append(tblPlate);
			tPrice += parseInt(theResources[i]["PriceTotal"]);
		}
                theTbl.append("<hr/>");
		$("#overallresourcesprice").html("Php. " + tPrice);
		getcurrentactivity();
	}
}

function controls() {
	xhr = new XMLHttpRequest();
	xhr.open("POST", "backend.php");
	xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
	xhr.send(JSON.stringify({
		"do":"getproject",
		"projectid":ProjectID
	}));
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
		$("#act_list").html("");
		for (var a = 0; a < proj["activities"].length; a++) {
			tBlex = '<span style="margin-top:5px;font-size:18px;font-weight:lighter;display:block;">%header% <span style="font-size:12px;color:gray;">%actprice%</span></span><hr style="margin-top:5px;margin-bottom:5px;"/><table class="form_table" style="min-width:300px;"><tr><td>Task Name:</td><td style="color:gray;">%actname%</td></tr><tr><td>Start Date:</td><td style="color:gray;">%startdate%</td></tr><tr><td>End Date:</td><td style="color:gray;">%enddate%</td></tr><tr><td>Programmed Cost:</td><td style="color:gray;">%pcost%</td></tr><tr><td>Actual Cost:</td><td style="color:gray;">%acost%</td></tr><tr><td>Status:</td><td style="color:gray;">%astatus%</td></tr></table><h4 style="text-align:center;font-weight:lighter">Task Resources</h4><table class="project_table" style="width:100%;"><thead><tr><th>Resource Name</th><th>Quantity</th><th>Used</th><th>Remaining</th><th>Cost</th><th>Actual Cost</th></tr></thead><tbody>%tbldata%</tbody></table>';
			tBlex = tBlex.replace("%header%",proj["activities"][a]["Activity"] +' - '+proj["activities"][a]["Name"]);
			tBlex = tBlex.replace("%actname%", proj["activities"][a]["Name"]);
			tBlex = tBlex.replace("%startdate%", FormalDateTime(proj["activities"][a]["StartDate"])[0]);
			tBlex = tBlex.replace("%enddate%", FormalDateTime(proj["activities"][a]["EndDate"])[0]);
                        tBlex = tBlex.replace("%astatus%", proj["activities"][a]["Done"]== 1 ? 'Done':'In Progress');
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
				bLej = "<tr class='coloredtr'><td>%name%</td><td>%qty%</td><td>%used%</td><td>%remaining%</td><td>%pcost%</td><td>%acost%</td></tr>";
				bLej = bLej.replace("%name%", proj["activities"][a]["resources"][b]["ResourceName"]);
				bLej = bLej.replace("%qty%", proj["activities"][a]["resources"][b]["Quantity"]);
				bLej = bLej.replace("%remaining%", proj["activities"][a]["resources"][b]["Remaining"]);
				bLej = bLej.replace("%used%", proj["activities"][a]["resources"][b]["Used"]);
				thePrice = parseInt(proj["activities"][a]["resources"][b]["ResourcePrice"]) * parseInt(proj["activities"][a]["resources"][b]["Quantity"]);
				bLej = bLej.replace("%pcost%", "Php. " + thePrice);
				bLej = bLej.replace("%acost%", "Php. " + parseInt(proj["activities"][a]["resources"][b]["ResourcePrice"]) * parseInt(proj["activities"][a]["resources"][b]["Used"]));
				ActPrice += thePrice;
				bLejx += bLej;
			}
			tBlex = tBlex.replace("%tbldata%", bLejx);
			tBlex = tBlex.replace("%actprice%", "Php. " + ActPrice);
			$("#act_list").append(tBlex);
		}
	}
}

$("#commentsbtn").on("click", function(event) {
	unselectall();
	$("#commentsbtn").addClass("selected");
	$("#comments").css("display", "block");
});

$("#controlmonitoringbtn").on("click", function(event) {
	unselectall();
	$("#controlmonitoringbtn").addClass("selected");
	$("#control_monitor").css("display", "block");
	controls();
});

$("#activitiesbtn").on("click", function(event) {
	unselectall();
	$("#activitiesbtn").addClass("selected");
	$("#activities").css("display", "block");
	getactivities();
});

$("#ganttpreviewbtn").on("click", function(event) {
	unselectall();
	getactivities();
	$("#ganttpreviewbtn").addClass("selected");
	$("#gantt_preview").css("display", "block");
});

$("#filesbtn").on("click", function(event) {
	unselectall();
	$("#filesbtn").addClass("selected");
	$("#projectfiles").css("display", "block");
	getfiles();
});

$("#resourcesbtn").on("click", function() {
	unselectall();
	$("#resourcesbtn").addClass("selected");
	$("#resourcescont").css("display", "block");
	getallresources();
});

    $("#addtaskbutton").on("click", function () {
        mode = $(this).data('mode');
        if(mode == 'none'){
            populateParentDropdown();
            $("#addtaskname").val('');
            $("#adddays").val('');
            $("#addstartdate").val('');
            $("#addenddate").val('');
            $("#addparent").val('');
            $(".task_form").show();
            $("#tdnotify").hide();
            $("#addnotify").prop('checked',false);
            $("#addmessage").val('');
            $(this).html('Add');
            $(this).data('mode','add');
            
        }
        else if(mode == 'add'){
            taskName = $("#addtaskname").val();
            taskDay = $("#adddays").val();
            taskstartday = $("#addstartdate").val();
            taskendday = $("#addenddate").val();
            actname = $("#actname").val();
            temporaryid = parseInt($("#temporaryid").val()) + 1;
            parentid = $("#addparent").val();
            notify = $("#addnotify").is(':checked');
            message = $("#addmessage").val();
            $("#temporaryid").val(temporaryid);
            var formattaskstartday = new Date(taskstartday );
            var formattaskendday = new Date(taskendday );
            if (taskName != "" && taskDay != "" && taskstartday != "" && taskendday != ""&& actname != "") {
                jsonObject= {"from":taskstartday,"to":taskendday,"label":taskName,"activity":actname,"days":taskDay,"temporaryid":temporaryid,"parentid":parentid,"manpower":[],"material":[],"equipment":[],"notify":notify,"message":message};
                var row = '<tr class="add_row_task add_task_'+temporaryid+'"><td>'+taskName+'</td> <td>'+taskDay+'</td><td>'+formattaskstartday.toInputFormat()+'</td><td>'+formattaskendday.toInputFormat()+'</td><td></td><td></td><td><td/>\n\
                <td><button class="edittaskbutton btn-xs"><span class="glyphicon glyphicon-edit"></button>\n\
                <button class="deletetaskbutton btn-xs"><span class="glyphicon glyphicon-remove"></button></td></tr>';
                $("#addtasktable").append(row);
                 $(this).data('mode','none');
                 $(".task_form").hide();
                 $(this).html('Add Task');
                 $('.add_row_task:last').data('parameters', jsonObject).trigger('click');
                 populateParentDropdown();
            } else {
                showError("task not Added", "Please fill up all task the fields.");
            }
        }
        else if(mode == 'edit'){
            
            taskName = $("#addtaskname").val();
            taskDay = $("#adddays").val();
            taskstartday = $("#addstartdate").val();
            taskendday = $("#addenddate").val();
            actname = $("#actname").val();
            temporaryid = parseInt($("#addeditid").val())  ;
            parentid = $("#addparent").val();
            notify = $("#addnotify").is(':checked');
            message = $("#addmessage").val();
            oldJson = $("#addtasktable").find('.add_task_'+temporaryid).data('parameters');
            var formattaskstartday = new Date(taskstartday );
            var formattaskendday = new Date(taskendday );
            if(oldJson.to != taskendday){
                updateChildTaskStartdateModal(temporaryid, taskendday);
            }
            if (taskName != "" && taskDay != "" && taskstartday != "" && taskendday != ""&& actname != "") {
                jsonObject= {"from":taskstartday,"to":taskendday,"label":taskName,"activity":actname,"days":taskDay,"temporaryid":temporaryid,"parentid":parentid,"manpower":oldJson.manpower,"material":oldJson.material,"equipment":oldJson.equipment,"notify":notify,"message":message};
                var row = '<td>'+taskName+'</td> <td>'+taskDay+'</td><td>'+formattaskstartday.toInputFormat()+'</td><td>'+formattaskendday.toInputFormat()+'</td><td></td><td></td><td><td/>\n\
                <td><button class="edittaskbutton btn-xs" ><span class="glyphicon glyphicon-edit"></button>\n\
                <button class="deletetaskbutton btn-xs" ><span class="glyphicon glyphicon-remove"></button></td>';
                manpowerhtml = $("#addtasktable").find('.add_task_'+temporaryid).find('td:eq(4)').html();
                materialhtml = $("#addtasktable").find('.add_task_'+temporaryid).find('td:eq(5)').html();
                equipmenthtml = $("#addtasktable").find('.add_task_'+temporaryid).find('td:eq(6)').html();
                $("#addtasktable").find('.add_task_'+temporaryid).html(row);
                 $("#addtasktable").find('.add_task_'+temporaryid).find('td:eq(4)').html(manpowerhtml);
                 $("#addtasktable").find('.add_task_'+temporaryid).find('td:eq(5)').html(materialhtml);
                 $("#addtasktable").find('.add_task_'+temporaryid).find('td:eq(6)').html(equipmenthtml);
                 $(this).data('mode','none');
                 $(".task_form").hide();
                 $(this).html('Add Task');
                 $("#addtasktable").find('.add_task_'+temporaryid).data('parameters', jsonObject).trigger('click');
                 populateParentDropdown();
            } else {
                showError("task not Added", "Please fill up all task the fields.");
            }
        }
    });
    
    $("#canceltaskbutton").on("click", function () {
        $("#addtaskbutton").data('mode','none');
        $(".task_form").hide();
        $("#addtaskbutton").html('Add Task');
    });
    $("#addstartdate, #adddays").on("change", function () {
        taskDay =$("#adddays").val();
        taskstartday = $("#addstartdate").val();
        if ( taskDay != "" && taskstartday != "" ) {
            var end =  new Date(taskstartday );
            end.setDate(end.getDate() + parseInt(taskDay)  -1); 
            $('#addenddate').datepicker('setDate', end);
        }   
    });
    
    function populateParentDropdown() {
        $("#addparent").html('<option value="">-- Select Parent Task--</option>');
        $('.row_task').each(function(){
            var dataParameters = JSON.parse($(this).data('parameters'));
            $('#addparent').append('<option class="parenttaskoption" value="'+dataParameters.temporaryid+'" startdate='+dataParameters.to   +'>'+dataParameters.label+'</option>');

        });
    }
    $(document).on("change" ,"#addparent",function() {
        if($(".parenttaskoption:selected").length >0 )
        {
            startdate = $(".parenttaskoption:selected").attr('startdate');
            if(startdate!= ''){
                    var start =  new Date(startdate );
                    start.setDate(start.getDate() + 1);
                    $('#addstartdate').datepicker('setDate', start);
                    taskDay =$("#adddays").val();
                    if ( taskDay != "" && start != "" ) {
                        var end =  new Date(startdate );
                        end.setDate(end.getDate() + parseInt(taskDay) +2); 
                        $('#addenddate').datepicker('setDate', end);
                    }   
            }
        }
    });
    $(document).on("change" ,"#addnotify",function() {
        if($(this).is(':checked') )
        {
            $('#tdnotify').show();
            if (!($('#addmessage').val()!='')){
                message = $('#addmessagetemplate').val();
                message= message.replace("%clientNameHolder%",$('#prjclientnameindicator').html());
                message= message.replace("%locationHolder%",$('#prjlocation').val());
                message= message.replace("%startDateHolder%",$('#addstartdate').val());
                message= message.replace("%taskNameHolder%",$('#addtaskname').val());
                $('#addmessage').val(message);
            }
        }
        else
        {
            $('#tdnotify').hide();
            $('#addmessage').val('');
        }
    });
    
    $(document).on("click" ,".editactivity",function() {
        $('#addtaskbutton').data('mode','none');
        $('#addtaskbutton').html('Add Task');
        classes = $(this).closest('.row_activity').attr("class");
        activityparameters = JSON.parse($(this).closest('.row_activity').data('parameters'));
        $("#actname").val(activityparameters.name);
        var array = classes.split(' ');
        modalMode = "edit";
        $("#addActivityModal").find("#theModalTask").html("Edit Activity");
        $("#addActivityModal").find("#addactbtn").html("Edit Activity");
        $("#addActivityModal").modal("show");
        $("#hiddeneditactivityid").val(array[1]);
        $("#addtasktable").html('');
        $("#addnotify").prop('checked',false);
        
        $('.'+array[1]+'.row_task').each(function(){
            taskparameter = JSON.parse($(this).data('parameters'));
            taskName = taskparameter.label;
            taskDay = taskparameter.days;
            taskstartday = taskparameter.from;
            taskendday = taskparameter.to;
            actname = taskparameter.activity;
            temporaryid = taskparameter.temporaryid;
            parentid = taskparameter.parentid;
            
            manpowerText='';
            materialText='';
            equipmentText='';
            var formattaskstartday = new Date(taskstartday );
            var formattaskendday = new Date(taskendday );
            if (taskName != "" && taskstartday != "" && taskendday != ""&& actname != "") {
                jsonObject= {"from":taskstartday,"to":taskendday,"label":taskName,"activity":actname,"days":taskDay,"temporaryid":temporaryid,"parentid":parentid,"manpower":taskparameter.manpower,"material":taskparameter.material,"equipment":taskparameter.equipment,"notify":taskparameter.notify,"message":taskparameter.message};
                var row = '<tr class="add_row_task add_task_'+temporaryid+'"><td>'+taskName+'</td> <td>'+taskDay+'</td><td>'+formattaskstartday.toInputFormat()+'</td><td>'+formattaskendday.toInputFormat()+'</td><td></td><td></td><td><td/>\n\
                <td><button class="edittaskbutton btn-xs"><span class="glyphicon glyphicon-edit"></button>\n\
                <button class="deletetaskbutton btn-xs"><span class="glyphicon glyphicon-remove"></button></td></tr>';
                $("#addtasktable").append(row);
                $.each(taskparameter.manpower, function(index, manpower){
                    manpowerText = manpowerText + ' ' + manpower.quantity + ' ' + manpower.name + '<br/>';
                });
                $.each(taskparameter.material, function(index, material){
                    materialText = materialText + ' ' + material.quantity + 'pcs. ' + material.name + '<br/>';
                });
                $.each(taskparameter.equipment, function(index, equipment){
                    equipmentText = equipmentText + ' ' + equipment.quantity + 'pcs. ' + equipment.name + '<br/>';
                });                
                $("#addtasktable").find("tr:last").find('td:eq(4)').html(manpowerText);
                $("#addtasktable").find("tr:last").find('td:eq(5)').html(materialText);
                $("#addtasktable").find("tr:last").find('td:eq(6)').html(equipmentText);
                 $(this).data('mode','none');
                 $(".task_form").hide();
                 $('.add_row_task:last').data('parameters', jsonObject).trigger('click');
                 populateParentDropdown();
             }
             
        });
    });
    
    function updateItemColumn(){
        $('.add_row_task.selected').find('td:eq(4)').html('');
        $('.add_row_task.selected').find('td:eq(5)').html('');
        materialobject =[];
        manpowerobject =[];
        equipmentobject =[];
        $("#addprjitms tr").each(function(){
            parameters = $(this).data('parameters');
            materialhtml='';
            manpowerhtml='';
            if(parameters.type == 'manpower'){
                manpowerhtml =  parameters.quantity + ' ' +parameters.name +'</br>';
                manpowerobject.push(parameters);
                $('.add_row_task.selected').find('td:eq(4)').append(manpowerhtml);
            }
            else if (parameters.type == 'material'){
                materialhtml = parameters.quantity + ' ' +parameters.name +'</br>';
                materialobject.push(parameters);
                $('.add_row_task.selected').find('td:eq(5)').append(materialhtml);
            }
            else if (parameters.type == 'equipment'){
                equipmenthtml = parameters.quantity + ' ' +parameters.name +'</br>';
                equipmentobject.push(parameters);
                $('.add_row_task.selected').find('td:eq(6)').append(equipmenthtml);
            }
        });
        dataParameter =$('.add_row_task.selected').data("parameters");
        dataParameter.manpower = manpowerobject;
        dataParameter.material = materialobject;
        dataParameter.equipment = equipmentobject;
        $('.add_row_task.selected').data("parameters",dataParameter);
    }
    
    function populateItemTable(){
        if($('.add_row_task.selected').length > 0 ){
            actAddItem = $("#actadditem");
            actAddItemQty = $("#actadditemqty");
            $("#addprjitms").html('');
            dataParameters = $('.add_row_task.selected').data('parameters');
            $.each(dataParameters.manpower, function( index, value ) {
                option = $('#actadditem option[value="' + value.id + '"]');
                totalprice = (parseInt(option.attr("price")) * parseInt(value.quantity));
                jsonObject = {
                    "id":value.id ,
                    "name":option.data("name"),
                    "type":option.attr("type"),
                    "quantity":value.quantity,
                    "totalprice":totalprice,
                    "price": option.attr("price")};
                itemTemplate = '<tr id="%itemrowid%" class="actItemRow"><td>%itemname%</td><td>%itemqty%</td><td>%itemprice%</td><td><button class="deleteitembutton btn btn-xs"><span class="glyphicon glyphicon-remove"></span></button></td></tr>';
                itemTemplate = itemTemplate.replace("%itemrowid%", "actItmRowID" +value.id);
                itemTemplate = itemTemplate.replace("%itemname%", jsonObject.name);
                itemTemplate = itemTemplate.replace("%itemqty%", jsonObject.quantity);
                itemTemplate = itemTemplate.replace("%itemprice%", "Php. " + totalprice);
                $("#addprjitms").append(itemTemplate);
                actAddItem.val("");
                actAddItemQty.val("");
                $("#actItmRowID" + value.id).data('parameters',jsonObject);
            });
            $.each(dataParameters.material, function( index, value ) {
                option = $('#actadditem option[value="' + value.id + '"]');
                totalprice = (parseInt(option.attr("price")) * parseInt(value.quantity));
                jsonObject = {
                    "id":value.id ,
                    "name":option.data("name"),
                    "type":option.attr("type"),
                    "quantity":value.quantity,
                    "totalprice":totalprice,
                    "price": option.attr("price")};
                itemTemplate = '<tr id="%itemrowid%" class="actItemRow"><td>%itemname%</td><td>%itemqty%</td><td>%itemprice%</td><td><button class="deleteitembutton btn btn-xs"><span class="glyphicon glyphicon-remove"></span></button></td></tr>';
                itemTemplate = itemTemplate.replace("%itemrowid%", "actItmRowID" +value.id);
                itemTemplate = itemTemplate.replace("%itemname%", jsonObject.name);
                itemTemplate = itemTemplate.replace("%itemqty%", jsonObject.quantity);
                itemTemplate = itemTemplate.replace("%itemprice%", "Php. " + totalprice);
                $("#addprjitms").append(itemTemplate);
                actAddItem.val("");
                actAddItemQty.val("");
                $("#actItmRowID" + value.id).data('parameters',jsonObject);
            });
            $.each(dataParameters.equipment, function( index, value ) {
                option = $('#actadditem option[value="' + value.id + '"]');
                totalprice = (parseInt(option.attr("price")) * parseInt(value.quantity));
                jsonObject = {
                    "id":value.id ,
                    "name":option.data("name"),
                    "type":option.attr("type"),
                    "quantity":value.quantity,
                    "totalprice":totalprice,
                    "price": option.attr("price")};
                itemTemplate = '<tr id="%itemrowid%" class="actItemRow"><td>%itemname%</td><td>%itemqty%</td><td>%itemprice%</td><td><button class="deleteitembutton btn btn-xs"><span class="glyphicon glyphicon-remove"></span></button></td></tr>';
                itemTemplate = itemTemplate.replace("%itemrowid%", "actItmRowID" +value.id);
                itemTemplate = itemTemplate.replace("%itemname%", jsonObject.name);
                itemTemplate = itemTemplate.replace("%itemqty%", jsonObject.quantity);
                itemTemplate = itemTemplate.replace("%itemprice%", "Php. " + totalprice);
                $("#addprjitms").append(itemTemplate);
                actAddItem.val("");
                actAddItemQty.val("");
                $("#actItmRowID" + value.id).data('parameters',jsonObject);
            });                        
        }
    }
    
Date.prototype.toChartFormat = function() {

       var yyyy = this.getFullYear().toString();
       var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
       var dd  = this.getDate().toString();
       return  yyyy+'-'+mm+'-'+dd;

    };
Date.prototype.toInputFormat = function() {

       var yyyy = this.getFullYear().toString();
       var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
       var dd  = this.getDate().toString();
       return this.getMonthNameShort('en') + ' '+ dd + ', '+ yyyy;

    };
    
Date.prototype.getMonthNameShort = function(lang) {
    lang = lang && (lang in Date.locale) ? lang : 'en';
    return Date.locale[lang].month_names_short[this.getMonth()];
};

Date.locale = {
    en: {
       month_names: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
       month_names_short: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    }
};

    $(document).on("click" ,".add_row_task",function() {
        $(".add_row_task.selected").removeClass('selected');
        $(this).addClass('selected');
        populateItemTable();
    });
    
    $(document).on("click" ,".edittaskbutton",function() {
        var data = $(this).closest('.add_row_task').data('parameters');
        $("#addtaskname").val(data.label);
        $("#adddays").val(data.days);
        $("#addeditid").val(data.temporaryid);
        $("#addparent").val(data.parentid);
        $("#addmessage").val(data.message);
        $("#addnotify").prop('checked',data.notify);
        if(data.notify){
            $('#tdnotify').show();
        }
        else{
            $('#tdnotify').hide();
        }
        var start =  new Date(data.from );
        $('#addstartdate').datepicker('setDate', start);
        var end =  new Date(data.to );
        $('#addenddate').datepicker('setDate', end);
        $(".task_form").show();
        $("#addtaskbutton").html('Save');
        $("#addtaskbutton").data('mode','edit');
    });
    
    $(document).on("click" ,".deletetaskbutton",function() {
        $(this).closest('.add_row_task').remove();
    });
    
    function updateChildTaskStartdateModal(parentId, startdate)
    {
        $('.add_row_task').each(function(){
            parameters = $(this).data('parameters');
            if(parameters.parentid == parentId)
            {
                var start =  new Date(startdate );
                var end =  new Date(startdate );
                end.setDate(end.getDate() + parseInt(parameters.days) +2); 
                parameters.from = start.toChartFormat();
                $(this).find('td:eq(2)').html(start.toInputFormat());
                parameters.to = end.toChartFormat();
                $(this).find('td:eq(3)').html(end.toInputFormat());
                $(this).data('parameters',parameters);
                updateChildTaskStartdateModal(parameters.temporaryid,end.toInputFormat() );
            }
        });
    }
    
    $("#addactbtn").on("click", function () {
        actAddName = $("#actname").val();
        
        if (actAddName !== "" ) {
                mainJson = [];
                activityJson = {};
                rowId = $("#hiddenactivityid").val();
                activityJson.name = actAddName;
                activityJson.tasks = [];
//                $('.row_activity.activity_'+ rowId ).data('parameters',JSON.stringify(parameterData));
                $('.add_row_task').each(function(){
                    taskJson = $(this).data('parameters');
                    activityJson.tasks.push(taskJson);
                });
                mainJson.push(activityJson);
			jsr = {
				"do":"add_activity",
				"projectid":ProjectID,
				"activities":JSON.stringify(activityJson)
			}

            xhr = new XMLHttpRequest();
            xhr.open("POST", "backend.php");
            xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhr.send(JSON.stringify(jsr));
            xhr.onload = function() {
                xx = JSON.parse(xhr.responseText);
                if (xx["success"]) {
                        $("#progressindicator").html(Math.round(xx["progress"]) + "%");
                        if (xx["progress"] == "100" || xx["progress"] == 100) {
                                $("#statusindicator").html("Completed");
            } else {
                                $("#statusindicator").html("In Progress");
            }
                        var completed = Math.round(xx["progress"]);
                        var inprogress = 100 - completed;
                        updatePie(inprogress, completed);
                        $("#addActivityModal").modal("hide");
                        showOk("Activity Added", "The activity is successfully added.");
                        getactivities();
            }
            }

        } else {
            showError("Activity not Added", "Please fill up activity name. (Activity name is required)");
        }
    });