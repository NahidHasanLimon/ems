$(function() {
      $.ajax({

        url: 'http://localhost/ems/admin/controller/charts/fusion_chart_data.php',
        type: 'GET',
        success: function(data) {
            chartData = data;
            var chartProperties = {
                "caption": "Monthly Working Days Overview",
                "xAxisName": "Employee",
                "yAxisName": "Attendance Days",
                "rotatevalues": "1",
                "theme": "zune"
            };

            apiChart = new FusionCharts({
                type: 'column2d',
                renderAt: 'chart-container',
                width: '550',
                height: '350',
                dataFormat: 'json',
                dataSource: {
                    "chart": chartProperties,
                    "data": chartData
                }
            });
            apiChart.render();
        }
    });
});