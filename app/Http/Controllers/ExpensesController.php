<?php

namespace App\Http\Controllers;

use \App\Models\Expenses;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $start_date=date('Y-m-01');
        $end_date=date('Y-m-t');
        $user_id=0;
        $expenses=Expenses::where('status',1)
            ->when(Auth()->user()->priority==1,function($query){
                return $query->whereHas('user',function($query){
                    return $query->where('mess_id',Auth()->user()->mess_id);
                });
            })
            ->when(Auth()->user()->priority!=1,function($query){
                return $query->where('user_id',Auth()->user()->id);
            })
            ->where('date','>=',$start_date)
            ->where('date','<=',$end_date)
            ->get();
        return view('mess.expenses.index',compact('expenses','start_date','end_date','user_id'));
    }

    public function create()
    {
        return view('mess.expenses.create');
    }

    public function store(Request $request,Expenses $expenses)
    {
        $this->validate($request,[
            'date' => ['required', 'string', 'max:255'],
        ]);

        $proceed=false;
        if(isset($request->expenses_name[0])){
            if(!empty($request->expenses_name[0]) && $request->expenses_price[0] > 0){
                $proceed=true;
            }
        }

        if($proceed){
            $total=0;
            $details=array();

            foreach ($request->expenses_name as $key => $item) {
                if(!empty($item) && $request->expenses_price[$key] > 0){
                    array_push($details, array(
                        'name' => $item,
                        'quantity' => $request->expenses_quantity[$key],
                        'price' => (int)($request->expenses_price[$key]),
                    ));

                    $total+=(int)($request->expenses_price[$key]);
                }
            }


            $expenses->date = date('Y-m-d',strtotime($request->date));
            $expenses->user_id = $request->user_id ? $request->user_id : Auth()->user()->id;
            $expenses->expenses = $total;
            $expenses->details = json_encode($details);
            $expenses->save();
            if($expenses){
                success('Expenses Saved Successfully');
            }else{
                error();
            }
        }else{
            session()->flash('danger','Please add at least one item.');
        }
        
        return redirect()->back();
    }

    public function show($data)
    {
        $start_date=explode('&',$data)[0] ? explode('&',$data)[0] : date('Y-m-01');
        $end_date=explode('&',$data)[1] ? explode('&',$data)[1] : date('Y-m-t');
        $user_id=(isset(explode('&',$data)[2]) && explode('&',$data)[2]>=0)  ? explode('&',$data)[2] : Auth()->user()->id;

        $expenses=Expenses::where('status',1)
            ->when(Auth()->user()->priority==1,function($query) use($user_id){
                return $query->when($user_id==0,function($query){
                                return $query->whereHas('user',function($query){
                                    return $query->where('mess_id',Auth()->user()->mess_id);
                                });
                            })
                            ->when($user_id!=0,function($query) use($user_id){
                                return $query->where('user_id',$user_id)
                                            ->whereHas('user',function($query){
                                                return $query->where('mess_id',Auth()->user()->mess_id);
                                            });
                            });
            })
            ->when(Auth()->user()->priority==0,function($query){
                return $query->where('user_id',Auth()->user()->id);
            })
            ->where('date','>=',$start_date)
            ->where('date','<=',$end_date)
            ->get();
        return view('mess.expenses.index',compact('expenses','start_date','end_date','user_id'));
    }

    public function view($id)
    {
        $expense=Expenses::find($id);
        return view('mess.expenses.view',compact('expense'));
    }

    public function edit(Expenses $expense)
    {
        return view('mess.expenses.edit',compact('expense'));
    }

    public function update(Request $request, Expenses $expense)
    {
        $this->validate($request,[
            'date' => ['required', 'string', 'max:255'],
        ]);

        $proceed=false;
        if(isset($request->expenses_name[0])){
            if(!empty($request->expenses_name[0]) && $request->expenses_price[0] > 0){
                $proceed=true;
            }
        }

        if($proceed){
            $total=0;
            $details=array();

            foreach ($request->expenses_name as $key => $item) {
                if(!empty($item) && $request->expenses_price[$key] > 0){
                    array_push($details, array(
                        'name' => $item,
                        'quantity' => $request->expenses_quantity[$key],
                        'price' => (int)($request->expenses_price[$key]),
                    ));

                    $total+=(int)($request->expenses_price[$key]);
                }
            }


            $expense->date = date('Y-m-d',strtotime($request->date));
            $expense->expenses = $total;
            $expense->details = json_encode($details);
            $expense->save();
            if($expense){
                success('Expenses Updated Successfully');
            }else{
                error();
            }
        }else{
            session()->flash('danger','Please add at least one item.');
        }
        
        return redirect()->back();
    }

    public function destroy(Expenses $expense)
    {
        $expense->delete();
        if($expense){
            return response()->json([
                'success' => true
            ]);
        }

        return response()->json([
            'success' => false
        ]);
    }
}
