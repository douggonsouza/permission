-- Sequence Drop Table

-- DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `permissions`;
DROP TABLE IF EXISTS `actions`;
DROP TABLE IF EXISTS `menus`;
DROP TABLE IF EXISTS `areas`;
DROP TABLE IF EXISTS `profiles`;
DROP TABLE IF EXISTS `sections`;

-- Sequande Create Table
CREATE TABLE `sections` (
  `section_id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(45) NOT NULL,
  `description` varchar(160) NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  `create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `profiles` (
  `profile_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(90) NOT NULL,
  `label` varchar(90) NOT NULL,
  `description` varchar(255) NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`profile_id`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `actions` (
  `action_id` int NOT NULL AUTO_INCREMENT,
  `action_slug` varchar(15) NOT NULL,
  `label` varchar(45) NOT NULL,
  `description` varchar(255) NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  `create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`action_id`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `areas` (
  `area_id` int NOT NULL AUTO_INCREMENT,
  `slug` varchar(90) NOT NULL,
  `label`varchar(45) NOT NULL,
  `description` varchar(160) NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  `create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`area_id`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `menus` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `label` varchar(25) NOT NULL,
  `url` varchar(160) NOT NULL,
  `icon` varchar(25) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`menu_id`),
  KEY `fk_menus_1_idx` (`profile_id`),
  KEY `fk_menus_2_idx` (`section_id`),
  CONSTRAINT `fk_menus_1` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`profile_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_menus_2` FOREIGN KEY (`section_id`) REFERENCES `sections` (`section_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `permissions` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `action_slug` varchar(15) NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`permission_id`),
  UNIQUE KEY `index2` (`profile_id`,`area_id`,`action_slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insere Permissões
INSERT INTO areas VALUES (null, 'users', 'Usuários', 'Permitir Usuário', 1, now());
INSERT INTO areas VALUES (null, 'profiles', 'Perfis', 'Permitir Usuário', 1, now());
INSERT INTO areas VALUES (null, 'areas', 'Areas', 'Permitir Usuário', 1, now());
INSERT INTO areas VALUES (null, 'permissions', 'Permissões', 'Permitir Usuário', 1, now());
INSERT INTO areas VALUES (null, 'actions', 'ações', 'Permitir Usuário', 1, now());

-- Insere perfis
INSERT INTO profiles VALUES (null, 'administrator','Administrador', 'acesso administrador', 1, now());
INSERT INTO profiles VALUES (null, 'member','Membro(a)', 'acesso membro(a)', 1, now());

-- Insere areas
INSERT INTO actions VALUES (null, 1, 'view', 'Ver', 1, now());
INSERT INTO actions VALUES (null, 1, 'delete', 'Excluir', 1, now());
INSERT INTO actions VALUES (null, 1, 'download', 'Baixar', 1, now());
INSERT INTO actions VALUES (null, 1, 'update', 'Mudar', 1, now());
INSERT INTO actions VALUES (null, 1, 'insert', 'Criar', 1, now());
INSERT INTO actions VALUES (null, 1, 'select', 'Listar', 1, now());
INSERT INTO actions VALUES (null, 1, 'upload', 'Enviar', 1, now());

-- Insere ações
INSERT INTO permissions VALUES (null, 1, 1, 'view', 1, now());
INSERT INTO permissions VALUES (null, 1, 1, 'delete', 1, now());
INSERT INTO permissions VALUES (null, 1, 1, 'download', 1, now());
INSERT INTO permissions VALUES (null, 1, 1, 'update', 1, now());
INSERT INTO permissions VALUES (null, 1, 1, 'insert', 1, now());
INSERT INTO permissions VALUES (null, 1, 1, 'select', 1, now());
INSERT INTO permissions VALUES (null, 1, 1, 'upload', 1, now());