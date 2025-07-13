<?php

namespace App\Models\Admin;

use App\Models\Auth\AuthModel;
use Illuminate\Database\Eloquent\Model;

class AddFunctModel extends Model
{
    protected $table = 'add_funds';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'created_by',
        'divisi_id',
        'jumlah',
        'tanggal_masuk',
        'keterangan',
        'created_at',
        'updated_at'
    ];

    public function creator()
    {
        return $this->belongsTo(AuthModel::class, 'created_by');
    }

    public function departemen()
    {
        return $this->belongsTo(\App\Models\Admin\ComunityModel::class);
    }
}
