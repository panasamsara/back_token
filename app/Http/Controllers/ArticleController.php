<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articles;
use App\Api;

class ArticleController extends Controller
{
    public function index(Request $request){
    	$keywords = $request->get('keyword');
    	if($keywords){
    		$articles = Articles::where('title', 'like', '%'.$keywords.'%')->paginate(5);
    	}else{
    		$articles = Articles::paginate(5);
    	}
        
        return Api::result($articles);
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
        $article = Articles::create($request->all());
       if ($article) {
           return Api::result(null, "添加任务保存成功.");
       }
       return Api::result(null, "添加任务保存失败.");
    }


      /**
     * Show the one resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Articles::findOrFail($id);
        $article ->update();
        return Api::result($article);
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
        $data['title'] = $request->title;
        $data['content'] = $request->input('content');
        $res = Articles::where('id', $id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Articles::destroy($id);
      return Api::result(null, '删除成功.');
    }
}
