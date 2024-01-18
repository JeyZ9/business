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

<?php
    require 'connect.php';

    $spl_select = "select * from country ORDER BY CountryCode";
    $stmt_s = $conn->prepare($spl_select);
    $stmt_s->execute();

    if(isset($_POST['submit'])){
    
        // if(isset($_POST["CustomerID"]) && $_POST["Name"]):
            
            if(!empty($_POST['CustomerID']) && !empty($_POST['Name'])){
            $uploadFile = $_FILES['Image']['name'];
            $tmpFile = $_FILES['Image']['tmp_name'];
            echo " upload file = " . $uploadFile;
            echo " tmp file = " . $tmpFile;
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $sql = "insert into customer values(:CustomerID, :Name, :Birthdate, :Email, :CountryCode, :OutstandingDebt, :Image)";
            $sql = "INSERT INTO customer VALUES (:CustomerID, :Name, :Birthdate, :Email, :CountryCode, :OutstandingDebt, :Image)";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':CustomerID', $_POST['CustomerID']);
            $stmt->bindParam(':Name', $_POST['Name']);
            $stmt->bindParam(':Birthdate', $_POST['Birthdate']);
            $stmt->bindParam(':Email', $_POST['Email']);
            $stmt->bindParam(':CountryCode', $_POST['CountryCode']);
            $stmt->bindParam(':OutstandingDebt', $_POST['OutstandingDebt']);
            $stmt->bindParam(':Image', $uploadFile);

            $fullpath = './Image/' . $uploadFile;
            echo " fullpath = " . $fullpath;
            move_uploaded_file($tmpFile, $fullpath);
            echo '
                <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

            try{

                if($stmt->execute()){
                    echo '
                    <script type="text/javascript">        
                    $(document).ready(function(){
                
                        swal({
                            title: "Success!",
                            text: "Successfuly add customer",
                            type: "success",
                            timer: 2500,
                            showConfirmButton: false
                        }, function(){
                                window.location.href = "index.php";
                        });
                    });                    
                    </script>
                ';
                }else{
                    $message = 'Fail to add new customer';
                }
                
            }catch(PDOException $e){
                echo ("fail". $e);
            }
                $conn = null;
        }
    }
?>

    <div class="container">
        <h1>Add Customer</h1>

        <form action="AddCutomer_dropdown_2.php" method="POST" class='box-form' enctype="multipart/form-data">
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
                <label for="Birthdate">Enter Date</label>
                <input type="date" placeholder="mm/dd/yyyy" name='Birthdate' id="date" />
            </div>

            <div class="box">
                <label for="Email">Enter Email</label>
                <input type="email" placeholder="example@gmail.com" name='Email' id="email" />
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
                <input type="number" placeholder="outstandingDebt" name='OutstandingDebt' id="outstandingDebt" />
            </div>

            <div class="box">
                <label for="image">Image</label>
                <input type="file" placeholder="image" name='Image' id="image" required />
            </div>


            <div class="box-btn">
                <button type="submit" name="submit">Sumit</button>
            </div>
        </form>
    </div>
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#customerTable').DataTable();
        });
    </script>
</body>
</html>