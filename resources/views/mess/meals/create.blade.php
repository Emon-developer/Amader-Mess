<form action="{{ route('meals.store') }}" method="post" id="create-form">
@csrf
<div class="row">
  <div class="col-md-12" style="padding-left: 25px;padding-right: 25px;">
    @if(Auth::user()->priority==1)
        <div class="form-group row">
            <label for="user_id"><strong>Member :</strong></label>
            <select name="user_id" id="user_id" class="form-control select2bs4">
                @if(isset(Auth::user()->mess->users[0]))
                @foreach(Auth::user()->mess->users as $key => $member)
                <option value="{{ $member->id }}" {{ Auth::user()->id==$member->id ? 'selected' : '' }}>{{ $member->name }}</option>
                @endforeach
                @endif
            </select>
        </div>
    @endif
    <div class="form-group row">
        <label for="date">Date</label>
        <input type="text" name="date" id="date" class="form-control" value="{{ date('Y-m-d') }}" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" im-insert="false">
    </div>
    <div class="form-group row">
        <label for="">Meals</label>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    @if(isset($settings[0]))
                    @foreach($settings as $key => $meal)
                    <th>{{ $meal->name }}</th>
                    @endforeach
                    @endif
                </tr>
            </thead>
            <tbody>
                <tr>
                    @if(isset($settings[0]))
                    @foreach($settings as $key => $meal)
                    <td>
                        <input type="number" name="meals[{{ $meal->id }}]" value="{{ $meal->meal }}" min="0" class="form-control">
                    </td>
                    @endforeach
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
    <div class="form-group row">
      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp; Save Meals</button>
    </div>
  </div>
</div>
</form>
<script type="text/javascript">
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
    $(function () {
        $('#date').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
        $('[data-mask]').inputmask();
    });
</script>