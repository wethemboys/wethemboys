$( document ).ready(function() {

    $("#actstartdate").datepicker({dateFormat: 'yy-mm-dd'});
    $("#actenddate").datepicker({dateFormat: 'yy-mm-dd'});
    $("#prjstartdate").datepicker({dateFormat: 'yy-mm-dd', minDate: 0});
    $("#prjenddate").datepicker({dateFormat: 'yy-mm-dd'});
    $("#prjenddate").datepicker('disable');
    
    $("#addstartdate").datepicker({dateFormat: 'yy-mm-dd', minDate: 0});
    $("#addenddate").datepicker({dateFormat: 'yy-mm-dd', minDate: 0});
    $("#addenddate").datepicker('disable');
    $("#adddays").TouchSpin();
    $("#actadditemqty").TouchSpin({"min":1});
    
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
        "do": "getuserinfo"
    };
    xhr.send(JSON.stringify(xhrd));
    xhr.onload = function () {
        user = JSON.parse(xhr.responseText);
        $("#usr_menu_disp").html(user["Name"]);
        $("#uname_display").html(user["Name"]);
        $("#usr_type").html(getCompleteType(user["Type"]));
        getclients();
    };

    $("#logout_btn").on("click", function () {
        xhr = new XMLHttpRequest();
        xhr.open("POST", "backend.php");
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhrd = {
            "do": "logoutuser"
        };
        xhr.send(JSON.stringify(xhrd));
        xhr.onload = function () {
            location.href = "login.php";
        };
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
        xhr.send(JSON.stringify({"do": "list_clients"}));
        xhr.onload = function () {
            clients = JSON.parse(xhr.responseText);
            clientsview = $("#prjclient");
            for (i = 0; i < clients.length; i++) {
                cc = "<option value='" + clients[i]["UserID"] + "'>" + clients[i]["Name"] + "</option>";
                clientsview.append(cc);
            }
            getResources();
        };
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

    $("#actadditem").on("change", function (event) {
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
        $("#addtasktable").html("");
        $("#itmname").html("- - -");
        $("#itmprice").html("- - -");
        modalMode = "add";
        $("#addActivityModal").find("#theModalTask").html("Add Activity");
        $("#addActivityModal").find("#addactbtn").html("Add Activity");
        $("#addActivityModal").modal("show");
//        $("#addActivityModal").find("#addhiddenid").val(0);
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
        x0.setHours(12, 0, 0);
        x1.setHours(12, 0, 0);

        // Round to remove daylight saving errors
        return Math.round((x1 - x0) / msPerDay);
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
            itemTemplate = itemTemplate.replace("%itemrowid%", i + "actItmRowID");
            itemTemplate = itemTemplate.replace("%itemname%", itemInfo[0]);
            itemTemplate = itemTemplate.replace("%itemqty%", ActItemList[i]["quantity"]);
            itemTemplate = itemTemplate.replace("%itemprice%", "Php. " + (parseInt(itemInfo[1]) * parseInt(ActItemList[i]["quantity"])));
            itemTemplate = itemTemplate.replace("%itemrid%", i + "actItmRID");
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

    $("#additmtoactbtn").on("click", function () {
        ActList[CurrentActID]["items"] = ItemList;
        ItemListCnt = 0;
        ItemList = [];
        $("#addItemModal").modal("hide");
    });

    actCount = 0;
    ActList = [];
    ActItemList = [];

    function prjitemdel(theItem) {
        theItemID = parseInt(theItem.target.parentNode.parentNode.id.replace("actItmRowID", ""));
        ActItemList = ActItemList.remove(theItemID);
        actItemListCnt--;
        eAC = 0;
        $("#addprjitms").children("tr").each(function () {
            this.id = eAC + "actItmRowID";
            eAC++;
        });
        $(theItem.target.parentNode.parentNode).remove();
        drawChart();
    }

    actItemListCnt = 0;


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

    Array.prototype.remove = function (index) {
        rArray = [];
        c = 0;
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
        $("#" + RowID).remove();
        ActList = ActList.remove(parseInt(AcID));
        actCount--;
        eaC = 0;
        $("#activityview").children("tr").each(function () {
            this.id = eaC + "actRow";
            eaC++;
        });
    }

    $("#addprjbtn").on("click", function () {
        sendJSON = {};
        projectName = $("#prjname").val();
        projectStartDate = $("#prjstartdate").val();
        projectEndDate = $("#prjenddate").val();
        projectClient = $("#prjclient").val();
        jsonObject = [];
        $('.row_activity').each(function(){
            activityJson = JSON.parse($(this).data('parameters'));
            classes = $(this).attr("class");
            arrayClass = classes.split(' ');
            activityJson.tasks = [];
            console.log(arrayClass[1]);
            $('.row_task.'+arrayClass[1]).each(function(){
                taskJson = JSON.parse($(this).data('parameters'));
                activityJson.tasks.push(taskJson);
            });
            jsonObject.push(activityJson);
        });
        if (projectName !== "" && projectStartDate !== "" && projectEndDate !== "" && projectClient !== "") {
            sendJSON = {};
            sendJSON["do"] = "add_project";
            sendJSON["name"] = projectName;
            sendJSON["startdate"] = projectStartDate;
            sendJSON["enddate"] = projectEndDate;
            sendJSON["userid"] = projectClient;
            sendJSON["activities"] = JSON.stringify(jsonObject);
            xhr = new XMLHttpRequest();
            xhr.open("POST", "backend.php");
            xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhr.send(JSON.stringify(sendJSON));
            xhr.onload = function () {
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
    
    $("#addActivityButton").on("click", function () {
        addAct();
    });
    
    $("#prjname, #prjenddate").on("change", function () {
        drawChart();
    });
    
    $("#prjsize").on("change", function () {
        if($(this).val() == 'others'){
            $('.tdothersize').show();
        }
        else
        {
            $('.tdothersize').hide();
        }
        populateProjectTemplate($(this).val());
        drawChart();
    }); 
    
    $("#prjstartdate").on("change", function () {
        populateProjectTemplate($(this).val());
        drawChart();
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
            $("#temporaryid").val(temporaryid);
            var formattaskstartday = new Date(taskstartday );
            var formattaskendday = new Date(taskendday );
            if (taskName != "" && taskDay != "" && taskstartday != "" && taskendday != ""&& actname != "") {
                jsonObject= {"from":taskstartday,"to":taskendday,"label":taskName,"activity":actname,"days":taskDay,"temporaryid":temporaryid,"parentid":parentid,"manpower":{},"material":{},"equipment":{}};
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
            oldJson = $("#addtasktable").find('.add_task_'+temporaryid).data('parameters');
            var formattaskstartday = new Date(taskstartday );
            var formattaskendday = new Date(taskendday );
            if(oldJson.to != taskendday){
                updateChildTaskStartdateModal(temporaryid, taskendday);
            }
            if (taskName != "" && taskDay != "" && taskstartday != "" && taskendday != ""&& actname != "") {
                jsonObject= {"from":taskstartday,"to":taskendday,"label":taskName,"activity":actname,"days":taskDay,"temporaryid":temporaryid,"parentid":parentid,"manpower":oldJson.manpower,"material":oldJson.material,"equipment":oldJson.equipment};
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
            end.setDate(end.getDate() + parseInt(taskDay) +2); 
            $('#addenddate').datepicker('setDate', end);
        }   
    });
    
    $(document).on("mouseenter" ,".row_activity",function() {
        classes = $(this).attr("class");
        var array = classes.split(' ');
        $("."+ array[1]).css("background-color", "#efefef");
    });
    
    $(document).on("mouseleave" ,".row_activity",function() {
        classes = $(this).attr("class");
        var array = classes.split(' ');
        $("."+ array[1]).css("background-color", "");
    });
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
    $(document).on("click" ,".deleteitembutton",function() {
        $(this).closest('.actItemRow').remove();
        updateItemColumn();
    });
    
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
                actAddItemQty.val("");
                $("#actItmRowID" + resourceid).data('parameters',jsonObject);
            }
            updateItemColumn();
        } else {
            showError("Item not Added", "Please select the item and the desired quantity.");
        }
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
    
    $("#addactbtn").on("click", function () {
        actAddName = $("#actname").val();
        
        if (actAddName !== "" ) {
            if (modalMode == "add") {
                parameterData = {};
                rowId = $("#hiddenactivityid").val();
                var newAcitivity = "<tr class='row_activity activity_"+rowId+"'><th colspan='8'>"+actAddName+" \n\
                <span style='float:right;'><button class='btn btn-warning btn-xs editactivity'><span class='glyphicon glyphicon-plus'></span> Edit Activity/Task/Items</button>\n\
                <button class='btn btn-danger btn-xs deleteactivity'><span class='glyphicon glyphicon-remove'></span> Delete Activity</button></span></th></tr>";
                $("#activityview").append(newAcitivity);
                parameterData.name = actAddName;
                $('.row_activity.activity_'+ rowId ).data('parameters',JSON.stringify(parameterData));
                $(".add_row_task").each(function(){
                    var taskData = $(this).data('parameters');
                    manpowerText = '';
                    materialText = '';
                    equipmentText = '';
                    $.each(taskData.material, function(index, material){
                        materialText = materialText + ' ' + material.quantity + 'pcs. ' + material.name + '<br/>';
                    });
                    $.each(taskData.manpower, function(index, manpower){
                        manpowerText = manpowerText + ' ' + manpower.quantity + ' ' + manpower.name + '<br/>';
                    });
                    $.each(taskData.equipment, function(index, equipment){
                        equipmentText = equipmentText + ' ' + equipment.quantity + ' ' + equipment.name + '<br/>';
                    });
                    $('#activityview').append("<tr class='activity_"+rowId+" row_task'><td></td><td>"+ taskData.label+"</td> <td>"+ taskData.days+"</td><td>"+ taskData.from+"</td><td>"+ taskData.to+"</td><td>"+manpowerText+"</td><td>"+ materialText+"</td><td>"+ equipmentText+"</td></tr>");
                    $('#activityview').find("tr:last").data('parameters',JSON.stringify(taskData));
                });
                $("#hiddenactivityid").val( parseInt($("#hiddenactivityid").val()) + 1);
            } else if(modalMode == "edit") {
                activityid = $("#hiddeneditactivityid").val();
                var acitivityhtml = "<th colspan='8'>"+actAddName+" \n\
                <span style='float:right;'><button class='btn btn-warning btn-xs editactivity'><span class='glyphicon glyphicon-plus'></span> Edit Activity/Task/Items</button>\n\
                <button class='btn btn-danger btn-xs deleteactivity'><span class='glyphicon glyphicon-remove'></span> Delete Activity</button></span></th>";
                $(".row_activity."+activityid).html(acitivityhtml);
                $('.'+activityid+'.row_task').remove();
                $(".add_row_task").each(function(){ 
                    var taskData = $(this).data('parameters');
                    manpowerText = '';
                    materialText = '';
                    equipmentText = '';
                    $.each(taskData.material, function(index, material){
                        materialText = materialText + ' ' + material.quantity + 'pcs. ' + material.name + '<br/>';
                    });
                    $.each(taskData.manpower, function(index, manpower){
                        manpowerText = manpowerText + ' ' + manpower.quantity + ' ' + manpower.name + '<br/>';
                    });
                    $.each(taskData.equipment, function(index, equipment){
                        equipmentText = equipmentText + ' ' + equipment.quantity + ' ' + equipment.name + '<br/>';
                    });
                    from = new Date(taskData.from);
                    to = new Date(taskData.to);
                    $("."+activityid+':last').after("<tr class='"+activityid+" row_task'><td></td><td>"+ taskData.label+"</td> <td>"+ taskData.days+"</td><td>"+ from.toInputFormat()+"</td><td>"+ to.toInputFormat()+"</td><td>"+manpowerText+"</td><td>"+ materialText+"</td><td>"+ equipmentText+"</td></tr>");
                    $("."+activityid+".row_task:last").data('parameters',JSON.stringify(taskData));
                    updateChildTaskStartdate(taskData.temporaryid, taskData.to);
                });

            }
            $("#addActivityModal").modal("hide");
            drawChart();
        } else {
            showError("Activity not Added", "Please fill up activity name. (Activity name is required)");
        }
    });
    $(document).on("click" ,".editactivity",function() {    
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
                jsonObject= {"from":taskstartday,"to":taskendday,"label":taskName,"activity":actname,"days":taskDay,"temporaryid":temporaryid,"parentid":parentid,"manpower":taskparameter.manpower,"material":taskparameter.material,"equipment":taskparameter.equipment};
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
    
    $(document).on("click" ,".deleteactivity",function() {    
        classes = $(this).closest('.row_activity').attr("class");
        activityparameters = JSON.parse($(this).closest('.row_activity').data('parameters'));
        $("#actname").val(activityparameters.name);
        var array = classes.split(' ');
        $('.'+array[1]).remove();
        drawChart();
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
                $(this).find('td:eq(2)').html(start.toInputFormat())
                parameters.to = end.toChartFormat();
                $(this).find('td:eq(3)').html(end.toInputFormat());
                $(this).data('parameters',parameters);
                updateChildTaskStartdateModal(parameters.temporaryid,end.toInputFormat() );
            }
        });
    }
    
    function updateChildTaskStartdate(parentId, startdate)
    {
        $('.row_task').each(function(){
            parameters = JSON.parse($(this).data('parameters'));
            if(parameters.parentid == parentId)
            {
                var start =  new Date(startdate );
                var end =  new Date(startdate );
                end.setDate(end.getDate() + parseInt(parameters.days) +2); 
                parameters.from = start.toChartFormat();
                $(this).find('td:eq(3)').html(start.toInputFormat());
                parameters.to = end.toChartFormat();
                $(this).find('td:eq(4)').html(end.toInputFormat());
                $(this).data('parameters',JSON.stringify(parameters));
                updateChildTaskStartdate(parameters.temporaryid,end.toInputFormat() );
            }
        });
    }
});