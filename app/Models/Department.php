<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'dep_name',
        'dep_description',
        'dep_status',
    ];

    public function Staff() {
        return $this->belongsTo(Department::class);
    }
}
