<?php

use App\Http\Controllers\ProfileController;
use App\Models\link;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

Route::get('/', function () {
    $link=link::all();
    return view ('welcome',compact('link'));
});

Route::post('/',function(Request $request){
 $rules= array(
 'link'=>'required|url'
 );

 $validation=Validator::make($request->all(),$rules);
 if( $validation->fails()){
    return  Redirect::to('/')->withErrors($validation);
 }
 else{
    $link=link::where('url',$request->input('link'))->first();
    if($link){
        //hash means short url
        return Redirect::to('/')->with('link',$link->hash);
    }
    else{
        do{
          $newHash=Str::random(6);
        } while(link::where('hash',$newHash)->count()>0);

        link::create(array(
            'url'=>$request->input('link'),
            'hash'=>$newHash
        ));

return Redirect::to('/')->with('link',$newHash);

    }
 }
});

Route::get('(hash)',function($hash){
$link=link::where('hash',$hash);

if($link){
    return  Redirect::to($link->url);
}else{
     return Redirect::to('/')->with('message','invalid link');
}
});


