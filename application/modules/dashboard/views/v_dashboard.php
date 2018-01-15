<!--Page Header-->
<div class="header">
    <div class="header-content">
        <div class="page-title"><i class="icon-display4"></i> Dashboard</div>
        <ul class="breadcrumb">
            <li class="active"><a href="#">Home</a></li>
        </ul>
    </div>


</div>
<!--/Page Header-->

<div class="container-fluid page-content">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Grafik Jumlah Kunjungan Tahun <?=date('Y');?></h5>
                </div>
                <div class="panel-body">
<!--                    <div class="chart" id="chart_kegiatan_month"></div>-->
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

        </div>
    </div>
</div>
<script type="text/javascript" src="<?=base_url('assets/scripts/mmenu.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/scripts/jquery.mousewheel.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/scripts/mapsvg.min.js');?>"></script>

<script type="text/javascript" src="<?=base_url('assets/scripts/chosen.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/scripts/slick.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/scripts/rangeslider.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/scripts/magnific-popup.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/scripts/waypoints.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/scripts/counterup.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/scripts/jquery-ui.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/scripts/tooltips.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/scripts/custom.js');?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#map").mapSvg({
            width: 1280,
            height: 605,
            loadingText: "Memuat Layout...",
            colors: {
                baseDefault: "#000000",
                background: "#eeeeee",
                //selected: "#f91942",
                selected: "#f8a208",
                hover: 20
            },
            regions: {
                'path_0': {
                    id: "path_0",
                    tooltip: "Ruang Adminduk",
                    data: {id: 3, name: "Ruang Adminduk"}
                },
                'path_2': {
                    id: "path_2",
                    tooltip: "Ruang Tamu",
                    data: {id: 2, name: "Ruang Tamu"}
                },
                'rect_4': {
                    id: "rect_4",
                    tooltip: "Ruang Rapat",
                    data: {id: 5, name: "Ruang Rapat"}
                },
                'rect_7': {
                    id: "rect_7",
                    tooltip: "Ruang Penerimaan",
                    data: {id: 1, name: "Ruang Penerimaan"}
                },
                'path_9': {
                    id: "path_9",
                    tooltip: "Ruang Monitoring",
                    data: {id: 4, name: "Ruang Monitoring"}
                },
                'path_11': {
                    id: "path_11",
                    tooltip: "Lorong"
                },
                'rect_13': {
                    id: "rect_13",
                    tooltip: "Ruang Panel",
                    data: {id: 12, name: "Ruang Panel"}
                },
                'rect_15': {
                    id: "rect_15",
                    tooltip: "Ruang Kerja BPPT",
                    data: {id: 11, name: "Ruang Kerja BPPT"}
                },
                'rect_29': {
                    id: "rect_29",
                    tooltip: "Ruang Developer",
                    data: {id: 9, name: "Ruang Developer"}
                },
                'path_31': {
                    id: "path_31",
                    tooltip: "Ruang UPS",
                    data: {id: 8, name: "Ruang UPS"}
                },
                'rect_33': {
                    id: "rect_33",
                    tooltip: "Ruang CCTV",
                    data: {id: 6, name: "Ruang CCTV"}
                },
                'path_37': {
                    id: "path_37",
                    tooltip: "Ruang Server",
                    data: {id: 10, name: "Ruang Server"}
                },
                'rect_59': {
                    id: "rect_59",
                    tooltip: "Lorong"
                }
            },
            viewBox: [0,0,576,592],
            onClick: function() {
                console.log(this.data.name);
                if (this.data.id) {
                    $('#room_name').html(this.data.name);
                    $.magnificPopup.open({
                        items: {
                            src: '#map-detail-dialog', // can be a HTML string, jQuery object, or CSS selector
                            type: 'inline',
                        },
                        fixedContentPos: false,
                        fixedBgPos: true,
                        overflowY: 'auto',
                        closeBtnInside: true,
                        preloader: false,
                        midClick: true,
                        removalDelay: 300,
                        mainClass: 'my-mfp-zoom-in',
                    });

                }
            },
            zoom: {
                on: true,
                limit: [0,10],
                delta: 1.2,
                buttons: {
                    on: true,
                    location: "right"
                }
            },
            scroll: {
                on: true,
                limit: false,
                background: false
            },
            gauge: {
                on: false,
                labels: {
                    low: "low",
                    high: "high"
                },
                colors: {
                    lowRGB: {
                        r: 85,
                        g: 0,
                        b: 0,
                        a: 1
                    },
                    highRGB: {
                        r: 238,
                        g: 0,
                        b: 0,
                        a: 1
                    },
                    low: "#550000",
                    high: "#ee0000",
                    diffRGB: {
                        r: 153,
                        g: 0,
                        b: 0,
                        a: 0
                    }
                },
                min: 0,
                max: false
            },
            source: "assets/layout/main.svg",title: "Main MMU",responsive: true
        });
    });
</script>

<!--<script type="text/javascript" src="--><?//=base_url('assets/js/charts/d3/d3.min.js');?><!--"></script>-->
<!--<script type="text/javascript" src="--><?//=base_url('assets/js/charts/c3/c3.min.js');?><!--"></script>-->

<!--<script type="text/javascript">
    'use_strict';
    $(function () {
        'use strict';

        var line_chart = c3.generate({
            bindto: '#chart_kegiatan_month',
            point: {
                r: 4
            },
            size: { height: 300 },
            color: {
                pattern: ['#4CAF50', '#e91e63', '#1E88E5', '#ffeb3b' , '#D102FA', '#FA8F02', '#1de9b6', '#a1887f']
            },
            data: {
                url: '<?=base_url("dashboard/get_chart_kegiatan_monthly");?>',
                mimeType: 'json',
                type: 'spline'
            },
            axis: {
                x: {
                    type: 'category',
                    categories: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
                },
                y: {
                    tick: { format: d3.format("d") }
                }
            },
            grid: {
                y: {
                    show: true
                }
            }
        });

        $(".sidebar-control").on('click', function() {
            line_chart.resize();
        });
    });
</script>-->