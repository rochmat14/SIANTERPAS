<?php

namespace App\Http\Traits;

use App\LogActivity;

trait SavedLogActivity
    {
        public function savedLog($action,$id_activity,$modul,$location,$note)
        {
            $log                = new LogActivity();
            $log->id_user       = auth()->user()->id ?? null;
            $log->modul         = $modul;
            $log->id_activity   = $id_activity ?? null;
            $log->action        = $action;
            $log->location      = $location;
            $log->note          = $note;
            $log->save();
        }
    }
