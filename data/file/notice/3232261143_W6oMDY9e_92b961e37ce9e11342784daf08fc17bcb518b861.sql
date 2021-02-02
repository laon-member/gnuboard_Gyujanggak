-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 21-01-06 08:44
-- 서버 버전: 10.1.38-MariaDB
-- PHP 버전: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `eyoom`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `board_business`
--

CREATE TABLE `board_business` (
  `idx` int(11) NOT NULL,
  `title` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_auth`
--

CREATE TABLE `g5_auth` (
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `au_menu` varchar(20) NOT NULL DEFAULT '',
  `au_auth` set('r','w','d') NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_autosave`
--

CREATE TABLE `g5_autosave` (
  `as_id` int(11) NOT NULL,
  `mb_id` varchar(20) NOT NULL,
  `as_uid` bigint(20) UNSIGNED NOT NULL,
  `as_subject` varchar(255) NOT NULL,
  `as_content` text NOT NULL,
  `as_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_board`
--

CREATE TABLE `g5_board` (
  `bo_table` varchar(20) NOT NULL DEFAULT '' COMMENT '게시판 db 이름',
  `gr_id` varchar(255) NOT NULL DEFAULT '',
  `bo_subject` varchar(255) NOT NULL DEFAULT '' COMMENT '게시판 이름',
  `bo_mobile_subject` varchar(255) NOT NULL DEFAULT '',
  `bo_device` enum('both','pc','mobile') NOT NULL DEFAULT 'both',
  `bo_admin` varchar(255) NOT NULL DEFAULT '',
  `bo_list_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_read_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_write_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_reply_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_comment_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_upload_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_download_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_html_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_link_level` tinyint(4) NOT NULL DEFAULT '0',
  `bo_count_delete` tinyint(4) NOT NULL DEFAULT '0',
  `bo_count_modify` tinyint(4) NOT NULL DEFAULT '0',
  `bo_read_point` int(11) NOT NULL DEFAULT '0',
  `bo_write_point` int(11) NOT NULL DEFAULT '0',
  `bo_comment_point` int(11) NOT NULL DEFAULT '0',
  `bo_download_point` int(11) NOT NULL DEFAULT '0',
  `bo_use_category` tinyint(4) NOT NULL DEFAULT '0',
  `bo_category_list` text NOT NULL,
  `bo_use_sideview` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_file_content` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_secret` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_dhtml_editor` tinyint(4) NOT NULL DEFAULT '0',
  `bo_select_editor` varchar(50) NOT NULL DEFAULT '',
  `bo_use_rss_view` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_good` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_nogood` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_name` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_signature` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_ip_view` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_list_view` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_list_file` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_list_content` tinyint(4) NOT NULL DEFAULT '0',
  `bo_table_width` int(11) NOT NULL DEFAULT '0',
  `bo_subject_len` int(11) NOT NULL DEFAULT '0',
  `bo_mobile_subject_len` int(11) NOT NULL DEFAULT '0',
  `bo_page_rows` int(11) NOT NULL DEFAULT '0',
  `bo_mobile_page_rows` int(11) NOT NULL DEFAULT '0',
  `bo_new` int(11) NOT NULL DEFAULT '0',
  `bo_hot` int(11) NOT NULL DEFAULT '0',
  `bo_image_width` int(11) NOT NULL DEFAULT '0',
  `bo_skin` varchar(255) NOT NULL DEFAULT '',
  `bo_mobile_skin` varchar(255) NOT NULL DEFAULT '',
  `bo_include_head` varchar(255) NOT NULL DEFAULT '',
  `bo_include_tail` varchar(255) NOT NULL DEFAULT '',
  `bo_content_head` text NOT NULL,
  `bo_mobile_content_head` text NOT NULL,
  `bo_content_tail` text NOT NULL,
  `bo_mobile_content_tail` text NOT NULL,
  `bo_insert_content` text NOT NULL,
  `bo_gallery_cols` int(11) NOT NULL DEFAULT '0',
  `bo_gallery_width` int(11) NOT NULL DEFAULT '0',
  `bo_gallery_height` int(11) NOT NULL DEFAULT '0',
  `bo_mobile_gallery_width` int(11) NOT NULL DEFAULT '0',
  `bo_mobile_gallery_height` int(11) NOT NULL DEFAULT '0',
  `bo_upload_size` int(11) NOT NULL DEFAULT '0',
  `bo_reply_order` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_search` tinyint(4) NOT NULL DEFAULT '0',
  `bo_order` int(11) NOT NULL DEFAULT '0',
  `bo_count_write` int(11) NOT NULL DEFAULT '0',
  `bo_count_comment` int(11) NOT NULL DEFAULT '0',
  `bo_write_min` int(11) NOT NULL DEFAULT '0',
  `bo_write_max` int(11) NOT NULL DEFAULT '0',
  `bo_comment_min` int(11) NOT NULL DEFAULT '0',
  `bo_comment_max` int(11) NOT NULL DEFAULT '0',
  `bo_notice` text NOT NULL,
  `bo_upload_count` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_email` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_cert` enum('','cert','adult','hp-cert','hp-adult') NOT NULL DEFAULT '',
  `bo_use_sns` tinyint(4) NOT NULL DEFAULT '0',
  `bo_use_captcha` tinyint(4) NOT NULL DEFAULT '0',
  `bo_sort_field` varchar(255) NOT NULL DEFAULT '',
  `bo_1_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_2_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_3_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_4_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_5_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_6_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_7_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_8_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_9_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_10_subj` varchar(255) NOT NULL DEFAULT '',
  `bo_1` varchar(255) NOT NULL DEFAULT '',
  `bo_2` varchar(255) NOT NULL DEFAULT '',
  `bo_3` varchar(255) NOT NULL DEFAULT '',
  `bo_4` varchar(255) NOT NULL DEFAULT '',
  `bo_5` varchar(255) NOT NULL DEFAULT '',
  `bo_6` varchar(255) NOT NULL DEFAULT '',
  `bo_7` varchar(255) NOT NULL DEFAULT '',
  `bo_8` varchar(255) NOT NULL DEFAULT '',
  `bo_9` varchar(255) NOT NULL DEFAULT '',
  `bo_10` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='게시판 종류';

--
-- 테이블의 덤프 데이터 `g5_board`
--

INSERT INTO `g5_board` (`bo_table`, `gr_id`, `bo_subject`, `bo_mobile_subject`, `bo_device`, `bo_admin`, `bo_list_level`, `bo_read_level`, `bo_write_level`, `bo_reply_level`, `bo_comment_level`, `bo_upload_level`, `bo_download_level`, `bo_html_level`, `bo_link_level`, `bo_count_delete`, `bo_count_modify`, `bo_read_point`, `bo_write_point`, `bo_comment_point`, `bo_download_point`, `bo_use_category`, `bo_category_list`, `bo_use_sideview`, `bo_use_file_content`, `bo_use_secret`, `bo_use_dhtml_editor`, `bo_select_editor`, `bo_use_rss_view`, `bo_use_good`, `bo_use_nogood`, `bo_use_name`, `bo_use_signature`, `bo_use_ip_view`, `bo_use_list_view`, `bo_use_list_file`, `bo_use_list_content`, `bo_table_width`, `bo_subject_len`, `bo_mobile_subject_len`, `bo_page_rows`, `bo_mobile_page_rows`, `bo_new`, `bo_hot`, `bo_image_width`, `bo_skin`, `bo_mobile_skin`, `bo_include_head`, `bo_include_tail`, `bo_content_head`, `bo_mobile_content_head`, `bo_content_tail`, `bo_mobile_content_tail`, `bo_insert_content`, `bo_gallery_cols`, `bo_gallery_width`, `bo_gallery_height`, `bo_mobile_gallery_width`, `bo_mobile_gallery_height`, `bo_upload_size`, `bo_reply_order`, `bo_use_search`, `bo_order`, `bo_count_write`, `bo_count_comment`, `bo_write_min`, `bo_write_max`, `bo_comment_min`, `bo_comment_max`, `bo_notice`, `bo_upload_count`, `bo_use_email`, `bo_use_cert`, `bo_use_sns`, `bo_use_captcha`, `bo_sort_field`, `bo_1_subj`, `bo_2_subj`, `bo_3_subj`, `bo_4_subj`, `bo_5_subj`, `bo_6_subj`, `bo_7_subj`, `bo_8_subj`, `bo_9_subj`, `bo_10_subj`, `bo_1`, `bo_2`, `bo_3`, `bo_4`, `bo_5`, `bo_6`, `bo_7`, `bo_8`, `bo_9`, `bo_10`) VALUES
('business', 'community', '사업공고', '', 'both', '', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, -1, 5, 1, -20, 0, '', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 60, 30, 15, 15, 24, 100, 835, 'basic', 'basic', '_head.php', '_tail.php', '', '', '', '', '', 4, 202, 150, 125, 100, 1048576, 1, 0, 0, 103, 1, 0, 0, 0, 0, '', 2, 0, '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('gallery', 'community', '갤러리', '', 'both', '', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, -1, 5, 1, -20, 0, '', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 60, 30, 15, 15, 24, 100, 835, 'gallery', 'gallery', '_head.php', '_tail.php', '', '', '', '', '', 4, 202, 150, 125, 100, 1048576, 1, 0, 0, 0, 0, 0, 0, 0, 0, '', 2, 0, '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('notice', 'community', '공지사항', '', 'both', '', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, -1, 5, 1, -20, 0, '', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 60, 30, 15, 15, 24, 100, 835, 'basic', 'basic', '_head.php', '_tail.php', '', '', '', '', '', 4, 202, 150, 125, 100, 1048576, 1, 0, 0, 45, 0, 0, 0, 0, 0, '', 2, 0, '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('qa', 'community', '질문답변', '', 'both', '', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, -1, 5, 1, -20, 0, '', 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 60, 30, 15, 15, 24, 100, 835, 'basic', 'basic', '_head.php', '_tail.php', '', '', '', '', '', 4, 202, 150, 125, 100, 1048576, 1, 0, 0, 0, 0, 0, 0, 0, 0, '', 2, 0, '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_board_file`
--

CREATE TABLE `g5_board_file` (
  `bo_table` varchar(20) NOT NULL DEFAULT '' COMMENT '게시판 이름',
  `wr_id` int(11) NOT NULL DEFAULT '0' COMMENT '게시판 순서',
  `bf_no` int(11) NOT NULL DEFAULT '0' COMMENT '파일 순서',
  `bf_source` varchar(255) NOT NULL DEFAULT '' COMMENT '파일 실제 이름',
  `bf_file` varchar(255) NOT NULL DEFAULT '' COMMENT '파일 저징된 이름',
  `bf_download` int(11) NOT NULL COMMENT '다운로드 수',
  `bf_content` text NOT NULL,
  `bf_fileurl` varchar(255) NOT NULL DEFAULT '',
  `bf_thumburl` varchar(255) NOT NULL DEFAULT '',
  `bf_storage` varchar(50) NOT NULL DEFAULT '',
  `bf_filesize` int(11) NOT NULL DEFAULT '0' COMMENT '파일 용량',
  `bf_width` int(11) NOT NULL DEFAULT '0' COMMENT '파일 가로 사이즈',
  `bf_height` smallint(6) NOT NULL DEFAULT '0' COMMENT '파일 세로 사이즈',
  `bf_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '파일 타입',
  `bf_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '파일 등록일자'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='게시판 파일';

--
-- 테이블의 덤프 데이터 `g5_board_file`
--

INSERT INTO `g5_board_file` (`bo_table`, `wr_id`, `bf_no`, `bf_source`, `bf_file`, `bf_download`, `bf_content`, `bf_fileurl`, `bf_thumburl`, `bf_storage`, `bf_filesize`, `bf_width`, `bf_height`, `bf_type`, `bf_datetime`) VALUES
('business', 0, 0, 'poker.zip', '0_BDGbljgh_dfa84a83a6e05bf63315e6cb17de1307f4cffb9e.zip', 0, '', '', '', '', 950877, 0, 0, 0, '2020-12-29 11:45:58'),
('business', 0, 1, '', '', 0, '', '', '', '', 0, 0, 0, 0, '2020-12-28 16:10:04'),
('business', 88, 0, 'poker_game.zip', '0_59Cdj1Fz_f37c798cfa8191d2f6b552052a90526e875f90ae.zip', 0, '', '', '', '', 860550, 0, 0, 0, '2020-12-28 16:15:00'),
('business', 88, 1, '', '', 0, '', '', '', '', 0, 0, 0, 0, '2020-12-28 16:15:00'),
('business', 89, 0, 'poker.zip', '0_jCcs302W_82bb9b323baf2cc948925bd036096125571a2c0a.zip', 0, '', '', '', '', 950877, 0, 0, 0, '2020-12-28 16:16:13'),
('business', 89, 1, '', '', 0, '', '', '', '', 0, 0, 0, 0, '2020-12-28 16:16:13'),
('business', 90, 0, 'poker.zip', '0_H3OirPqj_c608afccda5cb23a425f978320f04fea911766d2.zip', 0, '', '', '', '', 950877, 0, 0, 0, '2020-12-28 16:21:16'),
('business', 90, 1, '', '', 0, '', '', '', '', 0, 0, 0, 0, '2020-12-28 16:21:16'),
('business', 91, 0, 'EF_개발_스토리보드_2020_11_16.pptx', '0_DAYLSQRX_891c6bb0e4c9944306b3024f117bc6e854b06adc.pptx', 0, '', '', '', '', 117146, 0, 0, 0, '2020-12-28 16:21:30'),
('business', 91, 1, '', '', 0, '', '', '', '', 0, 0, 0, 0, '2020-12-28 16:21:30'),
('business', 92, 0, 'EF_개발_스토리보드_2020_11_16.pptx', '0_9r4psJ1G_0668be147c0c64f6d74d9ee23dff88f0275853f5.pptx', 0, '', '', '', '', 117146, 0, 0, 0, '2020-12-28 16:22:24'),
('business', 93, 0, 'poker.zip', '0_fzxFIvoZ_94044fa3894eb3be9e2cdb3f7f23840e7afc9679.zip', 0, '', '', '', '', 950877, 0, 0, 0, '2020-12-28 16:30:41'),
('business', 94, 0, 'agent.pptx', '0_TpcGB0S4_4dc4a7bc11d77b21c11cf7597a8454477cda2736.pptx', 0, '', '', '', '', 581897, 0, 0, 0, '2021-01-05 11:35:40'),
('g5_business_propos', 94, 0, 'build 2.zip', '0_F28VYwhQ_2ad450da17960fae5cb5696f01e8849d296a8bdf.zip', 0, '', '', '', '', 2343566, 0, 0, 0, '2021-01-05 12:09:58'),
('notice', 0, 0, 'build.zip', '0_oLHc5jRr_9ded95adc404f88346bc781d5f1d3d0b5e238323.zip', 0, '', '', '', '', 2313369, 0, 0, 0, '2020-12-28 15:34:22'),
('notice', 0, 1, 'poker_game.zip', '0_m6Espbdw_c167dd868aa240187c54a7e5892e2d206d3fd8dd.zip', 0, '', '', '', '', 860550, 0, 0, 0, '2020-12-28 15:07:28'),
('notice', 50, 0, 'build.zip', '0_XadCf9ev_f3865802f27f47efdc1d8cedee83567f1863de6c.zip', 0, '', '', '', '', 2313369, 0, 0, 0, '2020-12-28 15:36:01'),
('notice', 51, 0, 'EF_개발_스토리보드_2020_11_16.pptx', '0_aCgYzW9G_0ae99e4ad89f9f840ab19311ad9de0da9001d443.pptx', 0, '', '', '', '', 117146, 0, 0, 0, '2020-12-28 15:38:50'),
('notice', 51, 1, 'poker_game.zip', '0_JD57iFTb_c6202768d2028384ef204e297e79af5fd6736f8f.zip', 0, '', '', '', '', 860550, 0, 0, 0, '2020-12-28 15:38:50'),
('report', 0, 0, 'build.zip', '0_Ugx7ECQS_f9e5382b7d7276e61cc3000ea4e95c5bce503700.zip', 0, '', '', '', '', 2313369, 0, 0, 0, '2020-12-29 16:01:37'),
('report', 4, 1, 'build.zip.temp', '0_tDkBzUFN_908521ff034c56cc5a1939fd3a2a2a869ef509e6.temp', 0, '', '', '', '', 3325508, 0, 0, 0, '2020-12-29 15:34:57'),
('report', 47, 0, 'EF_개발_스토리보드_2020_11_16.pptx', '0_xTfIg3F0_87412b7b765a1da2697c583d0c883415eeec6a64.pptx', 0, '', '', '', '', 117146, 0, 0, 0, '2020-12-29 15:59:23'),
('report', 48, 0, 'build.zip', '0_3SmFZ6Jr_ff919858d1f9465117b66b9729caf24a82c58cf1.zip', 0, '', '', '', '', 2313369, 0, 0, 0, '2020-12-29 18:07:57'),
('report', 48, 1, 'build.zip', '0_JQgBYfxD_4038a548687d46a5fcd0d88e000ec0a764c544cc.zip', 0, '', '', '', '', 2313369, 0, 0, 0, '2020-12-29 18:13:57'),
('report', 48, 2, 'build.zip.temp', '0_UwO9y6kT_9dee70053d305ef7fe6389eea2459667ccb2f20f.temp', 0, '', '', '', '', 3325508, 0, 0, 0, '2020-12-29 18:49:44'),
('report', 48, 4, 'build.zip', '0_at5uGnjF_6f16f1833c76c06d1152e56bad471a39d5389cae.zip', 0, '', '', '', '', 2313369, 0, 0, 0, '2020-12-29 18:49:57'),
('report', 50, 0, 'build 2.zip', '0_Jwfe1a6B_526173d86f0a6c9573ef05cd64f05e91528f8ff2.zip', 0, '', '', '', '', 2343566, 0, 0, 0, '2021-01-05 13:31:52');

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_board_good`
--

CREATE TABLE `g5_board_good` (
  `bg_id` int(11) NOT NULL,
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `wr_id` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `bg_flag` varchar(255) NOT NULL DEFAULT '',
  `bg_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_board_new`
--

CREATE TABLE `g5_board_new` (
  `bn_id` int(11) NOT NULL,
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `wr_id` int(11) NOT NULL DEFAULT '0',
  `wr_parent` int(11) NOT NULL DEFAULT '0',
  `bn_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mb_id` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='게시판 새로운 글';

--
-- 테이블의 덤프 데이터 `g5_board_new`
--

INSERT INTO `g5_board_new` (`bn_id`, `bo_table`, `wr_id`, `wr_parent`, `bn_datetime`, `mb_id`) VALUES
(35, 'business', 0, 0, '2020-12-17 11:15:59', 'admin'),
(36, 'business', 0, 0, '2020-12-17 18:14:03', 'admin'),
(37, 'business', 0, 0, '2020-12-17 18:15:18', 'admin'),
(38, 'business', 29, 29, '2020-12-18 12:34:32', 'admin'),
(39, 'business', 30, 30, '2020-12-20 22:26:08', 'admin'),
(40, 'business', 31, 31, '2020-12-20 22:32:39', 'admin'),
(41, 'business', 32, 32, '2020-12-20 22:34:02', 'admin'),
(42, 'business', 33, 33, '2020-12-20 22:51:11', 'admin'),
(43, 'business', 34, 34, '2020-12-20 22:51:46', 'admin'),
(44, 'business', 35, 35, '2020-12-20 22:52:18', 'admin'),
(45, 'business', 36, 36, '2020-12-20 22:52:19', 'admin'),
(46, 'business', 37, 37, '2020-12-20 22:52:20', 'admin'),
(47, 'business', 38, 38, '2020-12-20 22:52:22', 'admin'),
(48, 'business', 39, 39, '2020-12-20 22:52:23', 'admin'),
(49, 'business', 40, 40, '2020-12-20 22:52:35', 'admin'),
(50, 'business', 41, 41, '2020-12-20 22:55:20', 'admin'),
(51, 'business', 42, 42, '2020-12-20 22:56:23', 'admin'),
(52, 'business', 43, 43, '2020-12-20 22:56:49', 'admin'),
(53, 'business', 44, 44, '2020-12-20 22:57:05', 'admin'),
(54, 'business', 45, 45, '2020-12-20 22:57:29', 'admin'),
(55, 'business', 46, 46, '2020-12-20 23:01:45', 'admin'),
(56, 'business', 47, 47, '2020-12-20 23:02:10', 'admin'),
(57, 'business', 48, 48, '2020-12-20 23:02:25', 'admin'),
(58, 'business', 49, 49, '2020-12-20 23:02:26', 'admin'),
(59, 'business', 50, 50, '2020-12-20 23:02:27', 'admin'),
(60, 'business', 51, 51, '2020-12-20 23:03:32', 'admin'),
(61, 'business', 52, 52, '2020-12-20 23:04:02', 'admin'),
(62, 'business', 53, 53, '2020-12-20 23:04:10', 'admin'),
(63, 'business', 54, 54, '2020-12-21 00:35:37', 'admin'),
(64, 'business', 55, 55, '2020-12-21 00:37:14', 'admin'),
(65, 'business', 56, 56, '2020-12-21 00:38:34', 'admin'),
(66, 'business', 57, 57, '2020-12-21 00:38:42', 'admin'),
(67, 'business', 58, 58, '2020-12-21 00:42:51', 'admin'),
(68, 'business', 0, 0, '2020-12-21 00:43:24', 'admin'),
(69, 'business', 0, 0, '2020-12-21 00:43:28', 'admin'),
(70, 'business', 0, 0, '2020-12-21 00:43:43', 'admin'),
(71, 'business', 0, 0, '2020-12-21 00:43:44', 'admin'),
(72, 'business', 0, 0, '2020-12-21 00:43:47', 'admin'),
(73, 'business', 0, 0, '2020-12-21 00:44:07', 'admin'),
(74, 'business', 0, 0, '2020-12-21 00:44:14', 'admin'),
(75, 'business', 0, 0, '2020-12-21 00:44:18', 'admin'),
(76, 'business', 0, 0, '2020-12-21 00:44:27', 'admin'),
(77, 'business', 0, 0, '2020-12-21 00:44:41', 'admin'),
(78, 'business', 0, 0, '2020-12-21 00:45:07', 'admin'),
(79, 'business', 0, 0, '2020-12-21 00:45:29', 'admin'),
(80, 'business', 0, 0, '2020-12-21 00:45:51', 'admin'),
(81, 'business', 0, 0, '2020-12-21 00:46:21', 'admin'),
(82, 'business', 0, 0, '2020-12-21 00:47:02', 'admin'),
(83, 'business', 0, 0, '2020-12-21 00:47:21', 'admin'),
(84, 'business', 0, 0, '2020-12-21 00:47:43', 'admin'),
(85, 'business', 0, 0, '2020-12-21 00:47:56', 'admin'),
(86, 'business', 0, 0, '2020-12-21 00:47:56', 'admin'),
(87, 'business', 0, 0, '2020-12-21 00:48:06', 'admin'),
(88, 'business', 0, 0, '2020-12-21 00:48:12', 'admin'),
(89, 'business', 0, 0, '2020-12-21 00:48:38', 'admin'),
(90, 'business', 0, 0, '2020-12-21 00:48:39', 'admin'),
(91, 'business', 0, 0, '2020-12-21 00:48:49', 'admin'),
(92, 'business', 0, 0, '2020-12-21 00:48:51', 'admin'),
(93, 'business', 0, 0, '2020-12-21 00:49:48', 'admin'),
(94, 'business', 0, 0, '2020-12-21 00:49:55', 'admin'),
(95, 'notice', 0, 0, '2020-12-21 01:17:42', 'admin'),
(96, 'notice', 0, 0, '2020-12-21 01:17:51', 'admin'),
(97, 'notice', 0, 0, '2020-12-21 01:18:31', 'admin'),
(98, 'notice', 0, 0, '2020-12-21 01:19:42', 'admin'),
(99, 'notice', 0, 0, '2020-12-21 01:19:46', 'admin'),
(100, 'notice', 0, 0, '2020-12-21 01:19:47', 'admin'),
(101, 'notice', 0, 0, '2020-12-21 01:19:50', 'admin'),
(102, 'notice', 0, 0, '2020-12-21 01:19:53', 'admin'),
(103, 'notice', 0, 0, '2020-12-21 01:20:00', 'admin'),
(104, 'notice', 0, 0, '2020-12-21 01:20:01', 'admin'),
(105, 'notice', 0, 0, '2020-12-21 01:20:03', 'admin'),
(106, 'notice', 0, 0, '2020-12-21 01:20:04', 'admin'),
(107, 'notice', 0, 0, '2020-12-21 01:20:09', 'admin'),
(108, 'notice', 0, 0, '2020-12-21 01:20:23', 'admin'),
(109, 'notice', 0, 0, '2020-12-21 01:20:41', 'admin'),
(110, 'notice', 0, 0, '2020-12-21 01:21:16', 'admin'),
(111, 'notice', 0, 0, '2020-12-21 01:26:30', 'admin'),
(112, 'notice', 0, 0, '2020-12-21 01:26:55', 'admin'),
(113, 'notice', 0, 0, '2020-12-21 01:27:01', 'admin'),
(114, 'notice', 0, 0, '2020-12-28 14:52:43', 'admin'),
(115, 'notice', 0, 0, '2020-12-28 14:55:39', 'admin'),
(116, 'notice', 0, 0, '2020-12-28 15:01:45', 'admin'),
(117, 'notice', 0, 0, '2020-12-28 15:01:55', 'admin'),
(118, 'notice', 0, 0, '2020-12-28 15:03:50', 'admin'),
(119, 'notice', 0, 0, '2020-12-28 15:04:05', 'admin'),
(120, 'notice', 0, 0, '2020-12-28 15:04:21', 'admin'),
(121, 'notice', 0, 0, '2020-12-28 15:05:34', 'admin'),
(122, 'notice', 0, 0, '2020-12-28 15:06:37', 'admin'),
(123, 'notice', 0, 0, '2020-12-28 15:07:03', 'admin'),
(124, 'notice', 0, 0, '2020-12-28 15:07:28', 'admin'),
(125, 'notice', 0, 0, '2020-12-28 15:11:33', 'admin'),
(126, 'notice', 0, 0, '2020-12-28 15:13:31', 'admin'),
(127, 'notice', 0, 0, '2020-12-28 15:18:49', 'admin'),
(128, 'notice', 0, 0, '2020-12-28 15:18:53', 'admin'),
(129, 'notice', 0, 0, '2020-12-28 15:19:21', 'admin'),
(130, 'notice', 0, 0, '2020-12-28 15:19:23', 'admin'),
(131, 'notice', 0, 0, '2020-12-28 15:19:31', 'admin'),
(132, 'notice', 0, 0, '2020-12-28 15:19:34', 'admin'),
(133, 'notice', 0, 0, '2020-12-28 15:33:39', 'admin'),
(134, 'notice', 0, 0, '2020-12-28 15:34:01', 'admin'),
(135, 'notice', 0, 0, '2020-12-28 15:34:22', 'admin'),
(136, 'notice', 50, 50, '2020-12-28 15:36:01', 'admin'),
(137, 'notice', 51, 51, '2020-12-28 15:38:50', 'admin'),
(138, 'business', 0, 0, '2020-12-28 16:10:04', 'admin'),
(139, 'business', 0, 0, '2020-12-28 16:12:48', 'admin'),
(140, 'business', 88, 88, '2020-12-28 16:15:00', 'admin'),
(141, 'business', 89, 89, '2020-12-28 16:16:13', 'admin'),
(142, 'business', 90, 90, '2020-12-28 16:21:16', 'admin'),
(143, 'business', 91, 91, '2020-12-28 16:21:30', 'admin'),
(144, 'business', 92, 92, '2020-12-28 16:22:24', 'admin'),
(145, 'business', 93, 93, '2020-12-28 16:30:41', 'admin'),
(146, 'notice', 52, 52, '2020-12-28 19:00:29', 'admin'),
(147, 'business', 94, 94, '2021-01-05 11:35:40', 'admin'),
(148, 'notice', 53, 53, '2021-01-05 14:20:00', 'admin'),
(149, 'business', 95, 95, '2021-01-05 14:49:06', 'admin');

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_business_propos`
--

CREATE TABLE `g5_business_propos` (
  `idx` int(11) NOT NULL COMMENT '순서',
  `bo_title_idx` int(255) NOT NULL COMMENT '지원사업 제목',
  `bo_idx` int(255) NOT NULL COMMENT '지원사업 순서',
  `mb_id` varchar(256) NOT NULL COMMENT '유저 아이디',
  `info_number` int(255) NOT NULL COMMENT '접수번호',
  `quest_number` int(255) NOT NULL COMMENT '과제번호',
  `ko_title` varchar(256) NOT NULL COMMENT '과제명(국문)',
  `en_title` varchar(256) NOT NULL COMMENT '과제명(영문)',
  `name` varchar(256) NOT NULL COMMENT '이름',
  `degree` varchar(256) NOT NULL COMMENT '전공(학위)',
  `belong` varchar(256) NOT NULL COMMENT '소속',
  `rank` varchar(256) NOT NULL COMMENT '직급',
  `email` varchar(256) NOT NULL COMMENT '이메일',
  `phone` int(255) NOT NULL COMMENT '전화번호',
  `main_member` int(255) NOT NULL COMMENT '공동연구원 수',
  `sub_member` int(255) NOT NULL COMMENT '연구보조원 수',
  `bf_datetime` date NOT NULL COMMENT '총 연구일',
  `date_start` date NOT NULL COMMENT '연구 시작일',
  `date_end` date NOT NULL COMMENT '연구 끝나는 일',
  `money` int(255) NOT NULL COMMENT '연구비 신청액',
  `one_year` int(255) NOT NULL COMMENT '1차년 연구비',
  `two_year` int(255) NOT NULL COMMENT '2차년 연구비',
  `file` int(255) NOT NULL COMMENT '파일 수',
  `wr_hit` int(255) NOT NULL COMMENT '뷰',
  `report_val_1` int(255) NOT NULL DEFAULT '0' COMMENT '중간 보고서 제출 현황',
  `report_val_2` int(255) NOT NULL DEFAULT '0' COMMENT '결과 보고서 제출 현황',
  `value` int(255) DEFAULT NULL COMMENT '지원사업 신청 결과'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `g5_business_propos`
--

INSERT INTO `g5_business_propos` (`idx`, `bo_title_idx`, `bo_idx`, `mb_id`, `info_number`, `quest_number`, `ko_title`, `en_title`, `name`, `degree`, `belong`, `rank`, `email`, `phone`, `main_member`, `sub_member`, `bf_datetime`, `date_start`, `date_end`, `money`, `one_year`, `two_year`, `file`, `wr_hit`, `report_val_1`, `report_val_2`, `value`) VALUES
(75, 1, 94, 'admin', 1, 1, '한국 과제명', '영문 과제명', '최고관리자', '사업기획', '라온스토리', '사원', 'admin@domain.com', 1057630034, 5, 2, '2021-01-05', '2021-10-12', '2022-01-19', 0, 100000, 90000000, 0, 0, 2, 0, 4),
(76, 1, 94, 'qwerqwer', 123, 123, 'sdfasfa', 'asdffd', 'qwer', '학사', '라온', '교수', 'qwerqwerqwer@qwerqwer.qwer', 1012345678, 12, 10, '2021-01-05', '2021-01-06', '2021-01-14', 0, 100000, 11111, 0, 0, 0, 0, 4),
(78, 1, 95, 'admin', 0, 1231321, 'rfdfsaf', 'dsafdsafs', '', '', '', '', '', 0, 0, 0, '2021-01-05', '0000-00-00', '0000-00-00', 1231231231, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_business_title`
--

CREATE TABLE `g5_business_title` (
  `idx` int(11) NOT NULL,
  `title` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_cert_history`
--

CREATE TABLE `g5_cert_history` (
  `cr_id` int(11) NOT NULL,
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `cr_company` varchar(255) NOT NULL DEFAULT '',
  `cr_method` varchar(255) NOT NULL DEFAULT '',
  `cr_ip` varchar(255) NOT NULL DEFAULT '',
  `cr_date` date NOT NULL DEFAULT '0000-00-00',
  `cr_time` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_config`
--

CREATE TABLE `g5_config` (
  `cf_title` varchar(255) NOT NULL DEFAULT '',
  `cf_theme` varchar(100) NOT NULL DEFAULT '',
  `cf_admin` varchar(100) NOT NULL DEFAULT '',
  `cf_admin_email` varchar(100) NOT NULL DEFAULT '',
  `cf_admin_email_name` varchar(100) NOT NULL DEFAULT '',
  `cf_add_script` text NOT NULL,
  `cf_use_point` tinyint(4) NOT NULL DEFAULT '0',
  `cf_point_term` int(11) NOT NULL DEFAULT '0',
  `cf_use_copy_log` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_email_certify` tinyint(4) NOT NULL DEFAULT '0',
  `cf_login_point` int(11) NOT NULL DEFAULT '0',
  `cf_cut_name` tinyint(4) NOT NULL DEFAULT '0',
  `cf_nick_modify` int(11) NOT NULL DEFAULT '0',
  `cf_new_skin` varchar(50) NOT NULL DEFAULT '',
  `cf_new_rows` int(11) NOT NULL DEFAULT '0',
  `cf_search_skin` varchar(50) NOT NULL DEFAULT '',
  `cf_connect_skin` varchar(50) NOT NULL DEFAULT '',
  `cf_faq_skin` varchar(50) NOT NULL DEFAULT '',
  `cf_read_point` int(11) NOT NULL DEFAULT '0',
  `cf_write_point` int(11) NOT NULL DEFAULT '0',
  `cf_comment_point` int(11) NOT NULL DEFAULT '0',
  `cf_download_point` int(11) NOT NULL DEFAULT '0',
  `cf_write_pages` int(11) NOT NULL DEFAULT '0',
  `cf_mobile_pages` int(11) NOT NULL DEFAULT '0',
  `cf_link_target` varchar(50) NOT NULL DEFAULT '',
  `cf_bbs_rewrite` tinyint(4) NOT NULL DEFAULT '0',
  `cf_delay_sec` int(11) NOT NULL DEFAULT '0',
  `cf_filter` text NOT NULL,
  `cf_possible_ip` text NOT NULL,
  `cf_intercept_ip` text NOT NULL,
  `cf_analytics` text NOT NULL,
  `cf_add_meta` text NOT NULL,
  `cf_member_skin` varchar(50) NOT NULL DEFAULT '',
  `cf_use_homepage` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_homepage` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_tel` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_tel` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_hp` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_hp` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_addr` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_addr` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_signature` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_signature` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_profile` tinyint(4) NOT NULL DEFAULT '0',
  `cf_req_profile` tinyint(4) NOT NULL DEFAULT '0',
  `cf_register_level` tinyint(4) NOT NULL DEFAULT '0',
  `cf_register_point` int(11) NOT NULL DEFAULT '0',
  `cf_icon_level` tinyint(4) NOT NULL DEFAULT '0',
  `cf_use_recommend` tinyint(4) NOT NULL DEFAULT '0',
  `cf_recommend_point` int(11) NOT NULL DEFAULT '0',
  `cf_leave_day` int(11) NOT NULL DEFAULT '0',
  `cf_search_part` int(11) NOT NULL DEFAULT '0',
  `cf_email_use` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_wr_super_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_wr_group_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_wr_board_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_wr_write` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_wr_comment_all` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_mb_super_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_mb_member` tinyint(4) NOT NULL DEFAULT '0',
  `cf_email_po_super_admin` tinyint(4) NOT NULL DEFAULT '0',
  `cf_prohibit_id` text NOT NULL,
  `cf_prohibit_email` text NOT NULL,
  `cf_new_del` int(11) NOT NULL DEFAULT '0',
  `cf_memo_del` int(11) NOT NULL DEFAULT '0',
  `cf_visit_del` int(11) NOT NULL DEFAULT '0',
  `cf_popular_del` int(11) NOT NULL DEFAULT '0',
  `cf_optimize_date` date NOT NULL DEFAULT '0000-00-00',
  `cf_use_member_icon` tinyint(4) NOT NULL DEFAULT '0',
  `cf_member_icon_size` int(11) NOT NULL DEFAULT '0',
  `cf_member_icon_width` int(11) NOT NULL DEFAULT '0',
  `cf_member_icon_height` int(11) NOT NULL DEFAULT '0',
  `cf_member_img_size` int(11) NOT NULL DEFAULT '0',
  `cf_member_img_width` int(11) NOT NULL DEFAULT '0',
  `cf_member_img_height` int(11) NOT NULL DEFAULT '0',
  `cf_login_minutes` int(11) NOT NULL DEFAULT '0',
  `cf_image_extension` varchar(255) NOT NULL DEFAULT '',
  `cf_flash_extension` varchar(255) NOT NULL DEFAULT '',
  `cf_movie_extension` varchar(255) NOT NULL DEFAULT '',
  `cf_formmail_is_member` tinyint(4) NOT NULL DEFAULT '0',
  `cf_page_rows` int(11) NOT NULL DEFAULT '0',
  `cf_mobile_page_rows` int(11) NOT NULL DEFAULT '0',
  `cf_visit` varchar(255) NOT NULL DEFAULT '',
  `cf_max_po_id` int(11) NOT NULL DEFAULT '0',
  `cf_stipulation` text NOT NULL,
  `cf_privacy` text NOT NULL,
  `cf_open_modify` int(11) NOT NULL DEFAULT '0',
  `cf_memo_send_point` int(11) NOT NULL DEFAULT '0',
  `cf_mobile_new_skin` varchar(50) NOT NULL DEFAULT '',
  `cf_mobile_search_skin` varchar(50) NOT NULL DEFAULT '',
  `cf_mobile_connect_skin` varchar(50) NOT NULL DEFAULT '',
  `cf_mobile_faq_skin` varchar(50) NOT NULL DEFAULT '',
  `cf_mobile_member_skin` varchar(50) NOT NULL DEFAULT '',
  `cf_captcha_mp3` varchar(255) NOT NULL DEFAULT '',
  `cf_editor` varchar(50) NOT NULL DEFAULT '',
  `cf_cert_use` tinyint(4) NOT NULL DEFAULT '0',
  `cf_cert_ipin` varchar(255) NOT NULL DEFAULT '',
  `cf_cert_hp` varchar(255) NOT NULL DEFAULT '',
  `cf_cert_kcb_cd` varchar(255) NOT NULL DEFAULT '',
  `cf_cert_kcp_cd` varchar(255) NOT NULL DEFAULT '',
  `cf_lg_mid` varchar(100) NOT NULL DEFAULT '',
  `cf_lg_mert_key` varchar(100) NOT NULL DEFAULT '',
  `cf_cert_limit` int(11) NOT NULL DEFAULT '0',
  `cf_cert_req` tinyint(4) NOT NULL DEFAULT '0',
  `cf_sms_use` varchar(255) NOT NULL DEFAULT '',
  `cf_sms_type` varchar(10) NOT NULL DEFAULT '',
  `cf_icode_id` varchar(255) NOT NULL DEFAULT '',
  `cf_icode_pw` varchar(255) NOT NULL DEFAULT '',
  `cf_icode_server_ip` varchar(50) NOT NULL DEFAULT '',
  `cf_icode_server_port` varchar(50) NOT NULL DEFAULT '',
  `cf_googl_shorturl_apikey` varchar(50) NOT NULL DEFAULT '',
  `cf_social_login_use` tinyint(4) NOT NULL DEFAULT '0',
  `cf_social_servicelist` varchar(255) NOT NULL DEFAULT '',
  `cf_payco_clientid` varchar(100) NOT NULL DEFAULT '',
  `cf_payco_secret` varchar(100) NOT NULL DEFAULT '',
  `cf_facebook_appid` varchar(100) NOT NULL,
  `cf_facebook_secret` varchar(100) NOT NULL,
  `cf_twitter_key` varchar(100) NOT NULL,
  `cf_twitter_secret` varchar(100) NOT NULL,
  `cf_google_clientid` varchar(100) NOT NULL DEFAULT '',
  `cf_google_secret` varchar(100) NOT NULL DEFAULT '',
  `cf_naver_clientid` varchar(100) NOT NULL DEFAULT '',
  `cf_naver_secret` varchar(100) NOT NULL DEFAULT '',
  `cf_kakao_rest_key` varchar(100) NOT NULL DEFAULT '',
  `cf_kakao_client_secret` varchar(100) NOT NULL DEFAULT '',
  `cf_kakao_js_apikey` varchar(100) NOT NULL,
  `cf_captcha` varchar(100) NOT NULL DEFAULT '',
  `cf_recaptcha_site_key` varchar(100) NOT NULL DEFAULT '',
  `cf_recaptcha_secret_key` varchar(100) NOT NULL DEFAULT '',
  `cf_1_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_2_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_3_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_4_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_5_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_6_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_7_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_8_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_9_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_10_subj` varchar(255) NOT NULL DEFAULT '',
  `cf_1` varchar(255) NOT NULL DEFAULT '',
  `cf_2` varchar(255) NOT NULL DEFAULT '',
  `cf_3` varchar(255) NOT NULL DEFAULT '',
  `cf_4` varchar(255) NOT NULL DEFAULT '',
  `cf_5` varchar(255) NOT NULL DEFAULT '',
  `cf_6` varchar(255) NOT NULL DEFAULT '',
  `cf_7` varchar(255) NOT NULL DEFAULT '',
  `cf_8` varchar(255) NOT NULL DEFAULT '',
  `cf_9` varchar(255) NOT NULL DEFAULT '',
  `cf_10` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `g5_config`
--

INSERT INTO `g5_config` (`cf_title`, `cf_theme`, `cf_admin`, `cf_admin_email`, `cf_admin_email_name`, `cf_add_script`, `cf_use_point`, `cf_point_term`, `cf_use_copy_log`, `cf_use_email_certify`, `cf_login_point`, `cf_cut_name`, `cf_nick_modify`, `cf_new_skin`, `cf_new_rows`, `cf_search_skin`, `cf_connect_skin`, `cf_faq_skin`, `cf_read_point`, `cf_write_point`, `cf_comment_point`, `cf_download_point`, `cf_write_pages`, `cf_mobile_pages`, `cf_link_target`, `cf_bbs_rewrite`, `cf_delay_sec`, `cf_filter`, `cf_possible_ip`, `cf_intercept_ip`, `cf_analytics`, `cf_add_meta`, `cf_member_skin`, `cf_use_homepage`, `cf_req_homepage`, `cf_use_tel`, `cf_req_tel`, `cf_use_hp`, `cf_req_hp`, `cf_use_addr`, `cf_req_addr`, `cf_use_signature`, `cf_req_signature`, `cf_use_profile`, `cf_req_profile`, `cf_register_level`, `cf_register_point`, `cf_icon_level`, `cf_use_recommend`, `cf_recommend_point`, `cf_leave_day`, `cf_search_part`, `cf_email_use`, `cf_email_wr_super_admin`, `cf_email_wr_group_admin`, `cf_email_wr_board_admin`, `cf_email_wr_write`, `cf_email_wr_comment_all`, `cf_email_mb_super_admin`, `cf_email_mb_member`, `cf_email_po_super_admin`, `cf_prohibit_id`, `cf_prohibit_email`, `cf_new_del`, `cf_memo_del`, `cf_visit_del`, `cf_popular_del`, `cf_optimize_date`, `cf_use_member_icon`, `cf_member_icon_size`, `cf_member_icon_width`, `cf_member_icon_height`, `cf_member_img_size`, `cf_member_img_width`, `cf_member_img_height`, `cf_login_minutes`, `cf_image_extension`, `cf_flash_extension`, `cf_movie_extension`, `cf_formmail_is_member`, `cf_page_rows`, `cf_mobile_page_rows`, `cf_visit`, `cf_max_po_id`, `cf_stipulation`, `cf_privacy`, `cf_open_modify`, `cf_memo_send_point`, `cf_mobile_new_skin`, `cf_mobile_search_skin`, `cf_mobile_connect_skin`, `cf_mobile_faq_skin`, `cf_mobile_member_skin`, `cf_captcha_mp3`, `cf_editor`, `cf_cert_use`, `cf_cert_ipin`, `cf_cert_hp`, `cf_cert_kcb_cd`, `cf_cert_kcp_cd`, `cf_lg_mid`, `cf_lg_mert_key`, `cf_cert_limit`, `cf_cert_req`, `cf_sms_use`, `cf_sms_type`, `cf_icode_id`, `cf_icode_pw`, `cf_icode_server_ip`, `cf_icode_server_port`, `cf_googl_shorturl_apikey`, `cf_social_login_use`, `cf_social_servicelist`, `cf_payco_clientid`, `cf_payco_secret`, `cf_facebook_appid`, `cf_facebook_secret`, `cf_twitter_key`, `cf_twitter_secret`, `cf_google_clientid`, `cf_google_secret`, `cf_naver_clientid`, `cf_naver_secret`, `cf_kakao_rest_key`, `cf_kakao_client_secret`, `cf_kakao_js_apikey`, `cf_captcha`, `cf_recaptcha_site_key`, `cf_recaptcha_secret_key`, `cf_1_subj`, `cf_2_subj`, `cf_3_subj`, `cf_4_subj`, `cf_5_subj`, `cf_6_subj`, `cf_7_subj`, `cf_8_subj`, `cf_9_subj`, `cf_10_subj`, `cf_1`, `cf_2`, `cf_3`, `cf_4`, `cf_5`, `cf_6`, `cf_7`, `cf_8`, `cf_9`, `cf_10`) VALUES
('그누보드5', 'basic', 'admin', 'admin@domain.com', '그누보드5', '', 1, 0, 1, 0, 100, 15, 60, 'basic', 15, 'basic', 'basic', 'basic', 0, 0, 0, 0, 10, 5, '_blank', 0, 30, '18아,18놈,18새끼,18뇬,18노,18것,18넘,개년,개놈,개뇬,개새,개색끼,개세끼,개세이,개쉐이,개쉑,개쉽,개시키,개자식,개좆,게색기,게색끼,광뇬,뇬,눈깔,뉘미럴,니귀미,니기미,니미,도촬,되질래,뒈져라,뒈진다,디져라,디진다,디질래,병쉰,병신,뻐큐,뻑큐,뽁큐,삐리넷,새꺄,쉬발,쉬밸,쉬팔,쉽알,스패킹,스팽,시벌,시부랄,시부럴,시부리,시불,시브랄,시팍,시팔,시펄,실밸,십8,십쌔,십창,싶알,쌉년,썅놈,쌔끼,쌩쑈,썅,써벌,썩을년,쎄꺄,쎄엑,쓰바,쓰발,쓰벌,쓰팔,씨8,씨댕,씨바,씨발,씨뱅,씨봉알,씨부랄,씨부럴,씨부렁,씨부리,씨불,씨브랄,씨빠,씨빨,씨뽀랄,씨팍,씨팔,씨펄,씹,아가리,아갈이,엄창,접년,잡놈,재랄,저주글,조까,조빠,조쟁이,조지냐,조진다,조질래,존나,존니,좀물,좁년,좃,좆,좇,쥐랄,쥐롤,쥬디,지랄,지럴,지롤,지미랄,쫍빱,凸,퍽큐,뻑큐,빠큐,ㅅㅂㄹㅁ', '', '', '', '', 'basic', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 1000, 2, 0, 0, 30, 10000, 1, 0, 0, 0, 0, 0, 0, 0, 0, 'admin,administrator,관리자,운영자,어드민,주인장,webmaster,웹마스터,sysop,시삽,시샵,manager,매니저,메니저,root,루트,su,guest,방문객', '', 30, 180, 180, 180, '2021-01-06', 2, 5000, 22, 22, 50000, 60, 60, 10, 'gif|jpg|jpeg|png', 'swf', 'asx|asf|wmv|wma|mpg|mpeg|mov|avi|mp3', 1, 15, 15, '오늘:1,어제:1,최대:2,전체:41', 0, '해당 홈페이지에 맞는 회원가입약관을 입력합니다.', '해당 홈페이지에 맞는 개인정보처리방침을 입력합니다.', 0, 500, 'basic', 'basic', 'basic', 'basic', 'basic', 'basic', 'smarteditor2', 0, '', '', '', '', '', '', 2, 0, '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_content`
--

CREATE TABLE `g5_content` (
  `co_id` varchar(20) NOT NULL DEFAULT '',
  `co_html` tinyint(4) NOT NULL DEFAULT '0',
  `co_subject` varchar(255) NOT NULL DEFAULT '',
  `co_content` longtext NOT NULL,
  `co_seo_title` varchar(255) NOT NULL DEFAULT '',
  `co_mobile_content` longtext NOT NULL,
  `co_skin` varchar(255) NOT NULL DEFAULT '',
  `co_mobile_skin` varchar(255) NOT NULL DEFAULT '',
  `co_tag_filter_use` tinyint(4) NOT NULL DEFAULT '0',
  `co_hit` int(11) NOT NULL DEFAULT '0',
  `co_include_head` varchar(255) NOT NULL,
  `co_include_tail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `g5_content`
--

INSERT INTO `g5_content` (`co_id`, `co_html`, `co_subject`, `co_content`, `co_seo_title`, `co_mobile_content`, `co_skin`, `co_mobile_skin`, `co_tag_filter_use`, `co_hit`, `co_include_head`, `co_include_tail`) VALUES
('company', 1, '회사소개', '<p align=center><b>회사소개에 대한 내용을 입력하십시오.</b></p>', '회사소개', '', '', '', 0, 0, '', ''),
('privacy', 1, '개인정보 처리방침', '<p align=center><b>개인정보 처리방침에 대한 내용을 입력하십시오.</b></p>', '개인정보-처리방침', '', '', '', 0, 0, '', ''),
('provision', 1, '서비스 이용약관', '<p align=center><b>서비스 이용약관에 대한 내용을 입력하십시오.</b></p>', '서비스-이용약관', '', '', '', 0, 0, '', '');

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_eyoom_activity`
--

CREATE TABLE `g5_eyoom_activity` (
  `act_id` mediumint(11) UNSIGNED NOT NULL,
  `mb_id` varchar(40) NOT NULL,
  `act_type` varchar(20) NOT NULL,
  `act_contents` text NOT NULL,
  `act_image` text NOT NULL,
  `act_regdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_eyoom_banner`
--

CREATE TABLE `g5_eyoom_banner` (
  `bn_no` int(10) UNSIGNED NOT NULL,
  `bn_code` varchar(20) NOT NULL,
  `bn_type` enum('intra','extra') NOT NULL DEFAULT 'intra',
  `bn_subject` varchar(255) NOT NULL DEFAULT '0',
  `bn_link` text,
  `bn_img` varchar(100) NOT NULL DEFAULT '',
  `bn_target` varchar(20) NOT NULL DEFAULT '',
  `bn_script` text NOT NULL,
  `bn_sort` int(10) DEFAULT '0',
  `bn_theme` varchar(30) NOT NULL DEFAULT 'default',
  `bn_state` smallint(1) NOT NULL DEFAULT '0',
  `bn_period` char(1) NOT NULL DEFAULT '1',
  `bn_start` varchar(10) NOT NULL,
  `bn_end` varchar(10) NOT NULL,
  `bn_exposed` mediumint(10) NOT NULL DEFAULT '0',
  `bn_clicked` mediumint(10) NOT NULL DEFAULT '0',
  `bn_view_level` tinyint(4) NOT NULL DEFAULT '1',
  `bn_regdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_eyoom_board`
--

CREATE TABLE `g5_eyoom_board` (
  `bo_id` mediumint(11) UNSIGNED NOT NULL,
  `bo_table` varchar(20) NOT NULL,
  `gr_id` varchar(10) NOT NULL,
  `bo_theme` varchar(50) NOT NULL,
  `bo_skin` varchar(40) NOT NULL,
  `use_gnu_skin` enum('y','n') NOT NULL DEFAULT 'n',
  `use_shop_skin` enum('y','n') NOT NULL DEFAULT 'n',
  `bo_use_profile_photo` char(1) NOT NULL DEFAULT '1',
  `bo_sel_date_type` enum('1','2') NOT NULL DEFAULT '1',
  `bo_use_hotgul` char(1) NOT NULL DEFAULT '1',
  `bo_use_anonymous` char(1) NOT NULL DEFAULT '2',
  `bo_use_infinite_scroll` char(1) NOT NULL DEFAULT '2',
  `bo_use_cmt_infinite` char(1) NOT NULL DEFAULT '0',
  `bo_use_cmt_best` char(1) NOT NULL DEFAULT '0',
  `bo_use_point_explain` char(1) NOT NULL DEFAULT '1',
  `bo_use_video_photo` char(1) NOT NULL DEFAULT '2',
  `bo_use_list_image` char(1) NOT NULL DEFAULT '1',
  `bo_use_good_member` char(1) NOT NULL DEFAULT '1',
  `bo_use_nogood_member` char(1) NOT NULL DEFAULT '0',
  `bo_use_yellow_card` char(1) NOT NULL DEFAULT '0',
  `bo_use_exif` char(1) NOT NULL DEFAULT '0',
  `bo_use_rating` char(1) NOT NULL DEFAULT '2',
  `bo_use_rating_list` char(1) NOT NULL DEFAULT '1',
  `bo_use_rating_member` char(1) NOT NULL DEFAULT '0',
  `bo_use_rating_score` char(1) NOT NULL DEFAULT '0',
  `bo_use_rating_comment` char(1) NOT NULL DEFAULT '0',
  `bo_rating_point` int(11) NOT NULL DEFAULT '0',
  `bo_use_tag` char(1) NOT NULL DEFAULT '0',
  `bo_use_automove` char(1) NOT NULL DEFAULT '0',
  `bo_use_summernote_mo` char(1) NOT NULL DEFAULT '1',
  `bo_use_addon_emoticon` char(1) NOT NULL DEFAULT '1',
  `bo_use_addon_video` char(1) NOT NULL DEFAULT '1',
  `bo_use_addon_coding` char(1) NOT NULL DEFAULT '0',
  `bo_use_addon_soundcloud` char(1) NOT NULL DEFAULT '0',
  `bo_use_addon_map` char(1) NOT NULL DEFAULT '0',
  `bo_use_addon_cmtfile` char(1) NOT NULL DEFAULT '1',
  `bo_use_extimg` char(1) NOT NULL DEFAULT '0',
  `bo_use_adopt_point` char(1) NOT NULL DEFAULT '0',
  `bo_adopt_minpoint` int(7) NOT NULL DEFAULT '0',
  `bo_adopt_maxpoint` int(11) NOT NULL DEFAULT '0',
  `bo_adopt_ratio` smallint(3) NOT NULL DEFAULT '0',
  `bo_write_limit` smallint(3) NOT NULL DEFAULT '0',
  `bo_cmt_best_min` tinyint(2) NOT NULL DEFAULT '10',
  `bo_cmt_best_limit` tinyint(2) NOT NULL DEFAULT '5',
  `bo_tag_level` tinyint(4) NOT NULL DEFAULT '2',
  `bo_tag_limit` tinyint(4) NOT NULL DEFAULT '10',
  `bo_automove` varchar(255) NOT NULL,
  `bo_exif_detail` text NOT NULL,
  `bo_blind_limit` tinyint(2) NOT NULL DEFAULT '5',
  `bo_blind_view` tinyint(2) NOT NULL DEFAULT '10',
  `bo_blind_direct` tinyint(2) NOT NULL DEFAULT '10',
  `bo_cmtpoint_target` char(1) NOT NULL DEFAULT '1',
  `bo_firstcmt_point` int(7) NOT NULL DEFAULT '0',
  `bo_firstcmt_point_type` char(1) NOT NULL DEFAULT '1',
  `bo_bomb_point` int(7) NOT NULL DEFAULT '0',
  `bo_bomb_point_type` char(1) NOT NULL DEFAULT '1',
  `bo_bomb_point_limit` int(3) NOT NULL DEFAULT '10',
  `bo_bomb_point_cnt` int(2) NOT NULL DEFAULT '1',
  `bo_lucky_point` int(7) NOT NULL DEFAULT '0',
  `bo_lucky_point_type` char(1) NOT NULL DEFAULT '1',
  `bo_lucky_point_ratio` int(2) NOT NULL DEFAULT '1',
  `download_fee_ratio` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_eyoom_contents`
--

CREATE TABLE `g5_eyoom_contents` (
  `ec_no` int(10) UNSIGNED NOT NULL,
  `ec_code` text NOT NULL,
  `me_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `me_code` varchar(255) NOT NULL DEFAULT '',
  `ec_name` varchar(255) NOT NULL DEFAULT '',
  `ec_subject` text NOT NULL,
  `ec_text` text NOT NULL,
  `ec_theme` varchar(30) NOT NULL DEFAULT 'eb4_basic',
  `ec_skin` varchar(50) NOT NULL DEFAULT 'basic',
  `ec_state` smallint(1) NOT NULL DEFAULT '0',
  `ec_link` varchar(255) NOT NULL,
  `ec_target` varchar(10) NOT NULL,
  `ec_image` varchar(255) NOT NULL,
  `ec_file` varchar(255) NOT NULL,
  `ec_filename` varchar(255) NOT NULL,
  `ec_sort` smallint(3) NOT NULL DEFAULT '0',
  `ec_link_cnt` smallint(2) NOT NULL DEFAULT '2',
  `ec_image_cnt` smallint(2) NOT NULL DEFAULT '5',
  `ec_ext_cnt` smallint(2) NOT NULL DEFAULT '5',
  `ec_regdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_eyoom_contents_item`
--

CREATE TABLE `g5_eyoom_contents_item` (
  `ci_no` int(10) UNSIGNED NOT NULL,
  `ec_code` text NOT NULL,
  `ci_theme` varchar(30) NOT NULL DEFAULT 'eb4_basic',
  `ci_state` char(1) NOT NULL DEFAULT '2',
  `ci_sort` int(10) DEFAULT '0',
  `ci_subject` text NOT NULL,
  `ci_text` text NOT NULL,
  `ci_content` text NOT NULL,
  `ci_link` text NOT NULL,
  `ci_target` text NOT NULL,
  `ci_img` text NOT NULL,
  `ci_period` char(1) NOT NULL DEFAULT '1',
  `ci_start` varchar(10) NOT NULL,
  `ci_end` varchar(10) NOT NULL,
  `ci_view_level` tinyint(4) NOT NULL DEFAULT '1',
  `ci_regdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_eyoom_exboard`
--

CREATE TABLE `g5_eyoom_exboard` (
  `ex_no` int(11) UNSIGNED NOT NULL,
  `bo_table` varchar(20) NOT NULL,
  `ex_fname` varchar(10) NOT NULL,
  `ex_subject` varchar(50) NOT NULL,
  `ex_use_search` enum('y','n') NOT NULL DEFAULT 'n',
  `ex_required` enum('y','n') NOT NULL DEFAULT 'n',
  `ex_form` varchar(20) NOT NULL DEFAULT 'text',
  `ex_type` varchar(20) NOT NULL,
  `ex_length` mediumint(5) NOT NULL,
  `ex_default` varchar(255) NOT NULL,
  `ex_item_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_eyoom_follow`
--

CREATE TABLE `g5_eyoom_follow` (
  `fo_no` int(11) UNSIGNED NOT NULL,
  `fo_my_id` varchar(30) NOT NULL,
  `fo_mb_id` varchar(30) NOT NULL,
  `fo_friends` enum('y','n') NOT NULL DEFAULT 'n',
  `fo_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_eyoom_goods`
--

CREATE TABLE `g5_eyoom_goods` (
  `eg_no` int(10) UNSIGNED NOT NULL,
  `eg_code` varchar(20) NOT NULL,
  `eg_subject` varchar(255) NOT NULL,
  `eg_theme` varchar(30) NOT NULL DEFAULT 'eb4_basic',
  `eg_skin` varchar(50) NOT NULL DEFAULT 'basic',
  `eg_state` smallint(1) NOT NULL DEFAULT '0',
  `eg_link` varchar(255) NOT NULL,
  `eg_target` varchar(10) NOT NULL,
  `eg_regdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_eyoom_goods_item`
--

CREATE TABLE `g5_eyoom_goods_item` (
  `gi_no` int(10) UNSIGNED NOT NULL,
  `eg_code` varchar(20) NOT NULL,
  `gi_theme` varchar(30) NOT NULL DEFAULT '',
  `gi_state` char(1) NOT NULL DEFAULT '2',
  `gi_sort` int(10) DEFAULT '0',
  `gi_title` varchar(255) NOT NULL,
  `gi_link` varchar(255) NOT NULL,
  `gi_target` varchar(10) NOT NULL,
  `gi_ca_id` varchar(20) NOT NULL DEFAULT '',
  `gi_ca_ids` varchar(255) NOT NULL DEFAULT '',
  `gi_exclude` varchar(255) NOT NULL DEFAULT '',
  `gi_include` varchar(255) NOT NULL DEFAULT '',
  `gi_count` smallint(2) NOT NULL DEFAULT '5',
  `gi_sortby` smallint(2) NOT NULL DEFAULT '1',
  `gi_view_it_id` char(1) NOT NULL DEFAULT 'y',
  `gi_view_it_name` char(1) NOT NULL DEFAULT 'y',
  `gi_view_it_basic` char(1) NOT NULL DEFAULT 'y',
  `gi_view_it_cust_price` char(1) NOT NULL DEFAULT 'y',
  `gi_view_it_price` char(1) NOT NULL DEFAULT 'y',
  `gi_view_it_icon` char(1) NOT NULL DEFAULT 'y',
  `gi_view_img` char(1) NOT NULL DEFAULT 'y',
  `gi_view_sns` char(1) NOT NULL DEFAULT 'y',
  `gi_img_width` smallint(3) NOT NULL DEFAULT '300',
  `gi_img_height` smallint(3) NOT NULL DEFAULT '0',
  `gi_view_level` tinyint(4) NOT NULL DEFAULT '1',
  `gi_regdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_eyoom_latest`
--

CREATE TABLE `g5_eyoom_latest` (
  `el_no` int(10) UNSIGNED NOT NULL,
  `el_code` varchar(20) NOT NULL,
  `el_subject` varchar(255) NOT NULL,
  `el_theme` varchar(30) NOT NULL DEFAULT 'eb4_basic',
  `el_skin` varchar(50) NOT NULL DEFAULT 'basic',
  `el_state` smallint(1) NOT NULL DEFAULT '0',
  `el_cache` int(10) NOT NULL DEFAULT '0',
  `el_new` mediumint(3) NOT NULL DEFAULT '0',
  `el_link` varchar(255) NOT NULL,
  `el_target` varchar(10) NOT NULL,
  `el_regdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `g5_eyoom_latest`
--

INSERT INTO `g5_eyoom_latest` (`el_no`, `el_code`, `el_subject`, `el_theme`, `el_skin`, `el_state`, `el_cache`, `el_new`, `el_link`, `el_target`, `el_regdt`) VALUES
(1, '1517122147', '인기게시물', 'eb4_basic', 'bestset', 1, 0, 24, '', '', '2020-11-18 11:13:05'),
(2, '1518393947', '베이직 그룹', 'eb4_basic', 'basic', 1, 120, 24, '', '', '2020-11-18 11:13:05'),
(3, '1518503581', '갤러리 그룹', 'eb4_basic', 'gallery', 1, 0, 24, '', '', '2020-11-18 11:13:05'),
(4, '1519114252', '웹진 그룹', 'eb4_basic', 'webzine', 1, 0, 24, '', '', '2020-11-18 11:13:05'),
(5, '1519177106', '새글', 'eb4_basic', 'newpost', 1, 0, 24, '', '', '2020-11-18 11:13:05'),
(6, '1520320186', '공지사항 사이드', 'eb4_basic', 'notice_roll_side', 1, 0, 24, '', '', '2020-11-18 11:13:05'),
(7, '1520321978', '공지사항 헤더', 'eb4_basic', 'notice_roll_header', 1, 0, 24, '', '', '2020-11-18 11:13:05'),
(8, '1526255599', '공지사항 쇼핑몰', 'eb4_basic', 'notice_roll_shop', 1, 0, 24, '', '', '2020-11-18 11:13:05');

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_eyoom_latest_item`
--

CREATE TABLE `g5_eyoom_latest_item` (
  `li_no` int(10) UNSIGNED NOT NULL,
  `el_code` varchar(20) NOT NULL,
  `li_theme` varchar(30) NOT NULL DEFAULT '',
  `li_state` char(1) NOT NULL DEFAULT '2',
  `li_sort` int(10) DEFAULT '0',
  `li_title` varchar(255) NOT NULL,
  `li_link` varchar(255) NOT NULL,
  `li_target` varchar(10) NOT NULL,
  `li_bo_table` varchar(20) NOT NULL DEFAULT '',
  `li_gr_id` varchar(20) NOT NULL DEFAULT '',
  `li_exclude` varchar(255) NOT NULL DEFAULT '',
  `li_include` varchar(255) NOT NULL DEFAULT '',
  `li_tables` text NOT NULL,
  `li_direct` char(1) NOT NULL DEFAULT 'n',
  `li_count` smallint(2) NOT NULL DEFAULT '5',
  `li_depart` smallint(1) NOT NULL DEFAULT '2',
  `li_period` smallint(2) NOT NULL DEFAULT '0',
  `li_type` char(2) NOT NULL,
  `li_ca_view` char(1) NOT NULL DEFAULT 'n',
  `li_cut_subject` smallint(2) NOT NULL DEFAULT '50',
  `li_best` char(1) NOT NULL DEFAULT 'n',
  `li_random` char(1) NOT NULL DEFAULT 'n',
  `li_img_view` char(1) NOT NULL DEFAULT 'n',
  `li_img_width` smallint(3) NOT NULL DEFAULT '300',
  `li_img_height` smallint(3) NOT NULL DEFAULT '300',
  `li_content` char(1) NOT NULL DEFAULT 'n',
  `li_cut_content` smallint(3) NOT NULL DEFAULT '100',
  `li_bo_subject` char(1) NOT NULL DEFAULT 'n',
  `li_mbname_view` char(1) NOT NULL DEFAULT 'y',
  `li_photo` char(1) NOT NULL DEFAULT 'n',
  `li_use_date` char(1) NOT NULL DEFAULT 'y',
  `li_date_type` char(1) NOT NULL DEFAULT '1',
  `li_date_kind` varchar(20) NOT NULL,
  `li_view_level` tinyint(4) NOT NULL DEFAULT '1',
  `li_regdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_eyoom_like`
--

CREATE TABLE `g5_eyoom_like` (
  `lk_no` int(11) UNSIGNED NOT NULL,
  `lk_my_id` varchar(30) NOT NULL,
  `lk_mb_id` varchar(30) NOT NULL,
  `lk_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_eyoom_link`
--

CREATE TABLE `g5_eyoom_link` (
  `s_no` int(11) UNSIGNED NOT NULL,
  `bo_table` varchar(20) NOT NULL,
  `wr_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `theme` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_eyoom_member`
--

CREATE TABLE `g5_eyoom_member` (
  `mb_id` varchar(30) NOT NULL,
  `level` mediumint(5) NOT NULL DEFAULT '1',
  `level_point` mediumint(11) NOT NULL DEFAULT '0',
  `photo` varchar(100) NOT NULL,
  `myhome_cover` varchar(100) NOT NULL,
  `myhome_hit` mediumint(11) NOT NULL DEFAULT '0',
  `open_page` enum('y','n') NOT NULL DEFAULT 'y',
  `respond` mediumint(5) NOT NULL DEFAULT '0',
  `onoff_push` enum('on','off') NOT NULL DEFAULT 'on',
  `onoff_push_respond` enum('on','off') NOT NULL DEFAULT 'on',
  `onoff_push_memo` enum('on','off') NOT NULL DEFAULT 'on',
  `onoff_push_social` enum('on','off') NOT NULL DEFAULT 'on',
  `onoff_push_likes` enum('on','off') NOT NULL DEFAULT 'on',
  `onoff_push_guest` enum('on','off') NOT NULL DEFAULT 'on',
  `onoff_social` enum('on','off') NOT NULL DEFAULT 'on',
  `open_email` enum('y','n') NOT NULL DEFAULT 'y',
  `open_homepage` enum('y','n') NOT NULL DEFAULT 'y',
  `open_tel` enum('y','n') NOT NULL DEFAULT 'y',
  `open_hp` enum('y','n') NOT NULL DEFAULT 'y',
  `view_timeline` char(1) NOT NULL DEFAULT '1',
  `view_favorite` char(1) NOT NULL DEFAULT '1',
  `view_followinggul` char(1) NOT NULL DEFAULT '1',
  `favorite` text NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_eyoom_menu`
--

CREATE TABLE `g5_eyoom_menu` (
  `me_id` int(11) NOT NULL,
  `me_theme` varchar(20) NOT NULL,
  `me_code` varchar(255) NOT NULL DEFAULT '',
  `me_name` varchar(255) NOT NULL DEFAULT '',
  `me_icon` varchar(100) NOT NULL,
  `me_shop` char(1) NOT NULL DEFAULT '2',
  `me_path` varchar(255) NOT NULL,
  `me_type` varchar(30) NOT NULL,
  `me_pid` varchar(40) NOT NULL,
  `me_sca` varchar(50) NOT NULL,
  `me_link` varchar(255) NOT NULL DEFAULT '',
  `me_target` varchar(255) NOT NULL DEFAULT '',
  `me_order` int(11) NOT NULL DEFAULT '0',
  `me_permit_level` tinyint(4) NOT NULL DEFAULT '1',
  `me_side` enum('y','n') NOT NULL DEFAULT 'y',
  `me_use` enum('y','n') NOT NULL DEFAULT 'y',
  `me_use_nav` enum('y','n') NOT NULL DEFAULT 'y'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_eyoom_pin`
--

CREATE TABLE `g5_eyoom_pin` (
  `pn_no` int(11) UNSIGNED NOT NULL,
  `mb_id` varchar(30) NOT NULL,
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `wr_id` int(11) NOT NULL,
  `it_id` varchar(20) NOT NULL DEFAULT '',
  `pn_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_eyoom_rating`
--

CREATE TABLE `g5_eyoom_rating` (
  `rt_id` int(11) UNSIGNED NOT NULL,
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `wr_id` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `rating` smallint(2) NOT NULL DEFAULT '0',
  `comment` varchar(255) NOT NULL,
  `rt_good` int(11) NOT NULL DEFAULT '0',
  `rt_nogood` int(11) NOT NULL DEFAULT '0',
  `rt_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_eyoom_respond`
--

CREATE TABLE `g5_eyoom_respond` (
  `rid` int(11) NOT NULL,
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `pr_id` mediumint(11) NOT NULL,
  `wr_id` int(11) NOT NULL DEFAULT '0',
  `wr_cmt` int(11) NOT NULL DEFAULT '0',
  `wr_subject` varchar(255) NOT NULL DEFAULT '',
  `wr_mb_id` varchar(20) NOT NULL,
  `mb_id` varchar(20) NOT NULL,
  `mb_name` varchar(255) NOT NULL,
  `re_cnt` mediumint(3) NOT NULL DEFAULT '0',
  `re_type` varchar(20) NOT NULL,
  `re_chk` tinyint(4) NOT NULL DEFAULT '0',
  `regdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_eyoom_slider`
--

CREATE TABLE `g5_eyoom_slider` (
  `es_no` int(10) UNSIGNED NOT NULL,
  `es_code` varchar(255) NOT NULL,
  `es_subject` varchar(255) NOT NULL,
  `es_theme` varchar(30) NOT NULL DEFAULT 'eb4_basic',
  `es_skin` varchar(50) NOT NULL DEFAULT 'basic',
  `es_text` text NOT NULL,
  `es_ytplay` char(1) NOT NULL DEFAULT '1',
  `es_ytmauto` char(1) NOT NULL DEFAULT '2',
  `es_state` smallint(1) NOT NULL DEFAULT '0',
  `es_link` varchar(255) NOT NULL,
  `es_target` varchar(10) NOT NULL,
  `es_image` varchar(255) NOT NULL,
  `es_link_cnt` smallint(2) NOT NULL DEFAULT '2',
  `es_image_cnt` smallint(2) NOT NULL DEFAULT '3',
  `es_regdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `g5_eyoom_slider`
--

INSERT INTO `g5_eyoom_slider` (`es_no`, `es_code`, `es_subject`, `es_theme`, `es_skin`, `es_text`, `es_ytplay`, `es_ytmauto`, `es_state`, `es_link`, `es_target`, `es_image`, `es_link_cnt`, `es_image_cnt`, `es_regdt`) VALUES
(1, '1516512257', '메인 슬라이더', 'eb4_basic', 'basic', '', '1', '2', 1, 'eyoom.net', '_self', '', 2, 5, '2020-11-18 11:13:05'),
(2, '1526428620', '쇼핑몰 메인 슬라이더', 'eb4_basic', 'shop_basic', '', '1', '2', 1, '', '_self', '', 1, 1, '2020-11-18 11:13:05');

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_eyoom_slider_item`
--

CREATE TABLE `g5_eyoom_slider_item` (
  `ei_no` int(10) UNSIGNED NOT NULL,
  `es_code` varchar(255) NOT NULL,
  `ei_theme` varchar(50) NOT NULL DEFAULT '',
  `ei_state` char(1) NOT NULL DEFAULT '2',
  `ei_sort` int(10) DEFAULT '0',
  `ei_title` varchar(255) NOT NULL,
  `ei_subtitle` varchar(255) NOT NULL,
  `ei_text` text NOT NULL,
  `ei_link` text NOT NULL,
  `ei_target` text NOT NULL,
  `ei_img` text NOT NULL,
  `ei_period` char(1) NOT NULL DEFAULT '1',
  `ei_start` varchar(10) NOT NULL,
  `ei_end` varchar(10) NOT NULL,
  `ei_clicked` mediumint(10) NOT NULL DEFAULT '0',
  `ei_view_level` tinyint(4) NOT NULL DEFAULT '1',
  `ei_regdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_eyoom_slider_ytitem`
--

CREATE TABLE `g5_eyoom_slider_ytitem` (
  `ei_no` int(10) UNSIGNED NOT NULL,
  `es_code` text NOT NULL,
  `ei_theme` varchar(30) NOT NULL DEFAULT '',
  `ei_state` char(1) NOT NULL DEFAULT '2',
  `ei_sort` int(10) DEFAULT '0',
  `ei_ytcode` varchar(255) NOT NULL,
  `ei_quality` varchar(10) NOT NULL DEFAULT 'hd1080',
  `ei_remember` char(1) NOT NULL DEFAULT '1',
  `ei_autoplay` char(1) NOT NULL DEFAULT '1',
  `ei_control` char(1) NOT NULL DEFAULT '1',
  `ei_loop` char(1) NOT NULL DEFAULT '1',
  `ei_mute` char(1) NOT NULL DEFAULT '1',
  `ei_raster` char(1) NOT NULL DEFAULT '1',
  `ei_volumn` smallint(3) NOT NULL DEFAULT '10',
  `ei_stime` smallint(4) NOT NULL DEFAULT '0',
  `ei_etime` smallint(4) NOT NULL DEFAULT '0',
  `ei_period` char(1) NOT NULL DEFAULT '1',
  `ei_start` varchar(10) NOT NULL,
  `ei_end` varchar(10) NOT NULL,
  `ei_view_level` tinyint(4) NOT NULL DEFAULT '1',
  `ei_regdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_eyoom_subscribe`
--

CREATE TABLE `g5_eyoom_subscribe` (
  `sb_no` int(11) UNSIGNED NOT NULL,
  `sb_my_id` varchar(30) NOT NULL,
  `sb_mb_id` varchar(30) NOT NULL,
  `sb_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_eyoom_tag`
--

CREATE TABLE `g5_eyoom_tag` (
  `tg_id` int(11) UNSIGNED NOT NULL,
  `tg_word` varchar(20) NOT NULL DEFAULT '',
  `tg_theme` varchar(40) NOT NULL DEFAULT 'basic',
  `tg_regcnt` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `tg_dpmenu` enum('y','n') NOT NULL DEFAULT 'n',
  `tg_scnt` int(11) NOT NULL DEFAULT '0',
  `tg_score` int(11) NOT NULL DEFAULT '0',
  `tg_recommdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tg_regdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_eyoom_tag_write`
--

CREATE TABLE `g5_eyoom_tag_write` (
  `tw_id` int(11) UNSIGNED NOT NULL,
  `tw_theme` varchar(40) NOT NULL,
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `wr_id` int(11) NOT NULL DEFAULT '0',
  `wr_subject` varchar(255) NOT NULL,
  `wr_option` set('html1','html2','secret','mail') NOT NULL,
  `wr_content` text NOT NULL,
  `wr_tag` text NOT NULL,
  `wr_image` text NOT NULL,
  `wr_hit` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `mb_name` varchar(50) NOT NULL,
  `mb_nick` varchar(50) NOT NULL,
  `mb_level` varchar(255) NOT NULL,
  `tw_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `eb_1` varchar(255) NOT NULL,
  `eb_2` varchar(255) NOT NULL,
  `eb_3` varchar(255) NOT NULL,
  `eb_4` varchar(255) NOT NULL,
  `eb_5` varchar(255) NOT NULL,
  `eb_6` varchar(255) NOT NULL,
  `eb_7` varchar(255) NOT NULL,
  `eb_8` varchar(255) NOT NULL,
  `eb_9` varchar(255) NOT NULL,
  `eb_10` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_eyoom_theme`
--

CREATE TABLE `g5_eyoom_theme` (
  `tm_name` varchar(40) NOT NULL,
  `tm_alias` varchar(20) NOT NULL,
  `tm_key` varchar(100) NOT NULL,
  `cm_key` varchar(255) NOT NULL,
  `cm_salt` varchar(10) NOT NULL,
  `tm_last` varchar(20) NOT NULL,
  `tm_time` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `g5_eyoom_theme`
--

INSERT INTO `g5_eyoom_theme` (`tm_name`, `tm_alias`, `tm_key`, `cm_key`, `cm_salt`, `tm_last`, `tm_time`) VALUES
('eb4_basic', '', '1605669018', '', '', '2020-11-18 12:10:18', '2020-11-18 11:13:05');

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_eyoom_yellowcard`
--

CREATE TABLE `g5_eyoom_yellowcard` (
  `yc_id` int(11) UNSIGNED NOT NULL,
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `wr_id` int(11) NOT NULL DEFAULT '0',
  `pr_id` int(11) NOT NULL,
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `yc_reason` char(1) NOT NULL,
  `yc_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_faq`
--

CREATE TABLE `g5_faq` (
  `fa_id` int(11) NOT NULL,
  `fm_id` int(11) NOT NULL DEFAULT '0',
  `fa_subject` text NOT NULL,
  `fa_content` text NOT NULL,
  `fa_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_faq_master`
--

CREATE TABLE `g5_faq_master` (
  `fm_id` int(11) NOT NULL,
  `fm_subject` varchar(255) NOT NULL DEFAULT '',
  `fm_head_html` text NOT NULL,
  `fm_tail_html` text NOT NULL,
  `fm_mobile_head_html` text NOT NULL,
  `fm_mobile_tail_html` text NOT NULL,
  `fm_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `g5_faq_master`
--

INSERT INTO `g5_faq_master` (`fm_id`, `fm_subject`, `fm_head_html`, `fm_tail_html`, `fm_mobile_head_html`, `fm_mobile_tail_html`, `fm_order`) VALUES
(1, '자주하시는 질문', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_group`
--

CREATE TABLE `g5_group` (
  `gr_id` varchar(10) NOT NULL DEFAULT '',
  `gr_subject` varchar(255) NOT NULL DEFAULT '',
  `gr_device` enum('both','pc','mobile') NOT NULL DEFAULT 'both',
  `gr_admin` varchar(255) NOT NULL DEFAULT '',
  `gr_use_access` tinyint(4) NOT NULL DEFAULT '0',
  `gr_order` int(11) NOT NULL DEFAULT '0',
  `gr_1_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_2_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_3_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_4_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_5_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_6_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_7_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_8_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_9_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_10_subj` varchar(255) NOT NULL DEFAULT '',
  `gr_1` varchar(255) NOT NULL DEFAULT '',
  `gr_2` varchar(255) NOT NULL DEFAULT '',
  `gr_3` varchar(255) NOT NULL DEFAULT '',
  `gr_4` varchar(255) NOT NULL DEFAULT '',
  `gr_5` varchar(255) NOT NULL DEFAULT '',
  `gr_6` varchar(255) NOT NULL DEFAULT '',
  `gr_7` varchar(255) NOT NULL DEFAULT '',
  `gr_8` varchar(255) NOT NULL DEFAULT '',
  `gr_9` varchar(255) NOT NULL DEFAULT '',
  `gr_10` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `g5_group`
--

INSERT INTO `g5_group` (`gr_id`, `gr_subject`, `gr_device`, `gr_admin`, `gr_use_access`, `gr_order`, `gr_1_subj`, `gr_2_subj`, `gr_3_subj`, `gr_4_subj`, `gr_5_subj`, `gr_6_subj`, `gr_7_subj`, `gr_8_subj`, `gr_9_subj`, `gr_10_subj`, `gr_1`, `gr_2`, `gr_3`, `gr_4`, `gr_5`, `gr_6`, `gr_7`, `gr_8`, `gr_9`, `gr_10`) VALUES
('community', '커뮤니티', 'both', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_group_member`
--

CREATE TABLE `g5_group_member` (
  `gm_id` int(11) NOT NULL,
  `gr_id` varchar(255) NOT NULL DEFAULT '',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `gm_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_login`
--

CREATE TABLE `g5_login` (
  `lo_ip` varchar(100) NOT NULL DEFAULT '',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `lo_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lo_location` text NOT NULL,
  `lo_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `g5_login`
--

INSERT INTO `g5_login` (`lo_ip`, `mb_id`, `lo_datetime`, `lo_location`, `lo_url`) VALUES
('127.0.0.1', '', '2020-12-31 12:47:30', '사업공고 1 페이지', '/bbs/board.php?bo_table=business&bo_idx=1'),
('::1', 'admin', '2021-01-06 16:09:57', '그누보드5', '');

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_mail`
--

CREATE TABLE `g5_mail` (
  `ma_id` int(11) NOT NULL,
  `ma_subject` varchar(255) NOT NULL DEFAULT '',
  `ma_content` mediumtext NOT NULL,
  `ma_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ma_ip` varchar(255) NOT NULL DEFAULT '',
  `ma_last_option` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_member`
--

CREATE TABLE `g5_member` (
  `mb_no` int(11) NOT NULL COMMENT '유저 순서',
  `mb_id` varchar(20) NOT NULL DEFAULT '' COMMENT '유저 아이디',
  `mb_password` varchar(255) NOT NULL DEFAULT '' COMMENT '유저 비밀번호',
  `mb_name` varchar(255) NOT NULL DEFAULT '' COMMENT '유저 이름',
  `mb_nick` varchar(255) NOT NULL DEFAULT '' COMMENT '유저 닉네임',
  `mb_nick_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '유저 닉네임 만든 날짜',
  `mb_email` varchar(255) NOT NULL DEFAULT '' COMMENT '유저 이메일',
  `mb_homepage` varchar(255) NOT NULL DEFAULT '',
  `mb_level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '유저 권한',
  `mb_sex` char(1) NOT NULL DEFAULT '',
  `mb_birth` varchar(255) NOT NULL DEFAULT '',
  `mb_tel` varchar(255) NOT NULL DEFAULT '',
  `mb_hp` varchar(255) NOT NULL DEFAULT '',
  `mb_certify` varchar(20) NOT NULL DEFAULT '',
  `mb_adult` tinyint(4) NOT NULL DEFAULT '0',
  `mb_dupinfo` varchar(255) NOT NULL DEFAULT '',
  `mb_zip1` char(3) NOT NULL DEFAULT '',
  `mb_zip2` char(3) NOT NULL DEFAULT '',
  `mb_addr1` varchar(255) NOT NULL DEFAULT '',
  `mb_addr2` varchar(255) NOT NULL DEFAULT '',
  `mb_addr3` varchar(255) NOT NULL DEFAULT '',
  `mb_addr_jibeon` varchar(255) NOT NULL DEFAULT '',
  `mb_signature` text NOT NULL,
  `mb_recommend` varchar(255) NOT NULL DEFAULT '',
  `mb_point` int(11) NOT NULL DEFAULT '0' COMMENT '유저 포인트',
  `mb_today_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '유저 마지막 로그인',
  `mb_login_ip` varchar(255) NOT NULL DEFAULT '',
  `mb_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '계정 만든 날짜',
  `mb_ip` varchar(255) NOT NULL DEFAULT '',
  `mb_leave_date` varchar(8) NOT NULL DEFAULT '',
  `mb_intercept_date` varchar(8) NOT NULL DEFAULT '',
  `mb_email_certify` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mb_email_certify2` varchar(255) NOT NULL DEFAULT '',
  `mb_memo` text NOT NULL,
  `mb_lost_certify` varchar(255) NOT NULL,
  `mb_mailling` tinyint(4) NOT NULL DEFAULT '0',
  `mb_sms` tinyint(4) NOT NULL DEFAULT '0',
  `mb_open` tinyint(4) NOT NULL DEFAULT '0',
  `mb_open_date` date NOT NULL DEFAULT '0000-00-00',
  `mb_profile` text NOT NULL,
  `mb_memo_call` varchar(255) NOT NULL DEFAULT '',
  `mb_memo_cnt` int(11) NOT NULL DEFAULT '0',
  `mb_scrap_cnt` int(11) NOT NULL DEFAULT '0',
  `belong` varchar(255) NOT NULL DEFAULT '' COMMENT '소속',
  `degree` varchar(255) NOT NULL DEFAULT '' COMMENT '학력',
  `rank` varchar(255) NOT NULL DEFAULT '' COMMENT '직책',
  `category` varchar(255) NOT NULL DEFAULT '' COMMENT '연구분야',
  `mb_5` varchar(255) NOT NULL DEFAULT '',
  `mb_6` varchar(255) NOT NULL DEFAULT '',
  `mb_7` varchar(255) NOT NULL DEFAULT '',
  `mb_8` varchar(255) NOT NULL DEFAULT '',
  `mb_9` varchar(255) NOT NULL DEFAULT '',
  `mb_10` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='유저 정보';

--
-- 테이블의 덤프 데이터 `g5_member`
--

INSERT INTO `g5_member` (`mb_no`, `mb_id`, `mb_password`, `mb_name`, `mb_nick`, `mb_nick_date`, `mb_email`, `mb_homepage`, `mb_level`, `mb_sex`, `mb_birth`, `mb_tel`, `mb_hp`, `mb_certify`, `mb_adult`, `mb_dupinfo`, `mb_zip1`, `mb_zip2`, `mb_addr1`, `mb_addr2`, `mb_addr3`, `mb_addr_jibeon`, `mb_signature`, `mb_recommend`, `mb_point`, `mb_today_login`, `mb_login_ip`, `mb_datetime`, `mb_ip`, `mb_leave_date`, `mb_intercept_date`, `mb_email_certify`, `mb_email_certify2`, `mb_memo`, `mb_lost_certify`, `mb_mailling`, `mb_sms`, `mb_open`, `mb_open_date`, `mb_profile`, `mb_memo_call`, `mb_memo_cnt`, `mb_scrap_cnt`, `belong`, `degree`, `rank`, `category`, `mb_5`, `mb_6`, `mb_7`, `mb_8`, `mb_9`, `mb_10`) VALUES
(1, 'admin', 'sha256:12000:G4RrtCE1ECthw48VTRTpWk4mHegSXAZh:uziYXytBZkkfvCwALeINf6Ak4+cPZSGS', '최고관리자', '최고관리자', '0000-00-00', 'admin@domain.com', '', 10, '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 3605, '2021-01-06 14:38:06', '::1', '2020-11-19 16:55:40', '::1', '', '', '2020-11-19 16:55:40', '', '', '', 1, 0, 1, '0000-00-00', '', '', 0, 1, '서울대학교', '박사', '교수', '한국학', '', '', '', '', '', ''),
(32, 'fdsafdsa', 'sha256:12000:DFt6+Uy/bi2ONUNDc5Xn06V+LBoLcfwO:xauEeSlguAJ6Jfas9/nYMhKT9X0sq6d1', 'fdsa', '', '2021-01-04', 'fdsafdsa@fdsa.fdsa', '', 5, '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '2021-01-04 19:55:15', '::1', '2021-01-04 19:55:15', '::1', '', '', '0000-00-00 00:00:00', '', '', '', 0, 0, 0, '2021-01-04', '', '', 0, 0, 'ㄹㅇㄴㅁ', 'ㄹㅇㄴㅁ', 'ㄹㅇㄴㅁ', 'ㄹㅇㄴㅁ', '', '', '', '', '', ''),
(33, 'fdsafdsafdsa', 'sha256:12000:pLQlTqowLr8qPi3k3Bf9xjJh8JYuhESh:4CfEFm9mEI13WZAfjKifnxJgn2JS62Dh', 'fdsa', '', '2021-01-04', 'fdsa@fdsafdsa.fdsafdsa', '', 2, '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '2021-01-04 19:58:16', '::1', '2021-01-04 19:58:16', '::1', '', '', '0000-00-00 00:00:00', '', '', '', 0, 0, 0, '2021-01-04', '', '', 0, 0, '', '', '', '', '', '', '', '', '', ''),
(34, 'fdsa', 'sha256:12000:DbW+SyzDczjv2sKcz9JAq0YwZv0S6blw:Ze2MUtYuTj9kWumz9ObZD3Unv1MOzVFy', 'fdsa', '', '2021-01-04', 'fdsa@fdsa.fdsa', '', 2, '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '2021-01-04 19:59:12', '::1', '2021-01-04 19:59:12', '::1', '', '', '0000-00-00 00:00:00', '', '', '', 0, 0, 0, '2021-01-04', '', '', 0, 0, '', '', '', '', '', '', '', '', '', ''),
(35, 'rewq', 'sha256:12000:PNoU2gv+3MfgzC6OoPGPr9k1yVCNtg38:mYR61yEkSISPqx5780AUl3WLXMX6Hddm', 'rewq', '', '2021-01-04', 'rewq@rfewq.rewq', '', 2, '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '2021-01-04 20:07:32', '::1', '2021-01-04 20:07:32', '::1', '', '', '0000-00-00 00:00:00', '', '', '', 0, 0, 0, '2021-01-04', '', '', 0, 0, '', '', '', '', '', '', '', '', '', ''),
(36, 'qwer', 'sha256:12000:r8fmW7c3hRt5F04Mc6NdbtvO+6sSIWIg:vR76VVcwWKz6SZsigCyXJFe9o+OxHgj/', 'qwer', '', '2021-01-04', 'qwer@qwer.qwer', '', 2, '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 200, '2021-01-05 18:50:10', '::1', '2021-01-04 20:08:37', '::1', '', '', '0000-00-00 00:00:00', '', '', '', 0, 0, 0, '2021-01-04', '', '', 0, 0, '', '', '', '', '', '', '', '', '', ''),
(37, 'skekalsrl', 'sha256:12000:m8W9yjO4pSRkBM9o+c71EP/cMvR9Qvcv:T9Twg88acdM36uDKNySCVNNQz5Tr8ZSu', '민기', '', '2021-01-04', 'skekalsrl62@gmail.com', '', 10, '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 100, '2021-01-05 11:24:38', '::1', '2021-01-04 20:12:08', '::1', '', '', '0000-00-00 00:00:00', '', '', '', 0, 0, 0, '2021-01-04', '', '', 0, 0, '세명대', '세명', '세명', '세명', '', '', '', '', '', ''),
(38, 'sfdsafdasfdsa', 'sha256:12000:kl+z1UL1+cN0M5j7owHjZsmQqEKZWH1X:EvmkihnTystdSfKwaMK2IQHTfeNpeNyJ', 'fdsa', '', '2021-01-05', 'fdsaf@fdsafsdaf.fdsaf', '', 5, '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '2021-01-05 10:45:14', '::1', '2021-01-05 10:45:14', '::1', '', '', '0000-00-00 00:00:00', '', '', '', 0, 0, 0, '2021-01-05', '', '', 0, 0, '라온', '고졸', '사원', '사업기획', '', '', '', '', '', ''),
(39, 'qwerqwer', 'sha256:12000:K5PUtjaGXSrKz48lkA0em4oer7TQVYaT:kXd5FErSUzHUhNs4CPOSXLSIonqvObjw', 'qwer', '', '2021-01-05', 'qwerqwerqwer@qwerqwer.qwer', '', 5, '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', 0, '2021-01-05 14:40:25', '::1', '2021-01-05 14:40:25', '::1', '', '', '0000-00-00 00:00:00', '', '', '', 0, 0, 0, '2021-01-05', '', '', 0, 0, 'qwe', 'ewq', 'ewq', 'eqw', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_member_social_profiles`
--

CREATE TABLE `g5_member_social_profiles` (
  `mp_no` int(11) NOT NULL,
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `provider` varchar(50) NOT NULL DEFAULT '',
  `object_sha` varchar(45) NOT NULL DEFAULT '',
  `identifier` varchar(255) NOT NULL DEFAULT '',
  `profileurl` varchar(255) NOT NULL DEFAULT '',
  `photourl` varchar(255) NOT NULL DEFAULT '',
  `displayname` varchar(150) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `mp_register_day` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mp_latest_day` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_memo`
--

CREATE TABLE `g5_memo` (
  `me_id` int(11) NOT NULL,
  `me_recv_mb_id` varchar(20) NOT NULL DEFAULT '',
  `me_send_mb_id` varchar(20) NOT NULL DEFAULT '',
  `me_send_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `me_read_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `me_memo` text NOT NULL,
  `me_send_id` int(11) NOT NULL DEFAULT '0',
  `me_type` enum('send','recv') NOT NULL DEFAULT 'recv',
  `me_send_ip` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_menu`
--

CREATE TABLE `g5_menu` (
  `me_id` int(11) NOT NULL,
  `me_code` varchar(255) NOT NULL DEFAULT '',
  `me_name` varchar(255) NOT NULL DEFAULT '',
  `me_link` varchar(255) NOT NULL DEFAULT '',
  `me_target` varchar(255) NOT NULL DEFAULT '',
  `me_order` int(11) NOT NULL DEFAULT '0',
  `me_use` tinyint(4) NOT NULL DEFAULT '0',
  `me_mobile_use` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_new_win`
--

CREATE TABLE `g5_new_win` (
  `nw_id` int(11) NOT NULL,
  `nw_device` varchar(10) NOT NULL DEFAULT 'both',
  `nw_begin_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `nw_end_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `nw_disable_hours` int(11) NOT NULL DEFAULT '0',
  `nw_left` int(11) NOT NULL DEFAULT '0',
  `nw_top` int(11) NOT NULL DEFAULT '0',
  `nw_height` int(11) NOT NULL DEFAULT '0',
  `nw_width` int(11) NOT NULL DEFAULT '0',
  `nw_subject` text NOT NULL,
  `nw_content` text NOT NULL,
  `nw_content_html` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_point`
--

CREATE TABLE `g5_point` (
  `po_id` int(11) NOT NULL,
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `po_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `po_content` varchar(255) NOT NULL DEFAULT '',
  `po_point` int(11) NOT NULL DEFAULT '0',
  `po_use_point` int(11) NOT NULL DEFAULT '0',
  `po_expired` tinyint(4) NOT NULL DEFAULT '0',
  `po_expire_date` date NOT NULL DEFAULT '0000-00-00',
  `po_mb_point` int(11) NOT NULL DEFAULT '0',
  `po_rel_table` varchar(20) NOT NULL DEFAULT '',
  `po_rel_id` varchar(20) NOT NULL DEFAULT '',
  `po_rel_action` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `g5_point`
--

INSERT INTO `g5_point` (`po_id`, `mb_id`, `po_datetime`, `po_content`, `po_point`, `po_use_point`, `po_expired`, `po_expire_date`, `po_mb_point`, `po_rel_table`, `po_rel_id`, `po_rel_action`) VALUES
(1, 'admin', '2020-11-19 18:01:57', '2020-11-19 첫로그인', 100, 11, 0, '9999-12-31', 100, '@login', 'admin', '2020-11-19'),
(2, 'admin', '2020-11-20 18:04:14', '2020-11-20 첫로그인', 100, 0, 0, '9999-12-31', 200, '@login', 'admin', '2020-11-20'),
(3, 'admin', '2020-11-23 11:11:21', '2020-11-23 첫로그인', 100, 0, 0, '9999-12-31', 300, '@login', 'admin', '2020-11-23'),
(5, 'admin', '2020-11-23 17:30:12', 'dfsdafdf 2 글쓰기', 5, 0, 0, '9999-12-31', 310, 'free', '2', '쓰기'),
(6, 'admin', '2020-11-23 18:51:21', 'dfsdafdf 3 글쓰기', 5, 0, 0, '9999-12-31', 315, 'free', '3', '쓰기'),
(7, 'admin', '2020-11-23 18:51:32', 'dfsdafdf 4 글쓰기', 5, 0, 0, '9999-12-31', 320, 'free', '4', '쓰기'),
(8, 'admin', '2020-11-23 18:51:42', 'dfsdafdf 5 글쓰기', 5, 0, 0, '9999-12-31', 325, 'free', '5', '쓰기'),
(9, 'admin', '2020-11-24 18:00:19', '2020-11-24 첫로그인', 100, 0, 0, '9999-12-31', 425, '@login', 'admin', '2020-11-24'),
(10, 'admin', '2020-11-26 17:43:30', '2020-11-26 첫로그인', 100, 0, 0, '9999-12-31', 520, '@login', 'admin', '2020-11-26'),
(11, 'admin', '2020-11-26 17:43:40', 'dfsdafdf 6 글쓰기', 5, 0, 0, '9999-12-31', 525, 'free', '6', '쓰기'),
(12, 'admin', '2020-11-27 13:26:00', '2020-11-27 첫로그인', 100, 0, 0, '9999-12-31', 625, '@login', 'admin', '2020-11-27'),
(13, 'admin', '2020-11-27 13:27:10', 'dfsdafdf 7 글쓰기', 5, 0, 0, '9999-12-31', 630, 'free', '7', '쓰기'),
(14, 'admin', '2020-11-27 13:34:32', 'dfsdafdf 8 글쓰기', 5, 0, 0, '9999-12-31', 635, 'free', '8', '쓰기'),
(15, 'admin', '2020-11-27 14:03:02', 'dfsdafdf 8-9 댓글쓰기(스크랩)', 1, 0, 0, '9999-12-31', 636, 'free', '9', '댓글'),
(16, 'admin', '2020-11-27 14:50:55', 'dfsdafdf 10 글쓰기', 5, 0, 0, '9999-12-31', 641, 'free', '10', '쓰기'),
(17, 'admin', '2020-11-27 14:50:58', 'dfsdafdf 11 글쓰기', 5, 0, 0, '9999-12-31', 646, 'free', '11', '쓰기'),
(18, 'admin', '2020-11-27 14:51:03', 'dfsdafdf 12 글쓰기', 5, 0, 0, '9999-12-31', 651, 'free', '12', '쓰기'),
(19, 'admin', '2020-11-27 14:51:07', 'dfsdafdf 13 글쓰기', 5, 0, 0, '9999-12-31', 656, 'free', '13', '쓰기'),
(20, 'admin', '2020-11-27 14:51:38', 'dfsdafdf 14 글쓰기', 5, 0, 0, '9999-12-31', 661, 'free', '14', '쓰기'),
(21, 'admin', '2020-11-27 14:51:52', 'dfsdafdf 15 글쓰기', 5, 0, 0, '9999-12-31', 666, 'free', '15', '쓰기'),
(22, 'admin', '2020-11-27 14:51:57', 'dfsdafdf 16 글쓰기', 5, 0, 0, '9999-12-31', 671, 'free', '16', '쓰기'),
(23, 'admin', '2020-11-27 14:52:01', 'dfsdafdf 17 글쓰기', 5, 0, 0, '9999-12-31', 676, 'free', '17', '쓰기'),
(24, 'admin', '2020-11-27 14:52:04', 'dfsdafdf 18 글쓰기', 5, 0, 0, '9999-12-31', 681, 'free', '18', '쓰기'),
(25, 'admin', '2020-11-27 14:52:07', 'dfsdafdf 19 글쓰기', 5, 0, 0, '9999-12-31', 686, 'free', '19', '쓰기'),
(26, 'admin', '2020-11-27 14:52:10', 'dfsdafdf 20 글쓰기', 5, 0, 0, '9999-12-31', 691, 'free', '20', '쓰기'),
(27, 'admin', '2020-11-27 14:52:14', 'dfsdafdf 21 글쓰기', 5, 0, 0, '9999-12-31', 696, 'free', '21', '쓰기'),
(28, 'admin', '2020-11-30 10:21:05', '2020-11-30 첫로그인', 100, 0, 0, '9999-12-31', 796, '@login', 'admin', '2020-11-30'),
(29, 'admin', '2020-12-01 10:11:53', '2020-12-01 첫로그인', 100, 0, 0, '9999-12-31', 896, '@login', 'admin', '2020-12-01'),
(30, 'admin', '2020-12-01 11:27:43', '사업공고 0 글쓰기', 5, 0, 0, '9999-12-31', 901, 'business', '0', '쓰기'),
(31, 'admin', '2020-12-03 10:47:11', '2020-12-03 첫로그인', 100, 0, 0, '9999-12-31', 1001, '@login', 'admin', '2020-12-03'),
(32, 'minki', '2020-12-03 13:51:53', '2020-12-03 첫로그인', 100, 0, 0, '9999-12-31', 100, '@login', 'minki', '2020-12-03'),
(33, 'admin', '2020-12-03 14:10:22', '사업공고 22 글읽기', -1, 0, 1, '2020-12-03', 1000, 'business', '22', '읽기'),
(34, 'minki', '2020-12-04 13:31:41', '2020-12-04 첫로그인', 100, 0, 0, '9999-12-31', 200, '@login', 'minki', '2020-12-04'),
(35, 'admin', '2020-12-04 14:14:51', '2020-12-04 첫로그인', 100, 0, 0, '9999-12-31', 1100, '@login', 'admin', '2020-12-04'),
(36, 'admin', '2020-12-07 08:57:10', '2020-12-07 첫로그인', 100, 0, 0, '9999-12-31', 1200, '@login', 'admin', '2020-12-07'),
(37, 'admin', '2020-12-08 01:20:18', '2020-12-08 첫로그인', 100, 0, 0, '9999-12-31', 1300, '@login', 'admin', '2020-12-08'),
(38, 'admin', '2020-12-09 10:11:20', '2020-12-09 첫로그인', 100, 0, 0, '9999-12-31', 1400, '@login', 'admin', '2020-12-09'),
(39, 'admin', '2020-12-09 11:45:20', '공지사항 1 글읽기', -1, 0, 1, '2020-12-09', 1399, 'notice', '1', '읽기'),
(40, 'admin', '2020-12-10 10:50:42', '2020-12-10 첫로그인', 100, 0, 0, '9999-12-31', 1499, '@login', 'admin', '2020-12-10'),
(41, 'admin', '2020-12-10 14:40:06', '사업공고 27 글읽기', -1, 0, 1, '2020-12-10', 1498, 'business', '27', '읽기'),
(42, 'admin', '2020-12-11 01:34:55', '2020-12-11 첫로그인', 100, 0, 0, '9999-12-31', 1598, '@login', 'admin', '2020-12-11'),
(43, 'admin', '2020-12-13 22:37:54', '2020-12-13 첫로그인', 100, 0, 0, '9999-12-31', 1698, '@login', 'admin', '2020-12-13'),
(44, 'admin', '2020-12-13 23:45:38', '공지사항 7 글읽기', -1, 0, 1, '2020-12-13', 1697, 'notice', '7', '읽기'),
(45, 'admin', '2020-12-13 23:49:48', '공지사항 8 글읽기', -1, 0, 1, '2020-12-13', 1696, 'notice', '8', '읽기'),
(46, 'admin', '2020-12-14 00:02:09', '2020-12-14 첫로그인', 100, 0, 0, '9999-12-31', 1796, '@login', 'admin', '2020-12-14'),
(47, 'admin', '2020-12-15 17:39:35', '2020-12-15 첫로그인', 100, 0, 0, '9999-12-31', 1896, '@login', 'admin', '2020-12-15'),
(48, 'admin', '2020-12-15 17:43:13', '공지사항 6 글읽기', -1, 0, 1, '2020-12-15', 1895, 'notice', '6', '읽기'),
(49, 'admin', '2020-12-15 17:48:29', '공지사항 2 글읽기', -1, 0, 1, '2020-12-15', 1894, 'notice', '2', '읽기'),
(50, 'admin', '2020-12-16 10:23:04', '2020-12-16 첫로그인', 100, 0, 0, '9999-12-31', 1994, '@login', 'admin', '2020-12-16'),
(51, 'admin', '2020-12-16 14:57:20', '공지사항 4 글읽기', -1, 0, 1, '2020-12-16', 1993, 'notice', '4', '읽기'),
(52, 'admin', '2020-12-16 14:57:24', '공지사항 5 글읽기', -1, 0, 1, '2020-12-16', 1992, 'notice', '5', '읽기'),
(53, 'admin', '2020-12-16 15:07:52', '공지사항 3 글읽기', -1, 0, 1, '2020-12-16', 1991, 'notice', '3', '읽기'),
(54, 'admin', '2020-12-17 10:46:00', '2020-12-17 첫로그인', 100, 0, 0, '9999-12-31', 2091, '@login', 'admin', '2020-12-17'),
(55, 'minki', '2020-12-17 16:50:43', '2020-12-17 첫로그인', 100, 0, 0, '9999-12-31', 300, '@login', 'minki', '2020-12-17'),
(56, 'fdsa', '2020-12-17 18:09:30', '2020-12-17 첫로그인', 100, 1, 0, '9999-12-31', 100, '@login', 'fdsa', '2020-12-17'),
(57, 'admin', '2020-12-18 10:35:00', '2020-12-18 첫로그인', 100, 0, 0, '9999-12-31', 2191, '@login', 'admin', '2020-12-18'),
(58, 'admin', '2020-12-18 12:34:32', '사업공고 29 글쓰기', 5, 0, 0, '9999-12-31', 2196, 'business', '29', '쓰기'),
(59, 'admin', '2020-12-20 20:01:07', '2020-12-20 첫로그인', 100, 0, 0, '9999-12-31', 2296, '@login', 'admin', '2020-12-20'),
(60, 'admin', '2020-12-20 22:26:08', '사업공고 30 글쓰기', 5, 0, 0, '9999-12-31', 2301, 'business', '30', '쓰기'),
(61, 'admin', '2020-12-20 22:32:39', '사업공고 31 글쓰기', 5, 0, 0, '9999-12-31', 2306, 'business', '31', '쓰기'),
(62, 'admin', '2020-12-20 22:34:02', '사업공고 32 글쓰기', 5, 0, 0, '9999-12-31', 2311, 'business', '32', '쓰기'),
(63, 'admin', '2020-12-20 22:51:11', '사업공고 33 글쓰기', 5, 0, 0, '9999-12-31', 2316, 'business', '33', '쓰기'),
(64, 'admin', '2020-12-20 22:51:46', '사업공고 34 글쓰기', 5, 0, 0, '9999-12-31', 2321, 'business', '34', '쓰기'),
(65, 'admin', '2020-12-20 22:52:18', '사업공고 35 글쓰기', 5, 0, 0, '9999-12-31', 2326, 'business', '35', '쓰기'),
(66, 'admin', '2020-12-20 22:52:19', '사업공고 36 글쓰기', 5, 0, 0, '9999-12-31', 2331, 'business', '36', '쓰기'),
(67, 'admin', '2020-12-20 22:52:20', '사업공고 37 글쓰기', 5, 0, 0, '9999-12-31', 2336, 'business', '37', '쓰기'),
(68, 'admin', '2020-12-20 22:52:22', '사업공고 38 글쓰기', 5, 0, 0, '9999-12-31', 2341, 'business', '38', '쓰기'),
(69, 'admin', '2020-12-20 22:52:23', '사업공고 39 글쓰기', 5, 0, 0, '9999-12-31', 2346, 'business', '39', '쓰기'),
(70, 'admin', '2020-12-20 22:52:35', '사업공고 40 글쓰기', 5, 0, 0, '9999-12-31', 2351, 'business', '40', '쓰기'),
(71, 'admin', '2020-12-20 22:55:20', '사업공고 41 글쓰기', 5, 0, 0, '9999-12-31', 2356, 'business', '41', '쓰기'),
(72, 'admin', '2020-12-20 22:56:23', '사업공고 42 글쓰기', 5, 0, 0, '9999-12-31', 2361, 'business', '42', '쓰기'),
(73, 'admin', '2020-12-20 22:56:49', '사업공고 43 글쓰기', 5, 0, 0, '9999-12-31', 2366, 'business', '43', '쓰기'),
(74, 'admin', '2020-12-20 22:57:05', '사업공고 44 글쓰기', 5, 0, 0, '9999-12-31', 2371, 'business', '44', '쓰기'),
(75, 'admin', '2020-12-20 22:57:29', '사업공고 45 글쓰기', 5, 0, 0, '9999-12-31', 2376, 'business', '45', '쓰기'),
(76, 'admin', '2020-12-20 23:01:45', '사업공고 46 글쓰기', 5, 0, 0, '9999-12-31', 2381, 'business', '46', '쓰기'),
(77, 'admin', '2020-12-20 23:02:10', '사업공고 47 글쓰기', 5, 0, 0, '9999-12-31', 2386, 'business', '47', '쓰기'),
(78, 'admin', '2020-12-20 23:02:25', '사업공고 48 글쓰기', 5, 0, 0, '9999-12-31', 2391, 'business', '48', '쓰기'),
(79, 'admin', '2020-12-20 23:02:26', '사업공고 49 글쓰기', 5, 0, 0, '9999-12-31', 2396, 'business', '49', '쓰기'),
(80, 'admin', '2020-12-20 23:02:27', '사업공고 50 글쓰기', 5, 0, 0, '9999-12-31', 2401, 'business', '50', '쓰기'),
(81, 'admin', '2020-12-20 23:03:32', '사업공고 51 글쓰기', 5, 0, 0, '9999-12-31', 2406, 'business', '51', '쓰기'),
(82, 'admin', '2020-12-20 23:04:02', '사업공고 52 글쓰기', 5, 0, 0, '9999-12-31', 2411, 'business', '52', '쓰기'),
(83, 'admin', '2020-12-20 23:04:10', '사업공고 53 글쓰기', 5, 0, 0, '9999-12-31', 2416, 'business', '53', '쓰기'),
(84, 'admin', '2020-12-21 00:35:37', '2020-12-21 첫로그인', 100, 0, 0, '9999-12-31', 2516, '@login', 'admin', '2020-12-21'),
(85, 'admin', '2020-12-21 00:35:37', '사업공고 54 글쓰기', 5, 0, 0, '9999-12-31', 2521, 'business', '54', '쓰기'),
(86, 'admin', '2020-12-21 00:37:14', '사업공고 55 글쓰기', 5, 0, 0, '9999-12-31', 2526, 'business', '55', '쓰기'),
(87, 'admin', '2020-12-21 00:38:34', '사업공고 56 글쓰기', 5, 0, 0, '9999-12-31', 2531, 'business', '56', '쓰기'),
(88, 'admin', '2020-12-21 00:38:42', '사업공고 57 글쓰기', 5, 0, 0, '9999-12-31', 2536, 'business', '57', '쓰기'),
(89, 'admin', '2020-12-21 00:42:51', '사업공고 58 글쓰기', 5, 0, 0, '9999-12-31', 2541, 'business', '58', '쓰기'),
(90, 'admin', '2020-12-21 01:17:42', '공지사항 0 글쓰기', 5, 0, 0, '9999-12-31', 2546, 'notice', '0', '쓰기'),
(91, 'admin', '2020-12-22 11:42:01', '2020-12-22 첫로그인', 100, 0, 0, '9999-12-31', 2646, '@login', 'admin', '2020-12-22'),
(92, 'admin', '2020-12-23 10:44:49', '2020-12-23 첫로그인', 100, 0, 0, '9999-12-31', 2746, '@login', 'admin', '2020-12-23'),
(93, 'fdsa', '2020-12-24 11:02:43', '2020-12-24 첫로그인', 100, 0, 0, '9999-12-31', 200, '@login', 'fdsa', '2020-12-24'),
(94, 'admin', '2020-12-24 11:03:49', '2020-12-24 첫로그인', 100, 0, 0, '9999-12-31', 2846, '@login', 'admin', '2020-12-24'),
(95, 'qwer', '2020-12-24 11:04:43', '2020-12-24 첫로그인', 100, 0, 0, '9999-12-31', 100, '@login', 'qwer', '2020-12-24'),
(96, 'fdsa', '2020-12-24 11:12:34', '사업공고 57 글읽기', -1, 0, 1, '2020-12-24', 199, 'business', '57', '읽기'),
(97, 'admin', '2020-12-24 16:55:44', '사업공고 28 글읽기', -1, 0, 1, '2020-12-24', 2845, 'business', '28', '읽기'),
(98, 'admin', '2020-12-28 10:25:10', '2020-12-28 첫로그인', 100, 0, 0, '9999-12-31', 2945, '@login', 'admin', '2020-12-28'),
(99, 'admin', '2020-12-28 15:36:01', '공지사항 50 글쓰기', 5, 0, 0, '9999-12-31', 2950, 'notice', '50', '쓰기'),
(100, 'admin', '2020-12-28 15:38:50', '공지사항 51 글쓰기', 5, 0, 0, '9999-12-31', 2955, 'notice', '51', '쓰기'),
(101, 'admin', '2020-12-28 16:15:00', '사업공고 88 글쓰기', 5, 0, 0, '9999-12-31', 2960, 'business', '88', '쓰기'),
(102, 'admin', '2020-12-28 16:16:13', '사업공고 89 글쓰기', 5, 0, 0, '9999-12-31', 2965, 'business', '89', '쓰기'),
(103, 'admin', '2020-12-28 16:21:16', '사업공고 90 글쓰기', 5, 0, 0, '9999-12-31', 2970, 'business', '90', '쓰기'),
(104, 'admin', '2020-12-28 16:21:30', '사업공고 91 글쓰기', 5, 0, 0, '9999-12-31', 2975, 'business', '91', '쓰기'),
(105, 'admin', '2020-12-28 16:22:24', '사업공고 92 글쓰기', 5, 0, 0, '9999-12-31', 2980, 'business', '92', '쓰기'),
(106, 'admin', '2020-12-28 16:30:41', '사업공고 93 글쓰기', 5, 0, 0, '9999-12-31', 2985, 'business', '93', '쓰기'),
(107, 'admin', '2020-12-28 19:00:29', '공지사항 52 글쓰기', 5, 0, 0, '9999-12-31', 2990, 'notice', '52', '쓰기'),
(108, 'admin', '2020-12-29 10:20:11', '2020-12-29 첫로그인', 100, 0, 0, '9999-12-31', 3090, '@login', 'admin', '2020-12-29'),
(109, 'admin', '2020-12-30 10:15:19', '2020-12-30 첫로그인', 100, 0, 0, '9999-12-31', 3190, '@login', 'admin', '2020-12-30'),
(110, 'admin', '2020-12-31 12:47:39', '2020-12-31 첫로그인', 100, 0, 0, '9999-12-31', 3290, '@login', 'admin', '2020-12-31'),
(111, 'admin', '2021-01-04 10:03:21', '2021-01-04 첫로그인', 100, 0, 0, '9999-12-31', 3390, '@login', 'admin', '2021-01-04'),
(112, 'admin', '2021-01-05 10:05:59', '2021-01-05 첫로그인', 100, 0, 0, '9999-12-31', 3490, '@login', 'admin', '2021-01-05'),
(113, 'skekalsrl', '2021-01-05 11:24:38', '2021-01-05 첫로그인', 100, 0, 0, '9999-12-31', 100, '@login', 'skekalsrl', '2021-01-05'),
(114, 'admin', '2021-01-05 11:35:40', '사업공고 94 글쓰기', 5, 0, 0, '9999-12-31', 3495, 'business', '94', '쓰기'),
(115, 'admin', '2021-01-05 14:20:00', '공지사항 53 글쓰기', 5, 0, 0, '9999-12-31', 3500, 'notice', '53', '쓰기'),
(116, 'admin', '2021-01-05 14:49:06', '사업공고 95 글쓰기', 5, 0, 0, '9999-12-31', 3505, 'business', '95', '쓰기'),
(117, 'qwer', '2021-01-05 18:50:10', '2021-01-05 첫로그인', 100, 0, 0, '9999-12-31', 200, '@login', 'qwer', '2021-01-05'),
(118, 'admin', '2021-01-06 14:38:06', '2021-01-06 첫로그인', 100, 0, 0, '9999-12-31', 3605, '@login', 'admin', '2021-01-06');

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_poll`
--

CREATE TABLE `g5_poll` (
  `po_id` int(11) NOT NULL,
  `po_subject` varchar(255) NOT NULL DEFAULT '',
  `po_poll1` varchar(255) NOT NULL DEFAULT '',
  `po_poll2` varchar(255) NOT NULL DEFAULT '',
  `po_poll3` varchar(255) NOT NULL DEFAULT '',
  `po_poll4` varchar(255) NOT NULL DEFAULT '',
  `po_poll5` varchar(255) NOT NULL DEFAULT '',
  `po_poll6` varchar(255) NOT NULL DEFAULT '',
  `po_poll7` varchar(255) NOT NULL DEFAULT '',
  `po_poll8` varchar(255) NOT NULL DEFAULT '',
  `po_poll9` varchar(255) NOT NULL DEFAULT '',
  `po_cnt1` int(11) NOT NULL DEFAULT '0',
  `po_cnt2` int(11) NOT NULL DEFAULT '0',
  `po_cnt3` int(11) NOT NULL DEFAULT '0',
  `po_cnt4` int(11) NOT NULL DEFAULT '0',
  `po_cnt5` int(11) NOT NULL DEFAULT '0',
  `po_cnt6` int(11) NOT NULL DEFAULT '0',
  `po_cnt7` int(11) NOT NULL DEFAULT '0',
  `po_cnt8` int(11) NOT NULL DEFAULT '0',
  `po_cnt9` int(11) NOT NULL DEFAULT '0',
  `po_etc` varchar(255) NOT NULL DEFAULT '',
  `po_level` tinyint(4) NOT NULL DEFAULT '0',
  `po_point` int(11) NOT NULL DEFAULT '0',
  `po_date` date NOT NULL DEFAULT '0000-00-00',
  `po_ips` mediumtext NOT NULL,
  `mb_ids` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_poll_etc`
--

CREATE TABLE `g5_poll_etc` (
  `pc_id` int(11) NOT NULL DEFAULT '0',
  `po_id` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `pc_name` varchar(255) NOT NULL DEFAULT '',
  `pc_idea` varchar(255) NOT NULL DEFAULT '',
  `pc_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_popular`
--

CREATE TABLE `g5_popular` (
  `pp_id` int(11) NOT NULL,
  `pp_word` varchar(50) NOT NULL DEFAULT '',
  `pp_date` date NOT NULL DEFAULT '0000-00-00',
  `pp_ip` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `g5_popular`
--

INSERT INTO `g5_popular` (`pp_id`, `pp_word`, `pp_date`, `pp_ip`) VALUES
(1, 'fdsafdjksa', '2020-11-19', '::1'),
(2, 'fdsafdjksa', '2020-11-20', '::1'),
(3, '5', '2020-12-01', '::1'),
(47, 'dfdsa', '2020-12-01', '::1'),
(26, 'fdsa', '2020-12-01', '::1'),
(46, 'fdsafdsa', '2020-12-01', '::1'),
(51, 'ㄹㅇㄴㅁ', '2020-12-01', '::1'),
(52, 'fdsafdjksa', '2020-12-03', '::1'),
(53, 'ㅇㄹㄴㅇㄹ', '2020-12-10', '::1'),
(54, 'ㄹㅇㄴㅁ', '2020-12-11', '::1'),
(55, '43214', '2020-12-30', '::1'),
(100, 'ddd', '2020-12-30', '::1'),
(73, 'fdsa', '2020-12-30', '::1'),
(71, 'fdsafdas', '2020-12-30', '::1'),
(257, '12', '2020-12-31', '::1'),
(116, '43214', '2020-12-31', '::1'),
(101, 'fdsa', '2020-12-31', '::1'),
(259, 'ㄱㄷ', '2020-12-31', '::1'),
(314, '12', '2021-01-04', '::1'),
(260, '123', '2021-01-04', '::1'),
(313, '1231', '2021-01-04', '::1'),
(422, '321', '2021-01-04', '::1'),
(274, '4321', '2021-01-04', '::1'),
(265, '43214', '2021-01-04', '::1'),
(405, '543', '2021-01-04', '::1'),
(407, '5432', '2021-01-04', '::1'),
(411, 'DSA', '2021-01-04', '::1'),
(414, 'dsafdsafdsafas', '2021-01-04', '::1'),
(327, 'fdsa', '2021-01-04', '::1'),
(328, 'fdsafdas', '2021-01-04', '::1'),
(275, 'ㄱㄱ', '2021-01-04', '::1'),
(264, 'ㄱㄱㄱ', '2021-01-04', '::1'),
(332, 'ㄱㄷ', '2021-01-04', '::1'),
(261, 'ㄱㄷㅈ', '2021-01-04', '::1'),
(316, 'ㄱㄷㅈㅂ', '2021-01-04', '::1'),
(315, 'ㄱㅈ', '2021-01-04', '::1'),
(277, 'ㄴㄴ', '2021-01-04', '::1'),
(268, 'ㄷㅈ', '2021-01-04', '::1'),
(344, 'ㄷㅈㄱ0', '2021-01-04', '::1'),
(340, 'ㄷㅈㄱㄷ', '2021-01-04', '::1'),
(322, 'ㄷㅈㄱㄷㅈㄱㄷㅈㄱㄷㅈ', '2021-01-04', '::1'),
(334, 'ㄷㅈㅂㄷ', '2021-01-04', '::1'),
(272, 'ㄹㅇ', '2021-01-04', '::1'),
(262, 'ㄹㅇㄴㅁ', '2021-01-04', '::1'),
(502, 'ㄹㅇㄴㅁㄹㅇㄴㅁㄹ', '2021-01-04', '::1'),
(435, 'ㄹㅇㄴㅁㄹㅇㄴㅁㄹㅇㄴㅁㄻㄴㅇ', '2021-01-04', '::1'),
(317, 'ㅈㄱ', '2021-01-04', '::1'),
(412, 'ㅈㄱㄷㅈ', '2021-01-04', '::1'),
(263, 'ㅈㅁㅇ', '2021-01-04', '::1'),
(346, '공지', '2021-01-04', '::1'),
(278, '한국', '2021-01-04', '::1'),
(311, '한국ㅇㄹㄴㅁ', '2021-01-04', '::1'),
(270, '한국학', '2021-01-04', '::1');

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_qa_config`
--

CREATE TABLE `g5_qa_config` (
  `qa_title` varchar(255) NOT NULL DEFAULT '',
  `qa_category` varchar(255) NOT NULL DEFAULT '',
  `qa_skin` varchar(255) NOT NULL DEFAULT '',
  `qa_mobile_skin` varchar(255) NOT NULL DEFAULT '',
  `qa_use_email` tinyint(4) NOT NULL DEFAULT '0',
  `qa_req_email` tinyint(4) NOT NULL DEFAULT '0',
  `qa_use_hp` tinyint(4) NOT NULL DEFAULT '0',
  `qa_req_hp` tinyint(4) NOT NULL DEFAULT '0',
  `qa_use_sms` tinyint(4) NOT NULL DEFAULT '0',
  `qa_send_number` varchar(255) NOT NULL DEFAULT '0',
  `qa_admin_hp` varchar(255) NOT NULL DEFAULT '',
  `qa_admin_email` varchar(255) NOT NULL DEFAULT '',
  `qa_use_editor` tinyint(4) NOT NULL DEFAULT '0',
  `qa_subject_len` int(11) NOT NULL DEFAULT '0',
  `qa_mobile_subject_len` int(11) NOT NULL DEFAULT '0',
  `qa_page_rows` int(11) NOT NULL DEFAULT '0',
  `qa_mobile_page_rows` int(11) NOT NULL DEFAULT '0',
  `qa_image_width` int(11) NOT NULL DEFAULT '0',
  `qa_upload_size` int(11) NOT NULL DEFAULT '0',
  `qa_insert_content` text NOT NULL,
  `qa_include_head` varchar(255) NOT NULL DEFAULT '',
  `qa_include_tail` varchar(255) NOT NULL DEFAULT '',
  `qa_content_head` text NOT NULL,
  `qa_content_tail` text NOT NULL,
  `qa_mobile_content_head` text NOT NULL,
  `qa_mobile_content_tail` text NOT NULL,
  `qa_1_subj` varchar(255) NOT NULL DEFAULT '',
  `qa_2_subj` varchar(255) NOT NULL DEFAULT '',
  `qa_3_subj` varchar(255) NOT NULL DEFAULT '',
  `qa_4_subj` varchar(255) NOT NULL DEFAULT '',
  `qa_5_subj` varchar(255) NOT NULL DEFAULT '',
  `qa_1` varchar(255) NOT NULL DEFAULT '',
  `qa_2` varchar(255) NOT NULL DEFAULT '',
  `qa_3` varchar(255) NOT NULL DEFAULT '',
  `qa_4` varchar(255) NOT NULL DEFAULT '',
  `qa_5` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `g5_qa_config`
--

INSERT INTO `g5_qa_config` (`qa_title`, `qa_category`, `qa_skin`, `qa_mobile_skin`, `qa_use_email`, `qa_req_email`, `qa_use_hp`, `qa_req_hp`, `qa_use_sms`, `qa_send_number`, `qa_admin_hp`, `qa_admin_email`, `qa_use_editor`, `qa_subject_len`, `qa_mobile_subject_len`, `qa_page_rows`, `qa_mobile_page_rows`, `qa_image_width`, `qa_upload_size`, `qa_insert_content`, `qa_include_head`, `qa_include_tail`, `qa_content_head`, `qa_content_tail`, `qa_mobile_content_head`, `qa_mobile_content_tail`, `qa_1_subj`, `qa_2_subj`, `qa_3_subj`, `qa_4_subj`, `qa_5_subj`, `qa_1`, `qa_2`, `qa_3`, `qa_4`, `qa_5`) VALUES
('1:1문의', '회원|포인트', 'basic', 'basic', 1, 0, 1, 0, 0, '0', '', '', 1, 60, 30, 15, 15, 600, 1048576, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_qa_content`
--

CREATE TABLE `g5_qa_content` (
  `qa_id` int(11) NOT NULL,
  `qa_num` int(11) NOT NULL DEFAULT '0',
  `qa_parent` int(11) NOT NULL DEFAULT '0',
  `qa_related` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `qa_name` varchar(255) NOT NULL DEFAULT '',
  `qa_email` varchar(255) NOT NULL DEFAULT '',
  `qa_hp` varchar(255) NOT NULL DEFAULT '',
  `qa_type` tinyint(4) NOT NULL DEFAULT '0',
  `qa_category` varchar(255) NOT NULL DEFAULT '',
  `qa_email_recv` tinyint(4) NOT NULL DEFAULT '0',
  `qa_sms_recv` tinyint(4) NOT NULL DEFAULT '0',
  `qa_html` tinyint(4) NOT NULL DEFAULT '0',
  `qa_subject` varchar(255) NOT NULL DEFAULT '',
  `qa_content` text NOT NULL,
  `qa_status` tinyint(4) NOT NULL DEFAULT '0',
  `qa_file1` varchar(255) NOT NULL DEFAULT '',
  `qa_source1` varchar(255) NOT NULL DEFAULT '',
  `qa_file2` varchar(255) NOT NULL DEFAULT '',
  `qa_source2` varchar(255) NOT NULL DEFAULT '',
  `qa_ip` varchar(255) NOT NULL DEFAULT '',
  `qa_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `qa_1` varchar(255) NOT NULL DEFAULT '',
  `qa_2` varchar(255) NOT NULL DEFAULT '',
  `qa_3` varchar(255) NOT NULL DEFAULT '',
  `qa_4` varchar(255) NOT NULL DEFAULT '',
  `qa_5` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_scrap`
--

CREATE TABLE `g5_scrap` (
  `ms_id` int(11) NOT NULL,
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `bo_table` varchar(20) NOT NULL DEFAULT '',
  `wr_id` varchar(15) NOT NULL DEFAULT '',
  `ms_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `g5_scrap`
--

INSERT INTO `g5_scrap` (`ms_id`, `mb_id`, `bo_table`, `wr_id`, `ms_datetime`) VALUES
(1, 'admin', 'free', '8', '2020-11-27 14:03:02');

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_shop_banner`
--

CREATE TABLE `g5_shop_banner` (
  `bn_id` int(11) NOT NULL,
  `bn_alt` varchar(255) NOT NULL DEFAULT '',
  `bn_url` varchar(255) NOT NULL DEFAULT '',
  `bn_device` varchar(10) NOT NULL DEFAULT '',
  `bn_position` varchar(255) NOT NULL DEFAULT '',
  `bn_border` tinyint(4) NOT NULL DEFAULT '0',
  `bn_new_win` tinyint(4) NOT NULL DEFAULT '0',
  `bn_begin_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bn_end_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bn_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bn_hit` int(11) NOT NULL DEFAULT '0',
  `bn_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_shop_cart`
--

CREATE TABLE `g5_shop_cart` (
  `ct_id` int(11) NOT NULL,
  `od_id` bigint(20) UNSIGNED NOT NULL,
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `it_id` varchar(20) NOT NULL DEFAULT '',
  `it_name` varchar(255) NOT NULL DEFAULT '',
  `it_sc_type` tinyint(4) NOT NULL DEFAULT '0',
  `it_sc_method` tinyint(4) NOT NULL DEFAULT '0',
  `it_sc_price` int(11) NOT NULL DEFAULT '0',
  `it_sc_minimum` int(11) NOT NULL DEFAULT '0',
  `it_sc_qty` int(11) NOT NULL DEFAULT '0',
  `ct_status` varchar(255) NOT NULL DEFAULT '',
  `ct_history` text NOT NULL,
  `ct_price` int(11) NOT NULL DEFAULT '0',
  `ct_point` int(11) NOT NULL DEFAULT '0',
  `cp_price` int(11) NOT NULL DEFAULT '0',
  `ct_point_use` tinyint(4) NOT NULL DEFAULT '0',
  `ct_stock_use` tinyint(4) NOT NULL DEFAULT '0',
  `ct_option` varchar(255) NOT NULL DEFAULT '',
  `ct_qty` int(11) NOT NULL DEFAULT '0',
  `ct_notax` tinyint(4) NOT NULL DEFAULT '0',
  `io_id` varchar(255) NOT NULL DEFAULT '',
  `io_type` tinyint(4) NOT NULL DEFAULT '0',
  `io_price` int(11) NOT NULL DEFAULT '0',
  `ct_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ct_ip` varchar(25) NOT NULL DEFAULT '',
  `ct_send_cost` tinyint(4) NOT NULL DEFAULT '0',
  `ct_direct` tinyint(4) NOT NULL DEFAULT '0',
  `ct_select` tinyint(4) NOT NULL DEFAULT '0',
  `ct_select_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_shop_category`
--

CREATE TABLE `g5_shop_category` (
  `ca_id` varchar(10) NOT NULL DEFAULT '0',
  `ca_name` varchar(255) NOT NULL DEFAULT '',
  `ca_order` int(11) NOT NULL DEFAULT '0',
  `ca_skin_dir` varchar(255) NOT NULL DEFAULT '',
  `ca_mobile_skin_dir` varchar(255) NOT NULL DEFAULT '',
  `ca_skin` varchar(255) NOT NULL DEFAULT '',
  `ca_mobile_skin` varchar(255) NOT NULL DEFAULT '',
  `ca_img_width` int(11) NOT NULL DEFAULT '0',
  `ca_img_height` int(11) NOT NULL DEFAULT '0',
  `ca_mobile_img_width` int(11) NOT NULL DEFAULT '0',
  `ca_mobile_img_height` int(11) NOT NULL DEFAULT '0',
  `ca_sell_email` varchar(255) NOT NULL DEFAULT '',
  `ca_use` tinyint(4) NOT NULL DEFAULT '0',
  `ca_stock_qty` int(11) NOT NULL DEFAULT '0',
  `ca_explan_html` tinyint(4) NOT NULL DEFAULT '0',
  `ca_head_html` text NOT NULL,
  `ca_tail_html` text NOT NULL,
  `ca_mobile_head_html` text NOT NULL,
  `ca_mobile_tail_html` text NOT NULL,
  `ca_list_mod` int(11) NOT NULL DEFAULT '0',
  `ca_list_row` int(11) NOT NULL DEFAULT '0',
  `ca_mobile_list_mod` int(11) NOT NULL DEFAULT '0',
  `ca_mobile_list_row` int(11) NOT NULL DEFAULT '0',
  `ca_include_head` varchar(255) NOT NULL DEFAULT '',
  `ca_include_tail` varchar(255) NOT NULL DEFAULT '',
  `ca_mb_id` varchar(255) NOT NULL DEFAULT '',
  `ca_cert_use` tinyint(4) NOT NULL DEFAULT '0',
  `ca_adult_use` tinyint(4) NOT NULL DEFAULT '0',
  `ca_nocoupon` tinyint(4) NOT NULL DEFAULT '0',
  `ca_1_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_2_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_3_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_4_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_5_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_6_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_7_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_8_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_9_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_10_subj` varchar(255) NOT NULL DEFAULT '',
  `ca_1` varchar(255) NOT NULL DEFAULT '',
  `ca_2` varchar(255) NOT NULL DEFAULT '',
  `ca_3` varchar(255) NOT NULL DEFAULT '',
  `ca_4` varchar(255) NOT NULL DEFAULT '',
  `ca_5` varchar(255) NOT NULL DEFAULT '',
  `ca_6` varchar(255) NOT NULL DEFAULT '',
  `ca_7` varchar(255) NOT NULL DEFAULT '',
  `ca_8` varchar(255) NOT NULL DEFAULT '',
  `ca_9` varchar(255) NOT NULL DEFAULT '',
  `ca_10` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_shop_coupon`
--

CREATE TABLE `g5_shop_coupon` (
  `cp_no` int(11) NOT NULL,
  `cp_id` varchar(100) NOT NULL DEFAULT '',
  `cp_subject` varchar(255) NOT NULL DEFAULT '',
  `cp_method` tinyint(4) NOT NULL DEFAULT '0',
  `cp_target` varchar(255) NOT NULL DEFAULT '',
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `cz_id` int(11) NOT NULL DEFAULT '0',
  `cp_start` date NOT NULL DEFAULT '0000-00-00',
  `cp_end` date NOT NULL DEFAULT '0000-00-00',
  `cp_price` int(11) NOT NULL DEFAULT '0',
  `cp_type` tinyint(4) NOT NULL DEFAULT '0',
  `cp_trunc` int(11) NOT NULL DEFAULT '0',
  `cp_minimum` int(11) NOT NULL DEFAULT '0',
  `cp_maximum` int(11) NOT NULL DEFAULT '0',
  `od_id` bigint(20) UNSIGNED NOT NULL,
  `cp_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_shop_coupon_log`
--

CREATE TABLE `g5_shop_coupon_log` (
  `cl_id` int(11) NOT NULL,
  `cp_id` varchar(100) NOT NULL DEFAULT '',
  `mb_id` varchar(100) NOT NULL DEFAULT '',
  `od_id` bigint(20) NOT NULL,
  `cp_price` int(11) NOT NULL DEFAULT '0',
  `cl_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_shop_coupon_zone`
--

CREATE TABLE `g5_shop_coupon_zone` (
  `cz_id` int(11) NOT NULL,
  `cz_type` tinyint(4) NOT NULL DEFAULT '0',
  `cz_subject` varchar(255) NOT NULL DEFAULT '',
  `cz_start` date NOT NULL DEFAULT '0000-00-00',
  `cz_end` date NOT NULL DEFAULT '0000-00-00',
  `cz_file` varchar(255) NOT NULL DEFAULT '',
  `cz_period` int(11) NOT NULL DEFAULT '0',
  `cz_point` int(11) NOT NULL DEFAULT '0',
  `cp_method` tinyint(4) NOT NULL DEFAULT '0',
  `cp_target` varchar(255) NOT NULL DEFAULT '',
  `cp_price` int(11) NOT NULL DEFAULT '0',
  `cp_type` tinyint(4) NOT NULL DEFAULT '0',
  `cp_trunc` int(11) NOT NULL DEFAULT '0',
  `cp_minimum` int(11) NOT NULL DEFAULT '0',
  `cp_maximum` int(11) NOT NULL DEFAULT '0',
  `cz_download` int(11) NOT NULL DEFAULT '0',
  `cz_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_shop_default`
--

CREATE TABLE `g5_shop_default` (
  `de_admin_company_owner` varchar(255) NOT NULL DEFAULT '',
  `de_admin_company_name` varchar(255) NOT NULL DEFAULT '',
  `de_admin_company_saupja_no` varchar(255) NOT NULL DEFAULT '',
  `de_admin_company_tel` varchar(255) NOT NULL DEFAULT '',
  `de_admin_company_fax` varchar(255) NOT NULL DEFAULT '',
  `de_admin_tongsin_no` varchar(255) NOT NULL DEFAULT '',
  `de_admin_company_zip` varchar(255) NOT NULL DEFAULT '',
  `de_admin_company_addr` varchar(255) NOT NULL DEFAULT '',
  `de_admin_info_name` varchar(255) NOT NULL DEFAULT '',
  `de_admin_info_email` varchar(255) NOT NULL DEFAULT '',
  `de_shop_skin` varchar(255) NOT NULL DEFAULT '',
  `de_shop_mobile_skin` varchar(255) NOT NULL DEFAULT '',
  `de_type1_list_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_type1_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_type1_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_type1_list_row` int(11) NOT NULL DEFAULT '0',
  `de_type1_img_width` int(11) NOT NULL DEFAULT '0',
  `de_type1_img_height` int(11) NOT NULL DEFAULT '0',
  `de_type2_list_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_type2_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_type2_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_type2_list_row` int(11) NOT NULL DEFAULT '0',
  `de_type2_img_width` int(11) NOT NULL DEFAULT '0',
  `de_type2_img_height` int(11) NOT NULL DEFAULT '0',
  `de_type3_list_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_type3_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_type3_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_type3_list_row` int(11) NOT NULL DEFAULT '0',
  `de_type3_img_width` int(11) NOT NULL DEFAULT '0',
  `de_type3_img_height` int(11) NOT NULL DEFAULT '0',
  `de_type4_list_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_type4_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_type4_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_type4_list_row` int(11) NOT NULL DEFAULT '0',
  `de_type4_img_width` int(11) NOT NULL DEFAULT '0',
  `de_type4_img_height` int(11) NOT NULL DEFAULT '0',
  `de_type5_list_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_type5_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_type5_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_type5_list_row` int(11) NOT NULL DEFAULT '0',
  `de_type5_img_width` int(11) NOT NULL DEFAULT '0',
  `de_type5_img_height` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type1_list_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_mobile_type1_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_mobile_type1_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type1_list_row` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type1_img_width` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type1_img_height` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type2_list_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_mobile_type2_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_mobile_type2_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type2_list_row` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type2_img_width` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type2_img_height` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type3_list_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_mobile_type3_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_mobile_type3_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type3_list_row` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type3_img_width` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type3_img_height` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type4_list_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_mobile_type4_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_mobile_type4_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type4_list_row` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type4_img_width` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type4_img_height` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type5_list_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_mobile_type5_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_mobile_type5_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type5_list_row` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type5_img_width` int(11) NOT NULL DEFAULT '0',
  `de_mobile_type5_img_height` int(11) NOT NULL DEFAULT '0',
  `de_rel_list_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_rel_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_rel_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_rel_img_width` int(11) NOT NULL DEFAULT '0',
  `de_rel_img_height` int(11) NOT NULL DEFAULT '0',
  `de_mobile_rel_list_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_mobile_rel_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_mobile_rel_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_mobile_rel_img_width` int(11) NOT NULL DEFAULT '0',
  `de_mobile_rel_img_height` int(11) NOT NULL DEFAULT '0',
  `de_search_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_search_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_search_list_row` int(11) NOT NULL DEFAULT '0',
  `de_search_img_width` int(11) NOT NULL DEFAULT '0',
  `de_search_img_height` int(11) NOT NULL DEFAULT '0',
  `de_mobile_search_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_mobile_search_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_mobile_search_list_row` int(11) NOT NULL DEFAULT '0',
  `de_mobile_search_img_width` int(11) NOT NULL DEFAULT '0',
  `de_mobile_search_img_height` int(11) NOT NULL DEFAULT '0',
  `de_listtype_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_listtype_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_listtype_list_row` int(11) NOT NULL DEFAULT '0',
  `de_listtype_img_width` int(11) NOT NULL DEFAULT '0',
  `de_listtype_img_height` int(11) NOT NULL DEFAULT '0',
  `de_mobile_listtype_list_skin` varchar(255) NOT NULL DEFAULT '',
  `de_mobile_listtype_list_mod` int(11) NOT NULL DEFAULT '0',
  `de_mobile_listtype_list_row` int(11) NOT NULL DEFAULT '0',
  `de_mobile_listtype_img_width` int(11) NOT NULL DEFAULT '0',
  `de_mobile_listtype_img_height` int(11) NOT NULL DEFAULT '0',
  `de_bank_use` int(11) NOT NULL DEFAULT '0',
  `de_bank_account` text NOT NULL,
  `de_card_test` int(11) NOT NULL DEFAULT '0',
  `de_card_use` int(11) NOT NULL DEFAULT '0',
  `de_card_noint_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_card_point` int(11) NOT NULL DEFAULT '0',
  `de_settle_min_point` int(11) NOT NULL DEFAULT '0',
  `de_settle_max_point` int(11) NOT NULL DEFAULT '0',
  `de_settle_point_unit` int(11) NOT NULL DEFAULT '0',
  `de_level_sell` int(11) NOT NULL DEFAULT '0',
  `de_delivery_company` varchar(255) NOT NULL DEFAULT '',
  `de_send_cost_case` varchar(255) NOT NULL DEFAULT '',
  `de_send_cost_limit` varchar(255) NOT NULL DEFAULT '',
  `de_send_cost_list` varchar(255) NOT NULL DEFAULT '',
  `de_hope_date_use` int(11) NOT NULL DEFAULT '0',
  `de_hope_date_after` int(11) NOT NULL DEFAULT '0',
  `de_baesong_content` text NOT NULL,
  `de_change_content` text NOT NULL,
  `de_point_days` int(11) NOT NULL DEFAULT '0',
  `de_simg_width` int(11) NOT NULL DEFAULT '0',
  `de_simg_height` int(11) NOT NULL DEFAULT '0',
  `de_mimg_width` int(11) NOT NULL DEFAULT '0',
  `de_mimg_height` int(11) NOT NULL DEFAULT '0',
  `de_sms_cont1` text NOT NULL,
  `de_sms_cont2` text NOT NULL,
  `de_sms_cont3` text NOT NULL,
  `de_sms_cont4` text NOT NULL,
  `de_sms_cont5` text NOT NULL,
  `de_sms_use1` tinyint(4) NOT NULL DEFAULT '0',
  `de_sms_use2` tinyint(4) NOT NULL DEFAULT '0',
  `de_sms_use3` tinyint(4) NOT NULL DEFAULT '0',
  `de_sms_use4` tinyint(4) NOT NULL DEFAULT '0',
  `de_sms_use5` tinyint(4) NOT NULL DEFAULT '0',
  `de_sms_hp` varchar(255) NOT NULL DEFAULT '',
  `de_pg_service` varchar(255) NOT NULL DEFAULT '',
  `de_kcp_mid` varchar(255) NOT NULL DEFAULT '',
  `de_kcp_site_key` varchar(255) NOT NULL DEFAULT '',
  `de_inicis_mid` varchar(255) NOT NULL DEFAULT '',
  `de_inicis_admin_key` varchar(255) NOT NULL DEFAULT '',
  `de_inicis_sign_key` varchar(255) NOT NULL DEFAULT '',
  `de_iche_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_easy_pay_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_samsung_pay_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_inicis_lpay_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_inicis_cartpoint_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_item_use_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_item_use_write` tinyint(4) NOT NULL DEFAULT '0',
  `de_code_dup_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_cart_keep_term` int(11) NOT NULL DEFAULT '0',
  `de_guest_cart_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_admin_buga_no` varchar(255) NOT NULL DEFAULT '',
  `de_vbank_use` varchar(255) NOT NULL DEFAULT '',
  `de_taxsave_use` tinyint(4) NOT NULL,
  `de_taxsave_types` set('account','vbank','transfer') NOT NULL DEFAULT 'account',
  `de_guest_privacy` text NOT NULL,
  `de_hp_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_escrow_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_tax_flag_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_kakaopay_mid` varchar(255) NOT NULL DEFAULT '',
  `de_kakaopay_key` varchar(255) NOT NULL DEFAULT '',
  `de_kakaopay_enckey` varchar(255) NOT NULL DEFAULT '',
  `de_kakaopay_hashkey` varchar(255) NOT NULL DEFAULT '',
  `de_kakaopay_cancelpwd` varchar(255) NOT NULL DEFAULT '',
  `de_naverpay_mid` varchar(255) NOT NULL DEFAULT '',
  `de_naverpay_cert_key` varchar(255) NOT NULL DEFAULT '',
  `de_naverpay_button_key` varchar(255) NOT NULL DEFAULT '',
  `de_naverpay_test` tinyint(4) NOT NULL DEFAULT '0',
  `de_naverpay_mb_id` varchar(255) NOT NULL DEFAULT '',
  `de_naverpay_sendcost` varchar(255) NOT NULL DEFAULT '',
  `de_member_reg_coupon_use` tinyint(4) NOT NULL DEFAULT '0',
  `de_member_reg_coupon_term` int(11) NOT NULL DEFAULT '0',
  `de_member_reg_coupon_price` int(11) NOT NULL DEFAULT '0',
  `de_member_reg_coupon_minimum` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `g5_shop_default`
--

INSERT INTO `g5_shop_default` (`de_admin_company_owner`, `de_admin_company_name`, `de_admin_company_saupja_no`, `de_admin_company_tel`, `de_admin_company_fax`, `de_admin_tongsin_no`, `de_admin_company_zip`, `de_admin_company_addr`, `de_admin_info_name`, `de_admin_info_email`, `de_shop_skin`, `de_shop_mobile_skin`, `de_type1_list_use`, `de_type1_list_skin`, `de_type1_list_mod`, `de_type1_list_row`, `de_type1_img_width`, `de_type1_img_height`, `de_type2_list_use`, `de_type2_list_skin`, `de_type2_list_mod`, `de_type2_list_row`, `de_type2_img_width`, `de_type2_img_height`, `de_type3_list_use`, `de_type3_list_skin`, `de_type3_list_mod`, `de_type3_list_row`, `de_type3_img_width`, `de_type3_img_height`, `de_type4_list_use`, `de_type4_list_skin`, `de_type4_list_mod`, `de_type4_list_row`, `de_type4_img_width`, `de_type4_img_height`, `de_type5_list_use`, `de_type5_list_skin`, `de_type5_list_mod`, `de_type5_list_row`, `de_type5_img_width`, `de_type5_img_height`, `de_mobile_type1_list_use`, `de_mobile_type1_list_skin`, `de_mobile_type1_list_mod`, `de_mobile_type1_list_row`, `de_mobile_type1_img_width`, `de_mobile_type1_img_height`, `de_mobile_type2_list_use`, `de_mobile_type2_list_skin`, `de_mobile_type2_list_mod`, `de_mobile_type2_list_row`, `de_mobile_type2_img_width`, `de_mobile_type2_img_height`, `de_mobile_type3_list_use`, `de_mobile_type3_list_skin`, `de_mobile_type3_list_mod`, `de_mobile_type3_list_row`, `de_mobile_type3_img_width`, `de_mobile_type3_img_height`, `de_mobile_type4_list_use`, `de_mobile_type4_list_skin`, `de_mobile_type4_list_mod`, `de_mobile_type4_list_row`, `de_mobile_type4_img_width`, `de_mobile_type4_img_height`, `de_mobile_type5_list_use`, `de_mobile_type5_list_skin`, `de_mobile_type5_list_mod`, `de_mobile_type5_list_row`, `de_mobile_type5_img_width`, `de_mobile_type5_img_height`, `de_rel_list_use`, `de_rel_list_skin`, `de_rel_list_mod`, `de_rel_img_width`, `de_rel_img_height`, `de_mobile_rel_list_use`, `de_mobile_rel_list_skin`, `de_mobile_rel_list_mod`, `de_mobile_rel_img_width`, `de_mobile_rel_img_height`, `de_search_list_skin`, `de_search_list_mod`, `de_search_list_row`, `de_search_img_width`, `de_search_img_height`, `de_mobile_search_list_skin`, `de_mobile_search_list_mod`, `de_mobile_search_list_row`, `de_mobile_search_img_width`, `de_mobile_search_img_height`, `de_listtype_list_skin`, `de_listtype_list_mod`, `de_listtype_list_row`, `de_listtype_img_width`, `de_listtype_img_height`, `de_mobile_listtype_list_skin`, `de_mobile_listtype_list_mod`, `de_mobile_listtype_list_row`, `de_mobile_listtype_img_width`, `de_mobile_listtype_img_height`, `de_bank_use`, `de_bank_account`, `de_card_test`, `de_card_use`, `de_card_noint_use`, `de_card_point`, `de_settle_min_point`, `de_settle_max_point`, `de_settle_point_unit`, `de_level_sell`, `de_delivery_company`, `de_send_cost_case`, `de_send_cost_limit`, `de_send_cost_list`, `de_hope_date_use`, `de_hope_date_after`, `de_baesong_content`, `de_change_content`, `de_point_days`, `de_simg_width`, `de_simg_height`, `de_mimg_width`, `de_mimg_height`, `de_sms_cont1`, `de_sms_cont2`, `de_sms_cont3`, `de_sms_cont4`, `de_sms_cont5`, `de_sms_use1`, `de_sms_use2`, `de_sms_use3`, `de_sms_use4`, `de_sms_use5`, `de_sms_hp`, `de_pg_service`, `de_kcp_mid`, `de_kcp_site_key`, `de_inicis_mid`, `de_inicis_admin_key`, `de_inicis_sign_key`, `de_iche_use`, `de_easy_pay_use`, `de_samsung_pay_use`, `de_inicis_lpay_use`, `de_inicis_cartpoint_use`, `de_item_use_use`, `de_item_use_write`, `de_code_dup_use`, `de_cart_keep_term`, `de_guest_cart_use`, `de_admin_buga_no`, `de_vbank_use`, `de_taxsave_use`, `de_taxsave_types`, `de_guest_privacy`, `de_hp_use`, `de_escrow_use`, `de_tax_flag_use`, `de_kakaopay_mid`, `de_kakaopay_key`, `de_kakaopay_enckey`, `de_kakaopay_hashkey`, `de_kakaopay_cancelpwd`, `de_naverpay_mid`, `de_naverpay_cert_key`, `de_naverpay_button_key`, `de_naverpay_test`, `de_naverpay_mb_id`, `de_naverpay_sendcost`, `de_member_reg_coupon_use`, `de_member_reg_coupon_term`, `de_member_reg_coupon_price`, `de_member_reg_coupon_minimum`) VALUES
('대표자명', '회사명', '123-45-67890', '02-123-4567', '02-123-4568', '제 OO구 - 123호', '123-456', 'OO도 OO시 OO구 OO동 123-45', '정보책임자명', '정보책임자 E-mail', 'basic', 'basic', 1, 'main.10.skin.php', 5, 1, 300, 0, 1, 'main.20.skin.php', 4, 1, 600, 0, 1, 'main.40.skin.php', 4, 1, 600, 0, 1, 'main.50.skin.php', 5, 1, 600, 0, 1, 'main.30.skin.php', 4, 1, 600, 0, 1, 'main.30.skin.php', 2, 4, 600, 0, 1, 'main.10.skin.php', 2, 2, 600, 0, 1, 'main.10.skin.php', 2, 4, 1000, 0, 1, 'main.20.skin.php', 2, 2, 160, 0, 1, 'main.10.skin.php', 2, 2, 600, 0, 1, 'relation.10.skin.php', 5, 600, 0, 1, 'relation.10.skin.php', 3, 600, 0, 'list.10.skin.php', 5, 5, 450, 0, 'list.10.skin.php', 2, 5, 600, 0, 'list.10.skin.php', 5, 5, 450, 0, 'list.10.skin.php', 2, 5, 600, 0, 1, 'OO은행 12345-67-89012 예금주명', 1, 0, 0, 0, 5000, 50000, 100, 1, '', '차등', '20000;30000;40000', '4000;3000;2000', 0, 3, '배송 안내 입력전입니다.', '교환/반품 안내 입력전입니다.', 7, 600, 0, 1000, 0, '{이름}님의 회원가입을 축하드립니다.\nID:{회원아이디}\n{회사명}', '{이름}님 주문해주셔서 고맙습니다.\n{주문번호}\n{주문금액}원\n{회사명}', '{이름}님께서 주문하셨습니다.\n{주문번호}\n{주문금액}원\n{회사명}', '{이름}님 입금 감사합니다.\n{입금액}원\n주문번호:\n{주문번호}\n{회사명}', '{이름}님 배송합니다.\n택배:{택배회사}\n운송장번호:\n{운송장번호}\n{회사명}', 0, 0, 0, 0, 0, '', 'kcp', '', '', '', '', '', 0, 0, 0, 0, 0, 1, 0, 1, 15, 0, '12345호', '0', 0, 'account', '', 0, 0, 0, '', '', '', '', '', '', '', '', 0, '', '', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_shop_event`
--

CREATE TABLE `g5_shop_event` (
  `ev_id` int(11) NOT NULL,
  `ev_skin` varchar(255) NOT NULL DEFAULT '',
  `ev_mobile_skin` varchar(255) NOT NULL DEFAULT '',
  `ev_img_width` int(11) NOT NULL DEFAULT '0',
  `ev_img_height` int(11) NOT NULL DEFAULT '0',
  `ev_list_mod` int(11) NOT NULL DEFAULT '0',
  `ev_list_row` int(11) NOT NULL DEFAULT '0',
  `ev_mobile_img_width` int(11) NOT NULL DEFAULT '0',
  `ev_mobile_img_height` int(11) NOT NULL DEFAULT '0',
  `ev_mobile_list_mod` int(11) NOT NULL DEFAULT '0',
  `ev_mobile_list_row` int(11) NOT NULL DEFAULT '0',
  `ev_subject` varchar(255) NOT NULL DEFAULT '',
  `ev_subject_strong` tinyint(4) NOT NULL DEFAULT '0',
  `ev_head_html` text NOT NULL,
  `ev_tail_html` text NOT NULL,
  `ev_use` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_shop_event_item`
--

CREATE TABLE `g5_shop_event_item` (
  `ev_id` int(11) NOT NULL DEFAULT '0',
  `it_id` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_shop_inicis_log`
--

CREATE TABLE `g5_shop_inicis_log` (
  `oid` bigint(20) UNSIGNED NOT NULL,
  `P_TID` varchar(255) NOT NULL DEFAULT '',
  `P_MID` varchar(255) NOT NULL DEFAULT '',
  `P_AUTH_DT` varchar(255) NOT NULL DEFAULT '',
  `P_STATUS` varchar(255) NOT NULL DEFAULT '',
  `P_TYPE` varchar(255) NOT NULL DEFAULT '',
  `P_OID` varchar(255) NOT NULL DEFAULT '',
  `P_FN_NM` varchar(255) NOT NULL DEFAULT '',
  `P_AUTH_NO` varchar(255) NOT NULL DEFAULT '',
  `P_AMT` int(11) NOT NULL DEFAULT '0',
  `P_RMESG1` varchar(255) NOT NULL DEFAULT '',
  `post_data` text NOT NULL,
  `is_mail_send` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_shop_item`
--

CREATE TABLE `g5_shop_item` (
  `it_id` varchar(20) NOT NULL DEFAULT '',
  `ca_id` varchar(10) NOT NULL DEFAULT '0',
  `ca_id2` varchar(255) NOT NULL DEFAULT '',
  `ca_id3` varchar(255) NOT NULL DEFAULT '',
  `it_skin` varchar(255) NOT NULL DEFAULT '',
  `it_mobile_skin` varchar(255) NOT NULL DEFAULT '',
  `it_name` varchar(255) NOT NULL DEFAULT '',
  `it_seo_title` varchar(200) NOT NULL DEFAULT '',
  `it_maker` varchar(255) NOT NULL DEFAULT '',
  `it_origin` varchar(255) NOT NULL DEFAULT '',
  `it_brand` varchar(255) NOT NULL DEFAULT '',
  `it_model` varchar(255) NOT NULL DEFAULT '',
  `it_option_subject` varchar(255) NOT NULL DEFAULT '',
  `it_supply_subject` varchar(255) NOT NULL DEFAULT '',
  `it_type1` tinyint(4) NOT NULL DEFAULT '0',
  `it_type2` tinyint(4) NOT NULL DEFAULT '0',
  `it_type3` tinyint(4) NOT NULL DEFAULT '0',
  `it_type4` tinyint(4) NOT NULL DEFAULT '0',
  `it_type5` tinyint(4) NOT NULL DEFAULT '0',
  `it_basic` text NOT NULL,
  `it_explan` mediumtext NOT NULL,
  `it_explan2` mediumtext NOT NULL,
  `it_mobile_explan` mediumtext NOT NULL,
  `it_cust_price` int(11) NOT NULL DEFAULT '0',
  `it_price` int(11) NOT NULL DEFAULT '0',
  `it_point` int(11) NOT NULL DEFAULT '0',
  `it_point_type` tinyint(4) NOT NULL DEFAULT '0',
  `it_supply_point` int(11) NOT NULL DEFAULT '0',
  `it_notax` tinyint(4) NOT NULL DEFAULT '0',
  `it_sell_email` varchar(255) NOT NULL DEFAULT '',
  `it_use` tinyint(4) NOT NULL DEFAULT '0',
  `it_nocoupon` tinyint(4) NOT NULL DEFAULT '0',
  `it_soldout` tinyint(4) NOT NULL DEFAULT '0',
  `it_stock_qty` int(11) NOT NULL DEFAULT '0',
  `it_stock_sms` tinyint(4) NOT NULL DEFAULT '0',
  `it_noti_qty` int(11) NOT NULL DEFAULT '0',
  `it_sc_type` tinyint(4) NOT NULL DEFAULT '0',
  `it_sc_method` tinyint(4) NOT NULL DEFAULT '0',
  `it_sc_price` int(11) NOT NULL DEFAULT '0',
  `it_sc_minimum` int(11) NOT NULL DEFAULT '0',
  `it_sc_qty` int(11) NOT NULL DEFAULT '0',
  `it_buy_min_qty` int(11) NOT NULL DEFAULT '0',
  `it_buy_max_qty` int(11) NOT NULL DEFAULT '0',
  `it_head_html` text NOT NULL,
  `it_tail_html` text NOT NULL,
  `it_mobile_head_html` text NOT NULL,
  `it_mobile_tail_html` text NOT NULL,
  `it_hit` int(11) NOT NULL DEFAULT '0',
  `it_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `it_update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `it_ip` varchar(25) NOT NULL DEFAULT '',
  `it_order` int(11) NOT NULL DEFAULT '0',
  `it_tel_inq` tinyint(4) NOT NULL DEFAULT '0',
  `it_info_gubun` varchar(50) NOT NULL DEFAULT '',
  `it_info_value` text NOT NULL,
  `it_sum_qty` int(11) NOT NULL DEFAULT '0',
  `it_use_cnt` int(11) NOT NULL DEFAULT '0',
  `it_use_avg` decimal(2,1) NOT NULL,
  `it_shop_memo` text NOT NULL,
  `ec_mall_pid` varchar(255) NOT NULL DEFAULT '',
  `it_img1` varchar(255) NOT NULL DEFAULT '',
  `it_img2` varchar(255) NOT NULL DEFAULT '',
  `it_img3` varchar(255) NOT NULL DEFAULT '',
  `it_img4` varchar(255) NOT NULL DEFAULT '',
  `it_img5` varchar(255) NOT NULL DEFAULT '',
  `it_img6` varchar(255) NOT NULL DEFAULT '',
  `it_img7` varchar(255) NOT NULL DEFAULT '',
  `it_img8` varchar(255) NOT NULL DEFAULT '',
  `it_img9` varchar(255) NOT NULL DEFAULT '',
  `it_img10` varchar(255) NOT NULL DEFAULT '',
  `it_1_subj` varchar(255) NOT NULL DEFAULT '',
  `it_2_subj` varchar(255) NOT NULL DEFAULT '',
  `it_3_subj` varchar(255) NOT NULL DEFAULT '',
  `it_4_subj` varchar(255) NOT NULL DEFAULT '',
  `it_5_subj` varchar(255) NOT NULL DEFAULT '',
  `it_6_subj` varchar(255) NOT NULL DEFAULT '',
  `it_7_subj` varchar(255) NOT NULL DEFAULT '',
  `it_8_subj` varchar(255) NOT NULL DEFAULT '',
  `it_9_subj` varchar(255) NOT NULL DEFAULT '',
  `it_10_subj` varchar(255) NOT NULL DEFAULT '',
  `it_1` varchar(255) NOT NULL DEFAULT '',
  `it_2` varchar(255) NOT NULL DEFAULT '',
  `it_3` varchar(255) NOT NULL DEFAULT '',
  `it_4` varchar(255) NOT NULL DEFAULT '',
  `it_5` varchar(255) NOT NULL DEFAULT '',
  `it_6` varchar(255) NOT NULL DEFAULT '',
  `it_7` varchar(255) NOT NULL DEFAULT '',
  `it_8` varchar(255) NOT NULL DEFAULT '',
  `it_9` varchar(255) NOT NULL DEFAULT '',
  `it_10` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_shop_item_option`
--

CREATE TABLE `g5_shop_item_option` (
  `io_no` int(11) NOT NULL,
  `io_id` varchar(255) NOT NULL DEFAULT '0',
  `io_type` tinyint(4) NOT NULL DEFAULT '0',
  `it_id` varchar(20) NOT NULL DEFAULT '',
  `io_price` int(11) NOT NULL DEFAULT '0',
  `io_stock_qty` int(11) NOT NULL DEFAULT '0',
  `io_noti_qty` int(11) NOT NULL DEFAULT '0',
  `io_use` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_shop_item_qa`
--

CREATE TABLE `g5_shop_item_qa` (
  `iq_id` int(11) NOT NULL,
  `it_id` varchar(20) NOT NULL DEFAULT '',
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `iq_secret` tinyint(4) NOT NULL DEFAULT '0',
  `iq_name` varchar(255) NOT NULL DEFAULT '',
  `iq_email` varchar(255) NOT NULL DEFAULT '',
  `iq_hp` varchar(255) NOT NULL DEFAULT '',
  `iq_password` varchar(255) NOT NULL DEFAULT '',
  `iq_subject` varchar(255) NOT NULL DEFAULT '',
  `iq_question` text NOT NULL,
  `iq_answer` text NOT NULL,
  `iq_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `iq_ip` varchar(25) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_shop_item_relation`
--

CREATE TABLE `g5_shop_item_relation` (
  `it_id` varchar(20) NOT NULL DEFAULT '',
  `it_id2` varchar(20) NOT NULL DEFAULT '',
  `ir_no` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_shop_item_stocksms`
--

CREATE TABLE `g5_shop_item_stocksms` (
  `ss_id` int(11) NOT NULL,
  `it_id` varchar(20) NOT NULL DEFAULT '',
  `ss_hp` varchar(255) NOT NULL DEFAULT '',
  `ss_send` tinyint(4) NOT NULL DEFAULT '0',
  `ss_send_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ss_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ss_ip` varchar(25) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_shop_item_use`
--

CREATE TABLE `g5_shop_item_use` (
  `is_id` int(11) NOT NULL,
  `it_id` varchar(20) NOT NULL DEFAULT '0',
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `is_name` varchar(255) NOT NULL DEFAULT '',
  `is_password` varchar(255) NOT NULL DEFAULT '',
  `is_score` tinyint(4) NOT NULL DEFAULT '0',
  `is_subject` varchar(255) NOT NULL DEFAULT '',
  `is_content` text NOT NULL,
  `is_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_ip` varchar(25) NOT NULL DEFAULT '',
  `is_confirm` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_shop_order`
--

CREATE TABLE `g5_shop_order` (
  `od_id` bigint(20) UNSIGNED NOT NULL,
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `od_name` varchar(20) NOT NULL DEFAULT '',
  `od_email` varchar(100) NOT NULL DEFAULT '',
  `od_tel` varchar(20) NOT NULL DEFAULT '',
  `od_hp` varchar(20) NOT NULL DEFAULT '',
  `od_zip1` char(3) NOT NULL DEFAULT '',
  `od_zip2` char(3) NOT NULL DEFAULT '',
  `od_addr1` varchar(100) NOT NULL DEFAULT '',
  `od_addr2` varchar(100) NOT NULL DEFAULT '',
  `od_addr3` varchar(255) NOT NULL DEFAULT '',
  `od_addr_jibeon` varchar(255) NOT NULL DEFAULT '',
  `od_deposit_name` varchar(20) NOT NULL DEFAULT '',
  `od_b_name` varchar(20) NOT NULL DEFAULT '',
  `od_b_tel` varchar(20) NOT NULL DEFAULT '',
  `od_b_hp` varchar(20) NOT NULL DEFAULT '',
  `od_b_zip1` char(3) NOT NULL DEFAULT '',
  `od_b_zip2` char(3) NOT NULL DEFAULT '',
  `od_b_addr1` varchar(100) NOT NULL DEFAULT '',
  `od_b_addr2` varchar(100) NOT NULL DEFAULT '',
  `od_b_addr3` varchar(255) NOT NULL DEFAULT '',
  `od_b_addr_jibeon` varchar(255) NOT NULL DEFAULT '',
  `od_memo` text NOT NULL,
  `od_cart_count` int(11) NOT NULL DEFAULT '0',
  `od_cart_price` int(11) NOT NULL DEFAULT '0',
  `od_cart_coupon` int(11) NOT NULL DEFAULT '0',
  `od_send_cost` int(11) NOT NULL DEFAULT '0',
  `od_send_cost2` int(11) NOT NULL DEFAULT '0',
  `od_send_coupon` int(11) NOT NULL DEFAULT '0',
  `od_receipt_price` int(11) NOT NULL DEFAULT '0',
  `od_cancel_price` int(11) NOT NULL DEFAULT '0',
  `od_receipt_point` int(11) NOT NULL DEFAULT '0',
  `od_refund_price` int(11) NOT NULL DEFAULT '0',
  `od_bank_account` varchar(255) NOT NULL DEFAULT '',
  `od_receipt_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `od_coupon` int(11) NOT NULL DEFAULT '0',
  `od_misu` int(11) NOT NULL DEFAULT '0',
  `od_shop_memo` text NOT NULL,
  `od_mod_history` text NOT NULL,
  `od_status` varchar(255) NOT NULL DEFAULT '',
  `od_hope_date` date NOT NULL DEFAULT '0000-00-00',
  `od_settle_case` varchar(255) NOT NULL DEFAULT '',
  `od_test` tinyint(4) NOT NULL DEFAULT '0',
  `od_mobile` tinyint(4) NOT NULL DEFAULT '0',
  `od_pg` varchar(255) NOT NULL DEFAULT '',
  `od_tno` varchar(255) NOT NULL DEFAULT '',
  `od_app_no` varchar(20) NOT NULL DEFAULT '',
  `od_escrow` tinyint(4) NOT NULL DEFAULT '0',
  `od_casseqno` varchar(255) NOT NULL DEFAULT '',
  `od_tax_flag` tinyint(4) NOT NULL DEFAULT '0',
  `od_tax_mny` int(11) NOT NULL DEFAULT '0',
  `od_vat_mny` int(11) NOT NULL DEFAULT '0',
  `od_free_mny` int(11) NOT NULL DEFAULT '0',
  `od_delivery_company` varchar(255) NOT NULL DEFAULT '0',
  `od_invoice` varchar(255) NOT NULL DEFAULT '',
  `od_invoice_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `od_cash` tinyint(4) NOT NULL,
  `od_cash_no` varchar(255) NOT NULL,
  `od_cash_info` text NOT NULL,
  `od_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `od_pwd` varchar(255) NOT NULL DEFAULT '',
  `od_ip` varchar(25) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_shop_order_address`
--

CREATE TABLE `g5_shop_order_address` (
  `ad_id` int(11) NOT NULL,
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `ad_subject` varchar(255) NOT NULL DEFAULT '',
  `ad_default` tinyint(4) NOT NULL DEFAULT '0',
  `ad_name` varchar(255) NOT NULL DEFAULT '',
  `ad_tel` varchar(255) NOT NULL DEFAULT '',
  `ad_hp` varchar(255) NOT NULL DEFAULT '',
  `ad_zip1` char(3) NOT NULL DEFAULT '',
  `ad_zip2` char(3) NOT NULL DEFAULT '',
  `ad_addr1` varchar(255) NOT NULL DEFAULT '',
  `ad_addr2` varchar(255) NOT NULL DEFAULT '',
  `ad_addr3` varchar(255) NOT NULL DEFAULT '',
  `ad_jibeon` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_shop_order_data`
--

CREATE TABLE `g5_shop_order_data` (
  `od_id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `dt_pg` varchar(255) NOT NULL DEFAULT '',
  `dt_data` text NOT NULL,
  `dt_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_shop_order_delete`
--

CREATE TABLE `g5_shop_order_delete` (
  `de_id` int(11) NOT NULL,
  `de_key` varchar(255) NOT NULL DEFAULT '',
  `de_data` longtext NOT NULL,
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `de_ip` varchar(255) NOT NULL DEFAULT '',
  `de_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_shop_order_post_log`
--

CREATE TABLE `g5_shop_order_post_log` (
  `oid` bigint(20) UNSIGNED NOT NULL,
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `post_data` text NOT NULL,
  `ol_code` varchar(255) NOT NULL DEFAULT '',
  `ol_msg` varchar(255) NOT NULL DEFAULT '',
  `ol_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ol_ip` varchar(25) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_shop_personalpay`
--

CREATE TABLE `g5_shop_personalpay` (
  `pp_id` bigint(20) UNSIGNED NOT NULL,
  `od_id` bigint(20) UNSIGNED NOT NULL,
  `pp_name` varchar(255) NOT NULL DEFAULT '',
  `pp_email` varchar(255) NOT NULL DEFAULT '',
  `pp_hp` varchar(255) NOT NULL DEFAULT '',
  `pp_content` text NOT NULL,
  `pp_use` tinyint(4) NOT NULL DEFAULT '0',
  `pp_price` int(11) NOT NULL DEFAULT '0',
  `pp_pg` varchar(255) NOT NULL DEFAULT '',
  `pp_tno` varchar(255) NOT NULL DEFAULT '',
  `pp_app_no` varchar(20) NOT NULL DEFAULT '',
  `pp_casseqno` varchar(255) NOT NULL DEFAULT '',
  `pp_receipt_price` int(11) NOT NULL DEFAULT '0',
  `pp_settle_case` varchar(255) NOT NULL DEFAULT '',
  `pp_bank_account` varchar(255) NOT NULL DEFAULT '',
  `pp_deposit_name` varchar(255) NOT NULL DEFAULT '',
  `pp_receipt_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pp_receipt_ip` varchar(255) NOT NULL DEFAULT '',
  `pp_shop_memo` text NOT NULL,
  `pp_cash` tinyint(4) NOT NULL DEFAULT '0',
  `pp_cash_no` varchar(255) NOT NULL DEFAULT '',
  `pp_cash_info` text NOT NULL,
  `pp_ip` varchar(255) NOT NULL DEFAULT '',
  `pp_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_shop_sendcost`
--

CREATE TABLE `g5_shop_sendcost` (
  `sc_id` int(11) NOT NULL,
  `sc_name` varchar(255) NOT NULL DEFAULT '',
  `sc_zip1` varchar(10) NOT NULL DEFAULT '',
  `sc_zip2` varchar(10) NOT NULL DEFAULT '',
  `sc_price` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_shop_wish`
--

CREATE TABLE `g5_shop_wish` (
  `wi_id` int(11) NOT NULL,
  `mb_id` varchar(255) NOT NULL DEFAULT '',
  `it_id` varchar(20) NOT NULL DEFAULT '0',
  `wi_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `wi_ip` varchar(25) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_uniqid`
--

CREATE TABLE `g5_uniqid` (
  `uq_id` bigint(20) UNSIGNED NOT NULL,
  `uq_ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `g5_uniqid`
--

INSERT INTO `g5_uniqid` (`uq_id`, `uq_ip`) VALUES
(2020112315011874, '::1'),
(2020112315514341, '::1'),
(2020112315520453, '::1'),
(2020112315525252, '::1'),
(2020112315530797, '::1'),
(2020112315532040, '::1'),
(2020112315533522, '::1'),
(2020112316015469, '::1'),
(2020112316043606, '::1'),
(2020112317294400, '::1'),
(2020112317295547, '::1'),
(2020112317301402, '::1'),
(2020112318510989, '::1'),
(2020112318511915, '::1'),
(2020112318514025, '::1'),
(2020112617432471, '::1'),
(2020112617433596, '::1'),
(2020112617434293, '::1'),
(2020112713252680, '::1'),
(2020112713260917, '::1'),
(2020112713264238, '::1'),
(2020112713265743, '::1'),
(2020112713284289, '::1'),
(2020112714505178, '::1'),
(2020112714505639, '::1'),
(2020112714505955, '::1'),
(2020112714510502, '::1'),
(2020112714510951, '::1'),
(2020112714514776, '::1'),
(2020112714515491, '::1'),
(2020112714515948, '::1'),
(2020112714520231, '::1'),
(2020112714520538, '::1'),
(2020112714520863, '::1'),
(2020112714521268, '::1'),
(2020113010201817, '::1'),
(2020113010201836, '::1'),
(2020113010411684, '::1'),
(2020113010430581, '::1'),
(2020113010444323, '::1'),
(2020120110123846, '::1'),
(2020120110132621, '::1'),
(2020120110132785, '::1'),
(2020120110134862, '::1'),
(2020120110135016, '::1'),
(2020120110135493, '::1'),
(2020120110135649, '::1'),
(2020120110161763, '::1'),
(2020120110165880, '::1'),
(2020120110170417, '::1'),
(2020120111273009, '::1'),
(2020120111280168, '::1'),
(2020120114070006, '::1'),
(2020120116014558, '::1'),
(2020120116030979, '::1'),
(2020120116035942, '::1'),
(2020120116052847, '::1'),
(2020120117115286, '::1'),
(2020120117131509, '::1'),
(2020120117131866, '::1'),
(2020120117132630, '::1'),
(2020120117133285, '::1'),
(2020120117151521, '::1'),
(2020120117155717, '::1'),
(2020120117182313, '::1'),
(2020120117222021, '::1'),
(2020120117222844, '::1'),
(2020120117223122, '::1'),
(2020120117224947, '::1'),
(2020120117225035, '::1'),
(2020120117232484, '::1'),
(2020120117234221, '::1'),
(2020120117240582, '::1'),
(2020120117242520, '::1'),
(2020120117264974, '::1'),
(2020120117271240, '::1'),
(2020120117293952, '::1'),
(2020120117294404, '::1'),
(2020120117304518, '::1'),
(2020120117305002, '::1'),
(2020120117310274, '::1'),
(2020120117314016, '::1'),
(2020120117342130, '::1'),
(2020120117342489, '::1'),
(2020120117350907, '::1'),
(2020120117374030, '::1'),
(2020120117374112, '::1'),
(2020120117382052, '::1'),
(2020120117383465, '::1'),
(2020120117393067, '::1'),
(2020120117393803, '::1'),
(2020120117411017, '::1'),
(2020120117414788, '::1'),
(2020120117415883, '::1'),
(2020120117420412, '::1'),
(2020120117422114, '::1'),
(2020120117452486, '::1'),
(2020120117455763, '::1'),
(2020120117462448, '::1'),
(2020120117470381, '::1'),
(2020120117472680, '::1'),
(2020120117501106, '::1'),
(2020120117504407, '::1'),
(2020120117520651, '::1'),
(2020120117520746, '::1'),
(2020120117520839, '::1'),
(2020120117520887, '::1'),
(2020120117520903, '::1'),
(2020120117532859, '::1'),
(2020120117533721, '::1'),
(2020120118030254, '::1'),
(2020120118030273, '::1'),
(2020120118052386, '::1'),
(2020120118052631, '::1'),
(2020120118053881, '::1'),
(2020120118053965, '::1'),
(2020120118054060, '::1'),
(2020120118060229, '::1'),
(2020120118060323, '::1'),
(2020120118060399, '::1'),
(2020120118061510, '::1'),
(2020120118061578, '::1'),
(2020120118061628, '::1'),
(2020120118061653, '::1'),
(2020120118061672, '::1'),
(2020120118064227, '::1'),
(2020120118064318, '::1'),
(2020120118064678, '::1'),
(2020120118070810, '::1'),
(2020120118070909, '::1'),
(2020120118071794, '::1'),
(2020120118112507, '::1'),
(2020120118114184, '::1'),
(2020120118115558, '::1'),
(2020120118115640, '::1'),
(2020120118115715, '::1'),
(2020120118115740, '::1'),
(2020120118115766, '::1'),
(2020120118115783, '::1'),
(2020120118115802, '::1'),
(2020120118121426, '::1'),
(2020120118121509, '::1'),
(2020120118121569, '::1'),
(2020120118130248, '::1'),
(2020120118130335, '::1'),
(2020120118133405, '::1'),
(2020120118163100, '::1'),
(2020120118395324, '::1'),
(2020120118402220, '::1'),
(2020120118402478, '::1'),
(2020120118405645, '::1'),
(2020120118412532, '::1'),
(2020120118412578, '::1'),
(2020120118412632, '::1'),
(2020120118414629, '::1'),
(2020120118414687, '::1'),
(2020120118420018, '::1'),
(2020120118420097, '::1'),
(2020120118424996, '::1'),
(2020120118531147, '::1'),
(2020120118595627, '::1'),
(2020120118595652, '::1'),
(2020120118595712, '::1'),
(2020120119000630, '::1'),
(2020120119003052, '::1'),
(2020120119003184, '::1'),
(2020120119004229, '::1'),
(2020120119012745, '::1'),
(2020120119012838, '::1'),
(2020120119012859, '::1'),
(2020120119012880, '::1'),
(2020120119012898, '::1'),
(2020120119012915, '::1'),
(2020120119012934, '::1'),
(2020120119012949, '::1'),
(2020120119012968, '::1'),
(2020120119012984, '::1'),
(2020120119013003, '::1'),
(2020120119013021, '::1'),
(2020120119013039, '::1'),
(2020120119013057, '::1'),
(2020120119013077, '::1'),
(2020120119013095, '::1'),
(2020120119013114, '::1'),
(2020120119013132, '::1'),
(2020120210172530, '::1'),
(2020120210172864, '::1'),
(2020120210225603, '::1'),
(2020120210232839, '::1'),
(2020120210371489, '::1'),
(2020120210373318, '::1'),
(2020120210414743, '::1'),
(2020120210492657, '::1'),
(2020120210493000, '::1'),
(2020120210495126, '::1'),
(2020120210495543, '::1'),
(2020120210500193, '::1'),
(2020120210502795, '::1'),
(2020120210502866, '::1'),
(2020120210502963, '::1'),
(2020120210502986, '::1'),
(2020120210503008, '::1'),
(2020120210503027, '::1'),
(2020120210512188, '::1'),
(2020120210513345, '::1'),
(2020120210581501, '::1'),
(2020120210581562, '::1'),
(2020120210581955, '::1'),
(2020120210582502, '::1'),
(2020120211030279, '::1'),
(2020120211031652, '::1'),
(2020120211033755, '::1'),
(2020120211042368, '::1'),
(2020120211042471, '::1'),
(2020120211042898, '::1'),
(2020120211043502, '::1'),
(2020120211044353, '::1'),
(2020120211044406, '::1'),
(2020120211044454, '::1'),
(2020120211045851, '::1'),
(2020120211054968, '::1'),
(2020120211055892, '::1'),
(2020120211062043, '::1'),
(2020120211063276, '::1'),
(2020120211064855, '::1'),
(2020120211065843, '::1'),
(2020120211070615, '::1'),
(2020120211070960, '::1'),
(2020120211072622, '::1'),
(2020120211085231, '::1'),
(2020120211085305, '::1'),
(2020120211100569, '::1'),
(2020120211110329, '::1'),
(2020120211110942, '::1'),
(2020120211112313, '::1'),
(2020120211113820, '::1'),
(2020120211120151, '::1'),
(2020120211122056, '::1'),
(2020120211122137, '::1'),
(2020120211123196, '::1'),
(2020120211123256, '::1'),
(2020120211125378, '::1'),
(2020120211130141, '::1'),
(2020120211130217, '::1'),
(2020120211133985, '::1'),
(2020120211160549, '::1'),
(2020120211164443, '::1'),
(2020120211165726, '::1'),
(2020120211172911, '::1'),
(2020120211181436, '::1'),
(2020120211271261, '::1'),
(2020120211272226, '::1'),
(2020120211273790, '::1'),
(2020120211273895, '::1'),
(2020120211274632, '::1'),
(2020120211274713, '::1'),
(2020120211275659, '::1'),
(2020120211283160, '::1'),
(2020120211284200, '::1'),
(2020120211290667, '::1'),
(2020120211291720, '::1'),
(2020120211294898, '::1'),
(2020120211300765, '::1'),
(2020120211302960, '::1'),
(2020120211303433, '::1'),
(2020120211305292, '::1'),
(2020120211310001, '::1'),
(2020120211315472, '::1'),
(2020120211320930, '::1'),
(2020120211322291, '::1'),
(2020120211323519, '::1'),
(2020120211325089, '::1'),
(2020120211331463, '::1'),
(2020120211333933, '::1'),
(2020120211335435, '::1'),
(2020120211335505, '::1'),
(2020120211335609, '::1'),
(2020120211335645, '::1'),
(2020120211335669, '::1'),
(2020120211335686, '::1'),
(2020120211335703, '::1'),
(2020120211335726, '::1'),
(2020120211335745, '::1'),
(2020120211335761, '::1'),
(2020120211335780, '::1'),
(2020120211335806, '::1'),
(2020120211342310, '::1'),
(2020120211343072, '::1'),
(2020120211344348, '::1'),
(2020120211344633, '::1'),
(2020120211354513, '::1'),
(2020120211354560, '::1'),
(2020120211354735, '::1'),
(2020120211360073, '::1'),
(2020120211360127, '::1'),
(2020120211360174, '::1'),
(2020120211360393, '::1'),
(2020120211361524, '::1'),
(2020120211361699, '::1'),
(2020120211363338, '::1'),
(2020120211363599, '::1'),
(2020120211363674, '::1'),
(2020120211363756, '::1'),
(2020120211363776, '::1'),
(2020120211363791, '::1'),
(2020120211363810, '::1'),
(2020120211363842, '::1'),
(2020120211363864, '::1'),
(2020120211410917, '::1'),
(2020120211420558, '::1'),
(2020120211422156, '::1'),
(2020120211444475, '::1'),
(2020120211450717, '::1'),
(2020120211454524, '::1'),
(2020120211454601, '::1'),
(2020120211460327, '::1'),
(2020120211462844, '::1'),
(2020120211463452, '::1'),
(2020120211464862, '::1'),
(2020120211470353, '::1'),
(2020120211472381, '::1'),
(2020120211472464, '::1'),
(2020120211473517, '::1'),
(2020120211474035, '::1'),
(2020120211474296, '::1'),
(2020120211474330, '::1'),
(2020120211480635, '::1'),
(2020120211482216, '::1'),
(2020120211483399, '::1'),
(2020120211485145, '::1'),
(2020120211501850, '::1'),
(2020120211502715, '::1'),
(2020120211505259, '::1'),
(2020120211512288, '::1'),
(2020120211512402, '::1'),
(2020120211513448, '::1'),
(2020120211514444, '::1'),
(2020120211514522, '::1'),
(2020120211523801, '::1'),
(2020120211523896, '::1'),
(2020120211530465, '::1'),
(2020120211530557, '::1'),
(2020120211532623, '::1'),
(2020120211534469, '::1'),
(2020120211540720, '::1'),
(2020120211563192, '::1'),
(2020120211563551, '::1'),
(2020120211573637, '::1'),
(2020120211573863, '::1'),
(2020120211574300, '::1'),
(2020120212253780, '::1'),
(2020120212255032, '::1'),
(2020120212262060, '::1'),
(2020120212295157, '::1'),
(2020120213173784, '::1'),
(2020120213173807, '::1'),
(2020120213173816, '::1'),
(2020120213175581, '::1'),
(2020120213175647, '::1'),
(2020120213175776, '::1'),
(2020120213181261, '::1'),
(2020120213181366, '::1'),
(2020120213185216, '::1'),
(2020120213190023, '::1'),
(2020120213190097, '::1'),
(2020120213195629, '::1'),
(2020120213195702, '::1'),
(2020120213195768, '::1'),
(2020120213221074, '::1'),
(2020120213221185, '::1'),
(2020120213221271, '::1'),
(2020120213221381, '::1'),
(2020120213221398, '::1'),
(2020120213221421, '::1'),
(2020120213221437, '::1'),
(2020120213221466, '::1'),
(2020120213221486, '::1'),
(2020120213221498, '::1'),
(2020120213221524, '::1'),
(2020120213221544, '::1'),
(2020120213221561, '::1'),
(2020120213223773, '::1'),
(2020120213430456, '::1'),
(2020120213430983, '::1'),
(2020120213431263, '::1'),
(2020120213432139, '::1'),
(2020120213435236, '::1'),
(2020120213435353, '::1'),
(2020120213442665, '::1'),
(2020120213443268, '::1'),
(2020120213444496, '::1'),
(2020120213451481, '::1'),
(2020120213453503, '::1'),
(2020120213455159, '::1'),
(2020120213460556, '::1'),
(2020120213473894, '::1'),
(2020120213473991, '::1'),
(2020120213474747, '::1'),
(2020120213474820, '::1'),
(2020120213492778, '::1'),
(2020120213494744, '::1'),
(2020120213525621, '::1'),
(2020120213574128, '::1'),
(2020120213584130, '::1'),
(2020120213584189, '::1'),
(2020120213591557, '::1'),
(2020120213593120, '::1'),
(2020120213593735, '::1'),
(2020120214001070, '::1'),
(2020120214004796, '::1'),
(2020120214011048, '::1'),
(2020120214011214, '::1'),
(2020120214011307, '::1'),
(2020120214011938, '::1'),
(2020120214012982, '::1'),
(2020120214014319, '::1'),
(2020120214020218, '::1'),
(2020120214022071, '::1'),
(2020120214022540, '::1'),
(2020120214031425, '::1'),
(2020120214033786, '::1'),
(2020120214035857, '::1'),
(2020120214042915, '::1'),
(2020120214044034, '::1'),
(2020120214051950, '::1'),
(2020120214084666, '::1'),
(2020120214092108, '::1'),
(2020120214095176, '::1'),
(2020120214101145, '::1'),
(2020120214102081, '::1'),
(2020120214103952, '::1'),
(2020120214104417, '::1'),
(2020120214105318, '::1'),
(2020120214105957, '::1'),
(2020120214112228, '::1'),
(2020120214113661, '::1'),
(2020120214114472, '::1'),
(2020120214115709, '::1'),
(2020120214120410, '::1'),
(2020120214123270, '::1'),
(2020120214123820, '::1'),
(2020120214124847, '::1'),
(2020120214130209, '::1'),
(2020120214132819, '::1'),
(2020120214133734, '::1'),
(2020120214140172, '::1'),
(2020120214151607, '::1'),
(2020120214151922, '::1'),
(2020120214153117, '::1'),
(2020120214153854, '::1'),
(2020120214154499, '::1'),
(2020120214161545, '::1'),
(2020120214164574, '::1'),
(2020120214170936, '::1'),
(2020120214183425, '::1'),
(2020120214183536, '::1'),
(2020120214184179, '::1'),
(2020120214190989, '::1'),
(2020120214191072, '::1'),
(2020120214191915, '::1'),
(2020120214192026, '::1'),
(2020120214192595, '::1'),
(2020120214195520, '::1'),
(2020120214195961, '::1'),
(2020120215042129, '::1'),
(2020120215042145, '::1'),
(2020120215043483, '::1'),
(2020120215053023, '::1'),
(2020120215053353, '::1'),
(2020120215054455, '::1'),
(2020120215075152, '::1'),
(2020120215075229, '::1'),
(2020120215095358, '::1'),
(2020120215095489, '::1'),
(2020120215101548, '::1'),
(2020120215102488, '::1'),
(2020120215121281, '::1'),
(2020120215130123, '::1'),
(2020120215130608, '::1'),
(2020120215131329, '::1'),
(2020120215131396, '::1'),
(2020120215132215, '::1'),
(2020120215133056, '::1'),
(2020120215135825, '::1'),
(2020120215140357, '::1'),
(2020120215140556, '::1'),
(2020120215142792, '::1'),
(2020120215142888, '::1'),
(2020120215145092, '::1'),
(2020120215152170, '::1'),
(2020120215165339, '::1'),
(2020120215165956, '::1'),
(2020120215211459, '::1'),
(2020120215214018, '::1'),
(2020120215252353, '::1'),
(2020120215254924, '::1'),
(2020120215260922, '::1'),
(2020120215260988, '::1'),
(2020120215273486, '::1'),
(2020120215274394, '::1'),
(2020120215274467, '::1'),
(2020120215275157, '::1'),
(2020120215280173, '::1'),
(2020120215280238, '::1'),
(2020120215282090, '::1'),
(2020120215285478, '::1'),
(2020120215292286, '::1'),
(2020120215295105, '::1'),
(2020120215300477, '::1'),
(2020120215301729, '::1'),
(2020120215301901, '::1'),
(2020120215333898, '::1'),
(2020120215340646, '::1'),
(2020120215340708, '::1'),
(2020120215340730, '::1'),
(2020120215340745, '::1'),
(2020120215340765, '::1'),
(2020120215340783, '::1'),
(2020120215340806, '::1'),
(2020120215340878, '::1'),
(2020120215342510, '::1'),
(2020120215342646, '::1'),
(2020120215343261, '::1'),
(2020120215400853, '::1'),
(2020120215545746, '::1'),
(2020120215545907, '::1'),
(2020120215563247, '::1'),
(2020120215563363, '::1'),
(2020120215563642, '::1'),
(2020120215563818, '::1'),
(2020120215571804, '::1'),
(2020120215571909, '::1'),
(2020120215572572, '::1'),
(2020120215572717, '::1'),
(2020120216013266, '::1'),
(2020120216013482, '::1'),
(2020120216013668, '::1'),
(2020120216022007, '::1'),
(2020120216055190, '::1'),
(2020120216055475, '::1'),
(2020120216055526, '::1'),
(2020120216055833, '::1'),
(2020120216060269, '::1'),
(2020120216060401, '::1'),
(2020120216071596, '::1'),
(2020120216094735, '::1'),
(2020120216095008, '::1'),
(2020120216095142, '::1'),
(2020120216095424, '::1'),
(2020120216095579, '::1'),
(2020120216095733, '::1'),
(2020120216110106, '::1'),
(2020120216110546, '::1'),
(2020120216143139, '::1'),
(2020120216143342, '::1'),
(2020120216143490, '::1'),
(2020120216165405, '::1'),
(2020120216165633, '::1'),
(2020120216170096, '::1'),
(2020120216170248, '::1'),
(2020120216171561, '::1'),
(2020120216182026, '::1'),
(2020120216182333, '::1'),
(2020120216182522, '::1'),
(2020120216182752, '::1'),
(2020120216184593, '::1'),
(2020120216184754, '::1'),
(2020120216185579, '::1'),
(2020120216193444, '::1'),
(2020120216194954, '::1'),
(2020120216195064, '::1'),
(2020120216201346, '::1'),
(2020120216201763, '::1'),
(2020120216202431, '::1'),
(2020120216202798, '::1'),
(2020120216203043, '::1'),
(2020120216203408, '::1'),
(2020120216250661, '::1'),
(2020120216252458, '::1'),
(2020120216252591, '::1'),
(2020120216253077, '::1'),
(2020120216253677, '::1'),
(2020120216253818, '::1'),
(2020120216253979, '::1'),
(2020120216280762, '::1'),
(2020120216390857, '::1'),
(2020120216392150, '::1'),
(2020120216392447, '::1'),
(2020120216394217, '::1'),
(2020120216394991, '::1'),
(2020120216395163, '::1'),
(2020120216404819, '::1'),
(2020120216475199, '::1'),
(2020120216475421, '::1'),
(2020120216475772, '::1'),
(2020120216475911, '::1'),
(2020120216480853, '::1'),
(2020120216480933, '::1'),
(2020120216485246, '::1'),
(2020120216492109, '::1'),
(2020120216492998, '::1'),
(2020120216494626, '::1'),
(2020120216515970, '::1'),
(2020120216520091, '::1'),
(2020120216525517, '::1'),
(2020120216525705, '::1'),
(2020120216531247, '::1'),
(2020120216531325, '::1'),
(2020120216531613, '::1'),
(2020120216532852, '::1'),
(2020120216534099, '::1'),
(2020120216540888, '::1'),
(2020120216541183, '::1'),
(2020120216541417, '::1'),
(2020120216541696, '::1'),
(2020120216541822, '::1'),
(2020120216541856, '::1'),
(2020120216542037, '::1'),
(2020120216542070, '::1'),
(2020120216543506, '::1'),
(2020120216543733, '::1'),
(2020120216543793, '::1'),
(2020120216545089, '::1'),
(2020120216545219, '::1'),
(2020120216545245, '::1'),
(2020120216545274, '::1'),
(2020120216545333, '::1'),
(2020120216545370, '::1'),
(2020120216545407, '::1'),
(2020120216545445, '::1'),
(2020120216545483, '::1'),
(2020120216545519, '::1'),
(2020120216572297, '::1'),
(2020120216572388, '::1'),
(2020120216573557, '::1'),
(2020120216573659, '::1'),
(2020120216573809, '::1'),
(2020120216573863, '::1'),
(2020120216573946, '::1'),
(2020120216574037, '::1'),
(2020120216574108, '::1'),
(2020120216574182, '::1'),
(2020120216574254, '::1'),
(2020120216574913, '::1'),
(2020120216575019, '::1'),
(2020120216575075, '::1'),
(2020120216575136, '::1'),
(2020120216575192, '::1'),
(2020120216580567, '::1'),
(2020120216580665, '::1'),
(2020120216580777, '::1'),
(2020120216580834, '::1'),
(2020120216580919, '::1'),
(2020120216581017, '::1'),
(2020120216583160, '::1'),
(2020120216583220, '::1'),
(2020120216583280, '::1'),
(2020120216583345, '::1'),
(2020120216583408, '::1'),
(2020120216583452, '::1'),
(2020120216583486, '::1'),
(2020120216591488, '::1'),
(2020120216591561, '::1'),
(2020120216591623, '::1'),
(2020120216591669, '::1'),
(2020120216591756, '::1'),
(2020120216592037, '::1'),
(2020120216592190, '::1'),
(2020120217024963, '::1'),
(2020120217025077, '::1'),
(2020120217030738, '::1'),
(2020120217030851, '::1'),
(2020120217033635, '::1'),
(2020120217033706, '::1'),
(2020120217033988, '::1'),
(2020120217034058, '::1'),
(2020120217034133, '::1'),
(2020120217034221, '::1'),
(2020120217034464, '::1'),
(2020120217034805, '::1'),
(2020120217042891, '::1'),
(2020120217042978, '::1'),
(2020120217045034, '::1'),
(2020120217045089, '::1'),
(2020120217045258, '::1'),
(2020120217045305, '::1'),
(2020120217045336, '::1'),
(2020120217045372, '::1'),
(2020120217045411, '::1'),
(2020120217051605, '::1'),
(2020120217052145, '::1'),
(2020120217052362, '::1'),
(2020120217052445, '::1'),
(2020120217052500, '::1'),
(2020120217052533, '::1'),
(2020120217052573, '::1'),
(2020120217052610, '::1'),
(2020120217052648, '::1'),
(2020120217052684, '::1'),
(2020120217052723, '::1'),
(2020120217052757, '::1'),
(2020120217052807, '::1'),
(2020120217052866, '::1'),
(2020120217054646, '::1'),
(2020120217054709, '::1'),
(2020120217054752, '::1'),
(2020120217054774, '::1'),
(2020120217054833, '::1'),
(2020120217054889, '::1'),
(2020120217055224, '::1'),
(2020120217055445, '::1'),
(2020120217060467, '::1'),
(2020120217060968, '::1'),
(2020120217061074, '::1'),
(2020120217061336, '::1'),
(2020120217061440, '::1'),
(2020120217061485, '::1'),
(2020120217061527, '::1'),
(2020120217061567, '::1'),
(2020120217061602, '::1'),
(2020120217061643, '::1'),
(2020120217061681, '::1'),
(2020120217061719, '::1'),
(2020120217061754, '::1'),
(2020120217061795, '::1'),
(2020120217061832, '::1'),
(2020120217061867, '::1'),
(2020120217061899, '::1'),
(2020120217061932, '::1'),
(2020120217071166, '::1'),
(2020120217071243, '::1'),
(2020120217071311, '::1'),
(2020120217071352, '::1'),
(2020120217071410, '::1'),
(2020120217071492, '::1'),
(2020120217071588, '::1'),
(2020120217071660, '::1'),
(2020120217071725, '::1'),
(2020120217071804, '::1'),
(2020120217071872, '::1'),
(2020120217071976, '::1'),
(2020120217072047, '::1'),
(2020120217072115, '::1'),
(2020120217072206, '::1'),
(2020120217072287, '::1'),
(2020120217072362, '::1'),
(2020120217072435, '::1'),
(2020120217072513, '::1'),
(2020120217072584, '::1'),
(2020120217072668, '::1'),
(2020120217072742, '::1'),
(2020120217072829, '::1'),
(2020120217073501, '::1'),
(2020120217073573, '::1'),
(2020120217073646, '::1'),
(2020120217073708, '::1'),
(2020120217073769, '::1'),
(2020120217073819, '::1'),
(2020120217073867, '::1'),
(2020120217073921, '::1'),
(2020120217073970, '::1'),
(2020120217074019, '::1'),
(2020120217074075, '::1'),
(2020120217074133, '::1'),
(2020120217074182, '::1'),
(2020120217074227, '::1'),
(2020120217074261, '::1'),
(2020120217074305, '::1'),
(2020120217074354, '::1'),
(2020120217074418, '::1'),
(2020120217074485, '::1'),
(2020120217074548, '::1'),
(2020120217074608, '::1'),
(2020120217074669, '::1'),
(2020120217083355, '::1'),
(2020120217083429, '::1'),
(2020120217083523, '::1'),
(2020120217083582, '::1'),
(2020120217085145, '::1'),
(2020120217093449, '::1'),
(2020120217112877, '::1'),
(2020120217121121, '::1'),
(2020120217175679, '::1'),
(2020120217175758, '::1'),
(2020120217175873, '::1'),
(2020120217180723, '::1'),
(2020120217182546, '::1'),
(2020120217182717, '::1'),
(2020120217184149, '::1'),
(2020120217184254, '::1'),
(2020120217184370, '::1'),
(2020120217184500, '::1'),
(2020120217184644, '::1'),
(2020120217195394, '::1'),
(2020120217195536, '::1'),
(2020120217195842, '::1'),
(2020120217200073, '::1'),
(2020120217200172, '::1'),
(2020120217202164, '::1'),
(2020120217202337, '::1'),
(2020120217203860, '::1'),
(2020120217204931, '::1'),
(2020120217211195, '::1'),
(2020120217211774, '::1'),
(2020120217212540, '::1'),
(2020120217212610, '::1'),
(2020120217212694, '::1'),
(2020120217212818, '::1'),
(2020120217212886, '::1'),
(2020120217213131, '::1'),
(2020120217213417, '::1'),
(2020120217220693, '::1'),
(2020120217230249, '::1'),
(2020120217230331, '::1'),
(2020120217230476, '::1'),
(2020120217230566, '::1'),
(2020120217230687, '::1'),
(2020120217230787, '::1'),
(2020120217235215, '::1'),
(2020120217235365, '::1'),
(2020120217235509, '::1'),
(2020120217235622, '::1'),
(2020120217235725, '::1'),
(2020120217241017, '::1'),
(2020120217241127, '::1'),
(2020120217241250, '::1'),
(2020120217241575, '::1'),
(2020120217241634, '::1'),
(2020120217241731, '::1'),
(2020120217245744, '::1'),
(2020120217252528, '::1'),
(2020120217261458, '::1'),
(2020120217264323, '::1'),
(2020120217271359, '::1'),
(2020120217274453, '::1'),
(2020120217275142, '::1'),
(2020120217285055, '::1'),
(2020120217285327, '::1'),
(2020120217285540, '::1'),
(2020120217285567, '::1'),
(2020120217291171, '::1'),
(2020120217292033, '::1'),
(2020120217293652, '::1'),
(2020120217293835, '::1'),
(2020120217293862, '::1'),
(2020120217293881, '::1'),
(2020120217294021, '::1'),
(2020120217300346, '::1'),
(2020120217301833, '::1'),
(2020120217301902, '::1'),
(2020120217301925, '::1'),
(2020120217301946, '::1'),
(2020120217301972, '::1'),
(2020120217301989, '::1'),
(2020120217302066, '::1'),
(2020120217302093, '::1'),
(2020120217304064, '::1'),
(2020120217305881, '::1'),
(2020120217310427, '::1'),
(2020120217313442, '::1'),
(2020120217313933, '::1'),
(2020120217314037, '::1'),
(2020120217314193, '::1'),
(2020120217324968, '::1'),
(2020120217344045, '::1'),
(2020120217344186, '::1'),
(2020120217350635, '::1'),
(2020120217350708, '::1'),
(2020120217350882, '::1'),
(2020120217351459, '::1'),
(2020120217351616, '::1'),
(2020120217352115, '::1'),
(2020120217354141, '::1'),
(2020120217354367, '::1'),
(2020120217354451, '::1'),
(2020120217354491, '::1'),
(2020120217354502, '::1'),
(2020120217354536, '::1'),
(2020120217354552, '::1'),
(2020120217360910, '::1'),
(2020120217361037, '::1'),
(2020120217361201, '::1'),
(2020120217361307, '::1'),
(2020120217361439, '::1'),
(2020120217361531, '::1'),
(2020120217361679, '::1'),
(2020120217362017, '::1'),
(2020120217362866, '::1'),
(2020120217363039, '::1'),
(2020120217371451, '::1'),
(2020120217374437, '::1'),
(2020120217374527, '::1'),
(2020120217374895, '::1'),
(2020120217380395, '::1'),
(2020120217380519, '::1'),
(2020120217405588, '::1'),
(2020120217405850, '::1'),
(2020120217410458, '::1'),
(2020120217410590, '::1'),
(2020120217410801, '::1'),
(2020120217412485, '::1'),
(2020120217414181, '::1'),
(2020120217414997, '::1'),
(2020120217415101, '::1'),
(2020120217415188, '::1'),
(2020120217415292, '::1'),
(2020120217415425, '::1'),
(2020120217415541, '::1'),
(2020120217415705, '::1'),
(2020120217415929, '::1'),
(2020120217423727, '::1'),
(2020120217423940, '::1'),
(2020120217424756, '::1'),
(2020120217424948, '::1'),
(2020120217425019, '::1'),
(2020120217425098, '::1'),
(2020120217425122, '::1'),
(2020120217425146, '::1'),
(2020120217425163, '::1'),
(2020120217425178, '::1'),
(2020120217425196, '::1'),
(2020120217425218, '::1'),
(2020120217425238, '::1'),
(2020120217425256, '::1'),
(2020120217425279, '::1'),
(2020120217425296, '::1'),
(2020120217425311, '::1'),
(2020120217425331, '::1'),
(2020120217463096, '::1'),
(2020120217463208, '::1'),
(2020120217463389, '::1'),
(2020120217535982, '::1'),
(2020120217540095, '::1'),
(2020120217540336, '::1'),
(2020120217540931, '::1'),
(2020120217545683, '::1'),
(2020120217550144, '::1'),
(2020120217550528, '::1'),
(2020120217551070, '::1'),
(2020120218545240, '::1'),
(2020120218545312, '::1'),
(2020120218545563, '::1'),
(2020120218551628, '::1'),
(2020120218551787, '::1'),
(2020120218552393, '::1'),
(2020120219010583, '::1'),
(2020120219010698, '::1'),
(2020120219010835, '::1'),
(2020120219011239, '::1'),
(2020120219191001, '::1'),
(2020120219191797, '::1'),
(2020120219191959, '::1'),
(2020120310233537, '::1'),
(2020120310233727, '::1'),
(2020120310244179, '::1'),
(2020120310244549, '::1'),
(2020120310251511, '::1'),
(2020120310251774, '::1'),
(2020120310252842, '::1'),
(2020120310252964, '::1'),
(2020120310253082, '::1'),
(2020120310253456, '::1'),
(2020120310264566, '::1'),
(2020120310264809, '::1'),
(2020120310264940, '::1'),
(2020120310265106, '::1'),
(2020120310265220, '::1'),
(2020120310272250, '::1'),
(2020120310405400, '::1'),
(2020120315064523, '::1'),
(2020120315064550, '::1'),
(2020120315064561, '::1'),
(2020120315125847, '::1'),
(2020120315125984, '::1'),
(2020120315130210, '::1'),
(2020120315130985, '::1'),
(2020120315365363, '::1'),
(2020120315365532, '::1'),
(2020120315365778, '::1'),
(2020120315373531, '::1'),
(2020120315373695, '::1'),
(2020120315374628, '::1'),
(2020120315381364, '::1'),
(2020120315381490, '::1'),
(2020120315382201, '::1'),
(2020120315390729, '::1'),
(2020120315390824, '::1'),
(2020120315395661, '::1'),
(2020120315395755, '::1'),
(2020120315395865, '::1'),
(2020120315400599, '::1'),
(2020120315401246, '::1'),
(2020120315401387, '::1'),
(2020120315405932, '::1'),
(2020120315410711, '::1'),
(2020120315410838, '::1'),
(2020120315414676, '::1'),
(2020120315415031, '::1'),
(2020120315415152, '::1'),
(2020120315421201, '::1'),
(2020120315421455, '::1'),
(2020120315421557, '::1'),
(2020120315500062, '::1'),
(2020120315502585, '::1'),
(2020120316231234, '::1'),
(2020120316231421, '::1'),
(2020120316231527, '::1'),
(2020120316231673, '::1'),
(2020120316243862, '::1'),
(2020120316244529, '::1'),
(2020120316245631, '::1'),
(2020120316261573, '::1'),
(2020120316263348, '::1'),
(2020120316272697, '::1'),
(2020120316273848, '::1'),
(2020120316290291, '::1'),
(2020120316290801, '::1'),
(2020120316300002, '::1'),
(2020120316305156, '::1'),
(2020120316350749, '::1'),
(2020120316350945, '::1'),
(2020120316351621, '::1'),
(2020120316352428, '::1'),
(2020120316353731, '::1'),
(2020120316354340, '::1'),
(2020120316354993, '::1'),
(2020120316363329, '::1'),
(2020120316364116, '::1'),
(2020120316364581, '::1'),
(2020120316365113, '::1'),
(2020120316370119, '::1'),
(2020120316370723, '::1'),
(2020120316564861, '::1'),
(2020120316565024, '::1'),
(2020120316565677, '::1'),
(2020120316565815, '::1'),
(2020120316570287, '::1'),
(2020120316582443, '::1'),
(2020120316582711, '::1'),
(2020120316583520, '::1'),
(2020120316584178, '::1'),
(2020120317001126, '::1'),
(2020120317003447, '::1'),
(2020120317004714, '::1'),
(2020120317020426, '::1'),
(2020120317034281, '::1'),
(2020120317181762, '::1'),
(2020120317181904, '::1'),
(2020120317182714, '::1'),
(2020120317190347, '::1'),
(2020120317190924, '::1'),
(2020120317191399, '::1'),
(2020120317193224, '::1'),
(2020120317201315, '::1'),
(2020120317373078, '::1'),
(2020120317373229, '::1'),
(2020120317373366, '::1'),
(2020120317374236, '::1'),
(2020120317403198, '::1'),
(2020120317404233, '::1'),
(2020120317404444, '::1'),
(2020120317404602, '::1'),
(2020120317405074, '::1'),
(2020120317405857, '::1'),
(2020120317412027, '::1'),
(2020120317414036, '::1'),
(2020120317415669, '::1'),
(2020120410322287, '::1'),
(2020120410322507, '::1'),
(2020120410323501, '::1'),
(2020120410325525, '::1'),
(2020120410325774, '::1'),
(2020120410340266, '::1'),
(2020120410341660, '::1'),
(2020120410342301, '::1'),
(2020120410342475, '::1'),
(2020120410343446, '::1'),
(2020120410344035, '::1'),
(2020120410344108, '::1'),
(2020120410344152, '::1'),
(2020120410355061, '::1'),
(2020120410355125, '::1'),
(2020120410355164, '::1'),
(2020120410355980, '::1'),
(2020120410360221, '::1'),
(2020120410360392, '::1'),
(2020120410360475, '::1'),
(2020120410360513, '::1'),
(2020120410364206, '::1'),
(2020120410364284, '::1'),
(2020120410364401, '::1'),
(2020120410364463, '::1'),
(2020120410364501, '::1'),
(2020120410364544, '::1'),
(2020120410364579, '::1'),
(2020120410364600, '::1'),
(2020120410364619, '::1'),
(2020120410364675, '::1'),
(2020120410364712, '::1'),
(2020120410364748, '::1'),
(2020120410364783, '::1'),
(2020120410364834, '::1'),
(2020120410365233, '::1'),
(2020120410370957, '::1'),
(2020120410371953, '::1'),
(2020120410372670, '::1'),
(2020120410373325, '::1'),
(2020120410374142, '::1'),
(2020120410375913, '::1'),
(2020120410381622, '::1'),
(2020120410403585, '::1'),
(2020120410404551, '::1'),
(2020120410414577, '::1'),
(2020120410431449, '::1'),
(2020120410441640, '::1'),
(2020120410442251, '::1'),
(2020120410454273, '::1'),
(2020120410482315, '::1'),
(2020120410483000, '::1'),
(2020120410483872, '::1'),
(2020120410483994, '::1'),
(2020120410484537, '::1'),
(2020120410504265, '::1'),
(2020120410554054, '::1'),
(2020120410554775, '::1'),
(2020120410560839, '::1'),
(2020120410561853, '::1'),
(2020120410595454, '::1'),
(2020120411014355, '::1'),
(2020120411015103, '::1'),
(2020120411015931, '::1'),
(2020120411020893, '::1'),
(2020120411020963, '::1'),
(2020120411022908, '::1'),
(2020120411022991, '::1'),
(2020120411023040, '::1'),
(2020120411023952, '::1'),
(2020120411024591, '::1'),
(2020120411045333, '::1'),
(2020120411190100, '::1'),
(2020120411191655, '::1'),
(2020120411191916, '::1'),
(2020120411192089, '::1'),
(2020120411205353, '::1'),
(2020120411205647, '::1'),
(2020120411260179, '::1'),
(2020120411260203, '::1'),
(2020120411260217, '::1'),
(2020120411261706, '::1'),
(2020120411270474, '::1'),
(2020120411270904, '::1'),
(2020120411271017, '::1'),
(2020120411273654, '::1'),
(2020120411274174, '::1'),
(2020120411275705, '::1'),
(2020120411275888, '::1'),
(2020120411280148, '::1'),
(2020120411280413, '::1'),
(2020120411280579, '::1'),
(2020120411280749, '::1'),
(2020120411282482, '::1'),
(2020120411282807, '::1'),
(2020120411282927, '::1'),
(2020120411301144, '::1'),
(2020120411301810, '::1'),
(2020120411302027, '::1'),
(2020120411302181, '::1'),
(2020120411302355, '::1'),
(2020120411303395, '::1'),
(2020120411303469, '::1'),
(2020120411303645, '::1'),
(2020120411303769, '::1'),
(2020120411304110, '::1'),
(2020120411304349, '::1'),
(2020120411305005, '::1'),
(2020120411305367, '::1'),
(2020120411314482, '::1'),
(2020120411314687, '::1'),
(2020120411314947, '::1'),
(2020120411315077, '::1'),
(2020120411315184, '::1'),
(2020120411315309, '::1'),
(2020120411315431, '::1'),
(2020120411321118, '::1'),
(2020120411322590, '::1'),
(2020120411325550, '::1'),
(2020120411330178, '::1'),
(2020120411331583, '::1'),
(2020120411382418, '::1'),
(2020120411402847, '::1'),
(2020120411534662, '::1'),
(2020120412253974, '::1'),
(2020120412254140, '::1'),
(2020120412254635, '::1'),
(2020120412260694, '::1'),
(2020120412291640, '::1'),
(2020120412292002, '::1'),
(2020120412292417, '::1'),
(2020120413143153, '::1'),
(2020120413151062, '::1'),
(2020120413151360, '::1'),
(2020120413152731, '::1'),
(2020120413152911, '::1'),
(2020120413154231, '::1'),
(2020120413154567, '::1'),
(2020120413155306, '::1'),
(2020120413260337, '::1'),
(2020120413260451, '::1'),
(2020120413260934, '::1'),
(2020120413314515, '::1'),
(2020120413314692, '::1'),
(2020120413314815, '::1'),
(2020120413321069, '::1'),
(2020120413344062, '::1'),
(2020120413425107, '::1'),
(2020120413435570, '::1'),
(2020120413445663, '::1'),
(2020120413445817, '::1'),
(2020120413450271, '::1'),
(2020120413481081, '::1'),
(2020120413481839, '::1'),
(2020120413553241, '::1'),
(2020120413554689, '::1'),
(2020120414145454, '::1'),
(2020120414180616, '::1'),
(2020120414180724, '::1'),
(2020120414180740, '::1'),
(2020120414180815, '::1'),
(2020120414181458, '::1'),
(2020120414182464, '::1'),
(2020120414182741, '::1'),
(2020120414303855, '::1'),
(2020120414303960, '::1'),
(2020120414304993, '::1'),
(2020120414335697, '::1'),
(2020120414351518, '::1'),
(2020120414352097, '::1'),
(2020120414352593, '::1'),
(2020120414451565, '::1'),
(2020120414451672, '::1'),
(2020120414452089, '::1'),
(2020120414472834, '::1'),
(2020120415080775, '::1'),
(2020120415080788, '::1'),
(2020120415111561, '::1'),
(2020120415111801, '::1'),
(2020120415112450, '::1'),
(2020120415112492, '::1'),
(2020120415112535, '::1'),
(2020120415112579, '::1'),
(2020120415112625, '::1'),
(2020120415112661, '::1'),
(2020120415114002, '::1'),
(2020120415114095, '::1'),
(2020120415114181, '::1'),
(2020120415134495, '::1'),
(2020120415174333, '::1'),
(2020120415174855, '::1'),
(2020120415175069, '::1'),
(2020120415190746, '::1'),
(2020120415191269, '::1'),
(2020120415191738, '::1'),
(2020120415192315, '::1'),
(2020120415192456, '::1'),
(2020120415194252, '::1'),
(2020120415205008, '::1'),
(2020120415213505, '::1'),
(2020120415215579, '::1'),
(2020120415221189, '::1'),
(2020120415221323, '::1'),
(2020120415222117, '::1'),
(2020120415423813, '::1'),
(2020120415423911, '::1'),
(2020120415424432, '::1'),
(2020120415583800, '::1'),
(2020120416011693, '::1'),
(2020120416012181, '::1'),
(2020120416013756, '::1'),
(2020120416022143, '::1'),
(2020120416023043, '::1'),
(2020120416025052, '::1'),
(2020120416042949, '::1'),
(2020120416122363, '::1'),
(2020120416124135, '::1'),
(2020120416144853, '::1'),
(2020120416150127, '::1'),
(2020120416275174, '::1'),
(2020120416281595, '::1'),
(2020120416440130, '::1'),
(2020120416440718, '::1'),
(2020120416443644, '::1'),
(2020120416453902, '::1'),
(2020120416454348, '::1'),
(2020120416454752, '::1'),
(2020120416454912, '::1'),
(2020120416461524, '::1'),
(2020120417031897, '::1'),
(2020120417031911, '::1'),
(2020120417033436, '::1'),
(2020120417040992, '::1'),
(2020120417041618, '::1'),
(2020120417085987, '::1'),
(2020120417094589, '::1'),
(2020120417110146, '::1'),
(2020120417110745, '::1'),
(2020120417113223, '::1'),
(2020120417152352, '::1'),
(2020120417152857, '::1'),
(2020120417153273, '::1'),
(2020120417183277, '::1'),
(2020120417183748, '::1'),
(2020120417235642, '::1'),
(2020120417235750, '::1'),
(2020120417255073, '::1'),
(2020120417260099, '::1'),
(2020120418030008, '::1'),
(2020120418030338, '::1'),
(2020120418030969, '::1'),
(2020120418031154, '::1'),
(2020120418031576, '::1'),
(2020120418031685, '::1'),
(2020120418253478, '::1'),
(2020120418253897, '::1'),
(2020120418262007, '::1'),
(2020120418262217, '::1'),
(2020120418270052, '::1'),
(2020120418284501, '::1'),
(2020120708330135, '::1'),
(2020120708334217, '::1'),
(2020120708334911, '::1'),
(2020120708335093, '::1'),
(2020120708341330, '::1'),
(2020120708341431, '::1'),
(2020120708341986, '::1'),
(2020120708353833, '::1'),
(2020120708354090, '::1'),
(2020120708355768, '::1'),
(2020120708411269, '::1'),
(2020120708411347, '::1'),
(2020120708414479, '::1'),
(2020120708414522, '::1'),
(2020120708422638, '::1'),
(2020120708422658, '::1'),
(2020120708422680, '::1'),
(2020120708435410, '::1'),
(2020120708444934, '::1'),
(2020120708450664, '::1'),
(2020120708452797, '::1'),
(2020120708455065, '::1'),
(2020120708455390, '::1'),
(2020120708461941, '::1'),
(2020120708462304, '::1'),
(2020120708542651, '::1'),
(2020120708560381, '::1'),
(2020120708563012, '::1'),
(2020120708571775, '::1'),
(2020120709084222, '::1'),
(2020120709132450, '::1'),
(2020120709134517, '::1'),
(2020120709145758, '::1'),
(2020120709553081, '::1'),
(2020120709561598, '::1'),
(2020120709573107, '::1'),
(2020120709581884, '::1'),
(2020120709585647, '::1'),
(2020120709594664, '::1'),
(2020120709595850, '::1'),
(2020120710002242, '::1'),
(2020120710010192, '::1'),
(2020120710330257, '::1'),
(2020120710364823, '::1'),
(2020120710390689, '::1'),
(2020120710423871, '::1'),
(2020120710435038, '::1'),
(2020120710440230, '::1'),
(2020120710445092, '::1'),
(2020120710445257, '::1'),
(2020120710451795, '::1'),
(2020120710453117, '::1'),
(2020120710455646, '::1'),
(2020120710470808, '::1'),
(2020120711242239, '::1'),
(2020120711255903, '::1'),
(2020120711264622, '::1'),
(2020120711265594, '::1'),
(2020120711270159, '::1'),
(2020120711272459, '::1'),
(2020120711272587, '::1'),
(2020120711273283, '::1'),
(2020120711273900, '::1'),
(2020120711275305, '::1'),
(2020120711280273, '::1'),
(2020120711282098, '::1'),
(2020120711282126, '::1'),
(2020120711292142, '::1'),
(2020120711292638, '::1'),
(2020120711293529, '::1'),
(2020120711373557, '::1'),
(2020120711400740, '::1'),
(2020120711403026, '::1'),
(2020120711403116, '::1'),
(2020120711403178, '::1'),
(2020120711403242, '::1'),
(2020120711440054, '::1'),
(2020120711442190, '::1'),
(2020120711452469, '::1'),
(2020120711465796, '::1'),
(2020120711473137, '::1'),
(2020120711474130, '::1'),
(2020120711475835, '::1'),
(2020120711484649, '::1'),
(2020120711485548, '::1'),
(2020120711491254, '::1'),
(2020120711492958, '::1'),
(2020120711500414, '::1'),
(2020120711505599, '::1'),
(2020120711511058, '::1'),
(2020120711511417, '::1'),
(2020120711511447, '::1'),
(2020120711511462, '::1'),
(2020120711512295, '::1'),
(2020120711515889, '::1'),
(2020120711521997, '::1'),
(2020120711523830, '::1'),
(2020120711523898, '::1'),
(2020120711523916, '::1'),
(2020120711533815, '::1'),
(2020120711535219, '::1'),
(2020120711541880, '::1'),
(2020120711543690, '::1'),
(2020120711552988, '::1'),
(2020120711564753, '::1'),
(2020120711570957, '::1'),
(2020120711595077, '::1'),
(2020120712010529, '::1'),
(2020120712015383, '::1'),
(2020120712032146, '::1'),
(2020120712033040, '::1'),
(2020120712035449, '::1'),
(2020120712052834, '::1'),
(2020120712063886, '::1'),
(2020120712070516, '::1'),
(2020120712081541, '::1'),
(2020120712085251, '::1'),
(2020120712085747, '::1'),
(2020120712102270, '::1'),
(2020120712104471, '::1'),
(2020120712110309, '::1'),
(2020120712113857, '::1'),
(2020120712122384, '::1'),
(2020120712135226, '::1'),
(2020120712153687, '::1'),
(2020120712154787, '::1'),
(2020120712162130, '::1'),
(2020120712170527, '::1'),
(2020120712171577, '::1'),
(2020120712173226, '::1'),
(2020120712185549, '::1'),
(2020120712191228, '::1'),
(2020120712212554, '::1'),
(2020120712221171, '::1'),
(2020120712232856, '::1'),
(2020120712241154, '::1'),
(2020120712245965, '::1'),
(2020120712251628, '::1'),
(2020120712270268, '::1'),
(2020120712271910, '::1'),
(2020120712274523, '::1'),
(2020120712300636, '::1'),
(2020120712300764, '::1'),
(2020120712300786, '::1'),
(2020120712300809, '::1'),
(2020120712300827, '::1'),
(2020120712305264, '::1'),
(2020120712322567, '::1'),
(2020120713312506, '::1'),
(2020120713321942, '::1'),
(2020120713322916, '::1'),
(2020120713324803, '::1'),
(2020120713394019, '::1'),
(2020120713394047, '::1'),
(2020120713453588, '::1'),
(2020120713454615, '::1'),
(2020120713462204, '::1'),
(2020120713492911, '::1'),
(2020120713495419, '::1'),
(2020120713564406, '::1'),
(2020120714002580, '::1'),
(2020120714004742, '::1'),
(2020120714015162, '::1'),
(2020120714045876, '::1'),
(2020120714060016, '::1'),
(2020120714064163, '::1'),
(2020120714070918, '::1'),
(2020120714075300, '::1'),
(2020120714084322, '::1'),
(2020120714085728, '::1'),
(2020120714093902, '::1'),
(2020120714100840, '::1'),
(2020120714101247, '::1'),
(2020120714104708, '::1'),
(2020120714130651, '::1'),
(2020120714203763, '::1'),
(2020120714210138, '::1'),
(2020120714223713, '::1'),
(2020120718551697, '::1'),
(2020120718571431, '::1'),
(2020120718571863, '::1'),
(2020120718572464, '::1'),
(2020120722511735, '::1'),
(2020120811315086, '::1'),
(2020120813292188, '::1'),
(2020120815190481, '::1'),
(2020120815421420, '::1'),
(2020120815421639, '::1'),
(2020120816031025, '::1'),
(2020120816041802, '::1'),
(2020120816254645, '::1'),
(2020121010173922, '::1'),
(2020121014214525, '::1'),
(2020121014353129, '::1'),
(2020121014365588, '::1'),
(2020121014370324, '::1'),
(2020121014370484, '::1'),
(2020121014370613, '::1'),
(2020121014375573, '::1'),
(2020121014394676, '::1'),
(2020121016280245, '::1'),
(2020121016282201, '::1'),
(2020121016283785, '::1'),
(2020121016284874, '::1'),
(2020121016285257, '::1'),
(2020121016310373, '::1'),
(2020121016310468, '::1'),
(2020121016310635, '::1'),
(2020121016310721, '::1'),
(2020121016344474, '::1'),
(2020121016351044, '::1'),
(2020121016360542, '::1'),
(2020121016364890, '::1'),
(2020121016365837, '::1'),
(2020121016371187, '::1'),
(2020121016373781, '::1'),
(2020121016381321, '::1'),
(2020121101523541, '::1'),
(2020121101530845, '::1'),
(2020121102374614, '::1'),
(2020121102380882, '::1'),
(2020121102381855, '::1'),
(2020121102382952, '::1'),
(2020121110532103, '::1'),
(2020121112181203, '::1'),
(2020121112183164, '::1'),
(2020121112183405, '::1'),
(2020121112184182, '::1'),
(2020121112185341, '::1'),
(2020121112275106, '::1'),
(2020121113363035, '::1'),
(2020121113382292, '::1'),
(2020121113393642, '::1'),
(2020121113394269, '::1'),
(2020121114324456, '::1'),
(2020121114325027, '::1'),
(2020121114325373, '::1'),
(2020121114335200, '::1'),
(2020121114341432, '::1'),
(2020121114341569, '::1'),
(2020121114351029, '::1'),
(2020121114364671, '::1'),
(2020121114371679, '::1'),
(2020121114371768, '::1'),
(2020121114372124, '::1'),
(2020121114374183, '::1'),
(2020121114374843, '::1'),
(2020121114383048, '::1'),
(2020121114383192, '::1'),
(2020121114383239, '::1'),
(2020121114383279, '::1'),
(2020121114383359, '::1'),
(2020121114383572, '::1'),
(2020121114385699, '::1'),
(2020121114385982, '::1'),
(2020121114390275, '::1'),
(2020121114391115, '::1'),
(2020121114391685, '::1'),
(2020121114392011, '::1'),
(2020121114413712, '::1'),
(2020121114415029, '::1'),
(2020121114415254, '::1'),
(2020121114415394, '::1'),
(2020121114415544, '::1'),
(2020121114415726, '::1'),
(2020121114415899, '::1'),
(2020121114420126, '::1'),
(2020121114431428, '::1'),
(2020121114431499, '::1'),
(2020121114431523, '::1'),
(2020121114431543, '::1'),
(2020121114431560, '::1'),
(2020121114431580, '::1'),
(2020121114431598, '::1'),
(2020121114431616, '::1'),
(2020121114431636, '::1'),
(2020121114432157, '::1'),
(2020121114434389, '::1'),
(2020121114444488, '::1'),
(2020121114463455, '::1'),
(2020121114492805, '::1'),
(2020121114515527, '::1'),
(2020121114531088, '::1'),
(2020121114570885, '::1'),
(2020121114593026, '::1'),
(2020121115002437, '::1'),
(2020121115010823, '::1'),
(2020121115010879, '::1'),
(2020121115020268, '::1'),
(2020121115312118, '::1'),
(2020121115313026, '::1'),
(2020121115435374, '::1'),
(2020121117042669, '::1'),
(2020121117101103, '::1'),
(2020121117484504, '::1'),
(2020121117484512, '::1'),
(2020121118274892, '::1'),
(2020121322380174, '::1'),
(2020121322380350, '::1'),
(2020121322380570, '::1'),
(2020121322380763, '::1'),
(2020121322392076, '::1'),
(2020121322415268, '::1'),
(2020121400433594, '::1'),
(2020121410030650, '::1'),
(2020121410455485, '::1'),
(2020121410483412, '::1'),
(2020121410504717, '::1'),
(2020121410513203, '::1'),
(2020121411114143, '::1'),
(2020121411115054, '::1'),
(2020121411140446, '::1'),
(2020121411140614, '::1'),
(2020121411213863, '::1'),
(2020121411232767, '::1'),
(2020121411240373, '::1'),
(2020121411240694, '::1'),
(2020121411240772, '::1'),
(2020121411240834, '::1'),
(2020121411242130, '::1'),
(2020121411243723, '::1'),
(2020121411243765, '::1'),
(2020121411243786, '::1'),
(2020121411243802, '::1'),
(2020121411243818, '::1'),
(2020121411244087, '::1'),
(2020121411244143, '::1'),
(2020121411244164, '::1'),
(2020121411244185, '::1'),
(2020121411244208, '::1'),
(2020121411244222, '::1'),
(2020121411245118, '::1'),
(2020121411255523, '::1'),
(2020121411262399, '::1'),
(2020121411325645, '::1'),
(2020121411484675, '::1'),
(2020121411541063, '::1'),
(2020121411545564, '::1'),
(2020121411552514, '::1'),
(2020121411554542, '::1'),
(2020121411573591, '::1'),
(2020121411581305, '::1'),
(2020121411590715, '::1'),
(2020121412081692, '::1'),
(2020121413294324, '::1'),
(2020121413500539, '::1'),
(2020121413501487, '::1'),
(2020121413523123, '::1'),
(2020121414402280, '::1'),
(2020121414423102, '::1'),
(2020121414423453, '::1'),
(2020121414423878, '::1'),
(2020121517421504, '::1'),
(2020121517423027, '::1'),
(2020121517424617, '::1'),
(2020121517431046, '::1'),
(2020121517445420, '::1'),
(2020121610255547, '::1'),
(2020121610262894, '::1'),
(2020121610264406, '::1'),
(2020121610382751, '::1'),
(2020121610391551, '::1'),
(2020121610434082, '::1'),
(2020121610434691, '::1'),
(2020121610482069, '::1'),
(2020121610512241, '::1'),
(2020121610524040, '::1'),
(2020121610561233, '::1'),
(2020121610562856, '::1'),
(2020121610575836, '::1'),
(2020121610581162, '::1'),
(2020121610585768, '::1'),
(2020121610585856, '::1'),
(2020121610590950, '::1'),
(2020121610591027, '::1'),
(2020121611014246, '::1'),
(2020121611014317, '::1'),
(2020121611014456, '::1'),
(2020121611022544, '::1'),
(2020121611022606, '::1'),
(2020121611022725, '::1'),
(2020121611024956, '::1'),
(2020121611025010, '::1'),
(2020121611040352, '::1'),
(2020121611040451, '::1'),
(2020121611054868, '::1'),
(2020121611054936, '::1'),
(2020121611055431, '::1'),
(2020121611064505, '::1'),
(2020121611071725, '::1'),
(2020121611120757, '::1'),
(2020121611121036, '::1'),
(2020121611123324, '::1'),
(2020121611123910, '::1'),
(2020121611132746, '::1'),
(2020121611134183, '::1'),
(2020121611134371, '::1'),
(2020121611143082, '::1'),
(2020121611151007, '::1'),
(2020121611151908, '::1'),
(2020121611185742, '::1'),
(2020121611232794, '::1'),
(2020121611233147, '::1'),
(2020121611233485, '::1'),
(2020121611412036, '::1'),
(2020121611412264, '::1'),
(2020121611414873, '::1'),
(2020121611591345, '::1'),
(2020121611591462, '::1'),
(2020121612004999, '::1'),
(2020121612290365, '::1'),
(2020121612294241, '::1'),
(2020121612294534, '::1'),
(2020121614133427, '::1'),
(2020121614145777, '::1'),
(2020121614150119, '::1'),
(2020121614152744, '::1'),
(2020121614244711, '::1'),
(2020121614303178, '::1'),
(2020121614303255, '::1'),
(2020121614303389, '::1'),
(2020121614313542, '::1'),
(2020121614313760, '::1'),
(2020121614322338, '::1'),
(2020121614324574, '::1'),
(2020121614324607, '::1'),
(2020121614324624, '::1'),
(2020121614324630, '::1'),
(2020121614324649, '::1'),
(2020121614324783, '::1'),
(2020121614324806, '::1'),
(2020121614324817, '::1'),
(2020121614325745, '::1'),
(2020121614334946, '::1'),
(2020121614334998, '::1'),
(2020121614354120, '::1'),
(2020121614354179, '::1'),
(2020121614355632, '::1'),
(2020121614365200, '::1'),
(2020121614365421, '::1'),
(2020121615243899, '::1'),
(2020121615310608, '::1'),
(2020121615321227, '::1'),
(2020121615325603, '::1'),
(2020121615333762, '::1'),
(2020121615334146, '::1'),
(2020121615334609, '::1'),
(2020121615335000, '::1'),
(2020121615363015, '::1'),
(2020121615373715, '::1'),
(2020121615374291, '::1'),
(2020121615380944, '::1'),
(2020121615391211, '::1'),
(2020121615394411, '::1'),
(2020121615413222, '::1'),
(2020121615424617, '::1'),
(2020121615430676, '::1'),
(2020121615545349, '::1'),
(2020121616045753, '::1'),
(2020121616070674, '::1'),
(2020121616072244, '::1'),
(2020121616073640, '::1'),
(2020121616075119, '::1'),
(2020121616083726, '::1'),
(2020121616090476, '::1'),
(2020121616090533, '::1'),
(2020121616091277, '::1'),
(2020121616091350, '::1'),
(2020121616092723, '::1'),
(2020121616092806, '::1'),
(2020121616094901, '::1'),
(2020121616095663, '::1'),
(2020121616095731, '::1'),
(2020121616095821, '::1'),
(2020121616100333, '::1'),
(2020121616100951, '::1'),
(2020121616105249, '::1'),
(2020121616110759, '::1'),
(2020121616115866, '::1'),
(2020121616120209, '::1'),
(2020121616121690, '::1'),
(2020121616121955, '::1'),
(2020121616122915, '::1'),
(2020121616123385, '::1'),
(2020121616124144, '::1'),
(2020121616125031, '::1'),
(2020121616125803, '::1'),
(2020121616131907, '::1'),
(2020121616142614, '::1'),
(2020121616144839, '::1'),
(2020121616150572, '::1'),
(2020121616150666, '::1'),
(2020121616155772, '::1'),
(2020121616171843, '::1'),
(2020121616172472, '::1'),
(2020121616192799, '::1'),
(2020121616194969, '::1'),
(2020121616195970, '::1'),
(2020121616201234, '::1'),
(2020121616201314, '::1'),
(2020121616205882, '::1'),
(2020121616211794, '::1'),
(2020121616214674, '::1'),
(2020121616232488, '::1'),
(2020121616234588, '::1'),
(2020121616252869, '::1'),
(2020121616260739, '::1'),
(2020121616263295, '::1'),
(2020121616265375, '::1'),
(2020121616273967, '::1'),
(2020121616275577, '::1'),
(2020121616275780, '::1'),
(2020121711075826, '::1'),
(2020121711083440, '::1'),
(2020121711132679, '::1'),
(2020121711133038, '::1'),
(2020121711141041, '::1'),
(2020121711150794, '::1'),
(2020121716055803, '::1'),
(2020121718122815, '::1'),
(2020121718131378, '::1'),
(2020121718143529, '::1'),
(2020121810355580, '::1'),
(2020121811340699, '::1'),
(2020121812124175, '::1'),
(2020121812125122, '::1'),
(2020121812272911, '::1'),
(2020121812273174, '::1'),
(2020121812273611, '::1'),
(2020121812333226, '::1'),
(2020121812333767, '::1'),
(2020121812334022, '::1'),
(2020121812344023, '::1'),
(2020121812351124, '::1'),
(2020121812414526, '::1'),
(2020121812430981, '::1'),
(2020121812504751, '::1'),
(2020121814045908, '::1'),
(2020121814050312, '::1'),
(2020121814050357, '::1'),
(2020121814050372, '::1'),
(2020121814050391, '::1'),
(2020121814051312, '::1'),
(2020121814051384, '::1'),
(2020121814052223, '::1'),
(2020121814052663, '::1'),
(2020121814053159, '::1'),
(2020121814055752, '::1'),
(2020121814072841, '::1'),
(2020121814074731, '::1'),
(2020121814080308, '::1'),
(2020121814080398, '::1'),
(2020121814081450, '::1'),
(2020121814173439, '::1'),
(2020121814173525, '::1'),
(2020121814180546, '::1'),
(2020121814182920, '::1'),
(2020121814191154, '::1'),
(2020121814193486, '::1'),
(2020121814231361, '::1'),
(2020121815191180, '::1'),
(2020121815194194, '::1'),
(2020121815210863, '::1'),
(2020121815210944, '::1'),
(2020121815212034, '::1'),
(2020121815215096, '::1'),
(2020121815215603, '::1'),
(2020121815223861, '::1'),
(2020121815223916, '::1'),
(2020121815260123, '::1'),
(2020121815262869, '::1'),
(2020121815262933, '::1'),
(2020121815273485, '::1'),
(2020121815293248, '::1'),
(2020121815294193, '::1'),
(2020121815295274, '::1'),
(2020121815302853, '::1'),
(2020121815310001, '::1'),
(2020121815311328, '::1'),
(2020121815313120, '::1'),
(2020121815335415, '::1'),
(2020121815384516, '::1'),
(2020121815384592, '::1'),
(2020121815390560, '::1'),
(2020121815400853, '::1'),
(2020121815400934, '::1'),
(2020121815401366, '::1'),
(2020121815405212, '::1'),
(2020121815410319, '::1'),
(2020121815411142, '::1'),
(2020121815415908, '::1'),
(2020121815422295, '::1'),
(2020121815424661, '::1'),
(2020121815425716, '::1'),
(2020121815431719, '::1'),
(2020121815432699, '::1'),
(2020121816012688, '::1'),
(2020121816021904, '::1'),
(2020121816053842, '::1'),
(2020121816055170, '::1'),
(2020121816120128, '::1'),
(2020121816130471, '::1'),
(2020121816141071, '::1'),
(2020121816145274, '::1'),
(2020121816160954, '::1'),
(2020121816163493, '::1'),
(2020121816173724, '::1'),
(2020121816183250, '::1'),
(2020121816331043, '::1'),
(2020121816340377, '::1'),
(2020121816342981, '::1'),
(2020121816344463, '::1'),
(2020121816351111, '::1'),
(2020121816401499, '::1'),
(2020121816422321, '::1'),
(2020121816465723, '::1'),
(2020121816465771, '::1'),
(2020121816494843, '::1'),
(2020121816500061, '::1'),
(2020121816555851, '::1'),
(2020121816561559, '::1'),
(2020121816574828, '::1'),
(2020121817041422, '::1'),
(2020121817092664, '::1'),
(2020121817092972, '::1'),
(2020121817095887, '::1'),
(2020121817140900, '::1'),
(2020121817165837, '::1'),
(2020121817170000, '::1'),
(2020121817172819, '::1'),
(2020121817173573, '::1'),
(2020121817173826, '::1'),
(2020121817174253, '::1'),
(2020121817193858, '::1'),
(2020121817194288, '::1'),
(2020121817223181, '::1'),
(2020121817232883, '::1'),
(2020121817261251, '::1'),
(2020121817264481, '::1'),
(2020121817280455, '::1'),
(2020121817304539, '::1'),
(2020121817310510, '::1'),
(2020121817313850, '::1'),
(2020121817335629, '::1'),
(2020121817341284, '::1'),
(2020121817351510, '::1'),
(2020121817370493, '::1'),
(2020121817390402, '::1'),
(2020121817412901, '::1'),
(2020121817430256, '::1'),
(2020121817432420, '::1'),
(2020121817443007, '::1'),
(2020121817445390, '::1'),
(2020121817454691, '::1'),
(2020121817461783, '::1'),
(2020121817475055, '::1'),
(2020121817480576, '::1'),
(2020121817483960, '::1'),
(2020121817485670, '::1'),
(2020121817490979, '::1'),
(2020121817493920, '::1'),
(2020121817494442, '::1'),
(2020121817495664, '::1'),
(2020121817495901, '::1'),
(2020121817500993, '::1'),
(2020121817513846, '::1'),
(2020121817514819, '::1'),
(2020121817520805, '::1'),
(2020121817523509, '::1'),
(2020121817535561, '::1'),
(2020121817535652, '::1');
INSERT INTO `g5_uniqid` (`uq_id`, `uq_ip`) VALUES
(2020121817554430, '::1'),
(2020121817572322, '::1'),
(2020121817582733, '::1'),
(2020121818042164, '::1'),
(2020121818234912, '::1'),
(2020121818253546, '::1'),
(2020121818254030, '::1'),
(2020121818254106, '::1'),
(2020121818264050, '::1'),
(2020121818270200, '::1'),
(2020121818273789, '::1'),
(2020121818285664, '::1'),
(2020121818302739, '::1'),
(2020121818332943, '::1'),
(2020121818344438, '::1'),
(2020121818352439, '::1'),
(2020121818384831, '::1'),
(2020121818385069, '::1'),
(2020121818385803, '::1'),
(2020121818392184, '::1'),
(2020121818392389, '::1'),
(2020121818393501, '::1'),
(2020121818394844, '::1'),
(2020121818395067, '::1'),
(2020121818395601, '::1'),
(2020121818400756, '::1'),
(2020121818403746, '::1'),
(2020121818404793, '::1'),
(2020121818404972, '::1'),
(2020121818405331, '::1'),
(2020121818410088, '::1'),
(2020121818410770, '::1'),
(2020121818411676, '::1'),
(2020121818412111, '::1'),
(2020121818413127, '::1'),
(2020121818415762, '::1'),
(2020121818420695, '::1'),
(2020121818425487, '::1'),
(2020121818430099, '::1'),
(2020121818441968, '::1'),
(2020121818451896, '::1'),
(2020121818461365, '::1'),
(2020121818461685, '::1'),
(2020121818472957, '::1'),
(2020121818485622, '::1'),
(2020121818492914, '::1'),
(2020121818535887, '::1'),
(2020121818540178, '::1'),
(2020122020011117, '::1'),
(2020122020011669, '::1'),
(2020122020011763, '::1'),
(2020122021281450, '::1'),
(2020122021301775, '::1'),
(2020122021302869, '::1'),
(2020122021303243, '::1'),
(2020122021320042, '::1'),
(2020122021354611, '::1'),
(2020122021354738, '::1'),
(2020122021355033, '::1'),
(2020122021361869, '::1'),
(2020122021371471, '::1'),
(2020122021403082, '::1'),
(2020122021403611, '::1'),
(2020122021411648, '::1'),
(2020122021412441, '::1'),
(2020122021423343, '::1'),
(2020122021423918, '::1'),
(2020122021425782, '::1'),
(2020122021462080, '::1'),
(2020122021465148, '::1'),
(2020122021465241, '::1'),
(2020122021465406, '::1'),
(2020122021470723, '::1'),
(2020122021470796, '::1'),
(2020122021472282, '::1'),
(2020122021472347, '::1'),
(2020122021473553, '::1'),
(2020122021483708, '::1'),
(2020122021484448, '::1'),
(2020122021490583, '::1'),
(2020122021501653, '::1'),
(2020122021504661, '::1'),
(2020122021505056, '::1'),
(2020122021514334, '::1'),
(2020122021551886, '::1'),
(2020122021552945, '::1'),
(2020122021561722, '::1'),
(2020122021563535, '::1'),
(2020122021565691, '::1'),
(2020122021571209, '::1'),
(2020122021572599, '::1'),
(2020122021583028, '::1'),
(2020122021584243, '::1'),
(2020122022000281, '::1'),
(2020122022003965, '::1'),
(2020122022005481, '::1'),
(2020122022032546, '::1'),
(2020122022034009, '::1'),
(2020122022035383, '::1'),
(2020122022040610, '::1'),
(2020122022041247, '::1'),
(2020122022043760, '::1'),
(2020122022044162, '::1'),
(2020122022051999, '::1'),
(2020122022052041, '::1'),
(2020122022053009, '::1'),
(2020122022053971, '::1'),
(2020122022054342, '::1'),
(2020122022072001, '::1'),
(2020122022072305, '::1'),
(2020122022251253, '::1'),
(2020122022323281, '::1'),
(2020122022344090, '::1'),
(2020122022345247, '::1'),
(2020122022345766, '::1'),
(2020122022510217, '::1'),
(2020122022513159, '::1'),
(2020122022551107, '::1'),
(2020122023014666, '::1'),
(2020122100383567, '::1'),
(2020122100405402, '::1'),
(2020122100410403, '::1'),
(2020122100410458, '::1'),
(2020122100411670, '::1'),
(2020122100413144, '::1'),
(2020122100413813, '::1'),
(2020122100423215, '::1'),
(2020122100423549, '::1'),
(2020122100454562, '::1'),
(2020122100464295, '::1'),
(2020122100465636, '::1'),
(2020122100502135, '::1'),
(2020122101023323, '::1'),
(2020122101033261, '::1'),
(2020122101040243, '::1'),
(2020122101041155, '::1'),
(2020122101041910, '::1'),
(2020122101053121, '::1'),
(2020122101054726, '::1'),
(2020122101064541, '::1'),
(2020122101065121, '::1'),
(2020122101081026, '::1'),
(2020122101092146, '::1'),
(2020122101092485, '::1'),
(2020122101101636, '::1'),
(2020122101105096, '::1'),
(2020122101105182, '::1'),
(2020122101105996, '::1'),
(2020122101114618, '::1'),
(2020122101115019, '::1'),
(2020122101115077, '::1'),
(2020122101120198, '::1'),
(2020122101120276, '::1'),
(2020122101121305, '::1'),
(2020122101121417, '::1'),
(2020122101123686, '::1'),
(2020122101123782, '::1'),
(2020122101125799, '::1'),
(2020122101131670, '::1'),
(2020122101131777, '::1'),
(2020122101135456, '::1'),
(2020122101140272, '::1'),
(2020122101143766, '::1'),
(2020122101192995, '::1'),
(2020122101194005, '::1'),
(2020122101201691, '::1'),
(2020122101202088, '::1'),
(2020122101203871, '::1'),
(2020122101211311, '::1'),
(2020122101213870, '::1'),
(2020122101231019, '::1'),
(2020122101231508, '::1'),
(2020122101231945, '::1'),
(2020122101233103, '::1'),
(2020122101243053, '::1'),
(2020122101244653, '::1'),
(2020122101255447, '::1'),
(2020122101260047, '::1'),
(2020122101260806, '::1'),
(2020122101262704, '::1'),
(2020122101265326, '::1'),
(2020122101265940, '::1'),
(2020122101425996, '::1'),
(2020122101430325, '::1'),
(2020122102284364, '::1'),
(2020122102285709, '::1'),
(2020122102455381, '::1'),
(2020122102524869, '::1'),
(2020122103511190, '::1'),
(2020122103511513, '::1'),
(2020122103521030, '::1'),
(2020122103521650, '::1'),
(2020122103523299, '::1'),
(2020122103523622, '::1'),
(2020122103524532, '::1'),
(2020122103540494, '::1'),
(2020122103541449, '::1'),
(2020122103541838, '::1'),
(2020122103542151, '::1'),
(2020122103542442, '::1'),
(2020122103550600, '::1'),
(2020122103553742, '::1'),
(2020122103570868, '::1'),
(2020122103571010, '::1'),
(2020122103573271, '::1'),
(2020122103573352, '::1'),
(2020122103574978, '::1'),
(2020122104014328, '::1'),
(2020122104014411, '::1'),
(2020122104014481, '::1'),
(2020122104052885, '::1'),
(2020122104053154, '::1'),
(2020122104053355, '::1'),
(2020122104053513, '::1'),
(2020122104120060, '::1'),
(2020122104122661, '::1'),
(2020122104133034, '::1'),
(2020122104133779, '::1'),
(2020122110073487, '::1'),
(2020122110073848, '::1'),
(2020122110291397, '::1'),
(2020122110291614, '::1'),
(2020122110291828, '::1'),
(2020122110292114, '::1'),
(2020122110292561, '::1'),
(2020122110325179, '::1'),
(2020122110325290, '::1'),
(2020122110325639, '::1'),
(2020122110325865, '::1'),
(2020122112240465, '::1'),
(2020122112253240, '::1'),
(2020122112260511, '::1'),
(2020122112260805, '::1'),
(2020122112261229, '::1'),
(2020122112264291, '::1'),
(2020122112290999, '::1'),
(2020122112291960, '::1'),
(2020122112304506, '::1'),
(2020122112304595, '::1'),
(2020122112304799, '::1'),
(2020122112310499, '::1'),
(2020122112321687, '::1'),
(2020122112323874, '::1'),
(2020122112323976, '::1'),
(2020122112333146, '::1'),
(2020122112334963, '::1'),
(2020122112335052, '::1'),
(2020122112335253, '::1'),
(2020122112341224, '::1'),
(2020122112341747, '::1'),
(2020122112344173, '::1'),
(2020122112350063, '::1'),
(2020122112352608, '::1'),
(2020122112363951, '::1'),
(2020122112373707, '::1'),
(2020122112373790, '::1'),
(2020122112380529, '::1'),
(2020122112380748, '::1'),
(2020122112382757, '::1'),
(2020122112392509, '::1'),
(2020122112392707, '::1'),
(2020122112393711, '::1'),
(2020122112403357, '::1'),
(2020122112403438, '::1'),
(2020122112403478, '::1'),
(2020122112403695, '::1'),
(2020122112441777, '::1'),
(2020122112441937, '::1'),
(2020122112443041, '::1'),
(2020122112443172, '::1'),
(2020122112445457, '::1'),
(2020122112452326, '::1'),
(2020122112453608, '::1'),
(2020122113491850, '::1'),
(2020122113531653, '::1'),
(2020122113534915, '::1'),
(2020122114320500, '::1'),
(2020122114323501, '::1'),
(2020122117533718, '::1'),
(2020122119474974, '::1'),
(2020122120013480, '::1'),
(2020122120105270, '::1'),
(2020122120110362, '::1'),
(2020122120155597, '::1'),
(2020122120155647, '::1'),
(2020122120164616, '::1'),
(2020122120164724, '::1'),
(2020122120184090, '::1'),
(2020122120184430, '::1'),
(2020122120184992, '::1'),
(2020122120185078, '::1'),
(2020122120185114, '::1'),
(2020122120202253, '::1'),
(2020122120210926, '::1'),
(2020122120215418, '::1'),
(2020122120220048, '::1'),
(2020122120232453, '::1'),
(2020122120243691, '::1'),
(2020122120245853, '::1'),
(2020122120253478, '::1'),
(2020122120275282, '::1'),
(2020122120275366, '::1'),
(2020122120283010, '::1'),
(2020122120293749, '::1'),
(2020122120381374, '::1'),
(2020122120382889, '::1'),
(2020122120394307, '::1'),
(2020122211422079, '::1'),
(2020122211443361, '::1'),
(2020122212175952, '::1'),
(2020122212183645, '::1'),
(2020122212272587, '::1'),
(2020122213524024, '::1'),
(2020122213524294, '::1'),
(2020122213524500, '::1'),
(2020122213561250, '::1'),
(2020122213561496, '::1'),
(2020122214153525, '::1'),
(2020122214153789, '::1'),
(2020122214344338, '::1'),
(2020122316225172, '::1'),
(2020122316225586, '::1'),
(2020122316231174, '::1'),
(2020122316235997, '::1'),
(2020122316240378, '::1'),
(2020122316265359, '::1'),
(2020122316271856, '::1'),
(2020122316272396, '::1'),
(2020122316275161, '::1'),
(2020122316284275, '::1'),
(2020122316285207, '::1'),
(2020122316292564, '::1'),
(2020122316313027, '::1'),
(2020122316314553, '::1'),
(2020122316314617, '::1'),
(2020122316314634, '::1'),
(2020122316314875, '::1'),
(2020122316314891, '::1'),
(2020122316314904, '::1'),
(2020122316314918, '::1'),
(2020122316314935, '::1'),
(2020122316323581, '::1'),
(2020122316324730, '::1'),
(2020122316332456, '::1'),
(2020122316340490, '::1'),
(2020122316340933, '::1'),
(2020122316361717, '::1'),
(2020122316370204, '::1'),
(2020122316372837, '::1'),
(2020122316372997, '::1'),
(2020122316373273, '::1'),
(2020122316375178, '::1'),
(2020122316380770, '::1'),
(2020122316383955, '::1'),
(2020122316395207, '::1'),
(2020122316395713, '::1'),
(2020122316411256, '::1'),
(2020122316412399, '::1'),
(2020122316414554, '::1'),
(2020122316425517, '::1'),
(2020122316432476, '::1'),
(2020122316440250, '::1'),
(2020122316444132, '::1'),
(2020122316444869, '::1'),
(2020122316445310, '::1'),
(2020122316500521, '::1'),
(2020122316525594, '::1'),
(2020122316532011, '::1'),
(2020122316580934, '::1'),
(2020122316585062, '::1'),
(2020122316591787, '::1'),
(2020122316593772, '::1'),
(2020122316594653, '::1'),
(2020122316594701, '::1'),
(2020122316594724, '::1'),
(2020122316594731, '::1'),
(2020122316594748, '::1'),
(2020122316594766, '::1'),
(2020122316594783, '::1'),
(2020122316594797, '::1'),
(2020122316594815, '::1'),
(2020122316594832, '::1'),
(2020122317012292, '::1'),
(2020122317034938, '::1'),
(2020122317062664, '::1'),
(2020122317063526, '::1'),
(2020122317063741, '::1'),
(2020122317083078, '::1'),
(2020122317084261, '::1'),
(2020122317084301, '::1'),
(2020122317084319, '::1'),
(2020122317084336, '::1'),
(2020122317084353, '::1'),
(2020122317084525, '::1'),
(2020122317084545, '::1'),
(2020122317084560, '::1'),
(2020122317091529, '::1'),
(2020122317094579, '::1'),
(2020122317105514, '::1'),
(2020122317112309, '::1'),
(2020122317112432, '::1'),
(2020122317112489, '::1'),
(2020122317112561, '::1'),
(2020122317113569, '::1'),
(2020122317115556, '::1'),
(2020122317121988, '::1'),
(2020122317123423, '::1'),
(2020122317125182, '::1'),
(2020122317142704, '::1'),
(2020122317144405, '::1'),
(2020122317144469, '::1'),
(2020122317144487, '::1'),
(2020122317144505, '::1'),
(2020122317160681, '::1'),
(2020122317161222, '::1'),
(2020122317173869, '::1'),
(2020122317173883, '::1'),
(2020122317173897, '::1'),
(2020122317173912, '::1'),
(2020122317184140, '::1'),
(2020122317191543, '::1'),
(2020122317192332, '::1'),
(2020122317194630, '::1'),
(2020122317250744, '::1'),
(2020122317251362, '::1'),
(2020122317255867, '::1'),
(2020122317310952, '::1'),
(2020122317311773, '::1'),
(2020122317544120, '::1'),
(2020122317544533, '::1'),
(2020122317590949, '::1'),
(2020122318001652, '::1'),
(2020122411123663, '::1'),
(2020122411192342, '::1'),
(2020122412014549, '::1'),
(2020122412015147, '::1'),
(2020122412043496, '::1'),
(2020122412084597, '::1'),
(2020122414012881, '::1'),
(2020122414020481, '::1'),
(2020122414021345, '::1'),
(2020122414021537, '::1'),
(2020122414042587, '::1'),
(2020122414051795, '::1'),
(2020122414060894, '::1'),
(2020122414061061, '::1'),
(2020122414144698, '::1'),
(2020122414152180, '::1'),
(2020122414305072, '::1'),
(2020122414321192, '::1'),
(2020122414322632, '::1'),
(2020122414324280, '::1'),
(2020122414325384, '::1'),
(2020122414341049, '::1'),
(2020122414361192, '::1'),
(2020122414365534, '::1'),
(2020122414365555, '::1'),
(2020122414365569, '::1'),
(2020122414365586, '::1'),
(2020122414365606, '::1'),
(2020122414365623, '::1'),
(2020122414365639, '::1'),
(2020122414365657, '::1'),
(2020122414365673, '::1'),
(2020122414365690, '::1'),
(2020122414365703, '::1'),
(2020122414365717, '::1'),
(2020122414365732, '::1'),
(2020122414365752, '::1'),
(2020122414365766, '::1'),
(2020122414365785, '::1'),
(2020122414365805, '::1'),
(2020122414365814, '::1'),
(2020122414365834, '::1'),
(2020122414365852, '::1'),
(2020122414365864, '::1'),
(2020122414365880, '::1'),
(2020122414365899, '::1'),
(2020122414365915, '::1'),
(2020122414365931, '::1'),
(2020122414365949, '::1'),
(2020122414365966, '::1'),
(2020122414365982, '::1'),
(2020122414370002, '::1'),
(2020122414370019, '::1'),
(2020122414370037, '::1'),
(2020122414370054, '::1'),
(2020122414370070, '::1'),
(2020122414370091, '::1'),
(2020122414370108, '::1'),
(2020122414370127, '::1'),
(2020122414370147, '::1'),
(2020122414370163, '::1'),
(2020122414370181, '::1'),
(2020122414370199, '::1'),
(2020122414370218, '::1'),
(2020122414372359, '::1'),
(2020122414380607, '::1'),
(2020122414382568, '::1'),
(2020122414552802, '::1'),
(2020122414552850, '::1'),
(2020122414563846, '::1'),
(2020122414580346, '::1'),
(2020122414582342, '::1'),
(2020122414583761, '::1'),
(2020122414585458, '::1'),
(2020122414592893, '::1'),
(2020122415211358, '::1'),
(2020122416555488, '::1'),
(2020122416560109, '::1'),
(2020122810183071, '::1'),
(2020122810251737, '::1'),
(2020122810252430, '::1'),
(2020122810260910, '::1'),
(2020122810305300, '::1'),
(2020122810320590, '::1'),
(2020122810320775, '::1'),
(2020122810321202, '::1'),
(2020122810322395, '::1'),
(2020122810522817, '::1'),
(2020122811124595, '::1'),
(2020122811132129, '::1'),
(2020122811134742, '::1'),
(2020122811141666, '::1'),
(2020122811151071, '::1'),
(2020122811154734, '::1'),
(2020122811163033, '::1'),
(2020122811192728, '::1'),
(2020122811195484, '::1'),
(2020122811214985, '::1'),
(2020122811223398, '::1'),
(2020122811225077, '::1'),
(2020122811231457, '::1'),
(2020122811253801, '::1'),
(2020122811345523, '::1'),
(2020122811363865, '::1'),
(2020122814223802, '::1'),
(2020122814241455, '::1'),
(2020122814245675, '::1'),
(2020122814252582, '::1'),
(2020122814254303, '::1'),
(2020122814353688, '::1'),
(2020122814374139, '::1'),
(2020122814394101, '::1'),
(2020122814404995, '::1'),
(2020122814410053, '::1'),
(2020122814412540, '::1'),
(2020122814412602, '::1'),
(2020122814414423, '::1'),
(2020122814421115, '::1'),
(2020122814425793, '::1'),
(2020122814435119, '::1'),
(2020122814435135, '::1'),
(2020122814451941, '::1'),
(2020122814475617, '::1'),
(2020122814490762, '::1'),
(2020122814502474, '::1'),
(2020122814505257, '::1'),
(2020122814510290, '::1'),
(2020122814521009, '::1'),
(2020122814552036, '::1'),
(2020122815013231, '::1'),
(2020122815112704, '::1'),
(2020122815383249, '::1'),
(2020122816095471, '::1'),
(2020122816122837, '::1'),
(2020122816144539, '::1'),
(2020122816160110, '::1'),
(2020122816295143, '::1'),
(2020122816303012, '::1'),
(2020122817051313, '::1'),
(2020122819000429, '::1'),
(2020122819003113, '::1'),
(2020122910194662, '::1'),
(2020122910215023, '::1'),
(2020122910215352, '::1'),
(2020122910215616, '::1'),
(2020122916235641, '::1'),
(2020122916243059, '::1'),
(2020122916243247, '::1'),
(2020122916450945, '::1'),
(2020122916455256, '::1'),
(2020122916584115, '::1'),
(2020122917372155, '::1'),
(2020123010153357, '::1'),
(2020123015582214, '::1'),
(2020123016013527, '::1'),
(2020123016074155, '::1'),
(2020123016081007, '::1'),
(2020123016085621, '::1'),
(2020123016090500, '::1'),
(2020123016091435, '::1'),
(2020123016091452, '::1'),
(2020123016091465, '::1'),
(2020123016091481, '::1'),
(2020123016091499, '::1'),
(2020123016091512, '::1'),
(2020123016092410, '::1'),
(2020123016101926, '::1'),
(2020123016105752, '::1'),
(2020123016110306, '::1'),
(2020123016111181, '::1'),
(2020123016111634, '::1'),
(2020123016112309, '::1'),
(2020123016113050, '::1'),
(2020123016113925, '::1'),
(2020123016122314, '::1'),
(2020123016122867, '::1'),
(2020123016123260, '::1'),
(2020123016123979, '::1'),
(2020123016124039, '::1'),
(2020123016135121, '::1'),
(2020123016135850, '::1'),
(2020123016135936, '::1'),
(2020123016135963, '::1'),
(2020123016135978, '::1'),
(2020123016140853, '::1'),
(2020123016150418, '::1'),
(2020123016174959, '::1'),
(2020123016181183, '::1'),
(2020123016190996, '::1'),
(2020123016194328, '::1'),
(2020123016200588, '::1'),
(2020123016201263, '::1'),
(2020123016220852, '::1'),
(2020123016220978, '::1'),
(2020123016222643, '::1'),
(2020123016222714, '::1'),
(2020123016223772, '::1'),
(2020123016261009, '::1'),
(2020123016270287, '::1'),
(2020123016273119, '::1'),
(2020123016274442, '::1'),
(2020123016280299, '::1'),
(2020123016282863, '::1'),
(2020123016285037, '::1'),
(2020123016293809, '::1'),
(2020123016332426, '::1'),
(2020123016333240, '::1'),
(2020123016334801, '::1'),
(2020123016340085, '::1'),
(2020123016340608, '::1'),
(2020123016342459, '::1'),
(2020123016374556, '::1'),
(2020123016381194, '::1'),
(2020123016392577, '::1'),
(2020123016401207, '::1'),
(2020123016420774, '::1'),
(2020123016421557, '::1'),
(2020123016432513, '::1'),
(2020123016433450, '::1'),
(2021010410032805, '::1'),
(2021010410033040, '::1'),
(2021010410033144, '::1'),
(2021010410033351, '::1'),
(2021010410312972, '::1'),
(2021010415521602, '::1'),
(2021010415522068, '::1'),
(2021010415522429, '::1'),
(2021010415522788, '::1'),
(2021010415523031, '::1'),
(2021010415535978, '::1'),
(2021010416131714, '::1'),
(2021010416501778, '::1'),
(2021010417104168, '::1'),
(2021010417112873, '::1'),
(2021010417215859, '::1'),
(2021010417220139, '::1'),
(2021010417220312, '::1'),
(2021010417290773, '::1'),
(2021010417293329, '::1'),
(2021010417320553, '::1'),
(2021010417320815, '::1'),
(2021010417325082, '::1'),
(2021010417335100, '::1'),
(2021010417342227, '::1'),
(2021010417385157, '::1'),
(2021010417404214, '::1'),
(2021010417404316, '::1'),
(2021010418123609, '::1'),
(2021010418260798, '::1'),
(2021010418261570, '::1'),
(2021010418262421, '::1'),
(2021010418263766, '::1'),
(2021010418263839, '::1'),
(2021010418263865, '::1'),
(2021010418263879, '::1'),
(2021010418263898, '::1'),
(2021010418264077, '::1'),
(2021010418264992, '::1'),
(2021010418290282, '::1'),
(2021010418291080, '::1'),
(2021010418292487, '::1'),
(2021010418295427, '::1'),
(2021010418594096, '::1'),
(2021010419010701, '::1'),
(2021010419051044, '::1'),
(2021010419053867, '::1'),
(2021010419330618, '::1'),
(2021010419395970, '::1'),
(2021010419401588, '::1'),
(2021010419405014, '::1'),
(2021010419405430, '::1'),
(2021010419465512, '::1'),
(2021010419465578, '::1'),
(2021010419465614, '::1'),
(2021010419465634, '::1'),
(2021010419465653, '::1'),
(2021010419472709, '::1'),
(2021010419472869, '::1'),
(2021010419472888, '::1'),
(2021010419472903, '::1'),
(2021010419480861, '::1'),
(2021010511344553, '::1'),
(2021010511354958, '::1'),
(2021010512111553, '::1'),
(2021010512112570, '::1'),
(2021010512130727, '::1'),
(2021010512141129, '::1'),
(2021010512141381, '::1'),
(2021010512141699, '::1'),
(2021010512144377, '::1'),
(2021010512151122, '::1'),
(2021010512153897, '::1'),
(2021010512164807, '::1'),
(2021010512165330, '::1'),
(2021010512201649, '::1'),
(2021010512223720, '::1'),
(2021010512224873, '::1'),
(2021010512355240, '::1'),
(2021010512355755, '::1'),
(2021010514075213, '::1'),
(2021010514082550, '::1'),
(2021010514083428, '::1'),
(2021010514085575, '::1'),
(2021010514090326, '::1'),
(2021010514155715, '::1'),
(2021010514194190, '::1'),
(2021010514281188, '::1'),
(2021010514305755, '::1'),
(2021010514312199, '::1'),
(2021010514330608, '::1'),
(2021010514372608, '::1'),
(2021010514374778, '::1'),
(2021010514380240, '::1'),
(2021010514425921, '::1'),
(2021010514440930, '::1'),
(2021010514485394, '::1'),
(2021010514491688, '::1'),
(2021010514492963, '::1'),
(2021010514493398, '::1'),
(2021010516460539, '::1'),
(2021010516514523, '::1'),
(2021010516522798, '::1'),
(2021010516540419, '::1'),
(2021010516545420, '::1'),
(2021010516550126, '::1'),
(2021010516550650, '::1'),
(2021010516552240, '::1'),
(2021010516594272, '::1'),
(2021010516595124, '::1'),
(2021010516595631, '::1'),
(2021010517004195, '::1'),
(2021010517020479, '::1'),
(2021010517020879, '::1'),
(2021010517022154, '::1'),
(2021010517241486, '::1'),
(2021010517255124, '::1'),
(2021010517261145, '::1'),
(2021010517262147, '::1'),
(2021010517271692, '::1'),
(2021010517272557, '::1'),
(2021010517273839, '::1'),
(2021010517273903, '::1'),
(2021010517294951, '::1'),
(2021010517301625, '::1'),
(2021010517301674, '::1'),
(2021010517301690, '::1'),
(2021010517301709, '::1'),
(2021010517312450, '::1'),
(2021010517320579, '::1'),
(2021010517320655, '::1'),
(2021010517341187, '::1'),
(2021010517360398, '::1'),
(2021010517392169, '::1'),
(2021010517392517, '::1'),
(2021010517393293, '::1'),
(2021010517393594, '::1'),
(2021010517395932, '::1'),
(2021010517412360, '::1'),
(2021010517432069, '::1'),
(2021010517435702, '::1'),
(2021010517503640, '::1'),
(2021010517504858, '::1'),
(2021010517531447, '::1'),
(2021010517551878, '::1'),
(2021010517563692, '::1'),
(2021010517580967, '::1'),
(2021010517581746, '::1'),
(2021010517591588, '::1'),
(2021010518043542, '::1'),
(2021010518050759, '::1'),
(2021010518070086, '::1'),
(2021010518131528, '::1'),
(2021010518132316, '::1'),
(2021010518200617, '::1'),
(2021010518265884, '::1'),
(2021010518270167, '::1'),
(2021010518270422, '::1'),
(2021010518274308, '::1'),
(2021010518534063, '::1'),
(2021010518552684, '::1'),
(2021010518552897, '::1'),
(2021010518553053, '::1'),
(2021010518553308, '::1'),
(2021010518553462, '::1'),
(2021010518553644, '::1'),
(2021010518555130, '::1'),
(2021010518573234, '::1'),
(2021010518574033, '::1'),
(2021010518581049, '::1'),
(2021010518583501, '::1'),
(2021010518583733, '::1'),
(2021010518585364, '::1'),
(2021010518585445, '::1'),
(2021010518585516, '::1'),
(2021010518590280, '::1'),
(2021010518592523, '::1'),
(2021010518592617, '::1'),
(2021010518592979, '::1'),
(2021010518593082, '::1'),
(2021010518593530, '::1'),
(2021010518594635, '::1'),
(2021010518594740, '::1'),
(2021010518594806, '::1'),
(2021010518594886, '::1'),
(2021010518595384, '::1'),
(2021010519001215, '::1'),
(2021010519001816, '::1'),
(2021010519001897, '::1'),
(2021010519002083, '::1'),
(2021010519022758, '::1'),
(2021010519022835, '::1'),
(2021010519022994, '::1'),
(2021010519031181, '::1'),
(2021010519033875, '::1'),
(2021010519042141, '::1'),
(2021010519042248, '::1'),
(2021010519042267, '::1'),
(2021010519042287, '::1'),
(2021010519042299, '::1'),
(2021010519045023, '::1'),
(2021010519045130, '::1'),
(2021010519045860, '::1'),
(2021010519053908, '::1'),
(2021010519060144, '::1'),
(2021010519095663, '::1'),
(2021010519100310, '::1'),
(2021010519100595, '::1'),
(2021010519100782, '::1'),
(2021010519104909, '::1'),
(2021010519110400, '::1'),
(2021010519110921, '::1'),
(2021010519120599, '::1'),
(2021010519120907, '::1'),
(2021010519141810, '::1'),
(2021010519154868, '::1'),
(2021010519155165, '::1');

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_visit`
--

CREATE TABLE `g5_visit` (
  `vi_id` int(11) NOT NULL DEFAULT '0',
  `vi_ip` varchar(100) NOT NULL DEFAULT '',
  `vi_date` date NOT NULL DEFAULT '0000-00-00',
  `vi_time` time NOT NULL DEFAULT '00:00:00',
  `vi_referer` text NOT NULL,
  `vi_agent` varchar(200) NOT NULL DEFAULT '',
  `vi_browser` varchar(255) NOT NULL DEFAULT '',
  `vi_os` varchar(255) NOT NULL DEFAULT '',
  `vi_device` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `g5_visit`
--

INSERT INTO `g5_visit` (`vi_id`, `vi_ip`, `vi_date`, `vi_time`, `vi_referer`, `vi_agent`, `vi_browser`, `vi_os`, `vi_device`) VALUES
(1, '::1', '2020-11-20', '16:58:57', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.66 Safari/537.36', '', '', ''),
(2, '::1', '2020-11-23', '10:00:26', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.66 Safari/537.36', '', '', ''),
(3, '::1', '2020-11-24', '10:06:51', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.66 Safari/537.36', '', '', ''),
(4, '127.0.0.1', '2020-11-25', '10:07:35', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.66 Safari/537.36', '', '', ''),
(5, '::1', '2020-11-25', '10:15:59', 'http://localhost/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.66 Safari/537.36', '', '', ''),
(6, '::1', '2020-11-26', '10:29:22', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.66 Safari/537.36', '', '', ''),
(7, '127.0.0.1', '2020-11-27', '12:07:41', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.66 Safari/537.36', '', '', ''),
(8, '::1', '2020-11-27', '12:07:45', 'http://localhost/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.66 Safari/537.36', '', '', ''),
(9, '::1', '2020-11-30', '09:59:38', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.66 Safari/537.36', '', '', ''),
(10, '::1', '2020-12-01', '09:59:41', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.66 Safari/537.36', '', '', ''),
(11, '::1', '2020-12-02', '10:00:17', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.66 Safari/537.36', '', '', ''),
(12, '::1', '2020-12-03', '10:22:50', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(13, '::1', '2020-12-04', '10:32:20', 'http://localhost/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(14, '::1', '2020-12-07', '08:32:09', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(15, '127.0.0.1', '2020-12-08', '10:23:27', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(16, '::1', '2020-12-08', '10:23:43', 'http://localhost/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(17, '::1', '2020-12-09', '10:24:23', 'http://localhost/bbs/board.notice.php?bo_table=notice&bo_idx=1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(18, '::1', '2020-12-10', '10:27:06', 'http://localhost/bbs/board.report.php?bo_table=business&bo_idx=1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(19, '127.0.0.1', '2020-12-10', '11:17:20', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(20, '::1', '2020-12-11', '12:01:41', 'http://localhost/bbs/board.rater.php?bo_table=qa&bo_idx=1&wr_idx=22', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(21, '::1', '2020-12-13', '15:43:56', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(22, '::1', '2020-12-14', '15:44:22', 'http://localhost/bbs/board.rater.php?bo_table=qa&wr_idx=22&bo_idx=2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(23, '127.0.0.1', '2020-12-14', '16:56:19', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(24, '127.0.0.1', '2020-12-15', '18:14:24', 'http://localhost/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(25, '::1', '2020-12-15', '18:15:55', 'http://localhost/bbs/board.rater.php?bo_table=qa&bo_idx=1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(26, '::1', '2020-12-17', '10:31:25', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(27, '::1', '2020-12-18', '10:33:53', 'http://localhost/bbs/login.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(28, '::1', '2020-12-20', '17:00:12', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(29, '::1', '2020-12-21', '17:00:40', 'http://localhost/bbs/application_user_update.php?value=2&idx=10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(30, '::1', '2020-12-22', '17:17:02', 'http://localhost/bbs/board.rater.admin.php?bo_table=qa&border_idx=57&bo_idx=1&u_id=1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(31, '::1', '2020-12-23', '17:17:38', 'http://localhost/bbs/board.php?bo_table=business&wr_id=57', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(32, '::1', '2020-12-24', '17:45:03', 'http://localhost/bbs/board.php?bo_table=business&bo_idx=1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(33, '127.0.0.1', '2020-12-28', '10:01:24', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(34, '::1', '2020-12-28', '10:18:29', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; Trident/7.0; rv:11.0) like Gecko', '', '', ''),
(35, '::1', '2020-12-29', '10:23:37', 'http://localhost/bbs/board.report.php?bo_table=business&bo_idx=1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(36, '::1', '2020-12-30', '10:23:50', 'http://localhost/bbs/board.rater.php?bo_table=qa&bo_idx=1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(37, '127.0.0.1', '2020-12-31', '12:47:25', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(38, '::1', '2020-12-31', '12:47:30', 'http://localhost/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(39, '::1', '2021-01-04', '10:01:56', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(40, '::1', '2021-01-05', '10:05:34', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', ''),
(41, '::1', '2021-01-06', '10:56:13', '', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', '', '', '');

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_visit_sum`
--

CREATE TABLE `g5_visit_sum` (
  `vs_date` date NOT NULL DEFAULT '0000-00-00',
  `vs_count` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `g5_visit_sum`
--

INSERT INTO `g5_visit_sum` (`vs_date`, `vs_count`) VALUES
('2020-11-20', 1),
('2020-11-23', 1),
('2020-11-24', 1),
('2020-11-26', 1),
('2020-11-30', 1),
('2020-12-01', 1),
('2020-12-02', 1),
('2020-12-03', 1),
('2020-12-04', 1),
('2020-12-07', 1),
('2020-12-09', 1),
('2020-12-11', 1),
('2020-12-13', 1),
('2020-12-17', 1),
('2020-12-18', 1),
('2020-12-20', 1),
('2020-12-21', 1),
('2020-12-22', 1),
('2020-12-23', 1),
('2020-12-24', 1),
('2020-12-29', 1),
('2020-12-30', 1),
('2021-01-04', 1),
('2021-01-05', 1),
('2021-01-06', 1),
('2020-11-25', 2),
('2020-11-27', 2),
('2020-12-08', 2),
('2020-12-10', 2),
('2020-12-14', 2),
('2020-12-15', 2),
('2020-12-28', 2),
('2020-12-31', 2);

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_write_business`
--

CREATE TABLE `g5_write_business` (
  `wr_id` int(11) NOT NULL COMMENT '사업공고 순서',
  `wr_quest_number` varchar(256) NOT NULL,
  `wr_num` int(11) NOT NULL DEFAULT '0',
  `wr_reply` varchar(10) NOT NULL,
  `wr_parent` int(11) NOT NULL DEFAULT '0',
  `wr_is_comment` tinyint(4) NOT NULL DEFAULT '0',
  `wr_comment` int(11) NOT NULL DEFAULT '0',
  `wr_comment_reply` varchar(5) NOT NULL,
  `ca_name` varchar(255) NOT NULL,
  `wr_option` set('html1','html2','secret','mail') NOT NULL,
  `wr_subject` varchar(255) NOT NULL COMMENT '지원사업 제목',
  `wr_content` text NOT NULL COMMENT '지원사업 내용',
  `wr_seo_title` varchar(255) NOT NULL DEFAULT '',
  `wr_link1` text NOT NULL COMMENT '지원사업 관련 링크1',
  `wr_link2` text NOT NULL COMMENT '지원사업 관련 링크2',
  `wr_link1_hit` int(11) NOT NULL DEFAULT '0' COMMENT '관련 링크1 조회수',
  `wr_link2_hit` int(11) NOT NULL DEFAULT '0' COMMENT '관련 링크2 조회수',
  `wr_hit` int(11) NOT NULL DEFAULT '0',
  `wr_good` int(11) NOT NULL DEFAULT '0' COMMENT '좋아요',
  `wr_nogood` int(11) NOT NULL DEFAULT '0' COMMENT '싫어요',
  `mb_id` varchar(20) NOT NULL COMMENT '등록자 ID',
  `wr_password` varchar(255) NOT NULL,
  `wr_name` varchar(255) NOT NULL COMMENT '등록자 이름',
  `wr_email` varchar(255) NOT NULL COMMENT '등록자 이메일',
  `wr_homepage` varchar(255) NOT NULL,
  `wr_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '등록일',
  `wr_file` tinyint(4) NOT NULL DEFAULT '0' COMMENT '등록 파일 수',
  `wr_last` varchar(19) NOT NULL,
  `wr_ip` varchar(255) NOT NULL,
  `wr_facebook_user` varchar(255) NOT NULL,
  `wr_twitter_user` varchar(255) NOT NULL,
  `wr_title_idx` int(11) NOT NULL COMMENT '사업공고 타이틀',
  `wr_date_start` date NOT NULL COMMENT '지원사업 시작하는 날짜',
  `wr_date_end` date NOT NULL COMMENT '지원사업 끝나는 날짜',
  `middle_result` int(255) DEFAULT NULL,
  `final_result` int(255) DEFAULT NULL,
  `wr_7` varchar(255) NOT NULL,
  `wr_8` varchar(255) NOT NULL,
  `wr_9` varchar(255) NOT NULL,
  `wr_10` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='사업공고 게시판';

--
-- 테이블의 덤프 데이터 `g5_write_business`
--

INSERT INTO `g5_write_business` (`wr_id`, `wr_quest_number`, `wr_num`, `wr_reply`, `wr_parent`, `wr_is_comment`, `wr_comment`, `wr_comment_reply`, `ca_name`, `wr_option`, `wr_subject`, `wr_content`, `wr_seo_title`, `wr_link1`, `wr_link2`, `wr_link1_hit`, `wr_link2_hit`, `wr_hit`, `wr_good`, `wr_nogood`, `mb_id`, `wr_password`, `wr_name`, `wr_email`, `wr_homepage`, `wr_datetime`, `wr_file`, `wr_last`, `wr_ip`, `wr_facebook_user`, `wr_twitter_user`, `wr_title_idx`, `wr_date_start`, `wr_date_end`, `middle_result`, `final_result`, `wr_7`, `wr_8`, `wr_9`, `wr_10`) VALUES
(94, '0001', -1, '', 94, 0, 0, '', '', '', '한국학 연구용역 사업공고입니다.', '이것은 사업공고입니다.', '한국학 연구용역 사업공고입니다.', '', '', 0, 0, 7, 0, 0, 'admin', '', '최고관리자', 'admin@domain.com', '', '2021-01-05 11:35:40', 1, '2021-01-05 11:35:40', '::1', '', '', 1, '2021-10-10', '2022-12-31', 0, 0, '', '', '', ''),
(95, '1231321', -2, '', 95, 0, 0, '', '', '', '1231312312', 'w31231312', '1231312312', '', '', 0, 0, 0, 0, 0, 'admin', '', '최고관리자', 'admin@domain.com', '', '2021-01-05 14:49:06', 0, '2021-01-05 14:49:06', '::1', '', '', 1, '2021-01-15', '2021-01-19', 0, 0, '', '', '', '');

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_write_business_title`
--

CREATE TABLE `g5_write_business_title` (
  `idx` int(11) NOT NULL COMMENT '카테고리 순서',
  `bo_table` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL COMMENT '카테고리 이름'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='사업공고 카테고리';

--
-- 테이블의 덤프 데이터 `g5_write_business_title`
--

INSERT INTO `g5_write_business_title` (`idx`, `bo_table`, `title`) VALUES
(1, 'business', '한국학 연구용역'),
(2, 'business', '한국학 저술지원'),
(3, 'business', '집중 클러스터'),
(4, 'business', '중소규모 집담회'),
(5, 'business', '한국학 학술대회'),
(6, 'business', '신진학자 초청 교류'),
(7, 'notice', '공지사항'),
(8, 'notice', '서식 다운로드'),
(9, 'notice', '지원실 파일 공유');

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_write_gallery`
--

CREATE TABLE `g5_write_gallery` (
  `wr_id` int(11) NOT NULL,
  `wr_num` int(11) NOT NULL DEFAULT '0',
  `wr_reply` varchar(10) NOT NULL,
  `wr_parent` int(11) NOT NULL DEFAULT '0',
  `wr_is_comment` tinyint(4) NOT NULL DEFAULT '0',
  `wr_comment` int(11) NOT NULL DEFAULT '0',
  `wr_comment_reply` varchar(5) NOT NULL,
  `ca_name` varchar(255) NOT NULL,
  `wr_option` set('html1','html2','secret','mail') NOT NULL,
  `wr_subject` varchar(255) NOT NULL,
  `wr_content` text NOT NULL,
  `wr_seo_title` varchar(255) NOT NULL DEFAULT '',
  `wr_link1` text NOT NULL,
  `wr_link2` text NOT NULL,
  `wr_link1_hit` int(11) NOT NULL DEFAULT '0',
  `wr_link2_hit` int(11) NOT NULL DEFAULT '0',
  `wr_hit` int(11) NOT NULL DEFAULT '0',
  `wr_good` int(11) NOT NULL DEFAULT '0',
  `wr_nogood` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL,
  `wr_password` varchar(255) NOT NULL,
  `wr_name` varchar(255) NOT NULL,
  `wr_email` varchar(255) NOT NULL,
  `wr_homepage` varchar(255) NOT NULL,
  `wr_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `wr_file` tinyint(4) NOT NULL DEFAULT '0',
  `wr_last` varchar(19) NOT NULL,
  `wr_ip` varchar(255) NOT NULL,
  `wr_facebook_user` varchar(255) NOT NULL,
  `wr_twitter_user` varchar(255) NOT NULL,
  `wr_1` varchar(255) NOT NULL,
  `wr_2` varchar(255) NOT NULL,
  `wr_3` varchar(255) NOT NULL,
  `wr_4` varchar(255) NOT NULL,
  `wr_5` varchar(255) NOT NULL,
  `wr_6` varchar(255) NOT NULL,
  `wr_7` varchar(255) NOT NULL,
  `wr_8` varchar(255) NOT NULL,
  `wr_9` varchar(255) NOT NULL,
  `wr_10` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_write_notice`
--

CREATE TABLE `g5_write_notice` (
  `wr_id` int(11) NOT NULL,
  `wr_num` int(11) NOT NULL DEFAULT '0',
  `wr_reply` varchar(10) NOT NULL,
  `wr_parent` int(11) NOT NULL DEFAULT '0',
  `wr_is_comment` tinyint(4) NOT NULL DEFAULT '0',
  `wr_comment` int(11) NOT NULL DEFAULT '0',
  `wr_comment_reply` varchar(5) NOT NULL,
  `ca_name` varchar(255) NOT NULL,
  `wr_option` set('html1','html2','secret','mail') NOT NULL,
  `wr_subject` varchar(255) NOT NULL,
  `wr_content` text NOT NULL,
  `wr_seo_title` varchar(255) NOT NULL DEFAULT '',
  `wr_link1` text NOT NULL,
  `wr_link2` text NOT NULL,
  `wr_link1_hit` int(11) NOT NULL DEFAULT '0',
  `wr_link2_hit` int(11) NOT NULL DEFAULT '0',
  `wr_hit` int(11) NOT NULL DEFAULT '0',
  `wr_good` int(11) NOT NULL DEFAULT '0',
  `wr_nogood` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL,
  `wr_password` varchar(255) NOT NULL,
  `wr_name` varchar(255) NOT NULL,
  `wr_email` varchar(255) NOT NULL,
  `wr_homepage` varchar(255) NOT NULL,
  `wr_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `wr_file` tinyint(4) NOT NULL DEFAULT '0',
  `wr_last` varchar(19) NOT NULL,
  `wr_ip` varchar(255) NOT NULL,
  `wr_facebook_user` varchar(255) NOT NULL,
  `wr_twitter_user` varchar(255) NOT NULL,
  `notice_table` int(255) NOT NULL,
  `wr_2` varchar(255) NOT NULL,
  `wr_3` varchar(255) NOT NULL,
  `wr_4` varchar(255) NOT NULL,
  `wr_5` varchar(255) NOT NULL,
  `wr_6` varchar(255) NOT NULL,
  `wr_7` varchar(255) NOT NULL,
  `wr_8` varchar(255) NOT NULL,
  `wr_9` varchar(255) NOT NULL,
  `wr_10` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='공지사항, 서식, 지원실';

--
-- 테이블의 덤프 데이터 `g5_write_notice`
--

INSERT INTO `g5_write_notice` (`wr_id`, `wr_num`, `wr_reply`, `wr_parent`, `wr_is_comment`, `wr_comment`, `wr_comment_reply`, `ca_name`, `wr_option`, `wr_subject`, `wr_content`, `wr_seo_title`, `wr_link1`, `wr_link2`, `wr_link1_hit`, `wr_link2_hit`, `wr_hit`, `wr_good`, `wr_nogood`, `mb_id`, `wr_password`, `wr_name`, `wr_email`, `wr_homepage`, `wr_datetime`, `wr_file`, `wr_last`, `wr_ip`, `wr_facebook_user`, `wr_twitter_user`, `notice_table`, `wr_2`, `wr_3`, `wr_4`, `wr_5`, `wr_6`, `wr_7`, `wr_8`, `wr_9`, `wr_10`) VALUES
(53, -1, '', 53, 0, 0, '', '', '', '공지공지', '공지사항입니다', '공지공지', '', '', 0, 0, 2, 0, 0, 'admin', '', '최고관리자', 'admin@domain.com', '', '2021-01-05 14:20:00', 0, '2021-01-05 14:20:00', '::1', '', '', 7, '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 테이블 구조 `g5_write_qa`
--

CREATE TABLE `g5_write_qa` (
  `wr_id` int(11) NOT NULL,
  `wr_num` int(11) NOT NULL DEFAULT '0',
  `wr_reply` varchar(10) NOT NULL,
  `wr_parent` int(11) NOT NULL DEFAULT '0',
  `wr_is_comment` tinyint(4) NOT NULL DEFAULT '0',
  `wr_comment` int(11) NOT NULL DEFAULT '0',
  `wr_comment_reply` varchar(5) NOT NULL,
  `ca_name` varchar(255) NOT NULL,
  `wr_option` set('html1','html2','secret','mail') NOT NULL,
  `wr_subject` varchar(255) NOT NULL,
  `wr_content` text NOT NULL,
  `wr_seo_title` varchar(255) NOT NULL DEFAULT '',
  `wr_link1` text NOT NULL,
  `wr_link2` text NOT NULL,
  `wr_link1_hit` int(11) NOT NULL DEFAULT '0',
  `wr_link2_hit` int(11) NOT NULL DEFAULT '0',
  `wr_hit` int(11) NOT NULL DEFAULT '0',
  `wr_good` int(11) NOT NULL DEFAULT '0',
  `wr_nogood` int(11) NOT NULL DEFAULT '0',
  `mb_id` varchar(20) NOT NULL,
  `wr_password` varchar(255) NOT NULL,
  `wr_name` varchar(255) NOT NULL,
  `wr_email` varchar(255) NOT NULL,
  `wr_homepage` varchar(255) NOT NULL,
  `wr_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `wr_file` tinyint(4) NOT NULL DEFAULT '0',
  `wr_last` varchar(19) NOT NULL,
  `wr_ip` varchar(255) NOT NULL,
  `wr_facebook_user` varchar(255) NOT NULL,
  `wr_twitter_user` varchar(255) NOT NULL,
  `wr_1` varchar(255) NOT NULL,
  `wr_2` varchar(255) NOT NULL,
  `wr_3` varchar(255) NOT NULL,
  `wr_4` varchar(255) NOT NULL,
  `wr_5` varchar(255) NOT NULL,
  `wr_6` varchar(255) NOT NULL,
  `wr_7` varchar(255) NOT NULL,
  `wr_8` varchar(255) NOT NULL,
  `wr_9` varchar(255) NOT NULL,
  `wr_10` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `rater`
--

CREATE TABLE `rater` (
  `idx` int(11) NOT NULL COMMENT '심사위원 순서',
  `business_idx` int(255) NOT NULL COMMENT '게시글 순서',
  `user_id` varchar(256) NOT NULL COMMENT '심사위원 아이디',
  `user_name` varchar(255) NOT NULL,
  `test_id` int(255) NOT NULL,
  `value` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='심사위원 권한 설정';

--
-- 테이블의 덤프 데이터 `rater`
--

INSERT INTO `rater` (`idx`, `business_idx`, `user_id`, `user_name`, `test_id`, `value`) VALUES
(79, 94, 'admin', '최고관리자', 1, 2),
(80, 94, 'fdsafdsa', 'fdsa', 1, 2),
(81, 94, 'skekalsrl', '민기', 1, 2),
(82, 94, 'sfdsafdasfdsa', 'fdsa', 1, 2),
(83, 94, 'admin', '최고관리자', 2, 2),
(84, 94, 'fdsafdsa', 'fdsa', 2, 2),
(85, 94, 'skekalsrl', '민기', 2, 2),
(86, 94, 'sfdsafdasfdsa', 'fdsa', 2, 2),
(87, 94, 'admin', '최고관리자', 3, 2),
(88, 94, 'fdsafdsa', 'fdsa', 3, 2),
(89, 94, 'skekalsrl', '민기', 3, 2),
(90, 94, 'sfdsafdasfdsa', 'fdsa', 3, 2);

-- --------------------------------------------------------

--
-- 테이블 구조 `rater_value`
--

CREATE TABLE `rater_value` (
  `idx` int(11) NOT NULL,
  `rater_idx` int(255) NOT NULL,
  `report_idx` int(255) NOT NULL,
  `test_user` varchar(256) NOT NULL,
  `test_title` varchar(256) NOT NULL,
  `test_plan` varchar(256) NOT NULL,
  `test_sum` int(255) NOT NULL,
  `test_average` int(255) NOT NULL,
  `test_opinion` varchar(256) NOT NULL,
  `value` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `rater_value`
--

INSERT INTO `rater_value` (`idx`, `rater_idx`, `report_idx`, `test_user`, `test_title`, `test_plan`, `test_sum`, `test_average`, `test_opinion`, `value`) VALUES
(16, 79, 75, '80', '80', '80', 80, 240, '평가평가', 2),
(17, 83, 75, '80', '40', '20', 47, 140, 'gggggg', 2);

-- --------------------------------------------------------

--
-- 테이블 구조 `report`
--

CREATE TABLE `report` (
  `idx` int(11) NOT NULL COMMENT '보고서 순서',
  `business_idx` int(255) NOT NULL COMMENT '게시글 순서',
  `mb_id` varchar(256) NOT NULL,
  `report_idx` int(255) NOT NULL COMMENT '보고서 종류',
  `contents` varchar(535) NOT NULL COMMENT '설명 내용',
  `report_file` tinyint(4) NOT NULL COMMENT '참고 파일 수',
  `report` int(255) DEFAULT NULL,
  `report_value` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='중간 및 결과 보고서';

--
-- 테이블의 덤프 데이터 `report`
--

INSERT INTO `report` (`idx`, `business_idx`, `mb_id`, `report_idx`, `contents`, `report_file`, `report`, `report_value`) VALUES
(50, 75, 'admin', 1, 'fdsafdasf', 0, 2, 0),
(51, 77, 'admin', 1, 'dsadas', 0, 2, 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `user3`
--

CREATE TABLE `user3` (
  `idx` int(11) NOT NULL,
  `id` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `passowrd` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `board_business`
--
ALTER TABLE `board_business`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `g5_auth`
--
ALTER TABLE `g5_auth`
  ADD PRIMARY KEY (`mb_id`,`au_menu`);

--
-- 테이블의 인덱스 `g5_autosave`
--
ALTER TABLE `g5_autosave`
  ADD PRIMARY KEY (`as_id`),
  ADD UNIQUE KEY `as_uid` (`as_uid`),
  ADD KEY `mb_id` (`mb_id`);

--
-- 테이블의 인덱스 `g5_board`
--
ALTER TABLE `g5_board`
  ADD PRIMARY KEY (`bo_table`);

--
-- 테이블의 인덱스 `g5_board_file`
--
ALTER TABLE `g5_board_file`
  ADD PRIMARY KEY (`bo_table`,`wr_id`,`bf_no`);

--
-- 테이블의 인덱스 `g5_board_good`
--
ALTER TABLE `g5_board_good`
  ADD PRIMARY KEY (`bg_id`),
  ADD UNIQUE KEY `fkey1` (`bo_table`,`wr_id`,`mb_id`);

--
-- 테이블의 인덱스 `g5_board_new`
--
ALTER TABLE `g5_board_new`
  ADD PRIMARY KEY (`bn_id`),
  ADD KEY `mb_id` (`mb_id`);

--
-- 테이블의 인덱스 `g5_business_propos`
--
ALTER TABLE `g5_business_propos`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `g5_business_title`
--
ALTER TABLE `g5_business_title`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `g5_cert_history`
--
ALTER TABLE `g5_cert_history`
  ADD PRIMARY KEY (`cr_id`),
  ADD KEY `mb_id` (`mb_id`);

--
-- 테이블의 인덱스 `g5_content`
--
ALTER TABLE `g5_content`
  ADD PRIMARY KEY (`co_id`),
  ADD KEY `co_seo_title` (`co_seo_title`);

--
-- 테이블의 인덱스 `g5_eyoom_activity`
--
ALTER TABLE `g5_eyoom_activity`
  ADD PRIMARY KEY (`act_id`);

--
-- 테이블의 인덱스 `g5_eyoom_banner`
--
ALTER TABLE `g5_eyoom_banner`
  ADD PRIMARY KEY (`bn_no`);

--
-- 테이블의 인덱스 `g5_eyoom_board`
--
ALTER TABLE `g5_eyoom_board`
  ADD PRIMARY KEY (`bo_id`),
  ADD KEY `bo_table` (`bo_table`),
  ADD KEY `bo_theme` (`bo_theme`);

--
-- 테이블의 인덱스 `g5_eyoom_contents`
--
ALTER TABLE `g5_eyoom_contents`
  ADD PRIMARY KEY (`ec_no`);

--
-- 테이블의 인덱스 `g5_eyoom_contents_item`
--
ALTER TABLE `g5_eyoom_contents_item`
  ADD PRIMARY KEY (`ci_no`);

--
-- 테이블의 인덱스 `g5_eyoom_exboard`
--
ALTER TABLE `g5_eyoom_exboard`
  ADD PRIMARY KEY (`ex_no`);

--
-- 테이블의 인덱스 `g5_eyoom_follow`
--
ALTER TABLE `g5_eyoom_follow`
  ADD PRIMARY KEY (`fo_no`);

--
-- 테이블의 인덱스 `g5_eyoom_goods`
--
ALTER TABLE `g5_eyoom_goods`
  ADD PRIMARY KEY (`eg_no`);

--
-- 테이블의 인덱스 `g5_eyoom_goods_item`
--
ALTER TABLE `g5_eyoom_goods_item`
  ADD PRIMARY KEY (`gi_no`);

--
-- 테이블의 인덱스 `g5_eyoom_latest`
--
ALTER TABLE `g5_eyoom_latest`
  ADD PRIMARY KEY (`el_no`);

--
-- 테이블의 인덱스 `g5_eyoom_latest_item`
--
ALTER TABLE `g5_eyoom_latest_item`
  ADD PRIMARY KEY (`li_no`);

--
-- 테이블의 인덱스 `g5_eyoom_like`
--
ALTER TABLE `g5_eyoom_like`
  ADD PRIMARY KEY (`lk_no`);

--
-- 테이블의 인덱스 `g5_eyoom_link`
--
ALTER TABLE `g5_eyoom_link`
  ADD PRIMARY KEY (`s_no`);

--
-- 테이블의 인덱스 `g5_eyoom_member`
--
ALTER TABLE `g5_eyoom_member`
  ADD UNIQUE KEY `mb_id` (`mb_id`);

--
-- 테이블의 인덱스 `g5_eyoom_menu`
--
ALTER TABLE `g5_eyoom_menu`
  ADD PRIMARY KEY (`me_id`);

--
-- 테이블의 인덱스 `g5_eyoom_pin`
--
ALTER TABLE `g5_eyoom_pin`
  ADD PRIMARY KEY (`pn_no`);

--
-- 테이블의 인덱스 `g5_eyoom_rating`
--
ALTER TABLE `g5_eyoom_rating`
  ADD PRIMARY KEY (`rt_id`);

--
-- 테이블의 인덱스 `g5_eyoom_respond`
--
ALTER TABLE `g5_eyoom_respond`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `mb_id` (`wr_mb_id`);

--
-- 테이블의 인덱스 `g5_eyoom_slider`
--
ALTER TABLE `g5_eyoom_slider`
  ADD PRIMARY KEY (`es_no`);

--
-- 테이블의 인덱스 `g5_eyoom_slider_item`
--
ALTER TABLE `g5_eyoom_slider_item`
  ADD PRIMARY KEY (`ei_no`);

--
-- 테이블의 인덱스 `g5_eyoom_slider_ytitem`
--
ALTER TABLE `g5_eyoom_slider_ytitem`
  ADD PRIMARY KEY (`ei_no`);

--
-- 테이블의 인덱스 `g5_eyoom_subscribe`
--
ALTER TABLE `g5_eyoom_subscribe`
  ADD PRIMARY KEY (`sb_no`);

--
-- 테이블의 인덱스 `g5_eyoom_tag`
--
ALTER TABLE `g5_eyoom_tag`
  ADD PRIMARY KEY (`tg_id`),
  ADD KEY `tg_word` (`tg_word`);

--
-- 테이블의 인덱스 `g5_eyoom_tag_write`
--
ALTER TABLE `g5_eyoom_tag_write`
  ADD PRIMARY KEY (`tw_id`),
  ADD KEY `mb_id` (`mb_id`),
  ADD KEY `wr_hit` (`wr_hit`);

--
-- 테이블의 인덱스 `g5_eyoom_theme`
--
ALTER TABLE `g5_eyoom_theme`
  ADD UNIQUE KEY `tm_name` (`tm_name`);

--
-- 테이블의 인덱스 `g5_eyoom_yellowcard`
--
ALTER TABLE `g5_eyoom_yellowcard`
  ADD PRIMARY KEY (`yc_id`);

--
-- 테이블의 인덱스 `g5_faq`
--
ALTER TABLE `g5_faq`
  ADD PRIMARY KEY (`fa_id`),
  ADD KEY `fm_id` (`fm_id`);

--
-- 테이블의 인덱스 `g5_faq_master`
--
ALTER TABLE `g5_faq_master`
  ADD PRIMARY KEY (`fm_id`);

--
-- 테이블의 인덱스 `g5_group`
--
ALTER TABLE `g5_group`
  ADD PRIMARY KEY (`gr_id`);

--
-- 테이블의 인덱스 `g5_group_member`
--
ALTER TABLE `g5_group_member`
  ADD PRIMARY KEY (`gm_id`),
  ADD KEY `gr_id` (`gr_id`),
  ADD KEY `mb_id` (`mb_id`);

--
-- 테이블의 인덱스 `g5_login`
--
ALTER TABLE `g5_login`
  ADD PRIMARY KEY (`lo_ip`);

--
-- 테이블의 인덱스 `g5_mail`
--
ALTER TABLE `g5_mail`
  ADD PRIMARY KEY (`ma_id`);

--
-- 테이블의 인덱스 `g5_member`
--
ALTER TABLE `g5_member`
  ADD PRIMARY KEY (`mb_no`),
  ADD UNIQUE KEY `mb_id` (`mb_id`),
  ADD KEY `mb_today_login` (`mb_today_login`),
  ADD KEY `mb_datetime` (`mb_datetime`);

--
-- 테이블의 인덱스 `g5_member_social_profiles`
--
ALTER TABLE `g5_member_social_profiles`
  ADD UNIQUE KEY `mp_no` (`mp_no`),
  ADD KEY `mb_id` (`mb_id`),
  ADD KEY `provider` (`provider`);

--
-- 테이블의 인덱스 `g5_memo`
--
ALTER TABLE `g5_memo`
  ADD PRIMARY KEY (`me_id`),
  ADD KEY `me_recv_mb_id` (`me_recv_mb_id`);

--
-- 테이블의 인덱스 `g5_menu`
--
ALTER TABLE `g5_menu`
  ADD PRIMARY KEY (`me_id`);

--
-- 테이블의 인덱스 `g5_new_win`
--
ALTER TABLE `g5_new_win`
  ADD PRIMARY KEY (`nw_id`);

--
-- 테이블의 인덱스 `g5_point`
--
ALTER TABLE `g5_point`
  ADD PRIMARY KEY (`po_id`),
  ADD KEY `index1` (`mb_id`,`po_rel_table`,`po_rel_id`,`po_rel_action`),
  ADD KEY `index2` (`po_expire_date`);

--
-- 테이블의 인덱스 `g5_poll`
--
ALTER TABLE `g5_poll`
  ADD PRIMARY KEY (`po_id`);

--
-- 테이블의 인덱스 `g5_poll_etc`
--
ALTER TABLE `g5_poll_etc`
  ADD PRIMARY KEY (`pc_id`);

--
-- 테이블의 인덱스 `g5_popular`
--
ALTER TABLE `g5_popular`
  ADD PRIMARY KEY (`pp_id`),
  ADD UNIQUE KEY `index1` (`pp_date`,`pp_word`,`pp_ip`);

--
-- 테이블의 인덱스 `g5_qa_content`
--
ALTER TABLE `g5_qa_content`
  ADD PRIMARY KEY (`qa_id`),
  ADD KEY `qa_num_parent` (`qa_num`,`qa_parent`);

--
-- 테이블의 인덱스 `g5_scrap`
--
ALTER TABLE `g5_scrap`
  ADD PRIMARY KEY (`ms_id`),
  ADD KEY `mb_id` (`mb_id`);

--
-- 테이블의 인덱스 `g5_shop_banner`
--
ALTER TABLE `g5_shop_banner`
  ADD PRIMARY KEY (`bn_id`);

--
-- 테이블의 인덱스 `g5_shop_cart`
--
ALTER TABLE `g5_shop_cart`
  ADD PRIMARY KEY (`ct_id`),
  ADD KEY `od_id` (`od_id`),
  ADD KEY `it_id` (`it_id`),
  ADD KEY `ct_status` (`ct_status`);

--
-- 테이블의 인덱스 `g5_shop_category`
--
ALTER TABLE `g5_shop_category`
  ADD PRIMARY KEY (`ca_id`),
  ADD KEY `ca_order` (`ca_order`);

--
-- 테이블의 인덱스 `g5_shop_coupon`
--
ALTER TABLE `g5_shop_coupon`
  ADD PRIMARY KEY (`cp_no`),
  ADD UNIQUE KEY `cp_id` (`cp_id`),
  ADD KEY `mb_id` (`mb_id`);

--
-- 테이블의 인덱스 `g5_shop_coupon_log`
--
ALTER TABLE `g5_shop_coupon_log`
  ADD PRIMARY KEY (`cl_id`),
  ADD KEY `mb_id` (`mb_id`),
  ADD KEY `od_id` (`od_id`);

--
-- 테이블의 인덱스 `g5_shop_coupon_zone`
--
ALTER TABLE `g5_shop_coupon_zone`
  ADD PRIMARY KEY (`cz_id`);

--
-- 테이블의 인덱스 `g5_shop_event`
--
ALTER TABLE `g5_shop_event`
  ADD PRIMARY KEY (`ev_id`);

--
-- 테이블의 인덱스 `g5_shop_event_item`
--
ALTER TABLE `g5_shop_event_item`
  ADD PRIMARY KEY (`ev_id`,`it_id`),
  ADD KEY `it_id` (`it_id`);

--
-- 테이블의 인덱스 `g5_shop_inicis_log`
--
ALTER TABLE `g5_shop_inicis_log`
  ADD PRIMARY KEY (`oid`);

--
-- 테이블의 인덱스 `g5_shop_item`
--
ALTER TABLE `g5_shop_item`
  ADD PRIMARY KEY (`it_id`),
  ADD KEY `ca_id` (`ca_id`),
  ADD KEY `it_name` (`it_name`),
  ADD KEY `it_seo_title` (`it_seo_title`),
  ADD KEY `it_order` (`it_order`);

--
-- 테이블의 인덱스 `g5_shop_item_option`
--
ALTER TABLE `g5_shop_item_option`
  ADD PRIMARY KEY (`io_no`),
  ADD KEY `io_id` (`io_id`),
  ADD KEY `it_id` (`it_id`);

--
-- 테이블의 인덱스 `g5_shop_item_qa`
--
ALTER TABLE `g5_shop_item_qa`
  ADD PRIMARY KEY (`iq_id`);

--
-- 테이블의 인덱스 `g5_shop_item_relation`
--
ALTER TABLE `g5_shop_item_relation`
  ADD PRIMARY KEY (`it_id`,`it_id2`);

--
-- 테이블의 인덱스 `g5_shop_item_stocksms`
--
ALTER TABLE `g5_shop_item_stocksms`
  ADD PRIMARY KEY (`ss_id`);

--
-- 테이블의 인덱스 `g5_shop_item_use`
--
ALTER TABLE `g5_shop_item_use`
  ADD PRIMARY KEY (`is_id`),
  ADD KEY `index1` (`it_id`);

--
-- 테이블의 인덱스 `g5_shop_order`
--
ALTER TABLE `g5_shop_order`
  ADD PRIMARY KEY (`od_id`),
  ADD KEY `index2` (`mb_id`);

--
-- 테이블의 인덱스 `g5_shop_order_address`
--
ALTER TABLE `g5_shop_order_address`
  ADD PRIMARY KEY (`ad_id`),
  ADD KEY `mb_id` (`mb_id`);

--
-- 테이블의 인덱스 `g5_shop_order_data`
--
ALTER TABLE `g5_shop_order_data`
  ADD KEY `od_id` (`od_id`);

--
-- 테이블의 인덱스 `g5_shop_order_delete`
--
ALTER TABLE `g5_shop_order_delete`
  ADD PRIMARY KEY (`de_id`);

--
-- 테이블의 인덱스 `g5_shop_order_post_log`
--
ALTER TABLE `g5_shop_order_post_log`
  ADD PRIMARY KEY (`oid`);

--
-- 테이블의 인덱스 `g5_shop_personalpay`
--
ALTER TABLE `g5_shop_personalpay`
  ADD PRIMARY KEY (`pp_id`),
  ADD KEY `od_id` (`od_id`);

--
-- 테이블의 인덱스 `g5_shop_sendcost`
--
ALTER TABLE `g5_shop_sendcost`
  ADD PRIMARY KEY (`sc_id`),
  ADD KEY `sc_zip1` (`sc_zip1`),
  ADD KEY `sc_zip2` (`sc_zip2`);

--
-- 테이블의 인덱스 `g5_shop_wish`
--
ALTER TABLE `g5_shop_wish`
  ADD PRIMARY KEY (`wi_id`),
  ADD KEY `index1` (`mb_id`);

--
-- 테이블의 인덱스 `g5_uniqid`
--
ALTER TABLE `g5_uniqid`
  ADD PRIMARY KEY (`uq_id`);

--
-- 테이블의 인덱스 `g5_visit`
--
ALTER TABLE `g5_visit`
  ADD PRIMARY KEY (`vi_id`),
  ADD UNIQUE KEY `index1` (`vi_ip`,`vi_date`),
  ADD KEY `index2` (`vi_date`);

--
-- 테이블의 인덱스 `g5_visit_sum`
--
ALTER TABLE `g5_visit_sum`
  ADD PRIMARY KEY (`vs_date`),
  ADD KEY `index1` (`vs_count`);

--
-- 테이블의 인덱스 `g5_write_business`
--
ALTER TABLE `g5_write_business`
  ADD PRIMARY KEY (`wr_id`),
  ADD KEY `wr_seo_title` (`wr_seo_title`),
  ADD KEY `wr_num_reply_parent` (`wr_num`,`wr_reply`,`wr_parent`),
  ADD KEY `wr_is_comment` (`wr_is_comment`,`wr_id`);

--
-- 테이블의 인덱스 `g5_write_business_title`
--
ALTER TABLE `g5_write_business_title`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `g5_write_gallery`
--
ALTER TABLE `g5_write_gallery`
  ADD PRIMARY KEY (`wr_id`),
  ADD KEY `wr_seo_title` (`wr_seo_title`),
  ADD KEY `wr_num_reply_parent` (`wr_num`,`wr_reply`,`wr_parent`),
  ADD KEY `wr_is_comment` (`wr_is_comment`,`wr_id`);

--
-- 테이블의 인덱스 `g5_write_notice`
--
ALTER TABLE `g5_write_notice`
  ADD PRIMARY KEY (`wr_id`),
  ADD KEY `wr_seo_title` (`wr_seo_title`),
  ADD KEY `wr_num_reply_parent` (`wr_num`,`wr_reply`,`wr_parent`),
  ADD KEY `wr_is_comment` (`wr_is_comment`,`wr_id`);

--
-- 테이블의 인덱스 `g5_write_qa`
--
ALTER TABLE `g5_write_qa`
  ADD PRIMARY KEY (`wr_id`),
  ADD KEY `wr_seo_title` (`wr_seo_title`),
  ADD KEY `wr_num_reply_parent` (`wr_num`,`wr_reply`,`wr_parent`),
  ADD KEY `wr_is_comment` (`wr_is_comment`,`wr_id`);

--
-- 테이블의 인덱스 `rater`
--
ALTER TABLE `rater`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `rater_value`
--
ALTER TABLE `rater_value`
  ADD PRIMARY KEY (`idx`),
  ADD UNIQUE KEY `report_idx` (`idx`);

--
-- 테이블의 인덱스 `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `user3`
--
ALTER TABLE `user3`
  ADD PRIMARY KEY (`idx`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `board_business`
--
ALTER TABLE `board_business`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_autosave`
--
ALTER TABLE `g5_autosave`
  MODIFY `as_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_board_good`
--
ALTER TABLE `g5_board_good`
  MODIFY `bg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_board_new`
--
ALTER TABLE `g5_board_new`
  MODIFY `bn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- 테이블의 AUTO_INCREMENT `g5_business_propos`
--
ALTER TABLE `g5_business_propos`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT '순서', AUTO_INCREMENT=79;

--
-- 테이블의 AUTO_INCREMENT `g5_business_title`
--
ALTER TABLE `g5_business_title`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_cert_history`
--
ALTER TABLE `g5_cert_history`
  MODIFY `cr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_eyoom_activity`
--
ALTER TABLE `g5_eyoom_activity`
  MODIFY `act_id` mediumint(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_eyoom_board`
--
ALTER TABLE `g5_eyoom_board`
  MODIFY `bo_id` mediumint(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_eyoom_contents`
--
ALTER TABLE `g5_eyoom_contents`
  MODIFY `ec_no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_eyoom_contents_item`
--
ALTER TABLE `g5_eyoom_contents_item`
  MODIFY `ci_no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_eyoom_exboard`
--
ALTER TABLE `g5_eyoom_exboard`
  MODIFY `ex_no` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_eyoom_follow`
--
ALTER TABLE `g5_eyoom_follow`
  MODIFY `fo_no` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_eyoom_goods`
--
ALTER TABLE `g5_eyoom_goods`
  MODIFY `eg_no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_eyoom_goods_item`
--
ALTER TABLE `g5_eyoom_goods_item`
  MODIFY `gi_no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_eyoom_latest`
--
ALTER TABLE `g5_eyoom_latest`
  MODIFY `el_no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 테이블의 AUTO_INCREMENT `g5_eyoom_latest_item`
--
ALTER TABLE `g5_eyoom_latest_item`
  MODIFY `li_no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_eyoom_like`
--
ALTER TABLE `g5_eyoom_like`
  MODIFY `lk_no` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_eyoom_link`
--
ALTER TABLE `g5_eyoom_link`
  MODIFY `s_no` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_eyoom_menu`
--
ALTER TABLE `g5_eyoom_menu`
  MODIFY `me_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_eyoom_pin`
--
ALTER TABLE `g5_eyoom_pin`
  MODIFY `pn_no` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_eyoom_rating`
--
ALTER TABLE `g5_eyoom_rating`
  MODIFY `rt_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_eyoom_respond`
--
ALTER TABLE `g5_eyoom_respond`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_eyoom_slider`
--
ALTER TABLE `g5_eyoom_slider`
  MODIFY `es_no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 테이블의 AUTO_INCREMENT `g5_eyoom_slider_item`
--
ALTER TABLE `g5_eyoom_slider_item`
  MODIFY `ei_no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_eyoom_slider_ytitem`
--
ALTER TABLE `g5_eyoom_slider_ytitem`
  MODIFY `ei_no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_eyoom_subscribe`
--
ALTER TABLE `g5_eyoom_subscribe`
  MODIFY `sb_no` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_eyoom_tag`
--
ALTER TABLE `g5_eyoom_tag`
  MODIFY `tg_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_eyoom_tag_write`
--
ALTER TABLE `g5_eyoom_tag_write`
  MODIFY `tw_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_eyoom_yellowcard`
--
ALTER TABLE `g5_eyoom_yellowcard`
  MODIFY `yc_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_faq`
--
ALTER TABLE `g5_faq`
  MODIFY `fa_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_faq_master`
--
ALTER TABLE `g5_faq_master`
  MODIFY `fm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `g5_group_member`
--
ALTER TABLE `g5_group_member`
  MODIFY `gm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_mail`
--
ALTER TABLE `g5_mail`
  MODIFY `ma_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_member`
--
ALTER TABLE `g5_member`
  MODIFY `mb_no` int(11) NOT NULL AUTO_INCREMENT COMMENT '유저 순서', AUTO_INCREMENT=40;

--
-- 테이블의 AUTO_INCREMENT `g5_member_social_profiles`
--
ALTER TABLE `g5_member_social_profiles`
  MODIFY `mp_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_memo`
--
ALTER TABLE `g5_memo`
  MODIFY `me_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_menu`
--
ALTER TABLE `g5_menu`
  MODIFY `me_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_new_win`
--
ALTER TABLE `g5_new_win`
  MODIFY `nw_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_point`
--
ALTER TABLE `g5_point`
  MODIFY `po_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- 테이블의 AUTO_INCREMENT `g5_poll`
--
ALTER TABLE `g5_poll`
  MODIFY `po_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_popular`
--
ALTER TABLE `g5_popular`
  MODIFY `pp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=503;

--
-- 테이블의 AUTO_INCREMENT `g5_qa_content`
--
ALTER TABLE `g5_qa_content`
  MODIFY `qa_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_scrap`
--
ALTER TABLE `g5_scrap`
  MODIFY `ms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `g5_shop_banner`
--
ALTER TABLE `g5_shop_banner`
  MODIFY `bn_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_shop_cart`
--
ALTER TABLE `g5_shop_cart`
  MODIFY `ct_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_shop_coupon`
--
ALTER TABLE `g5_shop_coupon`
  MODIFY `cp_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_shop_coupon_log`
--
ALTER TABLE `g5_shop_coupon_log`
  MODIFY `cl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_shop_coupon_zone`
--
ALTER TABLE `g5_shop_coupon_zone`
  MODIFY `cz_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_shop_event`
--
ALTER TABLE `g5_shop_event`
  MODIFY `ev_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_shop_item_option`
--
ALTER TABLE `g5_shop_item_option`
  MODIFY `io_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_shop_item_qa`
--
ALTER TABLE `g5_shop_item_qa`
  MODIFY `iq_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_shop_item_stocksms`
--
ALTER TABLE `g5_shop_item_stocksms`
  MODIFY `ss_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_shop_item_use`
--
ALTER TABLE `g5_shop_item_use`
  MODIFY `is_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_shop_order_address`
--
ALTER TABLE `g5_shop_order_address`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_shop_order_delete`
--
ALTER TABLE `g5_shop_order_delete`
  MODIFY `de_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_shop_sendcost`
--
ALTER TABLE `g5_shop_sendcost`
  MODIFY `sc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_shop_wish`
--
ALTER TABLE `g5_shop_wish`
  MODIFY `wi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_write_business`
--
ALTER TABLE `g5_write_business`
  MODIFY `wr_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '사업공고 순서', AUTO_INCREMENT=96;

--
-- 테이블의 AUTO_INCREMENT `g5_write_business_title`
--
ALTER TABLE `g5_write_business_title`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT '카테고리 순서', AUTO_INCREMENT=10;

--
-- 테이블의 AUTO_INCREMENT `g5_write_gallery`
--
ALTER TABLE `g5_write_gallery`
  MODIFY `wr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `g5_write_notice`
--
ALTER TABLE `g5_write_notice`
  MODIFY `wr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- 테이블의 AUTO_INCREMENT `g5_write_qa`
--
ALTER TABLE `g5_write_qa`
  MODIFY `wr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `rater`
--
ALTER TABLE `rater`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT '심사위원 순서', AUTO_INCREMENT=91;

--
-- 테이블의 AUTO_INCREMENT `rater_value`
--
ALTER TABLE `rater_value`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- 테이블의 AUTO_INCREMENT `report`
--
ALTER TABLE `report`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT '보고서 순서', AUTO_INCREMENT=52;

--
-- 테이블의 AUTO_INCREMENT `user3`
--
ALTER TABLE `user3`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
