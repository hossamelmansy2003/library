<?php
include("data_class.php");
if(empty($_SESSION['adminid'])){
    // header("Location:index.php?msg=login First");
}

$msg="";
if(!empty($_REQUEST['msg'])){
    $msg=$_REQUEST['msg'];
}

if($msg=="done"){
    echo "<div class='alert alert-success' role='alert'>Sucssefully Done</div>";
}
elseif($msg=="fail"){
    echo "<div class='alert alert-danger' role='alert'>Fail</div>";
}
?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- link bootstrap css -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
     <!--link css  -->
    <link rel="stylesheet" type="text/css" href="styles.css">

 <!-- link font-aweson  icon bootstrap -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- link java bootstrap -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        function openpart(portion) {
            var i;
            var x = document.getElementsByClassName("portion");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            console.log(portion + document.getElementById(portion));
            document.getElementById(portion).style.display = "block";
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="inner">
        <h3 class="head fs-5 fw-bolder text-center pt-5"> LIBRARY <i class="fa-solid fa-book-open-reader"></i> MANAGEMENT SYSTEM  </h3>
            <!-- Buttons -->
            <div class="leftinner">
                <br>
                <Button class="greenbtn" onclick="openpart('addbook')"><img class="icons" src="images/icon/book.png"
                        width="30px" height="30px" /> ADD BOOK</Button>
                <Button class="greenbtn" onclick="openpart('bookreport')"> <img class="icons"
                        src="images/icon/open-book.png" width="30px" height="30px" /> BOOK REPORT</Button>
                <Button class="greenbtn" onclick="openpart('bookrequestapprove')"><img class="icons"
                        src="images/icon/interview.png" width="30px" height="30px" /> BOOK REQUESTS</Button>
                <Button class="greenbtn" onclick="openpart('addstudent')"> <img class="icons"
                        src="images/icon/add-user.png" width="30px" height="30px" /> ADD STUDENT</Button>
                <Button class="greenbtn" onclick="openpart('studentrecord')"> <img class="icons"
                        src="images/icon/monitoring.png" width="30px" height="30px" /> STUDENT REPORT</Button>
                <Button class="greenbtn" onclick="openpart('issuebook')"> <img class="icons" src="images/icon/test.png"
                        width="30px" height="30px" /> ISSUE BOOK</Button>
                <Button class="greenbtn" onclick="openpart('issuebookreport')"> <img class="icons"
                        src="images/icon/checklist.png" width="30px" height="30px" /> ISSUE REPORT</Button>
                <a href="index.php"><Button class="greenbtn"><img class="icons" src="images/icon/book.png" width="30px"
                            height="30px" /> LOGOUT</Button></a>
            </div>
            <!-- Add book -->
            <div class="rightinner">
                <div id="addbook" class="innerright portion"
                    style="<?php  if(!empty($_REQUEST['viewid'])){ echo "display:block";} else {echo "display:none"; }?>">
                    <h3 class="greenhead">ADD NEW BOOK</h3>
                    <br>
                    <form action="addbook.php" method="post" enctype="multipart/form-data">
                        <label class="la">Book Name:</label>
                        </br>
                        <input class="ph" type="text" name="bookname" form-control />
                        </br>
                        <label class="la">Author:</label>
                        <br>
                        <input class="ph" type="text" name="bookauthor" form-control />
                        </br>
                        <label class="la">Publication:</label>
                        </br>
                        <input class="ph" type="text" name="bookpub" form-control />
                        <br>
                        <label class="la">Price:</label>
                        </br>
                        <input class="ph" type="number" name="bookprice" form-control />
                        </br>
                        <label class="la">Quantity:</label>
                        </br>
                        <input class="ph" type="number" name="bookquantity" form-control />
                        </br>
                        <div>
                            <label>Branch:</label><br>
                            <input type="radio" name="branch" value="other" /> Other <br>
                            <input type="radio" name="branch" value="BSIT" />BSIT <br>
                            <input type="radio" name="branch" value="BSCS" />BSCS <br>
                            <input type="radio" name="branch" value="BSSE" />BSSE <br>
                        </div>
                        </br>
                        <label class="la">Detail:</label>
                        </br>
                        <textarea class="ph" rows="4" cols="50" name="bookdetail" form-control /></textarea>
                        </br>
                        <label class="la">Book Photo:</label>
                        </br>
                        <input type="file" name="bookphoto" /></br>
                        </br>
                        <input type="submit" value="SUBMIT" />
                        </br>
                        </br>
                    </form>
                </div>
            </div>

            <!-- show list book report portion -->
            <div class="rightinner">
                <div id="bookreport" class="innerright portion" style="display:none">
                <h3 class="greenhead">Book Record</h3>
                <br>
                    <?php
                        $u=new data;
                        $u->setconnection();
                        $recordset=$u->getbook();
                        
                        $table="<table style='font-family: Arial,Helvtica, sans-serif; border-collapse; collapse:collapse; width: 100%;'><tr style='border:1px;
                        padding: 8px;'><th>#</th><th>Name</th><th>Author</th><th>Price</th><th>Publication</th><th>quantity</th><th>branch</th><th>View</th></tr>";
                        
                        foreach($recordset as $row){
                            $table.="<tr>";
                            $table.="<td>$row[0]</td>";
                            $table.="<td>$row[1]</td>";
                            $table.="<td>$row[2]</td>";
                            $table.="<td>$row[5]</td>";
                            $table.="<td>$row[6]</td>";
                            $table.="<td>$row[7]</td>";
                            $table.="<td>$row[10]</td>";
                            $table.="<td><a href='admin_service_dashboard.php?viewid=$row[0]'><button type='button' class='btn btn-primary'>View Book</button></a></td>";
                            $table.="</tr>";
                            $table.="</table/>";
                            echo $table;

                         }

                        ?>
                </div>
            </div>

            <!--Add Student-->
            <div class="rightinner">
                <div id="addstudent" class="innerright portion" style="display:none">
                <h3 class="greenhead">ADD Student</h3>
                <form action="add_person.php" method="post" enctype="multipart/form-data">
                        <label class="la">Name:</label>
                        <input class="ph" type="text" name="addname" />
                        </br>
                        <label class="la">Password:</label>
                        <input class="ph" type="password" name="addpass" />
                        </br>
                        <label class="la">Email:</label>
                        <input class="ph" type="email" name="addemail" />
                        </br>
                        <label for="type">Choose type:</label>
                        <select name="type">
                            <option value="student">student</option>
                            <option value="teacher">teacher</option>
                        </select>
                        <input type="submit" class="btn btn-info" value="submit">
                    </form>
                </div>
            </div>

            <!-- student report -->
            <div class="rightinner">
                <div id="studentrecord" class="innerright portion" style="display:none">
                <h3 class="greenhead">STUDENT RECORD</h3>
                <?php
                    $u=new data;
                    $u->setconnection();
                    $u->userdata();
                    $recordset=$u->userdata();
                
                    $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse; width: 100%;'><tr><th style=' 
                    padding: 8px;'> Name</th><th>Email</th><th>Type</th></tr>";
                    foreach($recordset as $row){
                        $table.="<tr>";
                       "<td>$row[0]</td>";
                        $table.="<td>$row[1]</td>";
                        $table.="<td>$row[2]</td>";
                        $table.="<td>$row[4]</td>";
                        $table.="<td><a href='delete.php?useriddelete=$row[0]'> <button type='button' class='btn btn-danger'>Delete</button></a></td>";
                        $table.="</tr>";
                        // $table.=$row[0];
                    }
                    $table.="</table>";
                
                    echo $table;
                    ?>
                </div>
            </div>

            <!-- issue book  -->
            <div class="rightinner">
                <div id="issuebook" class="innerright portion" style="display:none">
                <h3 class="greenhead">ISSUE BOOK</h3>
                <form action="issuebook.php" method="post" enctype="multipart/form-data">
                        <label for="book">Choose Book:</label>

                        <select name="book">
                            <?php
                            $u=new data;
                            $u->setconnection();
                            $u->getbookissue();
                            $recordset=$u->getbookissue();
                            foreach($recordset as $row){
                                echo "<option value='". $row[2] ."'>" .$row[2] ."</option>";
                            }            
                            ?>
                        </select>
                        <br>
                        <label for="Select Student">Select Student:</label>
                        <select name="userselect">
                            <?php
                                $u=new data;
                                $u->setconnection();
                                $u->userdata();
                                $recordset=$u->userdata();
                                foreach($recordset as $row){
                                   $id= $row[0];
                                    echo "<option value='". $row[1] ."'>" .$row[1] ."</option>";
                                }            
                            ?>
                        </select>
                        <br>
                        <label>Days</label> <input type="number" name="days" />
                        <input type="submit" value="SUBMIT" />
                    </form>
                </div>
            </div>

            <!-- student report -->
            <div class="rightinner">
                <div id="issuebookreport" class="innerright portion" style="display:none">
                    <h3 class="greenhead">Issue Book Record</h3>
                    <?php
                        $u=new data;
                        $u->setconnection();
                        $u->issuereport();
                        $recordset=$u->issuereport();

                        $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  
                        padding: 8px;'>Issue Name</th><th>Book Name</th><th>Issue Date</th><th>Return Date</th><th>Fine</th></th><th>Issue Type</th></tr>";

                        foreach($recordset as $row){
                            $table.="<tr>";
                           "<td>$row[0]</td>";
                            $table.="<td>$row[2]</td>";
                            $table.="<td>$row[3]</td>";
                            $table.="<td>$row[6]</td>";
                            $table.="<td>$row[7]</td>";
                            $table.="<td>$row[8]</td>";
                            $table.="<td>$row[4]</td>";
                            // $table.="<td><a href='otheruser_dashboard.php?returnid=$row[0]&userlogid=$userloginid'>Return</a></td>";
                            $table.="</tr>";
                            // $table.=$row[0];
                        }
                        $table.="</table>";
                    
                        echo $table;
                    ?>

                </div>
            </div>

            <!-- Book Request By Student/ Teacher -->
            <div class="rightinner">
                <div id="bookrequestapprove" class="innerright portion" style="display:none">
                    <h3 class="greenhead">BOOK REQUEST APPROVE</h3>
                    <?php
                        $u=new data;
                        $u->setconnection();
                        $u->requestbookdata();
                        $recordset=$u->requestbookdata();

                        $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='
                        padding: 8px;'>Person Name</th><th>person type</th><th>Book name</th><th>Days </th><th>Approve</th></tr>";
                        foreach($recordset as $row){
                            $table.="<tr>";
                           "<td>$row[0]</td>";
                          "<td>$row[1]</td>";
                          "<td>$row[2]</td>";
                        
                            $table.="<td>$row[3]</td>";
                            $table.="<td>$row[4]</td>";
                            $table.="<td>$row[5]</td>";
                            $table.="<td>$row[6]</td>";
                           // $table.="<td><a href='approvebookrequest.php?reqid=$row[0]&book=$row[5]&userselect=$row[3]&days=$row[6]'><button type='button' class='btn btn-primary'>Approved BOOK</button></a></td>";
                             $table.="<td><a href='approvebookrequest.php?reqid=$row[0]&book=$row[5]&userselect=$row[3]&days=$row[6]'><button type='button' class='btn btn-primary'>Aproved Book<button></td>";
                            // $table.="<td><a href='deletebook_dashboard.php?deletebookid=$row[0]'>Delete</a></td>";
                            $table.="</tr>";
                            // $table.=$row[0];
                        }
                        $table.="</table>";
                    
                        echo $table;
                    ?>
                </div>
            </div>

            <!-- issue book report -->
            <div class="rightinner">
                <div id="issuebookreport" class="innerright portion" style="display:none">
                    <h3 class="greenhead">Issue Book Record</h3>
                    <?php
                        $u=new data;
                        $u->setconnection();
                        $u->issuereport();
                        $recordset=$u->issuereport();

                        $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  
                        padding: 8px;'>Issue Name</th><th>Book Name</th><th>Issue Date</th><th>Return Date</th><th>Fine</th></th><th>Issue Type</th></tr>";

                        foreach($recordset as $row){
                            $table.="<tr>";
                           "<td>$row[0]</td>";
                            $table.="<td>$row[2]</td>";
                            $table.="<td>$row[3]</td>";
                            $table.="<td>$row[6]</td>";
                            $table.="<td>$row[7]</td>";
                            $table.="<td>$row[8]</td>";
                            $table.="<td>$row[4]</td>";
                            $table.="<td><a href='otheruser_dashboard.php?returnid=$row[0]&userlogid=$userloginid'>Return</a></td>";
                            $table.="</tr>";
                            // $table.=$row[0];
                        }
                        $table.="</table>";
                    
                        echo $table;
                    ?>
                </div>
            </div>

            <!-- book detail -->
            <div class="rightinner">
                <div id="bookdetail" class="innerright portion"
                    style="<?php  if(!empty($_REQUEST['viewid'])){ $viewid=$_REQUEST['viewid']; echo "display:block";} else {echo "display:none"; }?>">
                    <h3 class="greenhead">Book Detail</h3>
                    <br>
                    <?php
                        $u=new data;
                        $u->setconnection();
                        $u->getbookdetail($viewid);
                        $recordset=$u->getbookdetail($viewid);
                        foreach($recordset as $row){
                            $bookid= $row[0];
                            $bookimg= $row[1];
                            $bookname= $row[2];
                            $bookdetail= $row[3];
                            $bookauthour= $row[4];
                            $bookpub= $row[5];
                            $branch= $row[6];
                            $bookprice= $row[7];
                            $bookquantity= $row[8];
                            $bookava= $row[9];
                            $bookrent= $row[10];
                        }
                    ?>

                    <img width='150px' height='150px' style='border:1px solid #333333; float:left;margin-left:20px'
                        src="uploads/<?php echo $bookimg?>" />
                    </br>
                    <p style="color:black"><u>Book Name:</u> &nbsp&nbsp<?php echo $bookname ?></p>
                    <p style="color:black"><u>Book Detail:</u> &nbsp&nbsp<?php echo $bookdetail ?></p>
                    <p style="color:black"><u>Book Authour:</u> &nbsp&nbsp<?php echo $bookauthour ?></p>
                    <p style="color:black"><u>Book Publisher:</u> &nbsp&nbsp<?php echo $bookpub ?></p>
                    <p style="color:black"><u>Book Branch:</u> &nbsp&nbsp<?php echo $branch ?></p>
                    <p style="color:black"><u>Book Price:</u> &nbsp&nbsp<?php echo $bookprice ?></p>
                    <p style="color:black"><u>Book Available:</u> &nbsp&nbsp<?php echo $bookava ?></p>
                    <p style="color:black"><u>Book Rent:</u> &nbsp&nbsp<?php echo $bookrent ?></p>

                </div>
            </div>

        </div>
    </div>
</body>

</html>