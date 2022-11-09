<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Driver;
use App\Models\Car;
use App\Models\Transaction;
use App\Models\SettingApp;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Exports\TransactionExport;
use Exception;
use Excel;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:transaction_index')->only('index');
        $this->middleware('permission:transaction_create')->only('create', 'store');
        $this->middleware('permission:transaction_update')->only('edit', 'update');
    }

    public function index()
    {
        if (request()->ajax()) {
            $query = Transaction::with([
                'car',
                'driver',
                'user'
            ])->get();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('car', function($row) {
                    return $row->car->first()->name;
                })
                ->addColumn('driver', function($row) {
                    return $row->driver->first()->name;
                })
                ->addColumn('loan_day', function($row) {
                    $pick_date = Carbon::parse($row->pick_date);
                    $due_date = Carbon::parse($row->due_date);
                    $loan_day = $pick_date->diffInDays($due_date);

                    return $loan_day;
                })
                ->addColumn('status', function($row) {
                    return ucwords($row->status);
                })
                ->addColumn('user', function($row) {
                    return $row->user->first()->name;
                })
                ->addColumn('action', 'transaction._action')
                ->toJson();
        }
        return view('transaction.index');
    }

    public function create()
    {
        $cars = Car::where('status', 'available')
                    ->get();

        $drivers = Driver::where('status', 'available')
                    ->get();

        return view('transaction.create', compact('cars', 'drivers'));
    }

    public function calculation(Request $request)
    {
        $car = Car::find($request->car_id);
        $driver = Driver::find($request->driver_id);

        $pick_date = Carbon::parse($request->pick_date);
        $due_date = Carbon::parse($request->due_date);
        $loan_day = $pick_date->diffInDays($due_date);

        $car_fee = intval($car->fee) * intval($loan_day);
        $driver_fee = intval($driver->fee) * $loan_day;

        $total_charge = $car_fee + $driver_fee;

        return response()->json([
            'car_fee' => $car_fee,
            'driver_fee' => $driver_fee,
            'total_charge' => $total_charge,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string',
            'customer_phone' => 'required|string',
            'customer_address' => 'required|string',
            'customer_destination' => 'required|string',
            'customer_id_card_number' => 'required|string',
            'customer_sim_card_number' => 'required|string',
            'car_id' => 'required|numeric',
            'driver_id' => 'required|numeric',
            'pick_date' => 'required',
            'due_date' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        $pick_date = Carbon::parse($request->pick_date);
        $due_date = Carbon::parse($request->due_date);
        $loan_day = $pick_date->diffInDays($due_date);

        $car = Car::where('id', $request->car_id)->first();
        if (!$car) {
            Alert::toast('Data mobil tidak ditemukan', 'error');
            return redirect()->back->withinput($request->all());
        }

        $car_fee = intval($car->fee) * intval($loan_day);

        $driver = Driver::where('id', $request->driver_id)->first();
        if (!$driver) {
            Alert::toast('Data Driver tidak ditemukan', 'error');
            return redirect()->back()->withInput($request->all());
        }

        $driver_fee = intval($driver->fee) * $loan_day;

        $total_charge = $car_fee + $driver_fee;

        $transaction = Transaction::create([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'customer_destination' => $request->customer_destination,
            'customer_id_card_number' => $request->customer_id_card_number,
            'customer_sim_card_number' => $request->customer_sim_card_number,
            'car_id' => $request->car_id,
            'driver_id' => $request->driver_id,
            'pick_date' => $request->pick_date,
            'due_date' => $request->due_date,
            'car_fee' => $car_fee,
            'driver_fee' => $driver_fee,
            'total_charge' => $total_charge,
            'user_id' => auth()->user()->id
        ]);

        if ($transaction) {
            Alert::toast('Data saved successfully', 'success');
            return redirect()->route('transaction.edit', $transaction->id);
        } else {
            Alert::toast('Data failed to save', 'error');
            return redirect()->route('transaction.index');
        }
    }

    public function edit($id)
    {
        $cars = Car::where('status', 'available')->get();
        $drivers = Driver::where('status', 'available')->get();
        $transaction = Transaction::findOrFail($id);

        return view('transaction.edit', compact('cars', 'drivers', 'transaction'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string',
            'customer_phone' => 'required|string',
            'customer_address' => 'required|string',
            'customer_destination' => 'required|string',
            'customer_id_card_number' => 'required|string',
            'customer_sim_card_number' => 'required|string',
            'car_id' => 'required|numeric',
            'driver_id' => 'required|numeric',
            'pick_date' => 'required',
            'due_date' => 'required',
            'car_status' => 'required|string|in:unpickup,returned,unreturn',
            'transaction_status' => 'required|string|in:unpaid,paid,canceled,refund',
            'approved1' => 'required|string|in:pending,approved,rejected',
            'approved2' => 'string|in:pending,approved,rejected'
        ]);



        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        $setting = SettingApp::first();
        $pick_date = Carbon::parse($request->pick_date);
        $due_date = Carbon::parse($request->due_date);
        $loan_day = $pick_date->diffInDays($due_date);

        if (isset($request->return_date)) {
            $late_days = $pick_date->diffInDays($request->return_date);
        } else {
            $late_days = 0;
        }

        $car = Car::findOrFail($request->car_id);
        $car_fee = intval($car->fee) * intval($loan_day);

        $driver = Driver::findOrFail($request->driver_id);
        $driver_fee = intval($driver->fee) * $loan_day;

        $late_charge = 0;

        if ($late_days > $loan_day) {
            $late_days =- $loan_day;

            if ($late_days < 0) {
                $late_days = 1;
            }

            $late_charge = intval($late_days) * intval($setting->late_fee);
        }

        $total_charge = $car_fee + $driver_fee + $late_charge;

        $transaction = Transaction::findOrFail($id);

        DB::beginTransaction();
        try {

            $payload = [
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'customer_destination' => $request->customer_destination,
                'customer_id_card_number' => $request->customer_id_card_number,
                'customer_sim_card_number' => $request->customer_sim_card_number,
                'car_id' => $request->car_id,
                'driver_id' => $request->driver_id,
                'pick_date' => $request->pick_date,
                'due_date' => $request->due_date,
                'car_status' => $request->car_status,
                'status' => $request->status,
                'car_fee' =>  $car_fee,
                'driver_fee' =>  $driver_fee,
                'late_charge' => $late_charge,
                'total_charge' => $total_charge,
                'user_id' => auth()->user()->id,
                'car_status' => $request->car_status,
                'status' => $request->transaction_status,
                'approved1' => $request->approved1
            ];

            if (isset($request->return_date)) {
                $payload['return_date'] = $request->return_date;
            }

            if (isset($request->approved2)) {
                $payload['approved2'] = $request->approved2;
            }

            $transaction->update($payload);

            if ($transaction) {
                Alert::toast('Data Successfully updated', 'success');
                return redirect()->route('transaction.index');
            }
        } catch (Exception $e) {
            Alert::toast('Data Failed to save', 'error');
            return redirect()->route('transaction.index');
        } finally {
            DB::commit();
        }
    }

    public function report()
    {
        $start_month = Carbon::now()->firstOfMonth()->hour(00)->minute(00)->second(00);
        $end_month =  Carbon::now()->lastOfMonth()->hour(23)->minute(59)->second(59);

        return view('transaction.laporan', compact('start_month', 'end_month'));
    }

    public function export_excel(Request $request)
    {
        $dates = explode(' to ', $request->date);

        $start = str_replace(',', '', $dates[0]).' 00:00:00';
        $end   = str_replace(',', '', $dates[1]).' 23:59:59';

        $start_date = date('Y-m-d H:i:s', strtotime($start));
        $end_date = date('Y-m-d H:i:s', strtotime($end));

        $transaction = Transaction::with([
                'car',
                'driver',
                'user'
            ])
            ->whereBetween('created_at', [$start_date, $end_date])
            ->get();

        return Excel::download(new TransactionExport($transaction), 'transaction-report-period '.$request->date.'.xlsx');
    }
}
