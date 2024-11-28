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
                                    Creación plan
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Comedor
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
            <header>12.b Comedor</header>
            <form id="comedorForm" class="form">
                <div class="table-responsive">
                    <table class="table table-bordered" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="col">Detalle</th>
                                <th scope="col">SI</th>
                                <th scope="col">NO</th>
                                <th scope="col">
                                    Acciones para reducir la vulnerabilidad
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comedor as $fila)
                                <tr>
                                    <td>{{ $fila->detalle }}</td>
                                    <td>
                                        <input type="radio" name="respuesta_{{ $fila->cod_comedor }}" value="Si"
                                            {{ $fila->respuesta === 'Si' ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <input type="radio" name="respuesta_{{ $fila->cod_comedor }}" value="No"
                                            {{ $fila->respuesta === 'No' ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <textarea class="form-control"name="acciones_{{ $fila->cod_comedor }}">{{ $fila->acciones }}</textarea>
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
                    <button id="aceptar-btn" class="btn btn-primary">
                        Aceptar <i class="fa-solid fa-check"></i>
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
            const aceptarBtn = document.getElementById('aceptar-btn');

            // Obtener el valor de cod_familia desde localStorage
            const codFamilia = localStorage.getItem("codFamilia");

            //console.log(codFamilia);

            if (codFamilia) {
                // Agregar un listener de clic para redirigir al usuario
                aceptarBtn.addEventListener('click', (event) => {
                    event.preventDefault(); // Previene comportamientos predeterminados del botón.
                    const url = `/matriz_de_estructura_general_vivienda/${codFamilia}`;
                    //console.log("Redirigiendo a:", url);
                    window.location.href = url;
                });
            } else {
                console.error('El valor de cod_familia no está definido en localStorage.');

                // Si no hay cod_familia, podrías mostrar un mensaje o redirigir a una página predeterminada
                aceptarBtn.addEventListener('click', (e) => {
                    e
                        .preventDefault(); // Evitar la acción por defecto si cod_familia no está en localStorage
                    alert('No se encontró la familia, asegúrese de que la información esté disponible.');
                });
            }
        });
    </script>

    <script>
        document.getElementById('comedorForm').addEventListener('submit', async (event) => {
            event.preventDefault(); // Evita el envío predeterminado del formulario

            const cod_familia = "{{ $comedor->first()->cod_familia ?? '' }}";

            const form = event.target;
            const formData = new FormData(form);

            // Crear el objeto JSON a partir del formulario
            const data = {};
            formData.forEach((value, key) => {
                if (key.startsWith('respuesta_')) {
                    const id = key.split('_')[1];
                    if (!data[id]) data[id] = {};
                    data[id].respuesta = value;
                } else if (key.startsWith('acciones_')) {
                    const id = key.split('_')[1];
                    if (!data[id]) data[id] = {};
                    data[id].acciones = value;
                }
            });

            try {
                const response = await fetch('/comedor/actualizar', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        "X-CSRF-TOKEN": document.querySelector(
                                'meta[name="csrf-token"]'
                            ) ?
                            document.querySelector(
                                'meta[name="csrf-token"]'
                            ).content : "",
                    },
                    body: JSON.stringify({
                        estructuraVivienda: data
                    }),
                });

                const responseData = await response.json();

                if (responseData.success) {
                    //alert("Datos guardados correctamente");
                    window.location.href = `/sala/${cod_familia}`;
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
