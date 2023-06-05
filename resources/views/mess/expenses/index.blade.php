@extends('mess.layouts.index')
@section('content')
<div class="card" style="margin-bottom: 25px;">
    <div class="card-header bg-info text-white" style="cursor: pointer;">
        Expenses
        <a class="btn btn-success btn-sm" style="float: right" onclick="Show('New Expenses','{{ url('expenses/create') }}')"><i class=" fa fa-plus"></i>&nbsp;New Expenses</a>
    </div>
    <div class="card-body table-responsive">
        <div class="row">
            <div class="col-md-{{ Auth::user()->priority==1 ? '2' : '3' }}">
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="start_date"><strong>Date from :</strong></label>
                    <input type="text" name="start_date" id="start_date" class="form-control" value="{{ $start_date }}" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" im-insert="false">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="end_date"><strong>To :</strong></label>
                    <input type="text" name="end_date" id="end_date" class="form-control" value="{{ $end_date }}" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" im-insert="false">
                </div>
            </div>
            @if(Auth::user()->priority==1)
            <div class="col-md-2">
                <div class="form-group">
                    <label for="user_id"><strong>Member :</strong></label>
                    <select name="user_id" id="user_id" class="form-control select2bs4">
                        <option value="0" {{ $user_id==0 ? 'selected' : '' }}>All Members</option>
                        @if(isset(Auth::user()->mess->users[0]))
                        @foreach(Auth::user()->mess->users->where('status',1) as $key => $member)
                        <option value="{{ $member->id }}" {{ $user_id==$member->id ? 'selected' : '' }}>{{ $member->name }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
            @endif
            <div class="col-md-2">
                <a class="btn btn-primary text-white btn-block" onclick="searchExpenses()" style="margin-top: 32px;"><i class="fa fa-search"></i>&nbsp;Search</a>
            </div>
        </div>
        <table class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th style="width: 5%">SL</th>
                    @if(Auth::user()->priority==1)
                    <th>Member</th>
                    @endif
                    <th>Date</th>
                    <th>Day</th>
                    <th>Total Items</th>
                    <th>Total Expenses</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @if(isset($expenses[0]))
            @foreach($expenses as $key => $expense)
                <tr id="tr-{{ $expense->id }}">
                    <td>{{ $key + 1 }}</td>
                    @if(Auth::user()->priority==1)
                    <td>{{ $expense->user->name }}</td>
                    @endif
                    <td>{{ $expense->date }}</td>
                    <td>{{ date('l',strtotime($expense->date)) }}</td>
                    <td>{{ count(json_decode($expense->details)) }}</td>
                    <td>{{ $expense->expenses }}</td>
                    <td class="text-center">
                        <a onclick="Show('Items','{{ url('expenses/'.$expense->id.'/view') }}')" class="btn btn-primary text-white"><i class="fa fa-eye"></i></a>
                        <a onclick="Show('Edit Expenses Items','{{ url('expenses/'.$expense->id.'/edit') }}')" class="btn btn-info text-white"><i class="fa fa-edit"></i></a>
                        <a onclick="Delete('{{ $expense->id }}','{{ url('expenses') }}')" class="btn btn-danger text-white"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    function searchExpenses() {
        var priority="{{ Auth::user()->priority }}";
        if(priority=="1"){
            var user_id=$('#user_id').val();
        }else{
            var user_id="{{ Auth::user()->id }}";
        }

        window.open("{{ url('expenses') }}/"+($('#start_date').val())+"&"+($('#end_date').val())+"&"+(user_id),"_parent");
    }
</script>
@endsection
