@extends('layouts.app', ['active' => 'loans', 'title' => 'Peminjaman'])

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Tabel Inventori</h4>
        
        <!-- Basic Bootstrap Table -->
        <div class="card pb-2">
          <x-alert></x-alert>
          <div class="table-responsive text-nowrap">
            <table class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Barang</th>
                  <th>Peminjam</th>
                  <th>Mulai</th>
                  <th>Perjanjian kembali</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @php $no=1 @endphp
                @foreach ($loans as $loan)
                <tr>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $no }}</strong></td>
                  <td>{{ $loan->inventory ? $loan->inventory->item_code : '' }}</td>
                  <td>{{ $loan->guest->name }}</td>
                  <td>{{ $loan->start }}</td>
                  <td>{{ $loan->end }}</td>
                  <td>
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
