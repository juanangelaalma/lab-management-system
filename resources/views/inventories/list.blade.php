@extends('layouts.app', ['active' => 'inventories_list'])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Inventories</h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card">
                    <div class="table-responsive text-nowrap py-2">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Kondisi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($inventories as $inventory)
                                    <tr>
                                        <td>{{ $inventory->item_code }}</td>
                                        <td>{{ $inventory->name }}</td>
                                        <td>{{ $inventory->category->name }}</td>
                                        <td>{{ $inventory->description }}</td>
                                        <td><span
                                                class="badge me-1{{ $inventory->condition === 'bad' ? ' bg-label-danger' : ' bg-label-primary' }}">{{ ($inventory->condition == 'bad' ? '😥 ' : '🙂 ') . $inventory->condition }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="badge me-1{{ count($inventory->loans->where('status', 'not returned')) ? ' bg-label-danger' : ' bg-label-primary' }}">{{ count($inventory->loans->where('status', 'not returned')) ? 'not available' : 'available' }}</span>
                                        </td>
                                        <td>
                                            <a href=""
                                                class="btn btn-sm btn-primary{{ count($inventory->loans->where('status', 'not returned')) ? ' disabled' : '' }}">Ajukan
                                                Peminjaman</a>
                                        </td>
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
