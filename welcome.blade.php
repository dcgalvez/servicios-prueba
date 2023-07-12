<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="sweetalert2.min.css">
    <title>prueba-david_cordova</title>
</head>

<body>
    <h1 class="text-center p-3">Laravel Prueba</h1>

    @if (session("Correcto"))
    <div class="alert alert-success">{{session("Correcto")}}</div>
    @endif

    @if (session("Incorrecto"))
    <div class="alert alert-danger">{{session("Incorrecto")}}</div>
    @endif

    <script>
        let municipios = JSON.parse('{!! json_encode($array["municipios"]) !!}');
        let empleados = JSON.parse('{!! json_encode($array["datos"]) !!}');
    </script>

    <div class="p-3">

        <div class="row">
            <div class="mb-3 col-3">
                <label for="nombre_emp" class="form-label">Nombres</label>
                <input type="input" class="form-control" id="nombre_filtro" aria-describedby="nombreempleado" name="new_empleado" required>
            </div>
            <div class="mb-3 col-3">
                <label for="apellido_emp" class="form-label">Apellidos</label>
                <input type="input" class="form-control" id="apellido_filtro" aria-describedby="nombreempleado" name="new_apellido" required>
            </div>



            <div class="mb-3 col-3">
                <label for="correo_emp" class="form-label">Correo</label>
                <input type="email" class="form-control" id="correo_filtro" aria-describedby="nombreempleado" name="new_correo" required>
            </div>
            <div class="mb-3 col-3">
                <label for="telefono_emp" class="form-label">Telefono</label>
                <input type="input" class="form-control" maxlength="8" id="telefono_filtro" aria-describedby="nombreempleado" name="new_telefono" required>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-4">
                <label for="direccion_emp" class="form-label">Dirreccion</label>
                <input type="text" class="form-control" id="direccion_filtro" aria-describedby="nombreempleado" name="new_dirrecion" required>
            </div>

            <div class="mb-3 col-4">

                <label for="#n_depto" class="form-label">Departamento</label>
                <select class="form-select mb-3" name="new_departamento" id="nuevo_departamento3" placeholder="Seleccionar una categoria" required>
                    <option value=""> Selecciona una categoria</option>
                    @foreach ($array['departamentos'] as $dept)
                    <option value="{{$dept->id}}">{{ucfirst($dept->valor)}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col-4">
                <label for="#" class="form-label">Municipio</label>
                <select class="form-select mb-3" name="new_municipio" id="nuevo_municipio3" required>
                </select>
            </div>

        </div>
        <button type="button" class="btn btn-success m-2" id="btn_filtro"> Buscar </button>
        <button type="button" class="btn btn-warning m-2" id="btn_restart"><i class="bi bi-arrow-clockwise"></i></button>

        <!-- Activacion Modal -->
        <button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#registro_nuevo"> Nuevo </button>

        <!-- Modal Registrar -->
        <div class="modal fade" id="registro_nuevo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Empleado</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="new_empleado" class="form-label">Nombres</label>
                                    <input type="input" class="form-control" id="new_empleado" aria-describedby="nombreempleado" name="new_empleado" required>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="new_apellido" class="form-label">Apellidos</label>
                                    <input type="input" class="form-control" id="new_apellido" aria-describedby="nombreempleado" name="new_apellido" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-8">
                                    <label for="new_correo" class="form-label">Correo</label>
                                    <input type="email" class="form-control" id="new_correo" aria-describedby="nombreempleado" name="new_correo" required>
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="new_telefono" class="form-label">Telefono</label>
                                    <input type="input" class="form-control" maxlength="8" id="new_telefono" aria-describedby="nombreempleado" name="new_telefono" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="new_dirrecion" class="form-label">Dirreccion</label>
                                <input type="text" class="form-control" id="new_dirrecion" aria-describedby="nombreempleado" name="new_dirrecion" required>
                            </div>

                            <div class="row">


                                <label for="#n_depto">Departamento</label>
                                <select class="form-select form-select-sm mb-3" name="new_departamento" id="nuevo_departamento" placeholder="Seleccionar una categoria" required>
                                    <option value=0> Selecciona una categoria</option>
                                    @foreach ($array['departamentos'] as $dept)
                                    <option value="{{$dept->id}}">{{ucfirst($dept->valor)}}</option>
                                    @endforeach
                                </select>


                                <label for="#">Municipio</label>
                                <select class="form-select form-select-sm mb-3" name="new_municipio" id="nuevo_municipio" required>
                                </select>

                                <!-- @foreach ($array['municipios'] as $municipios)

                                <option value="{{$municipios->id}}">{{$municipios->valor}} {{$municipios->id}}</option>

                                @endforeach -->
                                </select>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" id="btn_registrar">Registrar</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <table class="table table-dark table-striped-columns m-2" id="tabla_pruebas">
            <thead>
                <tr>
                    <th scope="col">Nombres</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Departamento</th>
                    <th scope="col">Municipio</th>
                    <th scope="col">Acciones</th>
                </tr>

            </thead>
            <tbody id="tabla_body">
                @foreach ($array['datos'] as $info)
                <tr>
                    <th scope="col">{{$info->nombre}}</th>
                    <th scope="col">{{$info->apellido}}</th>
                    <th scope="col">{{$info->correo}}</th>
                    <th scope="col">{{$info->telefono}}</th>
                    <th scope="col">{{$info->direccion}}</th>
                    <th scope="col">{{$info->departamento_texto}}</th>
                    <th scope="col">{{$info->municipio_texto}}</th>
                    <th scope="col">
                        <button type="button" id="btnEditar" data-codigo="{{$info->id}}" class="btn btn-warning"><i class="bi bi-pencil-square"></i></button>
                        <button type="button" id="btnEliminar" data-codigo="{{$info->id}}" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a>
                    </th>
                </tr>

                <!-- Modal Actualizar -->
                <div class="modal fade" id="modificar_registro_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Empleado</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{route('prueba.update')}}">
                                    @csrf
                                    <input type="text" name="new_id" id="id_emp" hidden>
                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <label for="nombre_emp" class="form-label">Nombres</label>
                                            <input type="input" class="form-control" id="nombre_emp" aria-describedby="nombreempleado" name="new_empleado" required>
                                        </div>
                                        <div class="mb-3 col-6">
                                            <label for="apellido_emp" class="form-label">Apellidos</label>
                                            <input type="input" class="form-control" id="apellido_emp" aria-describedby="nombreempleado" name="new_apellido" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3 col-8">
                                            <label for="correo_emp" class="form-label">Correo</label>
                                            <input type="email" class="form-control" id="correo_emp" aria-describedby="nombreempleado" name="new_correo" required>
                                        </div>
                                        <div class="mb-3 col-4">
                                            <label for="telefono_emp" class="form-label">Telefono</label>
                                            <input type="input" class="form-control" maxlength="8" id="telefono_emp" aria-describedby="nombreempleado" name="new_telefono" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="direccion_emp" class="form-label">Dirreccion</label>
                                        <input type="text" class="form-control" id="direccion_emp" aria-describedby="nombreempleado" name="new_dirrecion" required>
                                    </div>

                                    <div class="row">


                                        <label for="#n_depto">Departamento</label>
                                        <select class="form-select form-select-sm mb-3" name="new_departamento" id="nuevo_departamento2" placeholder="Seleccionar una categoria" required>
                                            <option value=""> Selecciona una categoria</option>
                                            @foreach ($array['departamentos'] as $dept)
                                            <option value="{{$dept->id}}">{{ucfirst($dept->valor)}}</option>
                                            @endforeach
                                        </select>


                                        <label for="#">Municipio</label>
                                        <select class="form-select form-select-sm mb-3" name="new_municipio" id="nuevo_municipio2" required>
                                        </select>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary" id="btn_actualizar">Actualizar</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>


                @endforeach
            </tbody>
        </table>

        <!-- <script>
        
        $(document).on('change','#n_depto', function (e) {
            console.log(this.val)
        });
    </script> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="sweetalert2.min.js"></script>

        <script>
            $(document).on('click', '#btn_registrar', function(event) {
                event.preventDefault();

                var formData = {
                    new_empleado: $("#new_empleado").val(),
                    new_apellido: $("#new_apellido").val(),
                    new_correo: $("#new_correo").val(),
                    new_telefono: $("#new_telefono").val(),
                    new_dirrecion: $("#new_dirrecion").val(),
                    new_municipio: $("#nuevo_municipio").val(),
                    new_departamento: $("#nuevo_departamento").val(),
                };

                console.log(formData);

                enviar_ajax(formData, "/registrar_empleado");

                Swal.fire(
                    'Exito!',
                    'Se ha guardado Correctamente',
                    'success'
                )

                $('#registro_nuevo').modal('hide');



            });

            $(document).on('click', '#btn_filtro', function(event) {
                event.preventDefault();

                var formData = {
                    new_empleado: $("#nombre_filtro").val(),
                    new_apellido: $("#apellido_filtro").val(),
                    new_correo: $("#correo_filtro").val(),
                    new_telefono: $("#telefono_filtro").val(),
                    new_dirrecion: $("#direccion_filtro").val(),
                    new_municipio: $("#nuevo_municipio3").val(),
                    new_departamento: $("#nuevo_departamento3").val(),
                };

                console.log(formData);

                enviar_ajax(formData, "/buscar_empleado");
            });

            $(document).on('click', '#btn_restart', function(event) {
                event.preventDefault();

                enviar_ajax({}, "/resetear_empleados");
            });

            $(document).on('click', '#btn_actualizar', function(event) {
                event.preventDefault();

                var formData_act = {
                    new_empleado: $("#nombre_emp").val(),
                    new_apellido: $("#apellido_emp").val(),
                    new_correo: $("#correo_emp").val(),
                    new_telefono: $("#telefono_emp").val(),
                    new_dirrecion: $("#direccion_emp").val(),
                    new_municipio: $("#nuevo_municipio2").val(),
                    new_departamento: $("#nuevo_departamento2").val(),
                    new_id: $("#id_emp").val()
                };

                console.log(formData_act);

                enviar_ajax(formData_act, "/modificar_empleado");

                Swal.fire(
                    'Exito!',
                    'Se ha guardado Correctamente',
                    'success'
                )

                $('#modificar_registro_modal').modal('hide');
            });

            $(document).on('click', '#btnEditar', function() {
                console.log(this.dataset.codigo)
                const id = this.dataset.codigo;
                const encontrarEmpleado = empleados.find(empleado => (empleado.id == id));
                if (encontrarEmpleado) {
                    $('#id_emp').val(encontrarEmpleado.id);
                    $('#nombre_emp').val(encontrarEmpleado.nombre);
                    $('#apellido_emp').val(encontrarEmpleado.apellido);
                    $('#correo_emp').val(encontrarEmpleado.correo);
                    $('#telefono_emp').val(encontrarEmpleado.telefono);
                    $('#direccion_emp').val(encontrarEmpleado.direccion);
                    $('#nuevo_departamento2').val(`${encontrarEmpleado.id_depto}`);
                    cambiarMunicipio(encontrarEmpleado.id_depto, true);
                    $('#nuevo_municipio2').val(`${encontrarEmpleado.id_municipio}`);
                    $('#modificar_registro_modal').modal('show');
                }
            });

            $(document).on('click', '#btnEliminar', function(event) {
                event.preventDefault();

                Swal.fire({
                    title: 'Estas seguro de eliminar?',
                    text: "No podras revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const id = this.dataset.codigo;

                        var formData_del = {
                            new_id: id
                        };

                        console.log(formData_del);

                        enviar_ajax(formData_del, "/eliminar_empleado");

                        Swal.fire(
                            'Eliminado!',
                            'El registro ha sido eliminado',
                            'success'
                        )
                    }
                })

            });


            $(document).on('change', '#nuevo_departamento', function() {
                let id = $(this).val();
                cambiarMunicipio(id);
            });

            $(document).on('change', '#nuevo_departamento2', function() {
                let id = $(this).val();
                cambiarMunicipio(id, true);
            });

            $(document).on('change', '#nuevo_departamento3', function() {
                let id = $(this).val();
                cambiarMunicipio_filtro(id);
            });
            


            function cambiarMunicipio(departamento, editar = false) {
                $('#nuevo_municipio').empty();
                $('#nuevo_municipio2').empty();
                const encontrarMunicipios = municipios.map(municipio => {
                    if (municipio.id_padre == departamento) {
                        console.log(municipio)
                        if (editar) {
                            $('#nuevo_municipio2').append(`<option value="${municipio.id}">${municipio.valor}</option>`);
                        } else {
                            $('#nuevo_municipio').append(`<option value="${municipio.id}">${municipio.valor}</option>`);
                        }
                    }
                });
            }

            function cambiarMunicipio_filtro(departamento) {
                $('#nuevo_municipio3').empty();
                $('#nuevo_municipio3').append(`<option value="">Seleccione un Municipio</option>`);
                const encontrarMunicipios = municipios.map(municipio => {
                    if (municipio.id_padre == departamento) {
                        console.log(municipio)
                          $('#nuevo_municipio3').append(`<option value="${municipio.id}">${municipio.valor}</option>`);
                        
                    }
                });
            }


            function actualizar_tabla(empleados) {
                $('#tabla_body').empty();
                empleados.forEach(empleado => {
                    $('#tabla_body').append(`<tr>
                <td>${empleado.nombre}</td>
                <td>${empleado.apellido}</td>
                <td>${empleado.correo}</td>
                <td>${empleado.telefono}</td>
                <td>${empleado.direccion}</td>
                <td>${empleado.departamento_texto}</td>
                <td>${empleado.municipio_texto}</td>
                <td>
                <button type="button" id="btnEditar" data-codigo="${empleado.id}" class="btn btn-warning"><i class="bi bi-pencil-square"></i></button>
                <button type="button" id="btnEliminar"  data-codigo="${empleado.id}" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a>
                </td>                
                </tr>`);


                });
            }

            function enviar_ajax(info, ruta) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: ruta,
                    data: info,
                    dataType: "json",
                    success: function(res) {
                        console.log(res)
                        empleados = res.data
                        actualizar_tabla(empleados);

                    },
                    error: function(error) {
                        console.log(error)
                    },
                });
            }
            $(document).ready(function() {
                $('#tabla_pruebas').DataTable();

            });
        </script>

</body>

</html>