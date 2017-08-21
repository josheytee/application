-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2017 at 09:47 PM
-- Server version: 5.7.9
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ntc_doctrine`
--
CREATE DATABASE IF NOT EXISTS `ntc_doctrine` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ntc_doctrine`;

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
  `id_activity` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id_activity`),
  KEY `id_activity_url_idx` (`id_activity`,`url`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id_activity`, `name`, `description`, `url`, `icon`, `created`, `updated`) VALUES
(22, 'Choose your main activity', 'Nihil voluptatibus accusantium assumenda culpa similique totam et. Temporibus fuga consectetur velit neque vero minus. Reprehenderit autem architecto quia occaecati quis consequuntur soluta.', 'https://schneider.com/quo-aut-dolorem-nihil-est.html', 'http://walter.net/', '2016-09-04 14:45:32', '1975-02-09 06:52:22'),
(23, 'Lingerie and Adult', 'Exercitationem provident earum tempora. Deserunt natus exercitationem pariatur et ut adipisci expedita. Est sit accusamus voluptatem excepturi excepturi ea.', 'https://ebert.com/quam-a-ut-illo-quia.html', 'https://howe.info/sapiente-laudantium-nulla-et.html', '2013-08-10 11:52:13', '1978-08-20 04:16:39'),
(24, 'Animals and Pets', 'Temporibus fugit facilis enim sit. Maxime quas vero ad autem est voluptas distinctio. Explicabo vero qui impedit illo rerum ab voluptates.', 'https://www.little.com/voluptas-est-non-mollitia-excepturi-vel-fuga-quos', 'https://www.larson.com/veritatis-quo-repellat-omnis-quod-ad-dolorem-officiis-veniam', '1983-04-03 18:06:09', '1975-09-26 22:49:35'),
(25, 'Art and Culture', 'Consequatur odit eum tempora odit quia consequuntur odit. Blanditiis quo ducimus repudiandae quia harum cupiditate aut. Qui illo vero beatae rerum deleniti perspiciatis enim. Eveniet officia provident commodi tempore.', 'http://www.schoen.com/', 'https://www.cormier.com/et-soluta-est-exercitationem-deserunt', '1993-12-13 07:39:41', '2009-05-23 17:08:26'),
(26, 'Babies', 'Ut sit sed vitae vero dolorem maxime magnam. Dolore eos consectetur laborum aliquid omnis ut quia deserunt. Iusto sed dolorem aut animi illum perspiciatis nemo.', 'http://schiller.com/', 'https://www.beatty.com/facere-ut-ut-est-quia-et-porro', '2015-12-20 14:33:39', '1994-01-25 14:45:40'),
(27, 'Beauty and Personal Care', 'Exercitationem et sint mollitia aut eum. Aut reiciendis et qui eveniet. Minima sed tempore ea repellat necessitatibus dignissimos. Perferendis perspiciatis qui dolorem dolor nisi cupiditate. Officiis labore ducimus ratione.', 'http://mayer.net/at-voluptatum-sapiente-architecto.html', 'http://schneider.com/ipsa-nisi-et-sit-est-dignissimos-et', '1977-11-07 06:06:02', '1986-03-17 18:46:49'),
(28, 'Cars', 'Eos optio id soluta voluptatem dicta molestias veritatis rem. Ea iste sed accusamus explicabo et esse. Nesciunt sit soluta dolor. Explicabo nulla iusto occaecati beatae ut mollitia odio.', 'http://beer.biz/molestiae-deserunt-deserunt-quis-laudantium-exercitationem-rem-aut-quasi', 'http://haley.com/quaerat-laudantium-quod-dicta-cumque-aliquid', '1982-05-29 04:14:00', '1976-07-12 06:13:12'),
(29, 'Computer Hardware and Software', 'Tenetur repellendus veritatis ea ut ad vitae. Voluptatum est omnis ex deserunt. Eligendi dignissimos aut hic. Autem qui et ea facilis dolores.', 'http://kessler.net/', 'http://www.kuhlman.com/ad-debitis-impedit-culpa-ratione.html', '2011-06-21 04:37:18', '1988-08-18 16:34:58'),
(30, 'Download', 'Vero quia ab quis reprehenderit nisi in recusandae. Ea earum earum a accusantium laudantium accusamus ut. Reprehenderit nihil saepe sit qui ut. Magnam ut corporis laudantium saepe fugit iure eveniet.', 'http://www.labadie.com/explicabo-aliquam-eveniet-aliquid-ut-odio-ipsum-dolorem', 'https://www.schamberger.com/sit-dolore-deleniti-ut', '2013-07-14 03:33:33', '1982-03-03 04:34:21'),
(31, 'Fashion and accessories', 'Amet et quibusdam excepturi sint rerum nesciunt harum. Ut quaerat et quo voluptatem adipisci voluptatibus quibusdam. Libero qui eaque consequatur veniam non consequatur. Doloribus omnis fuga id consequuntur minus voluptatem odit.', 'http://www.olson.com/iste-quis-sunt-magni-veniam', 'http://smitham.com/', '2004-04-23 06:03:26', '1979-07-14 13:06:02'),
(32, 'Flowers, Gifts and Crafts', 'Accusamus voluptatem in nostrum. Maxime maiores sed est numquam. Enim dignissimos tempora fugiat veniam eligendi quibusdam sequi doloribus.', 'http://heaney.net/ea-ducimus-totam-quasi-quia-dolor-occaecati-nisi-similique', 'http://www.muller.com/', '2014-07-15 07:00:34', '2007-01-31 21:52:02'),
(33, 'Food and beverage', 'Sint ex corporis fugiat omnis. Eaque enim perspiciatis in temporibus exercitationem dolore aliquam. Quasi deleniti dolore rerum quibusdam dicta officiis.', 'http://www.barrows.com/dolorem-provident-aut-magni-ducimus-quae-nihil', 'http://www.rutherford.com/doloribus-ipsa-cum-optio-repellat-dolores', '1979-07-16 04:37:14', '1999-12-20 15:58:20'),
(34, 'HiFi, Photo and Video', 'Saepe sequi eos adipisci odio est dolor inventore. Ex sed ut praesentium dolores. Cupiditate molestiae molestias facere omnis.', 'http://kling.com/voluptatum-quibusdam-magnam-sed-aliquid-itaque-consequatur.html', 'http://luettgen.com/velit-et-non-aut-reprehenderit', '1972-06-25 21:00:01', '1992-10-06 18:55:49'),
(35, 'Home and Garden', 'Autem reprehenderit et ut inventore eveniet. Sit sit est ipsam dolores aut vel laboriosam. Nesciunt alias deserunt odit aut iure quo quis. Ut molestiae laborum aut incidunt molestias est velit.', 'http://www.wunsch.com/id-impedit-quae-et-quia-nihil-minima', 'http://www.ledner.info/non-pariatur-adipisci-facilis-nam', '1974-04-06 21:48:26', '1973-09-13 20:52:00'),
(36, 'Home Appliances', 'Rerum et perspiciatis hic sit commodi eveniet. Culpa nihil facilis amet error et aliquam debitis rerum. Aut itaque molestias aliquid dolores.', 'https://batz.org/nobis-inventore-adipisci-consectetur-cupiditate-non-quae-praesentium-quia.html', 'http://www.emard.info/', '1995-12-17 23:23:20', '2009-04-25 20:47:36'),
(37, 'Jewelry', 'Soluta quo delectus aut. Iusto aut fuga quod ipsum reprehenderit laborum. Reiciendis optio eum a laudantium repudiandae reiciendis. Corrupti aliquid totam accusantium doloremque reiciendis culpa fuga.', 'http://www.schumm.org/debitis-et-accusamus-incidunt', 'http://www.stehr.biz/voluptas-consequatur-nihil-doloribus-quia-neque-sunt-voluptatum.html', '1999-05-25 06:11:39', '1994-10-25 00:57:42'),
(38, 'Mobile and Telecom', 'Esse numquam ut ex doloremque qui soluta recusandae vero. Rerum dolor pariatur voluptate rerum reiciendis optio est. Neque eos sit accusantium vero totam molestiae rem. Totam aliquam corporis ut laudantium ut.', 'http://www.satterfield.com/quia-iusto-animi-quas-sit-eum-rerum-eum', 'http://christiansen.org/ut-ipsum-quisquam-et-voluptatem-sint-molestias.html', '1990-03-28 14:43:26', '2015-08-29 06:58:07'),
(39, 'Services', 'Dolorem vel magni quo ut. Illo quo est culpa eum aperiam. Repellendus et possimus sit dolor. Eligendi neque eum et.', 'http://huels.com/eos-recusandae-enim-eius-magnam', 'http://www.mcdermott.com/', '2009-04-24 07:05:40', '1978-06-17 15:46:45'),
(40, 'Shoes and accessories', 'Fugiat corrupti qui ad numquam sint neque. Enim cum quia dignissimos aut reprehenderit commodi. Reiciendis illo vitae voluptatibus repellat ut.', 'https://www.carroll.com/enim-odit-temporibus-aut-natus-nostrum-aperiam', 'http://pollich.com/labore-ea-amet-similique-et-incidunt.html', '2012-10-08 22:23:14', '1990-07-31 14:52:09'),
(41, 'Sports and Entertainment', 'Est veniam aut rerum nesciunt cumque asperiores assumenda. Fugit a eligendi aut neque ea neque error. Saepe ullam fugiat vero reiciendis sit dolor.', 'http://www.hirthe.info/odio-aut-voluptatem-eos-repudiandae.html', 'http://friesen.com/dolore-necessitatibus-recusandae-doloribus-sunt.html', '1975-01-12 03:11:28', '2012-11-20 11:21:22'),
(42, 'Travel', 'Reprehenderit sit et amet modi qui. Fugiat eos qui qui ipsam iure facere voluptatibus. Tenetur dicta ut quis doloremque sapiente tempore veritatis quisquam.', 'http://hammes.info/consequatur-nemo-odio-voluptas-quisquam-ea-suscipit-dicta-facilis', 'http://www.leuschke.biz/atque-aut-eius-repellendus-aspernatur-ducimus-enim', '1998-12-29 14:13:56', '1977-11-15 12:08:27');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `id_config` int(11) NOT NULL AUTO_INCREMENT,
  `data` blob NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id_config`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hook`
--

DROP TABLE IF EXISTS `hook`;
CREATE TABLE IF NOT EXISTS `hook` (
  `id_hook` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_hook`),
  KEY `id_hook_name_idx` (`id_hook`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `id_module` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id_module`),
  KEY `id_module_name_version_idx` (`id_module`,`name`,`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modulehook`
--

DROP TABLE IF EXISTS `modulehook`;
CREATE TABLE IF NOT EXISTS `modulehook` (
  `id_module` int(11) NOT NULL AUTO_INCREMENT,
  `id_hook` int(11) NOT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_module`),
  KEY `IDX_EA2FFFB52F785F57` (`id_hook`),
  KEY `id_hook_id_module_idx` (`id_module`,`id_hook`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `occupation`
--

DROP TABLE IF EXISTS `occupation`;
CREATE TABLE IF NOT EXISTS `occupation` (
  `id_occupation` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_shop` int(11) NOT NULL,
  `id_profile` int(11) NOT NULL,
  `started_on` date NOT NULL,
  `monthly_salary` int(11) NOT NULL,
  PRIMARY KEY (`id_occupation`),
  KEY `IDX_4DA57E816B3CA4B` (`id_user`),
  KEY `IDX_4DA57E81274A50A0` (`id_shop`),
  KEY `IDX_4DA57E815FCA037F` (`id_profile`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `occupation`
--

INSERT INTO `occupation` (`id_occupation`, `id_user`, `id_shop`, `id_profile`, `started_on`, `monthly_salary`) VALUES
(2, 1, 1, 1, '2017-08-16', 9000),
(3, 1, 2, 2, '2017-08-15', 4000);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop` int(11) DEFAULT NULL,
  `id_section` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `condition` enum('new','used','refurbished') COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` enum('simple','pack','virtual') COLLATE utf8_unicode_ci DEFAULT NULL,
  `available_for_order` tinyint(1) NOT NULL,
  `show_price` tinyint(1) NOT NULL,
  `price` decimal(10,4) NOT NULL,
  `online_only` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id_product`),
  UNIQUE KEY `UNIQ_1CF73D31274A50A0` (`id_shop`),
  UNIQUE KEY `UNIQ_1CF73D31F3EED39F` (`id_section`),
  KEY `product_price_name_idx` (`id_product`,`price`,`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `id_shop`, `id_section`, `name`, `short_description`, `description`, `condition`, `type`, `available_for_order`, `show_price`, `price`, `online_only`, `active`, `created`, `updated`) VALUES
(1, 1, 1, 'first product', 'product short discription', 'product full duscription', 'new', 'simple', 1, 1, '987655.0000', 1, 1, '2017-07-23 00:00:38', '2017-07-23 00:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `id_profile` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_profile`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id_profile`, `name`) VALUES
(1, 'super user'),
(2, 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table `router`
--

DROP TABLE IF EXISTS `router`;
CREATE TABLE IF NOT EXISTS `router` (
  `id_route` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `route` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:object)',
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_route`)
) ENGINE=InnoDB AUTO_INCREMENT=10373 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `router`
--

INSERT INTO `router` (`id_route`, `name`, `route`, `path`) VALUES
(10363, 'admin.index', 'C:31:"Symfony\\Component\\Routing\\Route":742:{a:9:{s:4:"path";s:6:"/admin";s:4:"host";s:0:"";s:8:"defaults";a:2:{s:6:"_title";s:11:"Amin | Home";s:11:"_controller";s:51:"ntc\\administrator\\controller\\AdminController::hello";}s:12:"requirements";a:1:{s:11:"_permission";s:18:"administer actions";}s:7:"options";a:2:{s:14:"compiler_class";s:39:"Symfony\\Component\\Routing\\RouteCompiler";s:12:"_admin_route";b:1;}s:7:"schemes";a:0:{}s:7:"methods";a:0:{}s:9:"condition";s:0:"";s:8:"compiled";C:39:"Symfony\\Component\\Routing\\CompiledRoute":248:{a:8:{s:4:"vars";a:0:{}s:11:"path_prefix";s:6:"/admin";s:10:"path_regex";s:11:"#^/admin$#s";s:11:"path_tokens";a:1:{i:0;a:2:{i:0;s:4:"text";i:1;s:6:"/admin";}}s:9:"path_vars";a:0:{}s:10:"host_regex";N;s:11:"host_tokens";a:0:{}s:9:"host_vars";a:0:{}}}}}', '/admin'),
(10364, 'admin.list', 'C:31:"Symfony\\Component\\Routing\\Route":804:{a:9:{s:4:"path";s:11:"/admin/list";s:4:"host";s:0:"";s:8:"defaults";a:2:{s:6:"_title";s:11:"Amin | Home";s:5:"_list";s:36:"ntc\\administrator\\controller\\Listing";}s:12:"requirements";a:1:{s:11:"_permission";s:18:"administer actions";}s:7:"options";a:3:{s:14:"compiler_class";s:39:"Symfony\\Component\\Routing\\RouteCompiler";s:12:"_admin_route";b:1;s:16:"_route_enhancers";a:1:{i:0;s:19:"route_enhancer.list";}}s:7:"schemes";a:0:{}s:7:"methods";a:0:{}s:9:"condition";s:0:"";s:8:"compiled";C:39:"Symfony\\Component\\Routing\\CompiledRoute":265:{a:8:{s:4:"vars";a:0:{}s:11:"path_prefix";s:11:"/admin/list";s:10:"path_regex";s:16:"#^/admin/list$#s";s:11:"path_tokens";a:1:{i:0;a:2:{i:0;s:4:"text";i:1;s:11:"/admin/list";}}s:9:"path_vars";a:0:{}s:10:"host_regex";N;s:11:"host_tokens";a:0:{}s:9:"host_vars";a:0:{}}}}}', '/admin/list'),
(10365, 'component.index', 'C:31:"Symfony\\Component\\Routing\\Route":753:{a:9:{s:4:"path";s:10:"/component";s:4:"host";s:0:"";s:8:"defaults";a:3:{s:4:"name";N;s:6:"_title";s:14:"Amin | Product";s:11:"_controller";s:51:"ntc\\component\\controller\\ComponentController::index";}s:12:"requirements";a:1:{s:11:"_permission";s:18:"administer actions";}s:7:"options";a:1:{s:14:"compiler_class";s:39:"Symfony\\Component\\Routing\\RouteCompiler";}s:7:"schemes";a:0:{}s:7:"methods";a:0:{}s:9:"condition";s:0:"";s:8:"compiled";C:39:"Symfony\\Component\\Routing\\CompiledRoute":262:{a:8:{s:4:"vars";a:0:{}s:11:"path_prefix";s:10:"/component";s:10:"path_regex";s:15:"#^/component$#s";s:11:"path_tokens";a:1:{i:0;a:2:{i:0;s:4:"text";i:1;s:10:"/component";}}s:9:"path_vars";a:0:{}s:10:"host_regex";N;s:11:"host_tokens";a:0:{}s:9:"host_vars";a:0:{}}}}}', '/component'),
(10366, 'home.index', 'C:31:"Symfony\\Component\\Routing\\Route":703:{a:9:{s:4:"path";s:1:"/";s:4:"host";s:0:"";s:8:"defaults";a:3:{s:4:"name";N;s:6:"_title";s:14:"Amin | Product";s:11:"_controller";s:41:"ntc\\home\\controller\\HomeController::index";}s:12:"requirements";a:1:{s:11:"_permission";s:18:"administer actions";}s:7:"options";a:1:{s:14:"compiler_class";s:39:"Symfony\\Component\\Routing\\RouteCompiler";}s:7:"schemes";a:0:{}s:7:"methods";a:0:{}s:9:"condition";s:0:"";s:8:"compiled";C:39:"Symfony\\Component\\Routing\\CompiledRoute":232:{a:8:{s:4:"vars";a:0:{}s:11:"path_prefix";s:1:"/";s:10:"path_regex";s:6:"#^/$#s";s:11:"path_tokens";a:1:{i:0;a:2:{i:0;s:4:"text";i:1;s:1:"/";}}s:9:"path_vars";a:0:{}s:10:"host_regex";N;s:11:"host_tokens";a:0:{}s:9:"host_vars";a:0:{}}}}}', '/'),
(10367, 'admin.product', 'C:31:"Symfony\\Component\\Routing\\Route":789:{a:9:{s:4:"path";s:14:"/admin/product";s:4:"host";s:0:"";s:8:"defaults";a:3:{s:4:"name";N;s:6:"_title";s:14:"Amin | Product";s:11:"_controller";s:47:"ntc\\product\\controller\\ProductController::index";}s:12:"requirements";a:1:{s:11:"_permission";s:18:"administer actions";}s:7:"options";a:2:{s:14:"compiler_class";s:39:"Symfony\\Component\\Routing\\RouteCompiler";s:12:"_admin_route";b:1;}s:7:"schemes";a:0:{}s:7:"methods";a:0:{}s:9:"condition";s:0:"";s:8:"compiled";C:39:"Symfony\\Component\\Routing\\CompiledRoute":274:{a:8:{s:4:"vars";a:0:{}s:11:"path_prefix";s:14:"/admin/product";s:10:"path_regex";s:19:"#^/admin/product$#s";s:11:"path_tokens";a:1:{i:0;a:2:{i:0;s:4:"text";i:1;s:14:"/admin/product";}}s:9:"path_vars";a:0:{}s:10:"host_regex";N;s:11:"host_tokens";a:0:{}s:9:"host_vars";a:0:{}}}}}', '/admin/product'),
(10368, 'admin.product.add', 'C:31:"Symfony\\Component\\Routing\\Route":957:{a:9:{s:4:"path";s:24:"/admin/product/add/{tab}";s:4:"host";s:0:"";s:8:"defaults";a:3:{s:3:"tab";s:11:"Information";s:6:"_title";s:14:"Amin | Product";s:11:"_controller";s:45:"ntc\\product\\controller\\ProductController::add";}s:12:"requirements";a:2:{s:3:"tab";s:2:".+";s:11:"_permission";s:18:"administer actions";}s:7:"options";a:2:{s:14:"compiler_class";s:39:"Symfony\\Component\\Routing\\RouteCompiler";s:12:"_admin_route";b:1;}s:7:"schemes";a:0:{}s:7:"methods";a:0:{}s:9:"condition";s:0:"";s:8:"compiled";C:39:"Symfony\\Component\\Routing\\CompiledRoute":399:{a:8:{s:4:"vars";a:1:{i:0;s:3:"tab";}s:11:"path_prefix";s:18:"/admin/product/add";s:10:"path_regex";s:40:"#^/admin/product/add(?:/(?P<tab>.+))?$#s";s:11:"path_tokens";a:2:{i:0;a:4:{i:0;s:8:"variable";i:1;s:1:"/";i:2;s:2:".+";i:3;s:3:"tab";}i:1;a:2:{i:0;s:4:"text";i:1;s:18:"/admin/product/add";}}s:9:"path_vars";a:1:{i:0;s:3:"tab";}s:10:"host_regex";N;s:11:"host_tokens";a:0:{}s:9:"host_vars";a:0:{}}}}}', '/admin/product/add/{tab}'),
(10369, 'admin.product.edit', 'C:31:"Symfony\\Component\\Routing\\Route":1120:{a:9:{s:4:"path";s:30:"/admin/product/{id}/edit/{tab}";s:4:"host";s:0:"";s:8:"defaults";a:3:{s:3:"tab";s:11:"information";s:6:"_title";s:14:"Amin | Product";s:11:"_controller";s:46:"ntc\\product\\controller\\ProductController::edit";}s:12:"requirements";a:3:{s:3:"tab";s:2:".+";s:2:"id";s:2:".+";s:11:"_permission";s:18:"administer actions";}s:7:"options";a:2:{s:14:"compiler_class";s:39:"Symfony\\Component\\Routing\\RouteCompiler";s:12:"_admin_route";b:1;}s:7:"schemes";a:0:{}s:7:"methods";a:0:{}s:9:"condition";s:0:"";s:8:"compiled";C:39:"Symfony\\Component\\Routing\\CompiledRoute":537:{a:8:{s:4:"vars";a:2:{i:0;s:2:"id";i:1;s:3:"tab";}s:11:"path_prefix";s:14:"/admin/product";s:10:"path_regex";s:52:"#^/admin/product/(?P<id>.+)/edit(?:/(?P<tab>.+))?$#s";s:11:"path_tokens";a:4:{i:0;a:4:{i:0;s:8:"variable";i:1;s:1:"/";i:2;s:2:".+";i:3;s:3:"tab";}i:1;a:2:{i:0;s:4:"text";i:1;s:5:"/edit";}i:2;a:4:{i:0;s:8:"variable";i:1;s:1:"/";i:2;s:2:".+";i:3;s:2:"id";}i:3;a:2:{i:0;s:4:"text";i:1;s:14:"/admin/product";}}s:9:"path_vars";a:2:{i:0;s:2:"id";i:1;s:3:"tab";}s:10:"host_regex";N;s:11:"host_tokens";a:0:{}s:9:"host_vars";a:0:{}}}}}', '/admin/product/{id}/edit/{tab}'),
(10370, 'admin.shop.add', 'C:31:"Symfony\\Component\\Routing\\Route":831:{a:9:{s:4:"path";s:18:"/admin/shop/create";s:4:"host";s:0:"";s:8:"defaults";a:2:{s:6:"_title";s:18:"Amin | Create Shop";s:5:"_form";s:28:"ntc\\shop\\form\\CreateShopForm";}s:12:"requirements";a:1:{s:11:"_permission";s:18:"administer actions";}s:7:"options";a:3:{s:14:"compiler_class";s:39:"Symfony\\Component\\Routing\\RouteCompiler";s:12:"_admin_route";b:1;s:16:"_route_enhancers";a:1:{i:0;s:19:"route_enhancer.form";}}s:7:"schemes";a:0:{}s:7:"methods";a:0:{}s:9:"condition";s:0:"";s:8:"compiled";C:39:"Symfony\\Component\\Routing\\CompiledRoute":286:{a:8:{s:4:"vars";a:0:{}s:11:"path_prefix";s:18:"/admin/shop/create";s:10:"path_regex";s:23:"#^/admin/shop/create$#s";s:11:"path_tokens";a:1:{i:0;a:2:{i:0;s:4:"text";i:1;s:18:"/admin/shop/create";}}s:9:"path_vars";a:0:{}s:10:"host_regex";N;s:11:"host_tokens";a:0:{}s:9:"host_vars";a:0:{}}}}}', '/admin/shop/create'),
(10371, 'admin.user.register', 'C:31:"Symfony\\Component\\Routing\\Route":820:{a:9:{s:4:"path";s:20:"/admin/user/register";s:4:"host";s:0:"";s:8:"defaults";a:2:{s:5:"_form";s:22:"ntc\\user\\form\\UserForm";s:6:"_title";s:8:"Add user";}s:12:"requirements";a:1:{s:11:"_permission";s:16:"administer users";}s:7:"options";a:3:{s:14:"compiler_class";s:39:"Symfony\\Component\\Routing\\RouteCompiler";s:12:"_admin_route";b:1;s:16:"_route_enhancers";a:1:{i:0;s:19:"route_enhancer.form";}}s:7:"schemes";a:0:{}s:7:"methods";a:0:{}s:9:"condition";s:0:"";s:8:"compiled";C:39:"Symfony\\Component\\Routing\\CompiledRoute":292:{a:8:{s:4:"vars";a:0:{}s:11:"path_prefix";s:20:"/admin/user/register";s:10:"path_regex";s:25:"#^/admin/user/register$#s";s:11:"path_tokens";a:1:{i:0;a:2:{i:0;s:4:"text";i:1;s:20:"/admin/user/register";}}s:9:"path_vars";a:0:{}s:10:"host_regex";N;s:11:"host_tokens";a:0:{}s:9:"host_vars";a:0:{}}}}}', '/admin/user/register'),
(10372, 'admin.user.authorize', 'C:31:"Symfony\\Component\\Routing\\Route":804:{a:9:{s:4:"path";s:16:"/admin/user/auth";s:4:"host";s:0:"";s:8:"defaults";a:2:{s:5:"_form";s:22:"ntc\\user\\form\\AuthForm";s:6:"_title";s:8:"Add user";}s:12:"requirements";a:1:{s:11:"_permission";s:16:"administer users";}s:7:"options";a:3:{s:14:"compiler_class";s:39:"Symfony\\Component\\Routing\\RouteCompiler";s:12:"_admin_route";b:1;s:16:"_route_enhancers";a:1:{i:0;s:19:"route_enhancer.form";}}s:7:"schemes";a:0:{}s:7:"methods";a:0:{}s:9:"condition";s:0:"";s:8:"compiled";C:39:"Symfony\\Component\\Routing\\CompiledRoute":280:{a:8:{s:4:"vars";a:0:{}s:11:"path_prefix";s:16:"/admin/user/auth";s:10:"path_regex";s:21:"#^/admin/user/auth$#s";s:11:"path_tokens";a:1:{i:0;a:2:{i:0;s:4:"text";i:1;s:16:"/admin/user/auth";}}s:9:"path_vars";a:0:{}s:10:"host_regex";N;s:11:"host_tokens";a:0:{}s:9:"host_vars";a:0:{}}}}}', '/admin/user/auth');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

DROP TABLE IF EXISTS `section`;
CREATE TABLE IF NOT EXISTS `section` (
  `id_section` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id_section`),
  UNIQUE KEY `UNIQ_E2CE4373F3EED39F` (`id_section`),
  UNIQUE KEY `UNIQ_E2CE4373274A50A0` (`id_shop`),
  KEY `section_url_idx` (`id_section`,`url`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id_section`, `id_shop`, `name`, `description`, `url`, `created`, `updated`) VALUES
(1, NULL, 'Gibson-Mante', 'Array', 'http://www.franecki.com/ut-nihil-nobis-cum-non', '1990-02-01 15:41:57', '1975-04-21 08:23:38'),
(2, NULL, 'Hoppe, Huels and McKenzie', 'Array', 'http://mcdermott.com/', '1985-10-22 16:07:56', '2008-12-27 17:09:05'),
(3, NULL, 'Larkin PLC', 'Array', 'http://monahan.com/', '1992-03-29 15:42:54', '1979-08-20 21:53:10'),
(4, NULL, 'Cole Inc', 'Array', 'http://www.weimann.com/', '2000-10-21 22:33:23', '2000-04-06 17:41:18'),
(5, NULL, 'Mante-Ebert', 'Array', 'http://green.com/quibusdam-fugit-maiores-earum-sunt-occaecati-est', '1985-04-28 01:42:44', '1993-07-03 13:52:09'),
(6, NULL, 'Konopelski-White', 'Array', 'http://fritsch.com/et-necessitatibus-eius-in-hic', '1971-01-21 06:08:24', '1975-01-12 05:45:00'),
(7, NULL, 'Gleichner, Hettinger and Smitham', 'Array', 'http://www.wisozk.com/voluptatibus-consequatur-reprehenderit-velit-accusamus-non.html', '2004-06-28 20:04:52', '1972-06-13 23:45:37'),
(8, NULL, 'McGlynn Inc', 'Array', 'http://ziemann.com/et-corporis-quae-fugiat-eius-exercitationem-aut-harum', '1993-07-13 21:58:16', '1995-06-18 07:24:59'),
(9, NULL, 'Hoppe, Feeney and Dare', 'Array', 'http://www.flatley.com/maiores-et-et-nam-quia-cum-dolor-ea-et', '2000-11-18 19:41:30', '1978-08-11 19:42:12'),
(10, NULL, 'Dach, Dibbert and Towne', 'Array', 'http://emmerich.com/laborum-et-et-reprehenderit-harum-harum-suscipit-placeat.html', '1998-10-28 07:23:39', '2003-03-07 00:56:15');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

DROP TABLE IF EXISTS `shop`;
CREATE TABLE IF NOT EXISTS `shop` (
  `id_shop` int(11) NOT NULL AUTO_INCREMENT,
  `id_activity` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id_shop`),
  UNIQUE KEY `UNIQ_C58E39CFCAFE5CF` (`id_activity`),
  KEY `activity_url_idx` (`id_activity`,`url`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id_shop`, `id_activity`, `name`, `description`, `url`, `created`, `updated`) VALUES
(1, NULL, 'Baumbach, Barrows and Feil', 'Eum facere id voluptatum labore. Dolores rem veniam in itaque asperiores quis. Doloribus suscipit similique eum enim sequi.', 'http://www.gusikowski.biz/laborum-est-illo-minima-facere-eligendi-ut.html', '1981-11-15 04:21:13', '1981-07-17 19:08:04'),
(2, NULL, 'Miller-Schultz', 'Ex pariatur et exercitationem. Similique autem voluptatem qui libero. Ut qui doloribus sint. Doloremque voluptate culpa natus amet.', 'http://marks.biz/', '2010-01-21 06:30:58', '2006-07-24 13:34:00'),
(3, NULL, 'Flatley-Hayes', 'Laborum nihil praesentium aliquam ipsa assumenda. Dolores aut minus in quia facere. Omnis eaque consequatur eligendi autem.', 'http://www.wisozk.biz/quod-et-quia-ratione-voluptas-omnis-perferendis', '1998-02-23 01:54:36', '2009-04-21 00:07:07'),
(4, NULL, 'Schimmel LLC', 'Expedita voluptas qui repudiandae facilis consequuntur a adipisci provident. Nostrum fugiat sed sed corporis doloribus voluptatem hic. Ut aut enim sunt iste voluptate esse sed est.', 'http://www.sawayn.com/magnam-excepturi-iste-sint-reiciendis-eligendi-consequatur', '2017-06-15 06:27:46', '1990-06-15 05:14:25'),
(5, NULL, 'Bernier-Swaniawski', 'Consequatur quia sit sint perferendis sunt qui. Qui aspernatur iste voluptas ad. Autem odit quo ab cum temporibus quas.', 'http://schamberger.com/aspernatur-et-neque-iste-ut-quod-veniam', '2014-12-19 17:08:47', '2008-05-07 21:37:41'),
(6, NULL, 'Kertzmann-Schroeder', 'Sapiente dignissimos ea nobis et recusandae. Natus unde autem consequatur culpa et. Vero dolores voluptates aut accusantium tenetur qui doloribus.', 'http://www.collins.org/sed-quia-ex-earum-commodi-sit-voluptatibus-et-deserunt', '2004-02-14 12:34:48', '2010-09-05 08:27:51'),
(7, NULL, 'Gusikowski-Kihn', 'Id dolorum ea non ut et quis. Quo consequatur quae alias enim. Rerum et asperiores inventore omnis. Ducimus aut laudantium sint vel et eum quia.', 'http://mante.net/totam-est-tempora-omnis-velit.html', '2014-07-10 03:04:48', '1983-08-21 10:28:47'),
(8, NULL, 'Kreiger Ltd', 'Voluptas possimus suscipit dolor sit. Ea eligendi et et repellat veritatis iste. Voluptatum id provident dolores vero amet laborum voluptas.', 'https://www.fritsch.com/sed-dolor-quia-quo', '1970-09-23 16:04:27', '1974-09-02 15:12:12'),
(9, NULL, 'Hahn Group', 'Ut temporibus facere quas dolores eius. Saepe neque quod repellat provident illo. Aut nihil commodi est laborum dolorem et. Corporis aut eum reprehenderit cumque dolores.', 'https://www.boyle.info/non-aut-sed-nostrum-possimus-odit-sit', '1983-05-14 02:09:45', '2011-11-02 06:37:09'),
(10, NULL, 'Williamson-Ondricka', 'Dolor nisi cum eos. Autem officiis repellendus voluptas vitae. Nisi quia aut saepe veniam pariatur consequatur reprehenderit.', 'http://towne.biz/', '1989-03-19 22:56:24', '2014-09-09 03:21:48');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_config` int(11) DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `UNIQ_2DA17977F85E0677` (`username`),
  UNIQUE KEY `UNIQ_2DA17977F2BD9A91` (`id_config`),
  KEY `username_email_phone_idx` (`username`,`email`,`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_config`, `firstname`, `lastname`, `username`, `password`, `remember_token`, `email`, `phone`, `created`, `updated`) VALUES
(1, NULL, 'tobi', 'agbeja', 'adapter', 'june24', NULL, 'tobiagbeja4#gmail.com', '', '2017-08-03 00:32:00', '2017-08-03 00:00:37'),
(11, NULL, 'Daisha', 'Schiller', 'beahan.henriette', '2Mhrc"n:XtJsH)dNFHJ', 'Windows CE', 'kihn.thaddeus@lynch.biz', '518-498-5516 x2428', '2013-10-04 13:14:56', '1993-01-09 12:48:47'),
(12, NULL, 'Dominic', 'Wisoky', 'schuster.lucile', '''lp=jki\\-8*$$#*m', 'Windows CE', 'chelsie10@turner.com', '1-935-629-2137 x40652', '1995-07-07 15:31:04', '2008-03-04 05:18:00'),
(13, NULL, 'Jordyn', 'Adams', 'jasmin08', 'TQZ%H;xux6H', 'Windows NT 5.2', 'ezra.thompson@gmail.com', '287.662.3393 x662', '2005-04-22 20:33:57', '1994-03-20 02:11:06'),
(14, NULL, 'Jonatan', 'Cummerata', 'flarson', 'cRw\\OQ#apYiKpci#~', 'Windows CE', 'runolfsdottir.maryam@larson.org', '832.808.1736 x081', '1987-03-26 03:43:26', '2004-03-11 23:05:27'),
(15, NULL, 'Cicero', 'Thiel', 'bauch.sheila', '<&vJ/g', 'Windows CE', 'nwuckert@gerhold.com', '669-579-7773 x7580', '2014-03-02 07:53:44', '1985-05-20 22:03:59'),
(16, NULL, 'Vito', 'Rosenbaum', 'maryjane28', '.u5Dv!Qnx!9o', 'Windows CE', 'effie.kiehn@will.net', '549.977.0431 x534', '2000-03-07 03:22:43', '1993-06-03 20:08:54'),
(17, NULL, 'Clare', 'Klocko', 'kylie28', ']\\e10O3|0I@oRz', 'Windows NT 5.2', 'mac.windler@friesen.net', '1-623-268-3514', '1995-07-17 18:48:33', '1975-08-05 12:14:30'),
(18, NULL, 'Athena', 'Nader', 'kelvin93', 'iADR!{^_', 'Windows 98', 'cordelia31@marquardt.biz', '+1-491-393-9247', '1970-02-24 08:19:28', '1979-03-20 14:51:57'),
(19, NULL, 'Aurore', 'Mueller', 'jody.boyer', '1=r%H?-', 'Windows NT 5.1', 'zbogisich@reilly.biz', '960.899.4682 x277', '1993-11-14 09:00:18', '2003-07-06 03:14:30'),
(20, NULL, 'Melba', 'Buckridge', 'qweber', '=:hz9pZtjfDF''', 'Windows NT 5.01', 'maude12@yahoo.com', '(980) 761-2677', '1999-06-01 20:23:39', '1986-11-20 05:43:42');

-- --------------------------------------------------------

--
-- Table structure for table `user_route`
--

DROP TABLE IF EXISTS `user_route`;
CREATE TABLE IF NOT EXISTS `user_route` (
  `id_route` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_route`,`id_user`),
  KEY `IDX_E006DB21EC416149` (`id_route`),
  KEY `IDX_E006DB216B3CA4B` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `modulehook`
--
ALTER TABLE `modulehook`
  ADD CONSTRAINT `FK_EA2FFFB52A1393C5` FOREIGN KEY (`id_module`) REFERENCES `module` (`id_module`),
  ADD CONSTRAINT `FK_EA2FFFB52F785F57` FOREIGN KEY (`id_hook`) REFERENCES `hook` (`id_hook`);

--
-- Constraints for table `occupation`
--
ALTER TABLE `occupation`
  ADD CONSTRAINT `FK_4DA57E81274A50A0` FOREIGN KEY (`id_shop`) REFERENCES `shop` (`id_shop`),
  ADD CONSTRAINT `FK_4DA57E815FCA037F` FOREIGN KEY (`id_profile`) REFERENCES `profile` (`id_profile`),
  ADD CONSTRAINT `FK_4DA57E816B3CA4B` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_1CF73D31274A50A0` FOREIGN KEY (`id_shop`) REFERENCES `shop` (`id_shop`),
  ADD CONSTRAINT `FK_1CF73D31F3EED39F` FOREIGN KEY (`id_section`) REFERENCES `section` (`id_section`);

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `FK_E2CE4373274A50A0` FOREIGN KEY (`id_shop`) REFERENCES `shop` (`id_shop`),
  ADD CONSTRAINT `FK_E2CE4373F3EED39F` FOREIGN KEY (`id_section`) REFERENCES `section` (`id_section`);

--
-- Constraints for table `shop`
--
ALTER TABLE `shop`
  ADD CONSTRAINT `FK_C58E39CFCAFE5CF` FOREIGN KEY (`id_activity`) REFERENCES `activity` (`id_activity`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_2DA17977F2BD9A91` FOREIGN KEY (`id_config`) REFERENCES `config` (`id_config`);

--
-- Constraints for table `user_route`
--
ALTER TABLE `user_route`
  ADD CONSTRAINT `FK_E006DB216B3CA4B` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `FK_E006DB21EC416149` FOREIGN KEY (`id_route`) REFERENCES `router` (`id_route`);
--
-- Database: `ntc_yml`
--
CREATE DATABASE IF NOT EXISTS `ntc_yml` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ntc_yml`;

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Activity''s name',
  `url` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Activity''s url string somethines it is the slug of the name',
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Activity''s icon',
  `description` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Shop''s description',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_url_idx` (`id`,`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Product''s url string',
  `short_description` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Product''s short description',
  `description` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Product''s long description',
  `condition` enum('new','used','refurbished') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Product''s condition',
  `type` enum('simple','pack','virtual') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Product''s type',
  `available` tinyint(1) NOT NULL COMMENT 'Product''s availability',
  `price` decimal(10,4) NOT NULL COMMENT 'Product''s price',
  `show_price` tinyint(1) NOT NULL COMMENT 'if the price should be shown',
  `online_only` tinyint(1) NOT NULL COMMENT 'if the product should be shown online only',
  `active` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_price_name_idx` (`id`,`price`,`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `short_description`, `description`, `condition`, `type`, `available`, `price`, `show_price`, `online_only`, `active`, `created`, `updated`) VALUES
(1, 'je;c', 'jijjnINHI', 'HNUNHNH', 'new', 'simple', 1, '1928.0000', 1, 1, 1, '2017-08-21 00:17:00', '2017-08-21 00:00:24');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'User''s phone number',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8157AA0F5E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` date NOT NULL COMMENT 'Role''s name',
  `createdBy` int(10) UNSIGNED NOT NULL COMMENT 'user id that created the role',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F75B25545E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `routing`
--

DROP TABLE IF EXISTS `routing`;
CREATE TABLE IF NOT EXISTS `routing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Route''s name',
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Route''s path string',
  `route` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'Route''s object(DC2Type:object)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=231 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `routing`
--

INSERT INTO `routing` (`id`, `name`, `path`, `route`) VALUES
(221, 'admin.index', '/admin', 'C:31:"Symfony\\Component\\Routing\\Route":742:{a:9:{s:4:"path";s:6:"/admin";s:4:"host";s:0:"";s:8:"defaults";a:2:{s:6:"_title";s:11:"Amin | Home";s:11:"_controller";s:51:"ntc\\administrator\\controller\\AdminController::hello";}s:12:"requirements";a:1:{s:11:"_permission";s:18:"administer actions";}s:7:"options";a:2:{s:14:"compiler_class";s:39:"Symfony\\Component\\Routing\\RouteCompiler";s:12:"_admin_route";b:1;}s:7:"schemes";a:0:{}s:7:"methods";a:0:{}s:9:"condition";s:0:"";s:8:"compiled";C:39:"Symfony\\Component\\Routing\\CompiledRoute":248:{a:8:{s:4:"vars";a:0:{}s:11:"path_prefix";s:6:"/admin";s:10:"path_regex";s:11:"#^/admin$#s";s:11:"path_tokens";a:1:{i:0;a:2:{i:0;s:4:"text";i:1;s:6:"/admin";}}s:9:"path_vars";a:0:{}s:10:"host_regex";N;s:11:"host_tokens";a:0:{}s:9:"host_vars";a:0:{}}}}}'),
(222, 'admin.list', '/admin/list', 'C:31:"Symfony\\Component\\Routing\\Route":804:{a:9:{s:4:"path";s:11:"/admin/list";s:4:"host";s:0:"";s:8:"defaults";a:2:{s:6:"_title";s:11:"Amin | Home";s:5:"_list";s:36:"ntc\\administrator\\controller\\Listing";}s:12:"requirements";a:1:{s:11:"_permission";s:18:"administer actions";}s:7:"options";a:3:{s:14:"compiler_class";s:39:"Symfony\\Component\\Routing\\RouteCompiler";s:12:"_admin_route";b:1;s:16:"_route_enhancers";a:1:{i:0;s:19:"route_enhancer.list";}}s:7:"schemes";a:0:{}s:7:"methods";a:0:{}s:9:"condition";s:0:"";s:8:"compiled";C:39:"Symfony\\Component\\Routing\\CompiledRoute":265:{a:8:{s:4:"vars";a:0:{}s:11:"path_prefix";s:11:"/admin/list";s:10:"path_regex";s:16:"#^/admin/list$#s";s:11:"path_tokens";a:1:{i:0;a:2:{i:0;s:4:"text";i:1;s:11:"/admin/list";}}s:9:"path_vars";a:0:{}s:10:"host_regex";N;s:11:"host_tokens";a:0:{}s:9:"host_vars";a:0:{}}}}}'),
(223, 'component.index', '/component', 'C:31:"Symfony\\Component\\Routing\\Route":753:{a:9:{s:4:"path";s:10:"/component";s:4:"host";s:0:"";s:8:"defaults";a:3:{s:4:"name";N;s:6:"_title";s:14:"Amin | Product";s:11:"_controller";s:51:"ntc\\component\\controller\\ComponentController::index";}s:12:"requirements";a:1:{s:11:"_permission";s:18:"administer actions";}s:7:"options";a:1:{s:14:"compiler_class";s:39:"Symfony\\Component\\Routing\\RouteCompiler";}s:7:"schemes";a:0:{}s:7:"methods";a:0:{}s:9:"condition";s:0:"";s:8:"compiled";C:39:"Symfony\\Component\\Routing\\CompiledRoute":262:{a:8:{s:4:"vars";a:0:{}s:11:"path_prefix";s:10:"/component";s:10:"path_regex";s:15:"#^/component$#s";s:11:"path_tokens";a:1:{i:0;a:2:{i:0;s:4:"text";i:1;s:10:"/component";}}s:9:"path_vars";a:0:{}s:10:"host_regex";N;s:11:"host_tokens";a:0:{}s:9:"host_vars";a:0:{}}}}}'),
(224, 'home.index', '/', 'C:31:"Symfony\\Component\\Routing\\Route":703:{a:9:{s:4:"path";s:1:"/";s:4:"host";s:0:"";s:8:"defaults";a:3:{s:4:"name";N;s:6:"_title";s:14:"Amin | Product";s:11:"_controller";s:41:"ntc\\home\\controller\\HomeController::index";}s:12:"requirements";a:1:{s:11:"_permission";s:18:"administer actions";}s:7:"options";a:1:{s:14:"compiler_class";s:39:"Symfony\\Component\\Routing\\RouteCompiler";}s:7:"schemes";a:0:{}s:7:"methods";a:0:{}s:9:"condition";s:0:"";s:8:"compiled";C:39:"Symfony\\Component\\Routing\\CompiledRoute":232:{a:8:{s:4:"vars";a:0:{}s:11:"path_prefix";s:1:"/";s:10:"path_regex";s:6:"#^/$#s";s:11:"path_tokens";a:1:{i:0;a:2:{i:0;s:4:"text";i:1;s:1:"/";}}s:9:"path_vars";a:0:{}s:10:"host_regex";N;s:11:"host_tokens";a:0:{}s:9:"host_vars";a:0:{}}}}}'),
(225, 'admin.product', '/admin/product', 'C:31:"Symfony\\Component\\Routing\\Route":789:{a:9:{s:4:"path";s:14:"/admin/product";s:4:"host";s:0:"";s:8:"defaults";a:3:{s:4:"name";N;s:6:"_title";s:14:"Amin | Product";s:11:"_controller";s:47:"ntc\\product\\controller\\ProductController::index";}s:12:"requirements";a:1:{s:11:"_permission";s:18:"administer actions";}s:7:"options";a:2:{s:14:"compiler_class";s:39:"Symfony\\Component\\Routing\\RouteCompiler";s:12:"_admin_route";b:1;}s:7:"schemes";a:0:{}s:7:"methods";a:0:{}s:9:"condition";s:0:"";s:8:"compiled";C:39:"Symfony\\Component\\Routing\\CompiledRoute":274:{a:8:{s:4:"vars";a:0:{}s:11:"path_prefix";s:14:"/admin/product";s:10:"path_regex";s:19:"#^/admin/product$#s";s:11:"path_tokens";a:1:{i:0;a:2:{i:0;s:4:"text";i:1;s:14:"/admin/product";}}s:9:"path_vars";a:0:{}s:10:"host_regex";N;s:11:"host_tokens";a:0:{}s:9:"host_vars";a:0:{}}}}}'),
(226, 'admin.product.add', '/admin/product/add/{tab}', 'C:31:"Symfony\\Component\\Routing\\Route":957:{a:9:{s:4:"path";s:24:"/admin/product/add/{tab}";s:4:"host";s:0:"";s:8:"defaults";a:3:{s:3:"tab";s:11:"Information";s:6:"_title";s:14:"Amin | Product";s:11:"_controller";s:45:"ntc\\product\\controller\\ProductController::add";}s:12:"requirements";a:2:{s:3:"tab";s:2:".+";s:11:"_permission";s:18:"administer actions";}s:7:"options";a:2:{s:14:"compiler_class";s:39:"Symfony\\Component\\Routing\\RouteCompiler";s:12:"_admin_route";b:1;}s:7:"schemes";a:0:{}s:7:"methods";a:0:{}s:9:"condition";s:0:"";s:8:"compiled";C:39:"Symfony\\Component\\Routing\\CompiledRoute":399:{a:8:{s:4:"vars";a:1:{i:0;s:3:"tab";}s:11:"path_prefix";s:18:"/admin/product/add";s:10:"path_regex";s:40:"#^/admin/product/add(?:/(?P<tab>.+))?$#s";s:11:"path_tokens";a:2:{i:0;a:4:{i:0;s:8:"variable";i:1;s:1:"/";i:2;s:2:".+";i:3;s:3:"tab";}i:1;a:2:{i:0;s:4:"text";i:1;s:18:"/admin/product/add";}}s:9:"path_vars";a:1:{i:0;s:3:"tab";}s:10:"host_regex";N;s:11:"host_tokens";a:0:{}s:9:"host_vars";a:0:{}}}}}'),
(227, 'admin.product.edit', '/admin/product/{id}/edit/{tab}', 'C:31:"Symfony\\Component\\Routing\\Route":1120:{a:9:{s:4:"path";s:30:"/admin/product/{id}/edit/{tab}";s:4:"host";s:0:"";s:8:"defaults";a:3:{s:3:"tab";s:11:"information";s:6:"_title";s:14:"Amin | Product";s:11:"_controller";s:46:"ntc\\product\\controller\\ProductController::edit";}s:12:"requirements";a:3:{s:3:"tab";s:2:".+";s:2:"id";s:2:".+";s:11:"_permission";s:18:"administer actions";}s:7:"options";a:2:{s:14:"compiler_class";s:39:"Symfony\\Component\\Routing\\RouteCompiler";s:12:"_admin_route";b:1;}s:7:"schemes";a:0:{}s:7:"methods";a:0:{}s:9:"condition";s:0:"";s:8:"compiled";C:39:"Symfony\\Component\\Routing\\CompiledRoute":537:{a:8:{s:4:"vars";a:2:{i:0;s:2:"id";i:1;s:3:"tab";}s:11:"path_prefix";s:14:"/admin/product";s:10:"path_regex";s:52:"#^/admin/product/(?P<id>.+)/edit(?:/(?P<tab>.+))?$#s";s:11:"path_tokens";a:4:{i:0;a:4:{i:0;s:8:"variable";i:1;s:1:"/";i:2;s:2:".+";i:3;s:3:"tab";}i:1;a:2:{i:0;s:4:"text";i:1;s:5:"/edit";}i:2;a:4:{i:0;s:8:"variable";i:1;s:1:"/";i:2;s:2:".+";i:3;s:2:"id";}i:3;a:2:{i:0;s:4:"text";i:1;s:14:"/admin/product";}}s:9:"path_vars";a:2:{i:0;s:2:"id";i:1;s:3:"tab";}s:10:"host_regex";N;s:11:"host_tokens";a:0:{}s:9:"host_vars";a:0:{}}}}}'),
(228, 'admin.shop.add', '/admin/shop/create', 'C:31:"Symfony\\Component\\Routing\\Route":831:{a:9:{s:4:"path";s:18:"/admin/shop/create";s:4:"host";s:0:"";s:8:"defaults";a:2:{s:6:"_title";s:18:"Amin | Create Shop";s:5:"_form";s:28:"ntc\\shop\\form\\CreateShopForm";}s:12:"requirements";a:1:{s:11:"_permission";s:18:"administer actions";}s:7:"options";a:3:{s:14:"compiler_class";s:39:"Symfony\\Component\\Routing\\RouteCompiler";s:12:"_admin_route";b:1;s:16:"_route_enhancers";a:1:{i:0;s:19:"route_enhancer.form";}}s:7:"schemes";a:0:{}s:7:"methods";a:0:{}s:9:"condition";s:0:"";s:8:"compiled";C:39:"Symfony\\Component\\Routing\\CompiledRoute":286:{a:8:{s:4:"vars";a:0:{}s:11:"path_prefix";s:18:"/admin/shop/create";s:10:"path_regex";s:23:"#^/admin/shop/create$#s";s:11:"path_tokens";a:1:{i:0;a:2:{i:0;s:4:"text";i:1;s:18:"/admin/shop/create";}}s:9:"path_vars";a:0:{}s:10:"host_regex";N;s:11:"host_tokens";a:0:{}s:9:"host_vars";a:0:{}}}}}'),
(229, 'admin.user.register', '/admin/user/register', 'C:31:"Symfony\\Component\\Routing\\Route":820:{a:9:{s:4:"path";s:20:"/admin/user/register";s:4:"host";s:0:"";s:8:"defaults";a:2:{s:5:"_form";s:22:"ntc\\user\\form\\UserForm";s:6:"_title";s:8:"Add user";}s:12:"requirements";a:1:{s:11:"_permission";s:16:"administer users";}s:7:"options";a:3:{s:14:"compiler_class";s:39:"Symfony\\Component\\Routing\\RouteCompiler";s:12:"_admin_route";b:1;s:16:"_route_enhancers";a:1:{i:0;s:19:"route_enhancer.form";}}s:7:"schemes";a:0:{}s:7:"methods";a:0:{}s:9:"condition";s:0:"";s:8:"compiled";C:39:"Symfony\\Component\\Routing\\CompiledRoute":292:{a:8:{s:4:"vars";a:0:{}s:11:"path_prefix";s:20:"/admin/user/register";s:10:"path_regex";s:25:"#^/admin/user/register$#s";s:11:"path_tokens";a:1:{i:0;a:2:{i:0;s:4:"text";i:1;s:20:"/admin/user/register";}}s:9:"path_vars";a:0:{}s:10:"host_regex";N;s:11:"host_tokens";a:0:{}s:9:"host_vars";a:0:{}}}}}'),
(230, 'admin.user.authorize', '/admin/user/auth', 'C:31:"Symfony\\Component\\Routing\\Route":804:{a:9:{s:4:"path";s:16:"/admin/user/auth";s:4:"host";s:0:"";s:8:"defaults";a:2:{s:5:"_form";s:22:"ntc\\user\\form\\AuthForm";s:6:"_title";s:8:"Add user";}s:12:"requirements";a:1:{s:11:"_permission";s:16:"administer users";}s:7:"options";a:3:{s:14:"compiler_class";s:39:"Symfony\\Component\\Routing\\RouteCompiler";s:12:"_admin_route";b:1;s:16:"_route_enhancers";a:1:{i:0;s:19:"route_enhancer.form";}}s:7:"schemes";a:0:{}s:7:"methods";a:0:{}s:9:"condition";s:0:"";s:8:"compiled";C:39:"Symfony\\Component\\Routing\\CompiledRoute":280:{a:8:{s:4:"vars";a:0:{}s:11:"path_prefix";s:16:"/admin/user/auth";s:10:"path_regex";s:21:"#^/admin/user/auth$#s";s:11:"path_tokens";a:1:{i:0;a:2:{i:0;s:4:"text";i:1;s:16:"/admin/user/auth";}}s:9:"path_vars";a:0:{}s:10:"host_regex";N;s:11:"host_tokens";a:0:{}s:9:"host_vars";a:0:{}}}}}');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

DROP TABLE IF EXISTS `section`;
CREATE TABLE IF NOT EXISTS `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Shop''s url string',
  `description` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Shop''s description',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_E2CE43734584665A` (`product_id`),
  KEY `section_url_idx` (`id`,`url`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `product_id`, `name`, `url`, `description`, `created`, `updated`) VALUES
(1, 1, 'xdmo', 'jnmip;j', 'ijn;jn', '2017-08-21 00:46:00', '2017-08-21 00:00:54');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

DROP TABLE IF EXISTS `shop`;
CREATE TABLE IF NOT EXISTS `shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Shop''s url string',
  `description` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Shop''s description',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C58E39C81C06096` (`activity_id`),
  KEY `url_idx` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'User''s email address',
  `phone` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'User''s phone number',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  UNIQUE KEY `UNIQ_8D93D649444F97DD` (`phone`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  UNIQUE KEY `UNIQ_8D93D6495F37A13B` (`token`),
  KEY `username_email_phone_idx` (`username`,`email`,`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `FK_E2CE43734584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `shop`
--
ALTER TABLE `shop`
  ADD CONSTRAINT `FK_C58E39C81C06096` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
