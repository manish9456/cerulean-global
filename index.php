<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport"
    content="width =device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="description" content="CERULEAN GLOBAL">
  <meta name="author" content="CERULEAN GLOBAL">
  <meta name="referrer" content="no-referrer-when-downgrade">
  <link href="/" rel="canonical">
  <base href="/">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/67330da5e1.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link
    href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,600&display=swap"
    rel="stylesheet">
  <!--[if lt IE 9]><script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script><![endif]-->

  <link rel="icon" type="image/png" href="assets/img/favicon.png" />
  <link rel="stylesheet" href="assets/css/base.css">
  <!-- <link rel="manifest" href="manifest.json"> -->
  <title>CERULEAN GLOBAL</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light smallheader">
    <a class="navbar-brand brand-left" href="/"> <img src="/assets/img/logo.png" /> </a>
    <div class="brand-centered">
      <a class="d-flex align-items-center" href="/"> <img src="/assets/img/logo-center.png" /></a>
    </div>
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="icon-bar top-bar"></span>
      <span class="icon-bar middle-bar"></span>
      <span class="icon-bar bottom-bar"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
        <li class="nav-item"><a class="nav-link" href="/work">Our Work</a></li>
        <li class="nav-item"><a class="nav-link" href="/conscious">Conscious</a></li>
        <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
      </ul>
    </div>
  </nav>

  <?php
        $host = '';
        $request = $_SERVER['REQUEST_URI'];
        // echo $request;
        // echo $host.'/';
        switch ($request) {
            case $host.'/':
                include "./views/home.php";
                break;
            case $host.'':
                include "./views/home.php";
                break;
            case $host.'/about':
              include "./views/about.php";
                break;
            case $host.'/work':
              include "./views/work.php";
                break;
            case $host.'/conscious':
              include "./views/conscious.php";
                break;
            case $host.'/contact':
              include "./views/contact.php";
                break;
            case $host.'/privacy':
              include "./views/privacy.php";
                break;
            default:
              // http_response_code(404);
              include "./views/home.php";
              break;
        }
    ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="assets/js/parallax.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
  </script>
  <script>
  $(function() {

    $(document).ready(function() {
      var url = window.location;
      // console.log(url);
      var menuItem = $('.navbar-nav li a').filter(function() {
        return this.pathname && url.pathname && url.pathname.includes(this.pathname);
      })
      menuItem.addClass('active');
    })

    var lastId,
      parallaxNav = $("#parallax-nav"),
      // All list items
      menuItems = parallaxNav.find("a"),
      // Anchors corresponding to menu items
      scrollItems = menuItems.map(function() {
        var item = $(this.hash);
        if (item.length) {
          return item;
        }
      });
    var pagePath = window?.location?.pathname.substring(1);

    /***
     * Bind click handler to menu items. so we can get a fancy scroll animation
     ***/
    menuItems.click(function(e) {
      if (
        location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
        location.hostname == this.hostname
      ) {
        // Figure out element to scroll to
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        // Does a scroll target exist?
        if (target.length) {
          $('html, body').animate({
            scrollTop: target.offset().top - 140
          }, 1000);
          $(this).parent().addClass("active").siblings().removeClass("active");
          // Only prevent default if animation is actually gonna happen

          event.preventDefault();
        }
      }
    });

    function activateOnPageNave() {
      // Get container scroll position
      var fromTop = $(this).scrollTop() + 140 + 1;

      // Get id of current scroll item
      var cur = scrollItems.map(function() {
        if ($(this).offset().top < fromTop)
          return this;
      });
      // Get the id of the current element
      cur = cur[cur.length - 1];
      var id = cur && cur.length ? cur[0].id : "";

      if (lastId !== id) {
        lastId = id;
        // Set/remove active class
        menuItems
          .parent().removeClass("active")
          .end().filter(`[href='${pagePath}#${id}']`).parent().addClass("active");
      }
    }
    activateOnPageNave();
    // Bind to scroll
    $(window).scroll(function() {
      activateOnPageNave();
    });
  });

  $('.carousel-item', '.show-neighbors').each(function() {
    var next = $(this).next();
    if (!next.length) {
      next = $(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));
  }).each(function() {
    var prev = $(this).prev();
    if (!prev.length) {
      prev = $(this).siblings(':last');
    }
    prev.children(':nth-last-child(2)').clone().prependTo($(this));
  });

  // Get the modal
  // var modal = document.getElementById("home-modal");
  // if (modal) {
  //   modal.style.display = "block";

  //   // Get the <span> element that closes the modal
  //   var span = document.getElementsByClassName("home-modal-close")[0];

  //   // When the user clicks on <span> (x), close the modal
  //   span.onclick = function() {
  //     modal.style.display = "none";
  //   }

  //   // When the user clicks anywhere outside of the modal, close it
  //   window.onclick = function(event) {
  //     if (event.target == modal) {
  //       modal.style.display = "none";
  //     }
  //   }
  // }
  </script>
  <script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "Organization",
    "name": "CERULEAN GLOBAL",
    "url": "\/\/cerulean-global.com",
    "contactPoint": [{
      "@type": "ContactPoint",
      "telephone": "+91 124 4669700",
      "contactType": "customer service"
    }]
  }
  </script>
</body>

</html>