<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="webfontkit/stylesheet.css">
    <link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/wtf-forms.css">
    <title>Admin</title>
  </head>
  <body>
    <?php
    require_once('.confiq/confiq.php');
    $session = session_auth_check($connect);
    if (!$session['session_valid'] || !$session['auth_key_valid']) {
      alert_message("Invalid authentication key.");
      exit();
    }
    ?>
    <div class="side__menu">
      <div class="side__menu__group">
        <a href="#addproduct" class="scroll" onclick="toggleSideMenu()">add product</a>
        <button class="button" name="button" onclick="toggleSideMenu()">notification</button>
        <button class="button" name="button" onclick="toggleSideMenu()">view images album</button>
        <button class="button" name="button" onclick="toggleSideMenu()">update stock</button>
        <a href="user/logout.php" class="scroll" onclick="toggleSideMenu()">log out</a>
      </div>
    </div>
    <div class="modify__product__menu">
      <form class="modify__container" action="" method="post" enctype="multipart/form-data" id="modify__popup">
      </form>
      <p class="modify__header">Modify item</p>
      <i class="fas fa-times close__icon modify__popup" onclick=""></i>
    </div>
    <span class="dark__transparent__background" id="dark1" onclick="toggleSideMenu()"></span>
    <span class="dark__transparent__background modify__popup" id="dark2" onclick=""></span>
    <span id="home"></span>
    <header>DII Samorasriworawan Shop</header>
    <nav class="floating">
      <button type="button" class="menu verticle__center" onclick="toggleSideMenu()">
        <i class="fas fa-bars fa-lg fa-fw menu__icon" aria-hidden="true"></i>
      </button>
      <a class="anchor scroll" href="#home">home</a>
      <a class="anchor scroll" href="#addproduct">add product</a>
      <a class="anchor scroll" href="#modifyproduct">modify product</a>
      <div class="login verticle__center">
        <form class="search__group" action="admin.php" method="post">
          <input type="text" class="search__field" name="find" placeholder="Search for product">
          <button type="submit" name="search" class="search__button">
            <i class="fas fa-search fa-lg fa-fw search__icon" aria-hidden="true"></i>
          </button>
        </form>
        <button class="login__button" onclick=""><i class="fas fa-bell"></i>notification</button>
      </div>
    </nav>
    <span id="addproduct"></span>
    <p class="add__product__header">Add a new product</p>
    <div class="add__product__container__group">
      <form class="add__product__container" action="" method="post" enctype="multipart/form-data">
        <div class="input__icon">
          <input type="text" required name="productname" class="input__glow" value="" placeholder="Item name">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-shopping-bag fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <input type="text" required name="producttitle" class="input__glow" value="" placeholder="Item display title/search keyword">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fab fa-slack-hash fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <textarea name="productdescription" rows="4" cols="80" class="input__glow">Some descriptions</textarea><br>
          <div class="icon__snap__field full__size">
            <div class="icon__snap__field__relative">
              <i class="fas fa-book-reader fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <input type="text" required name="productprice" class="input__glow" value="" placeholder="Item price">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-tag fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <input type="text" name="productsize" value="" class="input__glow" placeholder="Size of the item (Optional)">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-ruler-combined fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <input type="text" name="productgender" value="" class="input__glow" placeholder="Gender this item is for (Optional)">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-venus-double fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <input type="text" name="productlength" value="" class="input__glow" placeholder="length of the item (Optional)">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-pencil-ruler fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <input type="text" name="productdprice" value="" class="input__glow" placeholder="Discounted price (Optional)">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-percentage fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <input type="text" name="productimagepath" value="" class="input__glow" placeholder="File path in case of image was already uploaded (Optional)">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-file-signature fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="add__product__group">
          <label class="file">
            <input type="file" id="file" aria-label="File browser example">
            <span class="file-custom"></span>
          </label>
          <button type="submit" name="submit" class="button__icon button__blue button__add__product" style="margin-left: 1em"><i class="fas fa-cloud-upload-alt"></i>add product</button>
        </div>
      </form>
    </div>
    <span id="modifyproduct"></span>
    <div class="header">
      <p>Modify product</p>
    </div>
    <section class="product">

    </section>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="script_admin.js" charset="utf-8"></script>
  <script src="https://kit.fontawesome.com/115266479a.js" crossorigin="anonymous"></script>
</html>
