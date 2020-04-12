$(document).ready(function() {
  $(".input__glow")
  .focus(function() {
    $(this).siblings('.icon__snap__field').addClass('focus');
  })
  .focusout(function() {
    $(this).siblings('.icon__snap__field').removeClass('focus');
  });

  var buyQtyInput = $("[name='productbuyqty']");

  buyQtyInput.val("");

  buyQtyInput
  .keyup(function() {
    const label = $(".input__underbar label");
    const input = $(".input__underbar input");
    const button = $("#buy__qty");
    if (input.val() != "" && !input.hasClass("active")) {
      $(this).addClass("active");
      label.addClass("active");
      if (input.val() >= input.attr("min")) {
        button.prop('disabled', false);
      }
    } else if (input.val() < input.attr("min") && input.hasClass("active")) {
      input.removeClass("active");
      label.removeClass("active");
      button.prop('disabled', true);
    } else if (input.val() < input.attr("min")) {
      button.prop('disabled', true);
    }
  })
  .change(function() {
    const label = $(".input__underbar label");
    const input = $(".input__underbar input");
    const button = $("#buy__qty");
    if (input.val() != "" && !input.hasClass("active")) {
      $(this).addClass("active");
      label.addClass("active");
      if (input.val() >= input.attr("min")) {
        button.prop('disabled', false);
      }
    } else if (input.val() < input.attr("min") && input.hasClass("active")) {
      input.removeClass("active");
      label.removeClass("active");
      button.prop('disabled', true);
    } else if (input.val() < input.attr("min")) {
      button.prop('disabled', true);
    }
  })
  .focusout(function() {
    const label = $(".input__underbar label");
    const input = $(".input__underbar input");
    const button = $("#buy__qty");
    if (input.val() != "" && !input.hasClass("active")) {
      $(this).addClass("active");
      label.addClass("active");
      if (input.val() >= input.attr("min")) {
        button.prop('disabled', false);
      }
    } else if (input.val() < input.attr("min") && input.hasClass("active")) {
      input.removeClass("active");
      label.removeClass("active");
      button.prop('disabled', true);
    } else if (input.val() < input.attr("min")) {
      button.prop('disabled', true);
    }
  });

  $(document).on('submit', '.group__right__float', function() {
    var fd = new FormData();
    fd.append('a', $("#size").data("name"));
    fd.append('s', $("#size").val());
    fd.append('l', $("#length").val());
    fd.append('q', $("[name='productbuyqty']").val());
    var tempEntity = $("#buy__qty");
    tempEntity.html("<i class=\"fas fa-sync fa-lg fa-fw fa-spin\"></i>Buy product");
    $.ajax({
        url: 'user/add_to_cart.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response != "") {
                alert(response);
                tempEntity.html("<i class=\"fas fa-cart-arrow-down\"></i>Buy product");
                toggleBuyableMenu();
            } else {
              tempEntity.html("<i class=\"fas fa-cart-arrow-down\"></i>Buy product");
              toggleBuyableMenu();
            }
        },
    });
    return false;
  });

  const hrefTerm = "https://worawanbydiistudent.store/product.php";

  if (window.location.href.indexOf(hrefTerm) != -1) {
    refreshBuyableProduct();
  } else {
    reloadBuyableOption();
    reloadBuyableOptionHoverEffect();
  }

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

const refreshBuyableProduct = () => {
  var fd = new FormData();
  var target = $("section.product");
  target.html("<p class=\"cart__no__result\"><i class=\"fas fa-sync fa-lg fa-fw fa-spin\" style=\"margin-right: .5em\" aria-hidden=\"true\"></i>Loading please wait.</p>");
  $.ajax({
      url: 'user/show_buyable_search_result.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(response) {
        target.html(response);
        reloadBuyableOption();
        reloadBuyableOptionHoverEffect();
      },
  });
};

const reloadBuyableOptionHoverEffect = () => {
  $('.button__hover__expand__loggedin').hover(function() {
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

  $('.button__hover__expand__not__loggedin').hover(function() {
    $(this).css({"margin-right": ".7em"});
    $(this).html("<i class=\"fas fa-external-link-alt\" aria-hidden=\"true\"></i>more info");
    $(this).children().css({"margin-right": "1.25em"});
    $(this).siblings().html("<i class=\"fas fa-shopping-bag\"></i>");
    $(this).siblings().children().css({"margin-right": "0"});
  }, function() {
    $(this).css({"margin-right": "0"});
    $(this).html("<i class=\"fas fa-external-link-alt\" aria-hidden=\"true\"></i>");
    $(this).children().css({"margin-right": "0"});
    $(this).siblings().html("<i class=\"fas fa-edit\"></i>buy it now");
    $(this).siblings().children().css({"margin-right": "1em"});
  });
};

const refreshBuyablePage = (e) => {
  var fd = new FormData();
  fd.append('q', e);
  var buyQtyInput = $("[name='productbuyqty']");

  buyQtyInput.val("");

  var target = $(".drop__down__buyable .grid__group__left");
  target.css({
    'min-width': '400px',
    'min-height': '400px'
  });

  target.html("<p class=\"cart__no__result\"><i class=\"fas fa-sync fa-lg fa-fw fa-spin\" style=\"margin-right: .5em\" aria-hidden=\"true\"></i>Loading please wait.</p>");

  $.ajax({
    url: 'user/show_stock_buyable_size.php',
    type: 'post',
    data: fd,
    contentType: false,
    processData: false,
    success: function(response) {
      target.css({
        'min-width': 'unset',
        'min-height': 'unset'
      });
      target.html(response);
      refreshStockOption();
    },
  });
};

const reloadBuyableOption = () => {
  $(".buy__loggedin").click(function() {
    toggleBuyableMenu();
    refreshBuyablePage($(this).data("valueq"));
    $("[name='productbuyqty']").val("");
  });
};

const refreshStockOption = () => {
  const selectedAll = document.querySelectorAll(".selected");

  selectedAll.forEach(selected => {
    const optionsContainer = selected.previousElementSibling;
    const optionsList = optionsContainer.querySelectorAll(".option");
    const searchBox = selected.nextElementSibling;

    selected.removeEventListener("click", updateOpenTrigger);
    selected.addEventListener("click", updateOpenTrigger);

    optionsList.forEach(option => {
      option.removeEventListener("click", updateOptionList);
      option.addEventListener("click", updateOptionList);
    });
  });
};

const updateOpenTrigger = (e) => {
  var optionsContainer = e.currentTarget.previousElementSibling;
  if (optionsContainer.classList.contains("active")) {
    optionsContainer.classList.remove("active");
  } else {
    let currentActive = document.querySelector(".options__container.active");
    if (currentActive) {
      currentActive.classList.remove("active");
    }
    optionsContainer.classList.add("active");
  }
};

const updateOptionList = (e) => {
  var selected = e.currentTarget.parentNode.nextElementSibling;
  var optionsContainer = selected.previousElementSibling;
  var option = e.currentTarget;
  selected.childNodes[1].innerHTML = option.querySelector("label").innerHTML;
  optionsContainer.classList.remove("active");
  optionsContainer.parentNode.value = option.querySelector("input").value;
  var target = optionsContainer.parentNode;
  var targetId = target.id;
  if (targetId == "size") {
    var fd = new FormData();
    fd.append('q', $("#size").data("name"));
    fd.append('s', $("#size").val());
    $.ajax({
        url: 'user/show_stock_buyable_length.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response) {
          if (targetId == "size") {
            $("#productbuylength").html(response);
            refreshStockOption();
          } else {
            alert("No respond target were selected. target : " + targetId + " response : " + response);
          }
        },
    });
  } else if ($("#size").val() != "" && $("#length").val() != "" && !$(".grid__group__right").hasClass("active")) {
    document.querySelector(".grid__group__right").classList.toggle("active");
  } else {
    $("#buy__qty").prop('disabled', true);
  }
}

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
          selfReplicatingRemoveCart();
        }
      }
    };
    xmlhttp.open("GET", ".confiq/cartlist.php", true);
    xmlhttp.send();
  }
};

const selfReplicatingRemoveCart = () => {
  $(".menu__cart__product__qty__field").change(function() {
    if ($(this).val() != $(this).data("ovalue")) {
      if (parseInt($(this).attr('max')) >= parseInt($(this).val())) {
        $("[data-nameq=" + $(this).attr("name") + "]").prop('disabled', false);
      } else {
        $("[data-nameq=" + $(this).attr("name") + "]").prop('disabled', true);
      }
    } else {
      $("[data-nameq=" + $(this).attr("name") + "]").prop('disabled', true);
    }
  });

  $(".button__cart__remove").click(function() {
    if (!confirm("Remove this item?")) {
      return;
    }
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
                selfReplicatingRemoveCart();
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

  $(".button__cart__upload").click(function() {
    if (!confirm("Confirm change?")) {
      return;
    }
    if (window.XMLHttpRequest) {
      xmlhttp = new XMLHttpRequest();
    } else {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var tempEntity = $(this);
    tempEntity.html("<i class=\"fas fa-sync fa-spin\" aria-hidden=\"true\"></i>upload");
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "") {
          alert("Failed to update item in your cart.");
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
                selfReplicatingRemoveCart();
              }
            }
          };
          xmlhttp.open("GET", ".confiq/cartlist.php", true);
          xmlhttp.send();
        }
      }
    };
    xmlhttp.open("GET", "user/update_into_cart.php?q=" + tempEntity.data("nameq") + "&a=" + $("[name=" + tempEntity.data("nameq") + "]").val(), true);
    xmlhttp.send();
  });
};

const toggleBuyableMenu = () => {
  document.querySelector(".drop__down__buyable").classList.toggle("active");
  document.querySelector("#dark5").classList.toggle("activeDarkenBackground");
};
