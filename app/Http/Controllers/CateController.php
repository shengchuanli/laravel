<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cate;
use Validator;
use Illuminate\Validation\Rule;
class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr = Cate::all()->toArray();
        $data = $this->cateinfo($arr);
        return view('cate/index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr = Cate::all()->toArray();
        $data = $this->cateinfo($arr);
        return view('cate/create',['data'=>$data]);
    }
    function cateinfo($data,$pid=0,$level=1){
        static $info=[];
        foreach($data as $k=>$v){
            if($v['pid']==$pid){
                $v['level']=$level;
                $info[]=$v;
                $this->cateinfo($data,$v['cate_id'],$v['level']+1);
            }
        }
        return $info;
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
            'cate_name' => 'unique:cate|regex:/^[\x{4e00}-\x{9fa5}]+$/u'
        ],[
            'cate_name.unique'=>'分类名称已存在',
            'cate_name.regex'=>'分类名称必须为中文且不能为空',
        ]);
        if ($validator->fails()){
            return redirect('/1908A/cate/create')
            ->withErrors($validator)
            ->withInput();
        }
        $res = Cate::create($data);
        if($res){
            return redirect('/1908A/cate/index');
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
        $arr = Cate::all()->toArray();
        $getinfo = $this->cateinfo($arr);
        $data = Cate::where('cate_id',$id)->first();
        return view('cate/edit',['data'=>$data,'getinfo'=>$getinfo]);
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
        $data = $request->except("_token");
        $validator = Validator::make($data,[
            'cate_name' =>[
                'regex:/^[\x{4e00}-\x{9fa5}]+$/u',
                Rule::unique('cate')->ignore($id,'cate_id'),
            ]
        ],[
            'cate_name.unique'=>'分类名称已存在',
            'cate_name.regex'=>'分类名称必须为中文',
        ]);
        if ($validator->fails()){
            return redirect('/1908A/cate/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }
        $res = Cate::where('cate_id',$id)->update($data);
        if($res!==false){
            return redirect('/1908A/cate/index');
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
        $res1 = Cate::where('pid',$id)->first();
        if($res1){
            echo json_encode(['code'=>'11111','msg'=>'ok']);die;
        }
        $res = Cate::where('cate_id',$id)->delete();
        if($res){
            echo json_encode(['code'=>'00000','msg'=>'ok']);die;
        }
    }
}
