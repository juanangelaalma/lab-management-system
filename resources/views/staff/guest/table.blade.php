@extends('layouts.app', ['active' => 'users', 'title' => 'Users'])

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">User</h4>
        
        <!-- Basic Bootstrap Table -->
        <div class="card pb-2">
          <x-alert></x-alert>
          <div class="table-responsive text-nowrap p-3">
            <table class="table" id="data-table" style="width:100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Profile Picture</th>
                  <th>Nomor Induk</th>
                  <th>Email</th>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @php $no=1 @endphp
                @foreach ($users as $user)
                <tr>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $no }}</strong></td>
                  <td>
                    <img style="object-fit: cover;object-position: center;" class="d-block rounded" height="50" width="50" src="{{ $user->guest->profile_picture ? '/storage/assets/img/avatars/'.$user->guest->profile_picture : '/assets/img/avatars/profile.png' }}" alt="{{ $user->guest->name }}">
                  </td>
                  <td>{{ $user->guest->reg_number }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->guest->name }}</td>
                  <td>
                    <a href="{{ route('staff.guests.details', $user) }}" class="btn btn-info btn-sm text-white"><i class="bx bxs-user-detail"></i> Detail</a>
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

@endsection

@section('scripts')
@endsection
