
<?php
// session_start();
// if(empty ($_SESSION["login"])){
//         header("location:login.php");
//         exit();
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../styles/homestyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <style>
        .meta{
            display: flex;
            width: 100%;
            flex-direction: row;
            justify-content: space-between;
        }
        .book-title{
            width: 100;
            text-align: center;
            padding-bottom: 5%;
        }
    </style>
    <title>Home</title>

</head>

<body>
    <!-- NavBar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark p-md-3 backed-color">
        <div class="container">
            <a href="#" class="navbar-brand">
                <img src="../assets/logo.png" alt="" width="56" height="56">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="mx-auto"></div>
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a href="#books" class="nav-link text-white">Our books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white">[User name]</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-white">Logout</a>
                    </li>

                </ul>
            </div>
        </div>



    </nav>
    <div class="banner-image w-100 vh-100 d-flex justify-content-center align-items-center">
        <div class="content text-center">
            <h1 class="text-white banner-title">Welcome to</h1>
            <h2 class="text-white banner-title">E-book Vendors</h2>
        </div>
    </div>


    <?php
    require_once '../controller/book_controller.php';
    require_once '../model/book.php';
    $bookCrl = new BookController();
    if (isset($_POST["addBook"])) {
        $post = (object)$_POST;
        $title = $post->title;
        $author = $post->author;
        $price = $post->price;
        //echo $nom. " ".$date;
        $bookCrl->createBook($title, $author, $price);

        // echo "<script>document.location.href='index.php';</script>";
    }

    ?>
    <!-- PARTIE  ADMIN -->
    <form class="card m-5 p-2" method="post">
        <h2 class="pb-2"><strong>Add a book :</strong></h2>
        <div class="row">
            <div class="col-12 col-md-3">
                <input type="text" name="title" class="form-control dark" id="title" placeholder="Book title">
            </div>
            <div class="col-12 col-md-3">
                <input type="text" name="author" class="form-control" id="title" placeholder="Author">
            </div>
            <div class="col-12 col-md-3">
                <input type="number" name="price" min="0" max="999" maxlength="3" class="form-control" id="title" placeholder="Price">
            </div>
            <div class="col-12 col-md-3">
                <button type="submit" name="addBook" class="btn btn-dark" style="width: 100%;">Add</button>
            </div>
        </div>
    </form>
    <div class="card m-5 p-2">
        <h2 class="pb-2"><strong>All books :</strong></h2>

        <!-- read books admin  -->

        <?php
        require_once '../controller/book_controller.php';
        $gu = new BookController();

        $res = $gu->readBook("");
        //var_dump ($res);
        ?>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Price</th>
                    <th scope="col">Motify</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $taille = sizeof($res);
                for ($i = 0; $i < $taille; $i++) {
                    $book = $res[$i];
                ?>
                    <tr>
                        <td><?= $book->getId() ?></td>
                        <td><?= $book->getTitle() ?></td>
                        <td><?= $book->getAuthor() ?></td>
                        <td><?= $book->getPrice() ?> $</td>
                        <td>
                            <a href="../view/modify.php?id=<?= $book->getId() ?>&title=<?= $book->getTitle() ?>&author=<?= $book->getAuthor() ?>&price=<?= $book->getPrice() ?>"  name="modif" class="btn btn-warning" style="width: 100%;">Modify</a>
                        </td>
                        <td>
                            <a href="../controller/delete_book.php?id=<?=$book->getId()?>" name="del" class="btn btn-danger" style="width: 100%;">Delete</a>
                        </td>
                    </tr>

                <?php }  ?>

            </tbody>
        </table>

        <!-- read books admin  -->

    </div>
    <!-- END PARTIE ADMIN -->

    <!-- PARTIE USER -->
        <h2 class="pl-5 pb-2" id="books"><strong>Our books :</strong></h2>
        <div class="container pb-4">
            <div class="row">
            <?php
                $taille = sizeof($res);
                for ($i = 0; $i < $taille; $i++) {
                    $book = $res[$i];
                ?>
            <div class=" card p-2 col-12 col-md-4 m-1">
                <div class="book-title"><h5><strong><?= $book->getTitle()?></strong></h5></div>
                <div class="meta">
                    <div class="author"><strong>Author:</strong> <?= $book->getAuthor()?></div>
                    <div class="price"><strong>Price:</strong> <?= $book->getPrice()?>$</div>
                </div>
            </div>
            <?php }  ?>
            </div>
        
        </div>
    <!-- PARTIE USER -->


    <footer class="footer-bottom-area text-center bg-dark pt-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright text-white">
                        <p>Copyright <strong>M&M LTD</strong></a> © 2022 </p>
                    </div><!-- Copyright Text -->
                </div>
            </div>
        </div>
    </footer>
    <script>
        var nav = document.querySelector('nav');
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 150) {
                nav.classList.add('bg-dark', 'shadow');
            } else {
                nav.classList.remove('bg-dark', 'shadow');
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>