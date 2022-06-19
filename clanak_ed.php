<?php
    include 'connect.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>EL Debate</title>
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
        <section class="text-center">
            <div class="container clanak">
                <div class="sl">
                <?php

                    $id=$_GET['id'];
                    $query="SELECT * FROM vijesti WHERE id='$id'";
                    $result=mysqli_query($dbc,$query);
                    while($row=mysqli_fetch_array($result)){
                        echo "<h5>" . $row['kategorija'] . "</h5>";
                        echo "<h1>" . $row['naslov'] . "</h1>";
                        echo "<h3>" . $row['sazetak'] . "</h3>";
                        echo "<p>" . $row['datum'] . "</p>";
                        echo "<img src='img/" . $row['slika'] . "'>";
                        echo "<p>" . $row['tekst'] . "</p>";
                        }
                ?>
                </div>
            </div>
        </section>
    </div>
    <footer class="page-footer text-center blue">
        <p>Gabriela Suša, gsusa@tvz.hr, 2022.</p>
    </footer>
</body>
</html>