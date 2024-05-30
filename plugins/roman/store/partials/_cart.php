<?php
$cart = $this->vars['formModel']->cart;

if (!empty($cart)) {
    echo "<table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Preview</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>";

    $summaryPrice = 0;
    foreach ($cart as $item) {
        echo "<tr>
                <td>{$item['name']}</td>
                <td>";

        if (isset($item['src'])) {
            echo "<img src='{$item['src']}' alt='Preview'>";
        }

        echo "</td>
                <td>₴{$item['price']}</td>
                <td>{$item['count']}</td>";

        $totalPrice = $item['price'] * $item['count'];
        echo "<td>₴{$totalPrice}</td>";

        $summaryPrice += $totalPrice;

        echo "</tr>";
    }

    echo "</tbody>
        </table>";
    
    echo "<p>Summary Price: ₴{$summaryPrice}</p>";
} else {
    echo "<p>Cart is empty!</p>";
}
?>
