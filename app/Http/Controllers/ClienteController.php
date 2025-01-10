<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $clientes = Cliente::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nombre', 'like', "%{$search}%")
                    ->orWhere('apellido', 'like', "%{$search}%")
                    ->orWhere('rut', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('clientes.index', [
            'clientes' => $clientes,
            'search' => $search
        ]);
    }

    public function api()
    {
        $clientes = Cliente::paginate(10);
        return response()->json($clientes);
    }
}
