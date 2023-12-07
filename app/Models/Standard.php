<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{
    use HasFactory;
    
    public function grade(){
        return $this->belongsTo(Grade::class);
    } 
    public function standard(){
        return $this->belongsTo(Standard::class,'parent_id','id');
    } 
}
