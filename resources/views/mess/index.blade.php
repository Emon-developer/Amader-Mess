@extends('mess.layouts.index')
@section('content')
<style type="text/css" media="screen">
    .description-header{
        margin-bottom:15px !important;
        font-weight: bold !important;
    }
</style>
<div class="row">
  <div class="col-md-6">
    <!-- Widget: user widget style 2 -->
    <div class="card card-widget widget-user">
      <div class="widget-user-header bg-info">
        <h3 class="widget-user-username">{{ $mess->name }}</h3>
        <h5 class="widget-user-desc">
          {{ $mess->address }}  | {{ $mess->users->where('status', 1)->count() }} members
        </h5>
      </div>
      <div class="widget-user-image">
        <img class="img-circle elevation-2" src="{{ url('public/icon.jpg') }}" alt="User Avatar">
      </div>
      <div class="card-footer p-0">
        <ul class="nav flex-column">
            @if(isset($settings) && is_array($settings))
            @foreach($settings as $key => $setting)
              <li class="nav-item">
                <a class="nav-link">
                  {{ $key }} 
                  @if(isset($setting[0]))
                  @foreach($setting as $key => $meal)
                    <span class="float-right badge bg-success"style="margin: 0px 5px">{{ $meal }}</span>
                  @endforeach
                  @endif
                </a>
              </li>
            @endforeach
            @endif
        </ul>
      </div>
    </div>
    <!-- /.widget-user -->
  </div>
  <!-- /.col -->
  <div class="col-md-6">
    <!-- Widget: user widget style 1 -->
    <div class="card card-widget widget-user">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-info">
        <h3 class="widget-user-username">{{ Auth::user()->name }}</h3>
        <h5 class="widget-user-desc">{{ Auth::user()->profession }}</h5>
      </div>
      <div class="widget-user-image">
        <img class="img-circle elevation-2" src="{{ memberImage(Auth::user()->id) }}" style="height: 90px" alt="User Avatar">
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header"><small><strong>{{ getDateDiff(Auth::user()->created_at) }}</strong></small></h5>
              <span class="description-text">Member Since</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">{{ Auth::user()->expenses->sum('expenses') }}</h5>
              <span class="description-text">Total Expenses</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-4">
            <div class="description-block">
              <h5 class="description-header">{{ Auth::user()->meals->sum('meals') }}</h5>
              <span class="description-text">Total Meals</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
        </div>
        <hr style="margin-top: 2rem !important;margin-bottom: 2rem !important;">
        <div class="row">
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">{{ mealrate(date('Y'),date('m')) }}</h5>
              <span class="description-text">{{ date('F') }}'s Meal Rate</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">{{ Auth::user()->expenses->whereBetween('date',[date('Y-m-01'),date('Y-m-t')])->sum('expenses') }}</h5>
              <span class="description-text">{{ date('F') }}'s Expenses</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-4">
            <div class="description-block">
              <h5 class="description-header">{{ Auth::user()->meals->whereBetween('date',[date('Y-m-01'),date('Y-m-t')])->sum('meals') }}</h5>
              <span class="description-text">{{ date('F') }}'s  Meals</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    </div>
    <!-- /.widget-user -->
  </div>
</div>

<div class="row d-flex align-items-stretch">
@if(isset($users[0]))
@foreach($users as $key => $member)
  <div class="col-12 col-sm-6 col-md-4">
    <div class="card bg-light">
      <div class="card-body pt-3">
        <div class="row">
          <div class="col-md-8">
            <h4><b>{{ $member->name }}</b></h4>
            <p class="text-muted text-sm">
              <b>Profession : </b> {{ $member->profession }}
              <br>
              <b>Date of Birth : </b> {{ $member->dob }}
              <br>
              <b>Age : </b> {{ getDateDiff($member->dob) }}
              <br> 
              <b>Member from : </b> {{ strtotime($member->from) ? date('F j,Y',strtotime($member->from)) : '' }}
            </p>
          </div>
          <div class="col-md-4 text-center">
            <img src="{{ memberImage($member->id) }}" style="width: 100%;max-height: 135px;" alt="" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
  </div>
@endforeach
@endif
</div>


@endsection
