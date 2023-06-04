<h3 class="text-center">{{$user->name}} ({{date('F, Y', strtotime($year.'-'.$month))}})</h3>
<hr>
<form action="{{ route('meals.update',$user->id) }}" method="post" id="create-form">
@csrf
@method('PUT')
<input type="hidden" name="year" value="{{$year}}">
<input type="hidden" name="month" value="{{$month}}">

    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th>SL</th>
                <th>Date</th>
                <th>Day</th>
                @if(isset(auth()->user()->mess->settings[0]))
                @foreach(auth()->user()->mess->settings as $key => $meal)
                <th>{{ $meal->name }}</th>
                @endforeach
                @endif
            </tr>
        </thead>
        <tbody>
        @foreach ($dateRange as $key => $date)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{date('F j, Y', strtotime($date))}}</td>
                <td>{{date('l', strtotime($date))}}</td>
                @if(isset(auth()->user()->mess->settings[0]))
                @foreach(auth()->user()->mess->settings as $key => $meal)
                @php
                    $value = 0;
                    $this_day_meals = \App\Models\Meals::where('user_id', $user->id)->where('date', $date)->first();
                    if(isset($this_day_meals->id)){
                        $details = json_decode($this_day_meals->details, true);
                        if(isset($details[0])){
                            foreach($details as $key => $detail){
                                if($detail['meal_id'] == $meal->id){
                                    $value = $detail['meals'];
                                }
                            }
                        }
                    }
                @endphp
                    <td>
                        <input type="number" name="meals[{{ $date }}][{{ $meal->id }}]" value="{{$value}}" min="0" class="form-control">
                    </td>
                @endforeach
                @endif
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="{{auth()->user()->mess->settings->count()+3}}" class="text-center">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp; Update Meals</button>
                </td>
            </tr>
        </tfoot>
    </table>
</form>