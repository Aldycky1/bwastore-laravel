@extends('layouts.auth')

@section('content')
     <!-- Page Content -->
    <div class="page-content page-auth" id="register">
        <div class="section-store-auth">
            <div class="container">
                <div class="row align-items-center justify-content-center row-login">
                    <div class="col-lg-4">
                        <h2>
                            Memulai untuk jual beli <br />
                            dengan cara terbaru
                        </h2>
                        <form action="{{ route('register') }}" method="POST" class="mt-3">
                            @csrf
                            <div class="form-group">
                                <label>Full Name</label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    aria-describedby="nameHelp"
                                    value="{{ old('name') }}"
                                    required
                                    autofocus 
                                />
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>    
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input
                                    type="email"
                                    id="email" 
                                    name="email"
                                    @change="checkForEmailAvailability()"
                                    class="form-control  @error('email') is-invalid @enderror"
                                    :class="{ 'is-invalid' : this.email_unavailable }"
                                    aria-describedby="emailHelp"
                                    value="{{ old('email') }}"
                                    required 
                                    autocomplete="email" 
                                />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>    
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password <span class="text-danger">(minimal 8 karakter)</span></label>
                                <input 
                                    type="password" 
                                    id="password"  
                                    name="password" 
                                    required 
                                    autocomplete="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    value="{{ old('password') }}"
                                    :disabled="this.email_unavailable"
                                />
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>      
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi Password</label>
                                <input 
                                    type="password" 
                                    id="password_confirmation" 
                                    name="password_confirmation"
                                    autocomplete="new-password" 
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    value="{{ old('password_confirmation') }}"
                                    :disabled="this.email_unavailable"
                                />
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
                                    <input
                                        class="custom-control-input"
                                        type="radio"
                                        name="is_store_open"
                                        id="openStoreTrue"
                                        v-model="is_store_open"
                                        :value="true"
                                        value="{{ old('is_store_open') }}"
                                        :disabled="this.email_unavailable"
                                    />
                                    <label class="custom-control-label" for="openStoreTrue">
                                        Iya, boleh
                                    </label>                                    
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input
                                        class="custom-control-input"
                                        type="radio"
                                        name="is_store_open"
                                        id="openStoreFalse"
                                        v-model="is_store_open"
                                        :value="false"
                                        value="{{ old('is_store_open') }}"
                                        :disabled="this.email_unavailable"
                                    />
                                    <label class="custom-control-label" for="openStoreFalse">
                                        Enggak, makasih
                                    </label>
                                </div>
                                <div class="form-group d-none" v-if="is_store_open">
                                    <input                                                                                                                
                                        name="store_status"
                                        type="hidden"
                                        value="1" 
                                    />
                                </div>
                                <div class="form-group d-none" v-if="is_store_open === false">
                                    <input                                                                                                                
                                        name="store_status"
                                        type="hidden"
                                        value="0" 
                                    />
                                </div>
                            </div>
                            <div class="form-group" v-if="is_store_open">
                                <label>Nama Toko</label>
                                <input
                                    id="store_name"
                                    name="store_name"
                                    type="text"
                                    class="form-control @error('store_name') is-invalid @enderror"
                                    value="{{ old('store_name') }}"
                                    autofocus
                                    autocomplete
                                    aria-describedby="storeHelp"
                                    :disabled="this.email_unavailable"
                                />
                                @error('store_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> 
                                @enderror
                            </div>
                            <div class="form-group" v-if="is_store_open">
                                <label>Kategori</label>
                                <select name="categories_id" class="form-control" :disabled="this.email_unavailable">
                                    <option value="" disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" :disabled="this.email_unavailable" class="btn btn-success btn-block mt-4">
                                Sign Up Now
                            </button>
                            <a href="{{ route('login') }}"  class="btn btn-signup btn-block mt-2">
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
            },
            methods: {
                checkForEmailAvailability: function(){
                var self = this;
                axios.get('{{ route('api-register-check') }}', {
                    params: {
                    email: self.email
                    }
                })
                        .then(function (response) {
                            // Handle Success
                            if(response.data == "Available"){
                                self.$toasted.show(
                                    "Email anda tersedia! Silahkan lanjut ke langkah selanjutnya!",
                                    {
                                        position: "top-center",
                                        className: "rounded",
                                        duration: 1000,
                                    }
                                );
                                self.email_unavailable = false;
                            } else{
                                self.$toasted.error(
                                    "Maaf, tampaknya email sudah terdaftar pada sistem kami.",
                                    {
                                        position: "top-center",
                                        className: "rounded",
                                        duration: 1000,
                                    }
                                );
                                self.email_unavailable = true;
                            }
                        console.log(response);
                    })
                }
            },
            data() {
                return{
                    name: "",
                    email: "",
                    is_store_open: true,
                    store_name: "",
                    email_unavailable:false
                }
            },
        });
    </script>
@endpush