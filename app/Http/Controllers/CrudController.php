<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrudController extends Controller
{
    public function index()
    {
        $datos = DB::select("SELECT * FROM servicios");
        $datos = $this->prepararDatos($datos);
        return view("welcome")->with("datos", $datos);
    }
    
    private function prepararDatos($datos)
    {
        $num = 1;
        foreach ($datos as $servicio) {
            $servicio->num = $num++;
        }
        return $datos;
    }
    
    public function create(Request $request)
    {
        try {
            $sql = DB::insert("INSERT INTO servicios (product_name,product_price,product_amount) VALUES (?,?,?);", [
                $request->txtnombre,
                $request->txtprecio,
                $request->txtcantidad
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }

        //Mensaje de Respuesta

        if ($sql == true) {
            return back()->with("Correcto", "Producto insertado correctamente");
        } else {
            return back()->with("Incorrecto", "Error al insertar");
        }
    }

    public function update(Request $request)
    {
        try {
            $sql = DB::update("UPDATE servicios SET product_name = ?,product_price = ?,product_amount = ? WHERE product_id = ?;", [
                $request->txtnombre,
                $request->txtprecio,
                $request->txtcantidad,
                $request->txtcodigo,
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        //Mensaje de Respuesta

        if ($sql == true) {
            return back()->with("Correcto", "Producto modificado correctamente");
        } else {
            return back()->with("Incorrecto", "Error al modificar");
        }
    }

    public function delete($id)
    {

        try {
            $sql = DB::delete("DELETE FROM servicios WHERE product_id = $id");
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == true) {
            return back()->with("Correcto", "Producto eliminado con exito");
        } else {
            return back()->with("Incorrecto", "Error al eliminar producto");
        }
    }
}
