-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 05, 2017 at 05:19 AM
-- Server version: 10.1.20-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id1541108_stepostrdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `body` longtext,
  `dateModified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`body`, `dateModified`) VALUES
('Currently, we have dozens of Content Resource Management (CRM) web platforms for documenting topics about almost anything. We use them for blogs, technical documentation, wikis, and more. But if somebody wants to setup a website that only deals with step by step guide on certain topics, they will find out that most of the available CRMs will involve lots of customizations that require technical knowledge. This also means that these CRMs require a steep learning curve.\r\n\r\nTo provide a Content Resource Management web platform specifically designed for easily documenting topics which are represented in step by step fashion.\r\n\r\nstepostr (/stɛp/-/ˈpoʊ stər/) will be useful for documenting topics, how-to articles, step by step guides, and similar pages for:\r\n* Personal blogs\r\n* Hobby blogs\r\n* Technical documentations\r\n* Procedural documentations\r\n* etc.\r\n\r\nUsers will be able to easily compose, publish, and maintain posts due to the application being tailored for step by step topic documentation.\r\n\r\nstepostr  was created by Angelito O. Sardez, Jr.', '2017-05-03 19:20:27');

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `displayName` varchar(100) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `admin` tinyint(4) DEFAULT NULL,
  `lastLoginDate` datetime DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `displayName`, `active`, `admin`, `lastLoginDate`, `dateCreated`, `dateModified`) VALUES
(1, 'admin', '$2y$10$njXNqzEtpOprGUMTMpwJWex7j1RaZvrsctb6rN4zChTUW.W/sZws.', 'Administrator', 1, 1, '2017-05-05 01:32:00', '2017-05-01 00:00:00', '2017-05-03 22:24:14'),
(2, 'user', '$2y$10$uO5tLtbayD9BRI9I6pHcvOFZrqYWxPYB1..OGLzon0IXUmhBVz95.', 'User', 1, 0, '2017-05-04 01:20:12', '2017-05-03 22:27:15', '2017-05-03 22:27:15');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `description` text,
  `published` tinyint(4) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `description`, `published`, `dateCreated`, `dateModified`) VALUES
(1, 'User Guide', 'user-guide', 'Contains pages or posts for guiding users on how to use a site powered by the stepostr platform.', 1, '2017-05-03 15:01:41', '2017-05-04 01:43:51'),
(2, 'Announcements', 'announcements', 'Contains pages \\ posts regarding releases or any announcements related to the stepostr platform development.', 1, '2017-05-03 15:00:09', '2017-05-04 01:43:22'),
(4, 'Posts', 'posts', 'This category contains random posts.', 1, '2017-05-04 16:00:13', '2017-05-04 16:00:13');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `showIntroductionLabel` tinyint(4) DEFAULT '0',
  `introductionLabel` varchar(20) DEFAULT NULL,
  `introduction` text,
  `showBodyLabel` tinyint(4) DEFAULT '0',
  `bodyLabel` varchar(20) DEFAULT NULL,
  `body` mediumtext,
  `showStepLabel` tinyint(4) DEFAULT '0',
  `stepLabel` varchar(20) DEFAULT NULL,
  `showStepNumber` tinyint(4) DEFAULT '0',
  `showConclusionLabel` tinyint(4) DEFAULT '0',
  `conclusionLabel` varchar(20) DEFAULT NULL,
  `conclusion` text,
  `categoryId` int(11) DEFAULT NULL,
  `authorId` int(11) DEFAULT NULL,
  `updaterId` int(11) DEFAULT NULL,
  `published` tinyint(4) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `title`, `slug`, `showIntroductionLabel`, `introductionLabel`, `introduction`, `showBodyLabel`, `bodyLabel`, `body`, `showStepLabel`, `stepLabel`, `showStepNumber`, `showConclusionLabel`, `conclusionLabel`, `conclusion`, `categoryId`, `authorId`, `updaterId`, `published`, `dateCreated`, `dateModified`) VALUES
(9, 'How to edit your own account in stepostr', 'how-to-edit-your-own-account-in-stepostr', 1, 'Introduction', 'This guide will narrate the steps required for editing your own account', 0, '', '', 1, 'Step', 1, 1, 'Conclusion', 'With these steps, a user should be able to edit his \\ her account details.', 1, 2, 2, 1, '2017-05-03 23:20:15', '2017-05-03 23:26:28'),
(10, 'Creating a page in stepostr', 'creating-a-page-in-stepostr', 1, 'Introduction', 'This guide presents steps on how a user can create pages featuring step by step process on a certain topic using the stepostr platform.', 0, '', '', 1, 'Step', 1, 1, 'Conclusion', 'This page just sumarized the necessary steps on creating a page in stepostr', 1, 2, 2, 1, '2017-05-03 23:32:47', '2017-05-04 00:54:26'),
(11, 'Managing contributors', 'managing-contributors', 1, 'Introduction', 'Contributors are special types of users which can access the admin portal of the site but they are only limited in managing their owns account and manage pages.\r\nThis guide will show how to manage the contributors.\r\n\r\nNote: Managing contributors is only limited to the administrator account.\r\n', 0, '', '', 1, 'Step', 1, 1, 'Conclusion', '', 1, 1, 1, 1, '2017-05-03 23:56:05', '2017-05-04 00:15:37'),
(12, 'Managing categories', 'managing-categories', 1, 'Introduction', 'Categories are used to group posts or pages together based on topic. This will give the visitors a nicer way to navigate the site since they could find posts grouped together under the same topic.\r\nThis guide will show how to manage the categories.\r\n\r\nNote: Managing categories is only limited to the administrator account.', 0, '', '', 1, 'Step', 1, 1, 'Conclusion', 'By the end of these steps, you should be able to successfully manage categories in the admin portal.', 1, 1, 1, 1, '2017-05-04 00:18:45', '2017-05-04 00:51:14'),
(13, 'How to modify the site\'s details', 'how-to-modify-the-site\'s-details', 1, 'Introduction', 'This page contains step by step instructions for modifying the site\'s details such as its name, tagline, and about page contents.\r\n\r\nNote: Managing categories is only limited to the administrator account.', 0, '', '', 1, 'Step', 1, 1, 'Conclusion', 'By following these steps, you should be able successfully modify the site\'s details.', 1, 1, 1, 1, '2017-05-04 00:46:16', '2017-05-04 01:08:01'),
(15, 'How to modify the site\'s theme', 'how-to-modify-the-site\'s-theme', 1, 'Introduction', 'Theming in stepostr allows the administrator to set the the site\'s theme profile as well as set site banner and background images. This page contains information on how to set the site\'s theme.\r\n\r\nNote: Managing categories is only limited to the administrator account.\r\n', 0, '', '', 1, 'Step', 1, 1, 'Conclusion', 'By following these steps, you should be able to successfully modify the site\'s theme.', 1, 1, 1, 1, '2017-05-04 01:03:32', '2017-05-04 01:03:32'),
(16, 'Accessing the site\'s admin portal', 'accessing-the-site\'s-admin-portal', 0, 'Introduction', 'The site\'s admin portal is where the site configuration and management happens. This is where the administrator or the contributors could manage and publish pages. \r\n\r\nTo access the site\'s admin portal, you need to just add an \"/admin\" subdirectory in the site\'s url. For example, if the site\'s url is \"http://example.com\", then the admin portal is located at \"http://example.com/admin\". Navigating to that url will show the admin portal\'s login page. You need to know the username and password you need to use beforehand.', 0, '', '', 0, 'Step', 0, 0, 'Conclusion', '', 1, 1, 1, 1, '2017-05-04 01:14:05', '2017-05-04 01:14:05'),
(17, 'Navigating a stepostr powered site', 'navigating-a-stepostr-powered-site', 1, 'Introduction', 'The stepostr platform was designed to provide an easy way to published step by step or listed out information. Even though the goal of the platform aims to satisfy the need of the site\'s authors, the platform still makes sure that the public site\'s navigation experience is rich and usable since at the end of the day, the one that will read the posts are the visitors and they should be able to easily go through the site\'s sections to find what they are looking for.\r\n\r\nThis page contains list of ways on how a visitor could navigate a site powered by stepostr.', 0, '', '', 0, 'Step', 0, 0, 'Conclusion', '', 1, 2, 1, 1, '2017-05-04 01:27:52', '2017-05-04 01:40:12'),
(18, 'stepostr Release 1.0.0', 'stepostr-release-1-0-0', 1, 'Introduction', 'Finally it\'s here!\r\n\r\nThe development for stepostr (/stɛp/-/ˈpoʊ stər/)\'s initial release (1.0.0)  was completed on May 4, 2017 and will soon be available to the public via its GitHub repository: https://github.com/aosardez/stepostr.\r\n', 1, 'What\'s included?', '', 0, 'Step', 0, 1, 'What\'s next?', '', 2, 1, 1, 1, '2017-05-04 01:47:25', '2017-05-04 01:54:09'),
(19, 'Demo Notes', 'demo-notes', 1, 'Demo sites', 'We have the following sites which demonstrates how stepostr works: (please copy the links and paste them in the browser)\r\n\r\nVanilla stepostr instance demo site:\r\n* Public area: https://stepostr.000webhostapp.com (this site)\r\n* Admin area: https://stepostr.000webhostapp.com/admin\r\n\r\n\"Joie\'s Kitchen\" - a cookery blog that uses stepostr:\r\n* Public area: https://stepostr-cookery.000webhostapp.com\r\n* Admin area: https://stepostr-cookery.000webhostapp.com/admin\r\n\r\n\"Compute Team\'s Linux Admin Guide Book\" - a sample site that show\'s stepostr\'s use as a process guide repository for teams:\r\n* Public area: https://stepostr-linuxadmin.000webhostapp.com\r\n* Admin area: https://stepostr-linuxadmin.000webhostapp.com/admin\r\n\r\n\"Luke\'s Father\" - a Star Wars fan site powered by \"the force\" of stepostr:\r\n* Public area: https://stepostr-starwars.000webhostapp.com/\r\n* Admin area: https://stepostr-starwars.000webhostapp.com//admin', 0, '', '', 0, 'Step', 0, 1, 'Note:', 'When trying out the admin area, you may add new users, posts, etc. and edit and delete them, but please do not edit or delete the existing contents.', 4, 1, 1, 1, '2017-05-04 16:08:18', '2017-05-05 01:33:12');

-- --------------------------------------------------------

--
-- Table structure for table `pagestep`
--

CREATE TABLE `pagestep` (
  `id` int(11) NOT NULL,
  `pageId` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `order` int(11) DEFAULT '0',
  `body` text,
  `imagePath` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pagestep`
--

INSERT INTO `pagestep` (`id`, `pageId`, `name`, `order`, `body`, `imagePath`) VALUES
(6, 9, 'Login to the admin portal', 1, 'The first thing you need to do is to login to the admin portal.', '/uploads/images/2017-05-03/edit-account-1.png'),
(7, 9, 'Edit account details under My Account section', 2, 'Once logged-in, you will be automatically redirected to My Account section. You may now modify your account details.', '/uploads/images/2017-05-03/edit-account-2.png'),
(8, 9, 'Click Save button', 3, 'Finally, you just need to click the Save button located at the bottom of the page to complete the process.', '/uploads/images/2017-05-03/edit-account-3.png'),
(9, 10, 'Login to the admin portal', 1, 'You need to be logged in to the admin portal to begin with,', '/uploads/images/2017-05-03/create-page-1.png'),
(10, 10, 'Go to Pages section', 2, 'By default, you will be redirected to My Account section when you login. You need to go to the Pages section in order to publish pages.', '/uploads/images/2017-05-03/create-page-2.png'),
(11, 10, 'Click Add New button', 3, 'You need to click the Add New button in the pages section in order to create a new page.', ''),
(12, 10, 'Set the page\'s details', 4, 'You can now set the page\'s details such as its title, introduction, body, etc. You may also set the labels of each section and even the steps.', '/uploads/images/2017-05-03/create-page-3.png'),
(13, 10, 'Tick the published checkbox', 5, 'Pages created are not published by default. You need to tick the published checkbox in order for it to be displayed in the public section of the site.', '/uploads/images/2017-05-03/create-page-4.png'),
(14, 10, 'Click Save button', 6, 'One the page\'s details are set, you can now click the Save button located at the bottom of the page, to save the page.', ''),
(15, 10, 'Add steps', 7, 'The only time you can create steps is once you saved the page. You will find out that the Add Steps button is now enabled in the middle of the page and you can now create page steps.', '/uploads/images/2017-05-03/create-page-5.png'),
(16, 10, 'Set the page step\'s details', 8, 'In the Page Step Details page, provide the page step\'s information such as the step name, order, and body text. You may also browse for an image file related to the step.', '/uploads/images/2017-05-03/create-page-6.png'),
(17, 10, 'Add additional steps by clicking the Add New button', 9, 'You may also modify created steps and even delete ones which are not needed.', '/uploads/images/2017-05-03/create-page-7.png'),
(18, 10, 'Visit site to see the published page', 10, 'Once the steps are all defined, you can then visit the site to see how your page, plus its steps, looks like.', '/uploads/images/2017-05-03/create-page-8.png'),
(19, 11, 'Login to the admin portal', 1, 'You need to be logged-in to the admin portal to begin with.', '/uploads/images/2017-05-03/manage-contributors-1.png'),
(20, 11, 'Go to the Contributors section', 2, 'You need to go to the  Contributors section.', '/uploads/images/2017-05-04/manage-contributors-2.png'),
(21, 11, 'Add, Edit or Delete Contributor records', 3, 'You can then manage contributors by adding new ones, editing an existing one\'s details, and deleting some.\r\nIf you add or edit a contributor, you will be redirected to the Contributor Details page where you can set the contributor\'s particulars such as his \\ her username, password, display name, if the account is active, etc.', '/uploads/images/2017-05-04/manage-contributors-3.png'),
(22, 12, 'Login to the admin portal', 1, 'To begin with, you need to login to the admin portal first.', '/uploads/images/2017-05-04/manage-categories-1.png'),
(23, 12, 'Go to the Categories section', 2, 'You should then go to the Categories section by clicking Categories in the menu.', '/uploads/images/2017-05-04/manage-categories-2.png'),
(24, 12, 'Add, Edit or Delete Categories', 3, 'You can then add new categories by clicking the Add New button, edit an existing category by clicking the Edit button, or delete a category by clicking the Delete button.\r\n\r\nIf you chose to add or edit a category, you will be redirected to the Category Details page wherein you can modify the category\'s particulars. A category by the way is like page too since you can publish or unpublish them as well. Don\'t forget to click the Save button to save the changes made.', '/uploads/images/2017-05-04/manage-categories-3.png'),
(25, 13, 'Login to the admin portal', 1, 'You need to be logged-in to the admin portal first.', '/uploads/images/2017-05-04/modify-about-page-1.png'),
(26, 13, 'Go to the About Site section', 2, 'The site\'s details are located in the About Site section. You can access it by going to Site Configuration > About Site from the menu.\r\nOnce in the About Site page, modify the site\'s particulars as well as the about page contents.', '/uploads/images/2017-05-04/modify-about-page-2.png'),
(27, 13, 'Save changes', 3, 'Lastly, you need to click the Save button for the changes to take effect.', '/uploads/images/2017-05-04/modify-about-page-3.png'),
(28, 15, 'Login to the admin portal', 1, 'You need to be logged in to the admin portal to begin with,', '/uploads/images/2017-05-04/modify-theme-1.png'),
(29, 15, 'Go to Site Theme section', 2, 'You need to go to the site theme section by going to Site Configuration > Site Theme under in the menu.', '/uploads/images/2017-05-04/modify-theme-2.png'),
(30, 15, 'Set the site\'s theme particulars', 3, 'Set the site\'s theme particulars such as the theme name and banner and background images.', '/uploads/images/2017-05-04/modify-theme-3.png'),
(31, 15, 'Save changes', 4, 'For the changes to take effect, you need to click the Save button. Doing so will also enable the new theme configuration right away in both the admin portal and the public section of the site.', '/uploads/images/2017-05-04/modify-theme-4.png'),
(32, 16, 'The login page', 1, 'A stepostr powered site\'s login page.', '/uploads/images/2017-05-04/login-page.png'),
(33, 17, 'Navigating the home page', 1, 'The home page is the first page the user will see when they visit the site. This will also list out the latest pages published by the site\'s authors.', '/uploads/images/2017-05-04/navigate-home.png'),
(34, 17, 'Browsing the categories', 2, 'The categories (accessed via the menu) contains list of pages grouped per topic (or category). This section offers an easy way for the visitors to look for pages they want to read under a certain topic.', '/uploads/images/2017-05-04/navigate-category.png'),
(35, 17, 'Searching for a page', 3, 'The site also offers a capability for the visitors to search for pages based on given keywords. The visitor could perform a search by typing the keywords in the search text box located at the menu.', '/uploads/images/2017-05-04/navigate-search.png'),
(36, 17, 'About the site', 4, 'The visitor could also go to the about page via the menu to learn more about the site.', '/uploads/images/2017-05-04/navigate-about.png'),
(37, 17, 'Opening pages', 5, 'Finally what the visitor would most likely want to do is to read published articles. He \\ she can do it by opening the page. Opening pages could be done by directly going to the page\'s url in the browser (if it is known) or by clicking the page title as it is listed in the home page, category section, or search results.', '/uploads/images/2017-05-04/navigate-open-page.png'),
(39, 19, 'Navigation and administration intructions', 1, 'You may refer to the pages \\ posts under the user guide category of the main demo site: \r\n* https://stepostr.000webhostapp.com/category/user-guide\r\n\r\nThose pages contains information on how to navigate the public area (as a user) and how to maintain the site (as the administrator or a contributor).', ''),
(40, 19, 'Admin area login details', 2, 'There are 2 default accounts which could be used for accessing the admin sections of the demo site (http(s)://[sitname]/admin):\r\n\r\nAdministrator Account:\r\n* Username: admin\r\n* Password: password\r\n\r\nSample Contributor Account:\r\n* Username: user\r\n* Password: password', '');

-- --------------------------------------------------------

--
-- Table structure for table `sitedetail`
--

CREATE TABLE `sitedetail` (
  `title` varchar(50) DEFAULT NULL,
  `tagline` varchar(100) DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sitedetail`
--

INSERT INTO `sitedetail` (`title`, `tagline`, `dateModified`) VALUES
('stepostr (/stɛp/-/ˈpoʊ stər/)', 'This is a stepostr powered site. Enjoy!', '2017-05-03 19:20:27');

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE `theme` (
  `name` varchar(50) DEFAULT NULL,
  `showSiteName` tinyint(4) DEFAULT NULL,
  `showBannerImage` tinyint(4) DEFAULT NULL,
  `bannerImagePath` varchar(250) DEFAULT NULL,
  `showBackgroundImage` tinyint(4) DEFAULT NULL,
  `backgroundImagePath` varchar(250) DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`name`, `showSiteName`, `showBannerImage`, `bannerImagePath`, `showBackgroundImage`, `backgroundImagePath`, `dateModified`) VALUES
('stepostr-light', 0, 0, '/uploads/images/2017-05-02/testbg.png', 0, '/uploads/images/2017-05-02/testbgbody.png', '2017-05-04 00:59:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagestep`
--
ALTER TABLE `pagestep`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `pagestep`
--
ALTER TABLE `pagestep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
