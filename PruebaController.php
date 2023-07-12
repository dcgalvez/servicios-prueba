<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PruebaController extends Controller
{
    public function index()
    {
        $datos = DB::select('select * from empleados');
        $datos = $this->prepararDatos($datos);
        $departamentos = DB::select('SELECT * FROM catalogos WHERE grupo = "departamentos";');
        $municipios = DB::select('SELECT * FROM catalogos WHERE grupo = "municipios";');
        $array = [
            "datos" => $datos,
            "departamentos" => $departamentos,
            "municipios" => $municipios
        ];
        return view("welcome")->with("array", $array);
    }

    private function prepararDatos($datos)
    {
        foreach ($datos as $empleado) {
            $municipioNombre = '';
            $departamentoNombre = '';
            $municipioConsulta = DB::select('SELECT valor FROM catalogos WHERE grupo = "municipios" AND id=' . $empleado->id_municipio . ';');
            $departamentoConsulta = DB::select('SELECT valor FROM catalogos WHERE grupo = "departamentos" AND id=' . $empleado->id_depto . ';');
            foreach ($municipioConsulta as $mun_consulta) {
                $municipioNombre = $mun_consulta->valor;
            }
            foreach ($departamentoConsulta as $dep_consulta) {
                $departamentoNombre = $dep_consulta->valor;
            }
            $empleado->municipio_texto = $municipioNombre;
            $empleado->departamento_texto = $departamentoNombre;
        }
        return $datos;
    }

    public function list($id)
    {
        echo json_encode(DB::table('catalogos')->where('id_padre', $id)->get());
    }

    public function create(Request $request)
    {
        try {
            $sql = DB::insert('INSERT INTO empleados (nombre,apellido,correo,telefono,direccion,id_municipio,id_depto) VALUES (?,?,?,?,?,?,?)', [
                $request->new_empleado,
                $request->new_apellido,
                $request->new_correo,
                $request->new_telefono,
                $request->new_dirrecion,
                $request->new_municipio,
                $request->new_departamento
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }

        $datos = DB::select('select * from empleados');
        $datos = $this->prepararDatos($datos);

        return [
            "status" => 200,
            "mensage" => "Se guardo con exito",
            "data" => $datos
        ];

        // //Mensaje de Respuesta
        // if ($sql == true) {
        //     return back()->with("Correcto", "Los datos fueron ingresados con exito");
        // } else {
        //     return back()->with("Incorrecto", "Error al ingresar los datos");
        // }
    }

    public function update(Request $request)
    {
        try {
            $sql = DB::update('UPDATE empleados SET nombre=?,apellido=?,correo=?,telefono=?,direccion=?,id_municipio=?,id_depto=? WHERE id = ?', [
                $request->new_empleado,
                $request->new_apellido,
                $request->new_correo,
                $request->new_telefono,
                $request->new_dirrecion,
                $request->new_municipio,
                $request->new_departamento,
                $request->new_id
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        $datos = DB::select('select * from empleados');
        $datos = $this->prepararDatos($datos);

        return [
            "status" => 200,
            "mensage" => "Se guardo con exito",
            "data" => $datos
        ];
    }

    public function delete(Request $request)
    {
        try {
            $sql = DB::delete('DELETE FROM empleados WHERE id = ?', [
                $request->new_id
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }

        $datos = DB::select('select * from empleados');
        $datos = $this->prepararDatos($datos);

        return [
            "status" => 200,
            "mensage" => "Se guardo con exito",
            "data" => $datos
        ];
    }

    public function filtro(Request $request)
    {
        // try {
        //     $sql = DB::select('SELECT * FROM empleados WHERE nombre = ?', [
        //         $request->new_empleado,
        //         $request->new_apellido,
        //         $request->new_correo,
        //         $request->new_telefono,
        //         $request->new_dirrecion,
        //         $request->new_municipio,
        //         $request->new_departamento
        //     ]);
        // } catch (\Throwable $th) {
        //     $sql = 0;
        // }
        $filtro_empleado = "";
        if ($request->new_empleado != "") {
            $filtro_empleado = DB::select('SELECT * FROM empleados WHERE nombre = "' . $request->new_empleado . '";');
        }
        if ($request->new_apellido != "") {
            $filtro_empleado = DB::select('SELECT * FROM empleados WHERE apellido = "' . $request->new_apellido . '";');
        }
        if ($request->new_correo != "") {
            $filtro_empleado = DB::select('SELECT * FROM empleados WHERE correo = "' . $request->new_correo . '";');
        }
        if ($request->new_telefono != "") {
            $filtro_empleado = DB::select('SELECT * FROM empleados WHERE telefono = "' . $request->new_telefono . '";');
        }
        if ($request->new_direccion != "") {
            $filtro_empleado = DB::select('SELECT * FROM empleados WHERE direccion = "' . $request->new_direccion . '";');
        }
        if ($request->new_departamento != "") {
            $filtro_empleado = DB::select('SELECT * FROM empleados WHERE id_depto = ' . $request->new_departamento . ';');
        }
        if ($request->new_municipio != "") {
            $filtro_empleado = DB::select('SELECT * FROM empleados WHERE id_municipio = ' . $request->new_municipio . ';');
        }
        
        $filtro_empleado = $this->prepararDatos($filtro_empleado);

        return [
            "status" => 200,
            "mensage" => "Se guardo con exito",
            "data" => $filtro_empleado
        ];
    }

    public function restart(Request $request) {
        $datos = DB::select('select * from empleados');
        $datos = $this->prepararDatos($datos);

        return [
            "status" => 200,
            "mensage" => "Se guardo con exito",
            "data" => $datos
        ];
    }
}
