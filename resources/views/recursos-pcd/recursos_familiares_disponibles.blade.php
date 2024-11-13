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
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearRecursoModal">
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
                        <tbody id="recursosTableBody">
                            <!-- Aquí se llenarán las filas dinámicamente con JavaScript -->
                        </tbody>
                    </table>
                </div>
                <div class="row botonsform">
                    <div class="col">
                        <!-- Botón para abrir el modal de "Regresar" -->
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#regresarModal"
                            class="btn btn-secondary">Regresar <i class="fa-solid fa-rotate-left"></i></a>
                        <a href="/plan_accion_reduccion" class="btn btn-success">Siguiente
                            <i class="fa-solid fa-arrow-right"></i></a>
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
            <form id="recursoForm" class="form" method="POST">
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

    <!-- Enlazar jQuery localmente -->
    <script src="/assets/js/jquery-3.7.1.min.js"></script>
    <!-- Enlazar Bootstrap JS -->
    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {

            // Obtener amenazas desde la variable de Blade y convertir a un objeto JavaScript
            const recursos = @json($recursos);

            // Filtrar las amenazas por cod_familia desde localStorage
            const codFamilia = localStorage.getItem("codFamilia");
            const filteredRecursos = recursos.filter(item => item.cod_familia == codFamilia);

            // Limpiar la tabla
            const tbody = $("#recursosTableBody");
            tbody.empty();

            // Llenar la tabla con las amenazas filtradas
            filteredRecursos.forEach((item, index) => {
                const row = `<tr>
                            <td>${index + 1}</td>
                            <td>${item.descripcion}</td>
                            <td>${item.cantidad}</td>
                            <td>${item.ubicacion}</td>
                            <td>${item.uso_recurso}</td>
                            <td class="d-flex gap-2">
                                <button type="button" class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal" data-bs-target="#modalDelete"
                                    data-cod_integrante="${item.cod_recurso}">Editar 
                                <i class="fas fa-pen"></i>
                            </button>
                                <button type="button" class="btn btn-outline-danger btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#modalDelete"
                                        data-cod_amenaza="${item.cod_recurso}">Eliminar 
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

</body>

</html>