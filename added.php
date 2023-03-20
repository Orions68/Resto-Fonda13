<?php
include "inc/fw.php";
$name = $_POST['product'];
$price = $_POST['price'];
$id = $_POST['id'];

switch ($id)
{
    case "Plato":
        $sql = "INSERT INTO meal VALUES(:id, :name, :price);";
        break;
    case "Bebida":
        $sql = "INSERT INTO bev VALUES(:id, :name, :price);";
        break;
    case "Postre":
        $sql = "INSERT INTO dess VALUES(:id, :name, :price);";
        break;
    case "Vino":
        $sql = "INSERT INTO wine VALUES(:id, :name, :price);";
        break;
    default:
        $sql = "INSERT INTO coffe VALUES(:id, :name, :price);";
}

$stmt->execute(array(':id' => null, ':name' => $name, ':price' => $price));
echo "<script>if (!alert('Artículo : " . $name . " Agregado Correctamente.')) window.close('_self')</script>";
$title = "Artículo Agregado";
include "inc/header.php";
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
include "inc/footer.html";
?>