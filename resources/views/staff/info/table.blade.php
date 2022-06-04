@extends('layouts.app', ['active' => 'info', 'title' => 'Info'])

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Tabel Event</h4>
        
        <!-- Basic Bootstrap Table -->
        <div class="card pb-2">
          <x-alert></x-alert>
          <div class="card-header">
            <a href="{{ route('staff.info.create') }}" class="btn btn-primary btn-lg text-white"> <i class="bx bx-plus"></i> Tambah Event</a>
          </div>
          <div class="table-responsive text-nowrap px-3">
            <table class="table" id="data-table" style="width:100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Image</th>
                  <th>Event</th>
                  <th>PJ</th>
                  <th>Tanggal</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @php $no=1 @endphp
                @foreach ($events as $event)
                <tr>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $no }}</strong></td>
                  <td>
                    <img style="object-fit: cover;object-position: center;" class="d-block rounded" height="50" width="50" src="/storage/assets/img/events/thumbs/{{ $event->image }}" alt="{{ $event->name }}">
                  </td>
                  <td>{{ $event->name }}</td>
                  <td>{{ $event->responsible }}</td>
                  <td>{{ $event->start }}</td>
                  <td>
                    <a class="btn btn-sm btn-info" href="{{ route('staff.info.edit', $event) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                    <button id="btnDelete" onclick="deleteRecord({{ $event->id }})" type="button" data-bs-toggle="modal" data-bs-target="#modalDelete" class="btn btn-sm btn-danger"><i class="bx bx-trash me-1"></i> Delete</button>
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
