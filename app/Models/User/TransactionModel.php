<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class TransactionModel extends Model
{
    protected $table = 'transaction';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'divisi_id',
        'total',
        'total_disetujui',
        'nama_acara',
        'tanggal_pengajuan',
        'catatan',
        'supporting_image',
        'jumlah_hari',
        'tanggal_akhir',
        'status'
    ];

    public function user(){
        return $this->belongsTo(UserModel::class);
    }

    public function divisi_2(){
        return $this->belongsTo(\App\Models\Admin\ComunityModel::class);
    }

    public function scopeUnread($query){
        return $query->where('is_read', false)->where('status', 'pending');
    }

}
