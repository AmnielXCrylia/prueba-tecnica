<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de menus</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
                <tr>
                    <td><?php echo $menus[$i]->id_menu_padre ?></td>
                    <td><?php echo $menus[$i]->nombre ?></td>
                    <td></td>
                    <td><?php echo $menus[$i]->descripcion ?></td>
                    <td>
                        <button class="btn btn-warning">Editar</button>
                        <button class="btn btn-danger">Eliminar</button>
                    </td>
                </tr>
                <?php for ($j = 0; $j < count($subMenus); $j++) : 
                     if($menus[$i]->id_menu_padre == $subMenus[$j]->id_menu_padre){?>
                        <tr>
                         <td><?php echo $subMenus[$j]->id_menu_padre ?></td>
                         <td><?php echo $subMenus[$j]->nombre ?></td>
                         <td><?php echo $menus[$i]->nombre ?></td>
                         <td><?php echo $subMenus[$j]->descripcion ?></td>
                         <td>
                             <button class="btn btn-warning">Editar</button>
                             <button class="btn btn-danger">Eliminar</button>
                         </td>
                     </tr>
                     <?php }?>
                     
                <?php endfor ?>
            <?php endfor ?>
        </table>



    </div>


    <!-- Modal -->

    


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
                        <select name="mes" id="mes" class="mb-2" >
                            <option value="1">Enero</option>
                            <option value="2">Febrero</option>
                            <option value="3">Marzo</option>
                            <!-- Resto de los meses -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="mb-2" >
                    </div>
                    <div class="form-group d-flex  align-items-center">
                        <label for="descripcion">Descripción</label>
                        <textarea name="" id="" cols="30" ></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>
            </div>
        </div>
    </div>


    <script>
        document.querySelector('.btn.btn-success')
            .addEventListener('click', () => {
                var myModal = new bootsrap.Modal(document.getElementById('modalForm'))
                myModal.show();
            });
    </script>
</body>
</html>