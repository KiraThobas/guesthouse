-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Čtv 06. čec 2017, 09:42
-- Verze serveru: 5.7.14
-- Verze PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `guesthouse`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `mess`
--

CREATE TABLE `mess` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `text` text COLLATE utf8_czech_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `mess`
--

INSERT INTO `mess` (`id`, `date`, `name`, `surname`, `email`, `text`) VALUES
(3, '2017-07-06 11:17:15', 'Pepa', 'Novák', 'pepa@pepa.cz', 'Test2'),
(2, '2017-07-05 22:04:54', 'Karel', 'Vomáčka', 'karel@karel.cz', 'Bla bla bla');

-- --------------------------------------------------------

--
-- Struktura tabulky `page`
--

CREATE TABLE `page` (
  `id` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `menu` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `content` text COLLATE utf8_czech_ci,
  `page_order` int(10) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `page`
--

INSERT INTO `page` (`id`, `title`, `menu`, `content`, `page_order`) VALUES
('uvod', 'Penzion - Úvod', 'Úvodní stránka', '<p>Pie ice cream danish toffee cake gingerbread pie danish lollipop. Chocolate souffl&eacute; powder pastry jelly-o pie chocolate bar. Croissant jelly beans bonbon biscuit marshmallow gingerbread.</p>\r\n<p>Cookie brownie topping icing. Gingerbread liquorice danish sesame snaps toffee. Chocolate cake jelly beans cake.</p>\r\n<p>Powder toffee marzipan fruitcake jelly-o sugar plum souffl&eacute; danish. Caramels pastry cookie ice cream pie. Icing fruitcake topping. Jelly beans tiramisu lollipop cake toffee pie tiramisu.</p>\r\n<p>Gingerbread pudding donut. Souffl&eacute; sweet roll halvah. Toffee wafer cotton candy. Lemon drops pie bonbon. Croissant jelly-o sesame snaps oat cake wafer ice cream liquorice liquorice fruitcake. Cheesecake lollipop jelly beans macaroon toffee gummi bears marzipan carrot cake macaroon. Muffin halvah tootsie roll souffl&eacute; chocolate cake lollipop macaroon jelly beans cotton candy. Sesame snaps toffee tart chupa chups candy lollipop icing wafer tiramisu. Sweet jelly-o danish dessert gummies cheesecake. Croissant carrot cake sweet candy gingerbread croissant tootsie roll. Icing sesame snaps sugar plum. Bonbon icing tart tootsie roll dessert oat cake lemon drops. Chocolate bar jelly beans tart gummies jelly beans carrot cake cake jujubes.</p>\r\n<p>Topping bonbon drag&eacute;e. Gummi bears drag&eacute;e sesame snaps cheesecake drag&eacute;e chupa chups. Topping candy macaroon croissant pudding. Caramels halvah pie halvah. Ice cream chocolate chupa chups. Powder donut chupa chups marshmallow marshmallow. Chocolate jelly beans liquorice lemon drops tootsie roll halvah jelly beans jelly-o. Sesame snaps cupcake cupcake fruitcake souffl&eacute; gummi bears tootsie roll cheesecake. Chocolate cake drag&eacute;e marshmallow halvah cotton candy. Topping tart icing oat cake cake cake muffin. Lemon drops caramels sugar plum chocolate bar macaroon sweet lemon drops chocolate bar danish. Apple pie chocolate cake dessert. Tootsie roll powder jelly carrot cake. Sugar plum macaroon oat cake.</p>', 0),
('kontakt', 'Penzion - Kontakt', 'Kontakt', '<p style="margin: 0;">&nbsp;</p>\r\n<h2 style="margin: 5px 0;">Adresa:</h2>\r\n<p style="margin: 0;">Penzion Medvěd&iacute; sk&aacute;la<br /> Ulice 123<br /> Město 12345</p>\r\n<p style="margin: 0;">&nbsp;</p>\r\n<h2 style="margin: 5px 0;">Mapa:</h2>\r\n<p><iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2637846.4755273312!2d13.232463615427628!3d49.7856521739252!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x470b948fd7dd8243%3A0xf8661c75d3db586f!2zxIxlc2tv!5e0!3m2!1scs!2scz!4v1497198526156" width="600" height="450" frameborder="0" allowfullscreen=""></iframe></p>\r\n<p style="margin: 0;">&nbsp;</p>\r\n<h2 style="margin: 5px 0;">Kontaktn&iacute; formul&aacute;ř:</h2>\r\n<form id="kontaktForm" action="" method="POST">\r\n<table>\r\n<tbody>\r\n<tr>\r\n<th>Jm&eacute;no :</th>\r\n<td><input name="name" size="20" type="text" /></td>\r\n<th>Př&iacute;jmen&iacute;:</th>\r\n<td><input name="surname" size="20" type="text" /></td>\r\n</tr>\r\n<tr>\r\n<th>E-mail:</th>\r\n<td colspan="3"><input name="email" size="60" type="text" /></td>\r\n</tr>\r\n<tr>\r\n<td colspan="4"><textarea style="width: 443px; height: 46px;" cols="46" name="text" rows="4" placeholder="Napi&scaron;te n&aacute;m svůj n&aacute;zor.."></textarea></td>\r\n</tr>\r\n<tr>\r\n<td colspan="4"><input type="submit" value="Odeslat" /><input type="reset" value="Vymazat" /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</form>', 4),
('historie', 'Penzion - Historie', 'Historie', '<p>Pie ice cream danish toffee cake gingerbread pie danish lollipop. Chocolate souffl&eacute; powder pastry jelly-o pie chocolate bar. Croissant jelly beans bonbon biscuit marshmallow gingerbread.</p>\r\n<div class="nahled"><img src="images/foto2.jpg" alt="foto2" width="200" /> <img src="images/foto2.jpg" alt="foto2" width="200" /> <img src="images/foto2.jpg" alt="foto2" width="200" /> <img src="images/foto2.jpg" alt="foto2" width="200" /></div>\r\n<p>Cookie brownie topping icing. Gingerbread liquorice danish sesame snaps toffee. Chocolate cake jelly beans cake.</p>\r\n<p>Powder toffee marzipan fruitcake jelly-o sugar plum souffl&eacute; danish. Caramels pastry cookie ice cream pie. Icing fruitcake topping. Jelly beans tiramisu lollipop cake toffee pie tiramisu.</p>\r\n<p>&nbsp;</p>', 2),
('cenik', 'Penzion - Ceník', 'Ceník', '<p>Pie ice cream danish toffee cake gingerbread pie danish lollipop. Chocolate souffl&eacute; powder pastry jelly-o pie chocolate bar. Croissant jelly beans bonbon biscuit marshmallow gingerbread.</p>\r\n<table cellspacing="0" cellpadding="10">\r\n<tbody>\r\n<tr>\r\n<td colspan="4" align="center">tabulka cen penzionu</td>\r\n</tr>\r\n<tr>\r\n<td>cena</td>\r\n<td>1234</td>\r\n<td>1234</td>\r\n<td>1234</td>\r\n</tr>\r\n<tr>\r\n<td>cena</td>\r\n<td>1234</td>\r\n<td>1234</td>\r\n<td>1234</td>\r\n</tr>\r\n<tr>\r\n<td>cena</td>\r\n<td>1234</td>\r\n<td>1234</td>\r\n<td>1234</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>Cookie brownie topping icing. Gingerbread liquorice danish sesame snaps toffee. Chocolate cake jelly beans cake.</p>\r\n<p>Powder toffee marzipan fruitcake jelly-o sugar plum souffl&eacute; danish. Caramels pastry cookie ice cream pie. Icing fruitcake topping. Jelly beans tiramisu lollipop cake toffee pie tiramisu.</p>', 3),
('onas', 'Penzion - O nás', 'O nás', '<p>Pie ice cream danish toffee cake gingerbread pie danish lollipop. Chocolate souffl&eacute; powder pastry jelly-o pie chocolate bar. Croissant jelly beans bonbon biscuit marshmallow gingerbread.&nbsp;</p>\r\n<div class="nahled"><img src="images/foto3.jpg" alt="foto" width="200" /> <img src="images/foto3.jpg" alt="foto" width="200" /> <img src="images/foto3.jpg" alt="foto" width="200" /> <img src="images/foto3.jpg" alt="foto" width="200" /></div>\r\n<p>Sweet sweet roll macaroon brownie sesame snaps sweet marzipan marshmallow. Pudding chocolate cake apple pie bonbon brownie jujubes cotton candy. Toffee liquorice marshmallow cake. Wafer chocolate cake gummi bears fruitcake sugar plum lollipop jelly beans. Chocolate cake cotton candy dessert sweet sesame snaps chocolate cake wafer cookie. Candy canes candy canes dessert halvah liquorice cake gingerbread chocolate bar marzipan. Cotton candy halvah tootsie roll wafer tart.</p>\r\n<p>Sesame snaps caramels danish croissant cotton candy. Chocolate tart souffl&eacute; chocolate bar tiramisu. Cheesecake chocolate fruitcake powder sweet halvah sesame snaps. Tart chocolate bar jujubes chocolate pudding carrot cake. Jelly caramels macaroon donut chocolate bar dessert. Macaroon donut sesame snaps muffin souffl&eacute;.</p>\r\n<p>Marshmallow liquorice sesame snaps lemon drops oat cake fruitcake. Apple pie marzipan wafer jelly beans souffl&eacute; topping icing wafer jelly. Oat cake tiramisu sugar plum gingerbread dessert icing sweet roll tart cookie. Chupa chups souffl&eacute; chocolate cake powder sweet roll croissant jelly beans tart. Dessert croissant icing. Liquorice drag&eacute;e wafer halvah topping pudding cookie.</p>\r\n<p>Tiramisu carrot cake jelly-o souffl&eacute; macaroon. Sweet roll bear claw caramels wafer marzipan marzipan. Chupa chups chocolate sesame snaps. Chocolate lemon drops donut macaroon gingerbread drag&eacute;e. Pastry apple pie cake. Sweet roll pastry toffee carrot cake sugar plum cake macaroon sweet roll chocolate bar. Apple pie jelly-o sesame snaps chupa chups.</p>\r\n<p>Liquorice drag&eacute;e wafer halvah. Drag&eacute;e tootsie roll carrot cake jujubes. Croissant chocolate bar croissant liquorice. Chocolate bar sesame snaps candy marzipan wafer cookie. Gummi bears tiramisu oat cake cotton candy icing. Cotton candy carrot cake caramels topping ice cream jelly-o carrot cake marzipan croissant. Gummies lollipop toffee pie candy canes ice cream macaroon pudding. Oat cake donut pudding. Sweet gummies tootsie roll sweet roll sweet roll chupa chups fruitcake gummi bears. Pie gummi bears candy chocolate cheesecake biscuit. Marzipan topping icing. Donut sweet oat cake icing croissant lollipop jelly beans brownie.</p>', 1);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `mess`
--
ALTER TABLE `mess`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `mess`
--
ALTER TABLE `mess`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
