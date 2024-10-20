<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Page</title>
    <!-- TEMPORARY STYLE -->
    <style>
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            border-style: solid;
            border-color: red;
            min-height: 100vh;
        }

        header {
            display: flex;
            flex-direction: row;
            border: 1px solid violet;
            width: 100%;
        }

        .main-table {
            margin-top: 5rem;
            width: 50rem;
        } 

        .table-header {
            display: flex;
            flex-direction: row;
        }

        .table-header > p {
            margin: 0;
        }

        .table-header button:first-of-type {
            margin-left: auto;
        }

        .table-products > table {
            width: 100%;
            border-collapse: collapse;
            border-style: solid;
        }

        .table-products > table th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <header>
        <h1>HEADER SAMPLE BOOTHLINK</h1>
    </header>
    <main>
        <div class="main-table">
            <div class="table-header">
                <p>PRODUCT LISTING</p>
                
                <a href="EditProduct.html">
                    <button>Edit</button>
                </a>
                <a href="AddNewProduct.html">
                    <button>Add</button>
                </a>
                <select>Category</select>
            </div>
            <div class="table-products">
                <table>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Category</th>
                    </tr>
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?php echo $product['prod_serv_name']; ?></td>
                                <td><?php echo $product['price']; ?></td>
                                <td><?php echo $product['description']; ?></td>
                                <td><?php echo $product['category']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No products available</td>
                        </tr>
                    <?php endif; ?> 
                </table>
            </div>
        </div>
    </main>
</body>
</html>