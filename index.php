<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.pkgd.min.js"></script>

  <link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="styles/fontawesome.min.css" rel="stylesheet" type="text/css" />
  <link href="styles/owl.carousel.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="./styles/styles.css" />
  <title>Accueil</title>
</head>

<body>
  <nav class="top-nav">
    <button class="hamburger" aria-label="Menu">
      <svg class="hb" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10" stroke="#eee" stroke-width=".6"
        fill="rgba(0,0,0,0)" stroke-linecap="round" style="cursor: pointer">
        <path d="M2,3L5,3L8,3M2,5L8,5M2,7L5,7L8,7">
          <animate dur="0.2s" attributeName="d"
            values="M2,3L5,3L8,3M2,5L8,5M2,7L5,7L8,7;M3,3L5,5L7,3M5,5L5,5M3,7L5,5L7,7" fill="freeze"
            begin="start.begin" />
          <animate dur="0.2s" attributeName="d"
            values="M3,3L5,5L7,3M5,5L5,5M3,7L5,5L7,7;M2,3L5,3L8,3M2,5L8,5M2,7L5,7L8,7" fill="freeze"
            begin="reverse.begin" />
        </path>
        <rect width="10" height="10" stroke="none">
          <animate dur="2s" id="reverse" attributeName="width" begin="click" />
        </rect>
        <rect width="10" height="10" stroke="none">
          <animate dur="0.001s" id="start" attributeName="width" values="10;0" fill="freeze" begin="click" />
          <animate dur="0.001s" attributeName="width" values="0;10" fill="freeze" begin="reverse.begin" />
        </rect>
      </svg>
    </button>
    <div class="menu">
      <div class="left">
        <a id="logo" href="#">Arteco</a>
        <a href="#">Pompe à chaleur</a>
        <a href="#">Ventilation</a>
        <a href="#">Façade</a>
        <a href="#">Isolation</a>
        <a href="#">Réalisations</a>
        <a href="#">Nos partenaires</a>
      </div>
      <div class="right">
        <a target="_blank" href="https://www.facebook.com/profile.php?id=61553917978826"><img
            src="./assets/logo facebook.png" alt="" /></a>
        <a id="CTA" href="#">Devis gratuit</a>
      </div>
    </div>
  </nav>

  <header>
    <div class="background">
      <div class="black-layer"></div>
      <h1 class="title animate__animated animate__fadeInLeft">
        Économisez plus, isolez mieux.
      </h1>
      <h2 class="subTitle animate__animated animate__fadeInLeft animate__delay-1s">
        L'isolation par excellence.
      </h2>
    </div>
  </header>

  <section class="first">
    <h3 id="first">Construisons ensemble !</h3>
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque
      quibusdam ex error labore repellat voluptatum praesentium nostrum
      ratione, molestias esse voluptatibus animi a laboriosam, quisquam
      perspiciatis enim eaque beatae in? Blanditiis dignissimos at maiores
      cum! Odit natus consequuntur veritatis voluptatem, assumenda placeat
      quae amet ab veniam porro rerum vel dolor quia unde fugit nesciunt nisi
      quos omnis itaque explicabo? Laudantium. Atque, saepe! Officiis
      doloremque quae omnis.
    </p>
    <svg xmlns="http://www.w3.org/2000/svg" width="53" height="53" viewBox="0 0 53 53" fill="none">
      <path
        d="M51.5 26.5C51.5 40.3071 40.3071 51.5 26.5 51.5C12.6929 51.5 1.5 40.3071 1.5 26.5C1.5 12.6929 12.6929 1.5 26.5 1.5C40.3071 1.5 51.5 12.6929 51.5 26.5Z"
        stroke="#13A106" stroke-width="3" />
      <path
        d="M25.2929 40.7071C25.6834 41.0976 26.3166 41.0976 26.7071 40.7071L33.0711 34.3431C33.4616 33.9526 33.4616 33.3195 33.0711 32.9289C32.6805 32.5384 32.0474 32.5384 31.6569 32.9289L26 38.5858L20.3431 32.9289C19.9526 32.5384 19.3195 32.5384 18.9289 32.9289C18.5384 33.3195 18.5384 33.9526 18.9289 34.3431L25.2929 40.7071ZM25 13L25 40L27 40L27 13L25 13Z"
        fill="black" />
    </svg>
  </section>

  <section class="second">
    <h3 id="title">Nos préstations</h3>
    <div class="hero-slider" data-carousel>
      <div class="carousel-cell" style="background-image: url(./assets/pompeChaleur.jpeg)">
        <div class="overlay"></div>
        <div class="inner">
          <h2 class="title">Pompe à chaleur</h2>
          <p class="subtitle">
            Redonnez une seconde jeunesse à vos tuiles et ardoises grâce aux
            produits exclusifs de Technitoit, le spécialiste de la toiture en
            France.
          </p>
          <a href="https://flickity.metafizzy.co/" target="_blank" class="btn">Estimer</a>
        </div>
      </div>
      <div class="carousel-cell" style="background-image: url(./assets/toiture.png)">
        <div class="overlay"></div>
        <div class="inner">
          <h2 class="title">Toiture</h2>
          <p class="subtitle">
            Redonnez une seconde jeunesse à vos tuiles et ardoises grâce aux
            produits exclusifs de Technitoit, le spécialiste de la toiture en
            France.
          </p>
          <a href="https://flickity.metafizzy.co/" target="_blank" class="btn">Estimer</a>
        </div>
      </div>
      <div class="carousel-cell" style="background-image: url(./assets/facade.jpeg)">
        <div class="overlay"></div>
        <div class="inner">
          <h2 class="title">Façade</h2>
          <p class="subtitle">
            Éliminez les mousses, lichens, champignons, fissures, lézardes et
            traces rouges de votre façade grâce à la rénovation de façade
            Technitoit.
          </p>
          <a href="https://flickity.metafizzy.co/" target="_blank" class="btn">Estimer</a>
        </div>
      </div>
    </div>
  </section>

  <section class="third">
    <h3 id="title">Découvrir nos réalisations</h3>

    <div class="blog-slider">
      <div class="blog-slider__wrp swiper-wrapper">
        <div class="blog-slider__item swiper-slide">
          <div class="blog-slider__img">
            <img
              src="https://res.cloudinary.com/muhammederdem/image/upload/q_60/v1535759872/kuldar-kalvik-799168-unsplash.webp"
              alt="" />
          </div>
          <div class="blog-slider__content">
            <span class="blog-slider__code">26 December 2019</span>
            <div class="blog-slider__title">
              L'hydrofuge coloré sur tuiles.
            </div>
            <div class="blog-slider__text">
              Nouveaux propriétaires d’une belle maison en Haute-Garonne près
              de Toulouse, nos clients avaient entrepris de réaliser des
              travaux de rénovation de leur toiture avant même d’effectuer
              leur achat.
            </div>
            <a href="#" class="blog-slider__button">Consulter</a>
          </div>
        </div>
        <div class="blog-slider__item swiper-slide">
          <div class="blog-slider__img">
            <img
              src="https://res.cloudinary.com/muhammederdem/image/upload/q_60/v1535759871/jason-leung-798979-unsplash.webp"
              alt="" />
          </div>
          <div class="blog-slider__content">
            <span class="blog-slider__code">26 December 2019</span>
            <div class="blog-slider__title">
              Rénovation ardoises naturelle.
            </div>
            <div class="blog-slider__text">
              Dans le Finistère (29), Technitoit avait été sollicité pour
              réaliser une rénovation de toiture d’envergure. L’immense
              bâtisse, construite au cœur d’un paysage boisé, n’avait pas
              bénéficié d’un entretien régulier.
            </div>
            <a href="#" class="blog-slider__button">Consulter</a>
          </div>
        </div>

        <div class="blog-slider__item swiper-slide">
          <div class="blog-slider__img">
            <img
              src="https://res.cloudinary.com/muhammederdem/image/upload/q_60/v1535759871/alessandro-capuzzi-799180-unsplash.webp"
              alt="" />
          </div>
          <div class="blog-slider__content">
            <span class="blog-slider__code">26 December 2019</span>
            <div class="blog-slider__title">Panneaux solaires.</div>
            <div class="blog-slider__text">
              Propriétaires d’une belle maison en Gironde (33), nos clients
              avaient fait appel à Technitoit une première fois pour la
              rénovation de leur toiture.
            </div>
            <a href="#" class="blog-slider__button">Consulter</a>
          </div>
        </div>
      </div>
      <div class="blog-slider__pagination"></div>
    </div>
  </section>

  <section class="fourth">
    <h3 id="title">Notre équipe</h3>
    <?php
    // Requête pour récupérer tous les membres du personnel
    $sql = "SELECT * FROM Personnel ORDER BY idPersonel DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $personnels = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="contTeam">
      <?php foreach ($personnels as $personnel): ?>
        <div class="card">
          <img src="<?= htmlspecialchars($personnel['photo']) ?>"
            alt="Photo de <?= htmlspecialchars($personnel['nomComplet']) ?>"
            style="width: 100%; height: auto; border-radius: 50%;">
          <p id="name">
            <?= htmlspecialchars($personnel['nomComplet']) ?>
          </p>
          <p id="desc">
            <?= nl2br(htmlspecialchars($personnel['description'])) ?>
          </p>
          <div class="overlayCard">
          </div>
        </div>
      <?php endforeach; ?>
    </div>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque
        quibusdam ex error labore repellat voluptatum praesentium nostrum
        ratione, molestias esse voluptatibus animi a laboriosam, quisquam
        perspiciatis enim eaque beatae in? Blanditiis dignissimos at maiores
        cum! Odit natus consequuntur veritatis voluptatem, assumenda placeat
        quae amet ab veniam porro rerum vel dolor quia unde fugit nesciunt
        nisi quos omnis itaque explicabo?
      </p>
    </div>
  </section>

  <section class="fifth">
    <h3 id="title">Le blog d’Arteco</h3>
    <div class="card_wrapper">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="owl-carousel card_carousel">
              <!-- Article Preview 4 -->
              <div class="card_box">
                <div class="img_box" style="background-image: url(assets/facade.jpeg)">
                  <!-- Background image for article on exterior painting -->
                </div>
                <div class="text_box">
                  <h4>Peinture extérieure: Choix et application</h4>
                  <p>
                    Conseils pour choisir la peinture extérieure idéale et
                    techniques pour une application durable et esthétique.
                  </p>
                  <a href="#" class="blog-slider__button">READ MORE</a>
                </div>
              </div>

              <!-- Article Preview 5 -->
              <div class="card_box">
                <div class="img_box" style="background-image: url(assets/facade.jpeg)">
                  <!-- Background image for article on outdoor landscaping -->
                </div>
                <div class="text_box">
                  <h4>Aménagement paysager: Créer un espace de rêve</h4>
                  <p>
                    Idées et astuces pour transformer votre jardin en un
                    magnifique espace de détente et de loisirs.
                  </p>
                  <a href="#" class="blog-slider__button">READ MORE</a>
                </div>
              </div>

              <!-- Article Preview 6 -->
              <div class="card_box">
                <div class="img_box" style="background-image: url(assets/facade.jpeg)">
                  <!-- Background image for article on eco-friendly heating -->
                </div>
                <div class="text_box">
                  <h4>Systèmes de chauffage écologiques</h4>
                  <p>
                    Explorez les options de chauffage durable pour réduire
                    votre empreinte carbone tout en gardant votre maison au
                    chaud.
                  </p>
                  <a href="#" class="blog-slider__button">READ MORE</a>
                </div>
              </div>

              <!-- Article Preview 7 -->
              <div class="card_box">
                <div class="img_box" style="background-image: url(assets/facade.jpeg)">
                  <!-- Background image for article on custom carpentry -->
                </div>
                <div class="text_box">
                  <h4>Menuiserie sur mesure pour votre maison</h4>
                  <p>
                    Découvrez comment la menuiserie sur mesure peut
                    transformer et personnaliser votre espace de vie.
                  </p>
                  <a href="#" class="blog-slider__button">READ MORE</a>
                </div>
              </div>

              <!-- Article Preview 8 -->
              <div class="card_box">
                <div class="img_box" style="background-image: url(assets/facade.jpeg)">
                  <!-- Background image for article on renewable energies -->
                </div>
                <div class="text_box">
                  <h4>Investir dans les énergies renouvelables à domicile</h4>
                  <p>
                    Un guide pour intégrer les énergies solaire, éolienne et
                    autres sources renouvelables dans votre foyer.
                  </p>
                  <a href="#" class="blog-slider__button">READ MORE</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="overlayMenu"></div>

  <!-- Ajoutez ceci à votre corps HTML, à l'endroit souhaité -->
  <div id="scrollButton" class="pulse-button">
    <p>Devis gratuit</p>
  </div>

  <!-- Include Swiper's JS just before initializing Swiper -->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script src="script/jquery-3.4.1.min.js"></script>
  <script src="script/bootstrap.min.js"></script>
  <script src="script/owl.carousel.min.js"></script>

  <script>
    // Gestion de l'effet de défilement pour la barre de navigation
    window.addEventListener("scroll", function () {
      var nav = document.querySelector(".top-nav");
      nav.classList.toggle("scrolled", window.scrollY > 0);
    });

    window.onload = function () {
      console.log("Le script est chargé et exécuté.");

      // Initialisation de Flickity pour le carrousel
      var carousel = document.querySelector(".hero-slider");
      if (carousel) {
        var flkty = new Flickity(carousel, {
          accessibility: true,
          prevNextButtons: true,
          pageDots: true,
          setGallerySize: false,
          arrowShape: { x0: 10, x1: 60, y1: 50, x2: 60, y2: 45, x3: 15 },
        });

        flkty.on("scroll", function (progress) {
          flkty.slides.forEach(function (slide, i) {
            var image = carousel.querySelectorAll(".carousel-cell")[i];
            var x = ((slide.target + flkty.x) * -1) / 3;
            image.style.backgroundPosition = x + "px center";
          });
        });
      }

      // Gestion du bouton hamburger et de l'affichage du menu
      const hamburger = document.querySelector(".hamburger");
      const menu = document.querySelector(".menu");
      const overlay = document.querySelector(".overlayMenu");

      hamburger.addEventListener("click", function () {
        this.classList.toggle("active");
        menu.classList.toggle("active");
        overlay.style.display = menu.classList.contains("active")
          ? "block"
          : "none";
      });

      // Initialisation de Swiper pour le slider du blog
      var swiper = new Swiper(".blog-slider", {
        spaceBetween: 30,
        effect: "fade",
        loop: true,
        mousewheel: {
          invert: false,
        },
        pagination: {
          el: ".blog-slider__pagination",
          clickable: true,
        },
      });

      // Initialisation du carrousel Owl pour les cartes
      function card_carouselInit() {
        $(".owl-carousel.card_carousel").owlCarousel({
          dots: false,
          loop: true,
          margin: 20,
          stagePadding: 2,
          autoplayTimeout: 2500,
          nav: true,
          navText: [
            "<i class='far fa-arrow-alt-circle-left'></i>",
            "<i class='far fa-arrow-alt-circle-right'></i>",
          ],
          autoplayHoverPause: true,
          responsive: {
            0: {
              items: 1,
            },
            865: {
              items: 2,
            },
            992: {
              items: 3,
            },
          },
        });
      }
      card_carouselInit();
    };

    window.onscroll = function () {
      scrollFunction();
    };

    function scrollFunction() {
      var scrollHeight =
        document.documentElement.scrollHeight -
        document.documentElement.clientHeight;
      var scrollPosition =
        window.scrollY || document.documentElement.scrollTop;

      // Calcule le pourcentage de défilement
      var scrollPercentage = scrollPosition / scrollHeight;

      // Affiche le bouton si le pourcentage de défilement dépasse 40%
      if (scrollPercentage > 0.3) {
        document.getElementById("scrollButton").style.display = "flex";
      } else {
        document.getElementById("scrollButton").style.display = "none";
      }
    }

    document.addEventListener("scroll", function () {
      var blogSlider = document.querySelector(".blog-slider");
      var position = blogSlider.getBoundingClientRect();

      // Vérifie si blogSlider est dans la fenêtre d'affichage
      if (position.top >= -50 && position.bottom <= window.innerHeight) {
        // Supprime la classe pour réinitialiser l'animation
        blogSlider.classList.remove("animate-line");

        // Force le navigateur à reconnaître la suppression de la classe
        void blogSlider.offsetWidth;

        // Rajoute la classe pour déclencher l'animation
        blogSlider.classList.add("animate-line");
      }
    });
  </script>
</body>

</html>