<?php

namespace App\Http\Controllers;

use App\Pembayaran;
use App\Siswa;
use App\User;
use App\WebConfig;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function notifSuccess($message)
    {
        Session::flash('successMsg', $message);
    }

    public function notifInfo($message)
    {
        Session::flash('infoMsg', $message);
    }

    public function notifWarning($message)
    {
        Session::flash('warningMsg', $message);
    }

    public function notifError($message)
    {
        Session::flash('errorMsg', $message);
    }
}
