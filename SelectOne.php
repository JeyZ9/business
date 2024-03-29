<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
    try{
        require 'connect.php';
    }
    catch(Exception $e){
        throw new Exception($e->getMessage());
    }

    $sql = 'SELECT *, country.CountryName from customer INNER JOIN country on customer.CountryCode = country.CountryCode';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
?>



<table>
    <tr>
        <th>รหัสลูกค้า</th>
        <th>ชื่อ</th>
        <th>วันเกิด</th>
        <th>อีเมล</th>
        <th>ประเทศ</th>
        <th>ยอดหนี้</th>
    </tr>

    <?php
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    ?>
    <tr>
        <td>
            <a href="Detail.php?CustomerID=<?php echo $result["CustomerID"];?>">
                <?php echo $result["CustomerID"];?>
            </a> 
        </td>
        <td><?php echo $result["Name"];?></td>
        <td><?php echo $result["Birthdate"];?></td>
        <td><?php echo $result["Email"];?></td>
        <td><?php echo $result["CountryName"];?></td>
        <td><?php echo $result["OutstandingDebt"];?></td>
        <td>
            <a href="UpdateCustomer.php?CustomerID=<?php echo $result["CustomerID"];?>">Edit</a>
        </td>
    </tr>
    <?php } ?>
</table>
    
</body>
</html>