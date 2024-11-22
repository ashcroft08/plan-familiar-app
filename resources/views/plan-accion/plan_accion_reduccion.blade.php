<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crear proyecto</title>
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
                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop">Inicio</a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                        ¿Seguro que deseas
                                                        ir al Inicio?
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Si regresas al inicio,
                                                    se perderán los datos
                                                    que has ingresado hasta
                                                    ahora.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Cancelar
                                                        <i class="fa-solid fa-ban"></i>
                                                    </button>
                                                    <a href="/" class="btn btn-primary" role="button">Aceptar
                                                        <i class="fa-solid fa-check"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Creación de Plan
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Plan de acción
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
            <header>7. Plan de acción</header>
            <div class="d-flex justify-content-end mb-6">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="fa-solid fa-plus"></i>
                    </span>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearActividadModal">
                        Crear nueva actividad
                    </button>
                </div>
            </div>
            <form action="#" class="form">
                <div class="table-responsive">
                    <table class="table table-bordered" style="width: 100%">
                        <thead>
                            <tr>
                                <th colspan="4" class="text-center">
                                    Actividad Antes (Reducción)
                                </th>
                            </tr>
                            <tr>
                                <th class="text-wrap" style="max-width: 200px; padding: 10px">
                                    ¿Cómo nos preparamos? La preparación
                                    implica realizar las acciones
                                    encaminadas a estar listos para
                                    responder ante emergencias y desastres.
                                </th>
                                <th>Responsable</th>
                                <th>comentario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="actividadTableBody">
                            <!-- Aquí se llenarán las filas dinámicamente con JavaScript -->
                        </tbody>
                    </table>
                </div>
                <div class="row botonsform">
                    <div class="col">
                        <!-- Botón para abrir el modal de "Regresar" -->
                        <a href="/recursos_familiares_disponibles" class="btn btn-secondary">Regresar <i
                                class="fa-solid fa-rotate-left"></i></a>
                        <a href="/plan_accion_respuesta" class="btn btn-success">Siguiente
                            <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </form>
        </section>
    </div>

    <!-- Modal Formulario "Crear nuevo recurso" -->
    <div class="modal fade" id="crearActividadModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="crearProyectoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="actividadForm" class="form" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold fs-5" id="crearProyectoLabel">
                            Crear Nueva Actividad
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="actividad" class="form-label fw-bold">¿Cómo nos preparamos?</label>
                            <textarea name="actividad" id="actividad" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="responsable" class="form-label fw-bold">Responsable</label>
                            <input type="text" class="form-control" id="responsable" required />
                        </div>
                        <div class="mb-3">
                            <label for="comentario" class="form-label fw-bold">comentario</label>
                            <textarea class="form-control" id="comentario" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="guardarAmenaza" class="btn btn-primary">
                            Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Formulario "Editar recurso" -->
    <div class="modal fade" id="editarReduccionModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="editarReduccionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editarReduccionForm" class="form" method="PUT" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold fs-5" id="crearProyectoLabel">
                            Editar plan de acción (Reducción)
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Campo oculto para cod_reduccion -->
                        <input type="hidden" name="cod_reduccion" id="editCodReduccion" />
                        <div class="mb-3">
                            <label for="editActividad" class="form-label fw-bold">¿Cómo nos preparamos?</label>
                            <textarea name="editActividad" id="editActividad" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editResponsable" class="form-label fw-bold">Responsable</label>
                            <input type="text" class="form-control" id="editResponsable" required />
                        </div>
                        <div class="mb-3">
                            <label for="editComentario" class="form-label fw-bold">comentario</label>
                            <textarea class="form-control" id="editComentario" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="actualizarReduccion" class="btn btn-primary">
                            Actualizar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para eliminar recurso -->
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold fs-5" id="modalDeleteLabel" style="font-weight: bold;">
                        Eliminar el plan de acción (Reducción)
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Esta seguro que desea eliminar el plan?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar <i class="fa-solid fa-ban"></i>
                    </button>
                    <button type="button" class="btn btn-success" id="eliminarReduccion"> Aceptar <i
                            class="fa-solid fa-check"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Enlazar jQuery localmente -->
    <script src="/assets/js/jquery-3.7.1.min.js"></script>
    <!-- Enlazar Bootstrap JS -->
    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Obtener amenazas desde la variable de Blade y convertir a un objeto JavaScript
            const actividad = @json($actividad);

            // Filtrar las amenazas por cod_familia desde localStorage
            const codFamilia = localStorage.getItem("codFamilia");
            const filteredActividad = actividad.filter(item => item.cod_familia == codFamilia);

            // Limpiar la tabla
            const tbody = $("#actividadTableBody");
            tbody.empty();

            // Llenar la tabla con las amenazas filtradas
            filteredActividad.forEach((item) => {
                const row = `<tr>
                            <td>${item.preparacion}</td>
                            <td>${item.responsable}</td>
                            <td>${item.comentario}</td>
                            <td class="d-flex gap-2">
                                <button type="button" class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal" data-bs-target="#editarReduccionModal"
                                    data-cod_reduccion="${item.cod_reduccion}"
                                    data-preparacion="${item.preparacion}"
                                    data-responsable="${item.responsable}"
                                    data-comentario="${item.comentario}">Editar 
                                <i class="fas fa-pen"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#modalDelete"
                                        data-cod_reduccion="${item.cod_reduccion}">Eliminar 
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>`;
                tbody.append(row);
            });
        });
    </script>

    <script>
        // Mostrar el modal y cargar el cod_familia desde localStorage
        $("#crearActividadModal").on("show.bs.modal", function(event) {
            const codFamilia = localStorage.getItem("codFamilia");

            // Verificar si codFamilia existe
            if (!codFamilia) {
                alert("El código de familia no está disponible.");
                return;
            }

            // Asignar el valor a una variable oculta en caso de que se requiera
            document.getElementById("actividadForm").dataset.codFamilia = codFamilia;
        });

        // Lógica para manejar el formulario de crear recurso
        document
            .getElementById("actividadForm")
            .addEventListener("submit", async function(event) {
                event.preventDefault(); // Prevenir el envío por defecto

                // Obtener los valores del formulario
                const actividad = document.getElementById("actividad").value;
                const responsable = document.getElementById("responsable").value;
                const comentario = document.getElementById("comentario").value;
                const codFamilia = this.dataset.codFamilia;

                // Validaciones
                if (!actividad || !responsable || !comentario || !codFamilia) {
                    alert("Por favor, complete todos los campos.");
                    return;
                }

                // Datos a enviar
                const dataActividad = {
                    cod_familia: codFamilia,
                    actividad: actividad,
                    responsable: responsable,
                    comentario: comentario,
                };

                // Enviar los datos al servidor
                try {
                    const response = await fetch("/plan_accion_reduccion", { // Ruta actualizada aquí
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector(
                                'meta[name="csrf-token"]'
                            ) ? document.querySelector('meta[name="csrf-token"]').content : "",
                        },
                        body: JSON.stringify(dataActividad),
                    });

                    const responseData = await response.json();

                    if (responseData.success) {
                        // Mostrar mensaje de éxito
                        alert("El recurso ha sido guardado correctamente.");
                        $("#crearActividadModal").modal("hide"); // Cerrar el modal

                        // Opcionalmente redirigir o actualizar la vista
                        location.reload(); // Recargar la página para ver el nuevo recurso (ajustar si es necesario)
                    } else {
                        // Mostrar el mensaje de error
                        alert(responseData.message);
                    }
                } catch (error) {
                    console.error("Error:", error);
                    alert("Error al guardar el recurso.");
                }
            });
    </script>

    <!-- Script para eliminar recurso -->
    <script>
        $('#modalDelete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            codReduccion = button.data('cod_reduccion');
            //console.log('Código de integrante:', codReduccion); // Verifica si se captura correctamente
        });

        $('#eliminarReduccion').click(function() {
            if (!codReduccion) {
                console.log('Error: No se ha capturado el cod_reduccion.');
                return;
            }

            $.ajax({
                url: '/plan_accion_reduccion/' + codReduccion, // URL correcta
                type: 'DELETE',
                success: function(response) {
                    console.log('Respuesta del servidor:', response);
                    if (response.success) {
                        alert(response.message); // Mensaje de éxito
                        $('#modalDelete').modal('hide');
                        location.reload(); // Refrescar la página o eliminar la fila de la tabla
                    } else {
                        alert(response.message); // Mensaje de error
                    }
                },
                error: function(response) {
                    console.error('Error al eliminar:', response);
                    alert('Error al eliminar el plan de acción (Reducción)');
                }
            });
        });
    </script>

    <!-- Script para editar recurso -->
    <script>
        document.getElementById('editarReduccionModal').addEventListener('show.bs.modal', function(event) {
            // Botón que disparó el modal
            var button = event.relatedTarget;

            // Obtener datos del botón
            var codReduccion = button.getAttribute('data-cod_reduccion');
            var descripcion = button.getAttribute('data-descripcion');
            var cantidad = button.getAttribute('data-cantidad');
            var ubicacion = button.getAttribute('data-ubicacion');
            var uso_recurso = button.getAttribute('data-uso_recurso');

            //alert(uso_recurso);

            // Asignar valores a los campos del modal
            document.getElementById('editCodReduccion').value = codReduccion;
            document.getElementById('editDescripcion').value = descripcion;
            document.getElementById('editCantidad').value = cantidad;
            document.getElementById('editUbicacion').value = ubicacion;

            // Seleccionar el valor correcto en el dropdown de Uso de Recurso
            var uso_recursoField = document.getElementById('editUsoRecurso');
            for (var i = 0; i < uso_recursoField.options.length; i++) {
                if (uso_recursoField.options[i].value === uso_recurso) {
                    uso_recursoField.selectedIndex = i;
                    break;
                }
            }
        });

        document.getElementById('editarReduccionForm').addEventListener('submit', async function(event) {
            event.preventDefault(); // Evita que se recargue la página

            // Recopilar datos del formulario
            const formData = {
                descripcion: document.getElementById('editDescripcion').value,
                cantidad: document.getElementById('editCantidad').value,
                usoRecurso: document.getElementById('editUsoRecurso').value,
                ubicacion: document.getElementById('editUbicacion').value,
            };

            // Obtener el ID del integrante (desde el campo oculto en el formulario)
            const codUsoRecurso = document.getElementById('editCodReduccion').value;

            //console.log(formData);

            try {
                // Realizar la solicitud PUT al servidor
                const response = await fetch(`/recursos_familiares_disponibles/${codUsoRecurso}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        "X-CSRF-TOKEN": document.querySelector(
                            'meta[name="csrf-token"]'
                        ) ? document.querySelector('meta[name="csrf-token"]').content : "",
                    },
                    body: JSON.stringify(formData)
                });

                const result = await response.json();

                // Manejar la respuesta del servidor
                if (response.ok) {
                    alert(result.message); // Mostrar el mensaje de éxito
                    // Opcional: Actualizar la tabla o cerrar el modal
                    location.reload(); // Recargar la página para reflejar cambios
                } else {
                    alert(result.message || 'Error al guardar los cambios.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Hubo un error al realizar la solicitud.');
            }
        });
    </script>
</body>

</html>
