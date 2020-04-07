$(document).ready(function() {
  $(".input__glow")
  .focus(function() {
    $(this).siblings('.icon__snap__field').addClass('focus');
  })
  .focusout(function() {
    $(this).siblings('.icon__snap__field').removeClass('focus');
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
};
