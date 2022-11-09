<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;

class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:car_index')->only('index');
        $this->middleware('permission:car_create')->only('create', 'store');
        $this->middleware('permission:car_update')->only('edit', 'update');
        $this->middleware('permission:car_delete')->only('delete');
    }

    public function index()
    {
        if (request()->ajax()) {
            $query = Car::query();
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action', 'car._action')
                ->toJson();
        }
        return view('car.index');
    }

    public function add()
    {
        return view('car.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'color' => 'required|string',
            'police_number' => 'required|string',
            'cc' => 'required|string',
            'capacity' => 'required',
            'year' => 'required',
            'type' => 'required|in:manual,matic',
            'status' => 'required|in:available,non_available,repaired',
            'fee' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        $car = Car::create([
            'name' => $request->name,
            'color' => $request->color,
            'police_number' => $request->police_number,
            'cc' => $request->cc,
            'capacity' => $request->capacity,
            'year' => $request->year,
            'type' => $request->type,
            'status' => $request->status,
            'fee' => $request->fee
        ]);

        if ($car) {
            Alert::toast('Data saved successfully', 'success');
            return redirect()->route('car.index');
        } else {
            Alert::toast('Data failed to save', 'error');
            return redirect()->back('car.index');
        }
    }

    public function edit($id)
    {
        $car = Car::findOrFail($id);

        return view('car.edit', compact('car'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'color' => 'required|string',
            'police_number' => 'required|string',
            'cc' => 'required|string',
            'capacity' => 'required',
            'year' => 'required',
            'type' => 'required|in:manual,matic',
            'status' => 'required|in:available,non_available,repaired',
            'fee' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        $car = Car::findOrFail($id);

        DB::beginTransaction();
        try {
            $car->update([
                'name' => $request->name,
                'color' => $request->color,
                'police_number' => $request->police_number,
                'cc' => $request->cc,
                'capacity' => $request->capacity,
                'year' => $request->capacity,
                'type' => $request->type,
                'status' => $request->status,
                'fee' => $request->fee,
            ]);

            if ($car) {
                Alert::toast('Data Successfully updated', 'success');
                return redirect()->route('car.index');
            } else {
                Alert::toast('Data Failed updated', 'error');
                return redirect()->route('car.index');
            }
        } catch(Exception $e) {
            //\Log::error($e);
            DB::rollBack();
            Alert::toast('Data Failed updated', 'error');
            return redirect()->route('car.index');
        } finally {
            DB::commit();
        }
    }

    public function delete($id) {
        $car = Car::findOrFail($id);

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
