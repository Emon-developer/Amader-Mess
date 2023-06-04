<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonthlyCalculationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return $this->show(date('Y').'&'.date('m'));
    }

    public function show($data)
    {
        $year=explode('&',$data)[0] ? explode('&',$data)[0] : date('Y');
        $month=explode('&',$data)[1] ? explode('&',$data)[1] : date('m');

        $yearMonth=date('Y-m',strtotime($year.'-'.$month));
        
        $calculation=array();
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

                if($expenses > 0 || $meals > 0){
                    array_push($calculation, array(
                        'user' => $user,
                        'expenses' => $expenses,
                        'meals' => $meals,
                    ));
                }

                $total_expenses+=$expenses;
                $total_meals+=$meals;

            }
        }

        $meal_rate=0;
        if($total_expenses>0 && $total_meals){
            $meal_rate=number_format((float)$total_expenses/$total_meals, 2, '.', '');
        }

        return view('mess.monthlyCalculation.index',compact('year','month','calculation','total_expenses','total_meals','meal_rate'));
    }
}
