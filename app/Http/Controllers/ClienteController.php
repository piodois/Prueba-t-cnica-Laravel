<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Resources\ClienteResource;
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

    public function api(Request $request)
    {
        try {
            $search = $request->query('search');

            $clientes = Cliente::query()
                ->when($search, function ($query) use ($search) {
                    $query->where('nombre', 'like', "%{$search}%")
                        ->orWhere('apellido', 'like', "%{$search}%")
                        ->orWhere('rut', 'like', "%{$search}%");
                })
                ->paginate(10);

            return ClienteResource::collection($clientes)
                ->additional([
                    'meta' => [
                        'total' => $clientes->total(),
                        'current_page' => $clientes->currentPage(),
                        'last_page' => $clientes->lastPage(),
                        'per_page' => $clientes->perPage(),
                    ],
                    'links' => [
                        'next' => $clientes->nextPageUrl(),
                        'prev' => $clientes->previousPageUrl(),
                        'first' => $clientes->url(1),
                        'last' => $clientes->url($clientes->lastPage()),
                    ]
                ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener los datos',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
