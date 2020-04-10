$(document).ready(function() {
  refreshModifiable();

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

      $(".stock_update_trigger").click(function() {
        var target = document.querySelector(".stock_update_container");
        if (window.XMLHttpRequest) {
          xmlhttp = new XMLHttpRequest();
        } else {
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        target.innerHTML = "<p class=\"cart__no__result\"><i class=\"fas fa-sync fa-lg fa-fw fa-spin\" style=\"margin-right: .5em\" aria-hidden=\"true\"></i>Loading please wait.</p>";
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            target.innerHTML = this.responseText;
            refreshStockOption();
          }
        };
        xmlhttp.open("GET", "user/show_stock_updatable_name.php?q=", true);
        xmlhttp.send();
      });
    }
  };
  xmlhttp.open("GET", "user/show_modifiable_product.php", true);
  xmlhttp.send();
};

const refreshStockOption = () => {
  $(".stock_label").each(function() {
    $(this).change(function() {
      if ($(this).val() != "" && $("[name='productqty']").val() >= $("[name='productqty']").attr("min")) {
        $(".stock_update_button").prop("disabled", false);
      } else {
        $(".stock_update_button").prop("disabled", true);
      }
    });
  });

  $("[name='productqty']").keyup(function() {
    if ($(this).val() >= $(this).attr("min")) {
      $(".stock_update_button").prop("disabled", false);
    } else {
      $(".stock_update_button").prop("disabled", true);
    }
  });

  $("#stock_label_name").change(function() {
    if (window.XMLHttpRequest) {
      xmlhttp = new XMLHttpRequest();
    } else {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var tempEntity = $("#stock_label_size");
    tempEntity.html("");
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "") {
          alert("An error ocurred when try to retreive product size.");
        } else {
          tempEntity.html(this.responseText);
          refreshStockOption();
        }
      }
    };
    xmlhttp.open("GET", "user/show_stock_updatable_size.php?q=" + $(this).val(), true);
    xmlhttp.send();
  });

  $("#stock_label_size").change(function() {
    if (window.XMLHttpRequest) {
      xmlhttp = new XMLHttpRequest();
    } else {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var tempEntity = $("#stock_label_length");
    tempEntity.html("");
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "") {
          alert("An error ocurred when try to retreive product length.");
        } else {
          tempEntity.html(this.responseText);
          refreshStockOption();
        }
      }
    };
    xmlhttp.open("GET", "user/show_stock_updatable_length.php?q=" + $("#stock_label_name").val() + "&s=" + $(this).val(), true);
    xmlhttp.send();
  });

  $(".stock_update_button").click(function() {
    if (window.XMLHttpRequest) {
      xmlhttp = new XMLHttpRequest();
    } else {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var tempEntity = $(this);
    tempEntity.html("<i class=\"fas fa-sync fa-spin\" aria-hidden=\"true\"></i>Update stock");
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "") {
          var target = document.querySelector(".stock_update_container");
          if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
          } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          target.innerHTML = "<p class=\"cart__no__result\"><i class=\"fas fa-sync fa-lg fa-fw fa-spin\" style=\"margin-right: .5em\" aria-hidden=\"true\"></i>Loading please wait.</p>";
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              target.innerHTML = this.responseText;
              refreshStockOption();
              refreshModifiable();
            }
          };
          xmlhttp.open("GET", "user/show_stock_updatable_name.php?q=", true);
          xmlhttp.send();
        } else {
          alert(this.responseText);
          tempEntity.html("<i class=\"fas fa-cubes\"></i>Update stock");
          refreshStockOption();
        }
      }
    };
    xmlhttp.open("GET", "user/try_stock_update.php?q=" + $("[name='productqty']").val() + "&a=" + $("#stock_label_name").val() + "&s=" + $("#stock_label_size").val() + "&l=" + $("#stock_label_length").val(), true);
    xmlhttp.send();
  });
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

          $("[name='productsize']").change(function() {
            var lengthEntity = $("[name='productlength']");
            var sizeEntity = $(this);
            if (window.XMLHttpRequest) {
              xmlhttp = new XMLHttpRequest();
            } else {
              xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            lengthEntity.html("<option selected>Please select the length</option>");
            $("[name='productsizeedit']").val((sizeEntity.val() == "u")? "Default" : sizeEntity.val());
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                lengthEntity.html(this.responseText);

                $("[name='product']").each(function() {
                  if ($(this).data("size") == sizeEntity.val() && $(this).data("length") == lengthEntity.val()) {
                    $("[name='productprice']").val($(this).data("price"));
                    $("[name='productdprice']").val($(this).data("dprice"));
                    $("[name='selected']").val($(this).data("code"));
                    $(".button__modify__menu").prop("disabled", false);
                    return false;
                  } else {
                    $("[name='selected']").val("");
                    $(".button__modify__menu").prop("disabled", true);
                  }
                });

                $("[name='productlength']").change(function() {
                  var sizeEntity = $("[name='productsize']");
                  var lengthEntity = $(this);
                  $("[name='productlengthedit']").val((lengthEntity.val() == "u")? "Default" : lengthEntity.val());
                  $("[name='product']").each(function() {
                    if ($(this).data("size") == sizeEntity.val() && $(this).data("length") == lengthEntity.val()) {
                      $("[name='productprice']").val($(this).data("price"));
                      $("[name='productdprice']").val($(this).data("dprice"));
                      $("[name='selected']").val($(this).data("code"));
                      $(".button__modify__menu").prop("disabled", false);
                      return false;
                    } else {
                      $("[name='selected']").val("");
                      $(".button__modify__menu").prop("disabled", true);
                    }
                  });
                });
              }
            };
            xmlhttp.open("GET", "user/get_product_length.php?q=" + $("[name='code']").val() + "&s=" + sizeEntity.val(), true);
            xmlhttp.send();
          });

          $(document).on('submit', '#modify__popup', function() {
            var fd = new FormData();
            var files = $('#file')[0].files[0];
            var name = $("[name='productname']").val();
            var title = $("[name='producttitle']").val();
            var description = $("[name='productdescription']").val();
            var price = $("[name='productprice']").val();
            var dprice = $("[name='productdprice']").val();
            var size = $("[name='productsizeedit']").val();
            var gender = $("[name='productgender']").val();
            var length = $("[name='productlengthedit']").val();
            var imagepath = $("[name='productimagepath']").val();
            var code = $("[name='selected']").val();
            fd.append('file', files);
            fd.append('productname', name);
            fd.append('producttitle', title);
            fd.append('productdescription', description);
            fd.append('productprice', price);
            fd.append('productdprice', dprice);
            fd.append('productsize', (size == "Default")? "" : size);
            fd.append('productgender', gender);
            fd.append('productlength', (length == "Default")? "" : length);
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
      xmlhttp.open("GET", "user/show_modify_menu.php?q=" + $(this).data("name"), true);
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
  if (target.classList.contains("active__album__popup")) {
    var target = document.querySelector(".album__container");
    if (window.XMLHttpRequest) {
      xmlhttp = new XMLHttpRequest();
    } else {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    target.innerHTML = "<p class=\"cart__no__result\"><i class=\"fas fa-sync fa-lg fa-fw fa-spin\" style=\"margin-right: .5em\" aria-hidden=\"true\"></i>Loading please wait.</p>";
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        target.innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "user/show_album_image.php", true);
    xmlhttp.send();
  }
};
