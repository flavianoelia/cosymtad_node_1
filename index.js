const express = require('express');
const connection = require('./db'); // Conexión a la base de datos
const respuestasRoutes = require('./routes/respuestas'); // Importar las rutas de respuestas


const app = express();
const PORT = 3000;

// Middleware para manejar JSON
app.use(express.json());

// Ruta para la raíz del servidor
app.get('/', (req, res) => {
    res.send('Bienvenido a la API de Cosymtad Node.js');
});

// Ruta de prueba para verificar la conexión a la base de datos
app.get('/docentes', (req, res) => {
    connection.query('SELECT * FROM docente', (err, results) => {
        if (err) {
            console.error('Error al ejecutar la consulta:', err);
            res.status(500).send('Error al obtener los docentes');
            return;
        }
        res.json(results); // Devuelve los resultados como JSON
    });
});

// Usar las rutas de respuestas
app.use('/', respuestasRoutes); // app.use('/api', respuestasRoutes); api es solo una convención


// Iniciar el servidor
app.listen(PORT, () => {
    console.log(`Servidor corriendo en http://localhost:${PORT}`);
});