<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chiled_taskes extends Model
{
    use HasFactory;
    protected $fillable = [
        'task_id',
        'title',
        'user_id'
            ];

}
