<?php

  require "/includes/dbconn.php";
  require "/includes/funcs.php";
 // require "/includes/protect.php";
  
  
if(isset($_POST['name']))
{
    $name = $_POST['name'];
    $description = $_POST['description'];
    $cost = $_POST['cost'];   
    
    $query = "insert into products(name) values('$name')";
    $con1->query($query);
    $id = $con1->lastInsertId();
    
    $query2 = "insert into product_details(id,name,description,cost) values('$id','$name','$description',$cost)";
    $con1->query($query2);
}
else
{    
        if($_FILES["file"]["error"]>0)
        {

        }
        else
        {
            $img = file_get_contents($_FILES['file']['tmp_name']);
            $img = addslashes($img);

            $query = "update product_details set pic='$img',mime='{$_FILES['file']['type']}' where id={$_POST['id']} ";

            $con1->query($query);

        }

           header("Location:/p1/pro_create.php");
}
?>



<html>
<head>
<link href="style.css" rel="stylesheet" style="text/css>
</head>

    <body>
        <div class = "addproduct">
         <p> upload a new pic</p>
         
      <form action='/p1/pro_create.php' method='POST' enctype='multipart/form-data'>
       
            <p>select your file and upload            
              <input type="file" name="file" id="file"/>
            </p>
            
            <span class="productid">product_id</span>
             <input type="text" name="id"/><br/><br/>
            <input type="submit" value="upload" />
            
        </form>
      <br/>
          <form action='/p1/pro_create.php' method='POST' >
            <p>type in the product details..</p>
            <span class="productExtras">
            product name    
            <input type="text" name="name"/><br/>
            product description
            <textarea name="description" rows="4" cols="40"></textarea>
            <br/>
                            cost<input type="text" name="cost"/><br/>
            <input type="submit" value="upload" />
       
            </span>
      </form>
      </div>
      
    </body>

</html>