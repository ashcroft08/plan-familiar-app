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
                                    Información General
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
            <header>1. Información General</header>
            <form id="familiaForm" class="form" method="PUT"
                action="/informacion_general/{{ $informacion_general->cod_familia }}" autocomplete="off">
                <!-- Método PUT para actualizaciones -->
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="col-md-6 col-12 mb-3">
                        <div class="form-group">
                            <label for="nombreFam" style="font-weight: bold">Nombre de la familia acogiente</label>
                            <input type="text" class="form-control" name="nombreFam" id="nombreFam"
                                value="{{ $informacion_general->familia_acogiente }}" required />
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="direccionFam" style="font-weight: bold">Dirección del domicilio</label>
                            <input type="text" class="form-control" name="direccionFam" id="direccionFam"
                                value="{{ $informacion_general->direccion_domicilio }}" required />
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <div class="form-group">
                            <label for="telFam" style="font-weight: bold">Número de teléfono familia acogiente</label>
                            <input type="text" class="form-control" name="telFam" id="telFam"
                                value="{{ $informacion_general->telf_familia_acogiente }}" required />
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="provincia" style="font-weight: bold">Provincia</label>
                            <input type="text" class="form-control" name="provincia" id="provincia"
                                value="{{ $informacion_general->provincia }}" required />
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <div class="form-group">
                            <label for="canton" style="font-weight: bold">Cantón</label>
                            <input type="text" class="form-control" name="canton" id="canton"
                                value="{{ $informacion_general->canton }}" required />
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="barrio" style="font-weight: bold">Comunidad/Barrio/Recinto:</label>
                            <select class="form-control mb-2" id="selectOption" name="opcionBcr"
                                style="font-weight: bold">
                                <option value="comunidad"
                                    {{ $informacion_general->opcion_bcr == 'comunidad' ? 'selected' : '' }}>Comunidad
                                </option>
                                <option value="barrio"
                                    {{ $informacion_general->opcion_bcr == 'barrio' ? 'selected' : '' }}>Barrio</option>
                                <option value="recinto"
                                    {{ $informacion_general->opcion_bcr == 'recinto' ? 'selected' : '' }}>Recinto
                                </option>
                            </select>
                            <input type="text" class="form-control mb-3" name="nombreBcr" id="barrio"
                                value="{{ $informacion_general->nombre_bcr }}" required />
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-5">
                        <div class="form-group">
                            <label for="numCasa" style="font-weight: bold">Número de casa</label>
                            <input type="text" class="form-control" name="numCasa" id="numCasa"
                                value="{{ $informacion_general->numero_casa }}" required />
                        </div>
                    </div>
                </div>
                <div class="row botonsform">
                    <div class="col">
                        <button type="submit" id="guardarYContinuar" class="btn btn-success">
                            Siguiente
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </form>
        </section>
    </div>

    <!-- Modal para eliminar plan -->
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteLabel" style="font-weight: bold;">
                        ¿Seguro que desea
                        ir al Inicio?
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Si regresa al inicio,
                    se perderán los datos
                    que has ingresado hasta
                    ahora.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                        <i class="fa-solid fa-ban"></i>
                    </button>
                    <button type="button"class="btn btn-primary" id="eliminarPlan">
                        Aceptar
                        <i class="fa-solid fa-check"></i>
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
        function updatePlaceholder() {
            const selectOption = document.getElementById("selectOption");
            const barrioInput = document.getElementById("barrio");
            barrioInput.placeholder = `Nombre de ${
                    selectOption.options[selectOption.selectedIndex].text
                }`;
        }
    </script>

    <script>
        document.getElementById("guardarYContinuar").addEventListener("click", async function(event) {
            event.preventDefault(); // Prevenir que el formulario se envíe y se recargue

            // Obtener el valor de 'cod_familia' desde el formulario o algún otro lugar
            const cod_familia = "{{ $informacion_general->cod_familia }}";

            // Obtener los valores de cada campo
            const nombreFam = document.getElementById("nombreFam").value.trim();
            const direccionFam = document.getElementById("direccionFam").value.trim();
            const telFam = document.getElementById("telFam").value.trim();
            const provincia = document.getElementById("provincia").value.trim();
            const canton = document.getElementById("canton").value.trim();
            const opcionBcr = document.getElementById("selectOption").value;
            const nombreBcr = document.getElementById("barrio").value.trim();
            const numCasa = document.getElementById("numCasa").value.trim();

            // Validación básica de los campos
            if (
                !nombreFam ||
                !direccionFam ||
                !telFam ||
                !provincia ||
                !canton ||
                !nombreBcr ||
                !numCasa
            ) {
                alert("Por favor, complete todos los campos");
                return;
            }

            if (isNaN(telFam)) {
                alert("El número de teléfono debe ser numérico");
                return;
            }

            // Datos a enviar
            const data = {
                nombreFam: nombreFam,
                direccionFam: direccionFam,
                telFam: telFam,
                provincia: provincia,
                canton: canton,
                opcionBcr: opcionBcr,
                nombreBcr: nombreBcr,
                numCasa: numCasa,
            };

            // Depuración: Verificar los datos que se van a enviar
            //console.log("Enviando datos:", data);

            try {
                // Realizar la solicitud PUT
                const response = await fetch(`/informacion_general/${cod_familia}`, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        // Si se usa CSRF, pasa el token como encabezado
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]') ?
                            document.querySelector('meta[name="csrf-token"]').content : "",
                    },
                    body: JSON.stringify(data),
                });

                // Esperar la respuesta y convertirla a JSON
                const responseData = await response.json();

                if (responseData.success) {
                    // Redirige al siguiente formulario tras actualizar correctamente
                    // Redirigir a una nueva URL (ajusta la ruta según tu backend)
                    const url = `/amenazas`;
                    window.location.href = url; // Cambia la página
                } else {
                    // Si la respuesta es falsa (ya existe un duplicado), mostrar el mensaje y no redirigir
                    alert(responseData.message);
                }
            } catch (error) {
                console.error("Error en la solicitud:", error);
                alert("Hubo un error al enviar la solicitud");
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            var codFamilia;

            // Capturar el cod_familia cuando se hace clic en el botón de eliminar
            $('#modalDelete').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // El botón que activó el modal
                codFamilia = button.data('cod_familia'); // Obtener el cod_familia desde data-cod_familia
            });

            // Confirmar la eliminación
            $('#eliminarPlan').click(function() {
                $.ajax({
                    url: '/' + codFamilia, // Usar el cod_familia en la URL
                    type: 'DELETE',
                    success: function(response) {
                        // Cerrar el modal
                        $('#modalDelete').modal('hide');
                        window.location.href = "/";
                    },
                    error: function(response) {
                        alert('Error al eliminar el plan');
                    }
                });
            });
        });
    </script>
</body>

</html>
