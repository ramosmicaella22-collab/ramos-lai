<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product - Glassmorphism</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 40px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #2d4a3e 0%, #172821 100%),
                        url('https://images.unsplash.com/photo-1511497584788-876761102346?q=80&w=1920&auto=format&fit=crop') no-repeat center center fixed;
            background-blend-mode: overlay;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #fff;
        }
        .card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
            width: 100%;
            max-width: 450px;
            position: relative;
            overflow: hidden;
        }
        /* Glossy light sheen effect */
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -50%;
            width: 200%;
            height: 50%;
            background: linear-gradient(to bottom, rgba(255,255,255,0.15), rgba(255,255,255,0));
            transform: rotate(-15deg);
            pointer-events: none;
        }
        h1 {
            margin-top: 0;
            color: #ffffff;
            font-size: 24px;
            margin-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            padding-bottom: 12px;
        }
        .form-group {
            margin-bottom: 18px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #e0e0e0;
            font-size: 13px;
            letter-spacing: 0.5px;
        }
        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 11px;
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 14px;
            color: #333;
            outline: none;
            transition: background 0.2s;
        }
        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus {
            background: #ffffff;
        }
        .btn-save {
            background-color: #1b2e25;
            color: white;
            padding: 12px 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            letter-spacing: 1px;
            width: 100%;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            transition: background 0.3s ease;
            margin-top: 10px;
        }
        .btn-save:hover {
            background-color: #243d31;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #cbd5e1;
            text-decoration: none;
            font-size: 13px;
        }
        .back-link:hover {
            text-decoration: underline;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Add New Product</h1>
        
        <form action="<?= site_url('products/store'); ?>" method="POST">
            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="product_name" placeholder="Enter product name" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="3" placeholder="Enter product description"></textarea>
            </div>

            <div class="form-group">
                <label>Price (₱)</label>
                <input type="number" step="0.01" name="price" placeholder="0.00" required>
            </div>

            <div class="form-group">
                <label>Quantity</label>
                <input type="number" name="quantity" placeholder="0" required>
            </div>

            <button type="submit" class="btn-save">SAVE PRODUCT</button>
        </form>

        <a href="<?= site_url('products'); ?>" class="back-link">← Back to Product List</a>
    </div>
</body>
</html>