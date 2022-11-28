<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Trombinoscope</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container justify-content">
                <a class="navbar-brand text-white text-uppercase mx-0" href="home.php">Trombinoscope</a>
                    <a form class="form-inline">
                    <form action="searchdb.php" method="post">
		                <input class="form-control mr-sm-2" type="text" placeholder="Search" name="search" required>
		                <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button></a>
	                </form>
                <a href="logout.php">
                    <i class="fa fa-user-times text-white"></i>                   
                </a>
            </div>
            </div>
        </nav>
    </header>