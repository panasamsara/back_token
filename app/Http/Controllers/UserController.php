<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Api;
use App\Models\Admin;

class UserController extends Controller
{
    public function index(Request $request){
    	$keywords = $request->get('keyword');
    	if($keywords){
    		$users = Admin::where('title', 'like', '%'.$keywords.'%')->paginate(5);
    	}else{
    		$users = Admin::paginate(5);
    	}
        
        return Api::result($users);
    }
}
