@extends('mess.layouts.index')
@section('content')
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
        <div class="card" style="margin-bottom: 25px;">
            <div class="card-header bg-info text-white" style="cursor: pointer;">
                Change Password
            </div>
            <div class="card-body" style="padding: 30px">
        		<form method="POST" action="{{ url('change-password') }}">
                    @csrf
        			
                        <div class="form-group row">
                            <label for="current_password">{{ __('Current Password') }}</label>
                            <input id="current_password" type="password" class="form-control" name="current_password" required autocomplete="current_password">
                        </div>

                        <div class="form-group row">
                            <label for="password">{{ __('New Password') }}</label>
                            <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Change Password
                                </button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
	</div>
</div>
@endsection