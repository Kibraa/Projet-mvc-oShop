CREATE DATABASE ECOM;
\c ECOM;

CREATE TABLE category (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT
);

CREATE TABLE product (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    category_id INT REFERENCES category(id)
);

CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE social_links (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    url VARCHAR(255) NOT NULL,
    image VARCHAR(255)
);

CREATE TABLE cart (
    id SERIAL PRIMARY KEY,
    product_id INT REFERENCES product(id),
    quantity INT NOT NULL DEFAULT 1
);

INSERT INTO category (name, description) VALUES
('Détente', 'Chaussures confortables pour la maison et les loisirs.'),
('En ville', 'Chaussures élégantes pour une utilisation quotidienne.'),
('Au travail', 'Chaussures adaptées à un usage professionnel.');

INSERT INTO product (name, description, price, category_id) VALUES
('Chaussure Décontractée', 'Idéale pour les moments de détente.', 49.99, 1),
('Chaussure Ville Élégante', 'Parfaite pour vos sorties en ville.', 89.99, 2),
('Chaussure Professionnelle', 'Conçue pour le travail.', 129.99, 3);

INSERT INTO social_links (name, url, image) VALUES
('Facebook', 'https://facebook.com', 'facebook.jpg'),
('Twitter', 'https://twitter.com', 'twitter.jpg'),
('Instagram', 'https://instagram.com', 'instagram.jpg');

INSERT INTO cart (product_id, quantity) VALUES
(1, 2),
(2, 1),
(3, 1);
