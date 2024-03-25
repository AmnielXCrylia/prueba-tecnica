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

    public function catalogo()
    {
        $menu = Menu::all();
        $subMenu = SubMenu::all();
        view("menu.catalogo", ["menus" => $menu, "subMenus" => $subMenu]);
    }

    public function createMenu() 
    {
        $data = json_decode(file_get_contents('php://input'));
        $subMenu = new SubMenu();

        $subMenu->id_menu_padre = $data->menuPadre;
        $subMenu->nombre = $data->nombre;
        $subMenu->descripcion = $data->descripcion;
        
        $subMenu->save();

        echo json_encode($subMenu);
    }

    public function updateMenu() 
    {
        $data = json_decode(file_get_contents('php://input'));
        $subMenu = SubMenu::find($data->id);
        $subMenu->id_menu_padre = $data->menuPadre;
        $subMenu->nombre = $data->nombre;
        $subMenu->descripcion = $data->descripcion;
        $subMenu->save();

        echo json_encode($subMenu);
    }

    public function deleteMenu($id) 
    {
        try {
            $subMenu = SubMenu::find($id);
            $subMenu->remove();
            echo json_encode(['status' => true]);
        } catch (\Throwable $th) {
            echo json_encode(['status' => false]);
        }
        
    }

    public function findMenu($id)
    {
        $subMenu = SubMenu::find($id);
        echo json_encode($subMenu);
    }

}


?>