<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Driver;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;

class DriverController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:driver_index')->only('index');
        $this->middleware('permission:driver_create')->only('create', 'store');
        $this->middleware('permission:driver_update')->only('edit', 'update');
        $this->middleware('permission:driver_delete')->only('delete');
    }

    public function index()
    {
        if (request()->ajax()) {
            $query = Driver::query();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action', 'driver._action')
                ->toJson();
        }
        return view('driver.index');
    }

    public function add()
    {
        return view('driver.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'number_sim_card' => 'required|string',
            'gender' => 'required|in:male,female',
            'birthday' => 'required',
            'phone' => 'required|string|regex:/[0-9]+/im',
            'address' => 'required|string',
            'status' => 'required|in:available,non_available',
            'fee' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        $driver = Driver::create([
            'name' => $request->name,
            'number_sim_card' => $request->number_sim_card,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'status' => $request->status,
            'phone'=> $request->phone,
            'address' => $request->address,
            'fee' => $request->fee
        ]);

        if ($driver) {
            Alert::toast('Data successfully saved', 'success');
            return redirect()->route('driver.index');
        } else {
            Alert::toast('Data failed to save', 'error');
            return redirect()->route('driver.index');
        }
    }

    public function edit($id)
    {
        $driver = Driver::findOrFail($id);

        return view('driver.edit', compact('driver'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'number_sim_card' => 'required|string',
            'gender' => 'required|in:male,female',
            'birthday' => 'required',
            'phone' => 'required|string|regex:/[0-9]+/im',
            'address' => 'required|string',
            'status' => 'required|in:available,non_available',
            'fee' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        $driver = Driver::findOrFail($id);

        DB::beginTransaction();
        try {
            $driver->update([
                'name' => $request->name,
                'number_sim_card' => $request->number_sim_card,
                'gender' => $request->gender,
                'birthday' => $request->birthday,
                'status' => $request->status,
                'phone'=> $request->phone,
                'address' => $request->address,
                'fee' => $request->fee
            ]);

            if ($driver) {
                Alert::toast('Data Successfully saved', 'success');
                return redirect()->route('driver.index');
            }
        } catch (Exception $e) {
            Alert::toast('Data Failed to save', 'error');
            return redirect()->route('driver.index');
        } finally {
            DB::commit();
        }
    }

    public function delete($id) {
        $car = Driver::findOrFail($id);

        try {
            if ($car->delete()) {
                Alert::toast('Data deleted successfully', 'success');
                return redirect()->route('car.index');
            } else {
                Alert::toast('Data failed to delete', 'error');
                return redirect()->route('car.index');
            }
        } catch (Exception $e) {
            Alert::toast('Data failed to delete, already related', 'error');
            return redirect()->back();
        }
    }

}
