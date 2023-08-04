<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo Tabla</title>
    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script defer src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>

<body>
    <div class="card">
        <div class="card-header">Filtro</div>
        <div class="card-body">
            <form action="" method="post">
                Fecha inicial:
                <input type="date" name="inicio" id="inicio">
                Fecha final:
                <input type="date" name="fin" id="fin">
                <input class="btn btn-primary  btn-space" type="submit" value="Filtrar">
                &nbsp;|&nbsp;&nbsp;<a class="  btn btn-warning  btn-space" href="ventas.php">Mostrar todos</a>
            </form>
        </div>
    </div>
    <br>
    <table id="tabla" class="display " style="width:100%">
        <thead>
            <tr>
                <th>No. Venta</th>
                <th>Fecha</th>
                <th>Cliente</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $whereConsulta = "";
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST["inicio"]) && isset($_POST["fin"])) {
                    $whereConsulta = " where fechaventa between '" . $_POST["inicio"] . "' and '" . $_POST["fin"] . "'";
                }
            }
            $servername = "localhost";
            $username = "root";
            $password = "desarrollo";
            $dbname = "awfacturademo";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "select v.idventa, v.fechaventa, c.nombrecliente, c.apaternocliente, c.amaternocliente from venta as v inner join cliente as c on c.idcliente = v.idcliente " . $whereConsulta;

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>
                            <td>' . $row["idventa"] . '</td>
                            <td>' . $row["fechaventa"] . '</td>
                            <td>' . $row["nombrecliente"] . $row["apaternocliente"] . $row["amaternocliente"] . '</td>
                        </tr>';
                }
            }
            $conn->close();
            ?>

        </tbody>
    </table>


</body>

</html>