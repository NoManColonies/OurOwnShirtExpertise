$(document).ready(function() {
  refreshModifiable();

  $("#stock_label").change(function() {
    if ($(this).val() != "" && $("[name='productqty']").val() >= $("[name='productqty']").attr("min")) {
      $(".stock_update_button").prop("disabled", false);
    } else {
      $(".stock_update_button").prop("disabled", true);
    }
  });

  $("[name='productqty']").keyup(function() {
    if ($(this).val() >= $(this).attr("min")) {
      $(".stock_update_button").prop("disabled", false);
    } else {
      $(".stock_update_button").prop("disabled", true);
    }
  });

  $(".close__modify__popup").click(function() {
    var tempEntity = document.querySelector('.modify__product__menu');
    var background = document.querySelector('#dark2');
    tempEntity.classList.toggle('active__modify__menu');
    background.classList.toggle('activeDarkenBackground');
  });

  $(".input__glow")
  .focus(function() {
    $(this).siblings('.icon__snap__field').addClass('focus');
  })
  .focusout(function() {
    $(this).siblings('.icon__snap__field').removeClass('focus');
  });

  $(document).on('submit', '.add__product__container', function() {
    var fd = new FormData();
    var files = $('#fileAdd')[0].files[0];
    var name = $("[name='productaddname']").val();
    var title = $("[name='productaddtitle']").val();
    var description = $("[name='productadddescription']").val();
    var price = $("[name='productaddprice']").val();
    var size = $("[name='productaddsize']").val();
    var gender = $("[name='productaddgender']").val();
    var length = $("[name='productaddlength']").val();
    var dprice = $("[name='productadddprice']").val();
    var imagepath = $("[name='productaddimagepath']").val();
    fd.append('file', files);
    fd.append('productname', name);
    fd.append('producttitle', title);
    fd.append('productdescription', description);
    fd.append('productprice', price);
    fd.append('productsize', size);
    fd.append('productgender', gender);
    fd.append('productlength', length);
    fd.append('productdprice', dprice);
    fd.append('productimagepath', imagepath);
    var tempEntity = $(".button__add__product");
    tempEntity.html("<i class=\"fas fa-sync fa-lg fa-fw fa-spin\"></i>add product");
    $.ajax({
        url: 'user/add_new_product.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response != "") {
                alert(response);
                tempEntity.html("<i class=\"fas fa-cloud-upload-alt\"></i>add product");
                refreshModifiable();
            } else {
              tempEntity.html("<i class=\"fas fa-cloud-upload-alt\"></i>add product");
              refreshModifiable();
            }
        },
    });
    return false;
  });

  var scrollTeleport = $('.scroll');
  scrollTeleport.click(function(e) {
    if ($(this).data("a") == "logout") {
      return;
    }
    e.preventDefault();
    $('body,html').animate({
      scrollTop: $(this.hash).offset().top
    }, 500);
  });

  var scrollTeleport = $('.anchor');
  $(window).scroll(function() {
    var scrollbarLocation = $(this).scrollTop();
    scrollTeleport.each(function() {
      var sectionOffset = $(this.hash).offset().top - 200;
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

const refreshModifiable = () => {
  var target = document.querySelector(".product");
  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  target.innerHTML = "<p class=\"cart__no__result\"><i class=\"fas fa-sync fa-lg fa-fw fa-spin\" style=\"margin-right: .5em\" aria-hidden=\"true\"></i>Loading please wait.</p>";
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      target.innerHTML = this.responseText;
      reloadModifiableMenu();
    }
  };
  xmlhttp.open("GET", "user/show_modifiable_product.php", true);
  xmlhttp.send();
};

const reloadModifiableMenu = () => {
  $('.button__hover__expand__admin').hover(function() {
    $(this).css({"margin-right": ".7em"});
    $(this).html("<i class=\"fas fa-server\" aria-hidden=\"true\"></i>update stock");
    $(this).children().css({"margin-right": "1.25em"});
    $(this).siblings().html("<i class=\"fas fa-edit\"></i>");
    $(this).siblings().children().css({"margin-right": "0"});
  }, function() {
    $(this).css({"margin-right": "0"});
    $(this).html("<i class=\"fas fa-server\" aria-hidden=\"true\"></i>");
    $(this).children().css({"margin-right": "0"});
    $(this).siblings().html("<i class=\"fas fa-edit\"></i>modify product");
    $(this).siblings().children().css({"margin-right": "1em"});
  });

  $(".modify__popup").click(function() {
    var tempEntity = document.querySelector('.modify__product__menu');
    var background = document.querySelector('#dark2');
    tempEntity.classList.toggle('active__modify__menu');
    background.classList.toggle('activeDarkenBackground');
    if (tempEntity.classList.contains('active__modify__menu')) {
      var container = document.querySelector('.modify__container');
      if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
      } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      container.innerHTML = "<p class=\"cart__no__result\"><i class=\"fas fa-sync fa-lg fa-fw fa-spin\" style=\"margin-right: .5em\" aria-hidden=\"true\"></i>Loading please wait.</p>";
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          container.innerHTML = this.responseText;

          $(".input__glow")
          .focus(function() {
            $(this).siblings('.icon__snap__field').addClass('focus');
          })
          .focusout(function() {
            $(this).siblings('.icon__snap__field').removeClass('focus');
          });

          $(document).on('submit', '#modify__popup', function() {
            var fd = new FormData();
            var files = $('#file')[0].files[0];
            var name = $("[name='productname']").val();
            var title = $("[name='producttitle']").val();
            var description = $("[name='productdescription']").val();
            var price = $("[name='productprice']").val();
            var size = $("[name='productsize']").val();
            var gender = $("[name='productgender']").val();
            var length = $("[name='productlength']").val();
            var dprice = $("[name='productdprice']").val();
            var imagepath = $("[name='productimagepath']").val();
            var code = $("[name='code']").val();
            fd.append('file', files);
            fd.append('productname', name);
            fd.append('producttitle', title);
            fd.append('productdescription', description);
            fd.append('productprice', price);
            fd.append('productsize', size);
            fd.append('productgender', gender);
            fd.append('productlength', length);
            fd.append('productdprice', dprice);
            fd.append('productimagepath', imagepath);
            fd.append('productcode', code);
            $(this).html("<p class=\"cart__no__result\"><i class=\"fas fa-sync fa-lg fa-fw fa-spin\"></i>Submitting request...</p>");
            $.ajax({
                url: 'user/update_existing_product.php',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response != "") {
                        alert(response);
                        if (tempEntity.classList.contains('active__modify__menu')) {
                          tempEntity.classList.remove('active__modify__menu');
                          background.classList.remove('activeDarkenBackground');
                        }
                        refreshModifiable();
                    } else {
                      if (tempEntity.classList.contains('active__modify__menu')) {
                        tempEntity.classList.remove('active__modify__menu');
                        background.classList.remove('activeDarkenBackground');
                      }
                      refreshModifiable();
                    }
                },
            });
            return false;
          });
        }
      };
      xmlhttp.open("GET", "user/show_modify_menu.php?q=" + $(this).data("code"), true);
      xmlhttp.send();
    }
  });
};

const toggleStockUpdateMenu = () => {
  var target = document.querySelector(".stock_update_menu");
  var background = document.querySelector("#dark3");
  target.classList.toggle("active_stock_menu");
  background.classList.toggle("activeDarkenBackground");
};

const toggleAlbumMenu = () => {
  var target = document.querySelector(".view__album__popup");
  var background = document.querySelector("#dark4");
  target.classList.toggle("active__album__popup");
  background.classList.toggle("activeDarkenBackground");
};
