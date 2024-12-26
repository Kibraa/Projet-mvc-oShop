<footer>
    <div class="footer-content">
        <p>Dans les "shoe" - Votre boutique de chaussures</p>
        <p>Livraison et retours gratuits • 30 jours pour changer d'avis</p>
        <p>Service client : 01 02 03 04 05 (lun-ven, 8h-19h)</p>
    </div>

    <div class="social-links">
        <p>Suivez-nous sur :</p>
        <?php if (!empty($socialLinks)): ?>
            <?php foreach ($socialLinks as $link): ?>
                <a href="<?= htmlspecialchars($link['url']) ?>" target="_blank" aria-label="<?= htmlspecialchars($link['name']) ?>">
                    <img src="/oshop/public/assets/icons/<?= htmlspecialchars($link['image']) ?>" 
                         alt="<?= htmlspecialchars($link['name']) ?>" 
                         class="social-icon">
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun réseau social disponible.</p>
        <?php endif; ?>
    </div>

    <div class="newsletter">
        <form action="/oshop/public/newsletter" method="post">
            <label for="newsletter">Inscrivez-vous à notre newsletter :</label>
            <input type="email" id="newsletter" name="email" placeholder="Votre email" required>
            <button type="submit">S'inscrire</button>
        </form>
    </div>
</footer>