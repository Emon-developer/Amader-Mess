<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$mess=auth()->user()->mess;
    	$settings=array();
    	foreach (days() as $key => $day) {
    		$meals=\App\Models\MessSettings::where('days','LIKE','%'.$day.'%')->where(['status'=>1,'mess_id'=>$mess->id])->get();
    		$array=array();
    		if(isset($meals[0])){
    			foreach ($meals as $key => $meal) {
    				array_push($array,$meal->name);
    			}
    			$settings[$day]=$array;
    		}
    	}
        $users = \App\User::where('status', 1)->get();
        return view('mess.index',compact('mess','settings', 'users'));
    }

    public function myself()
    {
        return view('mess.myself');
    }

    public function myselfSubmit(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string'],
        ]);

            
        $user=\App\User::find(auth()->user()->id);
        $user->fill($request->all());
        $user->save();
        session()->flash('success','Information has been updated');
        return redirect()->back();
    }

    public function image()
    {
        return view('mess.image');
    }

    public function imageSubmit(Request $request)
    {
        $this->validate($request, [
            'file' => ['required', 'file'],
        ]);

        $user=\App\User::find(auth()->user()->id);

        $fileInfo=fileInfo($request->file);
        if(in_array($fileInfo['type'],eligibleMimes())){
            $image=$user->id.'-'.date('YmdHis').'-'.rand().'-'.rand().'.'.$fileInfo['extension'];
            $upload=fileUpload($request->file,'member-images',$image);
            if($upload){
                if(!empty($user->image) && file_exists(public_path('member-images/'.$user->image))){
                    fileDelete('member-images/'.$user->image);
                }
                $user->image=$image;
                $user->save();
                session()->flash('success','Image has been uploaded');
            }else{
                session('danger','Whoops! Something went wrong!');
            }
        }else{
            session('danger','Please upload a valid image');
        }
        
        
        return redirect()->back();
    }

    public function changePassword()
    {
        return view('mess.changePassword');
    }

    public function changePasswordSubmit(Request $request)
    {
        $this->validate($request, [
            'current_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if(\Hash::check($request->current_password,auth()->user()->password)){
            
            $user=\App\User::find(auth()->user()->id);
            $user->password=bcrypt($request->password);
            $user->save();
            
            session()->flash('success','Password has been changed');
            return redirect('/');
        }

        session()->flash('danger','Current Password doesnot matched');
        return redirect()->back();
    }
}
