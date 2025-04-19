const connection = require('./db');

// Ejemplo de consulta
connection.query('SELECT * FROM docente', (err, results) => {
    if (err) {
        console.error('Error al ejecutar la consulta:', err);
        return;
    }
    console.log('Resultados:', results);
});