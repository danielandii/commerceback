<?php

namespace App\Exports;

use App\Model\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PenjualanExport implements FromView, ShouldAutoSize
{
    public function __construct($penjualan)
    {
        $this->transaksi = $penjualan;
    }

    public function view(): View
    {
        return view('transaksi.transaksiexport', [
            'transaksi' => $this->transaksi
        ]);
    }
}
