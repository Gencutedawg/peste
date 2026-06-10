<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThicknessRemarks extends Model
{
    protected $table = 'thickness_remarks';

    protected $fillable = [
        'remark_name',
        'description',
        'is_active',
    ];
}
