<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruteria PHP</title>
</head>
<body>
    <?php
    $tiendaNombre = "Fruteria PHP";
    $abierto=True;
    $descuento=9.5;
    //Inicializamos el array de frutas

    $frutas = array(
        "manzana" => 0,
        "plátano" => 0,
        "naranja" => 0,
        "fresa" => 0,
        "mandarina" => 0,
        "toronja" => 0,
        "yuca" => 0,
        "kiwi" => 0,
        "sandia" => 0
        
    );

    // Procesamos el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($frutas as $fruta => $precio) {
        if (isset($_POST[$fruta])) {
            $frutas[$fruta] = floatval($_POST[$fruta]);
        }
    }
}
function aplicarDescuento($precio, $descuento) {
    return $precio - ($precio * $descuento / 100);
}

function precioTotal(){
    global $frutas;

    $total = 0; 
    foreach ($frutas as $fruta => $precio) {
        $total += $precio;
}
return $total;
}


if ($abierto) {
    echo "<h1>Bienvenido a $tiendaNombre</h1>";
   
    // Formulario para introducir precios
    echo "<h2>Introduce los precios de las frutas:</h2>";
    echo "<form method='post'>";
    foreach ($frutas as $fruta => $precio) {
        echo "<label for='$fruta'>$fruta:</label>";
        echo "<input type='number' step='0.01' name='$fruta' id='$fruta' value='$precio'><br>";
    }
    echo "<input type='submit' value='Actualizar precios'>";
    echo "</form>";


    echo "<h2>Nuestras frutas:</h2>";
    echo "<ul>";


    foreach ($frutas as $fruta => $precio) {
        $precioConDescuento = aplicarDescuento($precio, $descuento);
        echo "<li>$fruta: $precio (Con descuento: " ."$" . number_format($precioConDescuento, 2) . ")</li>";
    }
    echo "</ul>";
   
    $totalFrutas = count($frutas);
    echo "<p>Total de frutas: $totalFrutas</p>";
    echo "El total de su compra es " . precioTotal();
       
    echo "<h3>Oferta especial:</h3>";
    for ($i = 1; $i <= 3; $i++) {
        echo "<p>Compra $i kg de cualquier fruta y llévate un jugo gratis!</p>";
    }

    //Sistena de descuentos por compra
    $precio_total = precioTotal();

    switch ($precio_total){
        case  2500:
            $descuento=5.9;
            $nuevo_descuento = aplicarDescuento($precio, $descuento);
            echo "<p>La oferta segun su oferta es: $nuevo_descuento</p>";
            break;
            case 3500:
                $descuento=15.6;
                $nuevo_descuento = aplicarDescuento($precio, $descuento);
                echo "<p>La oferta segun su oferta es: $nuevo_descuento</p>";
            break;
            case  5000:
                $descuento=20.5;
                $nuevo_descuento = aplicarDescuento($precio, $descuento);
                echo "<p>La oferta segun su oferta es: $nuevo_descuento</p>";
            break;
            default:
                echo "<p>No hay descuento papu";
            }

         

        echo "<br></br>";

        echo "<form method='post'>";
        echo "<label>Agregue una fruta</label>";
        echo "<input type='text' name='nueva_fruta' placeholder='Ingrese fruta'>";  // Agregar 'name' y 'placeholder'
        echo "<input type='submit' name='agregar' value='Agregar'>";  // Agregar 'name' al botón
        echo "<br></br>";

        echo "<label>Eliminar una fruta</label>";
        echo "<input type='text' name='fruta_a_eliminar' placeholder='Ingrese fruta'>";  // Agregar 'name' y 'placeholder'
        echo "<input type='submit' name='eliminar' value='Eliminar'>";  // Agregar 'name' al botón
        echo "</form>";

        echo "<br></br>";

        

else {
    echo "<h1>Lo sentimos, estamos cerrados</h1>";
}




?>
</body>
</html>