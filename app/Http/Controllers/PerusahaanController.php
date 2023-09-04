<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Perusahaan;
use App\Transaksi;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perusahaans = Perusahaan::paginate(10);
        return view('admin.perusahaan.index', [
            'perusahaans' => $perusahaans,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nama' => 'required|unique:perusahaans,nama',
        ]);

        try {
            DB::beginTransaction();
            $perusahaan = Perusahaan::create($request->all());
            DB::commit();
            return redirect()->to(url()->previous())
                ->with('successMsg', 'Perusahaan berhasil ditambahkan');
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
        //
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
        $perusahaan = Perusahaan::find($id);

        $request->validate([
            'nama' => 'required',
        ]);

        try {
            $perusahaan->update($request->all());

            return redirect()->to(url()->previous())
                ->with('successMsg', 'Update Berhasil');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::info("errorMsg : " . json_encode($th->getMessage()));
            return redirect()->to(url()->previous())
                ->with('errorMsg', "Server Error");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perusahaan = Perusahaan::find($id);
        $transaksi = Transaksi::where('perusahaan_id', $id)->count();
        if($transaksi > 0){
            return response()->json([
                'msg' => 'Perusahaan relation in transaction'
            ], 500);
        }
        if ($perusahaan) {
            $perusahaan->delete();
            return response()->json([], 200);
        }
        return response()->json([], 404);
    }
}
