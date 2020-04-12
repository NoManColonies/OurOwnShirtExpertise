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
    require_once('.confiq/auth_confiq.php');
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
    } else if (!is_null($_REQUEST['username']) && !is_null($_REQUEST['password'])) {
      $array_of_error_code = register_result($connect, $listmanager, $_REQUEST['username'], $_REQUEST['password'], $_REQUEST['repassword'], $_REQUEST['name'], $_REQUEST['lastname'], $_REQUEST['address1'], $_REQUEST['address2'], $_REQUEST['city'], $_REQUEST['state'], $_REQUEST['province'], $_REQUEST['postcode'], $_REQUEST['phonenumber'], $_REQUEST['email']);
      if (!$array_of_error_code['username_valid']) {
        $listmanager->close();
        log_alert($connect, "Your username was already taken.");
        header("Location: https://worawanbydiistudent.store/login/register.php");
        exit();
      } else if (!$array_of_error_code['password_valid']) {
        log_alert($connect, "Password did not match or was null.");
      } else {
        $listmanager->close();
        $connect->close();
        header("Location: https://worawanbydiistudent.store/index.php");
        exit();
      }
    }
    ?>
    <div class="side__menu">
      <div class="side__menu__group">
        <a href="#home" class="scroll" onclick="toggleSideMenu()">home</a>
        <a href="#product" class="scroll" onclick="toggleSideMenu()">product</a>
        <?php
        if (!$session['session_valid']) {
          ?>
          <button class="button" name="button" onclick="toggleSideMenu();toggleLoginMenu();">login</button>
          <button class="button" name="button" onclick="toggleSideMenu();toggleRegisterMenu();">register</button>
          <?php
        } else {
          ?>
          <button class="button" name="button" onclick="toggleSideMenu();toggleCartMenu();">your cart</button>
          <a href="user/logout.php" onclick="toggleSideMenu()">logout</a>
          <?php
        }
        ?>
        <a href="#about" class="scroll" onclick="toggleSideMenu();">about us</a>
      </div>
    </div>
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
          <p class="menu__cart__product__name">Name</p>
          <p class="menu__cart__product__price">Price</p>
          <p class="menu__cart__product__qty__header">Quantity</p>
          <p class="menu__cart__product__action">Action</p>
        </div>
        <div class="menu__cart__group">
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
          <button disabled type="submit" class="button__slide__appear" id="buy__qty"><i class="fas fa-database"></i>Buy product</button>
        </form>
      </div>
    </div>
    <span class="dark__transparent__background" id="dark1" onclick="toggleSideMenu()"></span>
    <span class="dark__transparent__background" id="dark2" onclick="toggleLoginMenu()"></span>
    <span class="dark__transparent__background" id="dark3" onclick="toggleRegisterMenu()"></span>
    <span class="dark__transparent__background" id="dark4" onclick="toggleCartMenu()"></span>
    <span class="dark__transparent__background" id="dark5" onclick="toggleBuyableMenu()"></span>
    <span id="home"></span>
    <header>DII Samorasriworawan Shop</header>
    <nav class="floating">
      <button type="button" class="menu verticle__center" onclick="toggleSideMenu()">
        <i class="fas fa-bars fa-lg fa-fw menu__icon" aria-hidden="true"></i>
      </button>
      <a class="anchor scroll" href="#home">home</a>
      <a class="anchor scroll" href="#product">product</a>
      <a class="anchor scroll" href="#about">about us</a>
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
    <span id="product"></span>
    <div class="header">
      <p>Our Items</p>
    </div>
    <section class="product">
      <?php
      $retreive_distinct_product_result = $connect->query("select distinct productname from producttable");
      if (!empty($retreive_distinct_product_result->num_rows)) {
        while ($name_row = $retreive_distinct_product_result->fetch_assoc()) {
          $counter = 0;
          $retreive_all_product_result = $connect->query("select * from producttable where productname='".$name_row['productname']."'");
          if (!empty($retreive_all_product_result->num_rows)) {
            $price_array = [];
            $size_array = [];
            $length_array = [];
            $dprice_array = [];
            $code_array = [];
            $product_name = "";
            $product_title = "";
            $product_desc = "";
            $product_gender = "";
            $product_imagepath = "";
            while ($product_row = $retreive_all_product_result->fetch_assoc()) {
              $price_array = array_merge($price_array, array($product_row['productprice']));
              $dprice_array = array_merge($dprice_array, array($product_row['productdprice']));
              $code_array = array_merge($code_array, array($product_row['productcode']));
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
            <div class="product__container">
              <img src="<?php echo "images/".$product_imagepath; ?>" alt="">
              <div class="desc">
                <p class="product__name"><?php echo $product_name; ?></p>
                <p class="product__detail"><?php echo $product_title; ?></p>
                <div class="product__price__group">
                  <p class="product__price__tag">price :</p>
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
                  $check_bit = false;
                  if ($mind > $min) {
                    echo "<p class=\"product__price\">".$min."฿</p>";
                    echo "<p class=\"product__price\">~</p>";
                    $check_bit = true;
                  } else if ($mind != $min && $mind != 0) {
                    echo "<p class=\"product__price\">".$mind."฿</p>";
                    echo "<p class=\"product__price\">~</p>";
                    $check_bit = true;
                  }
                  if ($maxd > $max) {
                    if (!$check_bit) {
                      echo "<p class=\"product__price__specific\">".$maxd."฿</p>";
                    } else {
                      echo "<p class=\"product__price\">".$maxd."฿</p>";
                    }
                  } else if ($maxd != $max) {
                    if (!$check_bit) {
                      echo "<p class=\"product__price__specific\">".$max."฿</p>";
                    } else {
                      echo "<p class=\"product__price\">".$max."฿</p>";
                    }
                  }
                  ?>
                </div>
              </div>
              <div class="spec">
                <?php
                $check_bit = false;
                foreach ($size_array as $value) {
                  if ($value != "u" && $value != "") {
                    if (!$check_bit) {
                      ?>
                      <div class="product__spec">
                        <p class="product__size__tag">size :</p>
                      <?php
                      $check_bit = true;
                    }
                    ?>
                    <p class="product__size"><?php echo $value; ?></option>
                    <?php
                  }
                }
                if ($check_bit) {
                  ?>
                  </div>
                  <?php
                }
                $check_bit = false;
                foreach ($length_array as $value) {
                  if ($value != "" && $value != "u") {
                    if (!$check_bit) {
                      ?>
                      <div class="product__spec">
                      <p class="product__size__tag" style="margin-right: 0">length :</p>
                      <?php
                      $check_bit = true;
                    }
                    ?>
                    <p class="product__size"><?php echo $value; ?>"</option>
                    <?php
                  }
                }
                if ($check_bit) {
                  echo "</div>";
                }
                if (!is_null($product_gender) && $product_gender != "u") {
                  ?>
                  <div class="product__gender__group">
                    <p class="product__gender__tag">gender :</p>
                    <p class="product__gender"><?php echo $product_gender; ?></p>
                  </div>
                  <?php
                }
                if ($session['session_valid']) {
                  ?>
                  <div class="product__button__group">
                    <button type="button" class="inspect__item button__green button__hover__expand__loggedin" value="<?php echo $product_name; ?>" onclick=""><i class="fas fa-external-link-alt" aria-hidden="true"></i></button>
                    <button type="button" class="add__to__cart button__blue buy__loggedin" data-valueq="<?php echo $product_name; ?>" onclick=""><i class="fas fa-cart-arrow-down" aria-hidden="true"></i>add to cart</button>
                  </div>
                  <?php
                } else {
                  ?>
                  <div class="product__button__group">
                    <button type="button" class="inspect__item button__green button__hover__expand__not__loggedin" value="<?php echo $product_name; ?>" onclick=""><i class="fas fa-external-link-alt" aria-hidden="true"></i></button>
                    <button type="button" class="add__to__cart button__blue buy__not__loggedin" value="<?php echo $product_name; ?>" onclick="" name="add"><i class="fas fa-shopping-bag" aria-hidden="true"></i>buy it now</button>
                  </div>
                  <?php
                }
                ?>
              </div>
            </div>
            <?php
            $counter++;
            if ($counter > 5) {
              break;
            }
          }
        }
      }
      ?>
    </section>
    <div class="header header__hide">
      <button type="button" class="button__icon button__blue" onclick="productPage()"><i class="fas fa-eye"></i>show more</button>
    </div>
    <span id="about"></span>
    <div class="header header__top">
      <p>About Us</p>
    </div>
    <section class="page">

    </section>
  </body>
  <script src="https://kit.fontawesome.com/115266479a.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="script.js" charset="utf-8"></script>
</html>
