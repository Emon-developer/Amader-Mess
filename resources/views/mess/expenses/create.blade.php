<form action="{{ route('expenses.store') }}" method="post" id="create-form">
@csrf
<div class="row">
  <div class="col-md-12" style="padding-left: 25px;padding-right: 25px;">
    @if(Auth::user()->priority==1)
        <div class="form-group row">
            <label for="user_id"><strong>Member :</strong></label>
            <select name="user_id" id="user_id" class="form-control select2bs4">
                @if(isset(Auth::user()->mess->users[0]))
                @foreach(Auth::user()->mess->users->where('status',1) as $key => $member)
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
        <label for="">Expenses</label>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="expenses_view">
                
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right">
                        <strong>Total Expenses  :</strong>
                    </td>
                    <td class="text-right" id="total_expenses" style="padding-right: 35px">
                        
                    </td>
                    <td>
                       
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="text-center">
                        <a class="btn btn-primary text-white" onclick="newItem()"><i class="fa fa-plus"></i>&nbsp; New Item</a>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="form-group row">
      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp; Save Expenses</button>
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
    newItem();

    function newItem() {
        $('#expenses_view').append('<tr>'+
                                        '<td></td>'+
                                        '<td><input type="text" name="expenses_name[]" value="" class="form-control" onchange="calculateTotal()" onkeyup="calculateTotal()"></td>'+
                                        '<td><input type="text" name="expenses_quantity[]" value="" class="form-control"></td>'+
                                        '<td><input type="number" name="expenses_price[]" min="0" class="form-control text-right expenses" onchange="calculateTotal()" onkeyup="calculateTotal()"></td>'+
                                        '<td><a class="btn btn-danger text-white" onclick="removeItem($(this))"><i class="fa fa-times"></i></a></td>'+
                                    '</tr>');
        maintainSerial();
    }

    function maintainSerial() {
        var count=0;
        $.each($('#expenses_view tr'), function(index, val) {
            count++;
            $(this).find("td:first").html(count);
        });
        $('#expenses_view').find("tr:first").find("td:nth-child(5)").html('');
        calculateTotal();
    }

    function removeItem(element) {
        var count=0;
        $.each($('#expenses_view tr'), function(index, val) {
            count++;
        });

        if(count>1){
            element.parent().parent().remove();
            maintainSerial();
        }
    }

    function calculateTotal() {
        var total=0;
        $.each($('.expenses'), function(index, val) {
            if($(this).val()!="" && $(this).parent().prev().prev().find('input').val()!=""){
             total+=parseInt($(this).val());
            }
        });
        $('#total_expenses').html(total);
    }
</script>