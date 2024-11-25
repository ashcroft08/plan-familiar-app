<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Visualizacón plano</title>
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
                                    Visualizacón plan
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Números de emergencia
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
            <header>10. Números de emergencia</header>
            <form id="numerosForm" class="form" method="PUT">
                <div class="table-responsive">
                    <table class="table table-bordered" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Contacto:</th>
                                <th>Número Telefónico:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Centro de Salud/Hospital Cercano:</td>
                                <td>
                                    <input type="text" name="hospitalCercano" id="hospitalCercano"
                                        class="form-control" value="{{ $numeroEmergencia->hospital }}" />
                                </td>
                            </tr>
                            <tr>
                                <td>Médico del Barrio:</td>
                                <td>
                                    <input type="text" name="medicoBarrio" id="medicoBarrio" class="form-control"
                                        value="{{ $numeroEmergencia->medico_barrio }}" />
                                </td>
                            </tr>
                            <tr>
                                <td>Familiar #1:</td>
                                <td>
                                    <input type="text" name="fam1" id="fam1" class="form-control"
                                        value="{{ $numeroEmergencia->familiar1 }}" />
                                </td>
                            </tr>
                            <tr>
                                <td>Familiar #2:</td>
                                <td>
                                    <input type="text" name="fam2" id="fam2" class="form-control"
                                        value="{{ $numeroEmergencia->familiar2 }}" />
                                </td>
                            </tr>
                            <tr>
                                <td>Familiar #3:</td>
                                <td>
                                    <input type="text" name="fam3" id="fam3" class="form-control"
                                        value="{{ $numeroEmergencia->familiar3 }}" />
                                </td>
                            </tr>
                            <tr>
                                <td>UPC:</td>
                                <td>
                                    <input type="text" name="upc" id="upc" class="form-control"
                                        value="{{ $numeroEmergencia->upc }}" />
                                </td>
                            </tr>
                            <tr>
                                <td>Bomberos:</td>
                                <td>
                                    <input type="text" name="bomberos" id="bomberos" class="form-control"
                                        value="{{ $numeroEmergencia->bomberos }}" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
                    <h1 class="modal-title fs-5" id="regresarModalLabel">
                        ¿Seguro que desea regresar?
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Si regresa, se perderán los datos que haya editado en este formulario.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar <i class="fa-solid fa-ban"></i>
                    </button>
                    <a href="{{ url('plan_accion_recuperacion/visualizar/' . $numeroEmergencia->cod_familia) }}" class="btn btn-primary">Aceptar <i
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
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('numerosForm');
            const editarButton = document.getElementById('editar');
            const inputs = form.querySelectorAll('input');

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

                // Obtiene los valores de cada campo
                const cod_familia = "{{ $numeroEmergencia->cod_familia }}"
                const cod_numero_emergencia = "{{ $numeroEmergencia->cod_numero_emergencia }}";
                const hospitalCercano = document
                    .getElementById("hospitalCercano")
                    .value.trim();
                const medicoBarrio = document
                    .getElementById("medicoBarrio")
                    .value.trim();
                const fam1 = document.getElementById("fam1").value.trim();
                const fam2 = document.getElementById("fam2").value.trim();
                const fam3 = document.getElementById("fam3").value.trim();
                const upc = document.getElementById("upc").value.trim();
                const bomberos = document
                    .getElementById("bomberos")
                    .value.trim();

                // Validación básica de los campos
                if (
                    !hospitalCercano ||
                    !medicoBarrio ||
                    !fam1 ||
                    !fam2 ||
                    !fam3 ||
                    !upc ||
                    !bomberos
                ) {
                    alert("Por favor, complete todos los campos");
                    return;
                }

                // Validación de que los números telefónicos sean numéricos
                if (
                    isNaN(hospitalCercano) ||
                    isNaN(medicoBarrio) ||
                    isNaN(fam1) ||
                    isNaN(fam2) ||
                    isNaN(fam3) ||
                    isNaN(upc) ||
                    isNaN(bomberos)
                ) {
                    alert(
                        "Todos los números telefónicos deben ser numéricos"
                    );
                    return;
                }

                // Datos a enviar
                const data = {
                    hospitalCercano: hospitalCercano,
                    medicoBarrio: medicoBarrio,
                    fam1: fam1,
                    fam2: fam2,
                    fam3: fam3,
                    upc: upc,
                    bomberos: bomberos,
                };

                // Envío de datos al servidor con fetch
                try {
                    const response = await fetch(`/numeros_emergencia/${cod_numero_emergencia}`, {
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
                    });

                    const responseData = await response.json();

                    if (responseData.success) {
                        // Redirigir a una nueva URL (ajusta la ruta según tu backend)
                        const url = `/mi_mascota/visualizar/${cod_familia}`;
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
