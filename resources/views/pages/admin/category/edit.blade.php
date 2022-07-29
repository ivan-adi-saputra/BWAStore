@extends('layouts.admin')

@section('title')
    Category
@endsection

@section('content')
<div
  class="section-content section-dashboard-home"
  data-aos="fade-up"
>
  <div class="container-fluid">
    <div class="dashboard-heading">
        <h2 class="dashboard-title">Category</h2>
        <p class="dashboard-subtitle">
            Update Category
        </p>
    </div>
    <div class="dashboard-content">
      <div class="row">
        <div class="col-12">
            @if ( $errors->any() )
                <div class="alert alert-danger">
                    <ul>
                        @foreach ( $errors->all() as $item)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
          <form action="{{ route('category.update', $item->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Nama Kategori</label>
                      <input type="text" class="form-control" name="name" required value="{{ old('name', $item->name) }}" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Foto</label>
                      @if ( $item->photos )
                        <input type="file" class="form-control" name="photos" placeholder="Photo" required accept="image/*" id="imgInp" />
                        <img id="blah" src="{{ asset('storage/' . $item->photos) }}" alt="{{ $item->name }}" style="max-height: 80px" />
                      @else
                        <input type="file" class="form-control" name="photos" placeholder="Photo" required />
                        <img id="blah" src="" alt="" style="max-height: 80px" />
                      @endif
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