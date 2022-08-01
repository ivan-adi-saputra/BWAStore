@extends('layouts.auth')

@section('title')
    Store Login Page
@endsection

@push('addon-style')
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />  
@endpush

@section('content')
     <!-- Page Content -->
    <div class="page-content page-auth">
      <div class="section-store-auth" data-aos="fade-up">
        <div class="container">
          <div class="row align-items-center row-login">
            <div class="col-lg-6 text-center">
              <img
                src="/images/login-placeholder.png"
                alt=""
                class="w-50 mb-4 mb-lg-none"
              />
            </div>
            <div class="col-lg-5">
              <h2>
                Belanja kebutuhan utama, <br />
                menjadi lebih mudah
              </h2>
              @if(session()->has('error'))
                    <div class="alert alert-danger alert-dismissable">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                      {{ session('error') }}
                    </div>
              @endif
              <form class="mt-3" method="POST" action="{{ route('authenticate') }}">
              @csrf
                <div class="form-group">
                  <label>Email address</label>
                  <input
                    type="email"
                    name="email"
                    class="form-control w-75"
                    aria-describedby="emailHelp"
                  />
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control w-75" name="password"/>
                </div>
                <button 
                  type="submit"
                  class="btn btn-success btn-block w-75 mt-4"
                >
                  Sign In to My Account
                </button>
              </form>
              <a class="btn btn-signup w-75 mt-2" href="{{ route('register') }}">
                Sign Up
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('addon-script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection