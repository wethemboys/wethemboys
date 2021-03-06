function populateProjectTemplate()
{
    startdate = $("#prjstartdate").val();
    prjsize =$("#prjsize").val();
    var templateJson = {} ;
    if($("#prjsize").val()&&startdate){
        var jsonFilename = 'template/'+ prjsize + '.json';
        $.getJSON(jsonFilename, function(json) {
            templateJson = json;
            displayProjectTemplate( startdate, templateJson );
        });
    }
}

function displayProjectTemplate( startdate, templateJson )
{
    $('#activityview').html('');
    $.each(templateJson, function(i, activities){
       $('#activityview').append("<tr class= 'row_activity activity_"+ i+"'><th colspan='8'>"+activities.name +"\
        <span style='float:right;'><button class='btn btn-warning btn-xs editactivity'><span class='glyphicon glyphicon-plus'></span> Edit Activity/Task/Items</button>\n\
                <button class='btn btn-danger btn-xs deleteactivity'><span class='glyphicon glyphicon-remove'></span> Delete Activity</button></span></th></tr>");
       var parameterData = displayTaskTemplate( startdate, activities.tasks,i ,activities.name);
       
       parameterData.startdate = parameterData.startdate.toChartFormat();
       parameterData.enddate= parameterData.enddate.toChartFormat();
       parameterData.name = activities.name;
       $('.row_activity.activity_'+ i ).data('parameters',JSON.stringify(parameterData));
       $("#hiddenactivityid").val( parseInt($("#hiddenactivityid").val()) + 1);
    });

        var baseDate = new Date(startdate );
        var end = new Date();
        end.setDate(baseDate.getDate() + parseInt(templateJson[8].tasks[0].end) +2); 
        $('#prjenddate').datepicker('setDate', end);
        
        drawChart();
}
function displayTaskTemplate( startdate, taskJson, activity_id, activities_name )
{
    var parameterData = new Object();
    var initialize =0;
    $.each(taskJson, function(i, task){
       var baseDate = new Date(startdate );
       var start = new Date();
       var end = new Date();
       start.setDate(baseDate.getDate() + parseInt(task.start)); 
       end.setDate(baseDate.getDate() + parseInt(task.end)); 
       if (initialize ==0 ){
           parameterData.startdate = start;
           parameterData.enddate = end;
           initialize=1;
       }
       if( parameterData.startdate > start) 
       {
           parameterData.startdate = start;
       }
       if( parameterData.enddate < end) 
       {
           parameterData.enddate = end;
       }
       var manpowerText = '';
       var manpowerJson = [];
       $.each(task.manpower, function(ind, manpower){
           manpowerText = manpowerText + ' ' + manpower.quantity + ' ' + manpower.name + '<br/>';
           manpowerObject = {"id":manpower.id,"quantity":manpower.quantity,"name":manpower.name };
           manpowerJson.push(manpowerObject);
       });

       end.setDate(end.getDate() ); 
       var materialText = '';
       var materialJson = [];
       $.each(task.material, function(index, material){
           materialText = materialText + ' ' + material.quantity + 'pcs. ' + material.name + '<br/>';
           materialObject = {"id":material.id,"quantity":material.quantity,"name":material.name };
           materialJson.push(materialObject);
       });
       
       var equipmentText = '';
       var equipmentJson = [];
       $.each(task.equipment, function(index, equipment){
           equipmentText = equipmentText + ' ' + equipment.quantity + 'pcs. ' + equipment.name + '<br/>';
           equipmentObject = {"id":equipment.id,"quantity":equipment.quantity,"name":equipment.name };
           equipmentJson.push(equipmentObject);
       });
       $('#activityview').append("<tr class='activity_"+activity_id+" row_task'><td></td><td>"+ task.name+"</td> <td>"+ task.days+"</td><td>"+ start.toInputFormat()+"</td><td>"+ end.toInputFormat()+"</td><td>"+manpowerText+"</td><td>"+ materialText+"</td><td>"+ equipmentText+"</td></tr>");
       var taskData = new Object();
       taskData.from = start.toChartFormat();
       taskData.to= end.toChartFormat();
       taskData.label = task.name;
       taskData.activity = activities_name;
       taskData.days = task.days;
       taskData.material = materialJson;
       taskData.manpower = manpowerJson;
       taskData.equipment = equipmentJson;
       taskData.temporaryid = task.temporaryid;
       taskData.parentid = task.parentid;
       taskData.notify = false;
       $('#temporaryid').val(task.temporaryid);
       $('#activityview').find("tr:last").data('parameters',JSON.stringify(taskData));
    });
    return parameterData;
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