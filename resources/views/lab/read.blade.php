@extends('layouts.app', ['active' => 'lab_info'])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Lab Info</h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="row mb-5">

                    <div class="card p-4">
                        <h1 class="text-left">{{ $info->name }} Pertunjukan seni reog barong di dalam laboratorium
                        </h1>
                        <div class="text-left">
                          <i class='bx bxs-calendar'></i>
                          <h6 class="mb-4 d-inline-block">{{ $info->start }}</h6>
                        </div>
                        <img src="{{ $info->image }}" class="img-responsive rounded mb-4" alt="">
                        <p style="line-height: 2rem;">{{ $info->description }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
