<?php
namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersUnactiveExport implements FromView
{
    public function view(): View
    {
        $data = User::where('is_active', false)->role('Member')->whereYear('date_of_birth', '>=', now()->subYears(env('MAX_AGE'))->year)->get();
        return view('exports.user', [
            'users' => $data
        ]);
    }
}