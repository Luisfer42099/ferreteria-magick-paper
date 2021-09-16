<?php require_once 'header.php';
require_once 'conexion/database.php';

if (isset($_POST['ingresar'])) {
    $data = new Database();
    $con = $data->connect();

    $ema = isset($_POST['email']) ? $_POST['email'] : false;
    $cla = isset($_POST['clave']) ? $_POST['clave'] : false;
    if ($ema && $cla) {
        $sql = "SELECT * FROM usuarios WHERE email='$ema' AND clave='$cla'";
        $query = mysqli_query($con, $sql);
        $resultado = mysqli_fetch_object($query);

        $email = $resultado->email;
        $clave = $resultado->clave;

        if ($ema === $email) {
            if ($cla === $clave) {
                session_start();
                $_SESSION['user_id'] = $resultado;
                header("Location: productos/productos.php");
            } else {
                echo "<script>alert('La clave es incoreta')</script>";
            }
        } else {
            echo "<script>alert('El Email es incoreto')</script>";
        }
    } else {
        header('Location: index.php');
    }
}
?>
<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8">
                    <h2><b>inicio de Sesion</b></h2>
                </div>
            </div>
            <div class="col-ms-12">
                <form action="" method="POST">
                    <div class="col-md-6">
                        <label for="usuario">Usuario:</label>
                        <input type="email" name="email" id="email" placeholder="E-mail" required>
                    </div>
                    <div class="col-md 6">
                        <label for="clave">Clave:</label>
                        <input type="password" name="clave" id="clave" placeholder="*********" required>
                    </div>
                    <div class="col-md-6">
                        <input class="btn btn-primary" type="submit" value="Ingresar" name="ingresar">
                    </div>
                </form>
            </div>
            <div class="col-sm-12">
                <a class="btn btn-danger" href="login/registro.php">Registro</a>
            </div>
        </div>
    </div>
</div>
</div>
<?php require_once 'partes/footer.php'; ?>