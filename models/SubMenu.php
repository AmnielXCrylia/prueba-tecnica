<?php
class SubMenu extends Conection
{
    public $id_menu_padre;
    public $id_menu_hijo;
    public $nombre;
    public $descripcion;

    public static function all(){
        $db = new Conection();
        
        // $sql = "SELECT mp.nombre, '' as Menu_Padre, mp.descripcion FROM menu_padre mp UNION ALL
        // SELECT nombre, (select mp2.nombre from menu_padre mp2 where mp2.id_menu_padre = mh.id_menu_padre) as Menu_Padre, descripcion FROM menu_hijo mh";
        $sql = "SELECT * FROM menu_hijo";

        $prepare = $db->prepare($sql);
        $prepare->execute();

        return $prepare->fetchAll(PDO::FETCH_CLASS, SubMenu::class);
    }

    public static function find($id)
    {
        $$db = new Conection();
        $prepare = $db->prepare("SELECT * FROM menu_hijo WHERE id_menu_hijo = :id");
        $prepare->execute([":id" => $id]);

        return $prepare->fetchObject(SubMenu::class);
    }

    public function save()
    {
        $params = [":id_menu_padre" => $this->id_menu_padre, ":nombre" => $this->nombre, "descripcion" => $this->descripcion,];
        if(empty($this->id_menu_hijo)) {
            $prepare = $this->prepare("INSERT INTO menu_hijo (id_menu_padre, descripcion, nombre)
            VALUES (:descripcion, :nombre)");
            $prepare->execute($params);
        } else {
            $params[":id_menu_hijo"] = $this->id_menu_hijo;
            $prepare = $this->prepare("UPDATE menu_hijo SET nombre = :nombre, descripcion = :descripcion WHERE id_menu_hijo = :id_menu_hijo");
            $prepare->execute($params);
        }
    }

    public function remove()
    {
        $prepare = $this->prepare("DELETE FROM menu_hijo WHERE id_menu_hijo = :id_menu_hijo");
        $prepare->execute([":id_menu_hijo" => $this->id_menu_hijo]);
    }

}