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
          <form action="{{ route('product.update', $items->id) }}" method="post">
            @method('PUT')
            @csrf
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Nama Product</label>
                      <input type="text" class="form-control" name="name" required value="{{ old('name', $items->name) }}" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Pemilik</label>
                      <select class="form-control" name="users_id">
                        @foreach ( $users as $user )
                        @if( old('users_id', $items->user->id) === $user->id )
                          <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                        @else
                          <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Category</label>
                      <select class="form-control" name="categories_id">
                        @foreach ( $categories as $category )
                        @if ( old('categories_id', $items->category->id) == $category->id )
                          <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif 
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Price</label>
                      <input type="number" class="form-control" name="price" required value="{{ old('price', $items->price) }}" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Description</label>
                      <textarea    
                        name="description"
                        id="editor"
                        cols="30"
                        rows="4"
                        class="form-control">{{ old('description', $items->description) }}
                      </textarea>
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