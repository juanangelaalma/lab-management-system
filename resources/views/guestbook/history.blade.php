@extends('layouts.app', ['active' => 'guestbook_hist'])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Riwayat Kunjungan Anda</h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
              <div class="card">
                <div class="table-responsive text-nowrap py-2">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Tujuan</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @foreach ($guestbook as $gb)
                      <tr>
                        <td>{{ $gb->purpose }}</td>
                        <td>{{ $gb->start }}</td>
                        <td>{{ $gb->end }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection
