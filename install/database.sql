-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 19, 2020 at 02:19 PM
-- Server version: 5.7.26
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `donately`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_admin`
--

DROP TABLE IF EXISTS `app_admin`;
CREATE TABLE IF NOT EXISTS `app_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_image` varchar(100) NOT NULL DEFAULT '',
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL DEFAULT '',
  `address` text,
  `status` enum('A','I','D','P') NOT NULL DEFAULT 'P' COMMENT 'A:Approved ,P:Pending ,I:Inactive,D:Deleted,C:Completed',
  `profile_status` enum('V','N','R') NOT NULL DEFAULT 'N' COMMENT 'V:Verify , N:Not Verify,R: Rejected',
  `type` enum('A','S','C') NOT NULL DEFAULT 'A' COMMENT 'A:Admin,S:Staff,C:Client',
  `token` varchar(255) DEFAULT NULL,
  `default_password_changed` int(11) NOT NULL DEFAULT '0',
  `reset_password_check` int(11) NOT NULL DEFAULT '0',
  `reset_password_requested_on` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_causes`
--

DROP TABLE IF EXISTS `app_causes`;
CREATE TABLE IF NOT EXISTS `app_causes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `target_amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `received_amount` decimal(18,2) NOT NULL,
  `status` enum('A','I','E','C') NOT NULL DEFAULT 'A' COMMENT 'A: Active, I: Inactive, E:Expire, C: Completed',
  `created_by` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_cause_donation`
--

DROP TABLE IF EXISTS `app_cause_donation`;
CREATE TABLE IF NOT EXISTS `app_cause_donation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `donator_id` int(11) NOT NULL DEFAULT '0',
  `amount` decimal(18,2) NOT NULL,
  `type` enum('CA','CQ','S','P') NOT NULL DEFAULT 'CA',
  `status` enum('S','P','F') NOT NULL DEFAULT 'P',
  `online_transaction_details` text NOT NULL,
  `cause_id` int(11) NOT NULL DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_cms_page`
--

DROP TABLE IF EXISTS `app_cms_page`;
CREATE TABLE IF NOT EXISTS `app_cms_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'A=Active,I=Inactive',
  `code` varchar(50) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_cms_page`
--

INSERT INTO `app_cms_page` (`id`, `title`, `description`, `status`, `code`, `created_on`) VALUES
(1, 'Privacy Policy', '<h6>Privacy Policy<br><br>Welcome to donately!<br><br>By using the donately Platform, you agree to this policy. By \"Platform\" we mean a set of APIs, SDKs, plugins, code, specifications, documentation, technology, and services (such as content) that enable others, including application developers and website operators, to retrieve data from donately or provide data to us. We reserve the right to change this policy at any time without notice, so please check it regularly. Your continued use of the donately Platform constitutes acceptance of any changes. You also agree to and are responsible for ensuring that you comply with the donately Terms of Use and donately Community Guidelines.</h6><h2 id=\"what-is-a-privacy-policy\" xss=\"removed\"><br></h2>', 'A', 'privacy', '2020-04-26 14:09:45'),
(2, 'Terms and Condition', '<h6 xss=removed>Terms of Use</h6><h6 xss=removed><br>Welcome to donately!<br></h6><h6 xss=removed>These Terms of Use govern your use of donately</h6>', 'A', 'terms', '2020-04-26 14:09:59');

-- --------------------------------------------------------

--
-- Table structure for table `app_contact_us`
--

DROP TABLE IF EXISTS `app_contact_us`;
CREATE TABLE IF NOT EXISTS `app_contact_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_reply` enum('Y','N') CHARACTER SET latin1 NOT NULL DEFAULT 'N' COMMENT 'Y: Yes, N: No',
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_content`
--

DROP TABLE IF EXISTS `app_content`;
CREATE TABLE IF NOT EXISTS `app_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `details` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_content`
--

INSERT INTO `app_content` (`id`, `title`, `image`, `details`) VALUES
(1, 'about', '', '[\"Welcome to Welfare Stablished Since 1898\",\"The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn\\u2019t listen. She packed her seven versalia, put her initial into the belt and made herself on the way.\",\"On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word \\\"and\\\" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn\\u2019t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their.\\r\\n\\r\\nOn her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word \\\"and\\\" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn\\u2019t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their.\\r\\n\\r\\nOn her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word \\\"and\\\" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn\\u2019t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their.\"]'),
(3, 'home_content_title', '', '[\"Make Donation Me\",\"Make World Happy\",\"Sponsorship\"]'),
(4, 'home_content_description', '', '[\"Lorem ipsum dolor amet, consectetur amet adipiscing elit, sed do eiusmod incididunt labore dolore.\",\"Lorem ipsum dolor amet, consectetur amet adipiscing elit, sed do eiusmod incididunt labore dolore.\",\"Lorem ipsum dolor amet, consectetur amet adipiscing elit, sed do eiusmod incididunt labore dolore.\"]'),
(5, 'video_link', '', 'https://www.youtube.com/watch?v=Y6gJHBoGiYM'),
(6, 'home_slogan', '', 'Bringing Smiles to Millions!'),
(7, 'home_background', '5e15c04752816.php', ''),
(8, 'about_us_background', '', ''),
(9, 'team_background', '', ''),
(10, 'causes_background', '', ''),
(11, 'news_background', '', ''),
(12, 'gallery_background', '', ''),
(13, 'contact_us_background', '', ''),
(14, 'donation_background', '', ''),
(15, 'is_breadcrumb_enabled', '', 'N'),
(16, 'seo_keyword', '', 'SEO Keyword-1'),
(17, 'google_analytics', '', 'Google Analytics Code'),
(18, 'seo_description', '', 'SEO Description-2'),
(19, 'event_background', '', ''),
(20, 'project_background', '', ''),
(21, 'comment_project_id', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `app_currency`
--

DROP TABLE IF EXISTS `app_currency`;
CREATE TABLE IF NOT EXISTS `app_currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `currency_code` varchar(100) NOT NULL,
  `stripe_supported` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT 'Y: Yes, N: No',
  `razorpay_supported` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT 'Y: Yes, N: No',
  `paypal_supported` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT 'Y: Yes, N: No	',
  `display_status` enum('A','I') NOT NULL DEFAULT 'I' COMMENT 'A: Active, I: Inactive',
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'A: Active, I: Inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_currency`
--

INSERT INTO `app_currency` (`id`, `title`, `code`, `currency_code`, `stripe_supported`, `razorpay_supported`, `paypal_supported`, `display_status`, `status`) VALUES
(1, 'United State Dollar', 'USD', '&#36;', 'Y', 'N', 'Y', 'A', 'A'),
(4, 'Indian Rupee', 'INR', '&#8377;', 'Y', 'N', 'Y', 'A', 'A'),
(5, 'Quetzal', '502', 'Q', 'Y', 'N', 'Y', 'A', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `app_donation`
--

DROP TABLE IF EXISTS `app_donation`;
CREATE TABLE IF NOT EXISTS `app_donation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `donator_id` int(11) NOT NULL DEFAULT '0',
  `amount` decimal(18,2) NOT NULL,
  `type` enum('CA','CQ','S','P','R') NOT NULL DEFAULT 'CA' COMMENT 'CA:Cash,CQ:Cheque,S:Stripe,P:PayPal,R:Razorpay',
  `cheque_no` varchar(255) NOT NULL DEFAULT '0',
  `online_transaction_details` text NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_donation_category`
--

DROP TABLE IF EXISTS `app_donation_category`;
CREATE TABLE IF NOT EXISTS `app_donation_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `status` enum('A','I') NOT NULL COMMENT 'A: Active, I: Inactive',
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_email_log`
--

DROP TABLE IF EXISTS `app_email_log`;
CREATE TABLE IF NOT EXISTS `app_email_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `content` text NOT NULL,
  `status` enum('Sent','Not Sent') NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `details` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_email_setting`
--

DROP TABLE IF EXISTS `app_email_setting`;
CREATE TABLE IF NOT EXISTS `app_email_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail_type` enum('S','P') NOT NULL DEFAULT 'S',
  `smtp_host` varchar(255) NOT NULL,
  `smtp_username` varchar(255) NOT NULL,
  `smtp_password` varchar(255) NOT NULL,
  `smtp_port` int(11) NOT NULL,
  `smtp_secure` varchar(255) NOT NULL,
  `email_from` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_events`
--

DROP TABLE IF EXISTS `app_events`;
CREATE TABLE IF NOT EXISTS `app_events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `event_venue` text CHARACTER SET utf8 NOT NULL,
  `event_date` date DEFAULT NULL,
  `event_time` time DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` enum('A','E','I','') NOT NULL DEFAULT 'A' COMMENT 'A=Active,I=Inactive,E=Expire',
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `app_expense`
--

DROP TABLE IF EXISTS `app_expense`;
CREATE TABLE IF NOT EXISTS `app_expense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `details` text NOT NULL,
  `expense_date` date DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_expense_category`
--

DROP TABLE IF EXISTS `app_expense_category`;
CREATE TABLE IF NOT EXISTS `app_expense_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'A: Active, I: Inactive',
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_gallery`
--

DROP TABLE IF EXISTS `app_gallery`;
CREATE TABLE IF NOT EXISTS `app_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'A: Active, I: Inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_items`
--

DROP TABLE IF EXISTS `app_items`;
CREATE TABLE IF NOT EXISTS `app_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `status` enum('A','I') NOT NULL COMMENT 'A: Active, I: Inactive',
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_item_donation`
--

DROP TABLE IF EXISTS `app_item_donation`;
CREATE TABLE IF NOT EXISTS `app_item_donation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `donator_id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `qty` int(11) NOT NULL DEFAULT '1',
  `status` enum('R','NR') NOT NULL DEFAULT 'NR' COMMENT 'NR=Not Received Yet, R=Received',
  `created_by` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_language`
--

DROP TABLE IF EXISTS `app_language`;
CREATE TABLE IF NOT EXISTS `app_language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `db_field` text NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'A: Active, I: Inactive',
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_language`
--

INSERT INTO `app_language` (`id`, `title`, `db_field`, `status`, `created_date`) VALUES
(1, 'english', 'english', 'A', '2018-07-13 17:17:42');

-- --------------------------------------------------------

--
-- Table structure for table `app_language_data`
--

DROP TABLE IF EXISTS `app_language_data`;
CREATE TABLE IF NOT EXISTS `app_language_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `default_text` longtext NOT NULL,
  `english` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=856 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_language_data`
--

INSERT INTO `app_language_data` (`id`, `default_text`, `english`) VALUES
(1, 'login', 'Login'),
(2, 'logout', 'Logout'),
(3, 'return', 'Return'),
(4, 'now', 'Now'),
(5, 'required_message', 'This field is required.'),
(6, 'login_success', 'You have logged in successfully.'),
(7, 'login_failure', 'Please check your email or password and try again.'),
(8, 'forgot_password', 'Forgot Password'),
(9, 'forgot_mail_message', 'Need to reset your password?'),
(10, 'forgot_mail_content', 'We have received a request to reset your password. You can change your password by hitting the button below.'),
(11, 'reset_password', 'Reset Password'),
(12, 'forgot_success', 'Reset password link has been sent successfully.'),
(13, 'forgot_failure', 'Email not registered with system.'),
(14, 'reset_failure', 'Reset password link has been expired. Please try again.'),
(15, 'invalid_request', 'Invalid request. Please try again.'),
(16, 'reset_success', 'Your password has been changed successfully.'),
(17, 'update_password', 'Update Password'),
(18, 'current_password_failure', 'Your old password is invalid. Please try again.'),
(19, 'profile_success', 'Your profile has been updated successfully.'),
(20, 'logout_success', 'Logout successfully...'),
(22, 'vendor_verify_failure', 'Account verification link has been expired. Please try again.'),
(23, 'already_vendor_verify', 'Account already verify.'),
(24, 'account_verify_success', 'Account verified successfully.'),
(25, 'vendor_not_verify', 'Account not verified.'),
(26, 'account_verification_content', 'Your account has been created successfully.Please click on verification button to activate account.'),
(27, 'image', 'Image'),
(28, 'edit', 'Edit'),
(29, 'update', 'Update'),
(30, 'add', 'Add'),
(31, 'email', 'Email'),
(34, 'password', 'Password'),
(35, 'first_name', 'First Name'),
(36, 'last_name', 'Last Name'),
(37, 'phone', 'Phone'),
(38, 'choose_file', 'Choose File'),
(39, 'submit', 'Submit'),
(40, 'subject', 'Subject'),
(42, 'description', 'Description'),
(44, 'created_date', 'Created Date'),
(45, 'action', 'Action'),
(47, 'password_length', 'Password must be 8 characters long.'),
(48, 'password_lowercase', 'Must contain at least one lowercase letter.'),
(49, 'password_uppercase', 'Must contain at least one uppercase letter.'),
(50, 'password_numeric', 'Must contain at least one numeric digit and one special character.'),
(51, 'confirm_password', 'Confirm Password'),
(52, 'Change_password', 'Change Password'),
(55, 'profile_image', 'Profile Image'),
(56, 'upload_your_file', 'Upload your file'),
(57, 'manage', 'Manage'),
(60, 'delete', 'Delete'),
(61, 'confirm', 'Confirm'),
(62, 'close', 'Close'),
(63, 'total', 'Total'),
(66, 'active', 'Active'),
(67, 'inactive', 'Inactive'),
(68, 'title', 'Title'),
(69, 'select', 'Select'),
(70, 'delete_confirm', 'Are you sure you want to delete this record?'),
(72, 'new_account_mail', ' Your account has been created successfully.Your login credential are stated as below.'),
(74, 'rights_reserved_message', ' All Rights Reserved.'),
(75, 'protected_message', 'This is login protected. Please login now to view this.'),
(76, 'status', 'Status'),
(77, 'save', 'Save'),
(78, 'profile', 'Profile'),
(82, 'profile_text', 'Profile Text'),
(94, 'dashboard', 'Dashboard'),
(97, 'site_setting', 'Site Setting'),
(98, 'email_setting', 'Email Setting'),
(101, 'mandatory_update', 'Mandatory Update'),
(104, 'mandatory_payment', 'Please select payment method'),
(123, 'click_here', 'Click Here'),
(148, 'payment', 'Payment'),
(154, 'deleted', 'Deleted'),
(159, 'profile_text_content', 'Welcome'),
(208, 'category', 'Category'),
(210, 'site_setting_update', 'Site setting details updated successfully.'),
(211, 'smtp_update', 'Smtp details updated successfully.'),
(212, 'valid_image', 'Please select valid image(jpg, png, jpeg, gif extension only)'),
(213, 'valid_logo', 'Please check your image. It must be in minimum dimension of 241 x 61'),
(215, 'valid_logo_size', 'Size must be minimum of 241*61'),
(218, 'something_wrong', 'Something wrong.'),
(219, 'smtp_host', 'Smtp Host'),
(220, 'smtp_secure', 'Smtp Secure'),
(221, 'username', 'Username'),
(222, 'port', 'Port'),
(223, 'from_name', 'From Name'),
(224, 'site_name', 'Site Name'),
(225, 'site_email', 'Site Email'),
(226, 'site_phone', 'Site Phone'),
(227, 'address', 'Address'),
(228, 'language', 'Language'),
(231, 'information', 'Information'),
(232, 'social', 'Social'),
(233, 'media', 'Media'),
(238, 'facebook', 'Facebook'),
(239, 'google+', 'Google+'),
(240, 'twitter', 'Twitter'),
(241, 'instagram', 'Instagram'),
(243, 'link', 'Link'),
(244, 'company', 'Company'),
(245, 'english', 'English'),
(246, 'logo', 'Logo'),
(247, 'time_zone', 'TimeZone'),
(251, 'no_record_found', 'No Record Found'),
(252, 'payment_setting', 'Payment Setting'),
(253, 'payment_status', 'Payment Status'),
(254, 'update_payment_setting', 'Update Payment Setting'),
(255, 'stripe', 'Stripe'),
(256, 'yes', 'Yes'),
(257, 'no', 'No'),
(258, 'stripe_secret_key', 'Stripe Secret Key'),
(259, 'stripe_publish_key', 'Stripe Publish Key'),
(260, 'payment_setting_update', 'Payment setting has been updated successfully.'),
(261, 'master', 'Master'),
(273, 'name', 'Name'),
(277, 'website', 'Website'),
(283, 'send', 'Send'),
(301, 'cancel', 'Cancel'),
(302, 'transaction_fail', 'Your transaction is failed.Please try again.'),
(303, 'transaction_success', 'Your donation has been processed successfully.'),
(311, 'report', 'Report'),
(334, 'date', 'Date'),
(337, 'month', 'Month'),
(343, 'full_name', 'Full Name'),
(345, 'favicon_icon', 'favicon'),
(349, 'language_setting', 'Language Setting'),
(350, 'manage_language', 'Manage Language'),
(351, 'language_translate', 'Language Translate'),
(352, 'language_add', 'Language has been added successfully.'),
(353, 'language_update', 'Language has been updated successfully.'),
(354, 'language_delete', 'Language has been deleted successfully.'),
(355, 'language_used', 'Language is already in use. You are not allowed to delete.'),
(356, 'translate_word', 'Translate Word'),
(357, 'translated_word', 'Translated Word'),
(358, 'translate', 'Translate'),
(359, 'words', 'Words'),
(361, 'code', 'Code'),
(365, 'amount', 'Amount'),
(373, 'paypal_merchant_email', 'PayPal Merchant Email'),
(374, 'paypal', 'PayPal'),
(375, 'payment_by', 'Payment By'),
(377, 'paypal_mode', 'PayPal Mode'),
(378, 'paypal_sendbox', 'PayPal Sandbox'),
(379, 'paypal_live', 'PayPal Live'),
(381, 'seo', 'SEO'),
(385, 'from_date', 'From Date'),
(386, 'to_date', 'To Date'),
(388, 'seo_description', 'SEO Description'),
(389, 'seo_keyword', 'SEO Keyword'),
(390, 'seo_og_image', 'SEO og Image'),
(394, 'module', 'Module'),
(396, 'records', 'Records'),
(398, 'select_language', 'Select Language'),
(405, 'google', 'Google'),
(412, 'search', 'Search'),
(520, 'login_required', 'Please login and try again.'),
(552, 'account_created', 'Your Account has been created successfully'),
(553, 'your_login_detail', 'Your login credentials given as below'),
(554, 'login_account_credential', 'Login Account Credentials'),
(583, 'created_by', 'Created By'),
(585, 'quantity', 'Quantity'),
(628, 'all', 'All'),
(671, 'profile_verification_content', 'We would like to inform you that. Your profile has been '),
(678, 'staff', 'Staff'),
(699, 'staff_booked_no_delete', 'You are not allowed to delete this staff member.'),
(701, 'currency', 'Currency'),
(734, 'word', 'Word'),
(738, 'record_insert', 'Record has been inserted successfully.'),
(739, 'record_update', 'Record has been updated successfully.'),
(740, 'record_delete', 'Record has been deleted successfully.'),
(742, 'expense', 'Expense'),
(743, 'cash', 'Cash'),
(744, 'cheque', 'Cheque'),
(745, 'donation_type', 'Donation Type'),
(746, 'expense_category', 'Expense Category'),
(747, 'donation', 'Donation'),
(748, 'department', 'Donation Category'),
(749, 'admin', 'Admin'),
(750, 'delete_already_used', 'You are not allowed to delete this.'),
(751, 'donate_now', 'Donate Now'),
(752, 'donation_towards', 'Donation Towards'),
(755, 'search', 'Search'),
(756, 'this_field_is_required', 'This field is required.'),
(757, 'enter_valid_email', 'Please enter a valid email address.'),
(758, 'currently_not_available', 'Currently we are not available. Please try again after some time.'),
(759, 'slogan_one', 'Empowering Communities. Ending Poverty.'),
(760, 'slogan_two', 'Don’t turn away, Give today!'),
(761, 'city', 'City'),
(762, 'details', 'Details'),
(763, 'preview', 'Preview'),
(764, 'copy_link', 'Copy Link'),
(765, 'account_registration', 'Account Registration'),
(766, 'currency_display_position', 'Currency Display Position'),
(767, 'setting', 'Setting'),
(768, 'new_password', 'New Password'),
(769, 'from', 'From'),
(770, 'to', 'To'),
(771, 'head_accountant', 'Head Accountant'),
(772, 'donator', 'Donator'),
(773, 'gallery', 'Gallery'),
(774, 'news', 'News'),
(775, 'events', 'Events'),
(776, 'about_us', 'About Us'),
(777, 'contact_us', 'Contact Us'),
(778, 'causes', 'Causes'),
(779, 'donate', 'Donate'),
(780, 'website', 'Website'),
(781, 'content', 'Content'),
(782, 'about_image_size', 'Size must be minimum of 540*480'),
(783, 'cause', 'Cause'),
(784, 'target', 'Target'),
(785, 'raised_of', 'raised of'),
(786, 'last_donation_ago', 'Last donation X ago'),
(787, 'team', 'Team'),
(788, 'our', 'Our'),
(789, 'home', 'Home'),
(790, 'designation', 'Designation'),
(791, 'social_link', 'Social Link'),
(792, 'contact_information', 'Contact Information'),
(793, 'message', 'Message'),
(794, 'contact_us_title', 'Do you have any questions?'),
(795, 'contact_request_success', 'Your request has been submitted successfully.'),
(796, 'our_causes', 'Our Some Good Causes'),
(797, 'our_causes_title', 'Enter our cause text here'),
(798, 'recent_news', 'Recent News'),
(799, 'recent_news_title', 'Enter recent news title here'),
(800, 'donate_money', 'Donate Money'),
(801, 'be_a_volunteer', 'Be a Volunteer'),
(802, 'what_we_do', 'What We Do'),
(803, 'video_link_title', 'Video link of What we do'),
(804, 'leave_blank_if_not_needed', 'Please leave it blank if you want to set it.'),
(805, 'home_slogan', 'Home Slogan'),
(806, 'linkedin', 'linkedin'),
(807, 'banner_image', 'Banner Image'),
(808, 'banner_size', 'Size must be minimum of 1500*1000'),
(809, 'donation_email_message', 'We have received donation of AMOUNT. We are grateful for your support.'),
(810, 'thank_you', 'Thank You'),
(811, 'donate_money_sub_title', 'A Dream in their Mind is Our Mission. Help us to make their dreams come true.'),
(812, 'completed', 'Completed'),
(813, 'client', 'Client'),
(814, 'users', 'Users'),
(815, 'donators', 'Donators'),
(816, 'events', 'Events'),
(817, 'event', 'Event'),
(818, 'projects', 'Projects'),
(819, 'project', 'Project'),
(820, 'themes', 'Themes'),
(821, 'already_exist', 'is already exist.'),
(822, 'password_equal', 'Enter Confirm Password Same as Password'),
(823, 'maxlength_msg', 'Please enter no more than {0} characters.'),
(824, 'minlength_msg', 'Please enter at least {0} characters.'),
(825, 'max_msg', 'Please enter a value less than or equal to {0}.'),
(826, 'min_msg', 'Please enter a value greater than or equal to {0}.'),
(827, 'valid_url', 'Please enter valid url.'),
(828, 'item', 'Item'),
(829, 'items', 'Items'),
(830, 'qty', 'Quantity'),
(831, 'received', 'Received'),
(832, 'not_received', 'Not Received Yet'),
(833, 'request', 'Request'),
(834, 'time', 'Time'),
(835, 'venue', 'Venue'),
(836, 'display_datetime_form', 'Display Date Format'),
(837, 'slider', 'Slider'),
(838, 'pages', 'CMS Page'),
(839, 'sub_title', 'Sub title'),
(840, 'google_analytics', 'Google Analytics Code'),
(841, 'receipt_no', 'Receipt No'),
(842, 'reg_no', 'Reg. No'),
(843, 'Certificate_of_Appreciation', 'Certificate of Appreciation'),
(844, 'Presented_to', 'Presented to'),
(845, 'In_appreciation_of_your', 'In appreciation of your generous donation to the'),
(846, 'certy_description', 'We express our sincere gratitude for your contribution in support of the fundraiser.'),
(847, 'view_more', 'View More'),
(848, 'privacy_policy', 'Privacy Policy'),
(849, 'terms_and_conditions', 'Terms & Conditions'),
(850, 'administrator', 'Administrator'),
(851, 'received_by', 'Received By'),
(852, 'donation_receipt_message_one', 'Thank you for your donation! '),
(853, 'donation_receipt_message_two', 'The amount you have given will make a difference as the proceeds will go help put the children to school to give them better education, and thus make them better members of society. '),
(854, 'donation_receipt_message_three', 'This receipt is an attestation that we have gratefully received your generous contribution to our humble institution. Keep this receipt for your tax deduction purposes.'),
(855, 'transaction_successful', 'Thank you so much for your donation.'),
(856, 'export', 'Export');

-- --------------------------------------------------------

--
-- Table structure for table `app_module_setting`
--

DROP TABLE IF EXISTS `app_module_setting`;
CREATE TABLE IF NOT EXISTS `app_module_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) NOT NULL,
  `is_enable` enum('Y','N') NOT NULL DEFAULT 'Y' COMMENT 'Y=Yes,No',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_module_setting`
--

INSERT INTO `app_module_setting` (`id`, `module`, `is_enable`) VALUES
(1, 'expense', 'Y'),
(2, 'item', 'Y'),
(3, 'report', 'Y'),
(4, 'staff', 'Y'),
(5, 'causes', 'Y'),
(6, 'news', 'Y'),
(7, 'events', 'Y'),
(8, 'projects', 'Y'),
(9, 'gallery', 'Y'),
(10, 'team', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `app_news`
--

DROP TABLE IF EXISTS `app_news`;
CREATE TABLE IF NOT EXISTS `app_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'A: Active, I: Inactive',
  `created_by` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_payment_setting`
--

DROP TABLE IF EXISTS `app_payment_setting`;
CREATE TABLE IF NOT EXISTS `app_payment_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stripe` enum('Y','N') NOT NULL DEFAULT 'N',
  `on_cash` enum('Y','N') NOT NULL DEFAULT 'N',
  `stripe_secret` varchar(255) DEFAULT NULL,
  `stripe_publish` varchar(255) DEFAULT NULL,
  `paypal` enum('Y','N') NOT NULL COMMENT 'Y=Yes,N=No',
  `paypal_sendbox_live` enum('S','L') NOT NULL COMMENT 'S=Sandbox,L=Live',
  `paypal_merchant_email` varchar(255) DEFAULT NULL,
  `razorpay` enum('Y','N') DEFAULT 'N' COMMENT 'Y=Yes,N=No',
  `razorpay_merchant_key_id` varchar(255) DEFAULT NULL,
  `razorpay_merchant_key_secret` varchar(255) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_projects`
--

DROP TABLE IF EXISTS `app_projects`;
CREATE TABLE IF NOT EXISTS `app_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `gallery_images` text,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'A=Active,I=Inactive',
  `created_by` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_site_setting`
--

DROP TABLE IF EXISTS `app_site_setting`;
CREATE TABLE IF NOT EXISTS `app_site_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_logo` varchar(25) DEFAULT NULL,
  `banner_image` varchar(255) NOT NULL DEFAULT '',
  `company_name` varchar(255) DEFAULT NULL,
  `company_email` varchar(50) DEFAULT NULL,
  `company_phone` varchar(25) DEFAULT NULL,
  `company_address` text,
  `google_link` varchar(255) DEFAULT '',
  `fb_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT '',
  `insta_link` varchar(255) DEFAULT '',
  `linkdin_link` varchar(255) DEFAULT '',
  `language` varchar(255) NOT NULL DEFAULT 'english',
  `time_zone` varchar(255) DEFAULT NULL,
  `time_format` varchar(255) NOT NULL DEFAULT 'm-d-Y H:i',
  `fevicon_icon` varchar(100) DEFAULT NULL,
  `is_maintenance_mode` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT 'Y=Yes,N=No',
  `header_color_code` varchar(100) DEFAULT '#4b6499',
  `footer_color_code` varchar(100) DEFAULT '#4b6499',
  `footer_text` text,
  `currency_id` int(11) NOT NULL DEFAULT '1',
  `currency_position` enum('R','L') NOT NULL DEFAULT 'L',
  `trust_registration_no` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_slider`
--

DROP TABLE IF EXISTS `app_slider`;
CREATE TABLE IF NOT EXISTS `app_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `sub_title` text,
  `image` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'A: Active, I: Inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_team`
--

DROP TABLE IF EXISTS `app_team`;
CREATE TABLE IF NOT EXISTS `app_team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `image` varchar(255) CHARACTER SET latin1 NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `linkdin` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) NOT NULL,
  `status` enum('A','I') CHARACTER SET latin1 NOT NULL DEFAULT 'A' COMMENT 'A: Active, I: Inactive',
  `created_by` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_themes`
--

DROP TABLE IF EXISTS `app_themes`;
CREATE TABLE IF NOT EXISTS `app_themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'I',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `app_payment_setting` (`id`,`stripe`, `on_cash`, `stripe_secret`, `stripe_publish`, `paypal`, `paypal_sendbox_live`, `paypal_merchant_email`, `created_on`) VALUES (NULL,'N', 'N', NULL, NULL, 'N', 'S', NULL, '2018-08-01 00:00:00');
INSERT INTO `app_admin` (`id`,`first_name`, `last_name`, `email`, `password`,`status`, `profile_status`, `type`, `created_on`)
VALUES (NULL,'admin_first_name', 'admin_last_name', 'admin_email', 'admin_password','A', 'V', 'A','admin_created_at');

INSERT INTO `app_email_setting` (`id`,`mail_type`,`email_from`,`smtp_host`, `smtp_username`, `smtp_password`, `smtp_port`, `smtp_secure`)
VALUES (NULL,'email_mail_type','email_email_from','email_smtp_host', 'email_smtp_username', 'email_smtp_password', 'email_smtp_port', 'email_smtp_secure');

INSERT INTO `app_site_setting` (`id`,`company_logo`, `company_name`, `company_email`, `time_zone`)
VALUES (NULL,'site_setting_company_logo','site_setting_company_name', 'site_setting_company_email','Asia/Kolkata');


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
