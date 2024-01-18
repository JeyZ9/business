<?php
    if(isset($_GET["CustomerID"])){
        require 'connect.php';
        $spl_select = "SELECT * from customer WHERE CustomerID = :CustomerID";
        $stmt_s = $conn->prepare($spl_select);
        $stmt_s->bindParam(':CustomerID', $_GET['CustomerID']);
        $stmt_s->execute();
        $r = $stmt_s->fetch(PDO::FETCH_ASSOC);
    }

?>

<?php
        require 'connect.php';
        $spl_select = "select * from country ORDER BY CountryCode";
        $stmt_s = $conn->prepare($spl_select);
        $stmt_s->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container{
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .box-form{
            display: flex;
            flex-direction: column;
            border: 1px solid;
            border-radius: 5px;
            padding: 20px 10px;
            height: 50vh;
            justify-content: space-between;
        }
        .box{
            display: flex;
            flex-direction: column;
        }

        button{
            width: 100%;
            background-color: black;
            color: #ffff;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit</h1>
        
        <form action="UpdateCustomer.php?CustomerID=<?= $r["CustomerID"];?>" method="POST" class='box-form'>

            <input type="hidden" name="CustomerID" value="<?= $_GET['CustomerID'] ?>" />

            <div class="box">
                <label for="Name">Enter Name</label>
                <input type="text" placeholder="Wisarut" value="<?= $r['Name']?>" name='Name' id="Name" />
            </div>

            <div class="box">
                <label for="date">Enter Date</label>
                <!-- <input type="date" placeholder="mm/dd/yyyy" name='Birthdate' id="date" /> -->
                <input type="date" value="<?= $r['Birthdate'] ?>" name='Birthdate' id="date" />

            </div>
            
            <div class="box">
                <label for="email">Enter Email</label>
                <input type="email" placeholder="example@gmail.com" value="<?= $r['Email'] ?>" name='Email' id="email" />
            </div>
            <div class="box">
                <label for="countryCode">Enter CountryCode</label>
                <select name='CountryCode' id="countryCode">
                    <?php while ($cc = $stmt_s->fetch(PDO::FETCH_ASSOC)){?>
                        <option value="<?php echo $cc['CountryCode'] ?>">
                            <?php echo $cc['CountryName'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            
            <div class="box">
                <label for="outstandingDebt">outstandingDebt</label>
                <input type="number" placeholder="outstandingDebt" value="<?= $r['OutstandingDebt'] ?>" name='OutstandingDebt' id="outstandingDebt" />
            </div>


            <div class="box-btn">
                <button type="submit" name="submit">Sumit</button>
            </div>
        </form>
    </div>
</body>
</html>

<?php
try{
    if(isset($_POST['submit'])){
    
        // if(isset($_POST["CustomerID"]) && $_POST["Name"]):
        if(!empty($_POST['CustomerID']) && !empty($_POST['Name'])):
            require 'connect.php';
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $sql = "UPDATE customer SET CustomerID = :CustomerID, Name = :Name, Birthdate = :Birthdate, Email = :Email CountryCode = :CountryCode, OutstandingDebt = :OutstandingDebt WHERE CustomerID = :CustomerID";
            $sql = "UPDATE customer SET CustomerID = :CustomerID, Name = :Name, Birthdate = :Birthdate, Email = :Email, CountryCode = :CountryCode, OutstandingDebt = :OutstandingDebt WHERE CustomerID = :CustomerID";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':CustomerID', $_POST['CustomerID']);
            $stmt->bindParam(':Name', $_POST['Name']);
            $stmt->bindParam(':Birthdate', $_POST['Birthdate']);
            $stmt->bindParam(':Email', $_POST['Email']);
            $stmt->bindParam(':CountryCode', $_POST['CountryCode']);
            $stmt->bindParam(':OutstandingDebt', $_POST['OutstandingDebt']);
            if ($stmt->execute()){
                $message = 'Suscessfully add new customer';
            }else{
                $message = 'Fail to add new customer';
            }
            echo $message;
            
            $conn = null;
        endif;
    }
}catch(PDOException $e) {
    $message = ''.$e->getMessage();
}
?>