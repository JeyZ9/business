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

    $sql = 'DELETE FROM customer where CustomerID = ?';
    $params = array($strCustomerID);
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    // $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo 'delete success!'
?>
</body>
</html>