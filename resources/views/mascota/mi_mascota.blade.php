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
            <div class="d-flex justify-content-end mb-4">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="fa-solid fa-plus"></i>
                    </span>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearMascotaModal">
                        Agregar una mascota
                    </button>
                </div>
            </div>
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

    <!-- Modal Formulario "Crear nueva mascota" -->
    <div class="modal fade" id="crearMascotaModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="crearProyectoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="mascotaForm" class="form" method="POST" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold fs-5" id="crearProyectoLabel">
                            Agregar Nueva Mascota
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <input type="radio" id="esterilizadoNo" name="esterilizado" value="No"
                                    required />
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

    <!-- Modal Formulario "Editar mascota" -->
    <div class="modal fade" id="editarMascotaModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="editarMascotaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editarMascotaForm" class="form" method="PUT" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold fs-5" id="crearProyectoLabel">
                            Editar Mascota
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Campo oculto para cod_mascota -->
                        <input type="hidden" name="cod_mascota" id="editCodMascota" />
                        <div class="mb-3">
                            <label for="editNombreAnimal" class="form-label fw-bold">Nombre del Animal</label>
                            <input type="text" class="form-control" id="editNombreAnimal" required />
                        </div>
                        <div class="mb-3">
                            <label for="editEspecie" class="form-label fw-bold">Especie</label>
                            <input type="text" class="form-control" id="editEspecie" required />
                        </div>
                        <div class="mb-3">
                            <label for="editRaza" class="form-label fw-bold">Raza</label>
                            <input type="text" class="form-control" id="editRaza" required />
                        </div>
                        <div class="mb-3">
                            <label for="editEsterilizado" class="form-label fw-bold">Esterilizado</label>
                            <div>
                                <input type="radio" id="editEsterilizadoSi" name="editEsterilizado" value="Si"
                                    required />
                                <label for="editEsterilizadoSi" class="form-check-label">Sí</label>
                            </div>
                            <div>
                                <input type="radio" id="editEsterilizadoNo" name="editEsterilizado" value="No"
                                    required />
                                <label for="editEsterilizadoNo" class="form-check-label">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="actualizarMascota" class="btn btn-primary">
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
                        Eliminar la mascota
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Esta seguro que desea eliminar a la mascota?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar <i class="fa-solid fa-ban"></i>
                    </button>
                    <button type="button" class="btn btn-success" id="eliminarMascota"> Aceptar <i
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
        document.addEventListener('DOMContentLoaded', () => {
            const siguienteBtn = document.getElementById('siguiente-btn');

            // Obtener el valor de cod_familia desde localStorage
            const codFamilia = localStorage.getItem("codFamilia");

            siguienteBtn.addEventListener('click', (e) => {
                if (codFamilia) {
                    const url = `/matriz_de_estructura_general_vivienda/${codFamilia}`;
                    //alert(`Redirigiendo a: ${url}`);
                    window.location.href = url;
                } else {
                    e.preventDefault(); // Evitar la acción por defecto
                    alert('No se encontró la familia, asegúrese de que la información esté disponible.');
                    console.error('El valor de cod_familia no está definido en localStorage.');
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const regresarBtn = document.getElementById('regresar-btn');

            // Obtener el valor de cod_familia desde localStorage
            const codFamilia = localStorage.getItem("codFamilia");

            //console.log(codFamilia);

            if (codFamilia) {
                // Agregar un listener de clic para redirigir al usuario
                regresarBtn.addEventListener('click', (event) => {
                    event.preventDefault(); // Previene comportamientos predeterminados del botón.
                    const url = `/numeros_emergencia/${codFamilia}`;
                    //console.log("Redirigiendo a:", url);
                    window.location.href = url;
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
    </script>

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
                                    data-bs-toggle="modal" data-bs-target="#editarMascotaModal"
                                    data-cod_mascota="${item.cod_mascota}"
                                    data-nombre="${item.nombre }"
                                    data-especie="${item.especie }"
                                    data-raza="${item.raza }"
                                    data-esterilizado="${item.esterilizado}">Editar 
                                <i class="fas fa-pen"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-sm"
                                    data-bs-toggle="modal" data-bs-target="#modalDelete"
                                    data-cod_mascota="${item.cod_mascota}">Eliminar 
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            </td>
                        </tr>`;
                tbody.append(row);
            });
        });
    </script>

    <!-- Script para crear la mascota -->
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
                const dataMascota = {
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
                        body: JSON.stringify(dataMascota),
                    });

                    const responseData = await response.json();

                    if (responseData.success) {
                        Toastify({
                            text: responseData.message,
                            duration: 1500, // Duración del toast (3 segundos)
                            close: true,
                            gravity: "top", // Ubicación del toast en la pantalla
                            position: "right",
                            backgroundColor: "green",
                        }).showToast();

                        $("#crearMascotaModal").modal("hide"); // Cerrar el modal

                        setTimeout(() => {
                            location
                                .reload(); // Recargar la página para ver la nueva amenaza (ajustar si es necesario)
                        }, 1000);
                    } else {
                        Toastify({
                            text: responseData.message,
                            duration: 1500, // Duración del toast (3 segundos)
                            close: true,
                            gravity: "top", // Ubicación del toast en la pantalla
                            position: "right",
                            backgroundColor: "red",
                        }).showToast();
                    }
                } catch (error) {
                    console.error("Error:", error);
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

    <!-- Script para editar la mascota -->
    <script>
        document.getElementById('editarMascotaModal').addEventListener('show.bs.modal', function(event) {
            // Botón que disparó el modal
            var button = event.relatedTarget;

            // Obtener datos del botón
            var codMascota = button.getAttribute('data-cod_mascota');
            var nombre = button.getAttribute('data-nombre');
            var especie = button.getAttribute('data-especie');
            var raza = button.getAttribute('data-raza');
            var esterilizado = button.getAttribute('data-esterilizado');

            //alert(medicamentos);

            // Asignar valores a los campos del modal
            document.getElementById('editCodMascota').value = codMascota;
            document.getElementById('editNombreAnimal').value = nombre;
            document.getElementById('editEspecie').value = especie;
            document.getElementById('editRaza').value = raza;

            // Seleccionar el valor del Esterilizado (radio buttons)
            document.querySelectorAll('input[name="editEsterilizado"]').forEach(function(radio) {
                radio.checked = radio.value === esterilizado;
            });
        });

        document
            .getElementById("editarMascotaForm")
            .addEventListener("submit", async function(event) {
                event.preventDefault(); // Prevenir el envío por defecto

                // Obtener los valores del formulario
                const codMascota = document.getElementById("editCodMascota").value;
                const nombreAnimal = document.getElementById("editNombreAnimal").value;
                const especie = document.getElementById("editEspecie").value;
                const raza = document.getElementById("editRaza").value;
                const esterilizado = document.querySelector('input[name="editEsterilizado"]:checked')?.value;

                // Validaciones
                if (!nombreAnimal || !especie || !raza || !esterilizado || !codMascota) {
                    alert("Por favor, complete todos los campos.");
                    return;
                }

                // Datos a enviar
                const dataMascota = {
                    nombreAnimal: nombreAnimal,
                    especie: especie,
                    raza: raza,
                    esterilizado: esterilizado,
                };

                // Enviar los datos al servidor
                try {
                    const response = await fetch(`/mi_mascota/${codMascota}`, { // Ruta actualizada aquí
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector(
                                'meta[name="csrf-token"]'
                            ) ? document.querySelector('meta[name="csrf-token"]').content : "",
                        },
                        body: JSON.stringify(dataMascota),
                    });

                    const responseData = await response.json();

                    if (responseData.success) {
                        Toastify({
                            text: responseData.message,
                            duration: 1500, // Duración del toast (3 segundos)
                            close: true,
                            gravity: "top", // Ubicación del toast en la pantalla
                            position: "right",
                            backgroundColor: "green",
                        }).showToast();

                        $("#editarMascotaModal").modal("hide"); // Cerrar el modal

                        // Opcionalmente redirigir o actualizar la vista
                        location.reload(); // Recargar la página para ver el nuevo recurso (ajustar si es necesario)
                    } else {
                        // Mostrar el mensaje de error
                        alert(responseData.message);
                    }
                } catch (error) {
                    console.error("Error:", error);
                    alert("Error al guardar a la mascota.");
                }
            });
    </script>

    <!-- Script para eliminar la mascota -->
    <script>
        $('#modalDelete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            codMascota = button.data('cod_mascota');
            //console.log('Código de integrante:', codMascota); // Verifica si se captura correctamente
        });

        $('#eliminarMascota').click(function() {
            if (!codMascota) {
                console.log('Error: No se ha capturado el cod_mascota.');
                return;
            }

            $.ajax({
                url: '/mi_mascota/' + codMascota, // URL correcta
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
                    alert('Error al eliminar la mascota');
                }
            });
        });
    </script>
</body>

</html>
