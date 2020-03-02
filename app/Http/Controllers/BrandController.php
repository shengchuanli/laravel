<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Brand;
use Validator;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $brand_name = request()->brand_name??'';
        // $where=[];
        // if($brand_name){
        //     $where[]=['brand_name','like',"%$brand_name%"]
        // }
        $brandall=Brand::all();
        return view('brand/index',['brandall'=>$brandall]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 接受数据值
       $data = $request->except("_token");

       // 错误提示
       $validator=Validator::make($data,[
        'brand_name'=>['required','unique:brand','regex:/^[\x{4200}-\x{9fa5}A-Za-z0-9_]+$/u'],
        'brand_url'=>'required',
       ],[
         'brand_name.required'=>'品牌名称必填',
         'brand_name.unique'=>'名称已存在',
         'brand_name.regex'=>'必须是中文 字母 数字 下划线组成',
         'brand_url.required'=>'网址必填',
       ]);

       if($validator->fails()){
        return redirect('/1908A/brand/create')
                ->withErrors($validator)
                ->withInput();
       }



      if($request->hasFile('brand_logo')){
        $data['brand_logo']=$this->upload('brand_logo');
      }

        $res =Brand::create($data);
        if($res){
            return redirect('/1908A/brand/index');
        }
    }
   //单个上传文件
    function upload($filename){
        //判断上传过程中有无错误
        if(request()->file($filename)->isValid()){
            //接收值
            $photo = request()->file($filename);
            //上传
            return $photo->store($filename);
        }
        exit('未获取上传文件或上传文件过程出错');
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

        $res =Brand::find($id);
        return view('brand/update',['res'=>$res]);
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
           if($request->hasFile('brand_logo')){
         $data['brand_logo']=$this->upload('brand_logo');
      }
      $res=Brand::where('brand_id',$id)->update($data);
      if($res!==false){
        return redirect('/1908A/brand/index');
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
        $res=Brand::destroy($id);
        if($res){
            return redirect('/1908A/brand/index');
        }
    }
}
