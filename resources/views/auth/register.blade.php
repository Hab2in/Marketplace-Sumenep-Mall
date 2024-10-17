@extends('layouts.auth')

@push('prepend-script')
<!-- Tambahkan di dalam <head> pada layout utama atau di blade yang relevan -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endpush

@section('content')
  <div class="page-content page-auth" id="register">
    <div class="section-store-auth" data-aos="fade-up">
      <div class="container">
        <div class="row align-items-center justify-content-center row-login">
          <div class="col-lg-4">
            <h2>
              Memulai untuk jual beli <br />
              dengan cara terbaru
            </h2>
            <form method="POST" action="{{ route('register') }}" class="mt-3">
              @csrf
              <div class="form-group">
                <label>Full Name</label>
                <input id="name" 
                  v-model="name" 
                  type="text" 
                  class="form-control @error('name') is-invalid @enderror" 
                  name="name" 
                  value="{{ old('name') }}" 
                  required 
                  autocomplete="name" 
                  autofocus>
                @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label>Email Address</label>
                <input id="email"
                  v-model="email"
                  @change="checkForEmailAvailability()"
                  type="email" 
                  class="form-control @error('email') is-invalid @enderror" 
                  :class="{ 'is-invalid': this.email_unavailable }"
                  name="email" 
                  value="{{ old('email') }}" 
                  required 
                  autocomplete="email">
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label>Password</label>
                <div class="input-group">
                  <input id="password" 
                    type="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    name="password" 
                    required 
                    autocomplete="new-password">
                  <div class="input-group-append">
                    <span class="input-group-text" id="togglePassword">
                        <i class="fa fa-eye"></i>
                    </span>
                  </div>
                </div>
                @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label>Konfirmasi Password</label>
                <div class="input-group">
                  <input id="password_confirm" 
                    type="password" 
                    class="form-control @error('password_confirmation') is-invalid @enderror" 
                    name="password_confirmation" 
                    required 
                    autocomplete="new-password">
                  <div class="input-group-append">
                    <span class="input-group-text" id="togglePasswordConfirm">
                      <i class="fa fa-eye"></i>
                    </span>
                  </div>
                </div>
                @error('password_confirmation')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label>Store</label>
                <p class="text-muted">
                  Apakah anda juga ingin membuka toko?
                </p>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" name="is_store_open" id="openStoreTrue"
                    v-model="is_store_open" :value="true">
                  <label for="openStoreTrue" class="custom-control-label">
                    Iya, boleh
                  </label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" name="is_store_open" id="openStoreFalse"
                    v-model="is_store_open" :value="false">
                  <label for="openStoreFalse" class="custom-control-label">
                    Enggak, makasih
                  </label>
                </div>
              </div>
              <div class="form-group" v-if="is_store_open">
                <label>Nama Toko</label>
                <input 
                  v-model="store_name"
                  id="store_name" 
                  type="text" 
                  class="form-control @error('store_name') is-invalid @enderror" 
                  name="store_name" 
                  value="{{ old('store_name') }}" 
                  required 
                  autocomplete="store_name" 
                  autofocus>
                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>ation
                  </span>
                @enderror
              </div>
              <div class="form-group" v-if="is_store_open">
                <label>Kategori</label>
                <select name="categories_id" class="form-control">
                  <option value="" disabled>Select Category</option>
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group" v-if="is_store_open">
                <label> Sub Kategori</label>
                <select name="" class="form-control">
                  <option value="" disabled>Select Category</option>
                  @foreach ($categories as $category)
                    <option value="">{{ $category->name }}</option>
                  @endforeach
                </select>
              </div>
              
              <!-- <div class="form-group" v-if="is_store_open">
                <label>Sub Kategori</label>
                <select name="categories_id" class="form-control">
                  <option value="" disabled>Baby</option>
                  <option value="" disabled>Furniture</option>
                  <option value="" disabled>Skincare</option>
                  <option value="" disabled>Fashion</option>
                  <option value="" disabled>Technology</option>
                  <option value="" disabled>Tools</option>
                  <option value="" disabled>Lainnya</option> 
                </select>
              </div> -->
              <a href="{{ route('register') }}">
                  Reset
              </a>
              <button
                type="submit"
                class="btn btn-success btn-block mt-4"
                :disabled="this.email_unavailable"
              >
                Sign Up Now
              </button>
              <a href="{{ route('login') }}" class="btn btn-signup btn-block mt-2">
                Back to Sign In
              </a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('addon-script')
  <script src="/vendor/vue/vue.js"></script>
  <script src="https://unpkg.com/vue-toasted"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script>
    Vue.use(Toasted);

    var register = new Vue({
      el: "#register",
      mounted() {
        AOS.init();
        // this.$toasted.error(
        //   "Maaf, tampaknya email sudah terdaftar pada sistem kami.",
        //   {
        //     position: "top-center",
        //     classname: "rounded",
        //     duration: 1000
        //   }
        // );
      },
      methods: {
        checkForEmailAvailability: function () {
          var self = this;
          axios.get('{{ route('api-register-check') }}', {
            params: {
              email: this.email
            }
          })
            .then(function (response) {
              if(response.data == 'Available') {
                self.$toasted.show(
                  "Email anda tersedia! Silahkan lanjut langkah selanjutnya!", {
                    position: "top-center",
                    className: "rounded",
                    duration: 1000,
                  }
                );
                self.email_unavailable = false;
              } else {
                self.$toasted.error(
                  "Maaf, tampaknya email sudah terdaftar pada sistem kami.", {
                    position: "top-center",
                    className: "rounded",
                    duration: 1000,
                  }
                );
                self.email_unavailable = true;
              }
              // handle success
              console.log(response.data);
            });
        }
      },
      data() {
        return {
          name: "",
          email: "",
          is_store_open: true,
          store_name: "",
          email_unavailable: false
        }
      },
    });
  </script>
  <script src="/script/navbar-scroll.js"></script>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
      const togglePassword = document.getElementById('togglePassword');
      const passwordField = document.getElementById('password');
      const eyeIcon = togglePassword.querySelector('i');
      
      togglePassword.addEventListener('click', function() {
          if (passwordField.type === 'password') {
              passwordField.type = 'text';
              eyeIcon.classList.remove('fa-eye');
              eyeIcon.classList.add('fa-eye-slash');
          } else {
              passwordField.type = 'password';
              eyeIcon.classList.remove('fa-eye-slash');
              eyeIcon.classList.add('fa-eye');
          }
      });

      const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
      const passwordConfirmField = document.getElementById('password_confirm');
      const eyeIconConfirm = togglePasswordConfirm.querySelector('i');
      
      togglePasswordConfirm.addEventListener('click', function() {
          if (passwordConfirmField.type === 'password') {
              passwordConfirmField.type = 'text';
              eyeIconConfirm.classList.remove('fa-eye');
              eyeIconConfirm.classList.add('fa-eye-slash');
          } else {
              passwordConfirmField.type = 'password';
              eyeIconConfirm.classList.remove('fa-eye-slash');
              eyeIconConfirm.classList.add('fa-eye');
          }
      });
  });
  </script>
@endpush

