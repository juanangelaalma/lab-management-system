@extends('layouts.app', ['active' => 'dashboard', 'title' => 'Dashboard'])

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
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
        </div>
        <div class="row" style="max-height: 400px;">
            <div class="col-md-12 h-100 col-lg-4 order-0 mb-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Kunjungan hari ini</h5>
                    </div>
                    
                    <div class="card-body overflow-auto small-scrollbar" style="height: 300px;">
                        <ul class="p-0 m-0 h-100">
                            @if (!$guestbooks->count())
                                <div class="h-100 d-flex justify-content-center align-items-center">
                                    <span class="text-center">Maaf yaahh. Belum ada kunjungan hari ini 😥</span>
                                </div>
                            @else
                                @foreach ($guestbooks as $item)
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img style="object-fit: cover;object-position: center;" src="{{ $item->guest->profile_picture ? '/storage/assets/img/avatars/'.$item->guest->profile_picture : '/assets/img/avatars/profile.png' }}" alt="User" class="rounded" />
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">{{ $item->guest->name }}</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <span class="text-muted">{{ date("H:i:s", strtotime($item->start)) }}</span>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-12 h-100 col-lg-4 order-0 mb-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Inventori</h5>
                    </div>
                    <div class="card-body overflow-auto small-scrollbar d-flex flex-column justify-content-between" style="height: 300px;">
                        <ul class="p-0 m-0 h-100">
                            @if (!$inventories->count())
                                <div class="h-100 d-flex justify-content-center align-items-center">
                                    <span>Kosong 😥</span>
                                </div>
                            @else
                                @foreach ($inventories as $inventory)
                                <li class="d-flex mb-4 pb-1">
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">{{ $inventory->name }}</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <span class="text-muted badge me-1{{ $inventory->condition === 'bad' ? ' bg-label-danger' : ' bg-label-primary' }}">{{ ($inventory->condition == 'bad' ? '😥 ' : '🙂 ') . $inventory->condition }}</span>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            @endif
                        </ul>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('staff.inventories.table') }}" class="link-primary">More...</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 h-100 col-lg-4 order-0 mb-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Peminjaman</h5>
                    </div>
                    <div class="card-body overflow-auto small-scrollbar d-flex flex-column justify-content-between" style="height: 300px;">
                        <ul class="p-0 m-0 h-100">
                            @if (!$loans->count())
                                <div class="h-100 d-flex justify-content-center align-items-center">
                                    <span>Kosong 😥</span>
                                </div>
                            @else
                                @foreach ($loans as $loan)
                                <li class="d-flex mb-4 pb-1">
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">{{ $loan->item_code }}</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <span class="text-muted">{{ $loan->name }}</span>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            @endif
                        </ul>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('staff.inventories.table') }}" class="link-primary">More...</a>
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
