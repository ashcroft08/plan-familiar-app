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
            <form id="identificacionForm" class="form" method="POST">
                <input type="hidden" name="_method" value="PUT"> <!-- Campo oculto solo si es necesario -->
                <div class="table-responsive">
                    <table class="table table-bordered" style="width: 100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col">Amenaza</th>
                                <th scope="col">Efecto</th>
                                <th scope="col">¿Por qué puede ocurrir?</th>
                                <th scope="col">¿Qué podemos hacer?</th>
                            </tr>
                        </thead>
                        <tbody id="amenazasTableBody">
                            @foreach ($identificacionAmenaza as $index => $item)
                                <tr data-cod_identificacion="{{ $item->cod_identificacion }}">
                                    <td>{{ $item->cod_identificacion }}</td>
                                    <td>{{ $item->amenaza }}</td>
                                    <td>
                                        <textarea class="form-control efecto" id="efecto_{{ $index }}" rows="3" required>{{ $item->efecto }}</textarea>
                                    </td>
                                    <td>
                                        <textarea class="form-control razon" id="razon_{{ $index }}" rows="3" required>{{ $item->consecuencia }}</textarea>
                                    </td>
                                    <td>
                                        <textarea class="form-control accion" id="accion_{{ $index }}" rows="3" required>{{ $item->acciones }}</textarea>
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
                        <button type="button" id="guardarYContinuar" class="btn btn-success">
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
                    <a href="/integrantes_de_la_familia" class="btn btn-primary">Confirmar <i
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
        document.getElementById('guardarYContinuar').addEventListener('click', async () => {
            const cod_familia = "{{ $identificacionAmenaza->first()->cod_familia ?? '' }}";

            const filas = document.querySelectorAll('#amenazasTableBody tr');
            const amenazas = Array.from(filas).map(fila => ({
                cod_identificacion: fila.dataset.cod_identificacion,
                efecto: fila.querySelector('.efecto').value,
                consecuencia: fila.querySelector('.razon').value,
                acciones: fila.querySelector('.accion').value,
            }));

            try {
                const response = await fetch('/identificacion_de_amenazas', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        amenazas
                    }),
                });

                const data = await response.json();

                if (data.success) {
                    //alert(data.message);
                    // Redirigir a una nueva URL (ajusta la ruta según tu backend)
                    const url = `/recursos_familiares_disponibles`;
                    window.location.href = url; // Cambia la página
                } else {
                    alert(`Error: ${data.message}`);
                }
            } catch (error) {
                console.error('Error al actualizar las amenazas:', error);
                alert('Ocurrió un error al intentar actualizar las amenazas.');
            }
        });
    </script>

</body>

</html>
