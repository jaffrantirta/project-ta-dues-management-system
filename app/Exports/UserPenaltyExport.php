<?php

namespace App\Exports;

use App\Models\UserPenalty;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UserPenaltyExport implements FromView
{
    public function view(): View
    {
        return view('exports.penalty', [
            'penalties' => UserPenalty::with('user')->get()
        ]);
    }
}
