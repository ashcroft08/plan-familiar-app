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
            <header>5. Identificación de amenazas</header>
            <form action="#" class="form" method="POST">
                <!-- Campo oculto para cod_familia -->
                <input type="hidden" name="cod_familia" id="codFamiliaInput" />
                <div class="table-responsive">
                    <table class="table table-bordered" style="width: 100%">
                        <thead>
                            <tr>
                                <!-- <th scope="col">#</th> -->
                                <th scope="col">Amenaza</th>
                                <th scope="col">Efecto</th>
                                <th scope="col">¿Por qué puede ocurrir?</th>
                                <th scope="col">¿Qué podemos hacer?</th>
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
                    <a href="/integrantes_de_la_familia" class="btn btn-primary">Aceptar <i
                            class="fa-solid fa-check"></i></a>
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
                                <td data-cod_amenaza="${item.cod_amenaza}">${item.amenaza}</td>
                                <td><textarea class="form-control efecto" id="efecto_${index}" rows="3" required></textarea></td>
                                <td><textarea class="form-control razon" id="razon_${index}" rows="3" required></textarea></td>
                                <td><textarea class="form-control accion" id="accion_${index}" rows="3" required></textarea></td>
                            </tr>`;
                tbody.append(row);
            });
        });
    </script>


    <script>
        // Asignar el valor de cod_familia al campo oculto al cargar la página
        document.addEventListener("DOMContentLoaded", function() {
            const codFamilia = localStorage.getItem("codFamilia");
            if (codFamilia) {
                document.getElementById("codFamiliaInput").value =
                    codFamilia;
            } else {
                alert(
                    "No se encontró el código de familia en localStorage."
                );
            }
        });

        document
            .getElementById("guardarYContinuar")
            .addEventListener("click", async function(event) {
                event.preventDefault(); // Prevenir que el formulario se envíe y se recargue

                // Obtiene el valor del campo oculto cod_familia
                const codFamilia = localStorage.getItem("codFamilia");

                // Validación del código de familia
                if (!codFamilia) {
                    alert("No se encontró el código de la familia. Por favor, verifique.");
                    return;
                }

                // Variables para almacenar los datos de amenazas
                const amenazas = [];

                // Recorre las filas de la tabla para obtener los datos de cada amenaza
                const rows = document.querySelectorAll("#amenazasTableBody tr");
                rows.forEach((row, index) => {
                    const codAmenaza = row.cells[0].getAttribute(
                    "data-cod_amenaza"); // Obtener el cod_amenaza
                    const efecto = document.getElementById(`efecto_${index}`).value.trim();
                    const razon = document.getElementById(`razon_${index}`).value.trim();
                    const accion = document.getElementById(`accion_${index}`).value.trim();

                    // Validación de campos de cada fila
                    if (!codAmenaza || !efecto || !razon || !accion) {
                        alert("Por favor, complete todos los campos de las amenazas.");
                        return;
                    }

                    // Agrega la amenaza a la lista de datos a enviar
                    amenazas.push({
                        cod_familia: codFamilia,
                        cod_amenaza: codAmenaza,
                        efecto: efecto,
                        consecuencia: razon,
                        acciones: accion,
                    });
                });

                // Verifica si hay al menos una amenaza ingresada
                if (amenazas.length === 0) {
                    alert("Debe ingresar al menos una amenaza.");
                    return;
                }

                // Datos a enviar al backend
                const data = {
                    cod_familia: codFamilia,
                    amenazas: amenazas
                };

                try {
                    // Enviar datos al servidor
                    const response = await fetch(
                        "identificacion_de_amenazas", {
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
                            body: JSON.stringify(data),
                        }
                    );

                    const responseData = await response.json();

                    if (responseData.success) {
                        alert("Datos guardados correctamente");
                        window.location.href = "/recursos_familiares_disponibles";
                    } else {
                        alert(
                            responseData.message ||
                            "Hubo un error al guardar los datos"
                        );
                    }
                } catch (error) {
                    console.error("Error:", error);
                    alert("Error en la solicitud");
                }
            });
    </script>
</body>

</html>
