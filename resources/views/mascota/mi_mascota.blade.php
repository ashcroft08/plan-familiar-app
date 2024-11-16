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
                                    Mi mascota
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
            <header>11. Mi mascota</header>
            <div class="d-flex justify-content-end mb-6">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="fa-solid fa-plus"></i>
                    </span>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearMascotaModal">
                        Agregar una mascota
                    </button>
                </div>
            </div>
            <form action="#" class="form">
                <div class="table-responsive">
                    <table class="table table-bordered" style="width: 100%">
                        <thead>
                            <tr>
                                <th rowspan="2">#</th>
                                <th rowspan="2">Nombre del animal</th>
                                <th rowspan="2">Especie</th>
                                <th rowspan="2">Raza</th>
                                <th colspan="1" class="text-center">
                                    Carnet de Vacunación
                                </th>
                                <th rowspan="2">Acciones</th>
                            </tr>
                            <tr>
                                <th>Esterilizado</th>
                            </tr>
                        </thead>
                        <tbody id="mascotaTableBody">
                            <!-- Aquí se llenarán las filas dinámicamente con JavaScript -->
                        </tbody>
                    </table>
                </div>
                <div class="row botonsform">
                    <div class="col">
                        <!-- Botón para abrir el modal de "Regresar" -->
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#regresarModal"
                            class="btn btn-secondary">Regresar <i class="fa-solid fa-rotate-left"></i></a>
                        <a href="/matriz_de_estructura_general_vivienda" class="btn btn-success">Siguiente
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
                    <a href="/numeros_emergencia" class="btn btn-primary">Aceptar <i
                            class="fa-solid fa-check"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Formulario "Crear nueva mascota" -->
    <div class="modal fade" id="crearMascotaModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="crearProyectoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="mascotaForm" class="form" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold fs-5" id="crearProyectoLabel">
                            Agregar Nueva Mascota
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nombreAnimal" class="form-label fw-bold">Nombre del Animal</label>
                            <input type="text" class="form-control" id="nombreAnimal" required />
                        </div>
                        <div class="mb-3">
                            <label for="especie" class="form-label fw-bold">Especie</label>
                            <input type="text" class="form-control" id="especie" required />
                        </div>
                        <div class="mb-3">
                            <label for="raza" class="form-label fw-bold">Raza</label>
                            <input type="text" class="form-control" id="raza" required />
                        </div>
                        <div class="mb-3">
                            <label for="esterilizado" class="form-label fw-bold">Esterilizado</label>
                            <div>
                                <input type="radio" id="esterilizadoSi" name="esterilizado" value="Si" required />
                                <label for="esterilizadoSi" class="form-check-label">Sí</label>
                            </div>
                            <div>
                                <input type="radio" id="esterilizadoNo" name="esterilizado" value="No" required />
                                <label for="esterilizadoNo" class="form-check-label">No</label>
                            </div>
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
            const mascota = @json($mascota);

            // Filtrar las amenazas por cod_familia desde localStorage
            const codFamilia = localStorage.getItem("codFamilia");
            const filteredMascota = mascota.filter(item => item.cod_familia == codFamilia);

            // Limpiar la tabla
            const tbody = $("#mascotaTableBody");
            tbody.empty();

            // Llenar la tabla con las amenazas filtradas
            filteredMascota.forEach((item, index) => {
                const row = `<tr>
                            <td>${index + 1}</td>
                            <td>${item.nombre}</td>
                            <td>${item.especie}</td>
                            <td>${item.raza}</td>
                            <td>${item.esterilizado}</td>
                            <td class="d-flex gap-2">
                                <button type="button" class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal" data-bs-target="#modalDelete"
                                    data-cod_integrante="${item.cod_mascota}">Editar 
                                <i class="fas fa-pen"></i>
                            </button>
                                <button type="button" class="btn btn-outline-danger btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#modalDelete"
                                        data-cod_amenaza="${item.cod_mascota}">Eliminar 
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
        $("#crearMascotaModal").on("show.bs.modal", function(event) {
            const codFamilia = localStorage.getItem("codFamilia");

            // Verificar si codFamilia existe
            if (!codFamilia) {
                alert("El código de familia no está disponible.");
                return;
            }

            // Asignar el valor a una variable oculta en caso de que se requiera
            document.getElementById("mascotaForm").dataset.codFamilia = codFamilia;
        });

        // Lógica para manejar el formulario de crear recurso
        document
            .getElementById("mascotaForm")
            .addEventListener("submit", async function(event) {
                event.preventDefault(); // Prevenir el envío por defecto

                // Obtener los valores del formulario
                const nombreAnimal = document.getElementById("nombreAnimal").value;
                const especie = document.getElementById("especie").value;
                const raza = document.getElementById("raza").value;
                const esterilizado = document.querySelector('input[name="esterilizado"]:checked')?.value;
                const codFamilia = this.dataset.codFamilia;

                // Validaciones
                if (!nombreAnimal || !especie || !raza || !esterilizado || !codFamilia) {
                    alert("Por favor, complete todos los campos.");
                    return;
                }

                // Datos a enviar
                const dataRecurso = {
                    cod_familia: codFamilia,
                    nombreAnimal: nombreAnimal,
                    especie: especie,
                    raza: raza,
                    esterilizado: esterilizado,
                };

                // Enviar los datos al servidor
                try {
                    const response = await fetch("/mi_mascota", { // Ruta actualizada aquí
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
                        $("#crearMascotaModal").modal("hide"); // Cerrar el modal

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
