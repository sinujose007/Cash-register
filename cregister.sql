-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 03, 2019 at 06:09 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cregister`
--

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `access_token` varchar(40) NOT NULL COMMENT '获取资源的access_token',
  `client_id` varchar(80) NOT NULL COMMENT '开发者Appid',
  `user_id` varchar(255) DEFAULT NULL COMMENT '开发者用户id',
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '认证的时间date("Y-m-d H:i:s")',
  `scope` varchar(2000) DEFAULT NULL COMMENT '权限容器'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`access_token`, `client_id`, `user_id`, `expires`, `scope`) VALUES
('0b84a512b6ea40d9aa71027fd3dd46d898e2ae5c', 'testclient', 'user', '2015-06-28 11:55:05', 'userinfo cloud file node');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_authorization_codes`
--

CREATE TABLE `oauth_authorization_codes` (
  `authorization_code` varchar(40) NOT NULL COMMENT '通过Authorization 获取到的code，用于获取access_token',
  `client_id` varchar(80) NOT NULL COMMENT '开发者Appid',
  `user_id` varchar(255) DEFAULT NULL COMMENT '开发者用户id',
  `redirect_uri` varchar(2000) DEFAULT NULL COMMENT '认证后跳转的url',
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '认证的时间date("Y-m-d H:i:s")',
  `scope` varchar(2000) DEFAULT NULL COMMENT '权限容器'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `client_id` varchar(80) NOT NULL COMMENT '开发者AppId',
  `client_secret` varchar(80) NOT NULL COMMENT '开发者AppSecret',
  `redirect_uri` varchar(2000) NOT NULL COMMENT '认证后跳转的url',
  `grant_types` varchar(80) DEFAULT NULL COMMENT '认证的方式，client_credentials、password、refresh_token、authorization_code、authorization_access_token',
  `scope` varchar(100) DEFAULT NULL COMMENT '权限容器',
  `user_id` varchar(80) DEFAULT NULL COMMENT '开发者用户id'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`client_id`, `client_secret`, `redirect_uri`, `grant_types`, `scope`, `user_id`) VALUES
('client2', 'pass2', 'http://homeway.me/', 'authorization_code', 'file node userinfo cloud', 'xiaocao'),
('testclient', 'testpass', 'http://homeway.me/', 'client_credentials password authorization_code refresh_token', 'file node userinfo cloud', 'xiaocao');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_jwt`
--

CREATE TABLE `oauth_jwt` (
  `client_id` varchar(80) NOT NULL COMMENT '开发者用户id',
  `subject` varchar(80) DEFAULT NULL,
  `public_key` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `refresh_token` varchar(40) NOT NULL COMMENT '跟新access_token的token',
  `client_id` varchar(80) NOT NULL COMMENT '开发者AppId',
  `user_id` varchar(255) DEFAULT NULL COMMENT '开发者用户id',
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '认证的时间date("Y-m-d H:i:s")',
  `scope` varchar(2000) DEFAULT NULL COMMENT '权限容器'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oauth_refresh_tokens`
--

INSERT INTO `oauth_refresh_tokens` (`refresh_token`, `client_id`, `user_id`, `expires`, `scope`) VALUES
('0dcd00a06f1598db7c7df2d2faf4c16a7be9c28d', 'testclient', 'user', '2015-07-12 10:55:06', 'userinfo node file'),
('7432203dc184c6c2090fef8b02c5c5acf3f349a5', 'testclient', 'user', '2015-07-12 10:55:16', 'userinfo node file'),
('aef23d373a276116b3afd946ba4a9c39780186c0', 'testclient', 'user', '2015-07-12 10:53:34', 'userinfo cloud file node'),
('af1e55594cae88cedf312f84a89109e3b80a5932', 'testclient', 'user', '2015-07-12 10:54:33', 'userinfo cloud file node'),
('f09ed02ebf185fb08b4f0f316e59bac07028997b', 'testclient', 'user', '2015-07-12 10:46:36', 'userinfo cloud file node'),
('fb1aa4bd8d123abaa882c759d60326dae51543c3', 'testclient', 'user', '2015-07-12 10:46:49', 'userinfo cloud file node');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_scopes`
--

CREATE TABLE `oauth_scopes` (
  `scope` text COMMENT '容器名字',
  `is_default` tinyint(1) DEFAULT NULL COMMENT '是否默认拥有，1=>是，0=>否'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oauth_scopes`
--

INSERT INTO `oauth_scopes` (`scope`, `is_default`) VALUES
('userinfo', 1),
('file', 0),
('node', 0),
('cloud', 0),
('share', 0);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_users`
--

CREATE TABLE `oauth_users` (
  `username` varchar(255) NOT NULL COMMENT '内部时候使用的认证用户名',
  `password` varchar(2000) DEFAULT NULL COMMENT '内部时候使用的认证用户密码',
  `first_name` varchar(255) DEFAULT NULL COMMENT '内部时候使用',
  `last_name` varchar(255) DEFAULT NULL COMMENT '内部时候使用'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oauth_users`
--

INSERT INTO `oauth_users` (`username`, `password`, `first_name`, `last_name`) VALUES
('user', 'pass', 'xiaocao', 'grasses'),
('username', 'password', 'xiaocao', 'grasses');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `PRODUCT_PK` int(11) NOT NULL,
  `BARCODE` varchar(100) DEFAULT NULL,
  `PRODUCT_NAME` varchar(100) DEFAULT NULL,
  `PRODUCT_COST` decimal(10,2) NOT NULL,
  `VAT_FK` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`PRODUCT_PK`, `BARCODE`, `PRODUCT_NAME`, `PRODUCT_COST`, `VAT_FK`) VALUES
(1, 'A100', 'Product-A', '25.00', 1),
(2, 'B501', 'Product-B', '50.00', 2),
(3, 'C1001', 'Product-C', '100.00', 1),
(4, 'D401', 'Product-D', '40.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `RECEIPT_PK` int(11) NOT NULL,
  `CREATE_DATE` datetime NOT NULL,
  `CREATE_USER_PK` int(11) NOT NULL,
  `RECEIPT_NAME` varchar(100) DEFAULT NULL,
  `STATUS` int(11) NOT NULL DEFAULT '0' COMMENT '0: Created, 1;Finished'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`RECEIPT_PK`, `CREATE_DATE`, `CREATE_USER_PK`, `RECEIPT_NAME`, `STATUS`) VALUES
(1, '2019-06-03 12:10:28', 2, 'Receipt-1', 1),
(2, '2019-06-03 12:10:47', 2, 'Receipt-2', 0),
(3, '2019-06-03 12:24:12', 2, 'Receipt-3', 0),
(4, '2019-06-03 17:14:05', 3, 'Receipt-10', 1),
(5, '2019-06-03 17:14:53', 3, 'Receipt-11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `receipt_product`
--

CREATE TABLE `receipt_product` (
  `RECEIPT_PRODUCT_PK` int(11) NOT NULL,
  `RECEIPT_FK` int(11) NOT NULL,
  `PRODUCT_FK` int(11) NOT NULL,
  `MODIFIED_COST` decimal(10,2) NOT NULL,
  `DISCOUNT` int(11) NOT NULL DEFAULT '0' COMMENT 'if 1 discount available',
  `CREATED_DATE` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `receipt_product`
--

INSERT INTO `receipt_product` (`RECEIPT_PRODUCT_PK`, `RECEIPT_FK`, `PRODUCT_FK`, `MODIFIED_COST`, `DISCOUNT`, `CREATED_DATE`) VALUES
(1, 1, 1, '0.00', 0, '2019-06-03 13:45:07'),
(2, 1, 2, '0.00', 0, '2019-06-03 13:45:54'),
(3, 1, 3, '90.00', 0, '2019-06-03 13:46:31'),
(4, 2, 3, '0.00', 0, '2019-06-03 14:06:59'),
(5, 3, 1, '0.00', 0, '2019-06-03 14:43:37'),
(7, 4, 1, '0.00', 0, '2019-06-03 17:14:16'),
(8, 4, 2, '0.00', 0, '2019-06-03 17:14:22'),
(9, 4, 3, '0.00', 0, '2019-06-03 17:14:28'),
(10, 4, 4, '90.00', 0, '2019-06-03 17:14:34'),
(11, 5, 1, '0.00', 0, '2019-06-03 17:14:59'),
(12, 5, 3, '0.00', 0, '2019-06-03 17:15:05');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `ROLE_PK` int(11) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `START_URL` text NOT NULL,
  `DISABLED` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`ROLE_PK`, `NAME`, `START_URL`, `DISABLED`) VALUES
(1, 'admin', 'admin/index', 0),
(2, 'cashier', 'user/index', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('453806b11fe516aee2d3aa94273f7a1b', '::1', '0', 1559578541, ''),
('e516c908f575eb2d2e8f208530c1d3d4', '::1', '0', 1559578573, ''),
('c74da866d92edb894c95c456f13de673', '::1', '0', 1559578609, ''),
('b33db2018e3fa5df4efda2ff73286ab6', '::1', '0', 1559578633, ''),
('d83622dcc69bc6177b6b97e3388a899f', '::1', '0', 1559578657, ''),
('c0b9807eac5f76e5dfe42e4f04150276', '::1', '0', 1559578674, ''),
('014aaf82bb72634a5ccdbeabc15b81d3', '::1', '0', 1559578730, ''),
('b20960510bb6c6f6ae0e28c100670cc9', '::1', '0', 1559578770, ''),
('8b7837e131c103c997b48758ecfbcc32', '::1', '0', 1559578793, ''),
('7d198a829440a35350cb627536973e83', '::1', '0', 1559578809, ''),
('ae9615cbdab70c98b7f16470aa12dc59', '::1', '0', 1559578836, ''),
('d8b16dadf496292d2365180c77207042', '::1', '0', 1559578888, ''),
('06f224d431d1ed169b4f7fa31a969024', '::1', '0', 1559578904, ''),
('68e8ed8fae79beec5e98f2d737ad50a4', '::1', '0', 1559578989, ''),
('bf4069cf3042ff194974e6543f933e11', '::1', '0', 1559579022, ''),
('392a9a7d0291b39eb477a84d76553f02', '::1', '0', 1559579164, ''),
('dcc1b6f9c2088f86662551e6d74b2228', '::1', '0', 1559579251, ''),
('4b135fc6488a88c13abf5b5ae1b1bfb8', '::1', '0', 1559579371, ''),
('fdf1b73d86ea501e19d60732941a45c8', '::1', '0', 1559579422, ''),
('a15b813a690e7377b46333b71c7e70b3', '::1', '0', 1559579471, ''),
('b51952c03bf9f6f3f7bd29ef9bc209e2', '::1', '0', 1559579490, ''),
('1859b550a2271d3162bab37844835104', '::1', '0', 1559579607, ''),
('959a950048d57503654b0f4d77c35a60', '::1', '0', 1559579615, ''),
('19d068f90ab2fdc9aabb9112fd063e44', '::1', '0', 1559579713, ''),
('2653795aabb73a7ed6b2c6dc984a0281', '::1', '0', 1559580047, ''),
('ecc567cd33dcc19f3356dcd5a0ddf7d9', '::1', '0', 1559580103, ''),
('aff2c73aedc7d75062603e9590040f27', '::1', '0', 1559580133, ''),
('7e5ab34196ea8050fa6f5aa35d20bca9', '::1', '0', 1559580172, ''),
('c85777d9b457d875a1d053c8a12b8e2f', '::1', '0', 1559580191, ''),
('a6797978d8b06fe0afda062c6d94c926', '::1', '0', 1559580304, ''),
('e4c22f3e175e099452ee41410ef549d8', '::1', '0', 1559580337, ''),
('88ca210c51c9e4a9851cf88318b6cb68', '::1', '0', 1559580341, ''),
('4d17ae443d47efa90880fbf77cbbd24e', '::1', '0', 1559580346, ''),
('aab5a574e938f5a5d024d7d23af4cf58', '::1', '0', 1559580350, ''),
('61e2bbbb0794d15ac1ff33878d79e5c6', '::1', '0', 1559580352, ''),
('c1c305d79d7670289ad73ef0f79568f6', '::1', '0', 1559580369, ''),
('f53c2799976a7b6933ae0e694112ddba', '::1', '0', 1559580372, ''),
('6acdb527a1e95569878ccdf096a5cee5', '::1', '0', 1559580421, ''),
('91defa45effd25a172359275e059b990', '::1', '0', 1559580423, ''),
('7db84f97e432e7fd73a92d79fe378d89', '::1', '0', 1559580618, ''),
('b04e87b02471e271af91db6d4ac1a651', '::1', '0', 1559580621, ''),
('c041cc680679d46d7caa54e6eb3a684a', '::1', '0', 1559580624, ''),
('5bd150a0e2d80e23148a4054f63196e7', '::1', '0', 1559580631, ''),
('9b49560f251899402f77a65c24c28cae', '::1', '0', 1559580633, ''),
('6d04aa0e5a249869ba7e4da15d804c8b', '::1', '0', 1559580638, ''),
('046a339684ef76d5f21df9be98561af0', '::1', '0', 1559580745, ''),
('de94b4930cfc7a7f6dc2c93de9d7fe8e', '::1', '0', 1559580811, ''),
('d5f46e394ac901b346ec67d7aacfe7b9', '::1', '0', 1559580816, ''),
('cec2103a1ad59244cf4f34b8c54fae18', '::1', '0', 1559580818, ''),
('b27e18152f60916cd3822642ce8a5ca9', '::1', '0', 1559580822, ''),
('ecb9c478824c86f899fc58527ae5ab00', '::1', '0', 1559580827, ''),
('21db42f0566e292f1bdfbeaed15a1b9e', '::1', '0', 1559580854, ''),
('8b2ddf36218e773d8880c0a0c892e222', '::1', '0', 1559580880, ''),
('776af0b431b2192350978b277fd6d9c0', '::1', '0', 1559580919, ''),
('fba2f724733fde74e07bb1540972983f', '::1', '0', 1559580921, ''),
('07ab84fb41c92aa3fb7c3ff1b34b5b24', '::1', '0', 1559580977, ''),
('6b5be1c9c7c28387f701e8af89c0d1e0', '::1', '0', 1559580981, ''),
('07280dbdc7b780e7fc4f353672098ef0', '::1', '0', 1559580984, ''),
('8e19d033e5077eb6ff01c281daa17333', '::1', '0', 1559581520, ''),
('7ebbc6f3d45e2b5a6be07da65ce099bb', '::1', '0', 1559581525, ''),
('7f015544419615ba951a61ffca6952e4', '::1', '0', 1559581528, ''),
('e4b0bb0c7ba0fe3463e59510993cc799', '::1', '0', 1559581536, ''),
('18baea6532023be378e5604d4ed33a7c', '::1', '0', 1559581551, ''),
('cdf298d80fd6533234c0c84c41e20f5a', '::1', '0', 1559581577, ''),
('1c5e4db75c3d73d26457c22d9372a597', '::1', '0', 1559581580, ''),
('5b707e1ac57370724e8c3bf17473f912', '::1', '0', 1559581583, ''),
('ee7541bae5788a4dc4597d1c44b64d82', '::1', '0', 1559581585, ''),
('4e11c90df14b5cefb46afa821bd0c1a7', '::1', '0', 1559581587, ''),
('fe0e5d5f26e354fd4940b8d169fcd8af', '::1', '0', 1559581587, ''),
('de225e2b068906bc2cba19f9716fbf44', '::1', '0', 1559581591, ''),
('cfae4b357ddaa19b7af31f79652d0e70', '::1', '0', 1559581594, ''),
('acf5b72b31a67f66387182339b063d5f', '::1', '0', 1559581596, ''),
('02b1a711607154fe1802761880c81d9f', '::1', '0', 1559581614, ''),
('03e3085869f6714c151a912ba81bf6c9', '::1', '0', 1559581618, ''),
('419391bf740f4fa026779b580476efd3', '::1', '0', 1559581618, ''),
('4461e11bb4e8ec614094aaa742cb2347', '::1', '0', 1559581642, ''),
('f021e1098ab86c6ee43b8abf0a1b3954', '::1', '0', 1559581646, ''),
('d16f177d3bc2c36d7b8ee6c03404faf3', '::1', '0', 1559581660, ''),
('3255fbde9b3c6e80044ea5cf66d863c8', '::1', '0', 1559581669, ''),
('b5eccd5075243c116f2937663096243b', '::1', '0', 1559581738, ''),
('658af10fcaa453622893af3cf7e3f53a', '::1', '0', 1559581768, ''),
('eefc60901fb781526521c4ffbc4ec658', '::1', '0', 1559581771, ''),
('b45f812fcb55b8400e8db8b31e75ddbd', '::1', '0', 1559582009, ''),
('38b881e4337dec86b6b7461ebaa6458a', '::1', '0', 1559582009, ''),
('653ae28dd4815e8ce4cc351675ad6599', '::1', '0', 1559582013, ''),
('cf35cd23989d0091148e961c98955806', '::1', '0', 1559582016, ''),
('8ba2b5451e1d41491df275fd45f654ac', '::1', '0', 1559582019, ''),
('9ca20b21fe096459da1d793a255fd7a6', '::1', '0', 1559582035, ''),
('b9488af7de79cba79d5a54976f5fe79f', '::1', '0', 1559582046, ''),
('b553191f8897fdddecc13209493adb01', '::1', '0', 1559582046, ''),
('4b7f156b710f99e77724597a313deb6e', '::1', '0', 1559582050, ''),
('852cdb86049175dbc15d5e8f6a6352ed', '::1', '0', 1559582056, ''),
('89fd9d685a6a5a6b58ac79028c258a16', '::1', '0', 1559582056, ''),
('95b76ebae2e02c6ccf66411e919c803f', '::1', '0', 1559582062, ''),
('5eb7b5c8424cbfc247bb043ba6a2dce7', '::1', '0', 1559582063, ''),
('c6e1af33dfb088971710c0118bc01f23', '::1', '0', 1559582068, ''),
('4d42f773b0a021748e49edd68a0e6cb0', '::1', '0', 1559582069, ''),
('3d7ffda9a49e403788cb011e25474de5', '::1', '0', 1559582074, ''),
('9d38aade2455b3d2f4b5a70e5771bb82', '::1', '0', 1559582075, ''),
('d12a85a3783119897ae7bcd52b69c770', '::1', '0', 1559582085, ''),
('28d551783b0ab22dd608196ca6e6f265', '::1', '0', 1559582093, ''),
('20309db52d2908c0b15d8537444074a3', '::1', '0', 1559582094, ''),
('544685c80861c79a6b78d23363925165', '::1', '0', 1559582099, ''),
('c03bb96864f75004758f670320d78ed1', '::1', '0', 1559582099, ''),
('9a1bf0876e3981a53c041f5bd309a8ce', '::1', '0', 1559582105, ''),
('f90c3d682a5b999bfe0908e8850977f0', '::1', '0', 1559582105, ''),
('523138a53632035772a834eb64728557', '::1', '0', 1559582110, ''),
('418d7629dbb1f220d5cc572c31a43e9c', '::1', '0', 1559582111, ''),
('b80a26829bd3b48f3d6cb86e7e208e8c', '::1', '0', 1559582113, ''),
('5bfea02546e393c7b77d4de42e92d4f8', '::1', '0', 1559582116, ''),
('7716bc10f9c9252820532d403c9ca16f', '::1', '0', 1559582116, ''),
('b99c1f848f74030c7b40d09d68688587', '::1', '0', 1559582121, ''),
('e048118bc2ef61d514e668616a5197f0', '::1', '0', 1559582121, ''),
('3827750c7af8c90de5f92e253949e3f7', '::1', '0', 1559582125, ''),
('1abbbf30fa7ed24e0b93be8ddb56e821', '::1', '0', 1559582127, ''),
('69cec70b192a6ff6d3d5f4243aa038ca', '::1', '0', 1559582130, ''),
('186d9dc1108c5d45903ab4de53c27914', '::1', '0', 1559582130, ''),
('b4b139db3e72baa162ae3a4783c3e39b', '::1', '0', 1559582134, ''),
('e79d82841799adff29a4bede16273cdc', '::1', '0', 1559582151, ''),
('208a69271882b733c412abda9d21da8e', '::1', '0', 1559582154, ''),
('7403160160390e7dddd61d8e1a1fcf0f', '::1', '0', 1559582157, ''),
('1d983603e56e32fc673e69397d968244', '::1', '0', 1559582158, ''),
('51cb075a0e92facef583d3071010c088', '::1', '0', 1559582163, ''),
('6f4da876ed65fba3813bea3362bc14a1', '::1', '0', 1559582163, ''),
('36e3d1992a10243639c6431d0856da7b', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:66.0) Gecko/20100101 Firefox/66.0', 1559584282, 'a:3:{s:9:\"user_data\";s:0:\"\";s:14:\"validationcode\";s:64:\"KHswb5ApcDcqcTB431SxAUea1u7knqzTKsRZoWNE49XvUkNK1kKEDtT8FeEOSQYG\";s:8:\"userinfo\";a:7:{s:7:\"role_id\";s:1:\"1\";s:7:\"user_id\";s:1:\"1\";s:9:\"user_name\";s:4:\"sinu\";s:4:\"name\";s:9:\"SINU JOSE\";s:10:\"user_email\";s:21:\"sinujose007@gmail.com\";s:13:\"user_password\";s:60:\"$2a$08$RyV0865qQjmvGZ3PQYJL.OPJXMcbU1p.f8E8jTSRkMp1nxadofwky\";s:11:\"querystatus\";s:7:\"success\";}}');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `USER_PK` int(11) NOT NULL,
  `ROLE_FK` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(512) NOT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `DISABLED` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USER_PK`, `ROLE_FK`, `NAME`, `USERNAME`, `PASSWORD`, `EMAIL`, `DISABLED`) VALUES
(1, 1, 'SINU JOSE', 'sinu', '$2a$08$RyV0865qQjmvGZ3PQYJL.OPJXMcbU1p.f8E8jTSRkMp1nxadofwky', 'sinujose007@gmail.com', 0),
(2, 2, 'cashier1', 'user1', '$2a$08$i7Dst1KSxK/KXCkGVsnHkOTGMmQBmwZas.9vorWDBMRfTaekarGm.', 'cash1@gmail.com', 0),
(3, 2, 'cashier2', 'cash2', '$2a$08$RyV0865qQjmvGZ3PQYJL.OPJXMcbU1p.f8E8jTSRkMp1nxadofwky', 'cash1@gmail.com', 0),
(4, 2, 'cashier3', 'cash3', '$2a$08$HtPD9/oZzYNeJQEVxMCV2./Kj.RyX768O48xVitoL2m03TPt9gg1W', 'cash3@gmail.com', 0),
(5, 2, 'cashier4', 'cash4', '$2a$08$ZX2eDDCwUJwVoxv6AriB/.XR1rMRLzU/wIbczaImJNB7uf82A/yRW', 'cash3@gmail.com', 0),
(6, 2, 'cashier5', 'cash5', '$2a$08$ILTZaLQtxVSWNT9ffoCJi.GlBnrP2UVtKQnt0WJSAlKhpBluwWLFa', 'cash5@gmail.com', 0),
(7, 2, 'cashier52', 'cash55', '$2a$08$Ki3PIAKpXUAug2kciKl0t.OWeKln8EurEQGHBAwvaXtmg4YP7pEcq', 'cash5@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vatclass`
--

CREATE TABLE `vatclass` (
  `VAT_PK` int(11) NOT NULL,
  `VAT_CLASS` varchar(100) DEFAULT NULL,
  `VAT_RATE` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vatclass`
--

INSERT INTO `vatclass` (`VAT_PK`, `VAT_CLASS`, `VAT_RATE`) VALUES
(1, 'CLASS A', 6),
(2, 'CLASS B', 21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`access_token`);

--
-- Indexes for table `oauth_authorization_codes`
--
ALTER TABLE `oauth_authorization_codes`
  ADD PRIMARY KEY (`authorization_code`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `oauth_jwt`
--
ALTER TABLE `oauth_jwt`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`refresh_token`);

--
-- Indexes for table `oauth_users`
--
ALTER TABLE `oauth_users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`PRODUCT_PK`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`RECEIPT_PK`);

--
-- Indexes for table `receipt_product`
--
ALTER TABLE `receipt_product`
  ADD PRIMARY KEY (`RECEIPT_PRODUCT_PK`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`ROLE_PK`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`USER_PK`);

--
-- Indexes for table `vatclass`
--
ALTER TABLE `vatclass`
  ADD PRIMARY KEY (`VAT_PK`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `PRODUCT_PK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `RECEIPT_PK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `receipt_product`
--
ALTER TABLE `receipt_product`
  MODIFY `RECEIPT_PRODUCT_PK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `ROLE_PK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `USER_PK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vatclass`
--
ALTER TABLE `vatclass`
  MODIFY `VAT_PK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
