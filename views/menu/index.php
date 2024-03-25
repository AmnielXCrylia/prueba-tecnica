<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de menus</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="mt-5" >Listado de los items del menu</h1>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalForm">Agregar</button>

        <table class="table table-striped mt-4">
            <tr>
                <th>id</th>
                <th>Nombre</th>
                <th>Menu Padre</th>
                <th>Descripcion</th>
                <th>Acciones</th>

            </tr>

            <?php for ($i = 0; $i < count($menus); $i++) : ?>
                <tr data-id="<?php echo $menus[$i]->id_menu_padre;?>">
                    <td><?php echo $menus[$i]->id_menu_padre; ?></td>
                    <td><?php echo $menus[$i]->nombre ?></td>
                    <td></td>
                    <td><?php echo $menus[$i]->descripcion ?></td>
                    <td>
                        <button data-id="<?php echo $menus[$i]->id_menu_padre;?>" class="btn btn-warning">Editar</button>
                        <button data-id="<?php echo $menus[$i]->id_menu_padre;?>" class="btn btn-danger">Eliminar</button>
                    </td>
                </tr>
                <?php for ($j = 0; $j < count($subMenus); $j++) : 
                     if($menus[$i]->id_menu_padre == $subMenus[$j]->id_menu_padre){?>
                        <tr data-id="<?php echo $subMenus[$j]->id_menu_hijo;?>">
                         <td><?php echo $subMenus[$j]->id_menu_hijo ?></td>
                         <td><?php echo $subMenus[$j]->nombre ?></td>
                         <td><?php echo $menus[$i]->nombre ?></td>
                         <td><?php echo $subMenus[$j]->descripcion ?></td>
                         <td>
                             <button data-id="<?php echo $subMenus[$j]->id_menu_hijo;?>" class="btn btn-warning btnEditar">Editar</button>
                             <button data-id="<?php echo $subMenus[$j]->id_menu_hijo;?>" class="btn btn-danger btnEliminar">Eliminar</button>
                         </td>
                     </tr>
                     <?php }?>
                     
                <?php endfor ?>
            <?php endfor ?>
        </table>

        <button class="btn btn-primary" id="viewer" >visualizar</button>

    </div>

    <div class="modal fade" id="modalForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Formulario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" class="form-group" >

                    <div class="form-group">
                        <label for="menuPadre">Menu Padre</label>
                        <select name="menuPadre" id="selectMenuPadre" class="mb-2" >
                            <?php foreach($menus as $menu):?>
                                <option value="<?php echo $menu->id_menu_padre ?>"><?php echo $menu->nombre?></option>
                            <?php endforeach ?>    
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="mb-2" >
                    </div>

                    <div class="form-group d-flex  align-items-center">
                        <label for="descripcion">Descripción</label>
                        <textarea name="descripcion" id="" cols="30" ></textarea>
                    </div>
                    <input type="hidden" id="identificador" value="">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary btnGuardar">Guardar</button>
            </div>
            </div>
        </div>
    </div>




    <script>
        myModal = new bootstrap.Modal(document.getElementById('modalForm'))
        const fetchMenu = (event) => {
            let id = event.target.parentNode.parentNode.dataset.id
            console.log(id);
            axios.get(`http://localhost/prueba-tecnica/menu/findMenu/${id}`).then((res) => {
                let info = res.data;
                console.log(info.nombre);
                document.querySelector('select[name="menuPadre"]').value = info.menuPadre;
                document.querySelector('input[name="nombre"]').value = info.nombre;
                document.querySelector('textarea[name="descripcion"]').value = info.descripcion;
                document.querySelector('#identificador').value = id;
                myModal.show();
            })
        }

        const deleteMenu = (event) => {
            let id = event.target.parentNode.parentNode.dataset.id
            axios.delete(`http://localhost/prueba-tecnica/menu/deleteMenu/${id}`).then( (res) => {
                let info = res.data;
                if(info.status){
                    document.querySelector(`tr[data-id="${id}"]`).remove();
                }
            });
        }

        document.querySelector('.btn.btn-success')
            .addEventListener('click', () => {
                document.querySelector('select[name="menuPadre"]').value = "";
                document.querySelector('input[name="nombre"]').value = "";
                document.querySelector('textarea[name="descripcion"]').value = "";
                document.querySelector('#identificador').value = "";
                myModal.show();
            });

            document.querySelector('.btnGuardar')
            .addEventListener('click', () => {//TODO: Cambiar las rutas en la funcion axios por carpeta /php/prueba-tecnica
                let menuPadre = document.querySelector('select[name="menuPadre"]').value
                let nombre = document.querySelector('input[name="nombre"]').value
                let descripcion = document.querySelector('textarea[name="descripcion"]').value
                let id = document.querySelector('#identificador').value;
                console.log(id);
                axios.post(`http://localhost/prueba-tecnica/menu/${id == "" ? 'createMenu' : 'updateMenu'}`,{
                    menuPadre,
                    nombre,
                    descripcion,
                    id
                })
                .then((r) => {
                    console.log(r.data)
                    let info = r.data;
                    myModal.hide();
                })
            });
        
        let btnsEditar = document.querySelectorAll('.btnEditar');
        let btnsEliminar = document.querySelectorAll('.btnEliminar');
        for (let i = 0; i < btnsEditar.length; i++) {
            btnsEditar[i].addEventListener('click', fetchMenu);
            btnsEliminar[i].addEventListener('click', deleteMenu);        
        }

        document.getElementById("viewer").addEventListener('click', () => {
            axios.get(`http://localhost/prueba-tecnica/menu/catalogo`).then((res) => {
                window.location.href = "http://localhost/prueba-tecnica/menu/catalogo";
            })
        });

    </script>
</body>
</html>