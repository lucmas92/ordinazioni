<?php

namespace Lucmas\Reservations\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Metodo per la scrittura di file di log nelle operazioni rilevanti
     * @param String $message
     */
    protected function writelog(String $message)
    {
        logger(Auth::user()->username . ' ' . $message);
    }

}
