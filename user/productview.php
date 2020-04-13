<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../webfontkit/stylesheet.css">
    <title><?php echo $_REQUEST['q']; ?></title>
  </head>
  <body>
    <?php
    require_once('../.confiq/auth_confiq.php');
    $session = session_auth_check($connect);
    if ($session['auth_key_valid']) {
      $connect->close();
      $listmanager->close();
      header("Location: http://worawanbydiistudent.store/admin.php");
      exit();
    } else if (isset($_REQUEST['login'])) {
      if ((!is_null($_REQUEST['username']) || !is_null($_REQUEST['password'])) && !isset($_SESSION['current_userid']) && !isset($_SESSION['encrypted_hash_key'])) {
        if (!login_result($connect, $_REQUEST['username'], $_REQUEST['password'])) {
          alert_message("Incorret username or password.");
        } else {
          $connect->close();
          $listmanager->close();
          header("Location: https://worawanbydiistudent.store/index.php");
          exit();
        }
      }
    }
    ?>
    <div class="side__menu">
      <div class="side__menu__group">
        <a href="../index.php#home" class="scroll" onclick="toggleSideMenu()">home</a>
        <?php
        if (!$session['session_valid']) {
          ?>
          <a href="../product.php#product" class="scroll" onclick="toggleSideMenu()">product</a>
          <button class="button" name="button" onclick="toggleSideMenu();toggleLoginMenu();">login</button>
          <?php
        } else {
          ?>
          <button class="button" name="button" onclick="toggleSideMenu();toggleCartMenu();">your cart</button>
          <button class="button account__menu__trigger" name="button" onclick="toggleSideMenu()">account</button>
          <a href="user/logout.php" onclick="toggleSideMenu()">logout</a>
          <?php
        }
        ?>
        <a href="../index.php#about" class="scroll" onclick="toggleSideMenu();">about us</a>
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
                  <button type="submit" class="button__icon button__blue" id="password__change__button" style="margin-top: 1em"><i class="fas fa-lock"></i>Change password</button>
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
    <span class="dark__transparent__background" id="dark4" onclick="toggleCartMenu()"></span>
    <span class="dark__transparent__background" id="dark5" onclick="toggleBuyableMenu()"></span>
    <span class="dark__transparent__background" id="dark6" onclick="toggleAccountMenu()"></span>
    <span id="home"></span>
    <header>DII Samorasriworawan Shop</header>
    <nav class="floating">
      <button type="button" class="menu verticle__center" onclick="toggleSideMenu()">
        <i class="fas fa-bars fa-lg fa-fw menu__icon" aria-hidden="true"></i>
      </button>
      <a class="anchor scroll" href="../index.php#home">home</a>
      <a class="anchor scroll" href="../product.php#product">product</a>
      <a class="anchor scroll" href="../index.php#about">about us</a>
      <div class="login verticle__center">
        <form class="search__group" action="product.php" method="post">
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
    <section class="single__product__page">
      <div class="single__product__container">
      <?php
      $retreive_all_product_result = $connect->query("select * from producttable where productname='".$_REQUEST['q']."'");
      if (!empty($retreive_all_product_result->num_rows)) {
        $price_array = [];
        $size_array = [];
        $length_array = [];
        $dprice_array = [];
        $product_name = "";
        $product_title = "";
        $product_desc = "";
        $product_gender = "";
        $product_imagepath = "";
        while ($product_row = $retreive_all_product_result->fetch_assoc()) {
          $price_array = array_merge($price_array, array($product_row['productprice']));
          $dprice_array = array_merge($dprice_array, array($product_row['productdprice']));
          if (empty($product_name)) {
            $product_name = $product_row['productname'];
          }
          if (empty($product_title) && isset($product_row['producttitle'])) {
            $product_title = $product_row['producttitle'];
          }
          if (empty($product_desc) && isset($product_row['productdescription'])) {
            $product_desc = $product_row['productdescription'];
          }
          if (empty($product_gender) && isset($product_row['productgender']) && !empty($product_row['productgender'])) {
            $product_gender = $product_row['productgender'];
          }
          if (empty($product_imagepath)) {
            $product_imagepath = $product_row['productimagepath'];
          }
        }
        $retreive_product_result = $connect->query("select distinct productsize from producttable where productname='".$product_name."'");
        if (!empty($retreive_product_result->num_rows)) {
          while ($row = $retreive_product_result->fetch_assoc()) {
            $size_array = array_merge($size_array, array($row['productsize']));
          }
        } else {
          $size_array = array("u");
        }
        $retreive_product_result = $connect->query("select distinct productlength from producttable where productname='".$product_name."'");
        if (!empty($retreive_product_result->num_rows)) {
          while ($row = $retreive_product_result->fetch_assoc()) {
            $length_array = array_merge($length_array, array($row['productlength']));
          }
        } else {
          $length_array = array("u");
        }
        ?>
        <div class="img__box">
          <img src="../images/<?php echo $product_imagepath; ?>" class="img__content">
        </div>
        <div class="desc__box">
          <p class="product__name__heading"><?php echo $product_name; ?></p>
          <p class="product__title__heading"><?php echo $product_title; ?></p>
          <p class="product__desc__content"><?php echo $product_desc; ?></p>
        </div>
        <?php
        sort($price_array);
        sort($dprice_array);
        if (!is_null($price_array[0])) {
          $max = $price_array[0];
          $min = $price_array[0];
        } else {
          $max = 0;
          $min = 0;
        }
        if (!is_null($dprice_array[0])) {
          $maxd = $dprice_array[0];
          $mind = $dprice_array[0];
        } else {
          $maxd = 0;
          $mind = 0;
        }
        foreach (array_keys($price_array) as $key) {
          $maxd = ($dprice_array[$key] > $maxd)? $dprice_array[$key] : $maxd;
          $max = ($price_array[$key] > $max)? $price_array[$key] : $max;
          $mind = ($dprice_array[$key] < $mind)? $dprice_array[$key] : $mind;
          $min = ($price_array[$key] < $min)? $price_array[$key] : $min;
        }
        ?>
        <div class="spec__box">
          <div class="spec__size">
            <p class="size__tag">size :</p>
            <?php
            foreach ($size_array as $value) {
            if ($value != "u") {
              echo "<p>".$value."</p>";
              }
            }
            ?>
          </div>
          <?php
          $check_bit = false;
          foreach ($length_array as $value) {
            if ($value != "" && $value != "u") {
              if (!$check_bit) {
                ?>
                <div class="spec__length">
                  <p class="length__tag" style="margin-right: 0">length :</p>
                <?php
                $check_bit = true;
              }
              ?>
              <p><?php echo $value; ?>"</p>
              <?php
            }
          }
          if ($check_bit) {
            ?>
            </div>
            <?php
          }
          if ($product_gender != "u" && $product_gender != "") {
            ?>
            <div class="spec__gender">
              <p class="gender__tag">gender :</p>
              <p><?php echo $product_gender; ?></p>
            </div>
            <?php
          }
          ?>
          <div class="spec__price">
            <p class="price__tag">Price: </p>
          <?php
          $check_bit = false;
          if ($mind > $min) {
            echo "<p>".$min."฿</p>";
            echo "<p>~</p>";
            $check_bit = true;
          } else if ($mind != $min && $mind != 0) {
            echo "<p>".$mind."฿</p>";
            echo "<p>~</p>";
            $check_bit = true;
          }
          if ($maxd > $max) {
            if (!$check_bit) {
              echo "<p>".$maxd."฿</p>";
            } else {
              echo "<p>".$maxd."฿</p>";
            }
          } else if ($maxd != $max) {
            if (!$check_bit) {
              echo "<p>".$max."฿</p>";
            } else {
              echo "<p>".$max."฿</p>";
            }
          }
          ?>
          </div>
          <?php
          if ($session['session_valid']) {
            ?>
            <div class="action__box">
              <button type="button" class="add__to__cart button__blue buy__loggedin" data-valueq="<?php echo $product_name; ?>" onclick=""><i class="fas fa-cart-arrow-down" aria-hidden="true"></i>add to cart</button>
            </div>
            <?php
          } else {
            ?>
            <div class="action__box">
              <button type="button" class="add__to__cart button__blue buy__not__loggedin" value="<?php echo $product_name; ?>" onclick="" name="add"><i class="fas fa-shopping-bag" aria-hidden="true"></i>buy it now</button>
            </div>
            <?php
          }
          ?>
          </div>
        </div>
      </section>
      <?php
    }
    ?>
  </body>
  <script src="https://kit.fontawesome.com/115266479a.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="../script.js" charset="utf-8"></script>
</html>
