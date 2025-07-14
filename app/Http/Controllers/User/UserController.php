<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\AddFunctModel;
use App\Models\User\TransactionModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use function App\Helpers\path_view;

class UserController extends Controller
{
    public function user(){

        $users = Auth::user();
        $divisi = $users->divisi;
        $totalAproval = TransactionModel::where('status', 'approved')
        ->where('user_id', Auth::id())
        ->sum('total_disetujui');

        $transactions = TransactionModel::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();

        $startDate = Carbon::now()->subMonths(5)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $incomePerMonth = AddFunctModel::selectRaw('MONTH(tanggal_masuk) as month, SUM(jumlah) as total')
            ->where('created_by', Auth::id())
            ->whereBetween('tanggal_masuk', [$startDate, $endDate])
            ->groupBy('month')
            ->pluck('total', 'month');

        $expensePerMonth = TransactionModel::where('status', 'approved')
            ->where('user_id', Auth::id())
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

        $view = path_view('User.dashboard-user');
        return view($view, compact('divisi', 'transactions', 'totalAproval', 'monthlyData', 'months'));
    }
}
