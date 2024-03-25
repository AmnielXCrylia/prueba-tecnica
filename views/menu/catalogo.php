<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                
                <a class="navbar-brand" href="#">Evaluación</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNavDropdown">

                    <ul class="navbar-nav">
                    
                        <?php for ($i = 0; $i < count($menus); $i++) : ?>
                    
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo $menus[$i]->nombre ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php for ($j = 0; $j < count($subMenus); $j++) : ?>
                                        <?php if($menus[$i]->id_menu_padre == $subMenus[$j]->id_menu_padre){?>
                                            <li  class="subMenu"><a data-id="<?php echo $subMenus[$j]->id_menu_hijo;?>" class="dropdown-item" href="#" ><?php echo$subMenus[$j]->nombre ?></a></li>
                                        <?php }?>
                                    <?php endfor ?>
                                </ul>
                            </li>
                        <?php endfor ?>
                    </ul>

                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="card">
            <div class="card-header" id="cardHeader">
                Catalogos
            </div>
            <div class="card-body">
                <h5 class="card-title" id="cardTitle">Profesiones</h5>
                <p class="card-text" id="cardDescription">Listado de profesiones</p>
            </div>
        </div>
    </div>
 
<script>
    let dataSubMenus = <?php echo json_encode($subMenus);?>;
    let dataMenus = <?php echo json_encode($menus);?>;
    const selectSubMenu = (event) => {
        let id = event.target.dataset.id
        // console.log(id);
        for (let i = 0; i < dataSubMenus.length; i++) {
            if(id == dataSubMenus[i].id_menu_hijo){
                for (let j = 0; j < dataMenus.length; j++) {
                    if(dataSubMenus[i].id_menu_padre == dataMenus[j].id_menu_padre){
                        document.getElementById("cardHeader").innerHTML= dataMenus[j].nombre;
                        document.getElementById("cardTitle").innerHTML= dataSubMenus[i].nombre;;
                        document.getElementById("cardDescription").innerHTML= dataSubMenus[i].descripcion;;
                     break;
                    }
                }
                break;
            }
            
        }
    }
    
    console.log(dataSubMenus);
    let subMenus = document.querySelectorAll('.subMenu');
    for (let i = 0; i < subMenus.length; i++) {
        subMenus[i].addEventListener('click',selectSubMenu);
    }
</script>
</body>
</html>