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
        //Połączenie się z bazą danych o nazwie "rpnk_bd" na serwerze localhost
        $conn=new mysqli("localhost","root","","rpnk_bd");
        if(!$conn){
        die("Połączenie się nie udało".mysql_error());
        }
        if(!isset($_COOKIE['imie']) && !isset($_COOKIE['nazwisko'])){
            setcookie("imie", "", time()-3600);
            setcookie("nazwisko", "", time()-3600);
            header('Location: glowna.php');
        }
        //Wylogowanie się
        if(isset($_POST['wyloguj'])){
            setcookie("imie", "", time()-3600);
            setcookie("nazwisko", "", time()-3600);
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
                        <div class="col-lg-4 col-sm-12">
                            <h3 class="text-light text-center" style="margin-top:10px;">Zmień menu</h3>
                            <?php
                                //Formularz który dodaje nowe dania do tabeli 'dania' po wypełnieniu danymi
                                $min=$conn->query("SELECT id FROM dania ORDER BY id ASC LIMIT 1;");
                                $max=$conn->query("SELECT id FROM dania ORDER BY id DESC LIMIT 1;");
                                $min2=$min->fetch_assoc();
                                $max2=$max->fetch_assoc();
                                echo "<form class='text-light text-start' name='nowe_danie' action='' method='post' style='margin-left:10px'>";
                                echo "<h4 class='text-center'>Dodaj nowe danie do menu: </h4>";
                                echo "<label>Wprowadź nazwę dania: </label></br>";
                                echo "<input type='text' name='dodaj_nazwe' id='dodaj_nazwe' placeholder='Nazwa dania'></br>";
                                echo "<label>Wprowadź typ dania: </label></br>";
                                echo "<select id='typy' name='typy' value='Typ dania'>";
                                echo "<option value='1'>Zupa</option>";
                                echo "<option value='2'>Danie główne</option>";
                                echo "<option value='3'>Przekąska</option>";
                                echo "<option value='4'>Napój</option>";
                                echo "</select></br>";
                                echo "<label>Wprowadź cenę dania: </label></br>";
                                echo "<input type='number' name='cena' id='cena' min='1'></br>";
                                echo "<input type='submit' name='dodaj' id='dodaj' value='Dodaj danie' style='margin-top:5px'>";
                                echo "</form>";
                                //Dodanie wprowadzonych danych do tabeli
                                if(isset($_POST['dodaj'])){
                                    $typ=$_POST['typy'];
                                    $nazwa=$_POST['dodaj_nazwe'];
                                    $cena=$_POST['cena'];
                                    $result=$conn->query("INSERT INTO dania(typ, nazwa, cena) VALUES ('$typ', '$nazwa', '$cena')");
                                    if($result==TRUE){
                                        echo "<p class='text-center text-light'>Nowe danie zostało dodane</p>";
                                    }
                                }
                                //Formularz który modyfikuje cenę dania po wprowadzeniu ID danie, które chcemy zmienić oraz nowj ceny
                                echo "<form class='text-light text-start' name='zmien_danie' action='' method='post' style='margin-left:10px'>";
                                echo "<h4 class='text-center' style='border-top:3px solid white; padding-top:10px; margin-top:5px;'>Zmień cenę dania</h4>";
                                echo "<label>Podaj ID dania: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>";
                                echo "<input type='number' name='danie_id' id='danie_id' min='".$min2["id"]."' max='".$max2["id"]."'></br>";
                                echo "<label>Podaj nową cenę: &nbsp; </label>";
                                echo "<input type='number' name='nowa_cena' id='nowa_cena' min='1'></br>";
                                echo "<input type='submit' name='zmien_cene' id='zmien_cene' value='Zmień cenę' style='margin-top:5px'></br>";
                                //Modyfikowanie danych w tabeli
                                if(isset($_POST['zmien_cene'])){
                                    $id=$_POST['danie_id'];
                                    $nowa_cena=$_POST['nowa_cena'];
                                    $result=$conn->query("UPDATE dania SET cena=$nowa_cena WHERE id=$id");
                                    if($result==TRUE){
                                        echo "<p class='text-center text-light'>Cena została zmieniona</p>";
                                    }
                                }
                                //Formularz który usuwa dania z tabeli 'dania'
                                echo "<form class='text-light text-start' name='usun_d' action='' method='post' style='margin-left:10px'>";
                                echo "<h4 class='text-center' style='border-top:3px solid white; padding-top:10px; margin-top:5px;'>Usuń danie</h4>";
                                echo "<label>Podaj ID dania: &nbsp; </label>";
                                echo "<input type='number' name='usun_danie_id' id='usun_danie_id' min='".$min2["id"]."' max='".$max2["id"]."'></br>";
                                echo "<input type='submit' name='usun_danie' id='usun_danie' value='Usuń danie' style='margin-top:5px'></br>";
                                echo "</form>";
                                //Usunięcie dania z tabeli
                                if(isset($_POST['usun_danie'])){
                                    $id=$_POST['usun_danie_id'];
                                    $result=$conn->query("DELETE FROM dania WHERE id=$id");
                                    if($result==TRUE){
                                        echo "<p class='text-center text-light'>Danie zostało usunięte</p>";
                                    }
                                }
                            ?>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <form class="text-center" name="wyswietl" action="" method="post">
                                <input type="submit" name="wyswietl_dania" id="wyswietl_dania" value="Wyświetl dania" style="margin-top:10px;">
                                <input type="submit" name="wyswietl_zam" id="wyswietl_zam" value="Wyświetl zamówienia" style="margin-top:10px;">
                            </form>
                            <?php
                                //Wyświetlenie id, nazwy oraz ceny wszystkich potraw z tabeli 'dania'
                                if(isset($_POST['wyswietl_dania'])){
                                    echo "<table class='table table-striped table-light text-center'>";
                                    echo "<tr class='table table-info'>";
                                    echo "<th style='border:2px dashed black; padding:2px; font-size:20px;'>ID dania</th>";
                                    echo "<th style='border:2px dashed black; padding:2px; font-size:20px;'>Nazwa potrawy</th>";
                                    echo "<th style='border:2px dashed black; padding:2px; font-size:20px;'>Cena</th>";
                                    echo "</tr>";
                                    $result=$conn->query("SELECT id, nazwa, cena FROM dania ORDER BY id ASC;");
                                    while($row=$result->fetch_assoc()){
                                        echo "<tr><td style='border:2px dashed black; padding:2px; font-size:20px;'>".$row["id"]."</td><td style='border:2px dashed black; padding:2px; font-size:20px;'>".$row["nazwa"]."</td><td style='border:2px dashed black; padding:2px; font-size:20px;'>".$row["cena"]."</td></tr>";
                                    }
                                    echo "</table>";

                                }
                                //Wyświetlenie wszystkich informacji na temat zamówień klientów
                                if(isset($_POST['wyswietl_zam'])){
                                    echo "<table class='table table-striped table-light text-center'>";
                                    echo "<tr class='table table-info'>";
                                    echo "<th style='border:2px dashed black; padding:2px; font-size:20px;'>ID zamówienia</th>";
                                    echo "<th style='border:2px dashed black; padding:2px; font-size:20px;'>ID klienta</th>";
                                    echo "<th style='border:2px dashed black; padding:2px; font-size:20px;'>ID dania</th>";
                                    echo "<th style='border:2px dashed black; padding:2px; font-size:20px;'>Status zamówienia</th>";
                                    echo "</tr>";
                                    $result=$conn->query("SELECT * FROM zamowienia;");
                                    while($row=$result->fetch_assoc()){
                                        echo "<tr><td style='border:2px dashed black; padding:2px; font-size:20px;'>".$row["id"]."</td><td style='border:2px dashed black; padding:2px; font-size:20px;'>".$row["klient_id"]."</td><td style='border:2px dashed black; padding:2px; font-size:20px;'>".$row["danie_id"]."</td><td style='border:2px dashed black; padding:2px; font-size:20px;'>".$row["status_zam"]."</td></tr>";
                                    }
                                    echo "</table>";
                                }
                            ?>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <h3 class="text-light text-center" style="margin-top:10px;">Zmień status zamówień</h3>
                            <?php
                                //Formularz do edytowania statusu zamówienia
                                $min=$conn->query("SELECT id FROM zamowienia ORDER BY id ASC LIMIT 1;");
                                $max=$conn->query("SELECT id FROM zamowienia ORDER BY id DESC LIMIT 1;");
                                $min2=$min->fetch_assoc();
                                $max2=$max->fetch_assoc();
                                echo "<form class='text-light text-start' name='zmien_status_zam' action='' method='post' style='margin-left:10px'>";
                                echo "<h4 class='text-center'>Zmień status zamówienia: </h4>";
                                echo "<label>Wprowadź ID zamówienia: </label></br>";
                                echo "<input type='number' name='zam_id' id='zam_id' min='".$min2["id"]."' max='".$max2["id"]."'></br>";
                                echo "<label>Podaj status zamówienia: </label></br>";
                                echo "<select id='status' name='status' value='Status Zamówienia'>";
                                echo "<option value='1'>Zamówienie zostało wysłane (1)</option>";
                                echo "<option value='2'>Zamówienie jest przygotowywane (2)</option>";
                                echo "<option value='3'>Zamówienie jest w drodze (3)</option>";
                                echo "<option value='4'>Zamówienie zostało dostarczone (4)</option>";
                                echo "</select></br>";
                                echo "<input type='submit' name='zmien_status' id='zmien_status' value='Zmień status' style='margin-top:5px'>";
                                echo "</form>";
                                //Zmienienie statusu w tabeli 'zamowienia'
                                if(isset($_POST['zmien_status'])){
                                    $id=$_POST['zam_id'];
                                    $status=$_POST['status'];
                                    $result=$conn->query("UPDATE zamowienia SET status_zam=$status WHERE id=$id");
                                    if($result==TRUE){
                                        echo "<p class='text-center text-light'>Status został zmieniony</p>";
                                    }
                                }
                                //Formularz do usunięcie zamówienia wybranego przez użytkownika
                                echo "<form class='text-light text-start' name='usun_zamowienie' action='' method='post' style='margin-left:10px'>";
                                echo "<h4 class='text-center' style='border-top:3px solid white; padding-top:10px; margin-top:5px;'>Usuń zamówienie</h4>";
                                echo "<label>Podaj ID zamówienia: &nbsp; </label>";
                                echo "<input type='number' name='id_zam' id='id_zam' min='".$min2["id"]."' max='".$max2["id"]."'></br>";
                                echo "<input type='submit' name='usun_zam' id='usun_zam' value='Usuń zamówienie' style='margin-top:5px'></br>";
                                echo "</form>";
                                //Usunięcie wybranego zamówienia
                                if(isset($_POST['usun_zam'])){
                                    $id=$_POST['id_zam'];
                                    $result=$conn->query("DELETE FROM zamowienia WHERE id=$id");
                                    if($result==TRUE){
                                        echo "<p class='text-center text-light'>Zamówienie zostało usunięte</p>";
                                    }
                                }
                                //Formularz do usunięcia wszystkich zamówień które zostały już dostarczone do klientów
                                echo "<form class='text-light text-start' name='usun_dostarczone_zamowienia' action='' method='post' style='margin-left:10px'>";
                                echo "<h4 class='text-center' style='border-top:3px solid white; padding-top:10px; margin-top:5px;'>Usuń wszystkie dostarczone zamówienia</h4>";
                                echo "<input type='submit' name='usun_dostarczone' id='usun_dostarczone' value='Usuń dostarczone zamówienia' style='margin-top:5px'></br>";
                                echo "</form>";
                                //Usunięcie wszystkich dostarczonych zamówień
                                if(isset($_POST['usun_dostarczone'])){
                                    $result=$conn->query("DELETE FROM zamowienia WHERE status_zam=4");
                                    if($result==TRUE){
                                        echo "<p class='text-center text-light'>Wszystkie dostarczone dania zostały usunięte</p>";
                                    }
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