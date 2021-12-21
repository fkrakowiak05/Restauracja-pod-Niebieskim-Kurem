<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width">
      <title></title>
      <link href="style.css" rel="stylesheet" type="text/css"/>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <?php
        //Połączenie się z bazą danych pod tytulem "rpnk_bd" na serwerze localhost
        $conn=new mysqli("localhost","root","","rpnk_bd");
        if(!$conn){
        die("Połączenie się nie udało".mysql_error());
        }
        if(!isset($_COOKIE['telefon'])){ //Jeżeli ciasteczka nie są poprawnie ustawione lub wygasły, użytkownik zostanie przeniesiony do strony głównej
            setcookie("telefon", "", time()-3600);
            header('Location: glowna.php');
        }
        //Wylogowywanie się usuwa ciasteczka i przenosi użytkownika do strony głównej
        if(isset($_POST['wyloguj'])){
            setcookie("telefon", "", time()-3600);
            header('Location: glowna.php');
        }
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-sm-12">
                    <header class="row bg-info">
                        <!-- Przycisk do wylogowania się -->
                        <form name="wyloguj" action="" method="post">
                           <input type="submit" value="Wyloguj" name="wyloguj" style="position:absolute; width:20%; height:50px; border-radius:12px; margin:10px 0 0 10px;">
                        </form>
                        <div class="col-4"><img src="logo.png" alt="logo restauracji od freepik.com"></div>
                        <div class="col-8"><h1 class="fw-bold text-center text-light"></br>RESTAURACJA POD NIEBIESKIM KUREM</h1></div>
                    </header>
                    <div class="row bg-primary">
                        <div class="col-lg-4 col-sm-12" style="margin-top:10px">
                            <h3 class="text-center text-light">Zupy</h3>
                            <table class="table table-striped table-light text-center">
                                <tr class="table table-info">
                                    <th style='border:2px dashed black; padding:2px; font-size:20px;'>Nr. na karcie</th>
                                    <th style='border:2px dashed black; padding:2px; font-size:20px;'>Nazwa potrawy</th>
                                    <th style='border:2px dashed black; padding:2px; font-size:20px;'>Cena</th>
                                </tr>
                                <?php
                                    //Wyświetlenie dań z menu w zależności od typu dania
                                    $result=$conn->query("SELECT id, nazwa, cena FROM dania WHERE typ=1;");
                                    while($row=$result->fetch_assoc()){
                                    echo "<tr><td style='border:2px dashed black; padding:2px; font-size:20px'>".$row["id"]."</td><td style='border:2px dashed black; padding:2px; font-size:20px'>".$row["nazwa"]."</td><td style='border:2px dashed black; padding:2px; font-size:20px'>".$row["cena"]."</tr>";
                                    }
                                ?>
                            </table></br>
                            <h3 class="text-center text-light">Przekąski</h3>
                            <table class="table table-striped table-light text-center">
                                <tr class="table table-info">
                                    <th style='border:2px dashed black; padding:2px; font-size:20px;'>Nr. na karcie</th>
                                    <th style='border:2px dashed black; padding:2px; font-size:20px;'>Nazwa potrawy</th>
                                    <th style='border:2px dashed black; padding:2px; font-size:20px;'>Cena</th>
                                </tr>
                                <?php
                                    $result=$conn->query("SELECT id, nazwa, cena FROM dania WHERE typ=3;");
                                    while($row=$result->fetch_assoc()){
                                    echo "<tr><td style='border:2px dashed black; padding:2px; font-size:20px'>".$row["id"]."</td><td style='border:2px dashed black; padding:2px; font-size:20px'>".$row["nazwa"]."</td><td style='border:2px dashed black; padding:2px; font-size:20px'>".$row["cena"]."</tr>";
                                    }
                                ?>
                            </table></br>
                        </div>
                        <div class="col-lg-4 col-sm-12" style="margin-top:10px">
                            <h3 class="text-center text-light">Dania Główne</h3>
                            <table class="table table-striped table-light text-center">
                                <tr class="table table-info">
                                    <th style='border:2px dashed black; padding:2px; font-size:20px;'>Nr. na karcie</th>
                                    <th style='border:2px dashed black; padding:2px; font-size:20px;'>Nazwa potrawy</th>
                                    <th style='border:2px dashed black; padding:2px; font-size:20px;'>Cena</th>
                                </tr>
                                <?php
                                    $result=$conn->query("SELECT id, nazwa, cena FROM dania WHERE typ=2;");
                                    while($row=$result->fetch_assoc()){
                                    echo "<tr><td style='border:2px dashed black; padding:2px; font-size:20px'>".$row["id"]."</td><td style='border:2px dashed black; padding:2px; font-size:20px'>".$row["nazwa"]."</td><td style='border:2px dashed black; padding:2px; font-size:20px'>".$row["cena"]."</tr>";
                                    }
                                ?>
                            </table></br>
                            <h3 class="text-center text-light">Napoje</h3>
                            <table class="table table-striped table-light text-center">
                                <tr class="table table-info">
                                    <th style='border:2px dashed black; padding:2px; font-size:20px;'>Nr. na karcie</th>
                                    <th style='border:2px dashed black; padding:2px; font-size:20px;'>Nazwa potrawy</th>
                                    <th style='border:2px dashed black; padding:2px; font-size:20px;'>Cena</th>
                                </tr>
                                <?php
                                    $result=$conn->query("SELECT id, nazwa, cena FROM dania WHERE typ=4;");
                                    while($row=$result->fetch_assoc()){
                                    echo "<tr><td style='border:2px dashed black; padding:2px; font-size:20px'>".$row["id"]."</td><td style='border:2px dashed black; padding:2px; font-size:20px'>".$row["nazwa"]."</td><td style='border:2px dashed black; padding:2px; font-size:20px'>".$row["cena"]."</tr>";
                                    }
                                ?>
                            </table></br>
                        </div>
                        <div class="col-lg-4 col-sm-12" style="margin-top:10px;">
                            <h3 class="text-center text-light">Złóż Zamówienie</h3>
                            <?php
                                //formularz do dodawanie nowego zamówienia przez klienta
                                $min=$conn->query("SELECT id FROM dania ORDER BY id ASC LIMIT 1;");
                                $max=$conn->query("SELECT id FROM dania ORDER BY id DESC LIMIT 1;");
                                $min2=$min->fetch_assoc();
                                $max2=$max->fetch_assoc();
                                echo "<form class='text-light text-center' name='zloz_zam' action='' method='post'>";
                                echo "<label>Podaj nr dania: &nbsp;  </label>";
                                echo "<input type='number' name='danie_id' min='".$min2["id"]."' max='".$max2["id"]."'></br>";
                                echo "<input type='submit' value='Zamów' name='zamow'>";
                                echo "</form>";
                                if(isset($_POST['zamow'])){
                                    $danie_id=$_POST['danie_id'];
                                    $klient_id=$_COOKIE['klient_id'];
                                    $result=$conn->query("INSERT INTO zamowienia(klient_id, danie_id, status_zam) VALUES ('$klient_id', '$danie_id', 1)");
                                    //Jeżeli zapytanie zostało poprawnie wykonane, wypisany jest napis mówiący użytkownikowi o tym
                                    if($result==TRUE){
                                        echo "<p class='text-center text-light'>Zamówienie zostało poprawnie złożone</p>";
                                    }
                                }
                            ?>
                            <h3 class="text-center text-light" style="border-top:3px solid white; padding-top:10px; margin-top:5px;">Zobacz swoje zamówienia</h3>
                            <form class="text-light text-center" name="przeglad_zam" action="" method="post">
                                <h4>Status zamówień:</br></h4>
                                <label>1 - Zamówienie zostało wysłane</br></label>
                                <label>2 - Zamówienie jest przygotowywane</br></label>
                                <label>3 - Zamówienie jest w drodze</br></label>
                                <label>4 - Zamówienie zostało dostarczone<br></label>
                                <input type="submit" value="Moje zamówienia" name="przeglad" style="margin-top:5px">
                            </form>
                            <?php
                                //Klient może zobaczyć wszyskie zamówienia przez niego złożone
                                if(isset($_POST['przeglad'])){
                                    $klient_id=$_COOKIE['klient_id'];
                                    $result=$conn->query("SELECT dania.nazwa, zamowienia.status_zam FROM dania INNER JOIN zamowienia ON dania.id=zamowienia.danie_id WHERE zamowienia.klient_id=$klient_id");
                                    echo "</br><table class='table table-striped table-light text-center'>";
                                    echo "<tr class='table table-info'>";
                                    echo "<th style='border:2px dashed black; padding:2px; font-size:20px;'>Nazwa potrawy</th>";
                                    echo "<th style='border:2px dashed black; padding:2px; font-size:20px;'>Status</th>";
                                    echo "</tr>";
                                    while($row=$result->fetch_assoc()){
                                        echo "<tr><td style='border:2px dashed black; padding:2px; font-size:20px'>".$row["nazwa"]."</td><td style='border:2px dashed black; padding:2px; font-size:20px'>".$row["status_zam"]."</tr>";
                                    }
                                    echo "</table>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-12 text-center" style="background-color:skyblue;">
                    <img src="danie1.jpg" alt="'https://pl.freepik.com/zdjecia/jedzenie' Jedzenie zdjęcie utworzone przez timolina - pl.freepik.com" width="70%" height="20%" style="margin:20px;">
                    <img src="restauracja.jpg" alt="'https://pl.freepik.com/zdjecia/tlo' Tło zdjęcie utworzone przez evening_tao - pl.freepik.com" width="70%" height="20%" style="margin:20px;">
                    <img src="danie2.jpg" alt="'https://pl.freepik.com/zdjecia/jedzenie' Zdjęcie utworzone przez timolina - pl.freepik.com" width="70%" height="20%" style="margin:20px;">
                    <img src="danie3.jpg" alt="'https://www.freepik.com/photos/food' Zdjęcie jedzenia utworzone przez freepik - pl.freepik.com" width="70%" height="20%" style="margin:20px;">
                </div>
            </div>
        </div>
        <div class="container-fluid bg-info" style="position:absolute;">
            <div class="row">
                <div class="col-8">
                    <a href="http://www.freepik.com" class="link-dark">Designed by Freepik</a>
                    <a href="https://www.freepik.com/photos/food" class="link-dark">Zdjęcie jedzenie utworzone przez freepik i timolina - www.freepik.com</a></br>
                    <a href="https://pl.freepik.com/zdjecia/tlo" class="link-dark">Zdjęcie restauracji utworzone przez evening_tao - pl.freepik.com</a>
                </div>
                <div class="col-4 text-end">Adres: ul.123 Nisko</br>Telefon: 111 111 111</div>
            </div>
        </div>
        <div class="container-fluid bg-info" style="position:fixed; bottom:0;">
            <div class="row">
                <div class="col-8">
                    <a href="http://www.freepik.com" class="link-dark">Designed by Freepik</a>
                    <a href="https://www.freepik.com/photos/food" class="link-dark">Zdjęcie jedzenie utworzone przez freepik i timolina - www.freepik.com</a></br>
                    <a href="https://pl.freepik.com/zdjecia/tlo" class="link-dark">Zdjęcie restauracji utworzone przez evening_tao - pl.freepik.com</a>
                </div>
                <div class="col-4 text-end">Adres: ul.123 Nisko</br>Telefon: 111 111 111</div>
            </div>
        </div>
    </body>
</html>