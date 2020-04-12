<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="webfontkit/stylesheet.css">
    <link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/wtf-forms.css">
    <title>Admin</title>
  </head>
  <body>
    <?php
    require_once('.confiq/confiq.php');
    $session = session_auth_check($connect);
    if (!$session['session_valid'] || !$session['auth_key_valid']) {
      $connect->close();
      header("Location: https://worawanbydiistudent.store/index.php");
      exit();
    }
    ?>
    <div class="side__menu">
      <div class="side__menu__group">
        <a href="#addproduct" class="scroll" onclick="toggleSideMenu()">add product</a>
        <button class="button" name="button" onclick="toggleSideMenu();toggleNotificationMenu();">notification</button>
        <button class="button" name="button" onclick="toggleSideMenu();toggleAlbumMenu();">view images album</button>
        <button class="button stock__update__trigger" name="button" onclick="toggleSideMenu()">update stock</button>
        <a href="user/logout.php" data-a="logout" class="scroll" onclick="toggleSideMenu()">log out</a>
      </div>
    </div>
    <div class="modify__product__menu">
      <form class="modify__container" action="" method="post" enctype="multipart/form-data" id="modify__popup">
      </form>
      <p class="modify__header">Modify item</p>
      <i class="fas fa-times close__icon close__modify__popup" onclick=""></i>
    </div>
    <div class="view__album__popup">
      <p class="album__popup__header">Images album</p>
      <div class="album__container">
      </div>
      <i class="fas fa-times close__icon" onclick="toggleAlbumMenu()"></i>
    </div>
    <div class="drop__down__stock">
      <div class="grid__group__left">
      </div>
      <div class="grid__group__right ">
        <form class="group__right__float" action="" method="post">
          <div class="input__underbar">
            <input type="number" name="productstockqty" value="1" min="1">
            <label for="productstockqty">Stock</label>
          </div>
          <button disabled type="submit" class="button__slide__appear" id="stock__update"><i class="fas fa-database"></i>Update stock</button>
        </form>
      </div>
    </div>
    <div class="notification__menu">
      <div class="notification__container">
        <h1>Notification</h1>
        <div class="tab">
          <button class="tablinks" value="billing" name="billing" onclick="openTab(event)">Billing request</button>
          <button class="tablinks" value="pending" name="pending" onclick="openTab(event)">Pending request</button>
          <button class="tablinks" value="approved" name="approved" onclick="openTab(event)">Approved request</button>
        </div>
        <div id="billing" class="tabcontent">
          <div class="tabcontent__group">

          </div>
        </div>
        <div id="pending" class="tabcontent">
          <div class="tabcontent__group">

          </div>
        </div>
        <div id="approved" class="tabcontent">
          <div class="tabcontent__group">

          </div>
        </div>
      </div>
      <i class="fas fa-times close__icon" onclick="toggleNotificationMenu()"></i>
    </div>
    <span class="dark__transparent__background" id="dark1" onclick="toggleSideMenu()"></span>
    <span class="dark__transparent__background close__modify__popup" id="dark2"></span>
    <span class="dark__transparent__background" id="dark3" onclick="toggleStockUpdateMenu()"></span>
    <span class="dark__transparent__background" id="dark4" onclick="toggleAlbumMenu()"></span>
    <span class="dark__transparent__background" id="dark5" onclick="toggleNotificationMenu()"></span>
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
        <button class="login__button" onclick="toggleNotificationMenu()"><i class="fas fa-bell"></i>notification</button>
      </div>
    </nav>
    <span id="addproduct"></span>
    <p class="add__product__header">Add a new product</p>
    <div class="add__product__container__group">
      <form class="add__product__container" action="" method="post" enctype="multipart/form-data">
        <div class="input__icon">
          <input type="text" required name="productaddname" class="input__glow" value="" placeholder="Item name">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-shopping-bag fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <input type="text" name="productaddtitle" class="input__glow" value="" placeholder="Item display title/search keyword">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fab fa-slack-hash fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <textarea name="productadddescription" rows="4" cols="80" class="input__glow">Some descriptions</textarea><br>
          <div class="icon__snap__field full__size">
            <div class="icon__snap__field__relative">
              <i class="fas fa-book-reader fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <input type="text" required name="productaddprice" class="input__glow" value="" placeholder="Item price">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-tag fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <input type="text" name="productaddsize" value="" class="input__glow" placeholder="Size of the item">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-ruler-combined fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <input type="text" name="productaddgender" value="" class="input__glow" placeholder="Gender this item is for (Optional)">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-venus-double fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <input type="text" name="productaddlength" value="" class="input__glow" placeholder="length of the item (Optional)">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-pencil-ruler fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <input type="text" name="productadddprice" value="" class="input__glow" placeholder="Discounted price (Optional)">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-percentage fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="input__icon">
          <input type="text" name="productaddimagepath" value="" class="input__glow" placeholder="File path (Optional)">
          <div class="icon__snap__field">
            <div class="icon__snap__field__relative">
              <i class="fas fa-file-signature fa-lg fa-fw input__snap" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="add__product__group">
          <label class="file">
            <input type="file" id="fileAdd" aria-label="File browser example">
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
