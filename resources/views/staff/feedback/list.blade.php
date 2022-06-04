@extends('layouts.app_staff', ['active' => 'feedback', 'title' => 'Feedback'])

@section('styles')
  <link rel="stylesheet" href="/css/staff.css">
@endsection

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4 text-white">Feedback</h4>
        
        <!-- Basic Bootstrap Table -->
        <div class="card pb-2 bg-dark shadow">
          <x-alert></x-alert>
          <div class="table-responsive text-nowrap p-3">
            <table class="table" id="data-table" style="width:100%">
              <thead>
                <tr>
                  <th class="text-primary">No</th>
                  <th class="text-primary">Tanggal</th>
                  <th class="text-primary">Komplain</th>
                  <th class="text-primary">Saran</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0 text-white">
                @php $no=1 @endphp
                @foreach ($feedback as $item)
                <tr>
                  <td class="py-3"><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $no }}</strong></td>
                  <td class="py-3">
                    <span class="badge me-1 bg-label-primary">{{ timestamp_to_indo_date($item->created_at) }}</span>
                  </td>
                  <td class="py-3">{{ $item->complaint }}</td>
                  <td class="py-3">{{ $item->suggestion }}</td>
                </tr>
                @php $no++ @endphp                    
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>

@endsection

@section('scripts')
@endsection
