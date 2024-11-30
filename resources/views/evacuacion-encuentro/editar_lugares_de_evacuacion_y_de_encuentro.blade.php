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
            <form id="lugaresForm" class="form" method="PUT">
                <!-- Método PUT para actualizaciones -->
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <label for="puntoReunion" style="font-weight: bold">Amenazas:</label>
                        <!-- Lista de amenazas agregadas -->
                        @foreach ($amenazasNom as $item)
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between">
                                    {{ $item->amenaza }}
                                </li>
                            </ul>
                        @endforeach
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <div class="form-group">
                            <label for="puntoReunion" style="font-weight: bold">Punto de reunión en caso de:</label>
                            <textarea type="text" class="form-control" name="puntoReunion" id="puntoReunion" rows="8" required>{{ $lugarEvacuacionEncuentro->punto_reunion }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="rutaEvac" style="font-weight: bold">Ruta de evacuación</label>
                            <textarea class="form-control" name="rutaEvac" id="rutaEvac" rows="5" required>{{ $lugarEvacuacionEncuentro->ruta_evacuacion }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row botonsform">
                    <div class="col">
                        <button type="button" id="editar" class="btn btn-warning">
                            Editar
                            <i class="fa-solid fa-pencil"></i>
                        </button>
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
    <div class="modal fade" id="regresarModal" tabindex="-1" aria-labelledby="regresarModalLabel"
        aria-hidden="true">
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
                    <a href="{{ url('amenazas/visualizar/' . $lugarEvacuacionEncuentro->cod_familia) }}"
                        class="btn btn-primary">Confirmar <i class="fa-solid fa-check"></i></a>
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
            const form = document.getElementById('lugaresForm');
            const editarButton = document.getElementById('editar');
            const inputs = form.querySelectorAll('textarea');

            // Deshabilitar todos los campos al cargar la página
            inputs.forEach(input => input.disabled = true);

            // Funcionalidad del botón Editar
            editarButton.addEventListener('click', () => {
                inputs.forEach(input => input.disabled = false); // Desbloquea todos los campos
                editarButton.disabled = true; // Desactiva el botón de editar
            });
        });
    </script>

    <script>
        document
            .getElementById("guardarYContinuar")
            .addEventListener("click", async function(event) {
                event.preventDefault(); // Prevenir que el formulario se envíe y se recargue

                // Obtener el valor de 'cod_familia' desde el formulario o algún otro lugar
                const cod_familia = "{{ $lugarEvacuacionEncuentro->cod_familia }}";

                // Obtiene los valores de los campos, incluido el campo oculto
                const puntoReunion = document
                    .getElementById("puntoReunion")
                    .value.trim();
                const rutaEvac = document
                    .getElementById("rutaEvac")
                    .value.trim();

                // Validación de campos obligatorios
                if (!cod_familia) {
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
                    cod_familia: cod_familia,
                    puntoReunion: puntoReunion,
                    rutaEvac: rutaEvac,
                };
                try {
                    //console.log("Datos a enviar:", data);

                    // Enviar datos al servidor
                    const response = await fetch(
                        `/lugares_de_evacuacion_y_de_encuentro/${cod_familia}`, {
                            method: "PUT",
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
                        // Redirigir a una nueva URL (ajusta la ruta según tu backend)
                        const url = `/integrantes_de_la_familia/visualizar/${cod_familia}`;
                        window.location.href = url; // Cambia la página
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
