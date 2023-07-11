<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    
    <script src="https://kit.fontawesome.com/cba16ffbbc.js" crossorigin="anonymous"></script>
    
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">


</head>

<body>
    <h1 class="text-center p-3">Crud en Laravel XD</h1>

    @if (session("Correcto"))
    <div class="alert alert-success">{{session("Correcto")}}</div>
    @endif

    @if (session("Incorrecto"))
    <div class="alert alert-danger">{{session("Incorrecto")}}</div>
    @endif

    <script>
        var men = function() {
            var not = confirm("¿Estas seguro de eliminar?");
            return not;
        }
    </script>

    <!-- Modal Registrar -->
    <div class="modal fade" id="modalRegistro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar Productos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form method="post" action="{{route('crud.create')}}">
                        @csrf

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nombre del producto</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtnombre">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Precio del producto</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtprecio">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Cantidad del producto</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtcantidad">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Exit</button>
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="p-5 table-responsive">
        <button data-bs-toggle="modal" data-bs-target="#modalRegistro" class="btn btn-success m-3"> Registrar producto </button>
        <table class="table" id="tabla_dinamica">
            <thead>
                <tr>
                <th scope="col">N°</th>
                    <th scope="col">CODIGO</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Editar</th>

                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($datos as $item)
                <tr>
                <th>{{$item->num}}</th>
                    <th>{{$item->product_id}}</th>
                    <td>{{$item->product_name}}</td>
                    <td>$ {{$item->product_price}}</td>
                    <td>{{$item->product_amount}}</td>
                    <td><a href="" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->product_id}}" class="btn btn-warning btn-sm"><i class="fa-regular fa-pen-to-square"></a></i>
                        <a href="{{route('crud.delete', $item->product_id)}}" onclick="return men()" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></a></i>
                    </td>


                    <!-- Modal Modificar -->
                    <div class="modal fade" id="exampleModal{{$item->product_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar Productos</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form method="post" action="{{route('crud.update')}}">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Codigo del producto</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtcodigo" value="{{$item->product_id}}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Nombre del producto</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtnombre" value="{{$item->product_name}}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Precio del producto</label>
                                            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtprecio" value="{{$item->product_price}}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Cantidad del producto</label>
                                            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtcantidad" value="{{$item->product_amount}}">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Exit</button>
                                            <button type="submit" class="btn btn-primary">Modificar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </tr>
                @endforeach

            </tbody>
        </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tabla_dinamica').DataTable();
        });
    </script>
</body>

</html>