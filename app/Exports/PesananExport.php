<?php

namespace App\Exports;

use App\Model\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Http\Controllers\Excel;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PesananExport implements FromView, ShouldAutoSize
{

    public function __construct($pesanan)
    {
        $this->transaksi = $pesanan;
    }

    public function view(): View
    {
        return view('transaksi.transaksiexport', [
            'transaksi' => $this->transaksi
        ]);
    }
}
