$(document).ready(function() {
  refreshModifiable();
  stockTrigger();

  var stockQtyInput = $("[name='productstockqty']");

  stockQtyInput.val("");

  stockQtyInput
  .keyup(function() {
    const label = $(".input__underbar label");
    const input = $(".input__underbar input");
    const button = $("#stock__update");
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
    const button = $("#stock__update");
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
    const button = $("#stock__update");
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

  $("[name='productaddname']").change(function() {
    var fd = new FormData();
    var name = $(this).val();
    fd.append('q', name);
    $.ajax({
        url: 'user/autofill_existing_product.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response) {
            var value = response.split(',');
            $("[name='productaddtitle']").val(value[0]);
            $("[name='productadddescription']").val(value[1]);
            $("[name='productaddgender']").val(value[2]);
            $("[name='productaddimagepath']").val(value[3]);
        },
    });
  });

  $("[name='productaddname']").focusout(function() {
    var fd = new FormData();
    var name = $(this).val();
    fd.append('q', name);
    $.ajax({
        url: 'user/autofill_existing_product.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response) {
            var value = response.split(',');
            $("[name='productaddtitle']").val(value[0]);
            $("[name='productadddescription']").val(value[1]);
            $("[name='productaddgender']").val(value[2]);
            $("[name='productaddimagepath']").val(value[3]);
        },
    });
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
  var fd = new FormData();
  var target = $(".product");
  target.html("<p class=\"cart__no__result\"><i class=\"fas fa-sync fa-lg fa-fw fa-spin\" style=\"margin-right: .5em\" aria-hidden=\"true\"></i>Loading please wait.</p>");
  $.ajax({
      url: 'user/show_modifiable_product.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(response) {
        target.html(response);
        reloadModifiableMenu();
      },
  });
};

const stockTrigger = () => {
  $(".stock__update__trigger").click(function() {
    document.querySelector(".drop__down__stock").classList.toggle("active");
    document.querySelector("#dark3").classList.toggle("activeDarkenBackground");
    refreshStockPage();
  });

  $(document).on('submit', '.group__right__float', function() {
    var fd = new FormData();
    fd.append('a', $("#name").val());
    fd.append('s', $("#size").val());
    fd.append('l', $("#length").val());
    fd.append('q', $("[name='productstockqty']").val());
    var tempEntity = $("#stock__update");
    tempEntity.html("<i class=\"fas fa-sync fa-lg fa-fw fa-spin\"></i>Update stock");
    $.ajax({
        url: 'user/try_stock_update.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response != "") {
                alert(response);
                tempEntity.html("<i class=\"fas fa-database\"></i>Update stock");
                refreshStockPage();
                refreshModifiable();
            } else {
              tempEntity.html("<i class=\"fas fa-database\"></i>Update stock");
              refreshStockPage();
              refreshModifiable();
            }
        },
    });
    return false;
  });
};

const refreshStockPage = () => {
  var fd = new FormData();
  var stockQtyInput = $("[name='productqty']");

  stockQtyInput.val("");

  var target = $(".drop__down__stock .grid__group__left");
  target.css({
    'min-width': '500px',
    'min-height': '430px'
  });

  target.html("<p class=\"cart__no__result\"><i class=\"fas fa-sync fa-lg fa-fw fa-spin\" style=\"margin-right: .5em\" aria-hidden=\"true\"></i>Loading please wait.</p>");

  $.ajax({
      url: 'user/show_stock_updatable_name.php',
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
}

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

    if (searchBox) {
      searchBox.removeEventListener("keyup", stockSearchEvent);
      searchBox.addEventListener("keyup", stockSearchEvent);
    }

    const filterList = (e) => {
      searchTerm = e.target.value.toLowerCase();
      optionsList.forEach(option => {
        let label = option.firstElementChild.nextElementSibling.innerText.toLowerCase();
        if (label.indexOf(searchTerm) != -1) {
          option.style.display = "block";
        } else {
          option.style.display = "none";
        }
      });
    };

    if (searchBox) {
      searchBox.focus();
      searchBox.value = "";
      filterList("");
    }
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
  var fd = new FormData();
  var url = '';
  var selected = e.currentTarget.parentNode.nextElementSibling;
  var optionsContainer = selected.previousElementSibling;
  var option = e.currentTarget;
  selected.childNodes[1].innerHTML = option.querySelector("label").innerHTML;
  optionsContainer.classList.remove("active");
  optionsContainer.parentNode.value = option.querySelector("input").value;
  var target = optionsContainer.parentNode;
  var targetId = target.id;
  switch (targetId) {
    case "name":
      url = 'user/show_stock_updatable_size.php';
      fd.append('q', $("#name").val());
      break;
    case "size":
      url = 'user/show_stock_updatable_length.php';
      fd.append('q', $("#name").val());
      fd.append('s', $("#size").val());
      break;
    default:
      if ($("#name").val() != "" && $("#size").val() != "" && $("#length").val() != "" && !$(".grid__group__right").hasClass("active")) {
        document.querySelector(".grid__group__right").classList.toggle("active");
      } else {
        $("#stock__update").prop('disabled', true);
      }
      return;
  }
  $.ajax({
      url: url,
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(response) {
        switch (targetId) {
          case "name":
            $("#productmodsize").html(response);
            refreshStockOption();
            break;
          case "size":
            $("#productmodlength").html(response);
            refreshStockOption();
            break;
          default:
            alert("No respond target were selected. target : " + targetId + " response : " + response);
        }
      },
  });
}

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
      var container = $('.modify__container');
      if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
      } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      container.css({'min-height': '90%'});
      container.html("<p class=\"cart__no__result\"><i class=\"fas fa-sync fa-lg fa-fw fa-spin\" style=\"margin-right: .5em\" aria-hidden=\"true\"></i>Loading please wait.</p>");
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          container.css({'min-height': '0'});
          container.html(this.responseText);

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
  document.querySelector(".drop__down__stock").classList.toggle("active");
  document.querySelector("#dark3").classList.toggle("activeDarkenBackground");
};

const toggleAlbumMenu = () => {
  var target = document.querySelector(".view__album__popup");
  document.querySelector("#dark4").classList.toggle("activeDarkenBackground");
  target.classList.toggle("active__album__popup");
  if (target.classList.contains("active__album__popup")) {
    var fd = new FormData();
    var target = $(".album__container");
    target.html("<p class=\"cart__no__result\"><i class=\"fas fa-sync fa-lg fa-fw fa-spin\" style=\"margin-right: .5em\" aria-hidden=\"true\"></i>Loading please wait.</p>");
    $.ajax({
      url: 'user/show_album_image.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(response) {
        target.html(response);
      },
    });
  }
};
