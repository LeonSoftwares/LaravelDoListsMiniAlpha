<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoLists extends Model
{
    use HasFactory;

    protected $table = 'do_lists';

    protected $fillable = ['name', 'do', 'status', 'order_item', 'user_id', 'created_at'];
}
