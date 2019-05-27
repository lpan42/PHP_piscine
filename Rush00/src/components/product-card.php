<?php
	$stock = max(0, $product['stock'] - $_SESSION['cart'][$product['id']]);
?>
<div class="product">
    <form method="post">
        <div class="title"><?= $product['name'] ?></div>
        <div class="img-container">
            <img src="/<?= PRODUCTS_FOLDER.'/'.$product['id'] ?>" width="100%">
        </div>
        <p>
            <?php if ($stock <= 0) : ?>
                OUT OF STOCK
            <?php else : ?>
                <?= $stock ?> LEFT
            <?php endif; ?>
        </p>
        <p><?= $product['price'] ?> €</p>
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
        <input type="number" name="amount" value="1">
        <button type="submit" name="addcart" value="Add" <?= $product['stock'] - $_SESSION['cart'][$product['id']] <= 0 ? 'disabled' : '' ?>>Add to chart</button>
    </form>
</div>