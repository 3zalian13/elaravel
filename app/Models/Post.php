<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public  static  function  all(){
        $files = File::files(resource_path("posts"));

//         return array_map(function ($file){
//             $object= YamlFrontMatter::parseFile($file);
//             return $object->body();
//
//        }, $files);

         return collect($files)->map(function ($file){
             $object= YamlFrontMatter::parseFile($file);
             return $object->body();
         });
    }
    public static function find ($slg)
    {
         if (!file_exists($path = resource_path("posts/{$slg}.html"))){

            throw new ModelNotFoundException();
         }
        return cache()->remember( "azoz.$slg", 10 , function () use($path) {
            var_dump('red file');
            return file_get_contents($path);
         });
    }
}
