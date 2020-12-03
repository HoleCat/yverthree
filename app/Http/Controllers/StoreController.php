<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Categorie;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;

class StoreController extends Controller
{
    public function index()
    {
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
    }
    public function show($store)
    {
        $store = Store::query()->where('store','like','%'.$store.'%')->get();
        $count = count($store);
        if($count>1){
            $store = $store[0];
            $user_id = $store->user_id;
            $products = Product::query()
            ->join('categories', 'products.categorie_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as categorie_name')
            ->where('products.user_id','=',$user_id)
            ->get();
            $categories = Categorie::query()->where('user_id','=',$user_id)->get();
            $galleries = Gallery::query()->where('user_id','=',$user_id)->orderBy('order','asc')->get();
            return Inertia::render('Stores/Index',[
                'store' => $store,
                'products' => $products,
                'categories' => $categories,
                'galeries' => $galleries
            ]);
        } else if($count == 0) {
            $store = "NotFound";
            return redirect('/'.$store);
        } else {
            $store = $store[0];
            $user_id = $store->user_id;
            $products = Product::query()
            ->join('categories', 'products.categorie_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as categorie_name')
            ->where('products.user_id','=',$user_id)
            ->get();
            $categories = Categorie::query()->where('user_id','=',$user_id)->get();
            $galleries = Gallery::query()->where('user_id','=',$user_id)->orderBy('order','asc')->get();
            return Inertia::render('Stores/Index',[
                'store' => $store,
                'products_prop' => $products,
                'categories' => $categories,
                'galleries_prop'=> $galleries
            ]);
        }   
    }
    public function edit(Store $store)
    {
        $user = Auth::user();
        $count = Store::query()->where('user_id','=',$user->id)->count();
        if($count < 1){
            
        } else {
            $store = Store::query()->firstWhere('user_id','=',$user->id);
        }
        $store->action = "EDIT";
        //return $store;
        return Inertia::render('Stores/Edit',[
            'store_prop' => $store
        ]);
    }
    public function update(Request $request, Store $store)
    {
        $store = Store::find($request->id);
        $store->store = $request->store;
        $store->slogan = $request->slogan;
        $store->background_one = $request->background_one;
        $store->background_two = $request->background_two;
        $store->background_three = $request->background_three;
        $store->background_products = $request->background_products;
        $store->background_categories = $request->background_categories;
        $store->color_title_principal = $request->color_title_principal;
        $store->color_title_secondary = $request->color_title_secondary;
        $store->color_product_price = $request->color_product_price;
        $store->color_product_categorie = $request->color_product_categorie;
        $store->color_product_discount = $request->color_product_discount;
        $store->color_product_stock = $request->color_product_stock;
        $store->background_product_price = $request->background_product_price;
        $store->background_product_categorie = $request->background_product_categorie;
        $store->background_product_discount = $request->background_product_discount;
        $store->background_product_stock = $request->background_product_stock;
        $store->color_product_alert = $request->color_product_alert;
        $store->color_product_info = $request->color_product_info;
        $store->color_product_description = $request->color_product_description;
        $store->radio_options = $request->radio_options;
        $store->save();

        $user_id = $store->user_id;
        $products = Product::query()
        ->join('categories', 'products.categorie_id', '=', 'categories.id')
        ->select('products.*', 'categories.name as categorie_name')
        ->where('products.user_id','=',$user_id)
        ->get();
        $categories = Categorie::query()->where('user_id','=',$user_id)->get();
        $galleries = Gallery::query()->where('user_id','=',$user_id)->orderBy('order','asc')->get();
        return Inertia::render('Stores/Index',[
            'store' => $store,
            'products_prop' => $products,
            'categories' => $categories,
            'galleries_prop' => $galleries
        ]);
    }
    public function destroy(Store $store)
    {
    }
    public function car(){
        if(Auth::login()){
            $user = Auth::user();
            if(true){
                
            }
        }
    }
}
