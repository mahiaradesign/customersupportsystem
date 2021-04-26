<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class executive extends Model
{
    use HasFactory;
    protected $table = 'executive';
    protected $fillable = ['executive_id','query_assigned','query_solved','query_pending'];
    public $timestamp = true;
}
