<?php
    include 'connect.php';
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
        <section>
            <div class="container mundo">
                <div class="row">
                   
                    <?php
                        $kategorija=$_GET['id'];
                        $query= "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='$kategorija'";
                        $result=mysqli_query($dbc,$query);
                        while($row=mysqli_fetch_array($result)){
                            echo "<div class='col'>";
                            echo "<a href='clanak_ed.php?id=" . $row['id'] . "'>";
                            echo "<h2>" . $row['naslov'] . "</h2>";
                            echo "<img src='img/" . $row['slika'] . "'>";
                            echo "<p>" . $row['sazetak'] . "<p>";
                            echo $row['datum'];
                            echo "</a>";
                            echo "</div>";
                            }
                        mysqli_close($dbc);
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