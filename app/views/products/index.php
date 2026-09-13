<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
</head>
<body>
    <h2>Product List</h2>
    <a href="/products/create">+ Add New Product</a>
    <br><br>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= html_escape($product['id']) ?></td>
                <td><?= html_escape($product['product_name']) ?></td>
                <td><?= html_escape($product['description']) ?></td>
                <td><?= html_escape($product['price']) ?></td>
                <td><?= html_escape($product['quantity']) ?></td>
                <td><?= html_escape($product['created_at']) ?></td>
                <td>
                    <a href="/products/edit/<?= $product['id'] ?>">Edit</a> |
                    <a href="/products/delete/<?= $product['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>