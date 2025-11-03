-- ===========================================================
-- Base de données : SCHOOLIA
-- ===========================================================
CREATE DATABASE IF NOT EXISTS schoolia
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE schoolia;

-- ===========================================================
-- Table : niveau_scolaire
-- ===========================================================
CREATE TABLE IF NOT EXISTS niveau_scolaire (
    id_niveau_scolaire INT AUTO_INCREMENT,
    niveau VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_niveau_scolaire)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ===========================================================
-- Table : agent
-- ===========================================================
CREATE TABLE IF NOT EXISTS agent (
    id_agent INT AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    avatar VARCHAR(255),
    description TEXT,
    temperature FLOAT,
    system_prompt TEXT,
    PRIMARY KEY (id_agent)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ===========================================================
-- Table : matiere
-- ===========================================================
CREATE TABLE IF NOT EXISTS matiere (
    id_matiere INT AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    id_agent INT NOT NULL,
    PRIMARY KEY (id_matiere),
    FOREIGN KEY (id_agent) REFERENCES agent(id_agent)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ===========================================================
-- Table : utilisateur
-- ===========================================================
CREATE TABLE IF NOT EXISTS utilisateur (
    id_user INT AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('etudiant', 'professeur', 'admin') DEFAULT 'etudiant',
    id_niveau_scolaire INT NOT NULL,
    PRIMARY KEY (id_user),
    FOREIGN KEY (id_niveau_scolaire) REFERENCES niveau_scolaire(id_niveau_scolaire)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ===========================================================
-- Table : user_log
-- ===========================================================
CREATE TABLE IF NOT EXISTS user_log (
    id_userlog INT AUTO_INCREMENT,
    derniere_connection DATETIME,
    id_user INT NOT NULL,
    PRIMARY KEY (id_userlog),
    UNIQUE (id_user),
    FOREIGN KEY (id_user) REFERENCES utilisateur(id_user)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ===========================================================
-- Table : conversation
-- ===========================================================
CREATE TABLE IF NOT EXISTS conversation (
    id_conversation INT AUTO_INCREMENT,
    titre VARCHAR(150),
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_agent INT NOT NULL,
    id_user INT NOT NULL,
    PRIMARY KEY (id_conversation),
    FOREIGN KEY (id_agent) REFERENCES agent(id_agent)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (id_user) REFERENCES utilisateur(id_user)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ===========================================================
-- Table : message
-- ===========================================================
CREATE TABLE IF NOT EXISTS message (
    id_message INT AUTO_INCREMENT,
    question TEXT,
    reponse TEXT,
    id_conversation INT NOT NULL,
    PRIMARY KEY (id_message),
    FOREIGN KEY (id_conversation) REFERENCES conversation(id_conversation)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ===========================================================
-- Table : utiliser
-- ===========================================================
CREATE TABLE IF NOT EXISTS utiliser (
    id_user INT NOT NULL,
    id_agent INT NOT NULL,
    PRIMARY KEY (id_user, id_agent),
    FOREIGN KEY (id_user) REFERENCES utilisateur(id_user)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (id_agent) REFERENCES agent(id_agent)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ===========================================================
-- DONNÉES DE TEST
-- ===========================================================

-- Niveau scolaire
INSERT INTO niveau_scolaire (niveau)
VALUES 
('Collège'),
('Lycée'),
('Université');

-- Agent
INSERT INTO agent (nom, avatar, description, temperature, system_prompt)
VALUES
('Agent Mathéo', 'math.png', 'Agent spécialisé en mathématiques', 0.7, 'Tu es un assistant de mathématiques.'),
('Agent Histoire', 'hist.png', 'Agent passionné d\'histoire et de culture générale', 0.6, 'Tu es un professeur d\'histoire.'),
('Agent Scolaire', 'school.png', 'Agent généraliste pour le suivi scolaire', 0.8, 'Tu aides les élèves à organiser leur travail.');

-- Matière
INSERT INTO matiere (nom, id_agent)
VALUES
('Mathématiques', 1),
('Histoire', 2),
('Méthodologie', 3);

-- Utilisateur (avec passwords hashés via password_hash)
INSERT INTO utilisateur (nom, prenom, email, mot_de_passe, role, id_niveau_scolaire)
VALUES
('Dupont', 'Alice', 'alice.dupont@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'etudiant', 1),
('Martin', 'Jean', 'jean.martin@example.com', '$2y$10$DX5Z7z7KSEHe60DooxVTBeY1OK/PEMsqLSdsPiSUVVVVVVVVVVVVm', 'professeur', 2),
('Durand', 'Sophie', 'sophie.durand@example.com', '$2y$10$UuxjlAm6ZB0dCcAQhyyjB.HwQvDvGmwdsFc5XO9LhBbW5B5/4IUUS', 'admin', 3);

-- User log
INSERT INTO user_log (derniere_connection, id_user)
VALUES
(NOW() - INTERVAL 1 DAY, 1),
(NOW() - INTERVAL 3 DAY, 2),
(NOW(), 3);

-- Utiliser (relation user-agent)
INSERT INTO utiliser (id_user, id_agent)
VALUES
(1, 1),
(1, 3),
(2, 2),
(3, 3);

-- Conversation
INSERT INTO conversation (titre, id_agent, id_user)
VALUES
('Révision des équations', 1, 1),
('Chapitre sur la Révolution française', 2, 2);

-- Message
INSERT INTO message (question, reponse, id_conversation)
VALUES
('Comment résoudre une équation du second degré ?', 'Utilise la formule du discriminant Δ = b² - 4ac.', 1),
('Quand a eu lieu la prise de la Bastille ?', 'Le 14 juillet 1789.', 2);
