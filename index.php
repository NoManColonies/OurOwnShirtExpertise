<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="webfontkit/stylesheet.css">
    <title>Home</title>
  </head>
  <body>
    <?php
    require_once('.confiq/confiq.php');
    $session = session_restore_result($connect, $server_url);
    if ($session['auth_key_valid']) {
      $connect->close();
      header("Location: http://worawanbydiistudent.store/admin.php");
      exit();
    } else if (isset($_REQUEST['login'])) {
      if ((!is_null($_REQUEST['username']) || !is_null($_REQUEST['password'])) && !isset($_SESSION['current_userid']) && !isset($_SESSION['encrypted_hash_key1'])) {
        if (!login_result($connect, $server_url, $_REQUEST['username'], $_REQUEST['password'])) {
          login_retry_redirect($connect, "Incorrect username or password.");
        } else {
          $connect->close();
          header("Location: https://worawanbydiistudent.store/index.php");
          exit();
        }
      }
    }
    ?>
    <div class="side__menu">
      <a href="#" onclick="toggleSideMenu()">home</a>
      <button class="button" name="button" onclick="searchPreparePage();toggleSideMenu();">product</button>
      <?php
      if (!$session['session_valid']) {
        ?>
        <button class="button" name="button" onclick="toggleSideMenu();toggleLoginMenu();">login</button>
        <a href="#" onclick="toggleSideMenu()">register</a>
        <?php
      } else {
        ?>
        <button class="button" name="button" onclick="toggleSideMenu()">your cart</button>
        <a href="user/logout.php" onclick="toggleSideMenu()">logout</a>
        <?php
      }
      ?>
      <a href="#" onclick="toggleSideMenu()">about us</a>
    </div>
    <div class="login__menu">
      <i class="fas fa-times" onclick="toggleLoginMenu()"></i>
      <form class="" action="index.php" method="post">
        <div class="field__center username">
          <div class="input__icon">
            <input type="text" class="input__glow" name="username" value="" placeholder="Your username">
            <i class="fa fa-user fa-lg fa-fw input__snap" aria-hidden="true"></i>
          </div>
        </div>
        <div class="field__center password">
          <div class="input__icon">
            <input type="password" class="input__glow" name="password" value="" placeholder="*****">
            <i class="fas fa-key fa-lg fa-fw input__snap" aria-hidden="true"></i>
          </div>
        </div>
        <div class="field__center login__button__field">
          <button type="button" class="button__icon button__green" name="register"><i class="fas fa-file-contract"></i>register</button>
          <button type="submit" class="button__icon button__blue" name="login"><i class="fas fa-sign-in-alt"></i>login</button>
        </div>
      </form>
    </div>
    <span class="dark__transparent__background" id="dark1" onclick="toggleSideMenu()"></span>
    <span class="dark__transparent__background" id="dark2" onclick="toggleLoginMenu()"></span>
    <span class="dark__transparent__background" id="dark3" onclick=""></span>
    <header>DII Samorasriworawan Shop</header>
    <nav class="floating">
      <button class="menu verticle__center" onclick="toggleSideMenu()">
        <i class="fas fa-bars"></i>
      </button>
      <a class="anchor" href="#">home</a>
      <button type="button" class="search" onclick="searchPreparePage()" name="search">product</button>
      <a class="anchor" href="#">about us</a>
      <div class="login verticle__center">
        <form class="search__group" action="product.php" method="post">
          <input type="text" class="search__field" name="find" placeholder="Search for product">
          <button type="submit" name="search" class="search__button">
            <i class="fas fa-search search__icon"></i>
          </button>
        </form>
        <?php
        if ($session['session_valid']) {
          ?>
          <button class="login__button" onclick="">cart</button>
          <?php
        } else {
          ?>
          <button class="login__button" onclick="toggleLoginMenu()">login</button>
          <?php
        }
        ?>
      </div>
    </nav>
    <div class="slider__container">
      <slider>
        <slide>
        </slide>
        <slide>
        </slide>
        <slide>
        </slide>
        <slide>
        </slide>
      </slider>
    </div>
    <div class="header">
      <p>Our Items</p>
    </div>
    <section class="product">
      <div class="product__container">
        <img src="pic/fem1.jpg" alt="">
        <div class="desc">
          <p class="product__name">Fem1</p>
          <p class="product__detail">an ordinary female t-shirt.</p>
        </div>
        <div class="spec">
          <div class="product__spec">
            <p class="product__size__tag">size :</p>
            <p class="product__size">s</p>
            <p class="product__size">m</p>
            <p class="product__size">l</p>
          </div>
          <div class="product__price__group">
            <p class="product__price__tag">price :</p>
            <p class="product__price">300฿</p>
          </div>
          <button type="button" class="add__to__cart" name="add"><i class="fas fa-cart-arrow-down"></i>add to cart</button>
        </div>
      </div>
      <div class="product__container">
        <img src="pic/fem2.jpg" alt="">
        <div class="desc">
          <p class="product__name">Fem2</p>
          <p class="product__detail">an ordinary female skirt.</p>
        </div>
        <div class="spec">
          <div class="product__spec">
            <p class="product__size__tag">size :</p>
            <p class="product__size">s</p>
            <p class="product__size">m</p>
            <p class="product__size">l</p>
          </div>
          <div class="product__price__group">
            <p class="product__price__tag">price :</p>
            <p class="product__price">300฿</p>
          </div>
          <button type="button" class="add__to__cart" name="add"><i class="fas fa-cart-arrow-down"></i>add to cart</button>
        </div>
      </div>
      <div class="product__container">
        <img src="pic/fem3.jpg" alt="">
        <div class="desc">
          <p class="product__name">Fem3</p>
          <p class="product__detail">an ordinary female skirt.</p>
        </div>
        <div class="spec">
          <div class="product__spec">
            <p class="product__size__tag">size :</p>
            <p class="product__size">s</p>
            <p class="product__size">m</p>
            <p class="product__size">l</p>
          </div>
          <div class="product__price__group">
            <p class="product__price__tag">price :</p>
            <p class="product__price">300฿</p>
          </div>
          <button type="button" class="add__to__cart" name="add"><i class="fas fa-cart-arrow-down"></i>add to cart</button>
        </div>
      </div>
      <div class="product__container">
        <img src="pic/fem4.jpg" alt="">
        <div class="desc">
          <p class="product__name">Fem4</p>
          <p class="product__detail">an ordinary female skirt.</p>
        </div>
        <div class="spec">
          <div class="product__spec">
            <p class="product__size__tag">size :</p>
            <p class="product__size">s</p>
            <p class="product__size">m</p>
            <p class="product__size">l</p>
          </div>
          <div class="product__price__group">
            <p class="product__price__tag">price :</p>
            <p class="product__price">300฿</p>
          </div>
          <button type="button" class="add__to__cart" name="add"><i class="fas fa-cart-arrow-down"></i>add to cart</button>
        </div>
      </div>
    </section>
    <div class="header header__hide">
      <button type="button" class="button__icon button__blue" onclick="productPage()"><i class="fas fa-eye"></i>show more</button>
    </div>
    <div class="header header__top">
      <p>About Us</p>
    </div>
    <section class="page">

    </section>
  </body>
  <script src="script.js" charset="utf-8"></script>
  <script src="https://kit.fontawesome.com/115266479a.js" crossorigin="anonymous"></script>
</html>
