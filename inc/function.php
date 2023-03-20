<?php
function result($conn, $row, $where, $how) // Función result recibe la conexión, las filas de la base de datos $row y un 1 o un 0 para saber de donde se llama.
{
    global $table, $client, $wait, $price, $partial, $product, $qtty, $winy, $winy_price;
    $eacharticle = [];
    if ($how == 0)
    {
        $table = $row["table_id"];
        $client = getClient($conn, $row["client_id"]);
        $wait = getWait($conn, $row["wait_id"]);
    }
    else
    {
        $table = $row->table_id;
        $client = getClient($conn, $row->client_id);
        $wait = getWait($conn, $row->wait_id);
    }

    // for ($i = 0; $i < count($productArray) - 1; $i++)
    // {
    //     $eacharticle[$i] = explode(":", $productArray[$i]);
    //     if ($i == count($productArray) - 2)
    //     {
    //         $qtty .= $qttyArray[$i];
    //         $partial .= $partialArray[$i] . " $";
    //     }
    //     else
    //     {
    //         if ($where == 1) // Si $where es 1, se llamo desde la tabla HTML.
    //         {
    //             $qtty .= $qttyArray[$i] . "<br>";
    //             $partial .= $partialArray[$i] . " $<br>";
    //         }
    //         else // Si no es 1 se llamo desde la plantilla de Excel.
    //         {
    //             $qtty .= $qttyArray[$i] . "\n";
    //             $partial .= $partialArray[$i] . " $\n";
    //         }
    //     }
    // }

    $sql = "SELECT id FROM invoice ORDER BY id DESC LIMIT 1;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    $id = $row->id;

    $i = 0;
    $sql  = "SELECT * FROM sold WHERE invoice_id=$id;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_OBJ))
    {
        $article[$i] = $row->food_id;
        $wine[$i] = $row->wine_id;
        $qtties[$i] = $row->article_qtty;
        $i++;
    }

    $j = 0;
    for ($i = 0; $i < count($wine); $i++)
    {
        if ($wine[$i] != null)
        {
            $sql = "SELECT name, price FROM wine WHERE id=$wine[$i]";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_OBJ))
            {
                $wines[$j] = $row->name;
                $wine_price[$j] = $row->price;
                $j++;
            }
        }
    }

    for ($i = 0; $i < count($article); $i++)
    {
        $sql_product = "SELECT name, price FROM food WHERE id=$article[$i];";
        $stmt = $conn->prepare($sql_product);
        $stmt->execute();
        $row_product = $stmt->fetch(PDO::FETCH_OBJ);
        $product_name = $row_product->name;
        $product_price = $row_product->price;
        $partials[$i] = $product_price * $qtties[$i];
        if ($i == count($article) - 1)
        {
            $product .= $product_name;
            $price .= number_format((float)$product_price, 2, ',', '.') . " $";
            $qtty .= $qtties[$i];
            $partial .= $partials[$i];
            if ($j > 0)
            {
                for ($z = 0; $z < $j; $z++)
                {
                    $winy .= $wine[$z];
                    $winy_price .= $wine_price[$z];
                }
            }
        }
        else
        {
            if ($where == 1) // Si $where es 1, se llamo desde la tabla HTML.
            {
                $product .= $product_name . "<br>"; // Saltos de línea HTML.
                $price .= number_format((float)$product_price, 2, ',', '.') . " $<br>";
                $qtty .= $qtties[$i] . "<br>";
                $partial .= $partials[$i] . "<br>";
            }
            else // Si no es 1 se llamo desde la plantilla de Excel.
            {
                $product .= $product_name . "\n"; // Saltos de línea \n.
                $price .= number_format((float)$product_price, 2, ',', '.') . " $\n";
                $qtty .= $qtties[$i] . "\n";
                $partial .= $partials[$i] . "\n";
            }
        }
    }
}

function getClient($conn, $name)
{
    if ($name != null)
    {
        $sql = "SELECT name FROM delivery WHERE id=$name;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row->name;
    }
    else
    {
        return "Consumidor Final";
    }
}

function getWait($conn, $wait)
{
    if ($wait != null)
    {
        $sql = "SELECT name FORM wait WHERE id=$wait;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row->name;
    }
    else
    {
        return "Fonda 13";
    }
}
?>