<?php

namespace App\Lib;

class Kalender
{

  const NAMA_BULAN = [
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember',
  ];

  /**
   * @param string m format bulan
   * @return string nama bulan
   */
  public static function toBulan($bulanNumber)
  {
    try {
        return static::NAMA_BULAN[$bulanNumber];
    } catch (\Throwable $th) {
        return $bulanNumber;
    }
  }

}
