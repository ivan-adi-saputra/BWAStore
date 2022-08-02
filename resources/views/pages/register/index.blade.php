@extends('layouts.auth')

@section('title')
    Store Register Page
@endsection

@section('content')
     <!-- Page Content -->
    <div class="page-content page-auth mt-5" id="register">
      <div class="section-store-auth" data-aos="fade-up">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4">
              <h2>
                Memulai untuk jual beli <br />
                dengan cara terbaru
              </h2>
              <form  action="{{ route('register-store') }}" class="mt-3" method="POST">
              @csrf
                <div class="form-group">
                  <label>Full Name</label>
                  <input
                    type="text"
                    class="form-control is-valid"
                    aria-describedby="nameHelp"
                    v-model="name"
                    autofocus
                    name="name"
                    placeholder="Your Name"
                    value="{{ old('name') }}"
                  />
                </div>
                <div class="form-group">
                  <label>Username</label>
                  <input
                    type="text"
                    class="form-control is-valid"
                    aria-describedby="usernameHelp"
                    v-model="username"
                    name="username"
                    placeholder="Username"
                    value="{{ old('username') }}"
                  />
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input
                    type="email"
                    class="form-control is-invalid"
                    aria-describedby="emailHelp"
                    v-model="email"
                    name="email"
                    placeholder="email@example.com"
                    value="{{ old('email') }}"
                  />
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" id="password" class="form-control" name="password" placeholder="password"/>
                   @error('password')
                   <div class="invalid-feedback">
                    {{ $message }}
                   </div>
                  @enderror
                </div>

               <div class="form-group">
                  <label for="store_status">Store</label>
                  <p class="text-muted">
                    Apakah anda juga ingin membuka toko?
                  </p>
                  <div
                    class="custom-control custom-radio custom-control-inline"
                  >
                    <input
                      class="custom-control-input"
                      type="radio"
                      name="store_status"
                      value="1"
                      id="openStoreTrue"
                      v-model="store_status_true"
                      {{-- :value="true" --}}
                    />
                    <label class="custom-control-label" for="openStoreTrue"
                      >Iya, boleh</label
                    >
                  </div>
                  <div
                    class="custom-control custom-radio custom-control-inline"
                  >
                    <input
                      class="custom-control-input"
                      type="radio"
                      name="store_status"
                      value="0"
                      id="openStoreFalse"
                      v-model="store_status_false"
                      {{-- :value="false" --}}
                    />
                    <label
                      makasih
                      class="custom-control-label"
                      for="openStoreFalse" 
                      >Enggak, makasih</label
                    >
                  </div>
                </div>
                <div class="form-group" v-if="store_status_true">
                  <label>Nama Toko</label>
                  <small class="text-danger">*kosongkan jika tidak ingin dipilih</small>
                  <input
                    type="text"
                    class="form-control"
                    aria-describedby="storeHelp"
                    name="store_name"
                  />
                </div>
                <div class="form-group" v-if="store_status_true">
                  <label>Kategori</label>
                  <small class="text-danger">*kosongkan jika tidak ingin dipilih</small>
                  <select name="categories_id" class="form-control">
                    <option value=""></option>
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>
                <button type="submit" class="btn btn-success btn-block mt-4">
                  Sign Up Now
                </button>
              </form>
              <a href="{{ route('login') }}" class="btn btn-signup btn-block mt-2">
                Back to Sign In
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@push('addon-script')
      <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script>
      Vue.use(Toasted);

      var register = new Vue({
        el: "#register",
        mounted() {
          AOS.init();
          this.$toasted.error(
            "Maaf, tampaknya email sudah terdaftar pada sistem kami.",
            {
              position: "top-center",
              className: "rounded",
              duration: 1000,
            }
          );
        },
        data: {
          // name: "Angga Hazza Sett",
          // email: "kamujagoan@bwa.id",
          // password: "",
          // store_status: true,
          // store_status_true: true,
          // store_status_false: false,
          store_name: "",
        },
      });
    </script>
@endpush