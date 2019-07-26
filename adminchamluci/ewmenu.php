<?php
namespace PHPMaker2019\project1;

// Menu Language
if ($Language && $Language->LanguageFolder == $LANGUAGE_FOLDER)
	$MenuLanguage = &$Language;
else
	$MenuLanguage = new Language();

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(3, "mi_clientes", $MenuLanguage->MenuPhrase("3", "MenuText"), "clienteslist.php", -1, "", IsLoggedIn() || AllowListMenu('{5B4DA292-B8B0-4B7A-BB01-3B5D66F23446}clientes'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(1, "mi_blog", $MenuLanguage->MenuPhrase("1", "MenuText"), "bloglist.php", -1, "", IsLoggedIn() || AllowListMenu('{5B4DA292-B8B0-4B7A-BB01-3B5D66F23446}blog'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(2, "mi_categorias", $MenuLanguage->MenuPhrase("2", "MenuText"), "categoriaslist.php", -1, "", IsLoggedIn() || AllowListMenu('{5B4DA292-B8B0-4B7A-BB01-3B5D66F23446}categorias'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(4, "mi_contaco", $MenuLanguage->MenuPhrase("4", "MenuText"), "contacolist.php", -1, "", IsLoggedIn() || AllowListMenu('{5B4DA292-B8B0-4B7A-BB01-3B5D66F23446}contaco'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(5, "mi_correos", $MenuLanguage->MenuPhrase("5", "MenuText"), "correoslist.php", -1, "", IsLoggedIn() || AllowListMenu('{5B4DA292-B8B0-4B7A-BB01-3B5D66F23446}correos'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(7, "mi_header", $MenuLanguage->MenuPhrase("7", "MenuText"), "headerlist.php", -1, "", IsLoggedIn() || AllowListMenu('{5B4DA292-B8B0-4B7A-BB01-3B5D66F23446}header'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(8, "mi_laempresa", $MenuLanguage->MenuPhrase("8", "MenuText"), "laempresalist.php", -1, "", IsLoggedIn() || AllowListMenu('{5B4DA292-B8B0-4B7A-BB01-3B5D66F23446}laempresa'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(9, "mi_productos", $MenuLanguage->MenuPhrase("9", "MenuText"), "productoslist.php?cmd=resetall", -1, "", IsLoggedIn() || AllowListMenu('{5B4DA292-B8B0-4B7A-BB01-3B5D66F23446}productos'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(10, "mi_slider", $MenuLanguage->MenuPhrase("10", "MenuText"), "sliderlist.php", -1, "", IsLoggedIn() || AllowListMenu('{5B4DA292-B8B0-4B7A-BB01-3B5D66F23446}slider'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(11, "mi_usuario", $MenuLanguage->MenuPhrase("11", "MenuText"), "usuariolist.php", -1, "", IsLoggedIn() || AllowListMenu('{5B4DA292-B8B0-4B7A-BB01-3B5D66F23446}usuario'), FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>