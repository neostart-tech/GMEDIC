-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 13 mars 2024 à 18:40
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gmedic_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `article_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `article_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `categorie_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `articles_categorie_id_foreign` (`categorie_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `article_name`, `article_desc`, `article_image`, `published`, `categorie_id`, `created_at`, `updated_at`) VALUES
(1, 'Resmed Airsense 11', 'L\'AirSense 11 est un appareil auto-ajustable, ce qui signifie qu\'il ajuste automatiquement la pression de l\'air en fonction de vos besoins. Il dispose également d\'un certain nombre d\'autres fonctionnalités conçues pour rendre le traitement plus confortable et efficace, notamment :\r\n\r\nUn humidificateur intégré qui ajoute de l\'humidité à l\'air, ce qui peut aider à réduire la sécheresse et l\'irritation de la gorge\r\nUne fonction de rampe qui augmente progressivement la pression de l\'air au début de la thérapie, ce qui peut vous aider à vous y adapter plus facilement\r\nUn confort Un système de masque qui permet de choisir parmi une variété de masques afin de trouver celui qui vous convient le mieux\r\nL\'AirSense 11 est un traitement efficace pour l\'apnée du sommeil. Dans une étude, les personnes qui ont utilisé l\'AirSense 11 ont présenté une réduction significative du nombre d\'événements d\'apnée du sommeil et ont déclaré avoir une meilleure qualité de sommeil.', 'article_images/scOxcKAc0xrjlrlFsDp3l2fH6NXPgsiAHhokKAEU.jpg', 1, 1, '2024-02-07 07:23:10', '2024-02-07 07:33:23'),
(5, 'devilbiss sleepcube', 'Le Devilbiss SleepCube est un appareil à pression positive continue (PPC) qui aide à traiter l\'apnée du sommeil. Il s\'agit d\'un appareil de thérapie respiratoire qui envoie de l\'air pressurisé par un masque qui s\'adapte sur votre nez et votre bouche. L\'air pressurisé aide à maintenir les voies respiratoires ouvertes pendant votre sommeil, ce qui permet d\'empêcher les événements d\'apnée du sommeil. \r\n\r\nLe SleepCube est disponible en deux modèles :\r\n\r\nSleepCube Standard : Il s\'agit d\'un appareil à pression fixe, ce qui signifie qu\'il délivre une pression d\'air constante tout au long de la nuit.\r\nSleepCube BiLevel : Il s\'agit d\'un appareil à deux niveaux, ce qui signifie qu\'il délivre deux pressions d\'air différentes : une pression plus élevée pour l\'inspiration et une pression plus basse pour l\'expiration.', 'article_images/upSVB0UrrCQtb3jyoKQxNZNWnxPjV8vx0Kqz02ok.jpg', 1, 1, '2024-02-07 07:39:30', '2024-02-07 08:56:15'),
(6, 'Resmed airsense 10', 'L\'AirSense 10 est un appareil à pression positive continue (PPC) qui aide à traiter l\'apnée du sommeil. Il s\'agit d\'un appareil de thérapie respiratoire qui envoie de l\'air pressurisé par un masque qui s\'adapte sur votre nez et votre bouche. L\'air pressurisé aide à maintenir vos voies respiratoires ouvertes pendant que vous dormez, ce qui permet d\'empêcher les événements d\'apnée du sommeil. \r\n\r\nL\'AirSense 10 est disponible en deux modèles :\r\n\r\nAirSense 10 AutoSet : Il s\'agit d\'un appareil auto-ajustable, ce qui signifie qu\'il ajuste automatiquement la pression d\'air en fonction de vos besoins.\r\n\r\nAirSense 10 Elite : Il s\'agit d\'un appareil à pression fixe, ce qui signifie qu\'il délivre une pression d\'air constante tout au long de la nuit.\r\n\r\nL\'AirSense 10 dispose d\'un certain nombre de fonctionnalités qui en font un choix populaire pour les personnes souffrant d\'apnée du sommeil, notamment :\r\n\r\nUn design compact et léger : L\'AirSense 10 est petit et facile à transporter, ce qui le rend idéal pour voyager.\r\nUn fonctionnement silencieux : L\'AirSense 10 est l\'un des appareils CPAP les plus silencieux du marché, ce qui en fait un bon choix pour les personnes sensibles au bruit.\r\n\r\nUn humidificateur intégré : L\'humidificateur intégré ajoute de l\'humidité à l\'air, ce qui peut aider à réduire la sécheresse et l\'irritation de la gorge.\r\n\r\nUne fonction de rampe : La fonction de rampe augmente progressivement la pression de l\'air au début de la thérapie, ce qui peut vous aider à vous y adapter plus facilement.\r\n\r\nUn suivi des données : L\'AirSense 10 suit vos données de thérapie, telles que le nombre d\'événements d\'apnée du sommeil et les heures d\'utilisation de la thérapie. \r\n\r\nCes données peuvent être utilisées pour suivre vos progrès et apporter des ajustements à votre traitement si nécessaire.', 'article_images/sCoO5spres1WaRMcxfAqpGhbajRQVowz4IDpPhhy.webp', 1, 1, '2024-02-07 07:43:13', '2024-02-07 08:56:18'),
(4, 'Resmed air mini (PPC voyage)', 'Le ResMed AirMini est un appareil CPAP portable conçu pour les personnes souffrant d\'apnée du sommeil qui voyagent fréquemment ou préfèrent simplement un appareil plus petit et plus discret. Voici un résumé de ses principales caractéristiques :\r\n\r\nCompact et léger : Il s\'agit du CPAP le plus petit et le plus léger. machine sur le marché, pesant environ 10 onces et tenant dans la paume de votre main. Cela le rend idéal pour les voyages ou pour les siestes loin de chez vous. \r\n\r\nHumidification sans eau : L\'AirMini utilise une technologie unique appelée HumidX pour fournir de l\'humidité à l\'air sans avoir besoin d\'un réservoir d\'eau encombrant. Ceci est particulièrement pratique pour voyager et facilite le nettoyage de l\'appareil.\r\n\r\nTechnologie AutoSet : L\'AirMini est livré avec AutoSet, une technologie qui ajuste automatiquement la pression d\'air tout au long de la nuit pour répondre à vos besoins individuels. Cela garantit que vous recevez le niveau optimal de thérapie pour un sommeil confortable et efficace.\r\n\r\nFonctionnement silencieux : L\'AirMini est l\'une des machines CPAP les plus silencieuses disponibles, ce qui la rend moins perturbatrice pour votre sommeil et celui de votre partenaire.\r\n\r\nApplication pour smartphone : L\'application AirMini vous permet de contrôler vos paramètres de thérapie, de suivre vos données de sommeil et de dépanner tout problème. C\'est un moyen pratique de rester informé de votre thérapie et d\'effectuer les ajustements nécessaires.', 'article_images/JEAiaC33uoBLBbCPPDQwI0p8vFbTdPAG8EWECqoH.webp', 1, 1, '2024-02-07 07:35:32', '2024-02-15 19:54:03'),
(7, 'resmed mirage fx', 'Le ResMed Mirage FX est un masque nasal CPAP avec un design de support frontal qui est un précurseur de la série AirFit populaire d\'aujourd\'hui. Il est conçu pour être confortable et facile à utiliser, et il dispose d\'un certain nombre de fonctionnalités qui en font un choix populaire pour les personnes souffrant d\'apnée du sommeil. \r\n\r\nCaractéristiques du masque nasal ResMed Mirage FX :\r\n\r\nCoussin à double paroi SpringAir : Le coussin est conçu pour fournir un joint confortable et scellé, et il dispose de deux parois d\'air pour aider à réduire la pression sur le pont du nez.\r\n\r\nSupport frontal ultra-flexible : Le support est conçu pour s\'adapter à différentes formes de visage et il est flexible pour permettre un mouvement pendant le sommeil.\r\n\r\nHarnais minimaliste : Le harnais est conçu pour être léger et confortable, et il est facile à mettre et à enlever.\r\n\r\nSoufflet à dégagement rapide : Le soufflet est conçu pour se détacher facilement du masque, ce qui vous permet de vous lever et de vous déplacer sans avoir à retirer le masque.', 'article_images/kZRMAJiPph620Gw1eKVIJrgPCcVQI3OtCZU2hVDy.jpg', 1, 2, '2024-02-07 07:47:27', '2024-02-15 19:53:59'),
(8, 'Moniteur multiparametique', 'Un moniteur multiparamétrique est un appareil utilisé pour surveiller plusieurs paramètres physiologiques d\'un patient. Il s\'agit d\'un équipement médical essentiel utilisé dans les hôpitaux, les cliniques et les cabinets médicaux. Les moniteurs multiparamétriques peuvent être utilisés pour surveiller les patients de tous âges, y compris les nouveau-nés, les enfants et les adultes.\r\n\r\nLes paramètres les plus courants surveillés par les moniteurs multiparamétriques comprennent :\r\n\r\nFréquence cardiaque : La fréquence cardiaque est le nombre de battements cardiaques par minute. C\'est un indicateur important de la santé cardiaque et respiratoire.\r\n\r\nPression artérielle : La pression artérielle est la force du sang contre les parois des artères. C\'est un indicateur important de la santé cardiovasculaire.\r\n\r\nSpO2 : La SpO2 est le pourcentage d\'oxygène dans le sang. C\'est un indicateur important de la santé respiratoire.\r\n\r\nTempérature : La température est la mesure de la chaleur corporelle. C\'est un indicateur important de l\'infection et d\'autres conditions.\r\nLes moniteurs multiparamétriques peuvent également surveiller d\'autres paramètres, tels que :\r\n\r\nTaux respiratoire : Le taux respiratoire est le nombre de respirations qu\'une personne prend par minute. C\'est un indicateur important de la santé respiratoire.\r\n\r\nÉlectrocardiogramme (ECG) : L\'ECG est un enregistrement de l\'activité électrique du cœur. Il peut être utilisé pour diagnostiquer des arythmies cardiaques et d\'autres affections cardiaques.\r\n\r\nOxymétrie de pouls : L\'oxymétrie de pouls est une mesure du niveau d\'oxygène dans le sang. Il peut être utilisé pour diagnostiquer une hypoxémie, une condition dans laquelle le sang ne reçoit pas suffisamment d\'oxygène.\r\n\r\nCapnographie : La capnographie est une mesure du dioxyde de carbone dans le sang. Il peut être utilisé pour diagnostiquer une insuffisance respiratoire et d\'autres affections respiratoires.', 'article_images/LtXXpKejMV2Ie2MnHo0dnSxnl9Kp0hOAJV1IivDW.jpg', 1, 3, '2024-02-07 07:51:39', '2024-02-15 19:53:56'),
(9, 'tensiometre omron', 'Un tensiomètre Omron est un appareil utilisé pour mesurer la pression artérielle. Omron est une marque leader dans le domaine des tensiomètres domestiques et propose une large gamme d\'appareils adaptés à différents besoins et budgets. \r\n\r\nVoici quelques-unes des caractéristiques des tensiomètres Omron :\r\n\r\nFacilité d\'utilisation: Les tensiomètres Omron sont conçus pour être faciles à utiliser, même pour les personnes peu familières avec la mesure de la pression artérielle.\r\n\r\nPrécision: Les tensiomètres Omron sont cliniquement validés pour leur précision.\r\n\r\nFiabilité: Les tensiomètres Omron sont fabriqués avec des matériaux de haute qualité et sont conçus pour durer.\r\n\r\nCaractéristiques supplémentaires: De nombreux tensiomètres Omron offrent des fonctionnalités supplémentaires, telles que la détection des irrégularités du rythme cardiaque, le suivi de la mémoire et la connectivité Bluetooth.', 'article_images/M7lEATF7atPNO4TNnJdtkKHsuadmNggV5Xv2F6qK.jpg', 1, 3, '2024-02-07 07:54:02', '2024-02-15 19:53:53'),
(10, 'Glucomètre', 'Un glucomètre est un appareil utilisé pour mesurer la quantité de glucose dans le sang. C\'est un outil important pour les personnes atteintes de diabète, car il leur permet de surveiller leur glycémie et de gérer leur maladie.\r\n\r\nLes glucomètres fonctionnent en mesurant la quantité de courant électrique générée lorsque le glucose dans le sang réagit avec une enzyme sur une bandelette de test. Le résultat est affiché en milligrammes par décilitre (mg/dL) ou en millimoles par litre (mmol/L).', 'article_images/PsIGlVMxrVzs5LNhVJDwvQkNMB40AfKMYVDq3rxM.jpg', 1, 3, '2024-02-07 07:56:16', '2024-03-13 18:20:14');

-- --------------------------------------------------------

--
-- Structure de la table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `blog_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_desc` text COLLATE utf8mb4_unicode_ci,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_desc`, `published`, `created_at`, `updated_at`) VALUES
(1, 'CPAP - PPC', 'description', 1, '2024-02-07 07:18:32', '2024-02-15 09:28:28'),
(2, 'Masque', 'description', 1, '2024-02-07 07:18:50', '2024-02-15 08:58:49'),
(3, 'Autres appareils médicaux', 'Autre appareil médicaux', 1, '2024-02-07 07:48:25', '2024-02-08 17:24:28');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `messages_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10, '2014_10_12_000000_create_users_table', 2),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(11, '2024_02_02_091557_create_blogs_table', 3),
(6, '2024_02_02_091609_create_messages_table', 1),
(7, '2024_02_02_091618_create_articles_table', 1),
(8, '2024_02_02_091628_create_categories_table', 1),
(9, '2024_02_02_102143_create_sliders_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_id` bigint UNSIGNED DEFAULT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_id`, `tokenable_type`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'App\\Models\\User', 'jubaer', '6b85e77ef463129cad9d78ad8ac50f335d351635df9ac0d357b94305963e3888', '[\"*\"]', '2024-02-05 16:20:39', NULL, '2024-02-05 14:26:06', '2024-02-05 16:20:39'),
(2, 1, 'App\\Models\\User', 'jubaer', '8902249ce1b1d0a2c3e77a6855a9f0be1d612473b86449943d9539ad4fd27694', '[\"*\"]', '2024-02-05 20:41:43', NULL, '2024-02-05 16:19:24', '2024-02-05 20:41:43'),
(3, 1, 'App\\Models\\User', 'jubaer', 'c758a2998a0be4965e5d45aceb6a330ac25e8dee6fecb7b0830c26476357d256', '[\"*\"]', '2024-02-07 06:10:39', NULL, '2024-02-06 17:07:48', '2024-02-07 06:10:39'),
(4, 1, 'App\\Models\\User', 'jubaer', '957ae3d16626d56b792dda660de464bc6011d4527641cffb5fb72b8d987c625c', '[\"*\"]', '2024-02-08 18:25:46', NULL, '2024-02-07 06:07:46', '2024-02-08 18:25:46'),
(5, 1, 'App\\Models\\User', 'jubaer', 'b51b093f87f05bd5f9d10bff8f570e281cbfe3d7ce6a2b138eff2f616a9d3f8f', '[\"*\"]', '2024-02-15 19:43:28', NULL, '2024-02-14 22:21:57', '2024-02-15 19:43:28'),
(6, 1, 'App\\Models\\User', 'jubaer', '4c7a16ff039a7b82f6de0ddd62a638e41a5b130031b6c6175a23537f8901db2a', '[\"*\"]', '2024-02-15 19:54:09', NULL, '2024-02-15 18:52:55', '2024-02-15 19:54:09'),
(7, 1, 'App\\Models\\User', 'jubaer', '43c2f32bfdce73fce15629eaf377e3691e7a5adbbe0fd9ddddb0988ec0025786', '[\"*\"]', '2024-03-13 18:20:15', NULL, '2024-03-13 17:10:15', '2024-03-13 18:20:15'),
(8, 1, 'App\\Models\\User', 'jubaer', '2943b7c5721aa0e4af9baa5823e1195262fd65e6ce941d35b8d61f888842dcc2', '[\"*\"]', NULL, NULL, '2024-03-13 18:12:09', '2024-03-13 18:12:09');

-- --------------------------------------------------------

--
-- Structure de la table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `slider_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slide_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sliders`
--

INSERT INTO `sliders` (`id`, `slider_desc`, `slide_image`, `published`, `created_at`, `updated_at`) VALUES
(6, '', 'slide_images/KZYHJNlWv8CUxi30cXkVojK0XPF5auyfWEctQBLK.webp', 1, '2024-02-07 08:00:46', '2024-02-07 08:00:55'),
(2, 'Test', 'slide_images/xSuPvyDHuZbzOSxtJ1U1zqqZyy2VltfQjJB5CuyG.jpg', 0, '2024-02-04 19:44:04', '2024-02-05 16:19:51'),
(3, 'Test', 'slide_images/BsHrqBADXWCaBWJBpaT6w3gI14eRGHqwlmRTR3Xl.jpg', 0, '2024-02-04 19:44:19', '2024-02-07 08:09:46'),
(4, 'Test second', 'slide_images/TqzsWTETqwaV1WS8FHyYwujTHQeOVgjcpVPH7XI0.jpg', 0, '2024-02-04 19:45:40', '2024-02-07 08:09:49'),
(5, 'Nouvel arrivage', 'slide_images/UokhJYYwleGYsZkQ0OGbWQj6s4fGqPkOAN6XK2U4.jpg', 0, '2024-02-05 16:00:14', '2024-02-07 08:09:45'),
(7, '', 'slide_images/Iqz7oWA7ZfZAkxVY8aIfYhr3Zo9gqSqLAT9BBQyD.webp', 1, '2024-02-07 08:04:36', '2024-02-07 08:04:44'),
(8, '', 'slide_images/qma7RgJvIS7s7DYcSiJxZ5nb7S0WEbLgKfL9E7Fv.jpg', 1, '2024-02-07 08:08:56', '2024-02-07 08:09:18');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'email.test@gmail.com', NULL, '$2y$12$FtSN0LtX0kNdQZL231UGn.bJ2YGxOvcLx3eBI4qdW23u5WCdxgZwO', NULL, '2024-02-02 15:53:13', '2024-02-02 15:53:13');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
