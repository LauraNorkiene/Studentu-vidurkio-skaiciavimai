<?php
if (isset($_POST['upload'])) {
    move_uploaded_file(
        $_FILES['failas']['tmp_name'],
        'C:/xampp/htdocs/studentai/' . $_FILES['failas']['name']
    );

    $failas = 'C:/xampp/htdocs/studentai/' . $_FILES['failas']['name'];
    $f = fopen($failas, "r");

    $studnetVidurkis = array();
    while ($row = fgets($f)) {
        $studentas = explode(",", $row);
        $pazymiuKiekis = 0;
        $suma = 0;
        for ($i = 1; $i < sizeof($studentas); $i++) {
            $suma += $studentas[$i];
            $pazymiuKiekis++;
        }

        $temp = $suma / $pazymiuKiekis;
        $vidurkis = round($temp, 2);
        $studnetVidurkis[$studentas[0]] = $vidurkis;

        echo "Studento pažymių suma: <strong>$suma</strong> ir pažymių kiekis: <strong>$pazymiuKiekis</strong>, tai jų vidurkis: <strong>$vidurkis</strong> <br>";
    }

    $mokiniuKiekis = 0;
    $suma = 0;

    foreach ($studnetVidurkis as $sk) {
        $suma += $sk;
        $mokiniuKiekis++;
    }

    $temp = $suma / $mokiniuKiekis;
    $vidurkisGrupes = round($temp, 2);

    fclose($f);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="row justify-content-center">
        <div class="col-5">
            <div class="card mt-5">
                <div class="card-body">

                    <form class="mt-3" method="POST" action="" enctype="multipart/form-data">
                        <input type="hidden" name="upload" value="1">
                        <input type="file" name="failas">
                        <button>Išsiųsti</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <?php
        echo "<strong>Bendras grupės vidurkis:</strong> $vidurkisGrupes <br>";
        echo "<strong>Mokiniu kiekis:</strong> $mokiniuKiekis <br>";
        echo "<hr>";
        print_r($studnetVidurkis);
        echo "Pazymiu suma: $suma ir pazymiu kiekis: $pazymiuKiekis, tai vidurkis: $vidurkis  <br>";
        echo "<hr>";
        ?>
    </div>

    <div class="row justify-content-center">
        <div class="col-5">
            <div class="card mt-5">
                <div class="card-body">
                    <h1>Egzaminą perlaikyti turi:</h1>
                    <table class="mt-4 pt-3 mx-auto">
                        <thead class="headding">
                            <td>Eil. Nr.</td>
                            <td>Vardas</td>
                            <td>Vidurkis</td>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $nr = 1;
                                foreach ($studnetVidurkis as $key => $value) {
                                    if ($value < 5) {
                                        echo '<td class="headding">' . $nr++ . '</td>';
                                        echo '<td>' . $key . '</td>';
                                        echo ' <td>' . $value . '</td>';
                                    }
                                    echo ' </tr>';
                                }
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="card mt-5">
                <div class="card-body">
                    <h1>Stipendiją gaus:</h1>
                    <table class="mt-4 pt-3 mx-auto">
                        <thead class="headding">
                            <td>Eil. Nr.</td>
                            <td>Vardas</td>
                            <td>Vidurkis</td>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $nr = 1;
                                foreach ($studnetVidurkis as $key => $value) {
                                    if ($value > 8.5) {
                                        echo '<td class="headding">' . $nr++ . '</td>';
                                        echo ' <td>' . $key . '</td>';
                                        echo ' <td>' . $value . '</td>';
                                    }
                                    echo '</tr>';
                                }

                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>