<?php
include "includes/conn.php";
$title = "Artículo Agregado";
include "includes/header.php";
include "includes/modal-deismiss";

if (isset($_POST["product"]))
{
    $name = $_POST['product'];
    $price = $_POST['price'];
    $id = $_POST['id'];

    $sql = "INSERT INTO food VALUES(:id, :name, :price, :kind);";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':id' => null, ':name' => $name, ':price' => $price, ':kind' => $id));
    echo "<script>toast(0, 'Artículo : $name Agregado.', 'El Artículo Ha Sido Agregado a la Base de Datos Correctamente.'));</script>";
    ?>
    <section class="container-fluid pt-3">
        <div id="pc"></div>
        <div id="mobile"></div>
        <div class="row">
            <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div id="view1">
                    </div>
                </div>
            <div class="col-md-1"></div>
        </div>
    </section>
    <?php
    include "includes/footer.html";
}
else
{
    echo "<script>toast(2, 'Error Grave', 'Haz Llegado Aquí por Error.');</script>";
}
?>