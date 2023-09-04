// Crear un array de objetos
var data = [
    { nombre: 'Ejemplo 1', edad: 25 },
    { nombre: 'Ejemplo 2', edad: 30 },
    // Agrega más objetos aquí si es necesario
  ];
  
  // Convierte el array de objetos a JSON
  var jsonData = JSON.stringify(data);
  
  // Enviar los datos a PHP utilizando fetch
  fetch('php.php', {
    method: 'POST',
    body: jsonData, // El JSON que contiene los datos
    headers: {
      'Content-Type': 'application/json'
    }
  })
  .then(function(response) {
    return response.text();
  })
  .then(function(data) {
    console.log(data); // Puedes hacer algo con la respuesta de PHP aquí
  })
  .catch(function(error) {
    console.error('Error:', error);
  });
  