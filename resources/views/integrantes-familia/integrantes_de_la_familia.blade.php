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
    <style>
        .container {
            max-width: 1600px;
            width: 100%;
        }
    </style>
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
                                    Integrantes de la Familia
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
            <header>4. Integrantes de la familia</header>
            <div class="d-flex justify-content-end mb-4">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="fa-solid fa-plus"></i>
                    </span>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearIntegranteModal">
                        Crear nuevo integrante
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">Nombres y Apellidos</th>
                            <th scope="col">PCD</th>
                            <th scope="col">Edad</th>
                            <th scope="col">Sexo</th>
                            <th scope="col">Parentesco</th>
                            <th scope="col">Cuidador</th>
                            <th scope="col">
                                Frecuencia de necesidades especiales
                            </th>
                            <th scope="col">
                                Cuenta con carnet de discapacidad
                            </th>
                            <th scope="col">
                                Pertenece a algún proyecto (MIES o
                                Fundación)
                            </th>
                            <th scope="col">
                                Acciones y Responsabilidades
                            </th>
                            <th scope="col">
                                Medicamentos prescritos por el médico
                            </th>
                            <th scope="col">Dosis:</th>
                            <th scope="col">Observaciones</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="integrantesTableBody">
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

    <!-- Modal Formulario "Crear nuevo integrante" -->
    <div class="modal fade" id="crearIntegranteModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="crearProyectoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="integranteForm" class="form" method="POST" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold fs-5" id="crearProyectoLabel">
                            Crear Nuevo Integrante
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Campo oculto para cod_familia -->
                        <input type="hidden" name="cod_familia" id="codFamiliaInput" />
                        <div class="mb-3">
                            <label for="nombresApellidos" class="form-label fw-bold">Nombres y Apellidos</label>
                            <input type="text" class="form-control" id="nombresApellidos" name="nombresApellidos"
                                required />
                        </div>
                        <div class="mb-3">
                            <label for="pcd" class="form-label fw-bold">PCD (Persona con Discapacidad)</label>
                            <select class="form-select" id="pcd" required>
                                <option value="" disabled selected>
                                    Seleccione una discapacidad
                                </option>
                                <option value="Visual">
                                    Discapacidad visual
                                </option>
                                <option value="Auditiva">
                                    Discapacidad auditiva
                                </option>
                                <option value="Física o motriz">
                                    Discapacidad física o motriz
                                </option>
                                <option value="Intelectual">
                                    Discapacidad intelectual
                                </option>
                                <option value="Psicosocial o mental">
                                    Discapacidad psicosocial o mental
                                </option>
                                <option value="Lenguaje y comunicación">
                                    Discapacidad del lenguaje y la
                                    comunicación
                                </option>
                                <option value="Múltiple">
                                    Discapacidad múltiple
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edad" class="form-label fw-bold">Edad</label>
                            <input type="number" class="form-control" id="edad" name="edad" required />
                        </div>
                        <div class="mb-3">
                            <label for="sexo" class="form-label fw-bold">Sexo</label>
                            <div>
                                <input type="radio" id="masculino" name="sexo" value="Masculino" />
                                <label for="masculino" class="form-check-label">Masculino</label>
                            </div>
                            <div>
                                <input type="radio" id="femenino" name="sexo" value="Femenino" />
                                <label for="femenino" class="form-check-label">Femenino</label>
                            </div>
                            <div>
                                <input type="radio" id="otro" name="sexo" value="Otro" />
                                <label for="otro" class="form-check-label">Otro</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="parentesco" class="form-label fw-bold">Parentesco</label>
                            <input type="text" class="form-control" id="parentesco" required />
                        </div>
                        <div class="mb-3">
                            <label for="cuidador" class="form-label fw-bold">Cuidador</label>
                            <input type="text" class="form-control" id="cuidador" required />
                        </div>
                        <div class="mb-3">
                            <label for="frecuenciaNecesidades" class="form-label fw-bold">Frecuencia de Necesidades
                                Especiales
                                (Especifique)</label>
                            <input type="text" class="form-control" id="frecuenciaNecesidades"
                                name="frecuenciaNecesidades" required />
                        </div>
                        <div class="mb-3">
                            <label for="carnet" class="form-label fw-bold">Cuenta con carnet de discapacidad</label>
                            <div>
                                <input type="radio" id="carnetSi" name="carnet" value="Si" />
                                <label for="carnetSi" class="form-check-label">Sí</label>
                            </div>
                            <div>
                                <input type="radio" id="carnetNo" name="carnet" value="No" />
                                <label for="carnetNo" class="form-check-label">No</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="proyecto" class="form-label fw-bold">Pertenece a algún proyecto (MIES o
                                Fundación)</label>
                            <div>
                                <input type="radio" id="proyectoSi" name="proyecto" value="Si" />
                                <label for="proyectoSi" class="form-check-label">Sí</label>
                            </div>
                            <div>
                                <input type="radio" id="proyectoNo" name="proyecto" value="No" />
                                <label for="proyectoNo" class="form-check-label">No</label>
                            </div>
                        </div>
                        <!-- Agregando los nuevos campos solicitados -->
                        <div class="mb-3">
                            <label for="accionesResponsabilidades" class="form-label fw-bold">Acciones y
                                Responsabilidades</label>
                            <input type="text" class="form-control" id="accionesResponsabilidades" required />
                        </div>
                        <div class="mb-3">
                            <label for="medicamentosPrescritos" class="form-label fw-bold">Medicamentos prescritos por
                                el
                                médico</label>
                            <input type="text" class="form-control" id="medicamentosPrescritos" required />
                        </div>
                        <div class="mb-3">
                            <label for="dosis" class="form-label fw-bold">Dosis</label>
                            <input type="text" class="form-control" id="dosis" required />
                        </div>
                        <div class="mb-3">
                            <label for="observaciones" class="form-label fw-bold">Observaciones</label>
                            <textarea class="form-control" id="observaciones" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="guardarIntegrante" class="btn btn-primary">
                            Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Formulario "Editar integrante" -->
    <div class="modal fade" id="editarIntegranteModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="editarIntegranteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editarIntegranteForm" class="form" method="PUT" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold fs-5" id="editarIntegranteLabel">
                            Editar Integrante
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Campo oculto para cod_integrante -->
                        <input type="hidden" name="cod_integrante" id="editCodIntegrante" />
                        <div class="mb-3">
                            <label for="editNombres" class="form-label fw-bold">Nombres y Apellidos</label>
                            <input type="text" class="form-control" id="editNombres" name="nombres" required />
                        </div>
                        <div class="mb-3">
                            <label for="editPCD" class="form-label fw-bold">PCD (Persona con Discapacidad)</label>
                            <select class="form-select" id="editPCD" name="pcd" required>
                                <option value="" disabled>Seleccione una discapacidad</option>
                                <option value="Visual">Discapacidad visual</option>
                                <option value="Auditiva">Discapacidad auditiva</option>
                                <option value="Física o motriz">Discapacidad física o motriz</option>
                                <option value="Intelectual">Discapacidad intelectual</option>
                                <option value="Psicosocial o mental">Discapacidad psicosocial o mental</option>
                                <option value="Lenguaje y comunicación">Discapacidad del lenguaje y la comunicación
                                </option>
                                <option value="Múltiple">Discapacidad múltiple</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editEdad" class="form-label fw-bold">Edad</label>
                            <input type="number" class="form-control" id="editEdad" name="edad" required />
                        </div>
                        <div class="mb-3">
                            <label for="editSexo" class="form-label fw-bold">Sexo</label>
                            <div>
                                <input type="radio" id="editSexoMasculino" name="editSexo" value="Masculino" />
                                <label for="editSexoMasculino" class="form-check-label">Masculino</label>
                            </div>
                            <div>
                                <input type="radio" id="editSexoFemenino" name="editSexo" value="Femenino" />
                                <label for="editSexoFemenino" class="form-check-label">Femenino</label>
                            </div>
                            <div>
                                <input type="radio" id="editSexoOtro" name="sexo" value="Otro" />
                                <label for="editSexoOtro" class="form-check-label">Otro</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="editParentesco" class="form-label fw-bold">Parentesco</label>
                            <input type="text" class="form-control" id="editParentesco" name="parentesco"
                                required />
                        </div>
                        <div class="mb-3">
                            <label for="editCuidador" class="form-label fw-bold">Cuidador</label>
                            <input type="text" class="form-control" id="editCuidador" name="cuidador" required />
                        </div>
                        <div class="mb-3">
                            <label for="editFrecuenciaNecesidades" class="form-label fw-bold">
                                Frecuencia de Necesidades Especiales (Especifique)
                            </label>
                            <input type="text" class="form-control" id="editFrecuenciaNecesidades"
                                name="frecuencia_necesidades" required />
                        </div>
                        <div class="mb-3">
                            <label for="editCarnet" class="form-label fw-bold">Cuenta con carnet de
                                discapacidad</label>
                            <div>
                                <input type="radio" id="editCarnetSi" name="editCarnet" value="Si" />
                                <label for="editCarnetSi" class="form-check-label">Sí</label>
                            </div>
                            <div>
                                <input type="radio" id="editCarnetNo" name="editCarnet" value="No" />
                                <label for="editCarnetNo" class="form-check-label">No</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="editProyecto" class="form-label fw-bold">Pertenece a algún proyecto (MIES o
                                Fundación)</label>
                            <div>
                                <input type="radio" id="proyectoSi" name="editProyecto" value="Si" />
                                <label for="proyectoSi" class="form-check-label">Sí</label>
                            </div>
                            <div>
                                <input type="radio" id="proyectoNo" name="editProyecto" value="No" />
                                <label for="proyectoNo" class="form-check-label">No</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="editAccionesResponsabilidades" class="form-label fw-bold">
                                Acciones y Responsabilidades
                            </label>
                            <input type="text" class="form-control" id="editAccionesResponsabilidades"
                                name="acciones_responsabilidades" required />
                        </div>
                        <div class="mb-3">
                            <label for="editMedicamentosPrescritos" class="form-label fw-bold">Medicamentos prescritos
                                por
                                el
                                médico</label>
                            <input type="text" class="form-control" id="EditMedicamentosPrescritos" required />
                        </div>
                        <div class="mb-3">
                            <label for="editDosis" class="form-label fw-bold">Dosis</label>
                            <input type="text" class="form-control" id="editDosis" required />
                        </div>
                        <div class="mb-3">
                            <label for="editObservaciones" class="form-label fw-bold">Observaciones</label>
                            <textarea class="form-control" id="editObservaciones" name="editObservaciones" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="actualizarIntegrante" class="btn btn-primary">
                            Actualizar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para eliminar integrante -->
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold fs-5" id="modalDeleteLabel" style="font-weight: bold;">
                        Eliminar integrante de la familia
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Esta seguro que desea eliminar a este integrante?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar <i class="fa-solid fa-ban"></i>
                    </button>
                    <button type="button" class="btn btn-success" id="eliminarIntegrante"> Aceptar <i
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
            const regresarBtn = document.getElementById('regresar-btn');

            // Obtener el valor de cod_familia desde localStorage
            const codFamilia = localStorage.getItem("codFamilia");

            if (codFamilia) {
                // Agregar un listener de clic para redirigir al usuario
                regresarBtn.addEventListener('click', () => {
                    window.location.href = `/lugares_de_evacuacion_y_de_encuentro/${codFamilia}`;
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
                    window.location.href = `/identificacion_de_amenazas/${codFamilia}`;
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
            var codIntegrante;

            // Obtener integrantes desde la variable de Blade y convertir a un objeto JavaScript
            const integrantes = @json($integrantes);

            // Filtrar las integrantes por cod_familia desde localStorage
            const codFamilia = localStorage.getItem("codFamilia");
            const filteredIntegrantes = integrantes.filter(item => item.cod_familia == codFamilia);

            // Limpiar la tabla
            const tbody = $("#integrantesTableBody");
            tbody.empty();

            // Llenar la lista con las integrantess filtradas
            filteredIntegrantes.forEach((item) => {
                const row = `<tr>
                        <td>${item.nombres}</td>
                        <td>${item.pcd}</td>
                        <td>${item.edad}</td>
                        <td>${item.sexo}</td>
                        <td>${item.parentesco}</td>
                        <td>${item.cuidador}</td>
                        <td>${item.frecuencia_necesidades}</td>
                        <td>${item.carnet}</td>
                        <td>${item.proyecto}</td>
                        <td>${item.acciones_responsabilidades}</td>
                        <td>${item.medicamentos}</td>
                        <td>${item.dosis}</td>
                        <td>${item.observaciones}</td>
                        <td class="d-flex gap-2">
                            <button type="button" class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal" data-bs-target="#editarIntegranteModal"
                                    data-cod_integrante="${item.cod_integrante}"
                                    data-nombres="${item.nombres }"
                                    data-edad="${item.edad }"
                                    data-sexo="${item.sexo }"
                                    data-parentesco="${item.parentesco}"
                                    data-cuidador="${item.cuidador}"
                                    data-pcd="${item.pcd}" 
                                    data-frecuencia_necesidades="${item.frecuencia_necesidades}"
                                    data-carnet="${item.carnet}" 
                                    data-proyecto="${item.proyecto}"
                                    data-acciones_responsabilidades="${item.acciones_responsabilidades}"
                                    data-medicamentos="${item.medicamentos}"
                                    data-dosis="${item.dosis}"
                                    data-observaciones="${item.observaciones}">Editar 
                                <i class="fas fa-pen"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-sm"
                                    data-bs-toggle="modal" data-bs-target="#modalDelete"
                                    data-cod_integrante="${item.cod_integrante}">Eliminar 
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
        $("#crearIntegranteModal").on("show.bs.modal", function(event) {
            const codFamilia = localStorage.getItem("codFamilia");

            // Verificar si codFamilia existe
            if (!codFamilia) {
                alert("El código de familia no está disponible.");
                return;
            }

            // Asignar el valor a la entrada oculta
            document.getElementById("codFamiliaInput").value = codFamilia;
        });

        // Lógica para manejar el formulario de crear integrante
        document
            .getElementById("integranteForm")
            .addEventListener("submit", async function(event) {
                event.preventDefault(); // Prevenir el envío por defecto

                // Obtener los valores del formulario
                const nombresApellidos = document.getElementById("nombresApellidos").value;
                const pcd = document.getElementById("pcd").value;
                const edad = document.getElementById("edad").value;
                const sexo = document.querySelector('input[name="sexo"]:checked')?.value;
                const parentesco = document.getElementById("parentesco").value;
                const cuidador = document.getElementById("cuidador").value;
                const frecuenciaNecesidades = document.getElementById("frecuenciaNecesidades").value;
                const carnet = document.querySelector('input[name="carnet"]:checked')?.value;
                const proyecto = document.querySelector('input[name="proyecto"]:checked')?.value;
                const accionesResponsabilidades = document.getElementById("accionesResponsabilidades").value;
                const medicamentosPrescritos = document.getElementById("medicamentosPrescritos").value;
                const dosis = document.getElementById("dosis").value;
                const observaciones = document.getElementById("observaciones").value;
                const codFamilia = document.getElementById("codFamiliaInput").value;

                // Validaciones
                if (!nombresApellidos || !pcd || !edad || !sexo || !parentesco || !cuidador || !
                    frecuenciaNecesidades || !carnet || !proyecto || !accionesResponsabilidades || !
                    medicamentosPrescritos || !dosis || !observaciones || !codFamilia) {
                    alert("Por favor, complete todos los campos.");
                    return;
                }

                // Datos a enviar
                const dataIntegrante = {
                    cod_familia: codFamilia,
                    nombresApellidos: nombresApellidos,
                    pcd: pcd,
                    edad: edad,
                    sexo: sexo,
                    parentesco: parentesco,
                    cuidador: cuidador,
                    frecuencia_necesidades: frecuenciaNecesidades,
                    carnet: carnet,
                    proyecto: proyecto,
                    acciones_responsabilidades: accionesResponsabilidades,
                    medicamentos_prescritos: medicamentosPrescritos,
                    dosis: dosis,
                    observaciones: observaciones,
                };

                console.log("Datos a enviar", dataIntegrante);
                // Enviar los datos al servidor
                try {
                    const response = await fetch("/integrantes_de_la_familia", { // Ruta actualizada aquí
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector(
                                'meta[name="csrf-token"]'
                            ) ? document.querySelector('meta[name="csrf-token"]').content : "",
                        },
                        body: JSON.stringify(dataIntegrante),
                    });

                    const responseData = await response.json();

                    if (responseData.success) {
                        // Mostrar mensaje de éxito
                        alert("El integrante ha sido guardado correctamente.");
                        $("#crearIntegranteModal").modal("hide"); // Cerrar el modal

                        // Opcionalmente redirigir o actualizar la vista
                        location
                            .reload(); // Recargar la página para ver el nuevo integrante (ajustar si es necesario)
                    } else {
                        // Mostrar el mensaje de error
                        alert(responseData.message);
                    }
                } catch (error) {
                    console.error("Error:", error);
                    alert("Error al guardar el integrante.");
                }
            });
    </script>

    <!-- Script para eliminar integrante -->
    <script>
        $('#modalDelete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            codIntegrante = button.data('cod_integrante');
            //console.log('Código de integrante:', codIntegrante); // Verifica si se captura correctamente
        });

        $('#eliminarIntegrante').click(function() {
            if (!codIntegrante) {
                console.log('Error: No se ha capturado el cod_integrante.');
                return;
            }

            $.ajax({
                url: '/integrantes_de_la_familia/' + codIntegrante, // URL correcta
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
                    alert('Error al eliminar al integrante');
                }
            });
        });
    </script>

    <script>
        document.getElementById('editarIntegranteModal').addEventListener('show.bs.modal', function(event) {
            // Botón que disparó el modal
            var button = event.relatedTarget;

            // Obtener datos del botón
            var codIntegrante = button.getAttribute('data-cod_integrante');
            var nombres = button.getAttribute('data-nombres');
            var edad = button.getAttribute('data-edad');
            var sexo = button.getAttribute('data-sexo');
            var parentesco = button.getAttribute('data-parentesco');
            var cuidador = button.getAttribute('data-cuidador');
            var pcd = button.getAttribute('data-pcd');
            var frecuenciaNecesidades = button.getAttribute('data-frecuencia_necesidades');
            var carnet = button.getAttribute('data-carnet');
            var proyecto = button.getAttribute('data-proyecto');
            var accionesResponsabilidades = button.getAttribute('data-acciones_responsabilidades');
            var medicamentos = button.getAttribute('data-medicamentos');
            var dosis = button.getAttribute('data-dosis');
            var observaciones = button.getAttribute('data-observaciones');

            //alert(medicamentos);

            // Asignar valores a los campos del modal
            document.getElementById('editCodIntegrante').value = codIntegrante;
            document.getElementById('editNombres').value = nombres;
            document.getElementById('editEdad').value = edad;
            document.getElementById('editParentesco').value = parentesco;
            document.getElementById('editCuidador').value = cuidador;

            // Seleccionar el valor correcto en el dropdown de PCD
            var pcdField = document.getElementById('editPCD');
            for (var i = 0; i < pcdField.options.length; i++) {
                if (pcdField.options[i].value === pcd) {
                    pcdField.selectedIndex = i;
                    break;
                }
            }

            document.getElementById('editFrecuenciaNecesidades').value = frecuenciaNecesidades;

            // Seleccionar el valor del sexo (radio buttons)
            document.querySelectorAll('input[name="editSexo"]').forEach(function(radio) {
                radio.checked = radio.value === sexo;
            });

            // Seleccionar el valor del carnet (radio buttons)
            document.querySelectorAll('input[name="editCarnet"]').forEach(function(radio) {
                radio.checked = radio.value === carnet;
            });

            // Seleccionar el valor del proyecto (radio buttons)
            document.querySelectorAll('input[name="editProyecto"]').forEach(function(radio) {
                radio.checked = radio.value === proyecto;
            });

            document.getElementById('editAccionesResponsabilidades').value = accionesResponsabilidades;
            document.getElementById('EditMedicamentosPrescritos').value = medicamentos; // Corregir ID
            document.getElementById('editDosis').value = dosis;
            document.getElementById('editObservaciones').value = observaciones;
        });

        document.getElementById('editarIntegranteForm').addEventListener('submit', async function(event) {
            event.preventDefault(); // Evita que se recargue la página

            // Recopilar datos del formulario
            const formData = {
                nombres: document.getElementById('editNombres').value,
                pcd: document.getElementById('editPCD').value,
                edad: document.getElementById('editEdad').value,
                sexo: document.querySelector('input[name="editSexo"]:checked')?.value,
                parentesco: document.getElementById('editParentesco').value,
                cuidador: document.getElementById('editCuidador').value,
                frecuencia_necesidades: document.getElementById('editFrecuenciaNecesidades').value,
                carnet: document.querySelector('input[name="editCarnet"]:checked')?.value,
                proyecto: document.querySelector('input[name="editProyecto"]:checked')?.value,
                acciones_responsabilidades: document.getElementById('editAccionesResponsabilidades').value,
                medicamentos_prescritos: document.getElementById('EditMedicamentosPrescritos').value,
                dosis: document.getElementById('editDosis').value,
                observaciones: document.getElementById('editObservaciones').value
            };

            // Obtener el ID del integrante (desde el campo oculto en el formulario)
            const codIntegrante = document.getElementById('editCodIntegrante').value;

            //console.log(formData);

            try {
                // Realizar la solicitud PUT al servidor
                const response = await fetch(`/integrantes_de_la_familia/${codIntegrante}`, {
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
