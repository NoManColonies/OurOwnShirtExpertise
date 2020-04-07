$(document).ready(function() {
  $(".input__glow")
  .focus(function() {
    $(this).siblings('.icon__snap__field').addClass('focus');
  })
  .focusout(function() {
    $(this).siblings('.icon__snap__field').removeClass('focus');
  });

  $('.button__hover__expand').hover(function() {
    $(this).css({"margin-right": ".7em"});
    $(this).html("<i class=\"fas fa-external-link-alt\" aria-hidden=\"true\"></i>more info");
    $(this).children().css({"margin-right": "1.25em"});
    $(this).siblings().html("<i class=\"fas fa-cart-arrow-down\"></i>");
    $(this).siblings().children().css({"margin-right": "0"});
  }, function() {
    $(this).css({"margin-right": "0"});
    $(this).html("<i class=\"fas fa-external-link-alt\" aria-hidden=\"true\"></i>");
    $(this).children().css({"margin-right": "0"});
    $(this).siblings().html("<i class=\"fas fa-cart-arrow-down\"></i>add to cart");
    $(this).siblings().children().css({"margin-right": "1em"});
  });

  $(".buy__loggedin").click(function() {
    if (window.XMLHttpRequest) {
      xmlhttp = new XMLHttpRequest();
    } else {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var tempEntity = $(this);
    tempEntity.html("<i class=\"fas fa-sync fa-spin\" aria-hidden=\"true\"></i>add to cart");
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "") {
          alert("Failed to add product to your cart.");
        } else {
          tempEntity.html("<i class=\"fas fa-cart-arrow-down\"></i>add to cart");
        }
      }
    };
    xmlhttp.open("GET", "user/add_to_cart.php?q=" + tempEntity.data("valueq"), true);
    xmlhttp.send();
  });

  var scrollTeleport = $('.scroll');
  scrollTeleport.click(function(e) {
    if (document.querySelector('#about') == null || document.querySelector('#home') == null) {
      return;
    }
    e.preventDefault();
    $('body,html').animate({
      scrollTop: $(this.hash).offset().top
    }, 500);
  });

  $(window).scroll(function() {
    var scrollbarLocation = $(this).scrollTop();
    scrollTeleport.each(function() {
      var sectionOffset = $(this.hash).offset().top - 100;
      if (sectionOffset <= scrollbarLocation) {
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
      }
    });
  });

  const trigger = document.querySelector('header');
  const navBar = document.querySelector('nav');
  const menu = document.querySelector('.menu');
  const login = document.querySelector('.login');

  const navBarOptions = {
    rootMargin: "50px 0px 0px 0px"
  };

  const navBarObserver = new IntersectionObserver((entries, navBarObserver) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        navBar.classList.add('floating');
        navBar.classList.remove('fixed');
        trigger.classList.remove('fixed');
      } else {
        navBar.classList.add('fixed');
        navBar.classList.remove('floating');
        trigger.classList.add('fixed');
      }
    });
  }, navBarOptions);

  navBarObserver.observe(trigger);
});

const toggleSideMenu = () => {
  const target = document.querySelector('.side__menu');
  const background = document.querySelector('#dark1');
  target.classList.toggle('activeSideMenu');
  background.classList.toggle('activeDarkenBackground');
};

const toggleLoginMenu = () => {
  const target = document.querySelector('.login__menu');
  const background = document.querySelector('#dark2');
  target.classList.toggle('activeLoginMenu');
  background.classList.toggle('activeDarkenBackground');
};

const productPage = () => {
  window.location = "product.php";
};

const toggleRegisterMenu = () => {
  const target = document.querySelector('.register__menu');
  const background = document.querySelector('#dark3');
  target.classList.toggle('activeRegisterMenu');
  background.classList.toggle('activeDarkenBackground');
};

const toggleCartMenu = () => {
  const target = document.querySelector('.menu__cart');
  const background = document.querySelector('#dark4');
  target.classList.toggle('activeCartMenu');
  background.classList.toggle('activeDarkenBackground');
  if (target.classList.contains('activeCartMenu')) {
    if (window.XMLHttpRequest) {
      xmlhttp = new XMLHttpRequest();
    } else {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var cartRow = document.querySelector('.menu__cart__group');
    cartRow.innerHTML = "<p class=\"cart__no__result\"><i class=\"fas fa-sync fa-lg fa-fw fa-spin\" style=\"margin-right: .5em\" aria-hidden=\"true\"></i>Loading please wait.</p>";
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "") {
          window.location = "index.php";
        } else {
          cartRow.innerHTML = this.responseText;
        }
      }
    };
    xmlhttp.open("GET", ".confiq/cartlist.php", true);
    xmlhttp.send();
    $(".button__cart__remove").click(function() {
      alert("Clicked!");
      if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
      } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      var tempEntity = $(this);
      tempEntity.html("<i class=\"fas fa-sync fa-spin\" aria-hidden=\"true\"></i>remove");
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          if (this.responseText == "") {
            alert("Failed to remove product from your cart.");
          } else {
            if (window.XMLHttpRequest) {
              xmlhttp = new XMLHttpRequest();
            } else {
              xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            var cartRow = document.querySelector('.menu__cart__group');
            cartRow.innerHTML = "<p class=\"cart__no__result\"><i class=\"fas fa-sync fa-lg fa-fw fa-spin\" style=\"margin-right: .5em\" aria-hidden=\"true\"></i>Loading please wait.</p>";
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                if (this.responseText == "") {
                  window.location = "index.php";
                } else {
                  cartRow.innerHTML = this.responseText;
                }
              }
            };
            xmlhttp.open("GET", ".confiq/cartlist.php", true);
            xmlhttp.send();
          }
        }
      };
      xmlhttp.open("GET", "user/remove_from_cart.php?q=" + tempEntity.data("valueq") + "&a=" + tempEntity.data("valuea"), true);
      xmlhttp.send();
    });
  }
};
