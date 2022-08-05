<div class="md-modal md-effect-1" id="logoutModal" style="width:30%">
    <div class="md-content">
        <h4 class="font-weight-600 mb-0" style="background-color: #BF1E1B;color:white">Warning!</h4>
        <div class="n-modal-body" style="text-align:center ;">
            <p>Apakah Anda Yakin Ingin Logout?</p>

            <div class="row">
                <div class="col-lg-6">
                    <button class="btn btn-danger btn-block" onclick="location.href='<?= base_url('auth/logout') ?>'">Logout</button>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-success md-close btn-block">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="md-overlay"></div>

<footer class="footer-content">
    <div class="footer-text d-flex align-items-center justify-content-between">
        <div class="copy">&nbsp;</div>
        <div class="credit">Borneo Famili Transportama © <?= date('Y'); ?></div>
    </div>
</footer>
<!--/.footer content-->
<div class="overlay"></div>
</div>
<!--/.wrapper-->
</div>
<!--Global script(used by all pages)-->
<script src="<?= base_url() ?>assets/plugins/jQuery/jquery-3.4.1.min.js"></script>
<script src="<?= base_url() ?>assets/dist/js/popper.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/metisMenu/metisMenu.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
<!-- Third Party Scripts(used by this page)-->
<script src="<?= base_url() ?>assets/plugins/chartJs/Chart.min.js"></script>
<!-- <script src="<?= base_url() ?>assets/plugins/chartJs/chartJs.active.js"></script> -->
<script src="<?= base_url() ?>assets/plugins/sparkline/sparkline.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!--Page Active Scripts(used by this page)-->
<!-- <script src="<?= base_url() ?>assets/dist/js/pages/dashboard.js"></script> -->
<script src="<?= base_url() ?>assets/plugins/datatables/data-basic.active.js"></script>

<script src="<?= base_url() ?>assets/plugins/NotificationStyles/js/modernizr.custom.js"></script>
<script src="<?= base_url() ?>assets/plugins/NotificationStyles/js/classie.js"></script>
<script src="<?= base_url() ?>assets/plugins/NotificationStyles/js/notificationFx.js"></script>
<script src="<?= base_url() ?>assets/plugins/NotificationStyles/js/snap.svg-min.js"></script>
<script src="<?= base_url() ?>assets/plugins/modals/classie.js"></script>
<script src="<?= base_url() ?>assets/plugins/modals/modalEffects.js"></script>

<!--Page Scripts(used by all page)-->
<script src="<?= base_url() ?>assets/dist/js/sidebar.js"></script>
<script src="<?= base_url() ?>assets/dist/js/form.js"></script>
<script src="<?= base_url() ?>assets/dist/js/show_notif.js"></script>
<!-- Third Party Scripts(used by this page)-->
<script>
    function goBack() {
        window.history.back();
    }
</script>
<script>
    $(document).ready(function() {
        "use strict"; // Start of use strict

        var chart_labels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var temp_dataset = [
            <?php for ($i = 1; $i < 13; $i++) {
                echo $chartAll[$i];
            ?>, <?php
            } ?>
        ];
        var rain_dataset = [
            <?php for ($i = 1; $i < 13; $i++) {
                echo $chartAll[$i];
            ?>, <?php
            } ?>
        ];
        var ctx = document.getElementById("forecast").getContext('2d');
        var config = {
            type: 'bar',
            data: {
                labels: chart_labels,
                datasets: [{
                    type: 'line',
                    label: "Sales",
                    borderColor: "rgb(55, 160, 0)",
                    fill: false,
                    data: temp_dataset
                }, {
                    type: 'bar',
                    label: "Sales",
                    backgroundColor: "rgba(55, 160, 0, .1)",
                    borderColor: "rgba(55, 160, 0, .4)",
                    data: rain_dataset
                }]
            },
            options: {
                legend: false,
                scales: {
                    yAxes: [{
                        gridLines: {
                            color: "#e6e6e6",
                            zeroLineColor: "#e6e6e6",
                            borderDash: [2],
                            borderDashOffset: [2],
                            drawBorder: false,
                            drawTicks: false
                        },
                        ticks: {
                            padding: 20,
                            callback: function(value) {
                                return "Rp." + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                        }
                    }],

                    xAxes: [{
                        maxBarThickness: 50,
                        gridLines: {
                            lineWidth: [0]
                        },
                        ticks: {
                            padding: 20,
                            fontSize: 14,
                            fontFamily: "'Nunito Sans', sans-serif",
                        },
                    }]
                }
            }

        };

        var forecast_chart = new Chart(ctx, config);
        $("#0").on("click", function() {
            var data = forecast_chart.config.data;
            data.datasets[0].data = temp_dataset;
            data.datasets[1].data = rain_dataset;
            data.labels = chart_labels;
            forecast_chart.update();
        });
        $("#1").on("click", function() {
            var chart_labels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            var temp_dataset = [
                <?php for ($i = 1; $i < 13; $i++) {
                    echo $chartPayed[$i];
                ?>, <?php
                } ?>
            ];
            var rain_dataset = [
                <?php for ($i = 1; $i < 13; $i++) {
                    echo $chartPayed[$i];
                ?>, <?php
                } ?>
            ];
            var data = forecast_chart.config.data;
            data.datasets[0].data = temp_dataset;
            data.datasets[1].data = rain_dataset;
            data.labels = chart_labels;
            forecast_chart.update();
        });
        $("#blm_bayar").on("click", function() {
            var chart_labels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            var temp_dataset = [
                <?php for ($i = 1; $i < 13; $i++) {
                    echo $chartNotPayed[$i];
                ?>, <?php
                } ?>
            ];
            var rain_dataset = [
                <?php for ($i = 1; $i < 13; $i++) {
                    echo $chartNotPayed[$i];
                ?>, <?php
                } ?>
            ];

            var data = forecast_chart.config.data;
            data.datasets[0].data = temp_dataset;
            data.datasets[1].data = rain_dataset;
            data.labels = chart_labels;
            forecast_chart.update();
        });
    });
</script>
<script>
    //bar chart
    var chartColors = {
        gray: '#e4e4e4',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: '#37a000',
        blue: 'rgb(54, 162, 235)',
        purple: 'rgb(153, 102, 255)',
        grey: 'rgb(231,233,237)'
    };

    var randomScalingFactor = function() {
        return (Math.random() > 0.5 ? 1.0 : 1.0) * Math.round(Math.random() * 100);
    };

    // draws a rectangle with a rounded top
    Chart.helpers.drawRoundedTopRectangle = function(ctx, x, y, width, height, radius) {
        ctx.beginPath();
        ctx.moveTo(x + radius, y);
        // top right corner
        ctx.lineTo(x + width - radius, y);
        ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
        // bottom right	corner
        ctx.lineTo(x + width, y + height);
        // bottom left corner
        ctx.lineTo(x, y + height);
        // top left
        ctx.lineTo(x, y + radius);
        ctx.quadraticCurveTo(x, y, x + radius, y);
        ctx.closePath();
    };

    Chart.elements.RoundedTopRectangle = Chart.elements.Rectangle.extend({
        draw: function() {
            var ctx = this._chart.ctx;
            var vm = this._view;
            var left, right, top, bottom, signX, signY, borderSkipped;
            var borderWidth = vm.borderWidth;

            if (!vm.horizontal) {
                // bar
                left = vm.x - vm.width / 2;
                right = vm.x + vm.width / 2;
                top = vm.y;
                bottom = vm.base;
                signX = 1;
                signY = bottom > top ? 1 : -1;
                borderSkipped = vm.borderSkipped || 'bottom';
            } else {
                // horizontal bar
                left = vm.base;
                right = vm.x;
                top = vm.y - vm.height / 2;
                bottom = vm.y + vm.height / 2;
                signX = right > left ? 1 : -1;
                signY = 1;
                borderSkipped = vm.borderSkipped || 'left';
            }

            // Canvas doesn't allow us to stroke inside the width so we can
            // adjust the sizes to fit if we're setting a stroke on the line
            if (borderWidth) {
                // borderWidth shold be less than bar width and bar height.
                var barSize = Math.min(Math.abs(left - right), Math.abs(top - bottom));
                borderWidth = borderWidth > barSize ? barSize : borderWidth;
                var halfStroke = borderWidth / 2;
                // Adjust borderWidth when bar top position is near vm.base(zero).
                var borderLeft = left + (borderSkipped !== 'left' ? halfStroke * signX : 0);
                var borderRight = right + (borderSkipped !== 'right' ? -halfStroke * signX : 0);
                var borderTop = top + (borderSkipped !== 'top' ? halfStroke * signY : 0);
                var borderBottom = bottom + (borderSkipped !== 'bottom' ? -halfStroke * signY : 0);
                // not become a vertical line?
                if (borderLeft !== borderRight) {
                    top = borderTop;
                    bottom = borderBottom;
                }
                // not become a horizontal line?
                if (borderTop !== borderBottom) {
                    left = borderLeft;
                    right = borderRight;
                }
            }

            // calculate the bar width and roundess
            var barWidth = Math.abs(left - right);
            var roundness = this._chart.config.options.barRoundness || 0.5;
            var radius = barWidth * roundness * 0.5;

            // keep track of the original top of the bar
            var prevTop = top;

            // move the top down so there is room to draw the rounded top
            top = prevTop + radius;
            var barRadius = top - prevTop;

            ctx.beginPath();
            ctx.fillStyle = vm.backgroundColor;
            ctx.strokeStyle = vm.borderColor;
            ctx.lineWidth = borderWidth;

            // draw the rounded top rectangle
            Chart.helpers.drawRoundedTopRectangle(ctx, left, (top - barRadius + 1), barWidth, bottom - prevTop, barRadius);

            ctx.fill();
            if (borderWidth) {
                ctx.stroke();
            }

            // restore the original top value so tooltips and scales still work
            top = prevTop;
        }
    });

    Chart.defaults.roundedBar = Chart.helpers.clone(Chart.defaults.bar);

    Chart.controllers.roundedBar = Chart.controllers.bar.extend({
        dataElementType: Chart.elements.RoundedTopRectangle
    });

    var ctx = document.getElementById("barChart").getContext("2d");
    var myBar = new Chart(ctx, {
        type: 'roundedBar',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            datasets: [{
                label: 'Berita Acara',
                backgroundColor: chartColors.green,
                data: [
                    <?php for ($i = 1; $i < 13; $i++) {
                        echo $ba_Allbulan[$i];
                    ?>,
                    <?php } ?>
                ]
            }, {
                label: 'Invoice',
                backgroundColor: chartColors.gray,
                data: [
                    <?php for ($i = 1; $i < 13; $i++) {
                        echo $invoice_Allbulan[$i];
                    ?>,
                    <?php } ?>
                ]
            }]
        },
        options: {
            legend: false,
            responsive: true,
            barRoundness: 1,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        padding: 10
                    },
                    gridLines: {
                        borderDash: [2],
                        borderDashOffset: [2],
                        drawBorder: false,
                        drawTicks: false
                    }
                }],
                xAxes: [{
                    maxBarThickness: 10,
                    gridLines: {
                        lineWidth: [0],
                        drawBorder: false,
                        drawOnChartArea: false,
                        drawTicks: false
                    },
                    ticks: {
                        padding: 20
                    }
                }]
            }
        }
    });
</script>
</body>

</html>