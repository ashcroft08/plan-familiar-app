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
                                    Identificación de amenazas
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
                            @foreach ($amenazasNom as $index => $item)
                                <tr>
                                    <td data-cod_amenaza="{{ $item->cod_amenaza }}">{{ $item->amenaza }}</td>
                                    <td>
                                        <textarea class="form-control efecto" id="efecto_{{ $index }}" rows="3" required></textarea>
                                    </td>
                                    <td>
                                        <textarea class="form-control razon" id="razon_{{ $index }}" rows="3" required></textarea>
                                    </td>
                                    <td>
                                        <textarea class="form-control accion" id="accion_{{ $index }}" rows="3" required></textarea>
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
                    Si regresa, los datos ingresados en este formulario no se guardarán.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar <i class="fa-solid fa-ban"></i>
                    </button>
                    <a href="/integrantes_de_la_familia" class="btn btn-primary">Confirmar <i
                            class="fa-solid fa-check"></i></a></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Enlazar jQuery localmente -->
    <script src="/assets/js/jquery-3.7.1.min.js"></script>
    <!-- Enlazar Bootstrap JS -->
    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>

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
                let toastShown = false; // Bandera para verificar si se muestra el toast
                let valid = true; // Bandera para validar el formulario

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
                        // Mostrar el toast de advertencia solo una vez
                        if (!toastShown) {
                            Toastify({
                                text: "Por favor, complete todos los campos",
                                duration: 1500, // Duración del toast (1 segundos)
                                close: true,
                                gravity: "top", // Ubicación del toast en la pantalla
                                position: "right",
                                backgroundColor: "orange", // Color de fondo para advertencia
                            }).showToast();
                            toastShown = true; // Marcar que ya se mostró el toast
                        }
                        valid = false; // Marcar que la validación falló
                        return; // Detener la ejecución de esta iteración
                    }

                    // Agrega la amenaza a la lista de datos a enviar si la fila es válida
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
                    // Mostrar el toast de advertencia
                    if (!toastShown) {
                        Toastify({
                            text: "Debe ingresar al menos una amenaza",
                            duration: 1500, // Duración del toast (1 segundos)
                            close: true,
                            gravity: "top", // Ubicación del toast en la pantalla
                            position: "right",
                            backgroundColor: "orange", // Color de fondo para advertencia
                        }).showToast();
                        toastShown = true; // Marcar que ya se mostró el toast
                    }
                    valid = false; // Marcar que la validación falló
                    return; // Detener la ejecución del código
                }

                // Si la validación pasó, continúa con el envío de datos
                if (valid) {
                    // Datos a enviar al backend
                    const data = {
                        cod_familia: codFamilia,
                        amenazas: amenazas
                    };

                    try {
                        // Enviar datos al servidor
                        const response = await fetch("/identificacion_de_amenazas", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]') ?
                                    document.querySelector('meta[name="csrf-token"]').content : "",
                            },
                            body: JSON.stringify(data),
                        });

                        const responseData = await response.json();

                        if (responseData.success) {
                            // Mostrar el toast con el mensaje de éxito
                            Toastify({
                                text: responseData.message,
                                duration: 1500, // Duración del toast (1 segundos)
                                close: true,
                                gravity: "top", // Ubicación del toast en la pantalla
                                position: "right",
                                backgroundColor: "green",
                            }).showToast();

                            setTimeout(() => {
                                window.location.href = "/recursos_familiares_disponibles";
                            }, 1000);

                        } else {
                            Toastify({
                                text: responseData.message,
                                duration: 1500, // Duración del toast (1 segundos)
                                close: true,
                                gravity: "top",
                                position: "right",
                                backgroundColor: "red",
                            }).showToast();
                        }
                    } catch (error) {
                        console.error("Error:", error);
                        Toastify({
                            text: "Hubo un problema con la solicitud",
                            duration: 1500, // Duración del toast (3 segundos)
                            close: true,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "red",
                        }).showToast();
                    }
                }
            });
    </script>
</body>

</html>
