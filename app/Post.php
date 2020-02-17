<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ["title", "content", "slug", "user_id", "category_id", "cover_path", "status"];

    public function creator()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getDescriptionAttribute()
    {
        return substr($this->content, 0, 70) . "...";
    }

    public function getCoverAttribute()
    {
        $parts = explode("/", $this->cover_path);

        return end($parts);
    }


}
