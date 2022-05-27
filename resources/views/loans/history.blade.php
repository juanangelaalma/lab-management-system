@extends('layouts.app', ['active' => 'loans'])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Riwayat Peminjaman</h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
              <div class="card">
                <x-alert></x-alert>
                <div class="table-responsive text-nowrap py-2">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @php $no = 1 @endphp
                      @foreach ($loans as $loan)
                      <tr>
                        <td>{{ $no }}</td>
                        <td class="{{ $loan->inventory ? ''  : 'text-danger' }}">{{ $loan->inventory ? $loan->inventory->item_code : 'DELETED' }}</td>
                        <td class="{{ $loan->inventory ? ''  : 'text-danger' }}">{{ $loan->inventory ? $loan->inventory->name : 'DELETED' }}</td>
                        <td>{{ $loan->start }}</td>
                        <td>{{ $loan->end }}</td>
                        <td><span class="badge me-1 {{ $loan->status === 'not returned' ? 'bg-label-danger' : 'bg-label-primary' }}">{{ $loan->status }}</span></td>
                      </tr>
                      @php $no++ @endphp
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection
