-- Sequence Drop Table

DROP TABLE IF EXISTS `jobs`;
DROP TABLE IF EXISTS `evaluations`;
DROP TABLE IF EXISTS `lessons`;
DROP TABLE IF EXISTS `students`;
DROP TABLE IF EXISTS `classes`;
DROP TABLE IF EXISTS `teachers`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `license_actions`;
DROP TABLE IF EXISTS `license_permissions`;
DROP TABLE IF EXISTS `license_profiles`;

-- Sequande Create Table
CREATE TABLE `license_profiles` (
  `profile_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(90) NOT NULL,
  `label` varchar(90) NOT NULL,
  `description` varchar(255) NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `license_permissions` (
  `permission_id` int NOT NULL AUTO_INCREMENT,
  `slug` varchar(90) NOT NULL,
  `description` varchar(160) NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  `create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `license_actions` (
  `action_id` int NOT NULL AUTO_INCREMENT,
  `profile_id` int NOT NULL,
  `action` enum('view','upload','delete','download','update','insert','list') NOT NULL,
  `permission_id` int NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`action_id`),
  KEY `profile_id_idx` (`profile_id`),
  KEY `permissions_fk_idx` (`permission_id`),
  CONSTRAINT `permissions_fk` FOREIGN KEY (`permission_id`) REFERENCES `license_permissions` (`permission_id`),
  CONSTRAINT `profile_fk` FOREIGN KEY (`profile_id`) REFERENCES `license_profiles` (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(120) CHARACTER SET utf8 NOT NULL,
  `profile_id` int NOT NULL,
  `jobs` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(160) CHARACTER SET utf8 NOT NULL,
  `birth` date DEFAULT NULL,
  `ddd` varchar(3) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `password` varchar(90) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`user_id`),
  KEY `fk_users_1_idx` (`profile_id`),
  CONSTRAINT `fk_users_1` FOREIGN KEY (`profile_id`) REFERENCES `license_profiles` (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `teachers` (
  `teacher_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`teacher_id`),
  KEY `fk_teachers_1_idx` (`user_id`),
  CONSTRAINT `fk_teachers_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `classes` (
  `class_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(85) CHARACTER SET utf8 NOT NULL,
  `teacher_id` int NOT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`class_id`),
  KEY `fk_classes_teachers1_idx` (`teacher_id`),
  CONSTRAINT `fk_classes_teachers1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `students` (
  `student_id` int NOT NULL AUTO_INCREMENT,
  `class_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`student_id`),
  KEY `fk_students_1_idx` (`user_id`),
  CONSTRAINT `fk_students_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `lessons` (
  `lesson_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(120) CHARACTER SET utf8 NOT NULL,
  `class_id` int NOT NULL,
  `code` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `teacher_id` int NOT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`lesson_id`),
  UNIQUE KEY `lesson_code_UNIQUE` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `evaluations` (
  `evaluation_id` int NOT NULL AUTO_INCREMENT,
  `question1` tinyint(1) DEFAULT NULL,
  `question2` tinyint(1) DEFAULT NULL,
  `question3` tinyint(1) DEFAULT NULL,
  `question4` tinyint(1) DEFAULT NULL,
  `question5` tinyint(1) DEFAULT NULL,
  `question6` tinyint(1) DEFAULT NULL,
  `question7` tinyint(1) DEFAULT NULL,
  `question8` tinyint(1) DEFAULT NULL,
  `question9` tinyint(1) DEFAULT NULL,
  `question10` tinyint(1) DEFAULT NULL,
  `comment` varchar(45) DEFAULT NULL,
  `lesson_id` int NOT NULL,
  `teacher_id` int NOT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`evaluation_id`),
  KEY `fk_evaluations_lessons_idx` (`lesson_id`),
  KEY `fk_evaluations_teachers1_idx` (`teacher_id`),
  CONSTRAINT `fk_evaluations_lessons` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`lesson_id`),
  CONSTRAINT `fk_evaluations_teachers1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `jobs` (
  `job_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8 NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insere Trabalhos
INSERT INTO jobs VALUES (null, 'Pastor Titular', 'Pastor principal', now(), 1);
INSERT INTO jobs VALUES (null, 'Pastor Ajudante', 'Pastor auxiliar', now(), 1);
INSERT INTO jobs VALUES (null, 'Missionária', 'Missionária', now(), 1);
INSERT INTO jobs VALUES (null, 'Aspirante a Pastor', 'Em período probatório', now(), 1);
INSERT INTO jobs VALUES (null, 'Presbítero', 'Presbítero', now(), 1);
INSERT INTO jobs VALUES (null, 'Diácono', 'Diácono', now(), 1);
INSERT INTO jobs VALUES (null, 'Diaconisa', 'Diaconisa', now(), 1);
INSERT INTO jobs VALUES (null, 'Líder de Ação Social', 'Líder de Ação Social', now(), 1);
INSERT INTO jobs VALUES (null, 'Líder de Adultos', 'Líder de Adultos', now(), 1);
INSERT INTO jobs VALUES (null, 'Líder de Jovens', 'Líder de Jovens', now(), 1);
INSERT INTO jobs VALUES (null, 'Conselheiro(a) de Adolescentes', 'Conselheiro(a) de Adolescentes', now(), 1);
INSERT INTO jobs VALUES (null, 'Líder de Adolescentes', 'Líder de Adolescentes', now(), 1);
INSERT INTO jobs VALUES (null, 'Conselheiro(a) de Crianças', 'Conselheiro(a) de Crianças', now(), 1);
INSERT INTO jobs VALUES (null, 'Líder de Crianças', 'Líder de Crianças', now(), 1);
INSERT INTO jobs VALUES (null, 'Líder de Música', 'Líder de Música', now(), 1);
INSERT INTO jobs VALUES (null, 'Líder de Missões', 'Líder de Missões', now(), 1);
INSERT INTO jobs VALUES (null, 'Líder de Escola Bíblica', 'Líder de Escola Bíblica', now(), 1);
INSERT INTO jobs VALUES (null, 'Professor de Escola Bíblica', 'Professor de Escola Bíblica', now(), 1);
INSERT INTO jobs VALUES (null, 'Tesoureiro(a)', 'Tesoureiro(a)', now(), 1);
INSERT INTO jobs VALUES (null, 'Membro(a)', 'Membro(a)', now(), 1);

-- Insere Permissões
INSERT INTO license_permissions VALUES (null, 'permission-users', 'Permitir Usuário', 1, now());
INSERT INTO license_permissions VALUES (null, 'permission-jobs', 'Permitir Trabalho', 1, now());

-- Insere perfis
INSERT INTO license_profiles VALUES (null, 'administrator','Administrador', 'acesso administrador', 1, now());
INSERT INTO license_profiles VALUES (null, 'minister','Ministro', 'acesso ministro', 1, now());
INSERT INTO license_profiles VALUES (null, 'pastor','Pastor', 'acesso pastor', 1, now());
INSERT INTO license_profiles VALUES (null, 'missionary','Missionária(o)', 'acesso missionária', 1, now());
INSERT INTO license_profiles VALUES (null, 'presbyter','Presbíterro', 'acesso presbítero', 1, now());
INSERT INTO license_profiles VALUES (null, 'deacon','Diácono(a)', 'acesso diácono(isa)', 1, now());
INSERT INTO license_profiles VALUES (null, 'aspirant','Aspirante', 'acesso aspirante', 1, now());
INSERT INTO license_profiles VALUES (null, 'member','Membro(a)', 'acesso membro(a)', 1, now());
INSERT INTO license_profiles VALUES (null, 'congregated','Congregado(a)', 'acesso congregado(a)', 1, now());
INSERT INTO license_profiles VALUES (null, 'unknown','Desconhecido(a)', 'acesso indefinido(a)', 1, now());

-- Insere ações
INSERT INTO license_actions VALUES (null, 1, 'view', 1, 1, now());
INSERT INTO license_actions VALUES (null, 1, 'delete', 1, 1, now());
INSERT INTO license_actions VALUES (null, 1, 'download', 1, 1, now());
INSERT INTO license_actions VALUES (null, 1, 'update', 1, 1, now());
INSERT INTO license_actions VALUES (null, 1, 'insert', 1, 1, now());
INSERT INTO license_actions VALUES (null, 1, 'select', 1, 1, now());
INSERT INTO license_actions VALUES (null, 1, 'upload', 1, 1, now());
INSERT INTO license_actions VALUES (null, 1, 'view', 2, 1, now());
INSERT INTO license_actions VALUES (null, 1, 'delete', 2, 1, now());
INSERT INTO license_actions VALUES (null, 1, 'download', 2, 1, now());
INSERT INTO license_actions VALUES (null, 1, 'update', 2, 1, now());
INSERT INTO license_actions VALUES (null, 1, 'insert', 2, 1, now());
INSERT INTO license_actions VALUES (null, 1, 'select', 2, 1, now());
INSERT INTO license_actions VALUES (null, 1, 'upload', 2, 1, now());