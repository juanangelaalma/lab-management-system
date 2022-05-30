@extends('layouts.app', ['active' => 'guestbook'])

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Tabel Kunjungan</h4>
        
        <!-- Basic Bootstrap Table -->
        <div class="card pb-2">
          <x-alert></x-alert>
          <div class="table-responsive text-nowrap">
            <table class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Nama User</th>
                  <th>Tujuan</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @php $no=1 @endphp
                @foreach ($guestbook as $item)
                <tr>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $no }}</strong></td>
                  <td>
                    <span class="badge me-1 bg-label-warning">{{ timestamp_to_indo_date($item->start) }}</span>
                  </td>
                  <td>{{ $item->guest->name }}</td>
                  <td>{{ $item->purpose }}</td>
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
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Apakah kamu yakin?</h5>
          </div>
          <div class="modal-footer pt-4">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <form id="confirmDelete" method="post">
              @csrf
              @method("DELETE")
              <button type="submit" class="btn btn-danger">DELETE</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- / Content -->
@endsection

@section('scripts')
<script>
  function deleteRecord(id) {
    const confirmDelete = document.getElementById('confirmDelete')
    confirmDelete.setAttribute('action', `/staff/info/${id}/delete`)
  }
</script>
@endsection
