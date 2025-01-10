<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de gestión de clientes">
    <title>Sistema de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h1 class="h3 mb-0">Gestión de Clientes</h1>
                            <span class="badge bg-primary" id="total-clientes">0 clientes</span>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-12 col-md-8">
                                <div class="input-group">
                                    <span class="input-group-text bg-white">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                    <input
                                        type="text"
                                        id="search"
                                        class="form-control border-start-0"
                                        placeholder="Buscar por nombre, apellido o RUT..."
                                    >
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <button type="button" onclick="buscarClientes()" class="btn btn-primary w-100">
                                    <i class="fas fa-search me-2"></i>Buscar
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Apellido</th>
                                        <th scope="col">RUT</th>
                                    </tr>
                                </thead>
                                <tbody id="tabla-clientes">
                                    <!-- Los datos se cargarán aquí dinámicamente -->
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div class="text-muted small" id="info-paginacion">
                                Mostrando 0 - 0 de 0 resultados
                            </div>
                            <nav aria-label="Paginación">
                                <ul class="pagination mb-0" id="paginacion"></ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let currentPage = 1;

        async function cargarClientes(page = 1) {
            try {
                const search = document.getElementById('search').value;
                const response = await fetch(`/api/clientes?page=${page}&search=${search}`);
                const data = await response.json();

                // Actualizar tabla
                const tbody = document.getElementById('tabla-clientes');
                tbody.innerHTML = '';

                data.data.forEach(cliente => {
                    tbody.innerHTML += `
                        <tr>
                            <td class="text-center">${cliente.id}</td>
                            <td>${cliente.nombre}</td>
                            <td>${cliente.apellido}</td>
                            <td>${cliente.rut}</td>
                        </tr>
                    `;
                });

                // Actualizar contador
                document.getElementById('total-clientes').textContent =
                    `${data.meta.total} clientes`;

                // Actualizar información de paginación
                const inicio = ((data.meta.current_page - 1) * data.meta.per_page) + 1;
                const fin = Math.min(data.meta.current_page * data.meta.per_page, data.meta.total);
                document.getElementById('info-paginacion').textContent =
                    `Mostrando ${inicio} - ${fin} de ${data.meta.total} resultados`;

                // Actualizar paginación
                actualizarPaginacion(data.meta);

                // Actualizar página actual
                currentPage = page;

            } catch (error) {
                console.error('Error:', error);
            }
        }

        function actualizarPaginacion(meta) {
            const ul = document.getElementById('paginacion');
            ul.innerHTML = '';

            // Botón "Anterior"
            const prevButton = document.createElement('li');
            prevButton.className = `page-item ${meta.current_page === 1 ? 'disabled' : ''}`;
            prevButton.innerHTML = `
                <button class="page-link" onclick="cargarClientes(${meta.current_page - 1})" ${meta.current_page === 1 ? 'disabled' : ''}>
                    Anterior
                </button>
            `;
            ul.appendChild(prevButton);

            // Números de página
            for (let i = 1; i <= meta.last_page; i++) {
                const li = document.createElement('li');
                li.className = `page-item ${meta.current_page === i ? 'active' : ''}`;
                li.innerHTML = `
                    <button class="page-link" onclick="cargarClientes(${i})">
                        ${i}
                    </button>
                `;
                ul.appendChild(li);
            }

            // Botón "Siguiente"
            const nextButton = document.createElement('li');
            nextButton.className = `page-item ${meta.current_page === meta.last_page ? 'disabled' : ''}`;
            nextButton.innerHTML = `
                <button class="page-link" onclick="cargarClientes(${meta.current_page + 1})" ${meta.current_page === meta.last_page ? 'disabled' : ''}>
                    Siguiente
                </button>
            `;
            ul.appendChild(nextButton);
        }

        function buscarClientes() {
            cargarClientes(1);
        }

        // Cargar clientes al iniciar
        document.addEventListener('DOMContentLoaded', () => {
            cargarClientes();
        });

        // Búsqueda al presionar Enter
        document.getElementById('search').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                buscarClientes();
            }
        });
    </script>
</body>
</html>
