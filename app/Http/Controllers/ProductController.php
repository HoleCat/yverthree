<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index()
    {
        $user_id = Auth::user()->id;
        $products = Product::query()
        ->join('categories', 'products.categorie_id', '=', 'categories.id')
        ->select('products.*', 'categories.name as categorie_name')
        ->where('products.user_id','=',$user_id)
        ->get();
        $galleries = Gallery::query()->where('status','=',0)->where('user_id','=',$user_id)->get();
        return Inertia::render('Products/Index',['products_prop' => $products,'galleries_prop' => $galleries]);
    }
    public function create()
    {
        //$products = Product::with("user")->paginate(2);
        $user_id = Auth::user()->id;
        $categories = Categorie::query()->where('user_id','=',$user_id)->get();
        return Inertia::render('Products/Create', ['categories'=>$categories]);
    }
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->alert = $request->alert;
        $product->info = $request->info;
        $product->stock = $request->stock;
        $product->description = $request->description;
        $product->discount = $request->discount;
        $product->categorie_id = $request->categorie_id;
        $product->user_id = $user_id;
        $product->save();

        $products = Product::query()
            ->join('categories', 'products.categorie_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as categorie_name')
            ->where('products.user_id','=',$user_id)
            ->get();
            $galleries = Gallery::query()->where('user_id','=',$user_id)->get();
            return Inertia::render('Products/Index',['products_prop' => $products,'galleries_prop' => $galleries]);
    }
    public function show(Product $product)
    {
        $user_id = Auth::user()->id;
        $store = Store::query()->firstWhere('user_id','=',$user_id);
        return Inertia::render('Products/Preview',['product' => $product,'store' => $store]);
    }
    public function edit(Request $request)
    {
        $user_id = Auth::user()->id;
        $product = new Product();
        $old_product = new Product();
        $product->id = $request->id;
        $old_product->id = $request->id;
        $product->name = $request->name;
        $old_product->name = $request->name;
        $product->price = $request->price;
        $old_product->price = $request->price;
        $product->alert = $request->alert;
        $old_product->alert = $request->alert;
        $product->info = $request->info;
        $old_product->info = $request->info;
        $product->stock = $request->stock;
        $old_product->stock = $request->stock;
        $product->description = $request->description;
        $old_product->description = $request->description;
        $product->discount = $request->discount;
        $old_product->discount = $request->discount;
        $product->categorie_id = $request->categorie_id;
        $old_product->categorie_id = $request->categorie_id;
        $product->action = $request->action;
        $product->old_product = json_encode($old_product);
        $categories = Categorie::query()->where('user_id','=',$user_id)->get();
        return Inertia::render('Products/Edit',['product_prop' => $product,'categories' => $categories,]);
    }
    public function update(Request $request)
    {
        $user_id = Auth::user()->id;
        try {   
            $action = $request->action;
            switch($action){
                case 'EDIT':
                    $product = Product::find($request->id);
                    $product->id = $request->id;
                    $product->name = $request->name;
                    $product->price = $request->price;
                    $product->alert = $request->alert;
                    $product->info = $request->info;
                    $product->stock = $request->stock;
                    $product->description = $request->description;
                    $product->discount = $request->discount;
                    $product->categorie_id = $request->categorie_id;
                    $product->save();
                    $product->old_product = $request->old_product;
                    $product->categorie_name = Categorie::find($request->categorie_id)->name;
                    $store = Store::query()->firstWhere('user_id','=',$user_id);
                    
                    return Inertia::render('Products/Preview',['product_prop' => $product,'store_prop' => $store]);
                break;
                case 'ACEPT':
                    $products = Product::query()
                    ->join('categories', 'products.categorie_id', '=', 'categories.id')
                    ->select('products.*', 'categories.name as categorie_name')
                    ->where('products.user_id','=',$user_id)
                    ->get();
                    $galleries = Gallery::query()->where('user_id','=',$user_id)->get();
                    return Inertia::render('Products/Index',['products_prop' => $products,'galleries_prop' => $galleries]);
                break;
                case 'CANCEL':
                    $product = Product::find($request->id);
                    $old_product = json_decode($request->old_product);
                    $product->name = $old_product->name;
                    $product->price = $old_product->price;
                    $product->alert = $old_product->alert;
                    $product->info = $old_product->info;
                    $product->stock = $old_product->stock;
                    $product->description = $old_product->description;
                    $product->discount = $old_product->discount;
                    $product->categorie_id = $request->categorie_id;
                    $product->save();
                    $product->action = "EDIT";
                    $product->old_product = $old_product;
                    $categories = Categorie::query()->where('user_id','=',Auth::user()->id)->get();
                    return Inertia::render('Products/Edit',['product_prop' => $product,'categories' => $categories]);
                break;
            }
        } catch (\Throwable $th) {
            return ["error"=>$th->getMessage(),"trace"=>$th->getTraceAsString()];
        }
    }
    public function destroy(Request $request)
    {
        $user_id = Auth::user()->id;
        try {
            Product::query()->where('id','=',$request->id)->delete();
            $products = Product::query()
            ->join('categories', 'products.categorie_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as categorie_name')
            ->where('products.user_id','=',$user_id)
            ->get();
            $galleries = Gallery::query()->where('user_id','=',$user_id)->get();
            return Inertia::render('Products/Index',['products_prop' => $products,'galleries_prop'=>$galleries]);
        } catch (\Throwable $th) {
            $products = Product::query()
            ->join('categories', 'products.categorie_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as categorie_name')
            ->where('products.user_id','=',$user_id)
            ->get();
            $galleries = Gallery::query()->where('user_id','=',$user_id)->get();
            return Inertia::render('Products/Index',['products_prop' => $products,'galleries_prop'=>$galleries]);
        }
    }
}
