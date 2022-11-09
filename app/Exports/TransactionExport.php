<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionExport implements FromView
{
    public $transaction;

    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $transactions = $this->transaction;

        return view('transaction.excel', compact('transactions'));
    }
}
