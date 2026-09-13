<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen p-6">
    <div class="max-w-6xl mx-auto bg-white shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Product Inventory</h1>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-600">Welcome!</span>
                <a href="<?= site_url('logout'); ?>" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm transition">Logout</a>
            </div>
        </div>

        <div class="flex justify-between items-center mb-4">
            <a href="<?= site_url('products/create'); ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition">+ Add New Product</a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $p): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?= $p['id']; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $p['product_name']; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $p['description']; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">₱<?= number_format($p['price'], 2); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?= $p['quantity']; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="<?= site_url('products/edit/' . $p['id']); ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <a href="<?= site_url('products/delete/' . $p['id']); ?>" onclick="return confirm('Are you sure you want to delete this product?');" class="text-red-600 hover:text-red-900">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">No products found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>