<?php
    session_start();
    //session_destroy();
    //$_SESSION['online_class'];
    $conn = mysqli_connect("localhost", "root", "", "onlineclass") or die("Cannot connect to Database ". $conn->connect_error);;

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
 <a href="pay.php">Payment</a>

    <div class="container" style="width:700px;">
    <h3 align="center">Online Courses</h3><br>
    <div class="row gx-4">
    <?php  
        $query = "SELECT * FROM courses ORDER BY ID ASC";  
        $result = mysqli_query($conn, $query);  
        if(mysqli_num_rows($result) > 0)  
        {  
                while($row = mysqli_fetch_array($result))  
                {  
        ?>  
    <div class="col-md-4">   

    <div class="card" style="width: 20rem;">
        <!--img src="img/Jag.jpg" class="card-img-top" alt="..."-->
                <div class="card-body">
                    <form method="POST" action="index.php" id="pay">
                        <!--div class="mb-3"-->
                            <img src="index.php" class="img-responsive"> <br>
                            <label for="">Course: </label>
                            <h4 class="text-secondary"><?php echo 'Course: '.$row['Course']; ?></h4>  
                            <h4><?php echo 'Hours: '.$row["Hours"]; ?></h4>
                            <h4><?php echo 'Instructor: '.$row["Instructor"]; ?></h4>
                            <h4>Fee: $<?php echo $row["Fee"]; ?></h4>
                            <input type="hidden" name="id" value="<?php echo $row["ID"]; ?>" />
                            <input type="hidden" name="course" value="<?php echo $row["Course"]; ?>" />  
                            <input type="hidden" name="hrs" value="<?php echo $row["Hours"]; ?>" />
                            <input type="hidden" name="instructor" value="<?php echo $row["Instructor"]; ?>" />  
                            <input type="hidden" name="fee" value="<?php echo $row["Fee"]; ?>" />
                            <input type="submit" class="btn btn-secondary" name="subscribe" value="Subscribe"/>
                     <!--button type="submit" name="subscribe"  data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-secondary">
                        Subscribe
                        </button>
                    </form>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Subscription Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                    </div>
                                               
                            </div>
                            </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" name="cancel" data-bs-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                        </div-->
                    </form>
                </div>
            </div> <br>
        </div>
    </div>
    <?php  
         }  
    }  


    ?> 

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
                                        //$count = count($_SESSION['online_class']);
                                        if(isset($_SESSION['online_class']))  
                                        {  
                                            /*$_SESSION['online_class'][$count] = array(  
                                                array('id' => $_POST['id'],  
                                                'course' => $_POST["course"],    
                                                'hrs' => $_POST["hrs"],
                                                'instructor' => $_POST["instructor"],
                                                'fee' => $_POST["fee"]) 
                                           );*/

                                           //PREPARED STATEMENT
                                         $select = "SELECT * FROM courses WHERE ID = ?";
        
                                         $temp = $conn->prepare($select);
                                         $temp->bind_param("i", $_POST['id']);
                                         $temp->execute();

                                         $result = $temp->get_result();
                                            if($result-> num_rows > 0){
                                                while($row = $result-> fetch_assoc())
                                                {
                                                    //foreach($subscription as $keys => $values){
                                    ?>  
                                    <tr id="values">  
                                        <td><?php echo $row['Course']; ?></td>  
                                        <td><?php echo $row['Hours']; ?></td>
                                        <td><?php echo $row['Instructor']; ?></td>  
                                        <td>$ <?php echo $row['Fee']; ?></td> 
                                        <td><button type="button" class="btn btn-danger btnDelete">Remove</button></td>
                                    </tr>  
                                    <?php  
                                                $_SESSION['total'] = $_SESSION['total'] + ($row['Fee']); 
                                            //} 
                                        }  
                                        $temp->close();
                                        $conn->close();
                                    ?>  
                                    <tr>  
                                        <td colspan="3" align="right">Total</td>  
                                        <td align="right">$ <?php echo number_format($_SESSION['total'], 2); ?></td>  
                                        <td></td>  
                                    </tr>  
                                    <?php   
                                                }
                                            }
                                        else{
                                            echo 'No results found';
                                        } 
                                    }
                                    ?>  
                                </table>
                            </div>

                        </div>            

    <script>
        function form_submit() {
            document.getElementById("pay").submit();
        }    


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