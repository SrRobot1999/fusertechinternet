<?php

namespace App\Http\Controllers;

use App\Models\Base;
use Illuminate\Http\Request;

class BaseController extends Controller
{
        public function index()
    {
        $bases = Base::all();
        return view('bases.showbase', compact('bases'));
    }

    public function destroy($id)
    {
        $base = Base::findOrFail($id);
        $base->delete();
        return redirect()->back()->with('success', 'Registro eliminado correctamente.');
    }
}
