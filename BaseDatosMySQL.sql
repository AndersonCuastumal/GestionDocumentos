/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `pruebaphp` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pruebaphp`;

CREATE TABLE IF NOT EXISTS `doc_documentos` (
  `doc_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `doc_nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doc_codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doc_contenido` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doc_id_proceso` bigint unsigned NOT NULL,
  `doc_id_tipo` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`doc_id`),
  KEY `doc_documentos_doc_id_proceso_foreign` (`doc_id_proceso`),
  KEY `doc_documentos_doc_id_tipo_foreign` (`doc_id_tipo`),
  CONSTRAINT `doc_documentos_doc_id_proceso_foreign` FOREIGN KEY (`doc_id_proceso`) REFERENCES `pro_procesos` (`id`),
  CONSTRAINT `doc_documentos_doc_id_tipo_foreign` FOREIGN KEY (`doc_id_tipo`) REFERENCES `tip_tipo_docs` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `doc_documentos` (`doc_id`, `doc_nombre`, `doc_codigo`, `doc_contenido`, `doc_id_proceso`, `doc_id_tipo`, `created_at`, `updated_at`) VALUES
	(1, 'INSTRUCTIVO DE DESARROLLO', 'INS-ING-2', 'texto grande con el contenido del documento', 1, 1, NULL, NULL),
	(2, 'Documento A', 'EXA-ADM-3', 'texto grande con el contenido del documento', 2, 2, NULL, NULL),
	(3, 'Informe', 'INF-MRK-4', 'texto grande con el contenido del documento', 3, 3, NULL, NULL),
	(4, 'Contrato', 'CON-DEV-5', 'texto grande con el contenido del documento', 4, 4, NULL, NULL),
	(5, 'Presentación', 'PRE-RH-6', 'texto grande con el contenido del documento', 5, 5, NULL, NULL),
	(6, 'INSTRUCTIVO DE DESARROLLO', 'INS-ING-7', 'texto grande con el contenido del documento', 1, 1, NULL, NULL),
	(7, 'Documento A', 'EXA-ADM-8', 'texto grande con el contenido del documento', 2, 2, NULL, NULL),
	(8, 'Informe', 'INF-MRK-9', 'texto grande con el contenido del documento', 3, 3, NULL, NULL),
	(9, 'Contrato', 'CON-DEV-10', 'texto grande con el contenido del documento', 4, 4, NULL, NULL);

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(4, '2023_06_21_184940_create_pro_procesos_table', 1),
	(5, '2023_06_21_185000_create_tip_tipo_docs_table', 1),
	(6, '2023_06_21_185024_create_doc_documentos_table', 1);

CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `pro_procesos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pro_nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pro_prefijo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pro_procesos` (`id`, `pro_nombre`, `pro_prefijo`) VALUES
	(1, 'Ingeniería', 'ING'),
	(2, 'Administración', 'ADM'),
	(3, 'Marketing', 'MRK'),
	(4, 'Desarrollo de Producto', 'DEV'),
	(5, 'Recursos Humanos', 'RH');

CREATE TABLE IF NOT EXISTS `tip_tipo_docs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tip_nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tip_prefijo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tip_tipo_docs` (`id`, `tip_nombre`, `tip_prefijo`) VALUES
	(1, 'Instructivo', 'INS'),
	(2, 'Examen', 'EXA'),
	(3, 'Informe', 'INF'),
	(4, 'Contrato', 'CON'),
	(5, 'Presentación', 'PRE');

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin', 'admin@email.com', '$2y$10$XJQOu7LCnA7HEz5fT7yQDe4ZcuXxzS1NDxQ25ZapkuO0VCqxLKT.a', '2023-06-24 07:34:25', '2023-06-24 07:34:25');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
