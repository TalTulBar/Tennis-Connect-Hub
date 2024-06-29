<?php
session_start();
include 'db_connection.php'; 
$page_css = "css/my-orders.css";
include 'header.php';
?>
<div class="cart-section">
    <h3 class="mt-6">Order History</h3>
    <div class="cart-product grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 justify-items-center		">
        <?php
        $orderQuery = "SELECT * FROM reservations ORDER BY created_at DESC";
        $orderResult = mysqli_query($conn, $orderQuery);

        if ($orderResult) {
            if (mysqli_num_rows($orderResult) > 0) {
                while ($orderRow = mysqli_fetch_assoc($orderResult)) {
                    ?>
                    <div class="item border p-4 rounded shadow-sm">
                        <div class="order-date">
                            <div class="order-detail">
                                <div class="description">
                                    <span class="block font-bold">Order ID: <?php echo $orderRow['order_id']; ?></span>
                                    <span class="block">Product: <?php echo $orderRow['product_name']; ?></span>
                                    <span class="block">Price: $<?php echo $orderRow['price']; ?></span>
                                    <span class="block">Order Date: <?php echo $orderRow['created_at']; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="text-center flex justify-center flex-col">

                <p class="text-center mb-2"> order not found for your search</p>
                <a id="returnToSearch" href="index.php" class="text-center text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-1 text-center">Return to Search</a>
                </div>
<?php
            }
            mysqli_free_result($orderResult);
        } else {
            ?>
            <p class="text-red-500">Error fetching orders: <?php echo mysqli_error($conn); ?></p>
            <?php
        }

        mysqli_close($conn);
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
   $(document).ready(function() {
      var currentPage = location.pathname.split('/').pop();
      currentPage = currentPage.split('.')[0];
      $('ul li').removeClass('active');
      $('ul li a[href="' + currentPage + '.php"]').parent().addClass('active');
   });
</script>
<?php include 'footer.php'; ?>
