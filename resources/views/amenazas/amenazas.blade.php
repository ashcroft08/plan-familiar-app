<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Creación Plan</title>
    <!-- Enlazar CSS de Font Awesome localmente -->
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css" />
    <!-- Enlazar Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css" />
    <!-- Enlazar DataTables CSS -->
    <link rel="stylesheet" href="/assets/DataTables/datatables.min.css" />
    <!-- Enlazar CSS -->
    <link rel="stylesheet" href="/assets/css/forms.css" />

    <!-- Incluir el CSS de Toastify -->
    <link rel="stylesheet" href="/assets/toastify/toastify.css" />
    <!-- Incluir el JS de Toastify -->
    <script src="/assets/toastify/toastify.js"></script>
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
                    <button id="regresar-btn" class="btn btn-secondary">
                        Regresar <i class="fa-solid fa-rotate-left"></i>
                    </button>
                    <button id="siguiente-btn" class="btn btn-success">
                        Siguiente
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </section>
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar <i class="fa-solid fa-ban"></i>
                    </button>
                    <button type="button" class="btn btn-primary" id="eliminarAmenaza">Confirmar <i
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
        document.addEventListener('DOMContentLoaded', () => {
            const regresarBtn = document.getElementById('regresar-btn');

            // Obtener el valor de cod_familia desde localStorage
            const codFamilia = localStorage.getItem("codFamilia");

            if (codFamilia) {
                // Agregar un listener de clic para redirigir al usuario
                regresarBtn.addEventListener('click', () => {
                    window.location.href = `/informacion_general/${codFamilia}`;
                });
            } else {
                console.error('El valor de cod_familia no está definido en localStorage.');

                // Si no hay cod_familia, podrías mostrar un mensaje o redirigir a una página predeterminada
                regresarBtn.addEventListener('click', (e) => {
                    e
                        .preventDefault(); // Evitar la acción por defecto si cod_familia no está en localStorage
                    alert('No se encontró la familia, asegúrese de que la información esté disponible.');
                });
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            const siguienteBtn = document.getElementById('siguiente-btn');

            // Obtener el valor de cod_familia desde localStorage
            const codFamilia = localStorage.getItem("codFamilia");

            siguienteBtn.addEventListener('click', (e) => {
                if (codFamilia) {
                    // Redirigir al usuario con el cod_familia
                    window.location.href = `/lugares_de_evacuacion_y_de_encuentro/${codFamilia}`;
                } else {
                    e.preventDefault(); // Evitar la acción por defecto
                    alert('No se encontró la familia, asegúrese de que la información esté disponible.');
                    console.error('El valor de cod_familia no está definido en localStorage.');
                }
            });
        });
    </script>

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
                                    data-cod_amenaza="${item.cod_amenaza}" 
                                    data-nombre_amenaza="${item.amenaza}">Eliminar 
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
            var nombreAmenaza = button.data('nombre_amenaza');
            var modalBody = $(this).find('.modal-body');
            modalBody.text('¿Esta seguro que desea eliminar ' + nombreAmenaza + '?');
            codAmenaza = button.data('cod_amenaza');
            //console.log('Código de amenaza:', codAmenaza); // Verifica si se captura correctamente
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
                        // Mostrar mensaje toast de éxito
                        Toastify({
                            text: response.message,
                            duration: 1500, // Duración del toast (3 segundos)
                            close: true,
                            gravity: "top", // Ubicación del toast en la pantalla
                            position: "right",
                            backgroundColor: "green", // Color de fondo para éxito
                        }).showToast();
                        $('#modalDelete').modal('hide');

                        setTimeout(() => {
                            location
                                .reload(); // Recargar la página para ver la nueva amenaza (ajustar si es necesario)
                        }, 1000);

                    } else {
                        // Mostrar mensaje toast de error
                        Toastify({
                            text: response.message,
                            duration: 1000, // Duración del toast (3 segundos)
                            close: true,
                            gravity: "top", // Ubicación del toast en la pantalla
                            position: "right",
                            backgroundColor: "red", // Color de fondo para error
                        }).showToast();
                    }
                },
                error: function(response) {
                    console.error('Error al eliminar:', response);
                    // Mostrar mensaje toast de error
                    Toastify({
                        text: 'Error al eliminar la amenaza',
                        duration: 1000, // Duración del toast (3 segundos)
                        close: true,
                        gravity: "top", // Ubicación del toast en la pantalla
                        position: "right",
                        backgroundColor: "red", // Color de fondo para error
                    }).showToast();
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
                        // Mostrar el toast con el mensaje de éxito
                        Toastify({
                            text: "La amenaza ha sido guardada correctamente",
                            duration: 1500, // Duración del toast (3 segundos)
                            close: true,
                            gravity: "top", // Ubicación del toast en la pantalla
                            position: "right",
                            backgroundColor: "green",
                        }).showToast();
                        //alert("La amenaza ha sido guardada correctamente.");
                        $("#crearAmenazaModal").modal("hide"); // Cerrar el modal

                        // Esperar a que el toast termine antes de redirigir (1 segundos)
                        setTimeout(() => {
                            location
                                .reload(); // Recargar la página para ver la nueva amenaza (ajustar si es necesario)
                        }, 1000); // Espera 1 segundos antes de redirigir
                        // Opcionalmente redirigir o actualizar la tabla con la nueva amenaza
                    } else {
                        // Mostrar el toast con el mensaje de error
                        Toastify({
                            text: responseData.message,
                            duration: 1000, // Duración del toast (1 segundos)
                            close: true,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "red",
                        }).showToast();
                    }
                } catch (error) {
                    console.error("Error:", error);
                    // Mostrar un toast de error en caso de fallo en la comunicación
                    Toastify({
                        text: "Hubo un problema con la solicitud",
                        duration: 1000, // Duración del toast (3 segundos)
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "red",
                    }).showToast();
                }
            });
    </script>
</body>

</html>
