@extends('layouts.app', ['active' => 'dashboard', 'title' => 'Dashboard'])

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Selamt datang {{ $name }}! 🎉</h5>
                                <p class="mb-4">
                                    <span class="fw-bold">Tetap semangat!!</span>. Masa depan adalah milik Anda yang
                                    telah menyiapkannya dari hari ini
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 order-1">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-3 text-center text-warning">Pinjam</h5>
                                <h1 class="card-title mb-3 text-center text-warning">{{ $loans_total }}</h1>
                                <p class="fw-semibold mb-0 text-center text-warning">Kali</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-3 text-center text-primary">Kunjungan</h5>
                                <h1 class="card-title mb-3 text-center text-primary">{{ $guestbook_total }}</h1>
                                <p class="fw-semibold mb-0 text-center text-primary">Kali</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 order-1 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5>Grafik Kunjungan</h6>
                    </div>
                    <div class="card-body px-0">
                        <div class="tab-content p-0">
                            <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                                <div id="guestChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection


@section('scripts')
    <script>
        var months = {{ json_encode($months) }}
        console.log(months);
        const guestChartEl = document.querySelector('#guestChart');
        const guestChartConfig = {
            chart: {
                height: 400,
                type: 'line',
                parentHeightOffset: 0,
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false
                }
            },
            series: [{
                data: months
            }],
            markers: {
                strokeWidth: 2,
                strokeOpacity: 1,
                strokeColors: [config.colors.white],
                colors: [config.colors.warning]
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            colors: [config.colors.primary],
            grid: {
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                padding: {
                    top: -20
                }
            },
            tooltip: {
                custom: function({
                    series,
                    seriesIndex,
                    dataPointIndex,
                    w
                }) {
                    return '<div class="px-3 py-2">' + '<span>' + series[seriesIndex][dataPointIndex] + '</span>' +
                        '</div>';
                }
            },
            xaxis: {
                categories: [
                    'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'Nopember',
                    'Desember',
                ]
            },
            yaxis: {
                labels: {
                    formatter: function(val) {
                        return val.toFixed(0);
                    }
                }
            }
        };
        if (typeof guestChartEl !== undefined && guestChartEl !== null) {
            const guestChart = new ApexCharts(guestChartEl, guestChartConfig);
            guestChart.render();
        }
    </script>
@endsection
