const express = require('express');
const router = express.Router();
const connection = require('../db');

// Endpoint para agregar una respuesta
router.post('/respuestas', (req, res) => {
    const { respuesta, pregunta, encuesta, encuestado } = req.body;

    const query = `
        INSERT INTO respuestas (respuesta, pregunta, encuesta, encuestado)
        VALUES (?, ?, ?, ?)
    `;

    connection.query(query, [respuesta, pregunta, encuesta, encuestado], (err, results) => {
        if (err) {
            console.error('Error al insertar la respuesta:', err);
            res.status(500).send('Error al guardar la respuesta');
            return;
        }
        res.status(201).send('Respuesta guardada exitosamente');
    });
});

// Endpoint para obtener todas las respuestas
router.get('/respuestas', (req, res) => {
    const query = 'SELECT * FROM respuestas';

    connection.query(query, (err, results) => {
        if (err) {
            console.error('Error al obtener las respuestas:', err);
            res.status(500).send('Error al obtener las respuestas');
            return;
        }
        res.json(results); // Devuelve las respuestas como JSON
    });
});

module.exports = router;
