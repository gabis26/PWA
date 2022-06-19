<?php
    $picture = $_FILES['pphoto']['name'];
    $title=$_POST['title'];
    $about=$_POST['about'];
    $content=$_POST['content'];
    $category=$_POST['category'];
    $date=$_POST['datum'];
    $date=date('d.m.Y.',strtotime($date));
    if(isset($_POST['archive'])){
        $archive=1;
    }else{
        $archive=0;
    }
    $target_dir = 'img/'.$picture;
    move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);

    $dbc = mysqli_connect('localhost', 'root', '', 'El_debate') or 
    die('Error connecting to MySQL server.'. mysqli_connect_error());
    

    $query = "INSERT INTO vijesti (datum, naslov, sazetak, tekst, slika, kategorija, 
    arhiva ) VALUES ('$date', '$title', '$about', '$content', '$picture', 
    '$category', '$archive')";

    $result = mysqli_query($dbc, $query) or die('Error querying databese.'); 
    mysqli_close($dbc);
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>EL debate</title>
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
            <div class="container clanak">
                <?php 
                    echo "<h1>$title</h1>";
                    echo "<h3>$about</h3>";
                    echo "<p>$date</p>";
                    echo "<img src='img/$picture'/>";
                    echo "<p>$content</p>";
                ?>
             </div>
        </section>
    </div>
    <footer class="page-footer text-center blue">
        <p>Gabriela Suša, gsusa@tvz.hr, 2022.</p>
    </footer>
</body>
</html>

