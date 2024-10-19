<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Page</title>
    <!-- TEMPORARY STYLE -->
    <style>
        main{
            display: flex;
            flex-direction: column;
            align-items: center;
            border-style: solid;
            border-color: red;
            min-height: 100vh;
        }

        header{
            display: flex;
            flex-direction: row;
            border: 1px solid violet;
            width: 100%;
        }

        .main-table{
            margin-top: 5rem;
            width: 50rem;
        } 

        .table-header{
            display: flex;
            flex-direction: row;
        }

        .table-header > p{
            margin: 0;
        }

        .table-header button:first-of-type{
            margin-left: auto;
        }

        .table-products > table{
            width: 100%;
            border-collapse: collapse;
            border-style: solid;
        }

        .table-products > table th, td{
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
                <Select>Category</Select>
            </div>
            <div class="table-products">
                <table>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Availability</th>
                        <th>Category</th>
                    </tr>
                    <tr>
                        <td>Samosa</td>
                        <td>150</td>
                        <td>SARAP</td>
                        <td>In Stock</td>
                        <td>Food</td>
                    </tr>
                    <tr>
                        <td>Condomizer</td>
                        <td>510</td>
                        <td>Nuot sa sarap</td>
                        <td>In Stock</td>
                        <td>Food</td>
                    </tr>
                    <!-- ADD ROWS HERE USING PHP (From the database) -->
                     <!-- GOOD LUCK!!! -->
                </table>
            </div>
        </div>
    </main>
</body>
</html>