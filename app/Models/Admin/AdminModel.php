<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'username',
        'email',
        'password',
        'image',
        'created_at',
        'updated_at'
    ];
}
