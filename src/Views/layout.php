<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?=$this->e($title)?></title>
		<link rel="stylesheet" href="<?= $basePath ?>assets/css/reset.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/fontawesome.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/brands.css">
    <link href="https://fonts.googleapis.com/css?family=Sunflower:300,700" rel="stylesheet">
    <link rel="stylesheet" href="<?= $basePath ?>assets/css/style.css">

	<!-- On transforme la variable PHP en variable JS et on la rend disponible partout -->
	<script>
    const BASE_PATH = "<?= $basePath ?>";
    </script>
    <!-- Inclusion de jQuery -->

	</head>
	<body class="container-fluid">
		  <header>
        <?=$this->insert('partials/nav')?>
        
    </header>
    <main>
    


    	<?=$this->section('content')?>
    </main>











    <footer>
     <p>Copyright &copy; Oclock 2018</p> <a href="http://anthonyperspace.pw/contact" class="badge badge-primary">Contact</a>
    </footer>


    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- Inclusion du fichier app.js -->
    <script src="<?= $basePath ?>/assets/js/app.js"></script>
    <?=$this->section('js')?>
	</body>
</html>
