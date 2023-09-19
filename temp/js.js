// Realiza una solicitud GET a datos.php usando fetch
fetch('php.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('La solicitud falló');
        }
        return response.json();
    })
    .then(data => {
        // Actualiza el contenido de la página con los datos obtenidos
        document.getElementById('nombre').textContent = data.nombre;
        document.getElementById('edad').textContent = data.edad;
        document.getElementById('ciudad').textContent = data.ciudad;
    })
    .catch(error => {
        console.error('Error:', error);
    });
