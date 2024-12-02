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
                                    Inicio
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Visualización de Plan
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Gráfico de la vivienda
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
            <header>14. Gráfico de la vivienda</header>
            <form id="miFormulario">
                <label for="inputGroupFile01" class="form-label" style="font-weight: bold">Interior de la
                    Vivienda</label>
                <div id="preview01">
                    <!-- Mostrar la imagen ya almacenada para el interior de la vivienda -->
                    @if ($graficoVivienda->interior_vivienda)
                        <img src="{{ url('images/grafico_vivienda_interior/' . $graficoVivienda->interior_vivienda) }}"
                            alt="Interior Vivienda" style="max-width: 200px;">
                    @else
                        <p>No hay imagen cargada.</p>
                    @endif
                </div>
                <br />
                <div class="input-group mb-3">
                    <input type="file" class="form-control" name="inputGroupFile01" id="inputGroupFile01" />
                    <label class="input-group-text" for="inputGroupFile01">Cargar</label>
                </div>

                <label for="inputGroupFile02" class="form-label"
                    style="font-weight: bold">Barrio/Recinto/Comunidad</label>
                <div id="preview02">
                    <!-- Mostrar la imagen ya almacenada para el barrio -->
                    @if ($graficoVivienda->brc)
                        <img src="{{ url('images/grafico_vivienda_exterior/' . $graficoVivienda->brc) }}"
                            alt="Exterior Vivienda" style="max-width: 200px;">
                    @else
                        <p>No hay imagen cargada.</p>
                    @endif
                </div>
                <br />
                <div class="input-group mb-3">
                    <input type="file" class="form-control" name="inputGroupFile02" id="inputGroupFile02" />
                    <label class="input-group-text" for="inputGroupFile02">Cargar</label>
                </div>

                <label for="coordenada_x" class="form-label" style="font-weight: bold">Coordenada X</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="coordenada_x" id="coordenada_x"
                        value="{{ $graficoVivienda->coordenada_x }}" required />
                </div>

                <label for="coordenada_y" class="form-label" style="font-weight: bold">Coordenada Y</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="coordenada_y" id="coordenada_y"
                        value="{{ $graficoVivienda->coordenada_y }}" required />
                </div>

                <div class="row botonsform">
                    <div class="col">
                        <!-- Botón para abrir el modal de "Regresar" -->
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#regresarModal"
                            class="btn btn-secondary">Regresar
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                        <button type="submit" id="guardarYFinalizar" class="btn btn-danger">
                            Finalizar
                            <i class="fas fa-sign-out-alt"></i>
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

    <!-- Script para mostrar la previsualización de imágenes -->
    <script>
        // Función para mostrar la previsualización de la imagen cargada
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.innerHTML = '<img src="' + e.target.result +
                        '" alt="Vista previa" style="max-width: 200px;">';
                };

                reader.readAsDataURL(file);
            }
        }

        // Escuchar cambios en los inputs de archivos y actualizar la vista previa
        document.getElementById('inputGroupFile01').addEventListener('change', function() {
            previewImage(this, 'preview01');
        });

        document.getElementById('inputGroupFile02').addEventListener('change', function() {
            previewImage(this, 'preview02');
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const aceptarBtn = document.getElementById("aceptar-btn");

            // Obtener el valor de cod_familia desde localStorage
            const cod_familia = "{{ $graficoVivienda->cod_familia }}";

            //console.log(cod_familia);

            if (cod_familia) {
                // Agregar un listener de clic para redirigir al usuario
                aceptarBtn.addEventListener("click", (event) => {
                    event.preventDefault(); // Previene comportamientos predeterminados del botón.
                    const url = `/resumen_vulnerabilidad_vivienda/visualizar/${cod_familia}`;
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
        // Función para enviar el formulario
        async function enviarFormulario() {
            // Obtener los datos del formulario
            const form = document.getElementById("miFormulario");
            const formData = new FormData(form); // Crear un FormData con los datos del formulario

            // Obtener el cod_grafico_vivienda desde la variable Blade
            const cod_grafico_vivienda = "{{ $graficoVivienda->cod_grafico_vivienda }}";

            console.log(cod_grafico_vivienda)

            if (cod_grafico_vivienda) {
                formData.append("cod_grafico_vivienda", cod_grafico_vivienda); // Agregarlo al FormData
            } else {
                alert("El código gráfico de vivienda no está disponible.");
                return;
            }

            try {
                // Hacer la solicitud PUT con fetch
                const response = await fetch(`/grafico_vivienda/actualizar/${cod_grafico_vivienda}`, {
                    method: "PUT", // Cambia a PATCH si tu API lo requiere
                    body: formData, // El FormData contiene los archivos y demás datos
                });

                // Verificar si la respuesta fue exitosa
                const result = await response.json();

                if (result.success) {
                    alert("Datos actualizados correctamente");
                    window.location.href = "/"; // Redirigir tras el éxito
                } else {
                    alert("Error: " + result.message);
                }
            } catch (error) {
                console.error("Error al enviar el formulario:", error);
                alert("Hubo un error al enviar el formulario.");
            }
        }

        // Llamar a la función cuando el formulario sea enviado
        document
            .getElementById("miFormulario")
            .addEventListener("submit", function(event) {
                event.preventDefault(); // Prevenir el envío del formulario por defecto
                enviarFormulario();
            });
    </script>
</body>

</html>
