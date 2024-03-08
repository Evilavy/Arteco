<nav class="top-nav">
    <button class="hamburger" aria-label="Menu" id="hamburger">
        <svg class="hb" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10" stroke="#eee" stroke-width=".6"
            fill="rgba(0,0,0,0)" stroke-linecap="round" style="cursor: pointer">
            <path class="hb2" d="M2,3L5,3L8,3M2,5L8,5M2,7L5,7L8,7">
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
            <a id="logo" href="index.php">Arteco</a>
            <a href="#">Pompe à chaleur</a>
            <a href="#">Ventilation</a>
            <a href="#">Façade</a>
            <a href="#">Isolation</a>
            <a href="consulter-realisations.php">Réalisations</a>
            <a href="#">Nos partenaires</a>
        </div>
        <div class="right">
            <a target="_blank" href="https://www.facebook.com/profile.php?id=61553917978826"><img
                    src="./assets/logo facebook.png" alt="" />
            </a>
            <a href="">
                <img src="./assets/instagram logo.webp" alt="">
            </a>
            <a id="CTA" href="devis.php">Devis gratuit</a>
        </div>
    </div>
</nav>