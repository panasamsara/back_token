<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Roles;
use App\Api;


class RoleController extends Controller
{
    public function index(Request $request){
    	// $keywords = $request->get('keyword');
    	// if($keywords){
    	// 	$articles = Roles::where('title', 'like', '%'.$keywords.'%')->paginate(5);
    	// }else{
    		$roles = Roles::paginate(5);
    	// }
        
        return Api::result($roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Roles::create($request->all());
       if ($role) {
           return Api::result(null, "添加成功.");
       }
       return Api::result(null, "添加失败.");
    }


      /**
     * Show the one resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Roles::findOrFail($id);
        $role ->update();
        return Api::result($role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data['role_name'] = $request->title;
        $data['role_level'] = $request->input('content');
        $res = Roles::where('id', $id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Roles::destroy($id);
      return Api::result(null, '删除成功.');
    }
}
