

<!DOCTYPE html>
<html>
<head>
    <title>El debate</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .bojaPoruke{
            color:red;
        }
    </style>
</head>
<body>
<header>
<div class="container">
	<div class="row">
		<div class="col-md-12" align="center">
            <a class="navbar-brand" href="index_ed.php"><img src="img/logo.jpg"/></a>
		</div>
    </div>
    <div class="row">
            <div class="col-md-1">
                <a class="nav-link" href="unos.html">Unos</a>
            </div> 
            <div class="col-md-1">
                <a class="nav-link" href="index_ed.php">Home</a>
            </div>
            <div class="col-md-1">
                <a class="nav-link" href="kategorija.php?id=Mundo">Mundo</a>
            </div>
            <div class="col-md-1">
                <a class="nav-link" href="kategorija.php?id=Deportes">Deportes</a>
            </div>
            <div class="col-md-1">
                <a class="nav-link" href="administracija.php">Administracija</a>
            </div>

    </div>
    </header>
    <div class="container centar">
        <form name="forma" action="" method="POST">
            <div class="form-item">
            <label for="username">Korisničko ime</label>
            <div class="form-field">
            <input type="text" name="username" id="username" class="form-field-textual">
            </div>
            </div>
            <span id="porukaUsername" class="bojaPoruke"></span>
            <div class="form-item">
            <label for="ime">Ime</label>
            <div class="form-field">
            <input type="text" name="ime" id="ime" class="form-field-textual">
            </div>
            </div>
            <span id="porukaIme" class="bojaPoruke"></span>
            <div class="form-item">
            <label for="prezime">Prezime</label>
            <div class="form-field">
            <input type="text" name="prezime" id="prezime" class="form-field-textual">
            </div>
            </div>
            <span id="porukaPrezime" class="bojaPoruke"></span>
            <div class="form-item">
            <label for="lozinka">Lozinka</label>
            <div class="form-field">
            <input type="password" name="lozinka" id="lozinka" class="form-field-textual">
            </div>
            </div>
            <span id="porukaLozinka" class="bojaPoruke"></span>
            <div class="form-item">
            <label for="pLozinka">Ponovite lozinku</label>
            <div class="form-field">
            <input type="password" name="pLozinka" id="pLozinka" class="form-field-textual">
            </div>
            </div>
            <span id="porukaPlozinka" class="bojaPoruke"></span>
            <div class="form-item"><br>
            <button type="submit" value="Registriraj se" name="submit" id="submit">Registriraj se</button>
            </div>
        </form>
    </div>
    <footer class="page-footer text-center blue">
        <p>Gabriela Suša, gsusa@tvz.hr, 2022.</p>
    </footer>


    <?php 
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $username = $_POST['username'];
    $lozinka = $_POST['lozinka'];
    $hashed_password = password_hash($lozinka, CRYPT_BLOWFISH);
    $razina = 0;
    $registriranKorisnik = '';
    $dbc = mysqli_connect('localhost', 'root', '', 'El_debate') or 
    die('Error connecting to MySQL server.'. mysqli_connect_error());
    //Provjera postoji li u bazi već korisnik s tim korisničkim imenom
    $sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }
    if(mysqli_stmt_num_rows($stmt) > 0){
        echo "<p>Korisnik već postoji</p>";
    }
    else{
        // Ako ne postoji korisnik s tim korisničkim imenom - Registracija korisnika u bazi pazeći na SQL injection
        $sql = "INSERT INTO korisnik (ime, prezime,korisnicko_ime,lozinka,razina) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 'ssssd', $ime, $prezime, $username, $hashed_password, $razina);
            mysqli_stmt_execute($stmt);
            $registriranKorisnik = true;
        }
    }
    mysqli_close($dbc);

    if($registriranKorisnik==true){
        echo "<p>Korisnik je uspješno registriran!</p>";
    }
?>
    <script type="text/javascript">
        document.getElementById("submit").onclick=function(event){
            var slanjeForme = true;
        
            // Ime korisnika mora biti uneseno
            var poljeIme = document.getElementById("ime");
            var ime = document.getElementById("ime").value;
            if (ime.length == 0) {
            slanjeForme = false;
            poljeIme.style.border="1px solid red";
            document.getElementById("porukaIme").innerHTML="<br>Unesite ime!<br>";
            } else {
            poljeIme.style.border="1px solid green";
            document.getElementById("porukaIme").innerHTML="";
            }
            // Prezime korisnika mora biti uneseno
            var poljePrezime = document.getElementById("prezime");
            var prezime = document.getElementById("prezime").value;
            if (prezime.length == 0) {
            slanjeForme = false;
            poljePrezime.style.border="1px solid red";
            
            document.getElementById("porukaPrezime").innerHTML="<br>Unesite Prezime!<br>";
            } else {
            poljePrezime.style.border="1px solid green";
            document.getElementById("porukaPrezime").innerHTML="";
            }
            
            // Korisničko ime mora biti uneseno
            var poljeUsername = document.getElementById("username");
            var username = document.getElementById("username").value;
            if (username.length == 0) {
            slanjeForme = false;
            poljeUsername.style.border="1px solid red";
            
            document.getElementById("porukaUsername").innerHTML="<br>Unesite korisničko ime!<br>";
            } else {
            poljeUsername.style.border="1px solid green";
            document.getElementById("porukaUsername").innerHTML="";
            }
            
            // Provjera podudaranja lozinki
            var poljePass = document.getElementById("lozinka");
            var pass = document.getElementById("lozinka").value;
            var poljePassRep = document.getElementById("pLozinka");
            var passRep = document.getElementById("pLozinka").value;
            if (pass.length == 0 || passRep.length == 0 || pass != passRep) {
            slanjeForme = false;
            poljePass.style.border="1px solid red";
            poljePassRep.style.border="1px solid red";
            document.getElementById("porukaLozinka").innerHTML="<br>Lozinke nisu iste!<br>";
            
            document.getElementById("porukaPlozinka").innerHTML="<br>Lozinke nisu iste!<br>";
            } else {
            poljePass.style.border="1px solid green";
            poljePassRep.style.border="1px solid green";
            document.getElementById("porukaLozinka").innerHTML="";
            document.getElementById("porukaPlozinka").innerHTML="";
            }
            
            if (slanjeForme != true) {
            event.preventDefault();
            }
        };
    </script>
</body>
</html>




<?php
    include 'connect.php';
    define('UPLPATH', 'img/');
    session_start();
?>
<?php

// Provjera da li je korisnik došao s login forme
if (isset($_POST['submit'])) {
    // Provjera da li korisnik postoji u bazi uz zaštitu od SQL injectiona
    $prijavaImeKorisnika = $_POST['username'];
    $prijavaLozinkaKorisnika = $_POST['lozinka'];
    $sql = "SELECT korisnicko_ime, lozinka, razina FROM korisnik
    WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }
    mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, 
    $levelKorisnika);
    mysqli_stmt_fetch($stmt);
    //Provjera lozinke
    if ((password_verify($_POST['lozinka'], $lozinkaKorisnika) && 
    (mysqli_stmt_num_rows($stmt) > 0))) {
        $uspjesnaPrijava = true;
        // Provjera da li je admin
        if($levelKorisnika == 1) {
            $admin = true;
        }
        else {
            $admin = false;
        }
        //postavljanje session varijabli
        $_SESSION['$username'] = $imeKorisnika;
        $_SESSION['$level'] = $levelKorisnika;
    } 
    else {
        $uspjesnaPrijava = false;
    }   
}
// Brisanje i promijena arhiviranosti
?>
<!DOCTYPE html>
<html>
<head>
    <title>El debate</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
<div class="container">
	<div class="row">
		<div class="col-md-12" align="center">
            <a class="navbar-brand" href="index_ed.php"><img src="img/logo.jpg"/></a>
		</div>
    </div>
    <div class="row">
            <div class="col-md-1">
                <a class="nav-link" href="unos.html">Unos</a>
            </div> 
            <div class="col-md-1">
                <a class="nav-link" href="index_ed.php">Home</a>
            </div>
            <div class="col-md-1">
                <a class="nav-link" href="kategorija.php?id=Mundo">Mundo</a>
            </div>
            <div class="col-md-1">
                <a class="nav-link" href="kategorija.php?id=Deportes">Deportes</a>
            </div>
            <div class="col-md-1">
                <a class="nav-link" href="administracija.php">Administracija</a>
            </div>

    </div>
    </header>
    <div class="container-fluid centar">
        <?php
            if(($uspjesnaPrijava==true && $admin==true) || ((isset($_SESSION['$username'])) && (isset($_SESSION['$level'])==1))){
                $query = "SELECT * FROM vijesti";
                $result = mysqli_query($dbc, $query);
                while($row = mysqli_fetch_array($result)) {
                    echo '<form enctype="multipart/form-data" action="" method="POST">
                    <div class="form-item">
                    <label for="title">Naslov vjesti:</label>
                    <div class="form-field">
                    <input type="text" name="title" class="form-field-textual" 
                    value="'.$row['naslov'].'">
                    </div>
                    </div>
                    <div class="form-item">
                    <label for="about">Kratki sadržaj vijesti (do 50 
                    znakova):</label>
                    <div class="form-field">
                    <textarea name="about" id="" cols="30" rows="10" class="formfield-textual">'.$row['sazetak'].'</textarea>
                    </div>
                    </div>
                    <div class="form-item">
                    <label for="content">Sadržaj vijesti:</label>
                    <div class="form-field">
                    <textarea name="content" id="" cols="30" rows="10" class="formfield-textual">'.$row['tekst'].'</textarea>
                    </div>
                    </div>
                    <div class="form-item">
                    <label for="pphoto">Slika:</label>
                    <div class="form-field">
                    <input type="file" class="input-text" id="pphoto" 
                    value="'.$row['slika'].'" name="pphoto"/> <br><img src="' . UPLPATH . $row['slika'] . '" width=100px>
                    </div>
                    </div>
                    <div class="form-item">
                    <label for="category">Kategorija vijesti:</label>
                    <div class="form-field">
                    <select name="category" id="" class="form-field-textual" 
                    value="'.$row['kategorija'].'">
                    <option value="sport">Musica</option>
                    <option value="kultura">Deportes</option>
                    </select>
                    </div>
                    </div>
                    <div class="form-item">
                    <label>Spremiti u arhivu: 
                    <div class="form-field">';
                    if($row['arhiva'] == 0) {
                    echo '<input type="checkbox" name="archive" id="archive"/> 
                    Arhiviraj?';
                    } else {
                    echo '<input type="checkbox" name="archive" id="archive" 
                    checked/> Arhiviraj?';
                    }
                    echo '</div>
                    </label>
                    </div>
                    </div>
                    <div class="form-item">
                    <input type="hidden" name="id" class="form-field-textual" 
                    value="'.$row['id'].'">
                    <button type="reset" value="Poništi">Poništi</button>
                    <button type="submit" name="update" value="Prihvati"> 
                    Izmjeni</button>
                    <button type="submit" name="delete" value="Izbriši"> 
                    Izbriši</button>
                    </div>
                    </form>';
                }
            }
            else if($uspjesnaPrijava==true && $admin==false){
                echo '<p>Bok' . $imeKorisnika . '! Uspješno ste prijavljeni ali niste administrator.</p>';
            }
            else if(isset($_SESSION['$username']) && $_SESSION['$level'] == 0){
                echo '<p>Bok' . $_SESSION['$username'] . '! Uspješno ste prijavljeni ali niste administrator.</p>';
            }
            else if($uspjesnaPrijava==false){
                echo'da';
            }

        ?>
    <footer class="page-footer text-center blue">
        <p>Gabriela Suša, gsusa@tvz.hr, 2022.</p>
    </footer>
</body>
</html>

<?php
    if(isset($_POST['delete'])){
     $id=$_POST['id'];
     $query = "DELETE FROM vijesti WHERE id=$id ";
     $result = mysqli_query($dbc, $query);
     mysqli_close($dbc);
    }

    if(isset($_POST['update'])){
    $picture = $_FILES['pphoto']['name'];
    $title=$_POST['title'];
    $about=$_POST['about'];
    $content=$_POST['content'];
    $category=$_POST['category'];
    if(isset($_POST['archive'])){
        $archive=1;
    }else{
        $archive=0;
    }
    $target_dir = 'img/'.$picture;
    move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);
    $id=$_POST['id'];
    $query = "UPDATE vijesti SET naslov='$title', sazetak='$about', tekst='$content', 
    slika='$picture', kategorija='$category', arhiva='$archive' WHERE id=$id ";
    $result = mysqli_query($dbc, $query);
    mysqli_close($dbc);
    }
    
?>
