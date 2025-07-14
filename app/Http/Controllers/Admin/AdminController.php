<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\helper;
use App\Http\Controllers\Controller;
use App\Models\Admin\AddFunctModel;
use App\Models\Admin\OutFunctModel;
use App\Models\User\TransactionModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function App\Helpers\path_view;

class AdminController extends Controller
{
    public function admin(){
        $totalIncome = AddFunctModel::sum('jumlah');
        $historyTransaction = TransactionModel::all();
        $totalAprovalTransaction = TransactionModel::where('status', 'approved')->sum('total_disetujui');
        $aprroveCount = TransactionModel::where('status', 'approved')->count();

        $saldo = helper::getSaldo();

        $startDate = Carbon::now()->subMonths(5)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $incomePerMonth = AddFunctModel::selectRaw('MONTH(tanggal_masuk) as month, SUM(jumlah) as total')
            ->whereBetween('tanggal_masuk', [$startDate, $endDate])
            ->groupBy('month')
            ->pluck('total', 'month');

        $expensePerMonth = TransactionModel::where('status', 'approved')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('MONTH(created_at) as month, SUM(total_disetujui) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        $maxValue = max($incomePerMonth->max() ?? 1, $expensePerMonth->max() ?? 1);

        $monthlyData = [];
        $months = [];

        for ($i = 5; $i >= 0; $i--) {
            $carbonMonth = Carbon::now()->subMonths($i);
            $monthNumber = $carbonMonth->month;
            $monthName = $carbonMonth->locale('id')->monthName;

            $income = $incomePerMonth[$monthNumber] ?? 0;
            $expense = $expensePerMonth[$monthNumber] ?? 0;

            $monthlyData[$monthName] = [
                'income' => $income,
                'expense' => $expense,
                'income_percent' => ($income / $maxValue) * 100,
                'expense_percent' => ($expense / $maxValue) * 100,
            ];

            $months[] = $monthName;
        }

        $view = path_view('admin.dashboard-admin');
        return view($view, compact('totalIncome', 'totalAprovalTransaction', 'aprroveCount', 'historyTransaction', 'saldo', 'monthlyData', 'months'));
    }

    public function AddFunds(Request $request){
        $validated = $request->validate([
            'keterangan' => 'string|max:150',
            'jumlah' => 'required|numeric|min:1000',
            'tanggal' => 'required|date'

        ], [
            'jumlah.required' => 'Tidak boleh kosong',
            'jumlah.numeric' => 'Input harus berupa Angka',
            'jumlah.min' => 'Transaksi Minimal RP. 1000',
            'tanggal.required' => 'tanggal tidak boleh kosong'
        ]);

        $money = new AddFunctModel();
        $money->created_by = Auth::id();
        $money->jumlaj = $validated['jumlah'];
        $money->tanggal_transaksi = $validated['tanggal'];
        $money->keterangan = $validated['keterangan'];
        $money->save();

        return redirect()->back()->with('success', 'Dana Berhasil ditambahkan');
    }

}
