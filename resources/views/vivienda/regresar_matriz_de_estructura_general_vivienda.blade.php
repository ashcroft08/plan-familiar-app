<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Creación plan</title>
    <!-- Enlazar CSS de Font Awesome localmente -->
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css" />
    <!-- Enlazar Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css" />
    <!-- Enlazar DataTables CSS -->
    <link rel="stylesheet" href="/assets/DataTables/datatables.min.css" />
    <!-- Enlazar CSS -->
    <link rel="stylesheet" href="/assets/css/forms.css" />
</head>

<body>
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6"></div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb float-md-end">
                                <li class="breadcrumb-item">
                                    Inicio
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Creación de Plan
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Información General
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

        <!-- Hoverable rows start -->
        <section class="container">
            <header>
                12.a Matriz de estructura general de la vivienda
            </header>
            <form id="estructuraViviendaForm" class="form">
                <div class="table-responsive">
                    <table class="table table-bordered" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="col">Detalle</th>
                                <th scope="col">SI</th>
                                <th scope="col">NO</th>
                                <th scope="col">
                                    Acciones para reducir la vulnerabilidad
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estructuraVivienda as $fila)
                                <tr>
                                    <td>{{ $fila->detalle }}</td>
                                    <td>
                                        <input type="radio" name="respuesta_{{ $fila->cod_estructura_vivienda }}"
                                            value="Si" {{ $fila->respuesta === 'Si' ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <input type="radio" name="respuesta_{{ $fila->cod_estructura_vivienda }}"
                                            value="No" {{ $fila->respuesta === 'No' ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <textarea class="form-control" name="acciones_{{ $fila->cod_estructura_vivienda }}">{{ $fila->acciones }}</textarea>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row botonsform">
                    <div class="col">
                        <!-- Botón para abrir el modal de "Regresar" -->
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#regresarModal"
                            class="btn btn-secondary">Regresar <i class="fa-solid fa-rotate-left"></i></a>
                        <button type="submit" id="guardarYContinuar" class="btn btn-success">
                            Siguiente
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </form>
        </section>
    </div>

    <!-- Modal para el botón "Regresar" -->
    <div class="modal fade" id="regresarModal" tabindex="-1" aria-labelledby="regresarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fw-bold fs-5" id="regresarModalLabel">
                        ¿Está seguro de que desea regresar?
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    Si regresa, los cambios realizados en este formulario no se guardarán.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar <i class="fa-solid fa-ban"></i>
                    </button>
                    <a href="/mi_mascota" class="btn btn-primary">Confirmar <i class="fa-solid fa-check"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Enlazar jQuery localmente -->
    <script src="/assets/js/jquery-3.7.1.min.js"></script>
    <!-- Enlazar Bootstrap JS -->
    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('estructuraViviendaForm').addEventListener('submit', async (event) => {
            event.preventDefault(); // Evita el envío predeterminado del formulario

            const cod_familia = "{{ $estructuraVivienda->first()->cod_familia ?? '' }}";

            const form = event.target;
            const formData = new FormData(form);

            // Crear el objeto JSON a partir del formulario
            const data = {};
            formData.forEach((value, key) => {
                if (key.startsWith('respuesta_')) {
                    const id = key.split('_')[1];
                    if (!data[id]) data[id] = {};
                    data[id].respuesta = value;
                } else if (key.startsWith('acciones_')) {
                    const id = key.split('_')[1];
                    if (!data[id]) data[id] = {};
                    data[id].acciones = value;
                }
            });

            try {
                const response = await fetch('/matriz_de_estructura_general_vivienda/actualizar', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        "X-CSRF-TOKEN": document.querySelector(
                                'meta[name="csrf-token"]'
                            ) ?
                            document.querySelector(
                                'meta[name="csrf-token"]'
                            ).content : "",
                    },
                    body: JSON.stringify({
                        estructuraVivienda: data
                    }),
                });

                const responseData = await response.json();

                if (responseData.success) {
                    //alert("Datos guardados correctamente");
                    window.location.href = `/comedor/${cod_familia}`;
                } else {
                    alert(
                        responseData.message ||
                        "Hubo un error al guardar los datos"
                    );
                }
            } catch (error) {
                console.error("Error:", error);
                alert("Error en la solicitud");
            }
        });
    </script>
</body>

</html>
