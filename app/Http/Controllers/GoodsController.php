<?php

namespace App\Http\Controllers;

use App\Goods;
use Illuminate\Http\Request;
use App\Cate;
use App\Brand;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand_id=request()->brand_id;
        $where=[];
        if($brand_id){
            $where[]=['goods.brand_id','=',$brand_id];
        }
        $cate_id=request()->cate_id;
        if($cate_id){
            $where[]=['goods.cate_id','=',$cate_id];
        }
        $goods_name=request()->goods_name;
        if($goods_name){
            $where[]=['goods_name','like','%'.$goods_name.'%'];
        }
        /**分类数据*/
        $cateinfo=Cate::all()->toArray();
        $cateall= $this->cateinfo($cateinfo);
        /**品牌数据*/
        $brandall=Brand::all();
            $goodsall=Goods::leftjoin('brand', 'goods.brand_id','=','brand.brand_id')
                ->leftjoin('cate','cate.cate_id','=','goods.cate_id')
                ->where($where)
                ->paginate(3);
//        dd($goodsall);
        return view('goods.index',['goodsall'=>$goodsall,'cateall'=>$cateall,'brandall'=>$brandall,
            'brand_id'=>$brand_id,'cate_id'=>$cate_id,'goods_name'=>$goods_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            //分类数据
        $cateall=Cate::all()->toArray();
        $cateall=$this->cateinfo($cateall);
        $brandall=Brand::all();
        //品牌数据
//        dd($cateall);
        return view('goods.create',['cateall'=>$cateall,'brandall'=>$brandall]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $info=$request->except('_token');
        $validator=Validator::make($info,[
            'goods_name'=>['required','unique:goods','regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u'],
            'goods_num'=>'required|regex:/^\d+$/',
            'goods_price'=>'required|regex:/^\d+$/',
            'cate_id'=>'required',
            'brand_id'=>'required',
        ],[
            'goods_name.required'=>'商品名称必填',
            'goods_name.unique'=>'名称已存在',
            'goods_name.regex'=>'必须是中文,字母,下划线，数字组成',
            'goods_num.required'=>'商品库存必填',
            'goods_num.regex'=>'商品库存必须是数字',
            'goods_price.required'=>'商品价格必填',
            'goods_price.regex'=>'商品价格必需是数字',
            'cate_id.required'=>'商品分类必填',
            'brand_id.required'=>'商品品牌必填',
        ]);

        if ($validator->fails())
        {
            return redirect('/1908A/goods/create')
                ->withErrors($validator)
                ->withInput();
        }
        if($request->hasFile('goods_img')){
            $info['goods_img']=$this->upload('goods_img');
        };
        if($request->hasFile('goods_imgs')){
            $info['goods_imgs']=$this->MoreUploads('goods_imgs');
        };
        $res=Goods::create($info);
//         dd($res);
        if($res){
            return redirect('/1908A/goods/index');
        }else{
            return redirect('/1908A/goods/create');
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
        //分类数据
        $cateall=Cate::all()->toArray();
        $cateall=$this->cateinfo($cateall);
        //品牌数据
        $brandall=Brand::all();
//
        $goodsfind=Goods::find($id);
//        dd($goodsfind);

        return view('goods.edit',['goodsfind'=>$goodsfind,'cateall'=>$cateall,'brandall'=>$brandall]);
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
        $info=$request->except('_token');
        $validator=Validator::make($info,[
            'goods_name'=>['required',Rule::unique('goods')->ignore($request->id,
                'goods_id'),'regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u'],
            'goods_num'=>'required|regex:/^\d+$/',
            'goods_price'=>'required|regex:/^\d+$/',
            'cate_id'=>'required',
            'brand_id'=>'required',
        ],[
            'goods_name.required'=>'商品名称必填',
            'goods_name.unique'=>'名称已存在',
            'goods_name.regex'=>'必须是中文,字母,下划线，数字组成',
            'goods_num.required'=>'商品库存必填',
            'goods_num.regex'=>'商品库存必须是数字',
            'goods_price.required'=>'商品价格必填',
            'goods_price.regex'=>'商品价格必需是数字',
            'cate_id.required'=>'商品分类必填',
            'brand_id.required'=>'商品品牌必填',
        ]);

        if ($validator->fails())
        {
            return redirect('/1908A/goods/update/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
        if($request->hasFile('goods_img')){
            $info['goods_img']=$this->upload('goods_img');
        };
        if($request->hasFile('goods_imgs')){
            $info['goods_imgs']=$this->MoreUploads('goods_imgs');
        };
        $res=Goods::where(['goods_id'=>$id])->update($info);
        if($res!==false){
            return redirect('/1908A/goods/index');
        }else{
            return redirect('/1908A/goods/edit/'.$id);
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
//        echo $id;die;
        $res=Goods::destroy($id);
        if($res){
            echo json_encode(['code'=>00000,'msg'=>'成功']);
        }else{
            echo json_encode(['code'=>11111,'msg'=>'失败']);
        }
    }


    public function cateinfo($cateall,$pid=0,$level=1){
        static $res=[];
        foreach($cateall as $k=>$v){
            if ($v['pid']==$pid){
                $v['level']=$level;
                $res[] = $v;
                $this->cateinfo($cateall, $v['cate_id'],$v['level']+1);
            }
        }
        return $res;
    }

//文件上传
  public  function upload($filename){
        if(request()->file($filename)->isValid()){
            $file=request()->file($filename);
            return   $file->store($filename);
        }
        exit('文件上传错误');
    }

//多个文件上传
  public  function  MoreUploads($filename)
  {
      //接受上传信息
      $files = request()->file($filename);
      //判断是否是数组
      if (!is_array($files)) {
          return;
      }

      foreach($files as $v){
            if ($v->isValid()){
                $file[]= $v->store($filename);
            }
        }
        $str = implode('|', $file);
        // 返回入库信息
        return $str;
    }
//    jd唯一
    public function ajaxtest(){
        $value=request()->value;
        $where=[
            ['goods_name','=',$value]
        ];
        $goods_id=request()->id;
        if($goods_id){
            $where[]=['goods_id','!==',$goods_id];
        }
        $count=Goods::where($where)->count();
        if($count>0){
            echo json_encode(['code' => 00000, 'msg' => '该名称已存在', 'count' => $count]);die;
        }
        echo json_encode(['code' =>11111, 'msg' => 'ok', 'count' => $count]);die;
    }
}