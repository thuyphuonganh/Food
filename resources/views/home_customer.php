<?php
    // Thêm kết nối
    include "conn.php";

    // Bắt đầu phiên làm việc
    session_start();

    // Kiểm tra xem người dùng đã đăng nhập và có vai trò là khách hàng chưa
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 2) {
        // Xóa thông tin trong localStorage
        echo "<script>
            localStorage.removeItem('user_id');
            localStorage.removeItem('role');
            window.location.href = 'login.php';
        </script>";
        exit();
    }


    //Tìm kiếm
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $query_search = "AND p.product_name LIKE '%$search%'";
    } else {
        $search = "";
        $query_search = "";
    }

    //Danh mục
    if (isset($_GET['danhmuc'])) {
        $danhmuc = $_GET['danhmuc'];
        $query_add_danh_muc = "AND c.id = $danhmuc";
    } else {
        $danhmuc = 0;
        $query_add_danh_muc = "";
    }

    // Lọc theo giá
    if (isset($_GET['filter'])) {
        $filter = $_GET['filter'];
    } else {
        $filter = "ASC";
    }

    // Phân trang
    $limit = 12;
    if(isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    if($page == 1) {
        $begin = 0;
    } else {
        $begin = ($page * $limit) - $limit; //Công thức lấy sản phẩm từ vị trí đầu tiên
    }

    //Query danh mục
    $query_danhmuc = "SELECT * FROM categories";
    $data_danh_muc = mysqli_query($conn, $query_danhmuc);

    //Query sản phẩm
    $query = "SELECT p.id, p.product_name, p.price, p.image, p.status
    FROM products p, categories c
    WHERE p.category_id = c.id $query_add_danh_muc $query_search
    ORDER BY p.price $filter
    LIMIT $begin,$limit";
    $data = mysqli_query($conn, $query);


?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DuDu Store | Trang chủ</title>
    <link rel="stylesheet" href="../css/home.css">
    <link rel="icon" href="../images/favicon.png" type="image/png">
</head>
<body>


<?php include 'header.php'; ?>
    <main>
        <div class="products">
            <div class="main-search-filter">
            <form id="form-filter" action="home_customer.php" method='get'>
                <div class="sort-filter">
                    <!-- Lọc giá trị ------------------------------------------------------------------------------- -->
                    <select name ="filter" class = "select-filter" onchange = "document.getElementById('form-filter').submit()">
                        <?php if ($filter == "ASC") { ?>
                        <option value="ASC">Lọc theo giá: từ thấp đến cao</option>
                        <option value="DESC">Lọc theo giá: từ cao đến thấp</option>
                        <?php
                    } else {?>
                        <option value="DESC">Lọc theo giá: từ cao đến thấp</option>
                        <option value="ASC">Lọc theo giá: từ thấp đến cao</option>
                    <?php
                        }
                    ?>
                    </select>
                    <!-- -------------------------------------------------------------------------------------- -->
                </div>

                <!-- Gửi thêm giá trị danh mục khi lọc -->
                <?php
                    if ($danhmuc != 0) {?>
                    <input type="hidden" name="danhmuc" value="<?php echo $danhmuc?>">
                <?php
                    }
                ?>

                <!-- Gửi thêm giá trị tìm kiếm khi lọc -->
                <?php
                    if ($search != "") {?>
                    <input type="hidden" name="search" value="<?php echo $search?>">
                <?php
                    }
                ?>
            </form>

            <!-- Form tìm kiếm -->
            <div class="search-bar">
                <input type="text" id="input_search" placeholder="Nhập tên cần tìm" value="<?php echo $search; ?>" />
            </div>
            </div>

            <!-- Danh sách sản phẩm -->
            <div class="product-grid" id="productGrid">
                <?php while ($row = mysqli_fetch_assoc($data)) { ?>
                    <a href="product_detail.php?id=<?php echo $row['id']; ?>" class="product-link">
                        <div class="product-item">
                            <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['product_name']; ?>">
                            <p><?php echo $row['product_name']; ?></p>
                            <span><?php echo number_format($row['price'], 0, ',', '.'); ?>đ</span>
                            <button>Mua</button>
                        </div>
                    </a>
                <?php } ?>
            </div>

            <!-- PHÂN TRANG -->
            <div class="pagination" id="paginationContainer">
                <!-- Phân trang sẽ được tạo tự động -->
                 <?php
                    $query_trang = "SELECT p.id, p.product_name, p.price, p.image, p.status FROM products p, categories c WHERE p.category_id = c.id $query_add_danh_muc $query_search ORDER BY p.price $filter"; // Câu lệnh truy vấn
                    $sql_trang = mysqli_query($conn,$query_trang);  // Dữ liệu sau khi truy vấn
                    $row_count = mysqli_num_rows($sql_trang); //Số dòng dữ liệu
                    $page_count = ceil($row_count/$limit); //Số trang
                 ?>

                  <!-- Hiển thị icon first page   -->
                <?php
                    if ($page > 2) {
                        $first_page = 1;
                ?>
                    <a href='home_guest.php?page=<?php echo $first_page?>' class="product-link">
                        <span><<</span>
                    </a>
                <?php
                    }
                ?>

                <!-- Hiển thị từng số phân trang -->
                 <?php
                    for($i = 1; $i <= $page_count; $i++) {
                      if($i > $page-2 && $i < $page + 2) {?>
                            <a <?php if($page == $i) echo 'style="background:green";' ?>  href='home_customer.php?page=<?php echo $i?>&filter=<?php echo $filter?>&search=<?php echo $search;?>
                            <?php if($query_add_danh_muc != "") {?>
                                &danhmuc=<?php echo $danhmuc?>
                             <?php
                            }?>'
                            class="product-link">
                            <span><?php echo $i?></span>
                            </a>
                      <?php
                      }
                 ?>
                <?php
                    }
                ?>

                <!-- Hiển thị icon last page -->
                <?php
                    if ($page < $page_count-1) {
                        $end_page = $page_count;
                        ?>
                        <a href='home_customer.php?page=<?php echo $end_page?>' class="product-link">
                            <span>>></span>
                        </a>
                <?php
                    }
                ?>

            </div>
        </div>
    </main>
    <!-- JavaScript -->
    <script>
        const input = document.getElementById("input_search");
        input.addEventListener('keydown', function(event){
            var danhmuc = "<?php echo $danhmuc != 0 ? '&danhmuc=' + $danhmuc : ''; ?>";
            if (event.key === 'Enter') {
                const search = input.value;
                window.location.href = "home_customer.php?search=" + encodeURIComponent(search) + danhmuc + "&filter=<?php echo $filter?>";
            }
        })
    </script>
    <?php include 'footer.php'; ?>
</body>
</html>
