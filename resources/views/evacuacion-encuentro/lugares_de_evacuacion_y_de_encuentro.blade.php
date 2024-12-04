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
                                    Lugares de Evacuación y Encuentro
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
            <header>3. Lugares de Evacuación y Encuentro</header>
            <form class="form" method="POST" autocomplete="off">
                <!-- Campo oculto para cod_familia -->
                <input type="hidden" name="cod_familia" id="codFamiliaInput" />
                <div class="row">
                    <div class="col-md-6 col-12">
                        <label for="puntoReunion" style="font-weight: bold">Amenazas:</label>
                        <!-- Lista de amenazas agregadas -->
                        <ul class="list-group" id="amenazaList">
                        </ul>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <div class="form-group">
                            <label for="puntoReunion" style="font-weight: bold">Punto de reunión en caso de:</label>
                            <textarea type="text" class="form-control" name="puntoReunion" id="puntoReunion" rows="8" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="rutaEvac" style="font-weight: bold">Ruta de evacuación</label>
                            <textarea class="form-control" name="rutaEvac" id="rutaEvac" rows="5" required></textarea>
                        </div>
                    </div>
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
                    <a href="/amenazas" class="btn btn-primary">Confirmar <i class="fa-solid fa-check"></i></a>
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

            // Limpiar la lista
            const amenazaList = $("#amenazaList");
            amenazaList.empty();

            // Llenar la lista con las amenazas filtradas
            filteredAmenazas.forEach((item, index) => {
                const listItem = `<li class="list-group-item d-flex justify-content-between">
                                        ${item.amenaza}
                                </li>`;
                amenazaList.append(listItem);
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

                // Obtiene los valores de los campos, incluido el campo oculto
                const codFamilia =
                    document.getElementById("codFamiliaInput").value;
                const puntoReunion = document
                    .getElementById("puntoReunion")
                    .value.trim();
                const rutaEvac = document
                    .getElementById("rutaEvac")
                    .value.trim();

                // Validación de campos obligatorios
                if (!codFamilia) {
                    alert(
                        "No se encontró el código de la familia. Por favor, verifique."
                    );
                    return;
                }
                if (!puntoReunion || !rutaEvac) {
                    alert("Por favor, complete todos los campos.");
                    return;
                }

                // Datos a enviar al backend
                const data = {
                    cod_familia: codFamilia,
                    puntoReunion: puntoReunion,
                    rutaEvac: rutaEvac,
                };

                console.log("Datos enviados:", data);

                try {
                    //console.log("Datos a enviar:", data);

                    // Enviar datos al servidor
                    const response = await fetch(
                        "/lugares_de_evacuacion_y_de_encuentro", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]') ?
                                    document.querySelector('meta[name="csrf-token"]').content : "",
                            },
                            body: JSON.stringify(data),
                        }
                    );

                    const responseData = await response.json();

                    if (responseData.success) {
                        // Mostrar el toast con el mensaje de éxito
                        Toastify({
                            text: responseData.message,
                            duration: 1000, // Duración del toast (1 segundos)
                            close: true,
                            gravity: "top", // Ubicación del toast en la pantalla
                            position: "right",
                            backgroundColor: "green",
                        }).showToast();
                        //alert("Datos guardados correctamente");
                        setTimeout(() => {
                            window.location.href = "/integrantes_de_la_familia";
                        }, 1000);
                    } else {
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
