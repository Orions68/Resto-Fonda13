<?php
include "includes/conn.php";
include "includes/modal.html";
$title = "Formulario para Agregar un Cliente";
include "includes/header.php";
?>
<section class="container-fluid pt-3">
<div id="pc"></div>
    <div id="mobile"></div>
    <div class="row">
        <div class="col-md-1"></div>
            <div class="col-md-10">
                <div id="view1">
                    <div class="row">
                        <div class="col-md-5">
                        <h1>Registro de Clientes</h1>
                        <h3>La Contraseña y el C.U.I.T. Pueden Quedar en Blanco</h3>
                        <br>
                        <form action="addingUser.php" method="post" onsubmit="return verify()">
                        <label><input type="text" name="client" required> Tu Nombre</label>
                        <br><br>
                        <label><input type="text" name="surname" required> Apellido 1</label>
                        <br><br>
                        <label><input type="text" name="surname2"> Apellido 2</label>
                        <br><br>
                        <label><input id="dni" type="text" name="dni"> D.N.I.</label>
                        <br><br>
                        <label><input type="email" name="email" required> E-mail</label>
                        <br><br>
                        <label><input id="pass" type="password" name="pass"> Contraseña</label>
                        <br><br>
                        <label><input id="pass2" type="password" name="pass2"> Repite Contraseña</label>
                        <br><br>
                        <label><input type="text" name="phone" required> Teléfono</label>
                        <br><br>
                        <label><input type="text" name="address" required> Dirección</label>
                        <br><br>
                        <input type="submit" class="btn btn-primary btn-lg" value="Agrega">
                        </form>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-6">
                            <h1>Modificar los Datos de un Cliente</h1>
                            <br>
                            <form action="modify.php" method="post">
                            <label><select name="client" required>
                                <option value=""> Selecciona un Cliente</option>
                                <?php
                                $sql = "SELECT id, name from client";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                if ($stmt->rowCount() > 0)
                                {
                                    while ($row = $stmt->fetch(PDO::FETCH_OBJ))
                                    {
                                        echo '<option value=' . $row->id . '>' . $row->name . '</option>';
                                    }
                                }
                                ?>
                            </select> Modifica Los Datos de Este Cliente</label>
                            <br><br>
                            <input class="btn btn-secondary" type="submit" value="Modifica los Datos">
                            </form>
                            <br><hr><br>
                            <h1>Elimina un Cliente</h1>
                            <br>
                            <form action="deluser.php" method="post">
                            <label><select name="client" required>
                                <option value=""> Selecciona un Cliente</option>
                                <?php
                                $sql = "SELECT id, name from client";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                if ($stmt->rowCount() > 0)
                                {
                                    while ($row = $stmt->fetch(PDO::FETCH_OBJ))
                                    {
                                        echo '<option value=' . $row->id . '>' . $row->name . '</option>';
                                    }
                                }
                                ?>
                            </select> Elimina Este Cliente</label>
                            <br><br>
                            <input class="btn btn-danger btn-lg" type="submit" value="Elimina los Datos de Este Cliente">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-md-1"></div>
    </div>
</section>
<?php
include "includes/footer.html";
?>