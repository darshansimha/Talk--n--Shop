<?php

class user
{
	public $nick,$id,$age,$sex,$location,$workplace,$passions,$goals,$accomplish;
	public $food,$movies,$tv,$ph;
	public $pic,$mime;
}

class user_pic
{
	public $id,$nick,$pic,$mime;

}

?>
<?php


    require "includes/protect.php";
    require "includes/dbconn.php";
    require_once "includes/store2.php";
    require "includes/funcs.php";

?>
<?php
        //var_dump($_SESSION['user_obj']);
       
          //  echo "sex is ".$_SESSION['sex'];

            if(isset($_POST['age']) || isset($_POST['sex']) || isset($_POST['location']) || isset($_POST['ph']))
            {

                 //   var_dump(apc_fetch("john"));
                //    echo "<br/><br/><br/>";


                   $age = $_POST['age'];
                   $sex = $_POST['sex'];
                   $location = $_POST['location'];
                   $ph = $_POST['ph'];
                   
                   $sql = "update details set age='$age',sex='$sex',location='$location',ph='$ph' where id='$id' ";
                   echo $sql;
                   $ok = 1;

               //     var_dump(apc_fetch("john"));
               //     echo "<br/><br/><br/>";

                   try
                   {
                            execq($sql);
                            $sql2 = "update search_details set age='$age',sex='$sex',location='$location',ph='$ph' where id='$id' ";
                     //       var_dump(apc_fetch("john"));
                     //       echo "<br/><br/><br/>";
                   }
                   catch(Exception $e)
                   {
                            $ok = 0;
                   }


                   if($ok == 1)
                   {
                   //     var_dump(apc_fetch("john"));
                        execq($sql2);
                        echo "<br/><br/><br/>";


                        echo "inside OK!";
                       
                        
                        $user_obj = apc_fetch($nick);
                     //   var_dump(apc_fetch($rnick));
                     //      echo "<br/><br/><br/>";

                        echo "nick is ".$user_obj->nick;
                    //    var_dump(apc_fetch("john"));
                   //     echo "<br/><br/><br/>";

                        $user_obj->age = $age;
                      //  $user_obj->sex = $sex;
                        $user_obj->location = $location;
                        $user_obj->ph = $ph;
                        apc_store($nick,$user_obj);
                        require "includes/session_apc_store.php";


                   }
                   else
                   {
                       echo "query failed for some reason";
                   }

            }
?>

<html>
<head>
<link href="style.css" rel="stylesheet" style="text/css">
    <title>Edit your profile</title>
</head>
     <h1> My Profile </h1>

     <p> upload a new pic</p>
      <form action='/p1/pics/picupload.php' method='POST' enctype='multipart/form-data'>
            <p>select your file and upload</p>
            <input type="file" name="file" id="file"/>
            <input type="submit" value="upload" />
        </form>

     <form method ="POST" action="profiledit.php">
               <table>

                   <tr>
                       <td>Nick</td>

                       <td><?php echo $nick?></td>
                   </tr>
                    <tr>
                       <td>
                           Your profile pic..
                       </td>
                       <td>
                           <img src=<?php echo "/p1/pics/pic.php?"."id={$_SESSION['id']}"; ?> alt="no image" height="150px" width="150px" />
                       </td>
                   </tr>
                    <tr>
                       <td>Age</td>
                       <td><input type ="text" name="age" value="<?php echo $age ?>" /> </td>
                   </tr>
                    <tr>
                       <td>Sex</td>
                       <td><input type ="text" name="sex" value="<?php echo $sex?>" /> </td>
                   </tr>
                   <tr>
                       <td>Address</td>
                       <td><input type ="text" name="location" value="<?php echo $location ?>" /> </td>
                   </tr>
                   <tr>
                       <td>Phone Number</td>
                       <td><input type ="text" name="ph" value="<?php echo $ph?>" /></td>
                   </tr>
                   <tr>

                       
                   </tr>
               </table>
         <input type ="submit" value="save changes" />
     </form>
    <?php //var_dump(apc_fetch('john')); ?>
</html>