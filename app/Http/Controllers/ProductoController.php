<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
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
        $input = $request->all();
        $input['user_id'] = 1;
        $producto = Producto::create($input);

        return \response()->json(['res' => true, 'message' => 'insertado correctamente'], 200);
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
    public function update(UpdateProductoRequest $request, $id)
    {
        //update producto set nombre $request .... where id = $id
        $input = $request->all();
        $producto = Producto::find($id);
        $producto->update($input);

        return \response()->json(['res' => true, 'message' => 'modificado correctamente'], 200);
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

    public function setLike($id){
        $producto = Producto::find($id);
        $producto->like = $producto->like + 1;
        $producto->save();
        return \response()->json(['res' => true, 'message' => 'el like se incremento de 1'], 200);
    }

    public function setDislike($id){
        $producto = Producto::find($id);
        $producto->dislike = $producto->dislike + 1;
        $producto->save();
        return \response()->json(['res' => true, 'message' => 'el dislike se incremento de 1'], 200);
    }

    public function setImagen(Request $request, $id){
        $producto = Producto::findOrFail($id);
        $producto->url_imagen = $this->cargarImagen($request->imagen, $id);
        $producto->save();

        return \response()->json(['res' => true, 'message' => 'se subio la imagen'], 200);
    }

    private function cargarImagen($file, $id){
        $nombreArchivo = time() . "_{$id}." . $file->getClientOriginalExtension();
        $file->move(\public_path('imagenes'), $nombreArchivo);
        return $nombreArchivo;
    }
}
