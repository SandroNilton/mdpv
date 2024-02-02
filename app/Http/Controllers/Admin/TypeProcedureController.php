<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\TypeProcedure;
use Illuminate\Http\Request;

class TypeProcedureController extends Controller
{
    public function index(): view
    {
        return view('admin.type_procedures.index');
    }

    public function create(): view
    {
        return view('admin.type_procedures.create');
    }

    public function edit(TypeProcedure $type_procedure): view
    {
        return view('admin.type_procedures.edit', compact('type_procedure'));
    }
}
