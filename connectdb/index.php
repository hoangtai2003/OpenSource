<?php
session_start();
include("./connect.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
</head>
<body>
    
    <div class="container">
        <div class="row">
            <h3 class="text-center">Select Box</h3>
        </div>
        <div class="row">
            <div class="col-md-12" style="display: flex;">
                <div class="col-md-4" style="margin-right: 20px;">
                    <select class="form-control" id="selectTinh">
                        <option value="">Thành phố</option>
                        <?php
                            $sql = "select * from tinhthanh";
                            $result = mysqli_query($conn, $sql);
                            foreach($result as $row){
                                ?>
                                    <option value="<?= $row['idTT']?>"><?=$row['nameTT'] ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-control quan" id="selectQuan">
                        <option value="">Quận huyện</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $("#selectTinh").change(function(){
                var id = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: 'data.php',    
                    data: {id: id},
                    success: function(data){
                        $("#selectQuan").html(data);
                    }
                })
            });
        });
    </script>
</body>
</html>