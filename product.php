<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="webfontkit/stylesheet.css">
    <title>Product</title>
  </head>
  <body>
    <?php
    require_once('.confiq/confiq.php');
    $session = session_restore_result($connect, $server_url);
    if ($session['auth_key_valid']) {
      header("Location: https://worawanbydiistudent.store/admin.php");
      exit();
    }
    ?>
    <div class="side__menu">
      <a href="index.php" onclick="toggleSideMenu()">home</a>
      <button class="button" name="button" onclick="searchPreparePage();toggleSideMenu();">product</button>
      <?php
      if (!$session['session_valid']) {
        ?>
        <button class="button" name="button" onclick="toggleSideMenu();toggleLoginMenu();">login</button>
        <a href="#" onclick="toggleSideMenu();toggleRegisterMenu();">register</a>
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
      <form class="" action="index.html" method="post">
        <div class="field__center username">
          <div class="input__icon">
            <input type="text" class="input__glow" required name="username" value="" placeholder="Your username">
            <div class="icon__snap__field">
              <div class="icon__snap__field__relative">
                <i class="fas fa-user-shield fa-lg fa-fw input__snap" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="field__center password">
          <div class="input__icon">
            <input type="password" class="input__glow" required name="password" value="" placeholder="*****">
            <div class="icon__snap__field">
              <div class="icon__snap__field__relative">
                <i class="fas fa-key fa-lg fa-fw input__snap" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="field__center login__button__field">
          <button type="button" class="button__icon button__green" name="register" onclick="toggleLoginMenu();toggleRegisterMenu();"><i class="fas fa-file-contract"></i>register</button>
          <button type="submit" class="button__icon button__blue" name="login"><i class="fas fa-sign-in-alt"></i>login</button>
        </div>
      </form>
      <i class="fas fa-times close__icon" onclick="toggleLoginMenu()"></i>
    </div>
    <form action="index.php" class="register__menu" method="post">
      <div class="register__left" style="margin-top: 3em">
        <div class="input__icon">
          <input type="text" class="input__glow" required name="username" placeholder="Your username">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-user-shield fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <input type="password" class="input__glow" required name="password" placeholder="Your password">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-key fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <input type="password" class="input__glow" required name="repassword" placeholder="Confirm your password">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-key fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <input type="text" class="input__glow" required name="name" placeholder="Your full name">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-user-alt fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <input type="text" class="input__glow" required name="lastname" placeholder="Your lastname">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-users fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <input type="email" class="input__glow" required name="email" placeholder="Your email address">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-envelope fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <input type="text" class="input__glow" required name="phonenumber" placeholder="Your phone number">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-phone-alt fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="register__right">
        <div class="input__icon" style="margin-top: 3em">
          <input type="text" class="input__glow" required name="address1" placeholder="Your home address">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-house-user fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <input type="text" class="input__glow" name="address2" placeholder="Optional home address">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-house-user fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <input type="text" class="input__glow" required name="city" placeholder="City you lived in">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-building fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <input type="text" class="input__glow" required name="state" placeholder="State you lived in">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-city fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <input type="text" class="input__glow" required name="province" placeholder="Province you lived in">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-city fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <input type="text" class="input__glow" required name="postcode" placeholder="Your postcode">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-shipping-fast fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
      <i class="fas fa-times close__icon" onclick="toggleRegisterMenu()"></i>
      <button type="submit" name="button" class="button__icon button__green field__center" style="bottom: 20%"><i class="fas fa-file-contract"></i>register</button>
    </form>
    <span class="dark__transparent__background" id="dark1" onclick="toggleSideMenu()"></span>
    <span class="dark__transparent__background" id="dark2" onclick="toggleLoginMenu()"></span>
    <span class="dark__transparent__background" id="dark3" onclick="toggleRegisterMenu()"></span>
    <header>DII Samorasriworawan Shop</header>
    <nav class="floating">
      <button class="menu verticle__center" onclick="toggleSideMenu()">
        <i class="fas fa-bars"></i>
      </button>
      <a class="anchor" href="index.php">home</a>
      <button type="button" class="search" onclick="searchPreparePage()" name="search">product</button>
      <a class="anchor" href="#">about us</a>
      <div class="login verticle__center">
        <div class="search__group">
          <input type="text" class="search__field" name="find" placeholder="Search for product">
          <button type="button" name="search" class="search__button" onclick="">
            <i class="fas fa-search search__icon"></i>
          </button>
        </div>
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
    <section class="product" style="margin-top: 5rem">
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
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="script.js" charset="utf-8"></script>
  <script src="https://kit.fontawesome.com/115266479a.js" crossorigin="anonymous"></script>
</html>
