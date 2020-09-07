<script src="https://kit.fontawesome.com/40784c0abc.js" crossorigin="anonymous"></script>

<script src="/assets/vendor/jquery.min.js"></script>
<script src="/assets/vendor/popper.js"></script>
<script src="/assets/vendor/bootstrap.min.js"></script>
<script src="/assets/vendor/simplebar.js"></script>
<script src="/assets/vendor/Chart.min.js"></script>
<script src="/assets/vendor/moment.min.js"></script>
<script src="/assets/js/color_variables.js"></script>
<script src="/assets/js/app.js"></script>
<script src="/assets/vendor/dom-factory.js"></script>
<script src="/assets/vendor/material-design-kit.js"></script>
<script src="/assets/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/sweetalert.js"></script>

<script>
    (function() {
        'use strict';
        // Self Initialize DOM Factory Components
        domFactory.handler.autoInit()


        // Connect button(s) to drawer(s)
        var sidebarToggle = document.querySelectorAll('[data-toggle="sidebar"]')

        sidebarToggle.forEach(function(toggle) {
            toggle.addEventListener('click', function(e) {
                var selector = e.currentTarget.getAttribute('data-target') || '#default-drawer'
                var drawer = document.querySelector(selector)
                if (drawer) {
                    if (selector == '#default-drawer') {
                        $('.container-fluid').toggleClass('container--max');
                    }
                    drawer.mdkDrawer.toggle();
                }
            })
        })
    })()
</script>
<script src="/assets/vendor/morris.min.js"></script>
<script src="/assets/vendor/raphael.min.js"></script>
<script src="/assets/vendor/bootstrap-datepicker.min.js"></script>
<script src="/assets/js/datepicker.js"></script>
<script>
    $(function() {
        window.morrisDashboardChart = new Morris.Area({
            element: 'morris-area-chart',
            data: [{
                    year: '2017-01',
                    a: 6352.27
                },
                {
                    year: '2017-02',
                    a: 4309.98
                },
                {
                    year: '2017-03',
                    a: 1465.98
                },
                {
                    year: '2017-04',
                    a: 1298.25
                },
                {
                    year: '2017-05',
                    a: 3209
                },
                {
                    year: '2017-06',
                    a: 2083
                },
                {
                    year: '2017-07',
                    a: 1285.23
                },
                {
                    year: '2017-08',
                    a: 1289
                },
                {
                    year: '2017-09',
                    a: 4430
                },
                {
                    year: '2017-10',
                    a: 8921.19
                }
            ],
            xkey: 'year',
            ykeys: ['a'],
            labels: ['Earnings'],
            lineColors: ['#fff'],
            fillOpacity: '0.2',
            gridEnabled: true,
            gridTextColor: '#ffffff',
            resize: true
        });

    });
</script>

<script src="/assets/js/myjs.js"></script>
</body>

</html>