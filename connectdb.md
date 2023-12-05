1. Hàm mysqli_select_db: được sử dụng để kết nối với một MySQL database
Cú pháp: $db_handle = mysqli_connect($db_server_name, $db_user_name, $db_password);
Giải thích cú pháp của hàm mysqli_connect:
    $db_handle là biến sử dụng để kết nối với cơ sở dữ liệu.
    mysqli_connect(...) là hàm cho phép php kết nối ới CSDL
    $server_name là tên hoặc địa chỉ IP của hosting MySQL Server
    $user_name là giá trị user name trong MySQL server

2. Hàm mysqli_select_db: Được dùng để chọn một cơ sở dữ liệu
Cú pháp: mysqli_select_db(connection, dbname);
    mysqli_select_db(...) là hàm lựa chọn cơ sở dữ liệu, trả về true hoặc false
    connection Xác định kết nối MySQL để sử dụng
    dbname Xác định cơ sở dữ liệu để được sử dụng

3. Hàm mysqli_query : được dùng để thuực hiện truy vấn đến database
Cú pháp: mysqli_query(connection, query, resultmode);
    conection chỉ định kết nối MySQL sử dụng
    query chỉ định chuỗi truy vấn
    resultmode chỉ định chế độ của kết quả trả về (MYSQLI_STORE_RESULT là mặc định, còn nếu cần phải lấy số lượng lớn dữ liệu thì sử dụng MYSQLI_USE_RESULT)

3. Hàm mysqli_num_rows : Được dùng để trả về số lượng hàng trong một tập kết quả
Cú pháp: mysqli_num_rows(result):
    result là tập hợp các kết quả trả về từ các hàm mysqli_query(), mysqli_store_result() hoặc mysqli_use_result()

4. Hàm mysqli_fetch_array: Tìm nạp một hàng kết quả dưới dạng một mảng kết hợp, một mảng số hoặc cả hai
> Lưu ý: Các fieldname trả về từ hàm này là phân biệt hoa thường.
Cú pháp: mysqli_fetch_array(result, resulttype);
    "result" là một tập hợp kết quả trả về từ các hàm mysqli_query(), mysqli_store_result() hoặc mysqli_use_result()
    resulttype là tùy chọn. Chỉ định loại mảng nào sẽ được trả về. Có thể là một trong những giá trị sau: MYSQLI_ASSOC, MYSQLI_NUM, MYSQLI_BOTH 
5. Hàm mysqli_close(): Thực hiện việc đóng kết nối cơ sở dữ liệu đã kết nối trước đó
Cú pháp: mysqli_close(connection);
    "connection" chỉ định MySQL database sẽ đóng

