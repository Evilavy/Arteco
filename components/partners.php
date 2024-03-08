<?php

try {
    // Prepare and execute the query to fetch partner images
    $stmtPartners = $pdo->prepare("SELECT srcImg FROM Partenaire");
    $stmtPartners->execute();

    // Fetch all partner images
    $partners = $stmtPartners->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}


?>
<div class="marquee">
    <h3>Nos partenaires</h3>
    <ul class="marquee-content">
        <?php foreach ($partners as $partner): ?>
            <li class="slide">
                <i><img src="<?= htmlspecialchars($partner['srcImg']) ?>" alt="Partner Logo"></i>
            </li>
        <?php endforeach; ?>
    </ul>
</div>