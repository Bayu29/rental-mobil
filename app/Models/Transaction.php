<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Transaction extends Model
{
    use LogsActivity;
    use HasFactory;

    protected $guarded = ['id'];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
         -> useLogName('log_transaction')
         -> logOnly(['approved1','approved2'])
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
        return "Transaction" .$this->customer_name . " {$eventName} By "  . $user;
    }
}
