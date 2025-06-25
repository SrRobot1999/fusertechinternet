<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class NotificationsController extends Controller
{
    public function showNotification()
    {
        $fechaActual = Carbon::now()->toDateString();
        $data = DB::select("CALL sp_get_notification(?)", [$fechaActual]);
        return response()->json(['data' => $data]);
    }
}
