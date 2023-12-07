<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolDetail extends Model
{
    use HasFactory;
    protected $fillable = ['school_id', 'principal_name', 'principal_email', 'principal_phone_no', 'team_lead_name', 'team_lead_email', 'team_lead_phone_no' ];

}
