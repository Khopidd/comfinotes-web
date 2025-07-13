<?php

namespace App\Helpers;

use App\Models\Admin\SaldoModel;

if(!function_exists('path_view')){
    function path_view(string $view){
        return $view;
    }
}

class helper
{
     public static function tambahSaldo($jumlah)
    {
        $saldo = SaldoModel::first();
        if (!$saldo) {
            SaldoModel::create(['saldo' => $jumlah]);
        } else {
            $saldo->increment('saldo', $jumlah);
        }
    }

    public static function kurangiSaldo($jumlah)
    {
        $saldo = SaldoModel::first();
        if ($saldo) {
            $saldo->decrement('saldo', $jumlah);
        }
    }

    public static function getSaldo()
    {
        return SaldoModel::first()?->saldo ?? 0;
    }
}
