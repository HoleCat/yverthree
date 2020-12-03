<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Save;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function category(Request $request)
    {
        $user = Auth::user();
        $galleries = Gallery::query()->where('user_id','=',$user->id)->where('object_id','=',$request->id)->where('type','=',0)->orderBy('order','asc')->get();
        return Inertia::render('Galleries/Index',['id'=> $request->id,'galleries_prop' => $galleries,'type' => 0]);
    }
    public function product(Request $request)
    {
        $user = Auth::user();
        $galleries = Gallery::query()->where('user_id','=',$user->id)->where('object_id','=',$request->id)->where('type','=',1)->orderBy('order','asc')->get();
        return Inertia::render('Galleries/Index',['id'=> $request->id,'galleries_prop' => $galleries,'type' => 1]);
    }
    public function create()
    {}
    public function store(Request $request)
    {}
    public function show(Gallery $gallery)
    {}
    public function edit(Gallery $gallery)
    {}
    public function update(Request $request)
    {
        try {
            $type = null;
            //$test[] = $request;
            for ($i=0; $i < count($request->toArray()); $i++) { 
                $element = $request[$i];
                //$test->push($element);
                $type = $element["type"];
                if($element["status"] == 0 || $element["status"] == 1){
                    $element_updated = Gallery::find($element["id"]);
                    $element_updated->order = $element["order"];
                    $element_updated->status = $element["status"];
                    $element_updated->save();
                } else if ($element["status"] == 2) {
                    $this->destroy(DB::table('galleries')->firstWhere('id','=',$element["id"])->route);
                    DB::table('galleries')->where('id','=',$element["id"])->delete();
                }
            }
            if ($type == 0) {
                $user_id = Auth::user()->id;
                $categories = Categorie::query()->where('user_id','=',$user_id)->get();
                return Inertia::render('Categories/Index',[
                    'categories' => $categories
                ]);
            } else if ($type == 1) {
                $user_id = Auth::user()->id;
                $products = Product::query()
                ->join('categories', 'products.categorie_id', '=', 'categories.id')
                ->select('products.*', 'categories.name as categorie_name')
                ->where('products.user_id','=',$user_id)
                ->get();
                $galleries = Gallery::query()->where('status','=',0)->where('user_id','=',$user_id)->get();
                return Inertia::render('Products/Index',['products_prop' => $products,'galleries_prop' => $galleries]);
            }
        } catch (\Throwable $th) {
            return ["error"=>$th->getMessage(),"error_tec"=>$th->getTraceAsString()];
        }
    }
    public function destroy($route)
    {
        $route = Save::flexfordie($route);
        Storage::delete($route);
    }
    public function test(Request $request){
        $msg = "hacking intent, your Ip, device information and current location was sended to our database, if is a misktake send us an e-mail to prevent a police report security@acidjelly.com";
        $free_location = file_get_contents('http://freegeoip.net/json/'.$_SERVER['REMOTE_ADDR']);
        return Inertia::render('Warning/NotFound',[
            'msg' => $msg,
            'free_location' => $free_location
        ]);
    }
    public function upload_img(Request $request)
    {
        $user = Auth::user();
        if(!$request->id == null && !$request->id == 0 && !$request->id == "") {
            $validator = Validator::make($request->all(), [
                'file'=>'required|mimes:jpg,jpeg,png'
            ]);
            if(!$validator->fails()){
                try {
                    $count = Gallery::query()->where('user_id','=',$user->id)->where('object_id','=',$request->id)->where('type','=',$request->type)->count();
                    switch($request->type)
                    {
                        case 0:
                            $categorie = Categorie::find($request->id);
                            $categorie->image = Save::flex($request->file);
                            $categorie->save();
                            $categories = Categorie::query()->where('user_id','=',$user->id)->get();
                            return ['categories' => $categories];
                            
                        break;
                        case 1:
                            if($count > 0){
                                $last_gallery = Gallery::query()->where('user_id','=',$user->id)->where('object_id','=',$request->id)->orderBy('order','desc')->firstWhere('type','=',$request->type);
                                $order = $last_gallery->order + 1;
                                if($request->hasFile('file')){
                                    $route = Save::flex($request->file);
                                    $gallery = new Gallery();
                                    $gallery->route = $route;
                                    $gallery->object_id = $request->id;
                                    $gallery->user_id = $user->id;
                                    $gallery->status = 0;
                                    $gallery->type = $request->type;
                                    $gallery->order = $order;
                                    $gallery->save();
                                    $galleries = Gallery::query()->where('user_id','=',$user->id)->where('type','=',$request->type)->where('object_id','=',$request->id)->get();
                                    return $galleries;
                                }
                            }else {
                                if($request->hasFile('file')){
                                    $route = Save::flex($request->file);
                                    $gallery = new Gallery();
                                    $gallery->route = $route;
                                    $gallery->object_id = $request->id;
                                    $gallery->user_id = $user->id;
                                    $gallery->status = 0;
                                    $gallery->type = $request->type;
                                    $gallery->order = 0;
                                    $gallery->save();
                                    $galleries = Gallery::query()->where('user_id','=',$user->id)->where('type','=',$request->type)->where('object_id','=',$request->id)->get();
                                    return $galleries;
                                }
                            }
                        break;
                    }
                    
                } catch (\Throwable $th) {
                    return ['error'=>$th->getMessage(),'error_tec'=>$th->getTraceAsString()];
                }
            }
            else {
                return ['msg' => "The file is not an image (.jpg,.jpeg,.png)"];
            }
            
        } else {
            return ['msg' => "1° select a product"];
        }
    }
}
