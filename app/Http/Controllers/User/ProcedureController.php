<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Procedure;
use Illuminate\Http\Request;

class ProcedureController extends Controller
{
    public function index(): view
    {
        return view('user.procedures.index');
    }

    public function create(): view
    {
        return view('user.procedures.create');
    }

    public function edit(Procedure $procedure): view
    {
        return view('user.procedures.edit', compact('procedure'));
    }
}
