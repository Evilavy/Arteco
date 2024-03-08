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
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.pkgd.min.js"></script>

  <link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="styles/fontawesome.min.css" rel="stylesheet" type="text/css" />
  <link href="styles/owl.carousel.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="./styles/styles.css" />
  <link rel="stylesheet" href="./styles/partners.css" />
  <link rel="stylesheet" href="./styles/footer.css" />
  <title>Accueil</title>
</head>

<body>
  <?php include 'components/nav.php' ?>
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

  <section class="first section-height">
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

  <section class="second section-height">
    <h3 id="title">Nos préstations</h3>
    <div class="hero-slider" data-carousel>
      <?php
      // Requête pour récupérer toutes les prestations
      $sqlPrestations = "SELECT * FROM Prestation ORDER BY idPrestation DESC";
      $stmtPrestations = $pdo->prepare($sqlPrestations);
      $stmtPrestations->execute();
      $prestations = $stmtPrestations->fetchAll(PDO::FETCH_ASSOC);
      ?>
      <?php foreach ($prestations as $prestation): ?>
        <div class="carousel-cell" style="background-image: url('<?= $prestation['srcImage'] ?>')">
          <div class="overlay"></div>
          <div class="inner">
            <h2 class="title">
              <?= htmlspecialchars($prestation['titre']) ?>
            </h2>
            <p class="subtitle">
              <?= nl2br(htmlspecialchars($prestation['description'])) ?>
            </p>
            <a href="devis.php" class="btn">Estimer</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    </div>
  </section>

  <section class="third section-height">
    <h3 id="title">Découvrir nos réalisations</h3>

    <?php
    // Requête pour récupérer toutes les réalisations
    $sqlRealisations = "SELECT * FROM Realisations ORDER BY datePublication DESC";
    $stmtRealisations = $pdo->prepare($sqlRealisations);
    $stmtRealisations->execute();
    $realisations = $stmtRealisations->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="blog-slider">
      <div class="blog-slider__wrp swiper-wrapper">
        <?php foreach ($realisations as $realisation): ?>
          <div class="blog-slider__item swiper-slide">
            <div class="blog-slider__img">
              <img src="<?= htmlspecialchars($realisation['srcImgApres']) ?>" alt="Image Après">
            </div>
            <div class="blog-slider__content">
              <span class="blog-slider__code">
                <?= htmlspecialchars($realisation['datePublication']) ?>
              </span>
              <div class="blog-slider__title">
                <?= htmlspecialchars($realisation['titre']) ?>
              </div>
              <div class="blog-slider__text">
                <?= htmlspecialchars(strlen($realisation['situation']) > 200 ? substr($realisation['situation'], 0, 200) . '...' : $realisation['situation']) ?><br>
              </div>
              <a href="consulter-realisation.php?id=<?= $realisation['idRealisation'] ?>"
                class="blog-slider__button">Consulter</a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <img src="./prestationRepo" alt="">
      <div class="blog-slider__pagination"></div>
    </div>
  </section>

  <section class="fourth section-height">
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
        <div class="card" style="background-image: url('<?= htmlspecialchars($personnel['photo']) ?>');">
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

  <section class="fifth section-height">
    <h3 id="title">Le blog d’Arteco</h3>
    <?php
    $sqlArticles = "SELECT * FROM Article WHERE published = 1";
    $stmtArticles = $pdo->prepare($sqlArticles);
    $stmtArticles->execute();

    // Début du conteneur principal
    echo '<div class="card_wrapper"><div class="container"><div class="row"><div class="col-12"><div class="owl-carousel card_carousel">';

    while ($article = $stmtArticles->fetch()) {
      // Déterminer le chemin de l'image
      $imagePath = $article['srcImage'];

      // Générer le HTML pour l'article
      echo "<div class='card_box'>";
      echo "<div class='img_box' style='background-image: url(\"$imagePath\");'></div>";
      echo "<div class='text_box'>";

      // Vérifier si l'article a un lien
      if ($article['isLien'] == "1") {
        // Afficher uniquement le titre et une description spécifique pour les articles liés
        echo "<h4>" . htmlspecialchars($article['titre']) . "</h4>";
        echo "<p>Article à lien</p>";
        // Utiliser l'URL stockée dans $article['lien'] pour le bouton "Consulter"
        echo "<a target='_blank' href='" . $article['lien'] . "' class='blog-slider__button'>Consulter</a>";
      } else {
        // Obtenir la première section pour la description si l'article n'est pas lié
        $sqlFirstSection = "SELECT * FROM Section WHERE idArticle = ? ORDER BY ordre LIMIT 1";
        $stmtFirstSection = $pdo->prepare($sqlFirstSection);
        $stmtFirstSection->execute([$article['idArticle']]);
        $firstSection = $stmtFirstSection->fetch();
        $description = $firstSection ? substr(htmlspecialchars($firstSection['texte']), 0, 100) : '';
        // Afficher le titre, la description tronquée et le bouton "Consulter" habituel
        echo "<h4>" . htmlspecialchars($article['titre']) . "</h4>";
        echo "<p>$description...</p>";
        echo "<a href='consulter-article.php?id=" . $article['idArticle'] . "' class='blog-slider__button'>Consulter</a>";
      }

      echo "</div></div>";
    }

    // Fin du conteneur principal
    echo '</div></div></div></div></div>';
    ?>
  </section>

  <?php
  include('components/partners.php');
  include('components/footer.php');
  ?>
  <div class="overlayMenu"></div>

  <!-- Ajoutez ceci à votre corps HTML, à l'endroit souhaité -->
  <div id="scrollButton" class="pulse-button">
    <a href="devis.php">Devis gratuit</a>
  </div>

  <!-- Include Swiper's JS just before initializing Swiper -->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script src="script/jquery-3.4.1.min.js"></script>
  <script src="script/bootstrap.min.js"></script>
  <script src="script/owl.carousel.min.js"></script>
  <script src="script/nav.js"></script>
  <script src="script/partners.js"></script>

  <script>

    window.onload = function () {

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

      // Initialisation de Swiper pour le slider du blog
      var swiper = new Swiper(".blog-slider", {
        spaceBetween: 30,
        effect: "fade",
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