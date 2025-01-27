<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Proyectos Comunitarios</title>
    <!-- Enlazar CSS de Font Awesome localmente -->
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css" />
    <!-- Enlazar Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css" />
    <!-- Enlazar DataTables CSS -->
    <link rel="stylesheet" href="/assets/DataTables/datatables.min.css" />
    <!-- Enlazar CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="title-container">
                    <img src="/assets/img/logo-SGR.png" alt="Logo SGR" class="logo-sgr">
                    <h1 class="title-text">PLANES FAMILIARES INCLUSIVOS DE EMERGENCIA</h1>
                    <img src="/assets/img/logo-ESPOCH.png" alt="Logo ESPOCH" class="logo-espoch">
                </div>

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Hoverable rows start -->
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-end mb-6">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fa-solid fa-plus"></i>
                        </span>
                        <a href="/informacion_general" class="btn btn-success">Crear nuevo plan</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row" id="table-hover-row">
                    <!-- table hover -->
                    <table id="proyectos" class="table table-striped" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Nombre de la familia</th>
                                <th>Provincia</th>
                                <th>Cantón</th>
                                <th>Barrio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($informacion as $item)
                                <tr>
                                    <td>{{ $item->familia_acogiente }}</td>
                                    <td>{{ $item->provincia }}</td>
                                    <td>{{ $item->canton }}</td>
                                    <td>{{ $item->nombre_bcr }}</td>
                                    <td>
                                        <!-- Link trigger for danger theme modal -->
                                        <a href="informacion_general/visualizar/{{ $item->cod_familia }}"
                                            class="btn btn-success btn-sm">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>

                                        <!-- Button trigger for danger theme modal -->
                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#modalDelete"
                                            data-cod_familia="{{ $item->cod_familia }}"><i
                                                class="fas fa-trash-alt"></i></button>

                                        <!-- Botón para descargar el documento -->
                                        <a href="/generar-word/{{$item->cod_familia}}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-file-word"></i>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Hoverable rows end -->
    </div>
    <br>

    <!-- Modal para eliminar plan -->
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteLabel" style="font-weight: bold;">
                        Eliminar Plan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Deseas eliminar el plan de la familia?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                    <button type="button"class="btn btn-danger" id="eliminarPlan">
                        <i class="fa-solid fa-trash"></i> Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Enlazar jQuery localmente -->
    <script src="/assets/js/jquery-3.7.1.min.js"></script>
    <!-- Enlazar Bootstrap JS -->
    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Enlazar DataTables JS -->
    <script src="/assets/DataTables/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#proyectos").DataTable({
                responsive: true,
                language: {
                    decimal: "",
                    emptyTable: "No hay información",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    infoEmpty: "Mostrando 0 de 0 Entradas",
                    infoFiltered: "(Filtrado de _MAX_ total entradas)",
                    infoPostFix: "",
                    thousands: ",",
                    lengthMenu: "Mostrar _MENU_ Entradas",
                    loadingRecords: "Cargando...",
                    processing: "Procesando...",
                    search: "Buscar:",
                    zeroRecords: "Sin resultados encontrados",
                    paginate: {
                        first: "Primero",
                        last: "Último",
                        next: "Siguiente",
                        previous: "Anterior",
                    },
                },
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var codFamilia;

            // Capturar el cod_familia cuando se hace clic en el botón de eliminar
            $('#modalDelete').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // El botón que activó el modal
                codFamilia = button.data('cod_familia'); // Obtener el cod_familia desde data-cod_familia
            });

            // Confirmar la eliminación
            $('#eliminarPlan').click(function() {
                $.ajax({
                    url: '/' + codFamilia, // Usar el cod_familia en la URL
                    type: 'DELETE',
                    success: function(response) {
                        // Cerrar el modal
                        $('#modalDelete').modal('hide');
                        // Refrescar la página o eliminar el plan de la vista
                        location.reload();
                    },
                    error: function(response) {
                        alert('Error al eliminar el plan');
                    }
                });
            });
        });
    </script>

</body>

</html>
