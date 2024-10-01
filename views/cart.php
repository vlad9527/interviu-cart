<!-- INCLUDE 'HEAD' -->

<?php if (!empty($items)): ?>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
        <tr>
            <th>Product ID</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['product_id']) ?></td>
                <td><?= htmlspecialchars($item['qty']) ?></td>
                <td><?= htmlspecialchars($item['price']) ?></td>
                <td><?= htmlspecialchars($item['price'] * $item['qty']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <p><strong>Subtotal:</strong> <?= htmlspecialchars($totalValue) ?></p>
    <p><strong>Shipping Cost:</strong> <?= htmlspecialchars($shippingCost) ?></p>
    <p><strong>Grand Total:</strong> <?= htmlspecialchars($grandTotal) ?></p>
<?php else: ?>
    <p>Your cart is empty.</p>
<?php endif; ?>

<!-- INCLUDE 'FOOTER' -->
