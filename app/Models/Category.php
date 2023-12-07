<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillale = ['name'];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public static function allCategories()
    {
        return Category::all();
    }

    public function selectCols($req)
    {
        $this->name = $req->name;
        return $this;
    }
}
