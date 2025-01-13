<?php
// Bao gồm file kết nối
include 'ketnoi.php';

// Lấy dữ liệu từ bảng thongtinsua
$limit = 5; // Số sản phẩm trên mỗi trang
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM thongtinsua LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

// Đếm tổng số bản ghi
$total_sql = "SELECT COUNT(*) as total FROM thongtinsua";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_pages = ceil($total_row['total'] / $limit);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sữa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Danh sách sản phẩm sữa</h1>
    <div class="container">
        <?php if ($result->num_rows > 0): ?>
            <div class="grid">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="product">
                        <table>
                            <tr>
                                <td colspan="2"><img src="<?php echo $row['HinhAnh']; ?>" alt="<?php echo $row['tenSua']; ?>" /></td>
                            </tr>
                            <tr>
                                <td>Tên sữa:</td>
                                <td><?php echo $row['tenSua']; ?></td>
                            </tr>
                            <tr>
                                <td>Hãng sữa:</td>
                                <td><?php echo $row['hangSua']; ?></td>
                            </tr>
                            <tr>
                                <td>Loại sữa:</td>
                                <td><?php echo $row['loaiSua']; ?></td>
                            </tr>
                            <tr>
                                <td>Trọng lượng:</td>
                                <td><?php echo $row['trongLuong']; ?>g</td>
                            </tr>
                            <tr>
                                <td>Đơn giá:</td>
                                <td><?php echo number_format($row['donGia'], 2); ?> VNĐ</td>
                            </tr>
                        </table>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>Không có sản phẩm nào.</p>
        <?php endif; ?>
    </div>

    <div class="pagination">
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>

    <?php $conn->close(); ?>
</body>
</html>