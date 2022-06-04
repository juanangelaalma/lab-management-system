@extends('layouts.app_staff', ['active' => 'users', 'title' => 'Users'])

@section('styles')
  <link rel="stylesheet" href="/css/staff.css">
@endsection

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4 text-white">User</h4>
        
        <!-- Basic Bootstrap Table -->
        <div class="card pb-2 bg-dark shadow">
          <x-alert></x-alert>
          <div class="table-responsive text-nowrap p-3">
            <table class="table" id="data-table" style="width:100%">
              <thead>
                <tr>
                  <th class="text-primary">No</th>
                  <th class="text-primary">Profile Picture</th>
                  <th class="text-primary">Nomor Induk</th>
                  <th class="text-primary">Email</th>
                  <th class="text-primary">Name</th>
                  <th class="text-primary">Action</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0 text-white">
                @php $no=1 @endphp
                @foreach ($users as $user)
                <tr>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $no }}</strong></td>
                  <td class="py-3">
                    <img style="object-fit: cover;object-position: center;" class="d-block rounded" height="50" width="50" src="{{ $user->guest->profile_picture ? '/storage/assets/img/avatars/'.$user->guest->profile_picture : '/assets/img/avatars/profile.png' }}" alt="{{ $user->guest->name }}">
                  </t class="py-3"d>
                  <td class="py-3">{{ $user->guest->reg_number }}</td>
                  <td class="py-3">{{ $user->email }}</td>
                  <td class="py-3">{{ $user->guest->name }}</td>
                  <td class="py-3">
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
