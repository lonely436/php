<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    use HasFactory;
    // 1、关联数据表
    protected $table = 'enterprise';

    // 2、关掉create_at updated_at
    public $timestamps = false;

    // 3、批量赋值
    protected $guarded = [];
}
