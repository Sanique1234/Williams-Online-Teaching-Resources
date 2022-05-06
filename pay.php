<?php
    session_start();


    if(isset($_POST['pay'])){
        if(!empty($_SESSION['online_class']))
        {
            echo '<script>Thanks for choosing Williams Online Teaching Resources</script>';
            //echo '<script>alert("Course Already Added")</script>';  
            echo '<script>window.location="pay.php"</script>';
        }else{
            echo '<script>alert("No Course Chosen!")</script>'; 
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Payment</title>
</head>
<body>
<h3>Subscription Details</h3>
    <div class="table-responsive">  
                                <table class="table table-bordered" id="list">  
                                    <tr>  
                                        <th width="30%">Course</th>  
                                        <th width="10%">Hours</th>
                                        <th width="25%">Instructor</th>  
                                        <th width="15%">Fee</th>    
                                        <th width="10%">Action</th>  
                                    </tr>  
                                    <?php
                                    if(isset($_POST['subscribe'])) 
                                    {  
                                        if(isset($_SESSION['online_class']))  
                                        {  
                                            $subscription = array(  
                                                array('id' => $_POST['id'],  
                                                'course' => $_POST["course"],    
                                                'hrs' => $_POST["hrs"],
                                                'instructor' => $_POST["instructor"],
                                                'fee' => $_POST["fee"]) 
                                           );

                                         $select = "SELECT * FROM courses WHERE ID = ?";
        
                                         $temp = $conn->prepare($select);
                                         $temp->bind_param("i", $_POST['id']);
                                         $temp->execute();

                                         $result = $temp->get_result();
                                            if($result-> num_rows > 0){
                                                while($row = $result-> fetch_assoc())
                                                {
                                                    foreach($subscription as $keys => $values){
                                    ?>  
                                    <tr id="values">  
                                        <td><?php echo $row['Course']; ?></td>  
                                        <td><?php echo $row['Hours']; ?></td>
                                        <td><?php echo $row['Instructor']; ?></td>  
                                        <td>$ <?php echo $row['Fee']; ?></td> 
                                        <td><button type="button" class="btn btn-danger btnDelete">Remove</button></td>
                                    </tr>  
                                    <?php  
                                                $total = $total + ($row['Fee']); 
                                            } 
                                        }  
                                        $temp->close();
                                        $conn->close();
                                    ?>  
                                    <tr>  
                                        <td colspan="3" align="right">Total</td>  
                                        <td align="right">$ <?php echo number_format($total, 2); ?></td>  
                                        <td></td>  
                                    </tr>  
                                    <?php   
                                                }
                                            }
                                        }
                                        else{
                                            echo 'No results found';
                                        } 
                                    ?>  
                                </table>
                            </div>

        <form action="pay.php" method="POST">
        <button type="button" class="btn btn-success" style="margin-left: 1150px; text-align: right;" name="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Pay
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Your total is: <?php echo $_SESSION['total'];?> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" name="cancel" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" name="pay">Confirm Payment</button>
            </div>
            </div>
        </div>
        </div>
        </form>

    <script>
        $(document).ready(
            function(){
            $("#list").on('click','.btnDelete', function(){
                var table = document.getElementById("values");
                $(this).closest('tr').remove();
                <?php unset($_SESSION["online_class"][$keys]); ?>
                //row = table.rows[i] = null;
                //</?php $_SESSION["online_class"]= null; ?>
                alert("Course Removed!");  
                window.location="index.php";
                });
            
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    

</body>
</html>