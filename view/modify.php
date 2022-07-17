<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Update Book</title>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="../styles/loginstyles.css">

</head>

<body>
  <!-- partial:index.partial.html -->
  <div class="form">

    <?php
    $id = $_GET["id"];
    $title = $_GET["title"];
    $author = $_GET["author"];
    $price = $_GET["price"];

    require_once '../controller/book_controller.php';
    $book = new BookController();
    if (isset($_POST["Modify"])) {

      $book->updateBook(array("title", "author", "price"), array($_POST["title"], $_POST["author"], $_POST["price"]), "id=". $id);
    }



    ?>

    <div class="tab-content">
      <div id="signup">

        <form  action="../view/home.php" method="post">

          <div class="field-wrap">

            <input type="text" required autocomplete="off" name="title" value="<?= $title ?>" placeholder="Title*" />
          </div>



          <div class="field-wrap">

            <input type="text" required autocomplete="off" name="author" value="<?= $author ?>" placeholder="Author*" />
          </div>

          <div class="field-wrap">

            <input type="number" required autocomplete="off" name="price" placeholder="Price*" value="<?= $price ?>" />
          </div>

          <button type="submit" name="Modify" class="button button-block">Update</button>

        </form>

      </div>

      <div id="login">
        <h1>Welcome Back!</h1>

        <form action="/" method="post">

          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email" required autocomplete="off" />
          </div>

          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" required autocomplete="off" />
          </div>


          <button class="button button-block">Log In</button>

        </form>

      </div>

    </div><!-- tab-content -->

  </div> <!-- /form -->
  <!-- partial -->
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="../js/login.js"></script>

</body>

</html>