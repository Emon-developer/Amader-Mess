<?php
function fileInfo($file){
    if(isset($file)){
        return $image = array(
            'name' => $file->getClientOriginalName(), 
            'type' => $file->getClientMimeType(), 
            'size' => $file->getClientSize(), 
            'width' => getimagesize($file)[0], 
            'height' => getimagesize($file)[1], 
            'extension' => $file->getClientOriginalExtension(), 
        );
    }else{
        return $image = array(
            'name' => '0', 
            'type' => '0', 
            'size' => '0', 
            'width' => '0', 
            'height' => '0', 
            'extension' => '0', 
        );
    }
    
}

function eligibleMimes()
{
    return array(
        'image/jpeg',
        'image/png',
    );
}

function fileUpload($file,$destination,$name){
    $upload=$file->move(public_path('/'.$destination), $name);
    return $upload;
}

function fileMove($oldPath,$newPath){
    $move = \File::move($oldPath, $newPath);
    return $move;
}

function fileDelete($path){
    if(file_exists(public_path('/'.$path))){
        $delete=unlink(public_path('/'.$path));
        return $delete;
    }
    return false;
}

function memberImage($user_id)
{
    $image=url('/public/male.png');
    $user=\App\User::find($user_id);
    if(isset($user->id)){
        if(!empty($user->image) && file_exists(public_path('member-images/'.$user->image))){
            $image=url('/public/member-images/'.$user->image);
        }
    }

    return $image;
}
