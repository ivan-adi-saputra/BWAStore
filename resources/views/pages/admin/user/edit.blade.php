@extends('layouts.admin')

@section('title')
    User
@endsection

@section('content')
<div
  class="section-content section-dashboard-home"
  data-aos="fade-up"
>
  <div class="container-fluid">
    <div class="dashboard-heading">
        <h2 class="dashboard-title">User</h2>
        <p class="dashboard-subtitle">
            Update User
        </p>
    </div>
    <div class="dashboard-content">
      <div class="row">
          <form action="{{ route('user.update', $item->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Nama User</label>
                      <input type="text" class="form-control" name="name" required value="{{ $item->name }}" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Email User</label>
                      <input type="email" class="form-control" name="email" required value="{{ $item->email }}" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Password</label>
                      <small class="text-danger">
                        *kosongkan jika tidak ingin mengubah password
                      </small>
                      <input type="password" class="form-control" name="password" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Roles</label>
                      <select class="form-control form-control-sm" name="roles">
                        @if ( $item->roles )
                          <option value="{{ $item->roles }}" selected>{{ $item->roles }}</option>
                        @else
                          <option value="{{ $item->roles }}">{{ $item->roles }}</option>
                        @endif
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col text-right">
                    <button
                      type="submit"
                      class="btn btn-success px-5"
                    >
                      Save Now
                    </button>
                  </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('addon-script')
<script>
    imgInp.onchange = evt => {
    const [file] = imgInp.files
        if (file) {
            blah.src = URL.createObjectURL(file)
        }
    }
</script>
@endpush