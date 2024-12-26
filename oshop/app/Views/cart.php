<?php require __DIR__ . '/partials/header.php'; ?>

<main style="padding: 20px;">
    <h1>Mon panier</h1>
    <?php if (empty($_SESSION['cart'])): ?>
        <p>Votre panier est vide.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $productId => $quantity):
                    $stmt = $pdo->prepare('SELECT * FROM product WHERE id = :id');
                    $stmt->execute(['id' => $productId]);
                    $product = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (!$product) continue;

                    $total += $product['price'] * $quantity;
                ?>
                <tr>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= $quantity ?></td>
                    <td><?= number_format($product['price'], 2) ?> €</td>
                    <td><?= number_format($product['price'] * $quantity, 2) ?> €</td>
                    <td>
                        <form action="/oshop/public/cart/remove" method="post" style="display: inline;">
                            <input type="hidden" name="product_id" value="<?= $productId ?>">
                            <button type="submit" style="padding: 5px 10px; background-color: red; color: white; border: none; border-radius: 5px; cursor: pointer;">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Total</td>
                    <td><?= number_format($total, 2) ?> €</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    <?php endif; ?>
</main>

<?php 
try {
    $stmt = $pdo->query('SELECT * FROM social_links');
    $socialLinks = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $socialLinks = [];
}
require __DIR__ . '/partials/footer.php'; ?>