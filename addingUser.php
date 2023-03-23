<?php
include "includes/conn.php";
include "includes/modal-dismiss.html";
$title = "Agregando un Cliente para Delivery/Facturación";
include "includes/header.php";
$name = htmlspecialchars($_POST['client']);
$dni = htmlspecialchars($_POST['dni']);
$pass = htmlspecialchars($_POST['pass']);
$hash = password_hash($pass, PASSWORD_DEFAULT);
$email = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['phone']);
$address = htmlspecialchars($_POST['address']);
$ok = false;

$sql = "SELECT id FROM client WHERE phone='$phone' OR email='$email' OR dni='$dni';";
$stmt = $conn->prepare($sql);
$stmt->execute();
if ($stmt->rowCount() > 0)
{
    echo "<script>toast ('1', 'Cliente ya Registrado', 'El Teléfono, E-mail o D.N.I. ya Están Registrados en la Base de Datos. Si Hay Algúna Modificación en los Datos Usa Modificar o Eliminar Clientes.');</script>";
}
else
{
    $ok = true;
}

if ($ok)
{
    $stmt = $conn->prepare('INSERT INTO client VALUES(:id, :name, :dni, :email, :pass, :phone, :address)');
    if ($dni != "")
    {
        $stmt->execute(array(':id' => null, ':name' => $name, ':dni' => $dni, ':email' => $email, ':pass' => $hash, ':phone' => $phone, ':address' => $address));
    }
    else
    {
        $stmt->execute(array(':id' => null, ':name' => $name, ':dni' => null, ':email' => $email, ':pass' => $hash, ':phone' => $phone, ':address' => $address));
    }
    echo "<script>toast ('0', 'Cliente : " . $name . " Agregado Correctamente.', 'Se a Agregado el Cliente Para Hacer Pedidos a Domicilio.');</script>";
}
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
?>