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
                                    Resumen de la vulnerabilidad de la vivienda
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
            <header>13. Resumen de la vulnerabilidad de la vivienda</header>
            <form action="#" class="form">
                <div class="table-responsive">
                    <table class="table table-bordered" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="col">Detalle</th>
                                <th scope="col" class="text-center">
                                    <div class="d-flex justify-content-center">
                                        Espacio Físico
                                    </div>
                                    <div class="row row-cols-2"
                                        style="
                                                font-size: 0.85em;
                                                line-height: 1.2;
                                            ">
                                        <div class="col">
                                            a. Toda la vivienda
                                        </div>
                                        <div class="col">b. Comedor</div>
                                        <div class="col">c. Sala</div>
                                        <div class="col">d. Dormitorio</div>
                                        <div class="col">e. Baño</div>
                                        <div class="col">f. Cocina</div>
                                    </div>
                                </th>
                                <th scope="col">
                                    Acciones para reducir la vulnerabilidad
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vulnerabilidades as $vulnerabilidad)
                                <tr data-cod-vulnerabilidad="{{ $vulnerabilidad->cod_vulnerabilidad_vivienda }}">
                                    <!-- Columna del detalle -->
                                    <td>{{ $vulnerabilidad->detalle }}</td>

                                    <!-- Columna de checkboxes -->
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center" style="gap: 35px">
                                            @php
                                                // Asocia cada letra en minúscula con el campo correspondiente
                                                $espacios = [
                                                    'a' => 'toda_vivienda',
                                                    'b' => 'comedor',
                                                    'c' => 'sala',
                                                    'd' => 'dormitorio',
                                                    'e' => 'banio',
                                                    'f' => 'cocina',
                                                ];
                                            @endphp
                                            @foreach ($espacios as $letra => $campo)
                                                <div class="text-center">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="espacio_fisico[{{ $vulnerabilidad->cod_vulnerabilidad_vivienda }}][]"
                                                        id="espacioFisico_{{ $letra }}"
                                                        value="{{ $letra }}"
                                                        {{ $vulnerabilidad->$campo ? 'checked' : '' }} />
                                                    <div>{{ $letra }}</div> <!-- Letra en minúscula -->
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>

                                    <!-- Columna de acciones -->
                                    <td>
                                        <textarea class="form-control" name="acciones[{{ $vulnerabilidad->cod_vulnerabilidad_vivienda }}]"
                                            id="acciones_{{ $vulnerabilidad->cod_vulnerabilidad_vivienda }}">{{ $vulnerabilidad->acciones }}</textarea>
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
                    <button id="aceptar-btn" class="btn btn-primary">
                        Confirmar <i class="fa-solid fa-check"></i>
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
        document.addEventListener("DOMContentLoaded", () => {
            const aceptarBtn = document.getElementById("aceptar-btn");

            // Obtener el valor de cod_familia desde localStorage
            const codFamilia = "{{ $vulnerabilidades->first()->cod_familia ?? '' }}";

            //console.log(codFamilia);

            if (codFamilia) {
                // Agregar un listener de clic para redirigir al usuario
                aceptarBtn.addEventListener("click", (event) => {
                    event.preventDefault(); // Previene comportamientos predeterminados del botón.
                    const url = `/cocina/${codFamilia}`;
                    //console.log("Redirigiendo a:", url);
                    window.location.href = url;
                });
            } else {
                console.error(
                    "El valor de cod_familia no está definido en localStorage."
                );

                // Si no hay cod_familia, podrías mostrar un mensaje o redirigir a una página predeterminada
                aceptarBtn.addEventListener("click", (e) => {
                    e
                        .preventDefault(); // Evitar la acción por defecto si cod_familia no está en localStorage
                    alert(
                        "No se encontró la familia, asegúrese de que la información esté disponible."
                    );
                });
            }
        });
    </script>

    <script>
        document.getElementById("guardarYContinuar").addEventListener("click", async (e) => {
            e.preventDefault();

            const cod_familia = "{{ $vulnerabilidades->first()->cod_familia ?? '' }}";

            // Obtener todas las filas de la tabla
            const rows = document.querySelectorAll("tbody tr");

            // Array para almacenar los datos de todas las filas
            const data = Array.from(rows).map((row) => {
                // Obtener el ID del registro (cod_vulnerabilidad_vivienda) desde el atributo data-cod-vulnerabilidad
                const codVulnerabilidad = row.dataset.codVulnerabilidad || null;

                // Obtener los checkboxes marcados en la fila
                const checkboxes = row.querySelectorAll('input[type="checkbox"]:checked');

                // Construir un array con los valores seleccionados
                const espaciosSeleccionados = Array.from(checkboxes).map((cb) => cb.value);

                // Obtener el texto de la primera celda (detalle)
                const detalle = row.cells[0].innerText.trim();

                // Obtener el valor del textarea de la fila
                const acciones = row.querySelector("textarea").value.trim();

                return {
                    cod_vulnerabilidad_vivienda: codVulnerabilidad, // ID del registro (si existe)
                    detalle,
                    espacios_fisicos: espaciosSeleccionados, // Array de valores seleccionados (a, b, c, etc.)
                    acciones,
                };
            });

            //console.log(data);

            try {
                // Enviar los datos al backend
                const response = await fetch("/resumen_vulnerabilidad_vivienda/actualizar", {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.content ||
                            "",
                    },
                    body: JSON.stringify({
                        data, // Los datos de las filas de la tabla
                    }),
                });

                if (response.ok) {
                    const result = await response.json();
                    //alert("Datos guardados/actualizados exitosamente.");
                    window.location.href = `/grafico_vivienda`; // Ajusta la ruta
                } else {
                    const error = await response.json();
                    alert(`Error: ${error.message || "No se pudieron guardar los datos."}`);
                }
            } catch (err) {
                console.error("Error:", err);
                alert("Ocurrió un error inesperado.");
            }
        });
    </script>

</body>

</html>
