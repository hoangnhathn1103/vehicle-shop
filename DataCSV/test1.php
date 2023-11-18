<?php

// Kết nối với cơ sở dữ liệu MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hoangnhatshop";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối tới cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Truy vấn dữ liệu giao dịch mua hàng từ bảng trong cơ sở dữ liệu
$sql = "SELECT users.id, orders_details.product_id, orders_details.qty
FROM users
INNER JOIN orders ON users.id = orders.user_id
INNER JOIN orders_details ON orders.id = orders_details.order_id";
$result = $conn->query($sql);

// Kiểm tra và xử lý dữ liệu giao dịch
if ($result->num_rows > 0) {
    $transactions = [];
    while ($row = $result->fetch_assoc()) {
        $transactions[] = [
            "user_id" => $row["id"],
            "product_id" => $row["product_id"],
            "quantity" => $row["qty"]
        ];
    }
} else {
    echo "Không có dữ liệu giao dịch.";
}

// Đóng kết nối với cơ sở dữ liệu
$conn->close();


// Hàm tính khoảng cách Euclidean giữa hai điểm
function euclideanDistance($point1, $point2) {
    $sum = 0;
    foreach ($point1 as $key => $value) {
        $sum += pow($value - $point2[$key], 2);
    }
    return sqrt($sum);
}

// Hàm gợi ý sản phẩm cho khách hàng dựa trên KNN
function recommendItems($userId, $k) {
    global $transactions;

    // Lọc các giao dịch của khách hàng
    $customerTransactions = array_filter($transactions, function($transaction) use ($userId) {
        return $transaction['user_id'] == $userId;
    });

    // Tính toán khoảng cách giữa các giao dịch của khách hàng
    $distances = [];
    foreach ($customerTransactions as $transaction1) {
        $point1 = [$transaction1['product_id'], $transaction1['quantity']];
        foreach ($transactions as $transaction2) {
            if ($transaction2['user_id'] != $userId) {
                $point2 = [$transaction2['product_id'], $transaction2['quantity']];
                $distances[] = [
                    'transaction' => $transaction2,
                    'distance' => euclideanDistance($point1, $point2)
                ];
            }
        }
    }
        // Sắp xếp các giao dịch theo khoảng cách tăng dần
        usort($distances, function($a, $b) {
            return $a['distance'] <=> $b['distance'];
        });

        // Lấy danh sách mã sản phẩm gợi ý dựa trên K giao dịch gần nhất
        $recommendedItems = [];
        for ($i = 0; $i < $k; $i++) {
            $recommendedItems[] = $distances[$i]['transaction']['product_id'];
        }

        $recommendedItems=array_unique($recommendedItems);

        return $recommendedItems;
}

// Gọi hàm recommendItems và hiển thị danh sách sản phẩm gợi ý
$recommendedItems = recommendItems(6, 6); // Đây là ví dụ, bạn có thể thay đổi K (số lượng sản phẩm gợi ý)
echo "Các sản phẩm gợi ý cho khách hàng là: ";
foreach ($recommendedItems as $item) {
    echo $item . " ";
}
