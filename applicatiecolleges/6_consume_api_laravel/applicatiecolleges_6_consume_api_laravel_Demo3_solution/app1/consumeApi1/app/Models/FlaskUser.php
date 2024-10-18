<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlaskUser extends Model
{
    use HasFactory;

    protected $table = 'flask_users'; // Name of the table
    protected $fillable = ['name', 'email']; // Fillable fields
}