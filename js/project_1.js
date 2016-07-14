function populateProjectTemplate(startdate)
{
    alert(startdate);
    var templateData = 
            {
                '0': {
                    name:'Earthworks',
                    tasks :
                        {
                            '0' : {
                                name : 'Clearing and Grubing',
                                days  : 5,
                                start : 0,
                                end : 5,
                                manpower : {
                                    '0' : {
                                        id : 1,
                                        name : 'Foreman',
                                        quantity : 1
                                    },
                                    '1' : {
                                        id : 2,
                                        name : 'Labor',
                                        quantity : 2
                                    }
                                },
                                material : {
                                    '0' : {
                                        id : 1,
                                        name : 'Foreman',
                                        quantity : 1
                                    }
                                }
                            },
                            
                        }
                } 
            };
        alert(templateData);
        console.log(templateData);
}