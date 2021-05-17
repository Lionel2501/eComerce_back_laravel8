<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->all();

        $productos = Producto::with('user:id,email,name')
            ->where('nombre', 'like', "%{$request->buscar}%")
            ->orWhere('codigo', 'like', "%{$request->buscar}%")
            ->get();
        return \response()->json($productos, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::with('user:id,email,name')->find($id);
        return \response()->json($producto, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Producto::destroy($id);
            return \response()->json(['res' => true, 'message' => 'eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return \response()->json(['res' => false, 'message' => $e->getMessage()], 200);
        }
    }
}
