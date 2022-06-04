@extends('layouts.app_staff', ['active' => 'inventories_list', 'title' => 'Inventory'])

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
          <div class="card-header">
            <a href="{{ route('staff.inventories.create') }}" class="btn btn-primary btn-lg text-white"> <i class="bx bx-plus"></i> Tambah Inventori</a>
          </div>
          <div class="table-responsive text-nowrap px-3">
            <table class="table" id="data-table" style="width:100%">
              <thead>
                <tr>
                  <th class="text-primary">ID</th>
                  <th class="text-primary">Nama</th>
                  <th class="text-primary">Kategori</th>
                  <th class="text-primary">Kondisi</th>
                  <th class="text-primary">Actions</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0 text-white">
                @foreach ($inventories as $inventory)
                <tr>
                  <td class="py-3"><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $inventory->item_code }}</strong></td>
                  <td class="py-3">{{ $inventory->name }}</td>
                  <td class="py-3">{{ $inventory->category->name }}</td>
                  <td class="py-3">
                    <span class="badge me-1{{ $inventory->condition === 'bad' ? ' bg-label-danger' : ' bg-label-primary' }}">{{ ($inventory->condition == 'bad' ? '😥 ' : '🙂 ') . $inventory->condition }}</span>
                  </td>
                  <td class="py-3">
                    <a class="btn btn-sm btn-info" href="{{ route('staff.inventories.edit', $inventory) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                    <button id="btnDelete" onclick="deleteRecord({{ $inventory->id }})" type="button" data-bs-toggle="modal" data-bs-target="#modalDelete" class="btn btn-sm btn-danger"><i class="bx bx-trash me-1"></i> Delete</button>
                  </td>
                </tr>                    
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
    confirmDelete.setAttribute('action', `/staff/inventories/${id}/delete`)
  }
</script>
@endsection
