function drawChart(){
        var sourceJson =[];
        var lastactivity = '';
        $('.row_task').each(function(){
            var from = 0;
            var to = 0;
            var latestStart = 0;
            var latestFinish = 0;
            var values = new Object();
            
            var dataParameters = JSON.parse($(this).data('parameters'));
            var mainTaskJson= new Object();
            var activity  = '';
            if  ( lastactivity != dataParameters.activity){
                activity = dataParameters.activity;
                lastactivity = activity ;
            }
            mainTaskJson.name = activity;
            mainTaskJson.desc = dataParameters.label;
            mainTaskJson.values = [];
            mainTaskJson.done = dataParameters.done;
            values = new Object();
            
            from = new Date(dataParameters.from).getTime();
            values.from ="/Date("+from+")/";
            
            preTo = new Date(dataParameters.preTo).getTime();
            values.preTo ="/Date("+preTo+")/";
            values.addeddays =dataParameters.addeddays;
            values.actualTo= '';
            if(dataParameters.actualTo != '0000-00-00') {
                actualTo = new Date(dataParameters.actualTo).getTime();
                values.actualTo ="/Date("+actualTo+")/";
            }
            values.actualDays = dataParameters.actualDays;
            values.days = dataParameters.days;
            latestStart = new Date(dataParameters.from);
            latestStart.setDate( latestStart.getDate() + 3);
            latestStart = latestStart.getTime();;
            values.latestStart  ="/Date("+latestStart+")/";
            
            var baseTo = new Date(dataParameters.to );
            baseTo.setDate(baseTo.getDate() ); 
            to = baseTo.getTime();
            latestFinish = new Date(dataParameters.to);
            latestFinish.setDate( latestFinish.getDate() + 3);
            latestFinish = latestFinish.getTime();;
            values.latestFinish  ="/Date("+latestFinish+")/";
            values.to ="/Date("+to+")/";
            values.label= dataParameters.label;
            values.done = dataParameters.done;
//            values.customClass = dataParameters.label;
//            values.customClass = "ganttGreen";
            mainTaskJson.values.push(values);
            sourceJson.push(mainTaskJson);
            console.log(mainTaskJson);
            

        });
//        console.log(sourceJson.length);
        if(sourceJson.length > 0){
        $("#chart_div").gantt({
                source :sourceJson,
                navigate: "scroll",
                scale: "days",
                maxScale: "days",
                minScale: "days",
                itemsPerPage: 12,
                useCookie: true,
                onItemClick: function(data) {
//                    alert("Item clicked - show some details");
                },
                onAddClick: function(dt, rowId) {
//                    alert("Empty space clicked - add an item!");
                },
                onRender: function() {
                        $('.row.spacer').html('<table style="margin: auto;font-weight:bold;"><tbody style="text-align: center;"><tr><td colspan="4">LEGENDS</td></tr><tr><td style="background-color: #65D065;height: 15px;width: 30px;"></td><td style="width:100px;">Latest Start</td><td style="background-color: #F88484;height: 15px;width: 30px;"></td><td style="width:100px;">Latest Finish</td></tr><tr><td style="background-color: #FCB872;height: 15px;width: 30px;"></td><td >Delayed</td><td style="background-color: #FBFB90;height: 15px;width: 30px;"></td><td >Days added</td></tr></tbody></table>');
//                    if (window.console && typeof console.log === "function") {
//                        console.log("chart rendered");
//                    }
                }
            });
        }
            prettyPrint();

    }