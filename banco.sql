CREATE DATABASE IFood;

USE IFood;

CREATE TABLE Usuarios (
    id INT AUTO_INCREMENT,
    nome VARCHAR(255),
    email VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(id)
);

CREATE TABLE Restaurantes (
    id INT AUTO_INCREMENT,
    nome VARCHAR(255),
    endereco VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(id)
);

CREATE TABLE Pratos (
    id INT AUTO_INCREMENT,
    nome VARCHAR(255),
    descricao TEXT,
    preco DECIMAL(5,2),
    restaurante_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(id),
    FOREIGN KEY (restaurante_id) REFERENCES Restaurantes(id) ON DELETE CASCADE
);

CREATE TABLE Pedidos (
    id INT AUTO_INCREMENT,
    usuario_id INT,
    restaurante_id INT,
    data_hora DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(id),
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (restaurante_id) REFERENCES Restaurantes(id) ON DELETE CASCADE
);

CREATE TABLE PedidosPratos (
    id INT AUTO_INCREMENT,
    pedido_id INT,
    prato_id INT,
    quantidade INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(id),
    FOREIGN KEY (pedido_id) REFERENCES Pedidos(id) ON DELETE CASCADE,
    FOREIGN KEY (prato_id) REFERENCES Pratos(id) ON DELETE CASCADE
);

INSERT INTO Usuarios (nome, email) VALUES
('João Silva', 'joao.silva@example.com'),
('Maria Pereira', 'maria.pereira@example.com');

INSERT INTO Restaurantes (nome, endereco) VALUES
('Restaurante A', 'Rua A, 123'),
('Restaurante B', 'Rua B, 456');

INSERT INTO Pratos (nome, descricao, preco, restaurante_id) VALUES
('Prato 1', 'Descrição do Prato 1', 10.00, 1),
('Prato 2', 'Descrição do Prato 2', 15.00, 1),
('Prato 3', 'Descrição do Prato 3', 20.00, 2),
('Prato 4', 'Descrição do Prato 4', 25.00, 2);

INSERT INTO Pedidos (usuario_id, restaurante_id, data_hora) VALUES
(1, 1, NOW()),
(2, 2, NOW());

INSERT INTO PedidosPratos (pedido_id, prato_id, quantidade) VALUES
(1, 1, 2),
(1, 2, 1),
(2, 3, 1),
(2, 4, 2);

INSERT INTO Usuarios (nome, email) VALUES
('admin', 'admin@admin'),
('Carlos Santos', 'carlos.santos@example.com'),
('Ana Oliveira', 'ana.oliveira@example.com');

INSERT INTO Restaurantes (nome, endereco) VALUES
('Restaurante C', 'Rua C, 789'),
('Restaurante D', 'Rua D, 101112');

INSERT INTO Pratos (nome, descricao, preco, restaurante_id) VALUES
('Prato 5', 'Descrição do Prato 5', 30.00, 3),
('Prato 6', 'Descrição do Prato 6', 35.00, 3),
('Prato 7', 'Descrição do Prato 7', 40.00, 4),
('Prato 8', 'Descrição do Prato 8', 45.00, 4);

INSERT INTO Pedidos (usuario_id, restaurante_id, data_hora) VALUES
(3, 3, NOW()),
(4, 4, NOW());

INSERT INTO PedidosPratos (pedido_id, prato_id, quantidade) VALUES
(3, 5, 2),
(3, 6, 1),
(4, 7, 1),
(4, 8, 2);