<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Driver extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
         -> useLogName('log_driver')
         -> logOnly(['name', 'number_sim_card', 'gender', 'birthday_day', 'status', 'fee'])
         -> logOnlyDirty()
         -> dontSubmitEmptyLogs();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        if (isset(Auth::user()->name)) {
            $user = Auth::user()->name;
        } else {
            $user = "Super Admin";
        }
        return "Driver" .$this->name . " {$eventName} By "  . $user;
    }
}
