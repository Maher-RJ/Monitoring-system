function draw(container,data,unit,width=null,height=null) {
    //console.log(data);

    // Populate series
    if(data!=null){
        var processed_json = new Array();
        var date = new Array();
        var bool=true;
        Object.keys(data).forEach(function (key) {
            var row = new Array();
            data[key].forEach(function(element){
                row.push([element.date, parseInt(element.value)]);
                bool?date.push(element.date):"";
            });
            bool=false;
            processed_json.push({name:key,data:row});
        });
        var chart=Highcharts.chart(container,{
            chart: {
                type: "line",
                reflow: false
            },
            title: {
                text:$('#type').children('option:selected').text()
            },
            xAxis: {
                type: 'datetime',
                categories:date,
                tickInterval: 20, // one week
                title: {
                    text: "DateTime",
                    labels:{
                        formatter: function() {
                            return moment(this.value).format("YYYY-MM-DD");
                        }
                    },
                }
            },
            yAxis: {
                title: {
                    text:unit
                    ,

                }

            },
            series: processed_json
        });
        if(width>0&&height>0){
            chart.setSize(width, height);
        }
    }
}