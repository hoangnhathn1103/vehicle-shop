<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hoangnhatshop";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Hàm tính độ tương đồng cosine
function cosine_similarity($v1, $v2)
{
    $dot_product = 0;
    $magnitude1 = 0;
    $magnitude2 = 0;

    if (is_array($v1) && is_array($v2)) {
        foreach ($v1 as $key => $value) {
            if (array_key_exists($key, $v2)) {
                $dot_product += $value * $v2[$key];
            }
            $magnitude1 += pow($value, 2);
        }

        foreach ($v2 as $key => $value) {
            $magnitude2 += pow($value, 2);
        }

        $magnitude = sqrt($magnitude1) * sqrt($magnitude2);
        if ($magnitude == 0) {
            return 0;
        }

        return $dot_product / $magnitude;
    } else {
        // handle error when $v1 or $v2 is not an array
        return false;
    }
}



// Hàm lưu ma trận vào cơ sở dữ liệu
function save_matrix_to_database($conn, $matrix, $table_name)
{
    // Xóa bảng cũ nếu đã tồn tại
    $sql = "DROP TABLE IF EXISTS $table_name";
    mysqli_query($conn, $sql);

    // Tạo bảng mới
    $sql = "CREATE TABLE $table_name (
                customer_id VARCHAR(255) NOT NULL,
                product_id VARCHAR(255) NOT NULL,
                rating FLOAT,
                PRIMARY KEY (customer_id, product_id)
            )";
    mysqli_query($conn, $sql);

    // Thêm dữ liệu vào bảng
    foreach ($matrix as $customer_id => $products) {
        foreach ($products as $product_id => $rating) {
            $sql = "INSERT INTO $table_name (customer_id, product_id, rating)
                        VALUES ('$customer_id', '$product_id', $rating)";
            mysqli_query($conn, $sql);
        }
    }

}

function get_matrix_from_database($conn, $table_name) {
    $sql = "SELECT * FROM $table_name";
    $result = mysqli_query($conn, $sql);

    $matrix = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $row_data = array();
        foreach ($row as $key => $value) {
            if ($key != 'customer_id') {
                $row_data[$key] = $value;
            }
        }
        $matrix[$row['customer_id']] = $row_data;
    }

    return $matrix;
}




    // Kết nối cơ sở dữ liệu
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hoangnhatshop";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Đọc dữ liệu từ tệp CSV
    $file = fopen("data.csv","r");
    $data = array();
    while (($line = fgetcsv($file)) !== false) {
        $data[] = $line;
    }
    fclose($file);

    // Tạo ma trận
    $customers = array();
    $products = array();
    $ratings = array();
    foreach ($data as $row) {
        $customer_id = isset($row[0]) ? $row[0] : '';
        $product_id = isset($row[1]) ? $row[1] : '';
        $quantity = isset($row[2]) ? $row[2] : '';

        if (!empty($customer_id) && !in_array($customer_id, $customers)) {
        $customers[] = $customer_id;
        }
        if (!empty($product_id) && !in_array($product_id, $products)) {
        $products[] = $product_id;
        }

        $ratings[$customer_id][$product_id] = $quantity;
    }

    // In ma trận
    echo "   ";
    foreach ($products as $product_id) {
    echo $product_id . " ";
    }
    echo "\n";

    foreach ($customers as $customer_id) {
    echo $customer_id . " ";
    foreach ($products as $product_id) {
    echo isset($ratings[$customer_id][$product_id]) ? $ratings[$customer_id][$product_id] . " " : ' ' . " ";
    }
    echo "\n";
    }

    // Khởi tạo ma trận tương đồng
    $similarity_matrix = array();
    foreach ($ratings as $customer1 => $products1) {
        foreach ($ratings as $customer2 => $products2) {
            if ($customer1 != $customer2) {
                // Tính độ tương đồng cosine giữa hai khách hàng
                $similarity = cosine_similarity($products1, $products2);

                // Lưu độ tương đồng vào ma trận
                $similarity_matrix[$customer1][$customer2] = $similarity;
            }
        }
    }

    // Lưu ma trận đánh giá và ma trận tương đồng vào cơ sở dữ liệu
    save_matrix_to_database($conn, $ratings, 'ratings');
    save_matrix_to_database($conn, $similarity_matrix, 'similarity_matrix');


    // Tính toán ma trận dự đoán
    $prediction_matrix = array();
    foreach ($ratings as $customer1 => $products1) {
        foreach ($products1 as $product1 => $rating1) {
            $prediction = 0;
            $total_similarity = 0;

            foreach ($ratings as $customer2 => $products2) {
                if ($customer1 != $customer2 && isset($products2[$product1])) {
                    $similarity = $similarity_matrix[$customer1][$customer2];
                    $total_similarity += $similarity;
                    $prediction += $similarity * $products2[$product1];
                }
            }

            // Lưu dự đoán vào ma trận
            $prediction_matrix[$customer1][$product1] = ($total_similarity > 0) ? $prediction / $total_similarity : 0;
        }
    }

    // Lưu ma trận dự đoán vào cơ sở dữ liệu
    save_matrix_to_database($conn, $prediction_matrix, 'prediction_matrix');

    // Đóng kết nối cơ sở dữ liệu
    mysqli_close($conn);


    $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "hoangnhatshop";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Lấy ma trận đánh giá từ cơ sở dữ liệu
    $ratings = get_matrix_from_database($conn, 'ratings');

    // Lấy ma trận tương đồng từ cơ sở dữ liệu
    $similarity_matrix = get_matrix_from_database($conn, 'similarity_matrix');


    // Chọn một khách hàng để dự đoán
    $customer_id = '11';

    // Tính toán dự đoán cho khách hàng
    $prediction_matrix = array();
    foreach ($ratings as $customer => $products) {
        if ($customer != $customer_id) {
            // Tính độ tương đồng cosine giữa khách hàng được chọn và các khách hàng khác
            $similarity = cosine_similarity($ratings[$customer_id], $ratings[$customer]);

            // Lưu độ tương đồng và các đánh giá của khách hàng đó vào ma trận dự đoán
            foreach ($products as $product => $rating) {
                if (!isset($prediction_matrix[$product])) {
                    $prediction_matrix[$product] = array(
                        'similarity' => 0,
                        'rating' => 0,
                        'weighted_rating' => 0,
                    );
                }

                $prediction_matrix[$product]['similarity'] += $similarity;
                $prediction_matrix[$product]['rating'] += $rating;
                $prediction_matrix[$product]['weighted_rating'] += $rating * $similarity;
            }
        }
    }
    print_r($prediction_matrix);

    // Tính toán các sản phẩm gợi ý dựa trên ma trận dự đoán
    $recommendations = array();
    foreach ($prediction_matrix as $product => $values) {
        if ($values['rating'] == 0) {
            $recommendations[$product] = $values['weighted_rating'] / $values['similarity'];
        }
    }

    // Sắp xếp các sản phẩm gợi ý theo thứ tự giảm dần của độ ưu tiên
    arsort($recommendations);

    print_r($recommendations);
    // In ra danh sách các sản phẩm gợi ý cho khách hàng
    echo "Sản phẩm gợi ý cho khách hàng " . $customer_id . ":\n";
    foreach ($recommendations as $product => $score) {
        echo "- " . $product . " (Độ ưu tiên: " . $score . ")\n";
    }

    // Đóng kết nối cơ sở dữ liệu
    mysqli_close($conn);


?>
