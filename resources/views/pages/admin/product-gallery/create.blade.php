@extends('layouts.admin')

@section('title')
    Product gallery
@endsection

@section('content')
<div
  class="section-content section-dashboard-home"
  data-aos="fade-up"
>
  <div class="container-fluid">
    <div class="dashboard-heading">
        <h2 class="dashboard-title">Product gallery</h2>
        <p class="dashboard-subtitle">
            Create New Product gallery
        </p>
    </div>
    <div class="dashboard-content">
      <div class="row">
        <div class="col-12">
          <form action="{{ route('product-gallery.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Nama Product</label>
                      <select class="form-control" name="products_id">
                        @foreach ($products as $product)
                        @if ( old('products_id') == $product->id )
                          <option value="{{ $product->id }}" selected>{{ $product->name }}</option>
                        @else
                          <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Photos</label>
                      <input type="file" class="form-control" name="photos" required accept="image/*" id="imgInp" />
                      <img id="blah" src="" alt="" style="max-height: 80px" />
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