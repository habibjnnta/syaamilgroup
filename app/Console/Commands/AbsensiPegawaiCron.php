<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\AbsensiPegawai;
use App\SettingLibur;
use App\Pegawai;

class AbsensiPegawaiCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'absensi-pegawai:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = date("Y-m-d");
        $pegawais = Pegawai::all();
        $setting_libur = SettingLibur::where("tanggal",">=", $now)->get();
        \Log::info("Run Cron Absensi Pegawai!->".$now);
        foreach ($pegawais as $data) {
            if (!$setting_libur->isEmpty()) {
                $penempatan = explode(",",$data->lembaga_id);
                foreach ($setting_libur as $raw) {
                    if ($raw->tanggal == $now && in_array($raw->lembaga_id, $penempatan)) {
                        AbsensiPegawai::create([
                            'pegawai_id' => $data->id,
                            'tanggal' => $now,
                            'status' => $raw->keterangan,
                        ]);
                    }else{
                        AbsensiPegawai::create([
                            'pegawai_id' => $data->id,
                            'tanggal' => $now,
                        ]);
                    }
                }
            } else{
                AbsensiPegawai::create([
                    'pegawai_id' => $data->id,
                    'tanggal' => $now,
                ]);
            }
        }
    }
}
