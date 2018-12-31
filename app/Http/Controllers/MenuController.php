<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menus;
use App\Api;


class MenuController extends Controller
{
    public function index(Request $request){
    	$menus = Menus::where('parent_code','00')->get();	
    	// var_dump($menus);die();	
    	foreach($menus as $menu){
    		$menuBeans = Menus::where('parent_code',$menu->code)->get();
    		if(count($menuBeans)!=0 ){
    			$menu->menuBeans = $menuBeans;
    		}
		  
		}
        return Api::result($menus);
    }
}
