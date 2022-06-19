<?php
    include 'connect.php';
    session_start();
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
        <form name="forma" action="registracija.php" method="POST">
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



