<?php
include "includes/conn.php";

$table = $_POST["table"];
$table_name = getTable($conn, $_POST["table"]);
if (isset($_POST['invoice']))
{
    $wait = $_POST["wait"];
	$invoice = $_POST['invoice'];
	$record = explode (":", $invoice);
	for ($i = 2; $i <= count($record); $i+=2)
	{
		switch($i)
		{
			case 2:
			$mesa10 = $record[0] . ';' . $record[1];
			break;
			case 4:
			$mesa11 = $record[2] . ';' . $record[3];
			break;
			case 6:
			$mesa12 = $record[4] . ';' . $record[5];
			break;
			case 8:
			$mesa13 = $record[6] . ';' . $record[7];
			break;
			case 10:
			$mesa14 = $record[8] . ';' . $record[9];
			break;
			case 12:
			$mesa15 = $record[10] . ';' . $record[11];
			break;
			case 14:
			$mesa16 = $record[12] . ';' . $record[13];
			break;
			case 16:
			$mesa17 = $record[14] . ';' . $record[15];
			break;
		}
	}
}
if (!isset($_POST["wait"]))
{
    $wait = "";
}
$title = "Pedido de la Mesa: " . $table_name;
include "includes/header.php";
?>
<h2>Facturando : <?php echo $table_name ?></h2>
<br><br>
<section class="container-fluid pt-3">
<div id="view1">
<div id="pc"></div>
<div id="mobile"></div>
<div class="row">
	<div class="col-md-1"></div>
		<div class="col-md-8">
			<label><select class="name" name="plate" id="meal">
                <option value="">Selecciona un Plato</option>
			<?php
			$stmt = $conn->prepare('SELECT * FROM food WHERE kind=0;');
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_OBJ))
			{
				echo  '<option value="' . $row->id . ',' . $row->name . ',' . $row->price . '">' . $row->name . ', ' . $row->price . '</option>';
			}
			?>
			</select> Plato Seleccionado por el Cliente&nbsp;&nbsp;&nbsp;</label>
            <label><input id="qtty" type="number" name="qtty" value="1" min="1"> Cantidad de Platos</label>
            </div>
            <div class="col-md-2">
			<button onclick="add_plate()" class="btn btn-info btn-lg">Agregar Plato</button>
		</div>
	<div class="col-md-1"></div>
</div>
<br><br><br>
<div class="row">
	<div class="col-md-1"></div>
		<div class="col-md-8">
			<label><select class="name" name="bever" id="bev">
            <option value="">Selecciona una Bebida</option>
			<?php
			$stmt = $conn->prepare('SELECT * FROM food WHERE kind=1;');
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_OBJ))
			{
				echo  '<option value="' . $row->id . ',' . $row->name . ',' . $row->price . '">' . $row->name . ', ' . $row->price . '</option>';
			}
			?>
			</select> Bebida Seleccionada por el Cliente</label>
			<label><input id="qtty2" type="number" name="qtty2" value="1" min="1"> Cantidad de Bebidas</label>
            </div>
            <div class="col-md-2">
			<button onclick="add_bebida()" class="btn btn-info btn-lg">Agregar Bebida</button>
		</div>
	<div class="col-md-1"></div>
</div>
<br><br><br>
<div class="row">
	<div class="col-md-1"></div>
		<div class="col-md-8">
			<label><select class="name" name="dessert" id="dess">
            <option value="">Selecciona un Postre</option>
			<?php
			$stmt = $conn->prepare('SELECT * FROM food WHERE kind=2;');
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_OBJ))
			{
				echo  '<option value="' . $row->id . ',' . $row->name . ',' . $row->price . '">' . $row->name . ', ' . $row->price . '</option>';
			}
			?>
			</select> Postre Seleccionado por el Cliente&nbsp;</label>
			<label><input id="qtty3" type="number" name="qtty3" value="1" min="1"> Cantidad de Postres</label>
            </div>
            <div class="col-md-2">
			<button onclick="add_postre()" class="btn btn-info btn-lg">Agregar Postre</button>
		</div>
	<div class="col-md-1"></div>
</div>
<br><br><br>
<div class="row">
	<div class="col-md-1"></div>
		<div class="col-md-8">
			<label><select class="name" name="coffe" id="coffe">
            <option value="">Selecciona un Café</option>
			<?php
			$stmt = $conn->prepare('SELECT * FROM food WHERE kind=3;');
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_OBJ))
			{
				echo  '<option value="' . $row->id . ',' . $row->name . ',' . $row->price . '">' . $row->name . ', ' . $row->price . '</option>';
			}
			?>
			</select> Café Seleccionado por el Cliente&nbsp;</label>
			<label><input id="qtty4" type="number" name="qtty4" value="1" min="1"> Cantidad de Cafés</label>
            </div>
            <div class="col-md-2">
			<button onclick="add_coffe()" class="btn btn-info btn-lg">Agregar Café</button>
		</div>
	<div class="col-md-1"></div>
</div>
<br><br><br>
<div class="row">
	<div class="col-md-1"></div>
		<div class="col-md-8">
			<label><select class="name" class="name" name="wine" id="wine">
            <option value="">Selecciona un Vino</option>
			<?php
			$stmt = $conn->prepare('SELECT * FROM food WHERE kind=4;');
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_OBJ))
			{
				echo  '<option value="' . $row->id . ',' . $row->name . ',' . $row->price . '">' . $row->name . ', ' . $row->price . '</option>';
			}
			?>
			</select> Vino Seleccionado por el Cliente&nbsp;</label>
			<label><input id="qtty5" type="number" name="qtty5" value="1" min="1"> Cantidad de Vino</label>
            </div>
            <div class="col-md-2">
			<button onclick="add_wine()" class="btn btn-info btn-lg">Agregar Vino</button>
		</div>
	<div class="col-md-1"></div>
</div>
<br><br><br>
<form action='addInvoice.php' method="post">
<input type="hidden" name="client" value="">
    <label><select name="client" style="width: 600px;">
            <option value="">Consumidor Final</option>
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
    </select> Nombre del Cliente a Facturar</label>
    <input type="hidden" name="table" value="<?php echo $table; ?>">
    <input type="hidden" name="invoice" id="invoice">
    <input type="hidden" name="wait" value="<?php echo $wait; ?>">
    <br><br>
    <input type="submit" value="Facturar" class="btn btn-primary btn-lg">
</form>
<br>
<br>
<h2 id="platos" style="font-size:xx-large"></h2>
<h4 id="plate"></h4>
</div>
</section>
<?php
if (isset($_POST['invoice']))
{
	for ($i = 2; $i <= count($record); $i+=2)
	{
		switch($i)
		{
			case 2:
			echo '<script>addData("' . $mesa10 . '")</script>';
			break;
			case 4:
			echo '<script>addData("' . $mesa11 . '")</script>';
			break;
			case 6:
			echo '<script>addData("' . $mesa12 . '")</script>';
			break;
			case 8:
			echo '<script>addData("' . $mesa13 . '")</script>';
			break;
			case 10:
			echo '<script>addData("' . $mesa14 . '")</script>';
			break;
			case 12:
			echo '<script>addData("' . $mesa15 . '")</script>';
			break;
			case 14:
			echo '<script>addData("' . $mesa16 . '")</script>';
			break;
			case 16:
			echo '<script>addData("' . $mesa17 . '")</script>';
			break;
			case 18:
			echo '<script>addData("' . $mesa18 . '")</script>';
			break;	
		}
	}
}
echo "<button style='float:right; width:128px; height:64px;' onclick='deleting(" . '"' . $table . '"' . ")'  class='btn btn-danger'>Anular Factura</button><br><br><br>";
?>
<?php
include "includes/footer.html";

function getTable($conn, $table)
{
    $sql = "SELECT mesa FROM mesa WHERE id=$table;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    return $row->mesa;
}
?>