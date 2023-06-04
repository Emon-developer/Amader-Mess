<?php

namespace App\Http\Controllers;

use \App\Models\Meals;
use Illuminate\Http\Request;

class MealsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return $this->show(date('Y').'&'.date('m'));
    }

    public function create()
    {
        $settings=auth()->user()->mess->settings;
        return view('mess.meals.create',compact('settings'));
    }

    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'date' => ['required', 'string', 'max:255'],
        // ]);

        // $meals=0;
        // $details=array();
        // if(is_array($request->meals) && count($request->meals)){
        //     foreach ($request->meals as $key => $meal) {
        //         $meals+=$meal;
        //         array_push($details, array(
        //             'meal_id' => $key,
        //             'meals' => $meal,
        //         ));
        //     }
        // }

        // $meal=Meals::create([
        //     'user_id' => $request->user_id ? $request->user_id : auth()->user()->id,
        //     'date' => $request->date,
        //     'details' => json_encode($details),
        //     'meals' => $meals,
        // ]);
        
        // success('Meals Saved Successfully');
        // return redirect()->back();
    }

    public function show($data)
    {
        $year=explode('&',$data)[0] ? explode('&',$data)[0] : date('Y');
        $month=explode('&',$data)[1] ? explode('&',$data)[1] : date('m');

        $meals=Meals::where('status',1)
            ->whereHas('user',function($query){
                return $query->where('mess_id',auth()->user()->mess_id);
            })
            ->when(auth()->user()->priority==0,function($query){
                return $query->where('user_id',auth()->user()->id);
            })
            ->where(\DB::raw('substr(`date`, 1, 7)'), $year.'-'.$month)
            ->get();

        $users = \App\User::where('mess_id',auth()->user()->mess_id)
                ->where('status',1)
                ->when(auth()->user()->priority==0,function($query){
                    return $query->where('id',auth()->user()->id);
                })
                ->get();
        return view('mess.meals.index',compact('year','month','users'));
    }

    public function edit($data)
    {
        $user_id = explode('&',$data)[0] ? explode('&',$data)[0] : auth()->user()->id;
        $year = explode('&',$data)[1] ? explode('&',$data)[1] : date('Y');
        $month = explode('&',$data)[2] ? explode('&',$data)[2] : date('m');
        $dateRange = dateRange(date('Y-m-d', strtotime($year.'-'.$month)), date('Y-m-t', strtotime($year.'-'.$month)));

        $user = \App\User::where('id', $user_id)
                ->where('mess_id',auth()->user()->mess_id)
                ->when(auth()->user()->priority==0,function($query){
                    return $query->where('id',auth()->user()->id);
                })
                ->first();
        if(!isset($user->id)){
            return redirect('meals');
        }

        return view('mess.meals.edit',compact('user_id','year','month','dateRange','user'));
    }

    public function update(Request $request, $user_id)
    {
        $user = \App\User::where('id', $user_id)
                ->where('mess_id',auth()->user()->mess_id)
                ->when(auth()->user()->priority == 0,function($query){
                    return $query->where('id',auth()->user()->id);
                })
                ->first();
        if(!isset($user->id)){
            return redirect('meals');
        }

        $dateRange = dateRange(date('Y-m-d', strtotime($request->year.'-'.$request->month)), date('Y-m-t', strtotime($request->year.'-'.$request->month)));
        if(isset($dateRange[0])){
            foreach($dateRange as $key => $date){
                $meals = 0;
                $details = [];
                if(is_array($request->meals[$date]) && count($request->meals[$date])){
                    foreach ($request->meals[$date] as $key => $m) {
                        $meals+=$m;
                        array_push($details, array(
                            'meal_id' => $key,
                            'meals' => $m,
                        ));
                    }
                }

                $meal = Meals::where(['user_id' => $user->id, 'date' => $date])->first();
                if(!isset($meal->id)){
                    $meal = Meals::create(['user_id' => $user->id, 'date' => $date]);
                }

                $meal->details = json_encode($details);
                $meal->meals = $meals;
                $meal->save();
            }
        }
        
        success('Meals Updated Successfully');
        return redirect()->back();
    }

    public function destroy(Meals $meal)
    {
        $meal->delete();
        if($meal){
            return response()->json([
                'success' => true
            ]);
        }

        return response()->json([
            'success' => false
        ]);
    }
}
