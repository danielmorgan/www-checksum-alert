<?php

namespace App\Http\Controllers;

use App\Checker;
use Illuminate\Http\Request;

class CheckerController extends Controller
{
    public function create(Request $request)
    {
        $checker = Checker::create([
            'user_id' => $request->user_id,
            'url' => $request->url,
        ]);

        return redirect()
            ->route('checker')
            ->with(compact('checker'));
    }
}
