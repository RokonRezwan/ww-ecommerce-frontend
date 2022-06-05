@extends('layouts.app')

@section('content')
<div class="container" id="onSubmitLoginForm">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <div class="row" v-cloak>
                        <div v-if="message.length" class="alert alert-danger text-center p-2" role="alert">
                            @{{ message }}
                        </div>
                    </div>

                    <form @submit.prevent="onSubmitLoginForm">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" v-model="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" v-model="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
    const { createApp } = Vue
    createApp({
    data() {
        return {
            email: '',
            password: '',
            message: '',
        }
    },
  methods:{
        async onSubmitLoginForm(){
            // validate user input data
            if(this.email === '' || this.password === ''){
                alert('Email or Password can\'t be Empty');
                return;
            }
           // send request to api server
            const url = 'http://127.0.0.1:8000/api/login'
            const data = {
                email: this.email,
                password: this.password,
            };
            await axios.post(url, data).then((response) => {
                if(response.data.isSuccessStatus == false){
                    this.message = response.data.message;
                    //console.log(response.data.message);
                }
                else{
                    localStorage.setItem("authToken", JSON.stringify(response.data.token));
                    localStorage.setItem("userData", JSON.stringify(response.data.user));
                    window.location.href="/";
                }
            }).catch((error) => {
                console.log('error axios request', error.data);
            });
        }
    }
    }).mount('#onSubmitLoginForm');
    
    if(localStorage.getItem('authToken') !== null)
    {
        document.getElementById("onSubmitLoginForm").style.display = "none";
        //console.log(localStorage.getItem('authToken'));
    }
</script>
    
@endsection
