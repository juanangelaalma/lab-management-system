@extends('layouts.app', ['active' => 'feedback'])

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Feedback</h4>
        
        <!-- Basic Bootstrap Table -->
        <div class="card pb-2">
          <x-alert></x-alert>
          <div class="table-responsive text-nowrap">
            <table class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Komplain</th>
                  <th>Saran</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @php $no=1 @endphp
                @foreach ($feedback as $item)
                <tr>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $no }}</strong></td>
                  <td>
                    <span class="badge me-1 bg-label-warning">{{ timestamp_to_indo_date($item->created_at) }}</span>
                  </td>
                  <td>{{ $item->complaint }}</td>
                  <td>{{ $item->suggestion }}</td>
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
