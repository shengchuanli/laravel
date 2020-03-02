<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Admin;
use Illuminate\Validation\Rule;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageSize = config('app.pageSize');
        $data = Admin::paginate($pageSize);
        return view('admin/index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $validator = Validator::make($data,[
            'admin_tel' => 'unique:admin|regex:/^\d{11}$/',
            'admin_pwd' => 'regex:/^[A-Za-z0-9]+$/',
        ],[
            'admin_tel.unique'=>'用户名已存在',
            'admin_pwd.regex'=>'密码有数字字母组成',
            'admin_tel.regex'=>'手机号必须为11位数字',
        ]);
        if($validator->fails()){
            return redirect('/1908A/admin/create')
                    ->withErrors($validator)
                    ->withInput();
        }
        if($data['admin_pwd']!=$data['admin_pwds']){
            return redirect('/admin/create')->with('msg','此用户的密码两次不一致');
        }
        $data['admin_pwd'] = encrypt($data['admin_pwd']);
        unset($data['admin_pwds']);
        $data['admin_time'] = time();
        $res = Admin::create($data);
        if($res){
            return redirect('/1908A/admin/index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Admin::where('admin_id',$id)->first();
        return view('admin/edit',['data'=>$data]);
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
        $data = $request->except('_token');
        $validator = Validator::make($data,[
            'admin_tel' => 'regex:/^\d{11}$/',
            'admin_pwd' => 'regex:/^[A-Za-z0-9]+$/',
        ],[
            'admin_pwd.regex'=>'密码有数字字母组成',
            'admin_tel.regex'=>'手机号必须为11位数字',
        ]);
        if($validator->fails()){
            return redirect('/1908A/admin/edit/'.$id)
                    ->withErrors($validator)
                    ->withInput();
        }
        $res = Admin::where('admin_id',$id)->update($data);
        if($res!==false){
            return redirect('/1908A/admin/index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Admin::where('admin_id',$id)->delete();
        if($res){
            echo json_encode(['code'=>'0000','msg'=>'yes']);
        }
    }
}
