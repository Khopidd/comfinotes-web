<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class SaldoModel extends Model
{
    protected $table = 'saldo';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'saldo',
    ];
}
