<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CategorieController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index()
    {
        $user_id = Auth::user()->id;
        $categories = Categorie::query()->where('user_id','=',$user_id)->get();
        return Inertia::render('Categories/Index',[
            'categories' => $categories,'type'=>0
        ]);
    }
    public function create()
    {
        //$categories = Categorie::with("user")->paginate(2);
        return Inertia::render('Categories/Create');
    }
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $categorie = new Categorie();
        $categorie->name = $request->name;
        $categorie->description = $request->description;
        $categorie->icon = $request->icon;
        $categorie->image = "pendiente";
        $categorie->user_id = $user_id;
        $categorie->save();

        $categories = Categorie::query()->where('user_id','=',$user_id)->get();
        return Inertia::render('Categories/Index',[
            'categories' => $categories
        ]);
    }
    public function show(Categorie $categorie)
    {
        $user_id = Auth::user();
        $store = Store::query()->firstWhere('user_id','=',$user_id);
        return Inertia::render('Categories/Preview',[
            'categorie' => $categorie,
            'store' => $store
        ]);
    }
    public function edit(Request $request)
    {
        $categorie = new Categorie();
        $old_categorie = new Categorie();
        $categorie->id = $request->id;
        $old_categorie->id = $request->id;
        $categorie->name = $request->name;
        $old_categorie->name = $request->name;
        $categorie->description = $request->description;
        $old_categorie->description = $request->description;
        $categorie->icon = $request->icon;
        $old_categorie->icon = $request->icon;
        $categorie->image = $request->image;
        $old_categorie->image = $request->image;
        $categorie->action = $request->action;
        $old_categorie->action = $request->action;
        $categorie->old_categorie = json_encode($old_categorie);
        return Inertia::render('Categories/Edit',[
            'categorie_prop' => $categorie
        ]);
    }
    public function update(Request $request)
    {
        $user_id = Auth::user()->id;
        try {   
            $action = $request->action;
            switch($action){
                case 'EDIT':
                    $categorie = Categorie::find($request->id);
                    $categorie->id = $request->id;
                    $categorie->name = $request->name;
                    $categorie->description = $request->description;
                    $categorie->icon = $request->icon;
                    $categorie->image = "pendiente";
                    $categorie->save();
                    $categorie->old_categorie = $request->old_categorie;
                    $store = Store::query()->firstWhere('user_id','=',$user_id);                    
                    return Inertia::render('Categories/Preview',[
                        'categorie_prop' => $categorie,
                        'store' => $store
                    ]);
                break;
                case 'ACEPT':
                    $categories = Categorie::query()->where('user_id','=',$user_id)->get();
                    return Inertia::render('Categories/Index',[
                        'categories' => $categories
                    ]);
                break;
                case 'CANCEL':
                    $categorie = Categorie::find($request->id);
                    $old_categorie = json_decode($request->old_categorie);
                    $categorie->name = $old_categorie->name;
                    $categorie->description = $old_categorie->description;
                    $categorie->icon = $old_categorie->icon; 
                    $categorie->image = "pendiente";
                    $categorie->save();
                    $categorie->old_categorie = $request->old_categorie;
                    $categorie->action = "EDIT";
                    return Inertia::render('Categories/Edit',[
                        'categorie_prop' => $categorie
                    ]);
                break;
            }
        } catch (\Throwable $th) {
            return ["error"=>$th->getMessage(),"trace"=>$th->getTraceAsString()];
        }
    }
    public function destroy(Request $request)
    {
        $user_id = Auth::user()->id;
        $categorie_id = $request->id;
        try {
            Categorie::query()->where('id','=',$request->id)->delete();
            $categories = Categorie::query()->where('user_id','=',$user_id)->get();
            return Inertia::render('Categories/Index',[
                'categories' => $categories
            ]);
        } catch (\Throwable $th) {
            $products = Product::query()
            ->join('categories', 'products.categorie_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as categorie_name')
            ->where('products.user_id','=',$user_id)
            ->where('products.categorie_id','=',$categorie_id)
            ->get();
            return Inertia::render('Products/Index',[
                'products_prop' => $products
            ]);
        }
    }
}
