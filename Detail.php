<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    if(isset($_GET["CustomerID"]))
    {
        $strCustomerID = $_GET["CustomerID"];
        echo $strCustomerID;
    }
    try{
        require 'connect.php';
    } 
    catch(Exception $e){
        throw new Exception($e->getMessage());
    }

    $sql = 'select * from customer where CustomerID = ?';
    $params = array($strCustomerID);
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<table>
    <tr>
        <td>
            รหัสลูกค้า
        </td>
        <th>
            <?php echo $result['CustomerID'] ?>
        </th>
    </tr>
    <tr>
        <td>
            ชื่อลูกค้า
        </td>
        <th>
            <?php echo $result['Name'] ?>
        </th>
    </tr>
    <tr>
        <td>
            วันเกิด
        </td>
        <th>
            <?php echo $result['Birthdate'] ?>
        </th>
    </tr>
    <tr>
        <td>
            อีเมล
        </td>
        <th>
            <?php echo $result['Email'] ?>
        </th>
    </tr>
    <tr>
        <td>
            รหัสประเทศ
        </td>
        <th>
            <?php echo $result['CountryCode'] ?>
        </th>
    </tr>
</table>






</body>
</html>