@extends('layouts.app_staff', ['active' => 'loans', 'title' => 'Peminjaman'])

@section('styles')
  <link rel="stylesheet" href="/css/staff.css">
@endsection

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4 text-white">Tabel Inventori</h4>
        
        <!-- Basic Bootstrap Table -->
        <div class="card pb-2 bg-dark shadow">
          <x-alert></x-alert>
          <div class="table-responsive text-nowrap p-3">
            <table class="table" id="data-table" style="width:100%">
              <thead>
                <tr>
                  <th class="text-primary">No</th>
                  <th class="text-primary">Kode Barang</th>
                  <th class="text-primary">Peminjam</th>
                  <th class="text-primary">Mulai</th>
                  <th class="text-primary">Perjanjian kembali</th>
                  <th class="text-primary">Actions</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0 text-white">
                @php $no=1 @endphp
                @foreach ($loans as $loan)
                <tr>
                  <td class="py-3"><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $no }}</strong></td>
                  <td class="py-3">{{ $loan->inventory ? $loan->inventory->item_code : '' }}</td>
                  <td class="py-3">{{ $loan->guest->name }}</td>
                  <td class="py-3">{{ $loan->start }}</td>
                  <td class="py-3">{{ $loan->end }}</td>
                  <td class="py-3">
                    <button id="btnDone" onclick="asDone({{ $loan->id }})" type="button" data-bs-toggle="modal" data-bs-target="#modalDone" class="btn btn-sm btn-info"><i class='bx bx-check-circle'></i> As Done</button>
                  </td>
                </tr>                    
                @php $no++ @endphp
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="modalDone" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Apakah kamu yakin?</h5>
          </div>
          <div class="modal-footer pt-4">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <form id="confirmDone" method="post">
              @csrf
              @method("PUT")
              <button type="submit" class="btn btn-info"><i class='bx bx-check-circle'></i> As Done</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- / Content -->
@endsection

@section('scripts')
<script>
  function asDone(id) {
    const confirmDone = document.getElementById('confirmDone')
    confirmDone.setAttribute('action', `/staff/loans/${id}/asdone`)
  }
</script>
@endsection
