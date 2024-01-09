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

    $sql = 'select * from customer';
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
        <td><?php echo $result["CountryCode"];?></td>
    </tr>
    <?php } ?>
</table>
    
</body>
</html>