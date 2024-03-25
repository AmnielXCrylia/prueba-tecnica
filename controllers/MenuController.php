<?php
include_once "models/Menu.php";
include_once "models/Submenu.php";
class MenuController {

    public function index()
    {
        $menu = Menu::all();
        $subMenu = SubMenu::all();
        view("menu.index", ["menus" => $menu, "subMenus" => $subMenu]);
    }

}


?>