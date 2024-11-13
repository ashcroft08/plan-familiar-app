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
                                    Creación de proyecto
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Amenazas
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
            <header>2. Amenazas</header>
            <div class="d-flex justify-content-end mb-4">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="fa-solid fa-plus"></i>
                    </span>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearAmenazaModal">
                        Crear nueva amenaza
                    </button>
                </div>
            </div>
            <div class="table-responsive d-flex justify-content-center">
                <table class="table table-bordered" style="width: 80%">
                    <thead>
                        <tr>
                            <th scope="col" class="col-1">#</th>
                            <th scope="col">Amenazas</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody id="amenazasTableBody">
                        <!-- Aquí se llenarán las filas dinámicamente con JavaScript -->
                    </tbody>
                </table>
            </div>
            <div class="row botonsform">
                <div class="col">
                    <!-- Botón para abrir el modal de "Regresar" -->
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#regresarModal"
                        class="btn btn-secondary">Regresar <i class="fa-solid fa-rotate-left"></i></a>
                    <a href="lugares_de_evacuacion_y_de_encuentro" class="btn btn-success">Siguiente
                        <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
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
                    <a href="/datos_generales_documentacion" class="btn btn-primary">Aceptar <i
                            class="fa-solid fa-check"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Formulario "Crear nueva amenaza" -->
    <div class="modal fade" id="crearAmenazaModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="crearProyectoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="amenazaForm" class="form" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold fs-5" id="crearProyectoLabel">
                            Crear Nueva Amenaza
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Campo oculto para cod_familia -->
                        <input type="hidden" name="cod_familia" id="codFamiliaInput" />
                        <!-- Primer select para el tipo de amenaza -->
                        <div class="mb-3">
                            <label for="tipoAmenaza" class="form-label fw-bold">Tipo de Amenaza</label>
                            <select id="tipoAmenaza" class="form-select" required>
                                <option value="" selected>
                                    Selecciona el tipo de amenaza
                                </option>
                                <option value="naturales">Naturales</option>
                                <option value="antropicas">
                                    Antrópicas
                                </option>
                                <option value="sociales">Sociales</option>
                            </select>
                        </div>

                        <!-- Segundo select que se desbloquea según la opción seleccionada -->
                        <div class="mb-3">
                            <label for="subAmenaza" class="form-label fw-bold">Subcategoría de Amenaza</label>
                            <select id="subAmenaza" class="form-select" disabled required>
                                <option value="" selected>
                                    Selecciona una subcategoría
                                </option>
                            </select>
                        </div>

                        <!-- Tercer select para elegir la amenaza específica -->
                        <div class="mb-3">
                            <label for="amenazaEspecifica" class="form-label fw-bold">Amenaza Específica</label>
                            <select id="amenazaEspecifica" class="form-select" disabled required>
                                <option value="" selected>
                                    Selecciona una amenaza específica
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

    <!-- Modal para eliminar plan -->
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold fs-5" id="modalDeleteLabel" style="font-weight: bold;">
                        Eliminar amenaza
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Esta seguro que desea eliminar esta amenaza?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar <i class="fa-solid fa-ban"></i>
                    </button>
                    <button type="button" class="btn btn-success" id="eliminarAmenaza"> Aceptar <i
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
    <script src="/assets/js/amenazas.js"></script>

    <script>
        $(document).ready(function() {
            var codAmenaza;

            // Obtener amenazas desde la variable de Blade y convertir a un objeto JavaScript
            const amenazasNom = @json($amenazasNom);

            // Filtrar las amenazas por cod_familia desde localStorage
            const codFamilia = localStorage.getItem("codFamilia");
            const filteredAmenazas = amenazasNom.filter(item => item.cod_familia == codFamilia);

            // Limpiar la tabla
            const tbody = $("#amenazasTableBody");
            tbody.empty();

            // Llenar la tabla con las amenazas filtradas
            filteredAmenazas.forEach((item, index) => {
                const row = `<tr>
                        <td>${index + 1}</td>
                        <td>${item.amenaza}</td>
                        <td>
                            <button type="button" class="btn btn-outline-danger btn-sm"
                                    data-bs-toggle="modal" data-bs-target="#modalDelete"
                                    data-cod_amenaza="${item.cod_amenaza}">Eliminar 
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>`;
                tbody.append(row);
            });
        });
    </script>

    <script>
        $('#modalDelete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            codAmenaza = button.data('cod_amenaza');
            console.log('Código de amenaza:', codAmenaza); // Verifica si se captura correctamente
        });

        $('#eliminarAmenaza').click(function() {
            if (!codAmenaza) {
                console.log('Error: No se ha capturado el cod_amenaza.');
                return;
            }

            $.ajax({
                url: '/amenaza/' + codAmenaza, // URL correcta
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
                    alert('Error al eliminar la amenaza');
                }
            });
        });
    </script>

    <script>
        $("#crearAmenazaModal").on("show.bs.modal", function(event) {
            const codFamilia = localStorage.getItem("codFamilia");

            // Verificar si codFamilia existe
            if (!codFamilia) {
                alert("El código de familia no está disponible.");
                return;
            }

            // Asignar el valor a la entrada oculta
            document.getElementById("codFamiliaInput").value = codFamilia;
        });

        // Lógica para manejar el formulario de amenazas
        document
            .getElementById("amenazaForm")
            .addEventListener("submit", async function(event) {
                event.preventDefault(); // Prevenir el envío por defecto

                // Obtener los valores del formulario
                const amenazaEspecifica =
                    document.getElementById("amenazaEspecifica").value;
                const codFamilia =
                    document.getElementById("codFamiliaInput").value;

                // Validaciones
                if (!amenazaEspecifica ||
                    !codFamilia
                ) {
                    alert("Por favor, complete todos los campos.");
                    return;
                }

                // Datos a enviar
                const dataAmenaza = {
                    cod_familia: codFamilia,
                    amenazaEspecifica: amenazaEspecifica,
                };

                // Enviar los datos al servidor
                try {
                    const response = await fetch("/amenazas", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector(
                                    'meta[name="csrf-token"]'
                                ) ?
                                document.querySelector(
                                    'meta[name="csrf-token"]'
                                ).content : "",
                        },
                        body: JSON.stringify(dataAmenaza),
                    });

                    const responseData = await response.json();

                    if (responseData.success) {
                        // Mostrar mensaje de éxito
                        alert("La amenaza ha sido guardada correctamente.");
                        $("#crearAmenazaModal").modal("hide"); // Cerrar el modal

                        // Opcionalmente redirigir o actualizar la tabla con la nueva amenaza
                        location.reload(); // Recargar la página para ver la nueva amenaza (ajustar si es necesario)
                    } else {
                        // Mostrar el mensaje de error
                        alert(responseData.message);
                    }
                } catch (error) {
                    console.error("Error:", error);
                    alert("Error al guardar la amenaza.");
                }
            });
    </script>
</body>

</html>
