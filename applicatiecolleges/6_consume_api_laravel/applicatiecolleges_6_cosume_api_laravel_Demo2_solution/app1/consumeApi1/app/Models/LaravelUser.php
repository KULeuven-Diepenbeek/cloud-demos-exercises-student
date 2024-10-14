<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaravelUser extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural of the model name
    protected $table = 'laravelUsers';

    // The attributes that are mass assignable
    protected $fillable = [
        'name',
        'email',
    ];

    // Disable timestamps if your table doesn't have created_at and updated_at columns
    public $timestamps = true;
}