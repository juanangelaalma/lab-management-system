@extends('layouts.app', ['active' => 'inventory_list', 'title' => 'Peminjaman'])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Mengajukan Peminjaman</h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <x-alert></x-alert>
                    <div class="card-body">
                        <form action="{{ route('loans.store') }}" method="POST">
                            @csrf
                            <input type="text" name="inventory_id" value="{{ $inventory->id }}" hidden>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="item_code">Kode Item</label>
                                <div class="col-sm-10">
                                    <input type="text" name="item_code" value="{{ $inventory->item_code }}" class="form-control" id="item_code" readonly />
                                    @error('item_code')
                                        <span class="text-danger" role="alert">
                                            <p class="m-0 mt-2">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="name" class="col-md-2 col-form-label">Nama Barang</label>
                                <div class="col-md-10">
                                  <input type="text" name="name" value="{{ $inventory->name }}" class="form-control" id="name" readonly />
                                    @error('name')
                                        <span class="text-danger" role="alert">
                                            <p class="m-0 mt-2">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="start" class="col-md-2 col-form-label">Start</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="start" type="datetime-local"
                                        id="start" />
                                    @error('start')
                                        <span class="text-danger" role="alert">
                                            <p class="m-0 mt-2">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="end" class="col-md-2 col-form-label">Selesai</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="end" type="datetime-local"
                                        id="end" />
                                    @error('end')
                                        <span class="text-danger" role="alert">
                                            <p class="m-0 mt-2">{{ $message }}</p>
                                        </span>
                                    @enderror
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
            </div>
        </div>
    </div>
@endsection
