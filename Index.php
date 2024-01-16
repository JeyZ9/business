<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>CRUD Customer Information</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12"> <br>
                <h3>รายชื่อลูกค้า <a href="AddCutomer_dropdown_2.php" class="btn btn-info float-end">+เพิ่มข้อมูล</a> </h3>
                <table class="table table-striped  table-hover table-responsive table-bordered">
                    <thead align="center">
                        <tr>
                            <th width="10%">รหัสลูกค้า</th>
                            <th width="20%">ชื่อ-นามสกุล</th>
                            <th width="20%">วันเดือนปีเกิด</th>
                            <th width="25%">อีเมล์</th>
                            <th width="10%">ประเทศ</th>
                            <th width="10%">ยอดหนี้</th>
                            <th width="5%">แก้ไข</th>
                            <th width="5%">ลบ</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        require 'connect.php';
                        $sql =  "SELECT *, country.CountryName from customer INNER JOIN country on customer.CountryCode = country.CountryCode";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach ($result as $r) { ?>
                            <tr>
                                <td><?= $r['CustomerID'] ?></td>
                                <td><?= $r['Name'] ?></td>
                                <td><?= $r['Birthdate'] ?></td>
                                <td><?= $r['Email'] ?></td>
                                <td><?= $r['CountryName'] ?></td>
                                <td><?= $r['OutstandingDebt'] ?></td>
                                <td><a href="UpdateCustomer.php?CustomerID=<?= $r["CustomerID"];?>" class="btn btn-warning btn-sm">แก้ไข</a></td>
                                <td><a href="DeleteDetail.php?CustomerID=<?= $r['CustomerID'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบข้อมูล !!');">ลบ</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>