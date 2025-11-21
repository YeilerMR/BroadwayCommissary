-- Crear base de datos (opcional, si aún no existe)
CREATE DATABASE IF NOT EXISTS broadway_commissary 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE broadway_commissary;

-- Tabla para suscriptores de correo electrónico
CREATE TABLE IF NOT EXISTS email_subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    subscribed_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    unsubscribed_at DATETIME NULL,
    active BOOLEAN NOT NULL DEFAULT TRUE,
    
    -- Índices para rendimiento
    INDEX idx_email (email),
    INDEX idx_active (active),
    INDEX idx_subscribed_at (subscribed_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla para envíos del formulario de contacto
CREATE TABLE IF NOT EXISTS contact_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(30) NOT NULL,
    subject VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    submitted_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    ip_address VARCHAR(45) NOT NULL,  -- Soporta IPv4 e IPv6 (máx. 45 chars)
    
    -- Índices para consultas frecuentes
    INDEX idx_email (email),
    INDEX idx_submitted_at (submitted_at),
    INDEX idx_ip_address (ip_address)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- [Opcional] Insertar registros de ejemplo para pruebas
INSERT INTO email_subscribers (email, active) VALUES
('test1@example.com', TRUE),
('test2@example.com', TRUE),
('test3@example.com', FALSE);

INSERT INTO contact_submissions (name, email, phone, subject, message, ip_address) VALUES
('John Doe', 'john@example.com', '+1 (555) 123-4567', 'Inquiry about services', 'I would like to know more about your services...', '192.168.1.1'),
('Jane Smith', 'jane@example.com', '+1 (555) 987-6543', 'Pricing question', 'Could you send me your current pricing list?', '203.0.113.45');