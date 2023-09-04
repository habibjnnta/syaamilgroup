<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\DetailTransaksi;

class TransaksiExport implements FromCollection
{
    public $no_invoice;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($no_invoice)
    {
        $this->no_invoice = $no_invoice;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DetailTransaksi::join('transaksis','transaksis.no_invoice', '=', 'detail_transaksis.no_invoice')
                ->join('perusahaans','perusahaans.id', '=', 'transaksis.perusahaan_id')
                ->join('barangs','barangs.id', '=', 'detail_transaksis.barang_id')
                ->select(
                    "transaksis.no_invoice as no invoice",
                    "perusahaans.nama as nama perusahaan",
                    "barangs.nama as nama barang",
                    "detail_transaksis.jumlah as jumlah",
                    "detail_transaksis.harga as harga",
                    "transaksis.total as total",
                )
                ->where('detail_transaksis.no_invoice', '=', $this->no_invoice)->get();
    }
}
