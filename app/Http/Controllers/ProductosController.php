<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\Audit;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 

class ProductosController extends Controller
{
    
    public function __construct()
    {
        //$this->middleware('auth');
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function index()
    {
        return Productos::get();
    }
    */
    public function index(Request $request)
    {

        $length = $request->input('length');
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $searchValue = $request->input('search');
        $categoria = $request->input('categoria');
        $isActive = $request->input('isActive');

        $query = Productos::eloquentQuery($sortBy, $orderBy, $searchValue);


        if ( $isActive ) {
            if($categoria <> "Todos"){
                $query->where("activo", 1)->where("categoria", 'like' ,'%'.$categoria.'%')->Where(function ($query) use ($searchValue){
                    return $query->Where("precio", 'like' ,'%'. $searchValue .'%')->orWhere("unidad", 'like' ,'%'. $searchValue .'%')->orWhere("nombre", 'like' ,'%'. $searchValue .'%')->get();
                });
            }else{
                $query->where("activo", 1)->Where(function ($query) use ($searchValue){
                    return $query->Where("precio", 'like' ,'%'. $searchValue .'%')->orWhere("unidad", 'like' ,'%'. $searchValue .'%')->orWhere("nombre", 'like' ,'%'. $searchValue .'%')->get();
                });
            }
        }else{
                $query->where("id", 'like' ,'%'.$searchValue.'%')->orWhere("nombre", 'like' ,'%'.$searchValue.'%')->orWhere("precio", 'like' ,'%'.$searchValue.'%')->orWhere("unidad", 'like' ,'%'.$searchValue.'%')->orWhere("categoria", 'like' ,'%'.$searchValue.'%');
        }

        $data = $query->paginate($length);

        return new DataTableCollectionResource($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto = new Productos();
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->unidad = $request->unidad;
        $producto->categoria = $request->categoria;
        
        $destination_path = 'public/assets/productos-img';
        $imagen_name = $producto->nombre . '_' . $request->file('imagen')->getClientOriginalName();
        $path = $request->file('imagen')->storeAs($destination_path, $imagen_name);
        $producto->imagen = $imagen_name;

        if ($producto->save()){
            $entry = new Audit();
            $entry->user = auth()->user()->name;
            $entry->table = "Productos";
            $entry->action = "Crear - ".$producto->id;
            $entry->save();

            return true;
        }else{
            return false;
        }
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
        $producto = Productos::find($id);
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->unidad = $request->unidad;
        $producto->categoria = $request->categoria;

        if($request->hasFile('imagen')){
            File::delete('storage\assets\productos-img/'.$producto->imagen);
            $destination_path = 'public/assets/productos-img';
            $imagen_name = $producto->nombre . '_' . $request->file('imagen')->getClientOriginalName();
            $path = $request->file('imagen')->storeAs($destination_path, $imagen_name);
            $producto->imagen = $imagen_name;
        }       
        if ($producto->save() == 1){
            $entry = new Audit();
            $entry->user = auth()->user()->name;
            $entry->table = "Productos";
            $entry->action = "Editar - ".$producto->id;
            $entry->save();
            
            return true;
        }else{
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imagen = Productos::find($id)->imagen;
        File::delete('storage\assets\productos-img/'.$imagen);
        if (Productos::find($id)->delete()){    
            $entry = new Audit();
            $entry->user = auth()->user()->name;
            $entry->table = "Productos";
            $entry->action = "Eliminar - ".$id;
            $entry->save();
            return true;
        }else{
            return false;
        }
    }

    public function active($id, $value)
    {
        $producto = Productos::find($id);
        $producto->activo =  $value;
        if ($producto->save() == 1){
            return true;
        }else{
            return false;
        }
    }
}
