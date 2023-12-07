<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    const PACKAGE = 'package';
    const COURSE = 'course';
    
    public function packages()
    {
        return $this->hasMany(Package::class);
    }
    
    public static function allPackages()
    {
        return Plan::all();
    }

    public static function allPlans()
    {
        return Plan::all();
    }

    public function setColumns($req)
    {
        $this->title = $req->title;
        $this->amount = $req->amount;
        $this->currency = $req->currency;
        $this->plan_interval = $req->plan_interval;
        $this->interval_count = $req->interval_count;
        $this->plan_id = $req->plan_id;
        $this->product_id = $req->product_id;
        $this->description = $req->description;
        return $this;
    }
    
}
