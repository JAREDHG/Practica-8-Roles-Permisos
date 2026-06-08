<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Resources\ProductoResource;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $productos = Producto::with('categoria')
            ->buscar($request->busqueda) // [cite: 166]
            ->deCategoria($request->categoria_id) // [cite: 167]
            ->rangoPrecio($request->precio_min, $request->precio_max) // [cite: 168]
            ->orderBy($request->get('orden', 'nombre'), $request->get('dir', 'asc')) // [cite: 169, 170]
            ->paginate($request->get('por_pagina', 15)); // 

        return ProductoResource::collection($productos); // [cite: 172]
    }

    public function store(Request $request)
    {
        $this->authorize('create', Producto::class);
        $request->validate([
            'nombre'  => 'required|string',
            'precio'  => 'required|numeric',
            'imagen'  => 'nullable|image|mimes:jpg,png,webp|max:2048',
        ]);

        $data = $request->except('imagen');

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto = Producto::create($data);
        return new ProductoResource($producto);
    }

    public function show(Producto $producto)
    {
        return new ProductoResource($producto);
    }

    public function update(Request $request, Producto $producto)
    {
        $this->authorize('update', $producto);

        $request->validate([
            'nombre'  => 'sometimes|string',
            'precio'  => 'sometimes|numeric',
            'stock' => 'sometimes|numeric',
            'imagen'  => 'nullable|image|mimes:jpg,png,webp|max:2048',
        ]);

        $data = $request->only(['nombre', 'descripcion', 'precio', 'stock']);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto->update($data);
        return new ProductoResource($producto);
    }

    public function destroy(Producto $producto)
    {
        $this->authorize('delete', $producto);
        $producto->delete();
        return response()->json(null, 204);
    }
}
