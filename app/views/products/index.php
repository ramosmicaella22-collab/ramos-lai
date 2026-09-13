<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management - Dashboard</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 30px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #2d4a3e 0%, #172821 100%),
                        url('https://images.unsplash.com/photo-1511497584788-876761102346?q=80&w=1920&auto=format&fit=crop') no-repeat center center fixed;
            background-blend-mode: overlay;
            background-size: cover;
            min-height: 100vh;
            color: #fff;
        }
        .main-container {
            max-width: 1000px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        }
        .header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            padding-bottom: 15px;
        }
        h1 {
            margin: 0;
            font-size: 24px;
            color: #ffffff;
        }
        .user-section {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 14px;
            color: #e0e0e0;
        }
        .btn-logout {
            background-color: rgba(255, 75, 75, 0.8);
            color: white;
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            transition: background 0.2s;
        }
        .btn-logout:hover {
            background-color: rgb(255, 75, 75);
        }
        .btn-add {
            background-color: #1b2e25;
            color: white;
            padding: 10px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            display: inline-block;
            margin-bottom: 20px;
            transition: background 0.2s;
        }
        .btn-add:hover {
            background-color: #243d31;
        }
        .table-responsive {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            font-size: 14px;
        }
        th {
            background-color: rgba(0, 0, 0, 0.2);
            color: #ffffff;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }
        tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        tr:hover {
            background-color: rgba(255, 255, 255, 0.08);
        }
        td {
            color: #f0f0f0;
        }
        .empty-row {
            text-align: center;
            color: #ccc;
            padding: 20px;
        }
        .action-links a {
            margin-right: 10px;
            text-decoration: none;
            font-weight: 500;
        }
        .action-edit {
            color: #93c5fd;
        }
        .action-edit:hover {
            text-decoration: underline;
        }
        .action-delete {
            color: #fca5a5;
        }
        .action-delete:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="header-flex">
            <h1>Product Inventory</h1>
            <div class="user-section">
                <span>Welcome!</span>
                <a href="<?= site_url('logout'); ?>" class="btn-logout">Logout</a>
            </div>
        </div>

        <div>
            <a href="<?= site_url('products/create'); ?>" class="btn-add">+ Add New Product</a>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $p): ?>
                            <tr>
                                <td><?= $p['id']; ?></td>
                                <td><strong><?= $p['product_name']; ?></strong></td>
                                <td><?= $p['description']; ?></td>
                                <td>₱<?= number_format($p['price'], 2); ?></td>
                                <td><?= $p['quantity']; ?></td>
                                <td class="action-links">
                                    <a href="<?= site_url('products/edit/' . $p['id']); ?>" class="action-edit">Edit</a>
                                    <a href="<?= site_url('products/delete/' . $p['id']); ?>" onclick="return confirm('Are you sure you want to delete this product?');" class="action-delete">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="empty-row">No products found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>