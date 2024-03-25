<?php
class Menu extends Conection
{
    public $id_menu_padre;
    public $nombre;
    public $descripcion;

    public static function all(){
        $db = new Conection();
        
        $sql = "SELECT mp.nombre, '' as Menu_Padre, mp.descripcion FROM menu_padre mp UNION ALL
        SELECT nombre, (select mp2.nombre from menu_padre mp2 where mp2.id_menu_padre = mh.id_menu_padre) as Menu_Padre, descripcion FROM menu_hijo mh";
        $sql = "SELECT * FROM menu_padre";

        $prepare = $db->prepare($sql);
        $prepare->execute();

        return $prepare->fetchAll(PDO::FETCH_CLASS, Menu::class);
    }

    public static function find($id)
    {
        $$db = new Conection();
        $prepare = $db->prepare("SELECT * FROM menu_pare WHERE id_menu_padre = :id");
        $prepare->execute([":id" => $id]);

        return $prepare->fetchObject(Menu::class);
    }

    public function save()
    {
        $params = [":nombre" => $this->nombre, "descripcion" => $this->descripcion];
        if(empty($this->id)) {
            $prepare = $this->prepare("INSERT INTO menu_padre (descripcion, nombre)
            VALUES (:descripcion, :nombre)");
            $prepare->execute($params);
        } else {
            $params[":id_menu_padre"] = $this->id_menu_padre;
            $prepare = $this->prepare("UPDATE menu_padre SET nombre = :nombre, descripcion = :descripcion WHERE id_menu_padre = :id_menu_padre");
            $prepare->execute($params);
        }
    }

    public function remove()
    {
        $prepare = $this->prepare("DELETE FROM menu_padre WHERE id_menu_padre = :id_menu_padre");
        $prepare->execute([":id_menu_padre" => $this->id_menu_padre]);
    }

}