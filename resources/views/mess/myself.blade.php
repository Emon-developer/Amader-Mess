@extends('mess.layouts.index')
@section('content')
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="card" style="margin-bottom: 25px;">
            <div class="card-header bg-info text-white" style="cursor: pointer;">
                My Information
            </div>
            <div class="card-body" style="padding: 30px">
                <form method="POST" action="{{ url('myself') }}">
                    @csrf
                    
                        <div class="form-group row">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required autocomplete="name">
                        </div>
                        
                        <div class="form-group row">
                            <label for="profession">{{ __('Profession') }}</label>
                            <input id="profession" type="text" class="form-control" name="profession" value="{{ Auth::user()->profession }}" required autocomplete="profession">
                        </div>

                        <div class="form-group row">
                            <label for="dob">{{ __('Date of Birth') }}</label>
                            <input type="text" name="dob" id="dob" class="form-control" value="{{ Auth::user()->dob }}" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" im-insert="false">
                        </div>

                        <div class="form-group row">
                            <label for="from">{{ __('Member from') }}</label>
                            <input type="text" name="from" id="from" class="form-control" value="{{ Auth::user()->from }}" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" im-insert="false">
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Update My Information
                                </button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection