<?php

namespace App\Http\Controllers;

use App\Checker;
use App\Jobs\ChecksumWebsite;
use Illuminate\Http\Request;

class CheckerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('checkers', ['checkers' => Checker::all()]);
    }

    public function create(Request $request)
    {
        $checker = Checker::create([
            'user_id'  => $request->user()->id,
            'url'      => $request->url,
        ]);

        ChecksumWebsite::dispatchNow($checker);

        return redirect()
            ->route('checker')
            ->with(['message' => 'Created']);
    }

    public function destroy(Request $request, Checker $checker)
    {
        $checker->delete();

        return redirect()
            ->route('checker')
            ->with(['message' => 'Deleted']);
    }
}
