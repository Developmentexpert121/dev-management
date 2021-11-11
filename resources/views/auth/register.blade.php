@extends('layouts.app')

@section('content')

<section class="create-form">
    

<div class="container">
    <div class="row ">
      <div class="col-md-6">
        <div class="create-content">
            <h2>WELCOME<span> TO </span>Dev Management Tool</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.cilisis. </p>
            <img src="../../../images/auth/create-banner.png">
        </div>
       </div>  
        <div class="col-md-6">
            <div class="card create-card">
                <!-- <div class="card-header">{{ __('Register') }}</div> -->


                <div class="card-body"> 
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">

                        @csrf
                        <div class="create-head">
                            <h4>Create Account</h4>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="Role" class="col-md-4 col-form-label text-md-right">{{ __('User Role') }}</label>

                            <div class="col-md-6">
                                
                                <select name="user_role" id="cars" class="form-control" name="user_role" required>
                                <option value="">Please Select Role</option>
                                <option value="1" <?php if(old('user_role') == '1'){ echo 'selected'; } ?>>Team Leader</option>
                                <option value="2" <?php if(old('user_role') == '2'){ echo 'selected'; } ?>>Employee</option>
                                <option value="3" <?php if(old('user_role') == '3'){ echo 'selected'; } ?>>Manager</option>
                                <option value="4" <?php if(old('user_role') == '4'){ echo 'selected'; } ?> >Hr</option>
                                </select>


                                @error('user_role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>
                        


                      <!--  <div class="form-group row">
                            <label for="Role" class="col-md-4 col-form-label text-md-right">{{ __('User Role') }}</label>

                            <div class="col-md-6">
                                
                            <input type="file" name="image" >
                            @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                            </div>
                        </div>-->
                        


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
