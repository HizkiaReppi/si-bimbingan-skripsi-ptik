<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\Component;
use Illuminate\View\View;

class DashboardLayout extends Component
{
    public function __construct(public $title = null)
    {
        //
    }
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $user = Auth::user();
        
        $isUsernameAndPasswordSame = false;
        if ($user && Hash::check($user->username, $user->password)) {
            $isUsernameAndPasswordSame = true;
        }

        return view('layouts.dashboard', compact('isUsernameAndPasswordSame'));
    }
}
