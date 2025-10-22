-- tests/_data/dump.sql (Ahora para MySQL)
CREATE TABLE IF NOT EXISTS test_menus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titol VARCHAR(255) NOT NULL,
    descripcio TEXT,
    ordre INT DEFAULT 0,
    publicat BOOLEAN DEFAULT TRUE
);

-- Aquí puedes añadir cualquier otro esquema de tabla necesario para tus tests.