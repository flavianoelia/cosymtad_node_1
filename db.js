require('dotenv').config(); // Cargar las variables de entorno desde el archivo .env
const mysql = require('mysql2');

// Configuración de la conexión usando variables de entorno
const connection = mysql.createConnection({
    host: process.env.DB_HOST, // Host de la base de datos
    user: process.env.DB_USER, // Usuario de la base de datos
    password: process.env.DB_PASSWORD, // Contraseña de la base de datos
    database: process.env.DB_NAME // Nombre de la base de datos
});

// Conectar a la base de datos
connection.connect((err) => {
    if (err) {
        console.error('Error al conectar a la base de datos:', err);
        return;
    }
    console.log('Conexión exitosa a la base de datos');
});

module.exports = connection;