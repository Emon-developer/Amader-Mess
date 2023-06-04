@extends('auth.index')

@section('title')
Join Amader Mess
@endsection

@section('content')
<div class="col-md-2">
</div>
<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <h4><strong>Join Amamder Mess</strong></h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6" style="padding-left: 25px;padding-right: 25px;">
                        <div class="form-group row">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="username">Username</label>
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">

                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="col-md-6" style="padding-left: 25px;padding-right: 25px;">
                        <div class="form-group row">
                            <label for="mess_name">Mess Name</label>
                            <input id="mess_name" type="text" class="form-control @error('mess_name') is-invalid @enderror" name="mess_name" value="{{ old('mess_name') }}" required autocomplete="mess_name" autofocus>

                            @error('mess_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="mess_from">Mess Started from</label>
                            <input type="text" class="form-control" id="mess_from" @error('mess_from') is-invalid @enderror name="mess_from" value="{{ old('mess_from') }}" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" im-insert="false">

                            @error('mess_from')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="mess_address">Mess Address</label>
                            <textarea id="mess_address" class="form-control @error('mess_address') is-invalid @enderror" name="mess_address" required autocomplete="new-mess_address" style="height: 125px;resize:none"></textarea>

                            @error('mess_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                

                <div class="form-group row mb-0">
                    <div class="col-md-4 offset-md-4">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
              <hr>

              <p class="mb-1">
                @if (Route::has('login'))
                    <a class="btn btn-link" style="padding: .375rem 0rem !important;float: right" href="{{ route('login') }}">
                        Login to Amader Mess
                    </a>
                @endif
              </p>
            </form>
        </div>
    </div>
</div>
@endsection
