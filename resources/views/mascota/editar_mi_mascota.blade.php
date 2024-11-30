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
                                                    <h1 class="modal-title fw-bold fs-5" id="staticBackdropLabel">
                                                        ¿Estás seguro de que deseas ir al inicio?
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Si regresas al inicio, los datos que hayas modificado en este
                                                    formulario no se guardarán.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Cancelar
                                                        <i class="fa-solid fa-ban"></i>
                                                    </button>
                                                    <a href="/" class="btn btn-primary" role="button">Confirmar
                                                        <i class="fa-solid fa-check"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Visualización de Plan
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
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearMascotaModal"
                        id="crearMascota" disabled>
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
                        <tbody>
                            @foreach ($mascota as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->nombre }}</td>
                                    <td>{{ $item->especie }}</td>
                                    <td>{{ $item->raza }}</td>
                                    <td>{{ $item->esterilizado }}</td>
                                    <td class="d-flex gap-2">
                                        <button type="button" class="btn btn-warning btn-sm editarMascota"
                                            data-bs-toggle="modal" data-bs-target="#editarMascotaModal"
                                            data-cod_mascota="{{ $item->cod_mascota }}"
                                            data-nombre="{{ $item->nombre }}" data-especie="{{ $item->especie }}"
                                            data-raza="{{ $item->raza }}"
                                            data-esterilizado="{{ $item->esterilizado }}" disabled>Editar
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm eliminarMascota"
                                            data-bs-toggle="modal" data-bs-target="#modalDelete"
                                            data-cod_mascota="{{ $item->cod_mascota }}" disabled>Eliminar
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
                        <a href="{{ url('numeros_emergencia/visualizar/' . $item->cod_familia) }}"
                            class="btn btn-secondary">
                            Regresar <i class="fa-solid fa-rotate-left"></i>
                        </a>
                        <a href="{{ url('/matriz_de_estructura_general_vivienda/visualizar/' . $item->cod_familia) }}"
                            class="btn btn-success">Siguiente
                            <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </form>
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
                                <input type="radio" id="esterilizadoSi" name="esterilizado" value="Si"
                                    required />
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

    <!-- Script para crear la mascota -->
    <script>
        // Lógica para manejar el formulario de crear recurso
        document
            .getElementById("mascotaForm")
            .addEventListener("submit", async function(event) {
                event.preventDefault(); // Prevenir el envío por defecto

                const codFamilia = "{{ $mascota->first()->cod_familia ?? '' }}";

                // Obtener los valores del formulario
                const nombreAnimal = document.getElementById("nombreAnimal").value;
                const especie = document.getElementById("especie").value;
                const raza = document.getElementById("raza").value;
                const esterilizado = document.querySelector('input[name="esterilizado"]:checked')?.value;

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
                        // Mostrar mensaje de éxito
                        alert("La mascota ha sido guardada correctamente.");
                        $("#crearMascotaModal").modal("hide"); // Cerrar el modal

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
                        // Mostrar mensaje de éxito
                        alert("La mascota ha sido actualizada correctamente.");
                        $("#crearMascotaModal").modal("hide"); // Cerrar el modal

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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const editarButton = document.getElementById('editar');
            const mascotaButton = document.getElementById('crearMascota');
            const eliminarmascotaButtons = document.querySelectorAll(
                '.eliminarMascota');
            const editarmascotaButtons = document.querySelectorAll(
                '.editarMascota');

            // Funcionalidad del botón Editar
            editarButton.addEventListener('click', () => {
                eliminarmascotaButtons.forEach(button => {
                    button.disabled = false; // Habilitar todos los botones 'eliminar'
                });
                editarmascotaButtons.forEach(button => {
                    button.disabled = false; // Habilitar todos los botones 'eliminar'
                });
                mascotaButton.disabled = false;
                editarButton.disabled = true; // Desactiva el botón de editar
            });
        });
    </script>
</body>

</html>
