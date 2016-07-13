function populateProjectTemplate(startdate)
{

    var templateJson = 
            {
                '0': {name:'Earthworks',
                    tasks :{
                        '0' : {name : 'Clearing and Grubing',days : 5,start : 0,end : 5,
                            manpower : {
                                '0' : {id : 1,name : 'Foreman',quantity : 1},
                                '1' : {id : 2,name : 'Labor',quantity : 2}
                            },
                            material : {
                                '0' : {id : 3,name : 'Sickle',quantity : 3}
                            }
                        },
                        '1' : {name : 'Excavation',days : 12,start : 5,end : 17,
                            manpower : {},
                            material : {
                                '0' : {id : 3,name : 'Sickle',quantity : 1},
                                '1' : {id : 4,name : '16mm Deformed Bar',quantity : 3}
                            }
                        },
                        '2' : {name : 'Soil Poisoning',days : 5,start : 17,end : 22,
                            manpower : {
                                '0' : {id : 2,name : 'Labor',quantity : 1}
                            },
                            material : {}
                        },
                        '3' : {name : 'Gravel Bedding',days : 5,start : 22,end : 27,
                            manpower : {
                                '0' : {id : 2,name : 'Labor',quantity : 2}
                            },
                            material : {}
                        }
                    }
                },
                '1': {name:'Concrete Works',
                    tasks :{
                        '0' : {name : 'Footings',days : 7,start : 27,end : 34,
                            manpower : {
                                '0' : {id : 5,name : 'Mansory',quantity : 1},
                                '1' : {id : 2,name : 'Labor',quantity : 3},
                                '2' : {id : 6,name : 'Operator (Heavy Equipment)',quantity : 1}
                            },
                            material : {
                                '0' : {id : 7,name : 'Bags of Cement',quantity : 49},
                                '1' : {id : 8,name : 'Cubic Meter Sand',quantity : 2},
                                '2' : {id : 9,name : 'Cubic Meter Gravel',quantity : 4}
                            }
                        },
                        '1' : {name : 'Columns',days : 15,start : 34,end : 49,
                            manpower : {
                                '0' : {id : 10,name : 'Carpentry',quantity : 3},
                                '1' : {id : 5,name : 'Mansory',quantity : 3},
                                '2' : {id : 2,name : 'Labor',quantity : 5}
                            },
                            material : {
                                '0' : {id : 7,name : 'Bags of Cement',quantity : 75},
                                '1' : {id : 8,name : 'Cubic Meter Sand',quantity : 5},
                                '2' : {id : 9,name : 'Cubic Meter Gravel',quantity : 10}
                            }
                        },
                        '2' : {name : 'Beams',days : 11,start : 49,end : 60,
                            manpower : {
                                '0' : {id : 10,name : 'Carpentry',quantity : 5},
                                '1' : {id : 5,name : 'Mansory',quantity : 3},
                                '2' : {id : 2,name : 'Labor',quantity : 5}
                            },
                            material : {
                                '0' : {id : 7,name : 'Bags of Cement',quantity : 55},
                                '1' : {id : 8,name : 'Cubic Meter Sand',quantity : 4.5},
                                '2' : {id : 9,name : 'Cubic Meter Gravel',quantity : 9}
                            }
                        },
                        '3' : {name : 'Slabs',days : 8,start : 60,end : 68,
                            manpower : {
                                '0' : {id : 5,name : 'Mansory',quantity : 2},
                                '1' : {id : 10,name : 'Carpentry',quantity : 2},
                                '2' : {id : 2,name : 'Labor',quantity : 4}
                            },
                            material : {
                                '0' : {id : 7,name : 'Bags of Cement',quantity : 52},
                                '1' : {id : 8,name : 'Cubic Meter Sand',quantity : 4.5},
                                '2' : {id : 9,name : 'Cubic Meter Gravel',quantity : 9}
                            }
                        }
                    }
                },
                '2': {name:'Steel Works',
                    tasks :{
                        '0' : {name : 'Footings',days : 4,start : 5,end : 9,
                            manpower : {
                                '0' : {id : 11,name : 'Welder',quantity : 1},
                                '1' : {id : 2,name : 'Labor',quantity : 1}
                            },
                            material : {
                                '0' : {id : 4,name : '16mm Deformed Bar',quantity : 25}
                            }
                        },
                        '1' : {name : 'Columns',days : 22,start : 5,end : 27,
                            manpower : {
                                '0' : {id : 12,name : 'Steel Man',quantity : 2},
                                '1' : {id : 2,name : 'Labor',quantity : 1}
                            },
                            material : {
                                '0' : {id : 4,name : '16mm Deformed Bar',quantity : 68},
                                '1' : {id : 13,name : '12mm Deformed Ba',quantity : 145},
                                '2' : {id : 14,name : '10mm Deformed Ba',quantity : 285}
                            }
                        },
                        '2' : {name : 'Beams',days : 19,start : 5,end : 24,
                            manpower : {
                                '0' : {id : 12,name : 'Steel Man',quantity : 2},
                                '1' : {id : 2,name : 'Labor',quantity : 1}
                            },
                            material : {
                                '0' : {id : 4,name : '16mm Deformed Bar',quantity : 57},
                                '1' : {id : 13,name : '12mm Deformed Ba',quantity : 105},
                                '2' : {id : 14,name : '10mm Deformed Ba',quantity : 150}
                            }
                        },
                        '3' : {name : 'Slabs',days : 10,start : 5,end : 15,
                            manpower : {
                                '0' : {id : 12,name : 'Steel Man',quantity : 2},
                                '1' : {id : 2,name : 'Labor',quantity : 1}
                            },
                            material : {
                                '0' : {id : 14,name : '10mm Deformed Ba',quantity : 165}
                            }
                        }
                    }
                },
                '3': {name:'Framework',
                    tasks :{
                        '0' : {name : 'Formworks and Scaffoldings',days : 35,start : 5,end : 40,
                            manpower : {
                                '0' : {id : 2,name : 'Labor',quantity : 3},
                                '1' : {id : 10,name : 'Carpentry',quantity : 5}
                            },
                            material : {
                                '0' : {id : 15,name : 'inches x 3 inches x 10 feet coco lumber',quantity : 1050},
                                '1' : {id : 16,name : '4 ft x 8 ft plywood',quantity : 75}
                            }
                        }

                    }
                },
                '4': {name:'Mansory Works',
                    tasks :{
                        '0' : {name : 'Mansory',days : 41,start : 5,end : 46,
                            manpower : {
                                '0' : {id : 5,name : 'Mansory',quantity : 5},
                                '1' : {id : 2,name : 'Labor',quantity : 3}
                            },
                            material : {
                                '0' : {id : 17,name : '6 inches concrete hollow block',quantity : 1042},
                                '1' : {id : 18,name : '4 inches concrete hollow block',quantity : 469}
                            }
                        }
                    }
                },
                '5': {name:'Carpentry Works',
                    tasks :{
                        '0' : {name : 'Ceiling, Cabinets and Etc.',days : 31,start : 46,end : 77,
                            manpower : {
                                '0' : {id : 12,name : 'Steel Man',quantity : 2},
                                '1' : {id : 2,name : 'Labor',quantity : 1}
                            },
                            material : {
                                '0' : {id : 16,name : '4 ft x 8 ft plywood',quantity : 56},
                                '1' : {id : 19,name : '2 inches x 2 inches x 10 feet wood',quantity : 235}
                            }
                        }
                    }
                },
                '6': {name:'Roofing Works',
                    tasks :{
                        '0' : {name : 'Roofing Materials, Trusses and etc.',days : 12,start : 77,end : 89,
                            manpower : {
                                '0' : {id : 10,name : 'Carpentry',quantity : 5},
                                '1' : {id : 2,name : 'Labor',quantity : 3}
                            },
                            material : {
                                '0' : {id : 20,name : '12 feet yero',quantity : 17},
                                '1' : {id : 21,name : 'Nails',quantity : 1292},
                                '2' : {id : 22,name : 'C-Purlins 2 inches x 6 inches',quantity : 138}
                            }
                        }
                    }
                },
                '7': {name:'Pre-Fabricated Works',
                    tasks :{
                        '0' : {name : 'Door',days : 9,start : 89,end : 98,
                            manpower : {
                                '0' : {id : 10,name : 'Carpentry',quantity : 2},
                                '1' : {id : 2,name : 'Labor',quantity : 2}
                            },
                            material : {
                                '0' : {id : 23,name : 'UPBC',quantity : 2}
                            }
                        },
                        '1' : {name : 'Windows',days : 9,start : 98,end : 107,
                            manpower : {
                                '0' : {id : 10,name : 'Carpentry',quantity : 2},
                                '1' : {id : 2,name : 'Labor',quantity : 2}
                            },
                            material : {
                                '0' : {id : 23,name : 'UPBC',quantity : 14}
                            }
                        }
                    }
                },
                '8': {name:'Painting Works',
                    tasks :{
                        '0' : {name : 'Exterior',days : 24,start : 107,end : 131,
                            manpower : {
                                '0' : {id : 26,name : 'Painter',quantity : 4}
                            },
                            material : {
                                '0' : {id : 24,name : 'Roller',quantity : 10},
                                '1' : {id : 25,name : 'tin semi-gloss',quantity : 3},
                                '2' : {id : 27,name : 'gallon acrycolor',quantity : 1},
                                '3' : {id : 28,name : 'Paint Brush',quantity : 5},
                                '4' : {id : 29,name : 'Gallon thinner',quantity : 3}
                            }
                        }
                    }
                },
                '9': {name:'Plumbing',
                    tasks :{
                        '0' : {name : 'Fixtures',days : 2,start : 5,end : 7,
                            manpower : {
                                '0' : {id : 30,name : 'Plumber',quantity : 2},
                                '1' : {id : 2,name : 'Labor',quantity : 1}
                            },
                            material : {
                                '0' : {id : 31,name : 'Sink',quantity : 1},
                                '1' : {id : 32,name : 'water closet',quantity : 22},
                                '2' : {id : 33,name : 'Lavatory',quantity : 22},
                                '3' : {id : 34,name : 'Urinal',quantity : 22}
                            }
                        },
                        '1' : {name : 'Waterlines',days : 12,start : 5,end : 17,
                            manpower : {
                                '0' : {id : 30,name : 'Plumber',quantity : 1},
                                '1' : {id : 2,name : 'Labor',quantity : 1}
                            },
                            material : {
                                '0' : {id : 35,name : '1 inch blue bbc',quantity : 5},
                                '1' : {id : 36,name : '1 /2 inch blue bbc',quantity : 20},
                                '2' : {id : 37,name : '3 /4 inches blue bbc',quantity : 3}
                            }
                        },
                        '2' : {name : 'Sanitary',days : 12,start : 5,end : 17,
                            manpower : {
                                '0' : {id : 30,name : 'Plumber',quantity : 1},
                                '1' : {id : 2,name : 'Labor',quantity : 1}
                            },
                            material : {
                                '0' : {id : 38,name : '4 inches orange pipe',quantity : 4},
                                '1' : {id : 39,name : '3 inches orange pipe',quantity : 3},
                                '2' : {id : 40,name : '2 inches orange pipe',quantity : 2}
                            }
                        },
                        '3' : {name : 'Storm Drain',days : 12,start : 5,end : 17,
                            manpower : {
                                '0' : {id : 30,name : 'Plumber',quantity : 1},
                                '1' : {id : 2,name : 'Labor',quantity : 1}
                            },
                            material : {
                                '0' : {id : 39,name : '3 inches orange pipe',quantity : 15}
                            }
                        },
                    }
                },
            };

        displayProjectTemplate( startdate, templateJson );
}

function displayProjectTemplate( startdate, templateJson )
{
    $('#activityview').html('');
    $.each(templateJson, function(i, activities){
       $('#activityview').append("<tr class= 'row_activity activity_"+ i+"'><th colspan='7'>"+activities.name +"</th></tr>");
       var parameterData = displayTaskTemplate( startdate, activities.tasks );
       
       parameterData.startdate = parameterData.startdate.toChartFormat();
       parameterData.enddate= parameterData.enddate.toChartFormat();
       parameterData.name = activities.name;
       $('.activity_'+ i ).data('parameters',JSON.stringify(parameterData));
    });

        var baseDate = new Date(startdate );
        var end = new Date();
        end.setDate(baseDate.getDate() + parseInt(templateJson[8].tasks[0].end)); 
        $('#prjenddate').datepicker('setDate', end);
}
function displayTaskTemplate( startdate, taskJson )
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

       $.each(task.manpower, function(ind, manpower){
           manpowerText = manpowerText + ' ' + manpower.quantity + ' ' + manpower.name + '<br/>';
       });

       var materialText = '';
       $.each(task.material, function(index, material){
           materialText = materialText + ' ' + material.quantity + 'pcs. ' + material.name + '<br/>';
       });
       $('#activityview').append("<tr><td></td><td>"+ task.name+"</td> <td>"+ task.days+"</td><td>"+ start.toInputFormat()+"</td><td>"+ end.toInputFormat()+"</td><td>"+manpowerText+"</td><td>"+ materialText+"</td></tr>");
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