<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Save extends Model
{
    use HasFactory;

    static function flex($file){
        $filenamewithext = $file->getClientOriginalName();
        $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);
        $ext = $file->getClientOriginalExtension();
        $filenametostore = $filename.'_'.time().'.'.$ext;
        $route = $file->move('storage/', $filenametostore);
        $route = asset($route);
        return $route;
    }

    static function flexfordie($route){
        $route = asset($route);
        $array_route = explode("/",$route);
        $filename = "public/".$array_route[count($array_route-1)];
        return $filename;
    }
}
