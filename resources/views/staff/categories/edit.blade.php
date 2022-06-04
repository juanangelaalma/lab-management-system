@extends('layouts.app_staff', ['active' => 'categories', 'title' => 'Edit Kategori'])

@section('styles')
  <link rel="stylesheet" href="/css/staff.css">
@endsection

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4 text-white">Edit Kategori</h4>
        
        <!-- Basic Bootstrap Table -->
        <div class="card pb-2 bg-dark shadow">
          <div class="card-body">
            <form action="{{ route('staff.categories.edit', $category) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label text-white" for="name">Name kategori</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control bg-dark text-white" id="name"
                            placeholder="PC-1" value="{{ $category->name }}" />
                        @error('name')
                            <span class="text-danger" role="alert">
                                <p class="m-0 mt-2">{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
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
    confirmDelete.setAttribute('action', `/staff/inventories/${id}/delete`)
  }
</script>
@endsection
