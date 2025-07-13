<?php

namespace App\Models\Auth;

use App\Models\Admin\AddFunctModel;
use App\Models\Admin\OutFunctModel;
use App\Models\User\TransactionModel;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AuthModel extends Authenticatable
{
    protected $table = 'users';
    protected $primarykey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'username',
        'email',
        'password',
        'image',
        'divisi_id',
        'created_at',
        'updated_at'
    ];

    public function divisi()
    {
        return $this->belongsTo(\App\Models\Admin\ComunityModel::class, 'divisi_id');
    }

     public function transactions()
    {
        return $this->hasMany(TransactionModel::class);
    }

    public function incomes()
    {
        return $this->hasMany(AddFunctModel::class, 'created_by');
    }

    public function expenses()
    {
        return $this->hasMany(OutFunctModel::class, 'created_by');
    }

    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeUser($query)
    {
        return $query->where('role', 'user');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }
}
