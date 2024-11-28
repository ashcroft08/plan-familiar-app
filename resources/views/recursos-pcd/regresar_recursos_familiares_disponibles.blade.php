<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Visualización plan</title>
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
                                    Visualización plan
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Recursos familiares disponibles
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
                6. Recursos personales disponibles para la persona con
                discapacidad (PCD)
            </header>
            <div class="d-flex justify-content-end mb-4">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="fa-solid fa-plus"></i>
                    </span>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearRecursoModal"
                        id="crearRecurso" disabled>
                        Crear nuevo recurso
                    </button>
                </div>
            </div>
            <form action="#" class="form">
                <div class="table-responsive">
                    <table class="table table-bordered" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Ubicación</th>
                                <th scope="col">
                                    Para hacer uso del recurso
                                </th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recursos as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->descripcion }}</td>
                                    <td>{{ $item->cantidad }}</td>
                                    <td>{{ $item->ubicacion }}</td>
                                    <td>{{ $item->uso_recurso }}</td>
                                    <td class="d-flex gap-2">
                                        <button type="button" class="btn btn-warning btn-sm editarRecurso"
                                            data-bs-toggle="modal" data-bs-target="#editarRecursoModal"
                                            data-cod_recurso="{{ $item->cod_recurso }}"
                                            data-descripcion="{{ $item->descripcion }}"
                                            data-cantidad="{{ $item->cantidad }}"
                                            data-ubicacion="{{ $item->ubicacion }}"
                                            data-uso_recurso="{{ $item->uso_recurso }}" disabled>Editar
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm eliminarRecurso"
                                            data-bs-toggle="modal" data-bs-target="#modalDelete"
                                            data-cod_recurso="{{ $item->cod_recurso }}" disabled>Eliminar
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row botonsform">
                    <div class="col">
                        <button type="button" id="editar" class="btn btn-warning">
                            Editar
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                        <a href="{{ url('identificacion_de_amenazas/modificar/' . $item->cod_familia) }}"
                            class="btn btn-secondary">
                            Regresar <i class="fa-solid fa-rotate-left"></i>
                        </a>
                        <a href="{{ url('/plan_accion_reduccion/editar/' . $item->cod_familia) }}"
                            class="btn btn-success">Siguiente
                            <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </form>
        </section>
    </div>

    <!-- Modal para el botón "Regresar" -->
    <div class="modal fade" id="regresarModal" tabindex="-1" aria-labelledby="regresarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="regresarModalLabel">
                        ¿Seguro que deseas regresar?
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Si regresas, se perderán los datos que has ingresado
                    hasta ahora.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar <i class="fa-solid fa-ban"></i>
                    </button>
                    <a href="/identificacion_de_amenazas" class="btn btn-primary">Aceptar <i
                            class="fa-solid fa-check"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Formulario "Crear nuevo recurso" -->
    <div class="modal fade" id="crearRecursoModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="crearProyectoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="recursoForm" class="form" method="POST" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold fs-5" id="crearProyectoLabel">
                            Crear Nuevo Recurso Familiar
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="descripcion" class="form-label fw-bold">Descripción</label>
                            <input type="text" class="form-control" id="descripcion" required />
                        </div>
                        <div class="mb-3">
                            <label for="cantidad" class="form-label fw-bold">Cantidad</label>
                            <input type="number" class="form-control" id="cantidad" required />
                        </div>
                        <div class="mb-3">
                            <label for="ubicacion" class="form-label fw-bold">Ubicación</label>
                            <input type="text" class="form-control" id="ubicacion" required />
                        </div>
                        <div class="mb-3">
                            <label for="usoRecurso" class="form-label fw-bold">Para hacer uso del recurso</label>
                            <select class="form-select" id="usoRecurso" required>
                                <option value="" disabled selected>
                                    Seleccione una opción
                                </option>
                                <option value="Requiere apoyo">
                                    Requiere de apoyo
                                </option>
                                <option value="No requiere apoyo">
                                    No requiere de apoyo
                                </option>
                            </select>
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
    <div class="modal fade" id="editarRecursoModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="editarRecursoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editarRecursoForm" class="form" method="PUT" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold fs-5" id="crearProyectoLabel">
                            Editar Recurso Familiar
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Campo oculto para cod_recurso -->
                        <input type="hidden" name="cod_recurso" id="editCodRecurso" />
                        <div class="mb-3">
                            <label for="editDescripcion" class="form-label fw-bold">Descripción</label>
                            <input type="text" class="form-control" id="editDescripcion" required />
                        </div>
                        <div class="mb-3">
                            <label for="editCantidad" class="form-label fw-bold">Cantidad</label>
                            <input type="number" class="form-control" id="editCantidad" required />
                        </div>
                        <div class="mb-3">
                            <label for="editUbicacion" class="form-label fw-bold">Ubicación</label>
                            <input type="text" class="form-control" id="editUbicacion" required />
                        </div>
                        <div class="mb-3">
                            <label for="editUsoRecurso" class="form-label fw-bold">Para hacer uso del recurso</label>
                            <select class="form-select" id="editUsoRecurso" required>
                                <option value="" disabled selected>
                                    Seleccione una opción
                                </option>
                                <option value="Requiere apoyo">
                                    Requiere de apoyo
                                </option>
                                <option value="No requiere apoyo">
                                    No requiere de apoyo
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="actualizarRecurso" class="btn btn-primary">
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
                        Eliminar el recurso
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Esta seguro que desea eliminar el recurso?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar <i class="fa-solid fa-ban"></i>
                    </button>
                    <button type="button" class="btn btn-success" id="eliminarRecurso"> Aceptar <i
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
        // Mostrar el modal y cargar el cod_familia desde localStorage
        $("#crearRecursoModal").on("show.bs.modal", function(event) {
            const codFamilia = localStorage.getItem("codFamilia");

            // Verificar si codFamilia existe
            if (!codFamilia) {
                alert("El código de familia no está disponible.");
                return;
            }

            // Asignar el valor a una variable oculta en caso de que se requiera
            document.getElementById("recursoForm").dataset.codFamilia = codFamilia;
        });

        // Lógica para manejar el formulario de crear recurso
        document
            .getElementById("recursoForm")
            .addEventListener("submit", async function(event) {
                event.preventDefault(); // Prevenir el envío por defecto

                // Obtener los valores del formulario
                const descripcion = document.getElementById("descripcion").value;
                const cantidad = document.getElementById("cantidad").value;
                const ubicacion = document.getElementById("ubicacion").value;
                const usoRecurso = document.getElementById("usoRecurso").value;
                const codFamilia = this.dataset.codFamilia;

                // Validaciones
                if (!descripcion || !cantidad || !ubicacion || !usoRecurso || !codFamilia) {
                    alert("Por favor, complete todos los campos.");
                    return;
                }

                // Datos a enviar
                const dataRecurso = {
                    cod_familia: codFamilia,
                    descripcion: descripcion,
                    cantidad: cantidad,
                    ubicacion: ubicacion,
                    usoRecurso: usoRecurso,
                };

                // Enviar los datos al servidor
                try {
                    const response = await fetch("/recursos_familiares_disponibles", { // Ruta actualizada aquí
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector(
                                'meta[name="csrf-token"]'
                            ) ? document.querySelector('meta[name="csrf-token"]').content : "",
                        },
                        body: JSON.stringify(dataRecurso),
                    });

                    const responseData = await response.json();

                    if (responseData.success) {
                        // Mostrar mensaje de éxito
                        alert("El recurso ha sido guardado correctamente.");
                        $("#crearRecursoModal").modal("hide"); // Cerrar el modal

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
            codRecurso = button.data('cod_recurso');
            //console.log('Código de integrante:', codRecurso); // Verifica si se captura correctamente
        });

        $('#eliminarRecurso').click(function() {
            if (!codRecurso) {
                console.log('Error: No se ha capturado el cod_recurso.');
                return;
            }

            $.ajax({
                url: '/recursos_familiares_disponibles/' + codRecurso, // URL correcta
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
                    alert('Error al eliminar el recurso');
                }
            });
        });
    </script>

    <!-- Script para editar recurso -->
    <script>
        document.getElementById('editarRecursoModal').addEventListener('show.bs.modal', function(event) {
            // Botón que disparó el modal
            var button = event.relatedTarget;

            // Obtener datos del botón
            var codRecurso = button.getAttribute('data-cod_recurso');
            var descripcion = button.getAttribute('data-descripcion');
            var cantidad = button.getAttribute('data-cantidad');
            var ubicacion = button.getAttribute('data-ubicacion');
            var uso_recurso = button.getAttribute('data-uso_recurso');

            //alert(uso_recurso);

            // Asignar valores a los campos del modal
            document.getElementById('editCodRecurso').value = codRecurso;
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

        document.getElementById('editarRecursoForm').addEventListener('submit', async function(event) {
            event.preventDefault(); // Evita que se recargue la página

            // Recopilar datos del formulario
            const formData = {
                descripcion: document.getElementById('editDescripcion').value,
                cantidad: document.getElementById('editCantidad').value,
                usoRecurso: document.getElementById('editUsoRecurso').value,
                ubicacion: document.getElementById('editUbicacion').value,
            };

            // Obtener el ID del integrante (desde el campo oculto en el formulario)
            const codUsoRecurso = document.getElementById('editCodRecurso').value;

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
