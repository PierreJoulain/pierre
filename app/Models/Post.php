<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\Tag;
use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title','content','user_id'];

    /*public function comments()
    {
        return $this->hasMany(Comment::class);
    }*/

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function image(){
        return $this->hasOne(Image::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class,'pivot_table_post_tag');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
