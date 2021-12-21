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
        die("Połączenie się nie udało".mysql_error()); //komunikat w przypadku błędu połączenia się z bazą
        }
        //Zalogowanie się jako klient
        if(isset($_POST['logowanie-klient'])){
            $telefon=$_POST['telefon']; //Pobieranie dancyh z formularza na stronie
            $haslo=$_POST['haslo'];
            $result=$conn->query("SELECT id, telefon, haslo FROM klienci WHERE telefon='$telefon' AND BINARY haslo='$haslo';"); //Sprawdzenie czy dane logowania się zgadzają z danymi w bazie danych
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    $klient_id=$row["id"];
                }
                setcookie("klient_id", $klient_id, time()+3600); //Ustawienie ciasteczek które wygasną po 1 godzinie
                setcookie("telefon", $telefon, time()+3600);
                header('Location: klient.php'); //Jeżeli logowanie się udało, używkownik zostaje przeniesiony do strony dla klientów
            }
            else{
                //W przypadku błędnie wprowadzonych danych, wyskakuje komunikat
                echo '<script language="javascript">';
                echo 'alert("Logowanie się nie udało - sprawdź, czy dobrze wprowadziłeś dane logowania")'; 
                echo '</script>';
            }
        }
        //Zalogowanie się jako pracownik
        if(isset($_POST['logowanie-pracownik'])){
            $imie=$_POST['imie'];
            $nazwisko=$_POST['nazwisko'];
            $haslo=$_POST['haslo'];
            $result=$conn->query("SELECT imie, nazwisko, haslo FROM pracownicy WHERE imie='$imie' AND nazwisko='$nazwisko' AND BINARY haslo='$haslo';");
            if($result->num_rows>0){
                setcookie("imie", $imie, time()+3600);
                setcookie("nazwisko", $nazwisko, time()+60);
                header('Location: pracownik.php'); //Przeniesienie do strony dla pracowników
            }
            else{
                echo '<script language="javascript">';
                echo 'alert("Logowanie się nie udało - sprawdź, czy dobrze wprowadziłeś dane logowania")';
                echo '</script>';
            }
        }
        //Tworzenie konta dla nowego klienta
        if(isset($_POST['nowe-konto-kl'])){
            $imie=$_POST['imie'];
            $nazwisko=$_POST['nazwisko'];
            $telefon=$_POST['telefon'];
            $email=$_POST['email'];
            $haslo=$_POST['haslo'];
            if(empty($imie) || empty($nazwisko) || empty($telefon) || empty($haslo)){ //Sprawdzenie czy wszystkie wymagane pole zostały wypełnione
                echo '<script language="javascript">';
                echo 'alert("Uzupełnij wsyztkie wymagane pola aby utworzyć konto")';
                echo '</script>';
            }
            else{
                //Dodanie danych nowego klienta do bazy danych, po czym klient zostaje zalogowany do strony dla klientów
                $result=$conn->query("INSERT INTO klienci(imie, nazwisko,  telefon, email, haslo) VALUES ('$imie','$nazwisko','$telefon','$email','$haslo');");
                $result2=$conn->query("SELECT id FROM klienci WHERE imie='$imie' AND nazwisko='$nazwisko'");
                while($row=$result2->fetch_assoc()){
                    $klient_id=$row["id"];
                }
                setcookie("klient_id", $klient_id, time()+3600);
                setcookie("telefon", $telefon, time()+3600);
                header('Location: klient.php');
            }
        }
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-sm-12">
                    <header class="row bg-info">
                        <div class="col-4"><img src="logo.png" alt="logo restauracji od freepik.com"></div>
                        <div class="col-8"><h1 class="fw-bold text-end text-light"></br>RESTAURACJA POD NIEBIESKIM KUREM</h1></div>
                    </header>
                    <div class="row bg-primary">
                        <div class="col-lg-3 col-sm-9">
                            <div class="accordion" id="accordionExample" style="margin:30px; width:100%;">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Zaloguj się do naszej strony!
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <!-- Formularz do logowania się jako klient -->
                                            <form name="form-login-kl" action="" method="post">
                                                <div class="form-floating">
                                                    <input class="form-control input-login" type="text" name="telefon" id="telefon" placeholder="Telefon" style="width:75%"></br>
                                                    <label for="telefon">Telefon</label>
                                                </div>
                                                <div class="form-floating">
                                                    <input class="form-control" type="password" name="haslo" id="haslo" placeholder="Hasło" style="width:75%"></br>
                                                    <label for="haslo">Hasło</label>
                                                </div>
                                                <input type="submit" value="Login" style="width:75%" name="logowanie-klient">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Nie masz konta? Stwórz tutaj!
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <!-- Formularz do tworzenia konta klienta -->
                                            <form name="form-stw-kl" action="" method="post">
                                                <div class="form-floating">
                                                    <input class="form-control" type="text" name="imie" id="imie" placeholder="Imie" style="width:75%"></br>
                                                    <label for="imie">Imie<span class="text-danger">*</span></label>
                                                </div>
                                                <div class="form-floating">
                                                    <input class="form-control" type="text" name="nazwisko" id="nazwisko" placeholder="Nazwisko" style="width:75%"></br>
                                                    <label for="nazwisko">Nazwisko<span class="text-danger">*</span></label>
                                                </div>
                                                <div class="form-floating">
                                                    <input class="form-control" type="text" name="telefon" id="telefon" placeholder="Telefon" style="width:75%"></br>
                                                    <label for="telefon">Telefon<span class="text-danger">*</span></label>
                                                </div>
                                                <div class="form-floating">
                                                    <input class="form-control" type="text" name="email" id="email" placeholder="Email" style="width:75%"></br>
                                                    <label for="email">Email</label>
                                                </div>
                                                <div class="form-floating">
                                                    <input class="form-control" type="password" name="haslo" id="haslo" placeholder="Hasło" style="width:75%"></br>
                                                    <label for="haslo">Hasło<span class="text-danger">*</span></label>
                                                </div>
                                                <input type="submit" value="Stwórz konto" style="width:75%" name="nowe-konto-kl">
                                                <label class="text-danger">* odpowiedź wymagana</label>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Jeżeli tu pracujesz, zaloguj się tutaj.
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <!-- Formularz do logowania się jako pracownik -->
                                            <form name="form-login-pr" action="" method="post">
                                                <div class="form-floating">
                                                    <input class="form-control" type="text" name="imie" id="imie" placeholder="Imie" style="width:75%"></br>
                                                    <label for="imie">Imie</label>
                                                </div>
                                                <div class="form-floating">
                                                    <input class="form-control" type="text" name="nazwisko" id="nazwisko" placeholder="Nazwisko" style="width:75%"></br>
                                                    <label for="nazwisko">Nazwisko</label>
                                                </div>
                                                <div class="form-floating">
                                                    <input class="form-control" type="password" name="haslo" id="haslo" placeholder="Hasło" style="width:75%"></br>
                                                    <label for="haslo">Hasło</label>
                                                </div>
                                                <input type="submit" value="Login" id="input-login" name="logowanie-pracownik" style="width:75%">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 d-flex justify-content-center" style="margin-top:30px;">
                            <table class="table table-striped table-light text-center" style="width:80%;">
                                <tr class="table table-info">
                                    <th style='border:2px dashed black; padding:2px; font-size:20px;'>Nazwa potrawy</th>
                                    <th style='border:2px dashed black; padding:2px; font-size:20px;'>Cena</th>
                                </tr>
                                <?php
                                    //Wybieranie nazwy dań oraz ich ceny z bazy danych oraz wyświetlenie je w formie tabeli
                                    $result=$conn->query("SELECT nazwa, cena FROM dania ORDER BY typ ASC;");
                                    while($row=$result->fetch_assoc()){
                                        echo "<tr><td style='border:2px dashed black; padding:2px; font-size:20px;'>".$row["nazwa"]."</td><td style='border:2px dashed black; padding:2px; font-size:20px;'>".$row["cena"]."</td></tr>";
                                    }
                                ?>
                            </table>
                        </div>
                        <div class="col-lg-3 col-sm-12 text-light text-center" style="margin-top:30px;">
                            <h2>
                                O nas
                            </h2>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae condimentum nisi, et iaculis lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque lacus quam, accumsan a consequat eu, porttitor eu sem. Ut condimentum libero sed quam tincidunt imperdiet. Curabitur porttitor tristique est, vel euismod augue tincidunt eu. In hac habitasse platea dictumst. Etiam nec vulputate magna. Nam posuere libero libero, sed scelerisque nisl pellentesque condimentum. Nam augue dui, eleifend a nisl eget, commodo cursus odio. Maecenas pulvinar velit quis nunc rutrum ullamcorper. Maecenas sed justo nisl.
                            </p>
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