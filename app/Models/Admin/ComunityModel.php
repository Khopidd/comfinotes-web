<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $image_divisi
 */

class ComunityModel extends Model
{

    protected $table = 'divisi';
    protected $primaryKey = 'id' ;
    public $timestamps = true;
    protected $fillable = [
        'name_divisi',
        'image_divisi',
        'key_id',
        'created_at',
        'updated_at'
    ];

    public function comunite(){
        return $this->hasMany(\App\Models\Auth\AuthModel::class, 'divisi_id', 'id');
    }
}
