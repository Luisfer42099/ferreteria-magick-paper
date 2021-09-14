<?php
    require_once 'header.php';
    require_once '../conrollers/userscontroller.php';

    $usua = new Usuarios();

    if(isset($_POST['registrarse'])){
        $nom = isset($_POST['nombre']) ? $_POST['nombre'] : false;
        $ema = isset($_POST['email']) ? $_POST['email'] : false;
        $cla = isset($_POST['password']) ? $_POST['password'] : false;

        if ($nom && $ema && $cla){
            $activa = $usua->Registro($nom, $ema, $cla);
            if($activa){
                header("Location: ../index.php");
            }else{
                echo "<script>alert('No se pudo hacer el registro.')</script>";
                echo $activa;
            }
        }else{
            echo "<script>alert('No se pudo hacer el registro.')</script>";
        }
    }
?> 

<div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8"><h2><b>Registro de usuarios</b></h2></div></div>
                <div class="col-ms-12">
                    <form action="" method="POST">
                        <div class="col-md-12">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" required>
                        </div>
                        <div class="col-md-12">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" required>
                        </div>
                        <div class="col-md-12">
                            <label for="password">Contraseña</label>
                            <input type="password" name="password" id="password" required>
                        </div>
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-primary" value="Registrarse" name="registrarse">
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../partes/footer.php'; ?>