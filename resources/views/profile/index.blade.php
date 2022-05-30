@extends('layouts.app', ['active' => 'profile', 'title' => 'Profile'])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Profile</h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <x-alert></x-alert>
                    <form id="formAccountSettings" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img style="object-fit: cover; object-position: center;" id="profile-preview" src="{{ $profile->guest->profile_picture ? '/storage/assets/img/avatars/'.$profile->guest->profile_picture : '/assets/img/avatars/profile.png' }}"
                                    alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">Upload new photo</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" name="profile_picture" onchange="showPreview(event)" id="upload" class="account-file-input" hidden
                                            accept="image/png, image/jpeg" />
                                        @error('profile_picture')
                                            <span class="text-danger" role="alert">
                                                <p class="m-0 mt-2">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </label>
                                    <p class="text-muted mb-0">Allowed JPEG, JPG or PNG. Max size of 1Mb</p>
                                </div>
                            </div>
                        </div>
                        <hr class="my-0" />
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input class="form-control" type="text" id="name" name="name"
                                        value="{{ $profile->guest->name }}" autofocus />
                                    @error('name')
                                        <span class="text-danger" role="alert">
                                            <p class="m-0 mt-2">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="reg_number" class="form-label">Nomor Induk</label>
                                    <input class="form-control" type="text" name="reg_number" id="reg_number"
                                        value="{{ $profile->guest->reg_number }}" />
                                    @error('reg_number')
                                        <span class="text-danger" role="alert">
                                            <p class="m-0 mt-2">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="text" id="email" name="email"
                                        placeholder="john.doe@example.com" value="{{ $profile->email }}" />
                                    @error('email')
                                        <span class="text-danger" role="alert">
                                            <p class="m-0 mt-2">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="birth_place" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="birth_place" name="birth_place"
                                        placeholder="Surabaya" value="{{ $profile->guest->birth_place }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="birth_place" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="birth_date" name="birth_date"
                                        value="{{ $profile->guest->birth_date }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="address" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Address" value="{{ $profile->guest->address }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="major" class="form-label">Jurusan</label>
                                    <input class="form-control" type="text" id="major" name="major"
                                        placeholder="Teknik Informatika" value="{{ $profile->guest->major }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="study_program" class="form-label">Program Study</label>
                                    <input class="form-control" type="text" id="study_program" name="study_program"
                                        placeholder="S1 Teknik Informatika"
                                        value="{{ $profile->guest->study_program }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="class" class="form-label">Kelas</label>
                                    <input class="form-control" type="text" id="class" name="class" placeholder="A"
                                        value="{{ $profile->guest->class }}" />
                                    @error('class')
                                        <span class="text-danger" role="alert">
                                            <p class="m-0 mt-2">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
      function showPreview(event) {
        if(event.target.files.length > 0) {
          const src = URL.createObjectURL(event.target.files[0]);
          const preview = document.getElementById('profile-preview');
          preview.src = src;
        }
      }
    </script>
@endsection
