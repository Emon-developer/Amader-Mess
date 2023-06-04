<?php
function minutesDifference($from,$to)
{
    $start_date = new DateTime($from);
    $since_start = $start_date->diff(new DateTime($to));
    $minutes = $since_start->days * 24 * 60;
    $minutes += $since_start->h * 60;
    $minutes += $since_start->i;
    return $minutes;
}

function days()
{
	return array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
}

function getDateDiff($date){
    return \Carbon\Carbon::parse($date)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days');
}

function mealrate($year,$month)
{
	$yearMonth=date('Y-m',strtotime($year.'-'.$month));
    $total_expenses=0;
    $total_meals=0;
    if(isset(Auth()->user()->mess->users[0])){
        foreach (Auth()->user()->mess->users as $key => $user) {
            
            $expenses=\App\Models\Expenses::where('user_id',$user->id)
                                            ->where(\DB::raw('substr(date,1,7)'),$yearMonth)
                                            ->sum('expenses');
            $meals=\App\Models\Meals::where('user_id',$user->id)
                                            ->where(\DB::raw('substr(date,1,7)'),$yearMonth)
                                            ->sum('meals');

            $total_expenses+=$expenses;
            $total_meals+=$meals;

        }
    }

    $meal_rate=0;
    if($total_expenses>0 && $total_meals){
        $meal_rate=number_format((float)$total_expenses/$total_meals, 2, '.', '');
    }

    return $meal_rate;
}

function success($msg='Operation done successfylly')
{
	session()->flash('success',$msg);
}

function error($msg='Something went wrong!')
{
	session()->flash('error',$msg);
}

