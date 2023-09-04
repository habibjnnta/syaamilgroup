<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Transaksi;
use App\DetailTransaksi;
use App\Perusahaan;
use App\Barang;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksis = Transaksi::paginate(10);
        return view('admin.transaksi.index', [
            'transaksis' => $transaksis,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perusahaan = Perusahaan::all();
        $barang = Barang::all();
        return view('admin.transaksi.create', [
            'perusahaan' => $perusahaan,
            'barang' => $barang,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'perusahaan_id' => 'required',
            'barang_id' => 'required',
            'jumlah' => 'required',
        ]);

        try {
            DB::beginTransaction();
            
            $count = Transaksi::whereYear('created_at', '=', date('Y'))->count();
            $invoice = date('Ymd');
            $invoice .= sprintf("%04d", $count + 1);
            
            $total = 0;
            foreach($request->barang_id as $key => $value){
                $barang = Barang::find($value);
                if($barang->stok < $request->jumlah[$key]){
                    return redirect()->to(url()->previous())
                        ->with('errorMsg', 'Ada Barang melebihi stok !');
                }else{
                    $total += $request->jumlah[$key] * $barang->harga;
                    DetailTransaksi::create([
                        'no_invoice' => $invoice,
                        'barang_id' => $value,
                        'jumlah' => $request->jumlah[$key],
                        'harga' => $barang->harga,
                    ]);
                    $barang->stok = $barang->stok - $request->jumlah[$key];
                    $barang->save();
                }
            }

            Transaksi::create([
                'no_invoice' => $invoice,
                'perusahaan_id' => $request->perusahaan_id,
                'total' => $total,
            ]);

            DB::commit();
            return redirect()->to(url()->previous())
                ->with('successMsg', 'Transaksi berhasil dilakukan');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::info("errorMsg : " . json_encode($th->getMessage()));
            return redirect()->to(url()->previous())
                ->with('errorMsg', "Server Error");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksi = Transaksi::find($id);
        $detail = DetailTransaksi::where('no_invoice', '=', $transaksi->no_invoice)->paginate(10);
        return view('admin.transaksi.show', [
            'transaksi' => $transaksi,
            'detail' => $detail,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);
        DetailTransaksi::where('no_invoice', $transaksi->no_invoice)->delete();
        if ($transaksi) {
            $transaksi->delete();
            return response()->json([], 200);
        }
        return response()->json([], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function export($id)
    {
        $transaksi = Transaksi::find($id);
        return Excel::download(new TransaksiExport($transaksi->no_invoice), 'transaksi-'.$transaksi->no_invoice.'.xlsx');
    }

}
