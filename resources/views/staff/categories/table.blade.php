@extends('layouts.app_staff', ['active' => 'categories', 'title' => 'Kategori'])

@section('styles')
  <link rel="stylesheet" href="/css/staff.css">
@endsection

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4 text-white">Tabel Kategori</h4>
        
        <!-- Basic Bootstrap Table -->
        <div class="card pb-2 bg-dark shadow">
          <x-alert></x-alert>
          <div class="card-header">
            <a href="{{ route('staff.categories.create') }}" class="btn btn-primary btn-lg text-white"> <i class="bx bx-plus"></i> Tambah Kategori</a>
          </div>
          <div class="table-responsive text-nowrap">
            <table class="table">
              <thead>
                <tr>
                  <th class="text-primary">Nomor</th>
                  <th class="text-primary">Nama</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0 text-white">
                @php $no=1 @endphp
                @foreach ($categories as $category)
                <tr>
                  <td class="py-3"><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $no }}</strong></td>
                  <td class="py-3">{{ $category->name }}</td>
                  <td class="py-3">
                    <a class="btn btn-sm btn-info" href="{{ route('staff.categories.edit', $category) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                    <button id="btnDelete" onclick="deleteRecord({{ $category->id }})" type="button" data-bs-toggle="modal" data-bs-target="#modalDelete" class="btn btn-sm btn-danger"><i class="bx bx-trash me-1"></i> Delete</button>
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
    confirmDelete.setAttribute('action', `/staff/categories/${id}/delete`)
  }
</script>
@endsection
