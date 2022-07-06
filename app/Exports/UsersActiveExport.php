<?php
namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersActiveExport implements FromView
{
    public function view(): View
    {
        return view('exports.user', [
            'users' => User::where('is_active', true)->role('Member')->get()
        ]);
    }
}