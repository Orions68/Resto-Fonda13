<?php
include "inc/fw.php";

if (isset($_POST["table"]))
{
    $table = $_POST['table'];
    if (file_exists($table . ".txt"))
    {
        unlink($table . ".txt");
    }
    $client = $_POST["client"];
    if ($client == 0)
    {
        $client = null;
    }
    $invoice = $_POST['invoice'];
    $wait = $_POST["wait"];
    if ($wait == 0)
    {
        $wait = null;
    }
    $date = date("Y-m-d");
    $time = date("H:i:s");
    $article = "";
    $qtty1 = "";
    $prices = "";
    $part = "";
    $total = 0;
    $j = 0;

    $record = explode (",", $invoice);
    for ($i = 0; $i < count($record) - 1; $i+=4)
    {
        $id[$j] = $record[$i];
        $price[$j] = $record[$i + 2];
        $qtty[$j] = $record[$i + 3];
        $total += $price[$j] * $qtty[$j];
        $j++;
    }
    echo $i . "<br>" . $record[0] . "<br>" . $record[1];
}
include "inc/modal-invoice.html";
$title = "Guardando Factura";
include "inc/header.php";
?>
<section class="container-fluid pt-3">
    <div id="pc"></div>
    <div id="mobile"></div>
    <div class="row">
        <div class="col-md-1"></div>
            <div class="col-md-10">
                <div id="view1">
                    <?php
                    $stmt = $conn->prepare('INSERT INTO invoice VALUES(:id, :client_id, :wait_id, :table_id, :total, :date, :time);');
                    $stmt->execute(array(':id' => null, ':client_id' => $client, ':wait_id' => $wait, ':table_id' => $table, ':total' => $total, ':date' => $date, ':time' => $time));
                    $sql = "SELECT id FROM invoice ORDER BY id DESC LIMIT 1;";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_OBJ);
                    $invoice_id = $row->id;

                    $sql = "INSERT INTO sold VALUES(:id, :invoice_id, :food_id, :wine_id, :article_qtty);";
                    $stmt = $conn->prepare($sql);
                    for ($i = 0; $i < count($id); $i++)
                    {
                        echo $i . "<br>" . $id[$i];
                        if ($id[$i] >= 1000)
                        {
                            $stmt->execute(array(':id' => null, ':invoice_id' => $invoice_id, ':food_id' => null, ':wine_id' => $id[$i], ':article_qtty' => $qtty[$i]));
                        }
                        else
                        {
                            $stmt->execute(array(':id' => null, ':invoice_id' => $invoice_id, ':food_id' => $id[$i], ':wine_id' => null, ':article_qtty' => $qtty[$i]));
                        }
                    }
                    echo "<script>toast('0', 'Facturado', 'Factura de monto: " . $total . " Alamacenada en la Base de Datos Correctamente.');</script>";
                    ?>
                </div>
            </div>
        <div class="col-md-1"></div>
    </div>
</section>
<?php
include "inc/footer.html";
?>