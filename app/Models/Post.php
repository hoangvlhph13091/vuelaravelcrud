<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table ='posts';
    protected $fillable=['title','content'];

    public function post(){
        return $this->hasMany(Product::class,'id','postID');
    }
}
