<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $start = Carbon::now()->firstOfMonth();
        $end = Carbon::now()->endOfMonth();

        $car_chart = DB::table('transactions')
            ->select(
                DB::raw('COUNT(transactions.id) as total_pemakaian'),
                DB::raw('cars.name as car_name'),
            )->join('cars', 'transactions.car_id', '=', 'cars.id')
            ->where('transactions.status', 'paid')
            ->where('approved1', 'approved')
            ->where('approved2', 'approved')
            ->whereBetween('transactions.created_at', [$start, $end])
            ->groupBy('car_name')
            ->orderBy('total_pemakaian', 'ASC')
            ->get();

        return view('dashbaord.index', compact('car_chart', 'start', 'end'));
    }

    public function car_chart(Request $request)
    {
        $start = $request->start_date;
        $end = $request->end_date;

        if ($start) {
            $start = str_replace(',', '', $request->start_date).' 00:00:00';
            $start_date = date('Y-m-d H:i:s', strtotime($start));
        }

        if ($end) {
            $end = str_replace(',', '', $request->end_date).' 23:59:59';
            $end_date = date('Y-m-d H:i:s', strtotime($end));
        }

        $car_chart = DB::table('transactions')
            ->select(
                DB::raw('COUNT(transactions.id) as y'),
                DB::raw('cars.name as x'),
            )->join('cars', 'transactions.car_id', '=', 'cars.id')
            ->where('transactions.status', 'paid')
            ->where('approved1', 'approved')
            ->where('approved2', 'approved')
            ->whereBetween('transactions.created_at', [$start_date, $end_date])
            ->groupBy('x')
            ->orderBy('y', 'ASC')
            ->get();

        return response()->json($car_chart);
    }
}
