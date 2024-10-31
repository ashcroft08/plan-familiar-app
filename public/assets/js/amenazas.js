// Mapeo de las subcategorías según el tipo de amenaza
const subCategorias = {
    naturales: [
        { value: 'biologicas', text: 'Biológicas (Epidemia, Pandemia, Plaga)' },
        { value: 'geologicas', text: 'Geológicas (Actividad Volcánica, Deslizamiento, etc.)' },
        { value: 'hidrometeorologicas', text: 'Hidrometeorológicas (Avalancha, Inundación, etc.)' }
    ],
    antropicas: [
        { value: 'tecnologicas', text: 'Tecnológicas (Accidente minero, Explosión, etc.)' },
        { value: 'degradacion_ambiental', text: 'Degradación Ambiental (Incendio forestal, Intoxicación, etc.)' }
    ],
    sociales: [] // No se necesitan subcategorías para "sociales"
};

// Mapeo de las amenazas específicas según la subcategoría
const amenazasEspecificas = {
    biologicas: ['Epidemia', 'Pandemia', 'Plaga'],
    geologicas: ['Actividad Volcánica', 'Deslizamiento', 'Hundimiento', 'Sismo', 'Tsunami', 'Subsistencia'],
    hidrometeorologicas: ['Avalancha', 'Déficit Hídrico', 'Aluvión', 'Granizada', 'Helada', 'Inundación', 'Oleaje', 'Tormenta Eléctrica', 'Vendaval'],
    tecnologicas: ['Accidente Minero', 'Colapso Estructural', 'Explosión', 'Incendio Estructural'],
    degradacion_ambiental: ['Incendio Forestal', 'Intoxicación', 'Contaminación Ambiental'],
    desplazados: ['Desplazados Forzosos'],
    eventos_masivos: ['Perturbación en Eventos Masivos'],
    sociales: ['Desplazados Forzosos', 'Perturbación en Eventos Masivos', 'Paros/Protestas/Manifestaciones'] // Amenazas específicas de Sociales
};

// Lógica para el select de tipo de amenaza
document.getElementById('tipoAmenaza').addEventListener('change', function () {
    const tipo = this.value;
    const subAmenaza = document.getElementById('subAmenaza');
    const amenazaEspecifica = document.getElementById('amenazaEspecifica');

    // Limpiar y deshabilitar los selects secundarios
    subAmenaza.innerHTML = '<option value="" selected>Selecciona una subcategoría</option>';
    subAmenaza.disabled = true;
    amenazaEspecifica.innerHTML = '<option value="" selected>Selecciona una amenaza específica</option>';
    amenazaEspecifica.disabled = true;

    if (tipo === 'sociales') {
        // Si se selecciona "Sociales", saltar la subcategoría y cargar directamente las amenazas específicas
        amenazasEspecificas['sociales'].forEach(function (amenaza) {
            const option = document.createElement('option');
            option.value = amenaza.toLowerCase().replace(/\s+/g, '_');
            option.textContent = amenaza;
            amenazaEspecifica.appendChild(option);
        });
        amenazaEspecifica.disabled = false;
    } else if (tipo && subCategorias[tipo]) {
        // Añadir las opciones de subcategorías si el tipo de amenaza no es "sociales"
        subCategorias[tipo].forEach(function (sub) {
            const option = document.createElement('option');
            option.value = sub.value;
            option.textContent = sub.text;
            subAmenaza.appendChild(option);
        });
        subAmenaza.disabled = false;
    }
});

// Lógica para el select de subcategoría
document.getElementById('subAmenaza').addEventListener('change', function () {
    const sub = this.value;
    const amenazaEspecifica = document.getElementById('amenazaEspecifica');

    // Limpiar y deshabilitar el select de amenaza específica
    amenazaEspecifica.innerHTML = '<option value="" selected>Selecciona una amenaza específica</option>';
    amenazaEspecifica.disabled = true;

    if (sub && amenazasEspecificas[sub]) {
        // Añadir las opciones de amenazas específicas
        amenazasEspecificas[sub].forEach(function (amenaza) {
            const option = document.createElement('option');
            option.value = amenaza.toLowerCase().replace(/\s+/g, '_');
            option.textContent = amenaza;
            amenazaEspecifica.appendChild(option);
        });
        amenazaEspecifica.disabled = false;
    }
});