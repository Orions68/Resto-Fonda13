<?php
include "includes/conn.php";
include "includes/function.php";
$title = "Última Factura";
include "includes/header.php";

$sql = "SELECT *, DATE_FORMAT(inv_date,'%d %M %Y') as date FROM invoice ORDER BY id DESC limit 1";
$stmt_date = $conn->prepare("SET lc_time_names = 'es_ES'");
$stmt_date->execute();
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_OBJ);
$id = $row->id;
$client = $row->client_id;
$wait = $row->wait_id;
$table = getTable($conn, $row->table_id);
$product = "";
$price = "";
$qtty = "";
$partial = "";
$total = $row->total;
$date = $row->inv_date;
$time = $row->inv_time;
?>
<section class="container-fluid pt-3">
<div id="pc"></div>
	<div id="mobile"></div>
    <div class="row">
        <div class="col-md-1"></div>
            <div class="col-md-10">
                <div id="view1">
                    <h1>Fonda 13</h1>
					<?php
					echo '<div id="printable0">
                        <h2>Factura de la Mesa: ' . $table . ' Fecha: ' . $date . '</h2>
						<div class="row">
                            <div style="width: 1px;"></div>
                            <div class="column middle" style="background-color:#d0d0d0;">
                            <h4>Cliente</h4>
                            </div>
                            <div class="column left" style="background-color:#d8d8d8;">
                            <h4>Artículo</h4>
                            </div>
                            <div class="column right" style="background-color:#dedede;">
                            <h4>Precio</h4>
                            </div>
                            <div class="column middle" style="background-color:#e0e0e0;">
                            <h4>Cantidad</h4>
                            </div>
                            <div class="column right" style="background-color:#e8e8e8;">
                            <h4>Parcial</h4>
                            </div>
                            <div class="column middle" style="background-color:#eeeeee;">
                            <h4>Base Imponible</h4>
                            </div>
                            <div class="column middle" style="background-color:#f0f0f0;">
                            <h4>Pago de I.V.A. 10%</h4>
                            </div>
                            <div class="column middle" style="background-color:#f8f8f8;">
                            <h4>Total</h4>
                            </div>
						</div>';

                    result($conn, $row, 1, 1); // Llama a la función result, le pasa la conexión y el resultado de la base de datos.

					echo '<div class="row">
                            <div style="width: 1px;"></div>
                            <div class="column middle" style="background-color:#d0d0d0;">
                            <h5>' . $client . '</h5>
                            </div>
                            <div class="column left" style="background-color:#d8d8d8;">
                            <h5>' . $product . '</h5>
                            </div>
                            <div class="column right" style="background-color:#dedede;">
                            <h5>' . $price . '</h5>
                            </div>
                            <div class="column middle" style="background-color:#e0e0e0;">
                            <h5>' . $qtty . '</h5>
                            </div>
                            <div class="column right" style="background-color:#e8e8e8;">
                            <h5>' . $partial . '</h5>
                            </div>
                            <div class="column middle" style="background-color:#eeeeee;">
                            <h5>' . number_format((float)$total * 100 / 110, 2, ",", ".") . ' $</h5>
                            </div>
                            <div class="column middle" style="background-color:#f0f0f0; text-align: center;">
                            <h5>' . number_format((float)$total * 100 / 110  * .1, 2, ",", ".") . ' $</h5>
                            </div>
                            <div class="column middle" style="background-color:#f8f8f8;">
                            <h5>' . number_format((float)$total, 2, ",", ".") . ' $</h5>
                            </div>
                        </div>
                    <div class="row">
                        <div class="column total">Total I.V.A. Incluido: ' . number_format((float)$total, 2, ",", ".") . ' $
                    </div></div>
                </div>
                    <a id="image0" download="Factura a: ' . $table . '.png"></a>
                    <br><br>
                    <div class="row">
                    <div class="col-md-4">
                    <button onclick="printIt(-1)" style="width:160px; height:80px;" class="btn btn-primary">Imprimir Ticket</button>
                    </div>
                    <div class="col-md-5">
                        <button onclick="pdfDown(0)" class="btn btn-secondary btn-lg">Descarga la Factura en PDF</button>
                    </div>
                    <div class="col-md-3">
                    <button onclick="window.open(\'saveIt.php?id=' . $id . '\', \'_blank\')" style="width:160px; height:80px;" class="btn btn-info">Guardar Factura en Exel</button>
                    <script>capture(0);</script>
                    </div>
                    </div>';
					?>
                    <br><br><br>
                    <button class="btn btn-danger" style="width:160px; height:80px;" onclick="window.close()">Cierra Esta Ventana</button>
				</div>
            </div>
        <div class="col-md-1"></div>
    </div>
</section>
<?php
include "includes/footer.html";
?>