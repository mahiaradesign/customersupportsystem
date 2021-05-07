<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feedbacks extends Model
{
    use HasFactory;
    protected $table = 'feedback';
    protected $fillable = ['ticket_id','fdbk_msg'];
    public $timestamp = true;
}
