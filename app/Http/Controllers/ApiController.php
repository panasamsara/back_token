<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Cookie;
 
 
class ApiController extends Controller
{
    /*注册*/
    public function register(Request $request)
    {
        $input = $request->all();
        $input['password'] = md5($input['password']);
        Admin::create($input);
        return response()->json(['result'=>true]);
    }
 
    /*登陆*/
    public function login(Request $request)
    {
        \Config::set('jwt.user' , "App\Models\Admin");
        \Config::set('auth.providers.users.model', \App\Models\Admin::class);
        $input = $request->all();
        $input['password'] = md5($input['password']);
        if($user=Admin::where($input)->first()){
            $token=JWTAuth::fromUser($user);
        }else{
            return response()->json(['result' => '账号或密码错误.']);
        }
 
        return response()->json(['token' => $token, 'user' =>Admin::where($input)->first() ]);
    }
 
    /*获取用户信息*/
    public function get_user_details(Request $request)
    {
        $user = JWTAuth::toUser(JWTAuth::getToken());
        return response()->json(['result' => $user]);
    }
 
    public function quitLogin()
    {
        $token = Cookie::get('token');
        // var_dump($token);die();
        JWTAuth::invalidate($token);
        return response()->json(['msg' =>'退出成功']);
    }
}

