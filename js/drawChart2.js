function drawChart(){
        var sourceJson =[];
        var lastactivity = '';
        $('.row_task').each(function(){
            var from = 0;
            var to = 0;
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
            values = new Object();
            
            from = new Date(dataParameters.from).getTime();
            values.from ="/Date("+from+")/";
            var baseTo = new Date(dataParameters.to );
            baseTo.setDate(baseTo.getDate() -3); 
            to = baseTo.getTime();
            values.to ="/Date("+to+")/";
            values.label= dataParameters.label;
//            values.customClass = dataParameters.label;
            values.customClass = "ganttGreen";
            mainTaskJson.values.push(values);
            sourceJson.push(mainTaskJson);
            
            
            var latestStart= new Object();
            latestStart.name = '';
            latestStart.desc = "<span class='font-blue'>Latest Start</span>";
            latestStart.values = [];
            values = new Object();
            
            var baseFrom = new Date(dataParameters.from );
            baseFrom.setDate(baseFrom.getDate() +2); 
            from = baseFrom.getTime();
            values.from ="/Date("+from+")/";
            
//            var baseTo = new Date(dataParameters.from );
//            baseTo.setDate(baseTo.getDate() + 3); 
//            to = baseTo.getTime();
            values.to ="/Date("+to+")/";
            
            values.label= 'Latest Start';
            values.customClass = "ganttRed";
            latestStart.values.push(values);
            sourceJson.push(latestStart);
            
//            
//            
//            var latestEnd= new Object();
//            latestEnd.name = '';
//            latestEnd.desc =  "<span class='font-red'>Latest Finish</span>";
//            latestEnd.values = [];
//            values = new Object();
//            
//            var baseFrom = new Date(dataParameters.to );
//            baseFrom.setDate(baseFrom.getDate() -2); 
//            from = baseFrom.getTime();
//            values.from ="/Date("+from+")/";
//            
//            var baseTo = new Date(dataParameters.to );
//            baseTo.setDate(baseTo.getDate() ); 
//            to = baseTo.getTime();
//            values.to ="/Date("+to+")/";
//            values.label= 'Latest Finish';
//            values.customClass =dataParameters.label + " - Latest Finish";
//            latestEnd.values.push(values);
//            sourceJson.push(latestEnd);
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
//                    if (window.console && typeof console.log === "function") {
//                        console.log("chart rendered");
//                    }
                }
            });
        }
            prettyPrint();

    }