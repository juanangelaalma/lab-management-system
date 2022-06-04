@extends('layouts.app_staff', ['active' => 'inventories_list', 'title' => 'Edit Inventory'])

@section('styles')
  <link rel="stylesheet" href="/css/staff.css">
@endsection

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4 text-white">Tambah Inventori</h4>
        
        <!-- Basic Bootstrap Table -->
        <div class="card pb-2 bg-dark shadow">
          <div class="card-body">
            <form action="{{ route('staff.inventories.edit', $inventory) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label text-white" for="item-code">Kode Item</label>
                    <div class="col-sm-10">
                        <input type="text" name="item_code" class="form-control bg-dark text-white" id="item-code"
                            placeholder="PC-1" value="{{ $inventory->item_code }}" />
                        @error('item_code')
                            <span class="text-danger" role="alert">
                                <p class="m-0 mt-2">{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label text-white" for="name">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control bg-dark text-white" id="name"
                            placeholder="Macbook Pro" value="{{ $inventory->name }}" />
                        @error('name')
                            <span class="text-danger" role="alert">
                                <p class="m-0 mt-2">{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                  <label for="category" class="col-sm-2 col-form-label text-white">Kategori</label>
                  <div class="col-md-10">
                    <select class="form-select bg-dark text-white" name="category_id" id="category" aria-label="Default select example">
                      <option selected value="null">Pilih...</option>
                      @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $inventory->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                      @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-danger" role="alert">
                            <p class="m-0 mt-2">{{ $message }}</p>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="condition" class="col-sm-2 col-form-label text-white">Kondisi</label>
                  <div class="col-md-10">
                    <select class="form-select bg-dark text-white" name="condition" id="condition" aria-label="Default select example">
                      <option selected value="null">Pilih...</option>
                      <option value="good" {{ $inventory->condition == 'good' ? 'selected' : '' }} >Baik</option>
                      <option value="bad" {{ $inventory->condition == 'bad' ? 'selected' : '' }} >Buruk</option>
                    </select>
                    @error('condition')
                        <span class="text-danger" role="alert">
                          <p class="m-0 mt-2">{{ $message }}</p>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label text-white" for="description">Deskripsi
                        (Optional)</label>
                    <div class="col-sm-10">
                        <textarea id="description" name="description" class="form-control bg-dark text-white" placeholder="Deskripsi tujuan"
                            aria-label="Deskripsi tujuan"
                            aria-describedby="basic-icon-default-message2">{{ $inventory->description }}</textarea>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Send</button>
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
