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
    require_once('.confiq/auth_confiq.php');
    $session = session_auth_check($connect);
    if ($session['auth_key_valid']) {
      $listmanager->close();
      $connect->close();
      header("Location: https://worawanbydiistudent.store/admin.php");
      exit();
    }
    ?>
    <div class="side__menu">
      <div class="side__menu__group">
        <a href="index.php#home" class="scroll" onclick="toggleSideMenu()">home</a>
        <?php
        if (!$session['session_valid']) {
          ?>
          <a href="#product" class="scroll" onclick="toggleSideMenu()">product</a>
          <button class="button" name="button" onclick="toggleSideMenu();toggleLoginMenu();">login</button>
          <button class="button" name="button" onclick="toggleSideMenu();toggleRegisterMenu();">register</button>
          <?php
        } else {
          ?>
          <button class="button" name="button" onclick="toggleSideMenu();toggleCartMenu();">your cart</button>
          <button class="button account__menu__trigger" name="button" onclick="toggleSideMenu()">account</button>
          <a href="user/logout.php" onclick="toggleSideMenu()">logout</a>
          <?php
        }
        ?>
        <a href="index.php#about" class="scroll" onclick="toggleSideMenu();">about us</a>
      </div>
    </div>
    <?php
    if (!$session['session_valid']) {
      ?>
      <div class="login__menu">
        <form class="" action="index.php" method="post">
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
      <?php
    }
    ?>
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
    <?php
    if ($session['session_valid']) {
      ?>
      <div class="menu__cart">
        <div class="menu__cart__header">
          <span class="cart__header">Your cart items</span>
          <p class="menu__cart__product__name">Product spec</p>
          <p class="menu__cart__product__price">Price</p>
          <p class="menu__cart__product__qty__header">Quantity</p>
          <p class="menu__cart__product__action">Action</p>
        </div>
        <div class="menu__cart__group">
        </div>
        <div class="menu__cart__footer">
          <button class="button__icon button__dark" id="purchase" style="margin-right: 1em"><i class="fas fa-money-bill-wave"></i>Purchase</button>
          <div class="menu__cart__total">
          </div>
        </div>
        <i class="fas fa-times close__icon" onclick="toggleCartMenu()"></i>
      </div>
      <?php
    }
    ?>
    <div class="drop__down__buyable">
      <div class="grid__group__left">
      </div>
      <div class="grid__group__right ">
        <form class="group__right__float" action="" method="post">
          <div class="input__underbar">
            <input type="number" name="productbuyqty" value="1" min="1">
            <label for="productbuyqty">Amount</label>
          </div>
          <button disabled type="submit" class="button__slide__appear" id="buy__qty"><i class="fas fa-cart-arrow-down"></i>Buy product</button>
        </form>
      </div>
    </div>
    <?php
    if ($session['session_valid']) {
      ?>
      <div class="account__menu">
        <div class="account__container">
          <h1>Account menu</h1>
          <div class="tab">
            <button class="tablinks" value="credentials" name="credentials" onclick="openTab(event)">User credentials</button>
            <button class="tablinks" value="password" name="password" onclick="openTab(event)">Password management</button>
            <button class="tablinks" value="transaction" name="transaction" onclick="openTab(event)">Transaction history</button>
          </div>
          <div id="credentials" class="tabcontent">
            <div class="tabcontent__group" id="credentials__parent">
            </div>
          </div>
          <div id="password" class="tabcontent">
            <div class="tabcontent__group">
              <div class="tabcontent__field">
                <form action="" method="post" id="password__change" class="group__center">
                  <div class="input__icon">
                    <input type="password" class="input__glow" required name="oldpassword" placeholder="Old password">
                    <div class="icon__snap__field">
                      <div class="icon__snap__field__relative">
                        <i class="fas fa-key fa-lg fa-fw input__snap" aria-hidden="true"></i>
                      </div>
                    </div>
                  </div>
                  <div class="input__icon">
                    <input type="password" class="input__glow" required name="newpassword" placeholder="New password">
                    <div class="icon__snap__field">
                      <div class="icon__snap__field__relative">
                        <i class="fas fa-key fa-lg fa-fw input__snap" aria-hidden="true"></i>
                      </div>
                    </div>
                  </div>
                  <div class="input__icon">
                    <input type="password" class="input__glow" required name="conpassword" placeholder="Confirm new password">
                    <div class="icon__snap__field">
                      <div class="icon__snap__field__relative">
                        <i class="fas fa-key fa-lg fa-fw input__snap" aria-hidden="true"></i>
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="button__icon button__blue" style="margin-top: 1em"><i class="fas fa-lock"></i>Change password</button>
                </form>
              </div>
            </div>
          </div>
          <div id="transaction" class="tabcontent">
            <div class="tabcontent__group" name="transaction__group">
            </div>
          </div>
        </div>
        <i class="fas fa-times close__icon" onclick="toggleAccountMenu()"></i>
      </div>
      <?php
    }
    ?>
    <span class="dark__transparent__background" id="dark1" onclick="toggleSideMenu()"></span>
    <span class="dark__transparent__background" id="dark2" onclick="toggleLoginMenu()"></span>
    <span class="dark__transparent__background" id="dark3" onclick="toggleRegisterMenu()"></span>
    <span class="dark__transparent__background" id="dark4" onclick="toggleCartMenu()"></span>
    <span class="dark__transparent__background" id="dark5" onclick="toggleBuyableMenu()"></span>
    <span class="dark__transparent__background" id="dark6" onclick="toggleAccountMenu()"></span>
    <span id="home"></span>
    <header>DII Samorasriworawan Shop</header>
    <nav class="floating">
      <button type="button" class="menu verticle__center" onclick="toggleSideMenu()">
        <i class="fas fa-bars fa-lg fa-fw menu__icon" aria-hidden="true"></i>
      </button>
      <a class="anchor scroll" href="index.php#home">home</a>
      <a class="anchor scroll" href="#product">product</a>
      <a class="anchor scroll" href="index.php#about">about us</a>
      <div class="login verticle__center">
        <form class="search__group" action="" method="post">
          <input type="text" class="search__field" name="find" placeholder="Search for product">
          <button type="submit" name="search" class="search__button">
            <i class="fas fa-search fa-lg fa-fw search__icon" aria-hidden="true"></i>
          </button>
        </form>
        <?php
        if ($session['session_valid']) {
          ?>
          <button class="login__button" onclick="toggleCartMenu()"><i class="fas fa-shopping-basket"></i>cart</button>
          <?php
        } else {
          ?>
          <button class="login__button" onclick="toggleLoginMenu()">login</button>
          <?php
        }
        ?>
      </div>
    </nav>
    <span id="product"></span>
    <section class="product">

    </section>
  </body>
  <script src="https://kit.fontawesome.com/115266479a.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="script.js" charset="utf-8"></script>
</html>
