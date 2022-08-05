$(document).ready(function () {

    "use strict"; // Start of use strict

    //Card table
    $('.card-table').DataTable({
        "bPaginate": false,
        "bFilter": false,
        "bInfo": false
    });

    //Tooltip
    $('[data-toggle="tooltip"]').tooltip();

    //Sparklines Charts
    $(".sparkline1").sparkline([34, 43, 43, 35, 44, 32, 44, 52, 25], {
        type: 'line',
        lineColor: '#37a000',
        fillColor: '#37a000',
        width: '150',
        height: '20'
    });
    $(".sparkline2").sparkline([5, 6, 7, 2, 0, -4, -2, 4, 5, 6, 3, 2, 4, -6, -5, -4, 6, 5, 4, 3], {
        type: 'bar',
        barColor: '#37a000',
        negBarColor: '#c6c6c6',
        width: '150',
        height: '20'
    });
    $(".sparkline3").sparkline([10, 2], {
        type: 'pie',
        sliceColors: ['#37a000', '#ffffff'],
        width: '150',
        height: '20'
    });
    $(".sparkline4").sparkline([34, 43, 43, 35, 44, 32, 15, 22, 46, 33, 86, 54, 73, 53, 12, 53, 23, 65, 23, 63, 53, 42, 34, 56, 76, 15, 54, 23, 44], {
        type: 'line',
        lineColor: '#37a000',
        fillColor: '#37a000',
        width: '150',
        height: '20'
    });
    $(".sparkline5").sparkline([1, 1, 0, 1, -1, -1, 1, -1, 0, 0, 1, 1], {
        type: 'tristate',
        posBarColor: '#37a000',
        negBarColor: '#ffffff',
        width: '150',
        height: '20'
    });
    $(".sparkline6").sparkline([4, 6, 7, 7, 4, 3, 2, 1, 4, 4, 5, 6, 3, 4, 5, 8, 7, 6, 9, 3, 2, 4, 1, 5, 6, 4, 3, 7], {
        type: 'discrete',
        lineColor: '#37a000',
        width: '150',
        height: '20'
    });


    //doughut chart
    var ctx = document.getElementById("doughutChart");
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                    data: [40, 25, 20],
                    backgroundColor: [
                        "#37a000",
                        "#42b704",
                        "#e4e4e4",
                    ],
                    hoverBackgroundColor: [
                        "#4cd604",
                        "#4cd604",
                        "#4cd604"
                    ]
                }],
            labels: [
                "green",
                "green",
                "green",
                "green"
            ]
        },
        options: {
            legend: false,
            responsive: true,
            cutoutPercentage: 80
        }
    });




});