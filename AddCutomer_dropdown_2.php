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
        <h1>Add Customer</h1>

        <form action="Index.php" method="POST" class='box-form'>
            <div class="head">
                <h2>Register</h2>
            </div>
            <div class="box">
                <label for="customerID">Enter ID</label>
                <input type="text" placeholder="Cus000" name='CustomerID' id="customerID" />
            </div>

            <div class="box">
                <label for="Name">Enter Name</label>
                <input type="text" placeholder="Wisarut" name='Name' id="Name" />
            </div>

            <div class="box">
                <label for="outstandingDebt">outstandingDebt</label>
                <input type="number" placeholder="outstandingDebt" name='outstandingDebt' id="outstandingDebt" />
            </div>

            <div class="box">
                <label for="email">Enter Email</label>
                <input type="email" placeholder="example@gmail.com" name='email' id="email" />
            </div>
            
            <div class="box">
                <label for="date">Enter Date</label>
                <input type="date" placeholder="mm/dd/yyyy" name='date' id="date" />
            </div>

            

            <div class="box">
                <label for="countryCode">Enter CountryCode</label>
                <select name='countryCode' id="countryCode">
                    <?php while ($cc = $stmt_s->fetch(PDO::FETCH_ASSOC)){?>
                        <option value="<?php echo $cc['CountryCode'] ?>">
                            <?php echo $cc['CountryName'] ?>
                        </option>
                    <?php } ?>
                </select>
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
            $sql = "insert into customer values(:customerID, :Name,:email, :birthdate, :countryCode, :outstandingDebt)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':customerID', $_POST['CustomerID']);
            $stmt->bindParam(':Name', $_POST['Name']);
            $stmt->bindParam(':birthdate', $_POST['date']);
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->bindParam(':countryCode', $_POST['countryCode']);
            $stmt->bindParam(':outstandingDebt', $_POST['outstandingDebt']);
            if ($stmt->execute()) :
                $message = 'Suscessfully add new customer';
            else :
                $message = 'Fail to add new customer';
            endif;
            echo $message;
            
            $conn = null;
        endif;
    }
}catch(PDOException $e) {
    $message = ''.$e->getMessage();
}
?>