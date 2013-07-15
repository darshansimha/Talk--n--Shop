


<?php

require "includes/protect.php";
require "includes/dbconn.php";
require "includes/funcs.php";
 require "includes/store.php";
// http://www.w3schools.com/jquery/jquery.js
?>
<?php
            if(isset($_GET['id']))
            {
                $fid = $_GET['id'];
                $fid = htmlspecialchars(addslashes($fid));



                $query = "select *  from details where id=$fid";
                $result_all = execq($query);
            }




?>
 <script type="text/javascript" src="http://localhost/p1/jquery.js"></script>
 <script type="text/javascript" >
function ramble()
 {

    <?php echo "var to_nick ="."'{$result_all['nick']}';";
          echo "var to_name ="."'{$result_all['name']}';";
    ?>


   $(document).ready(function(){

       var ramble_content = $("#txtarea").val();
       var location_content =$("#location").val();
       $.ajax({
           url:"/p1/rambles.php",
           type:"GET",
           data:({ramble:ramble_content,location:location_content,to_nick:to_nick,to_name:to_name}),
           dataType:"json",
           success:function(result){
             //  alert("your ramble has been posted");
             //  alert("time is "+result.time);

             var str = "  <div class='post' id="+result.id+">";
                 str+= "  <p id='post_user_nick'>"+"<?php echo $_SESSION['nick']; ?>"+"</p>";
                 str+="<p id ='post_user_pic'><img src='/p1/pics/pic.php?nick="+"<?php echo $_SESSION['nick']; ?>&id=<?php echo $_SESSION['id'] ?>"+" height='50px' width='50px'/></p>>";
                 str+="<span id='post_content'>"+result.content+"</span><br/>";
                 str+="<span id='post_time'>at "+result.time+"</span><br/>";
                 if(result.time)
                     {
                         str+="<span id='post_location'>writing from '"+result.location+"'</span><br/>";
                     }
                 str+="</div>";
                $("#post_area").prepend(str);
              //  alert("you're ramble has been posted nick:"+result.nick+" content:"+result.content+"time:"+result.time+"location:"+result.location);


           }

       })
   })

 }

</script>







<html>

      
<head>
<link rel="stylesheet" href="style.css" style="text/css"/>
             <div class = bubble>
            
 
               <title><?php echo $nick ?>'s bubble</title>
</div>
</head>
            <body>
            <div class = "registerMobile">
            <p>register  or <span class="top">update</span> your phone number</p>
            </div> 
            <form action = '/p1/profile.php' method='POST'>
              <div id="logoutButton"><br/>
                   
              <a href="/p1/logout.php" class ="top" id="logout">Logout</a>
              </div>
            </form>
         

            <h1> My Profile </h1>
            <div class = "MobileNumber"> Phone-Number:
              
              <input type='text' name = 'ph'>
              <input type='submit' name = 'update'>
              <br/>
            </div>
<div id="mypic">
    <img src=<?php echo "/p1/pics/pic.php?"."id={$fid}" ?> alt="no image" height="150px" width="150px" />
  </div>
               <a href="/p1/profiledit.php">Edit your profile</a> <br/><br/>
               <table>
               <?php echo "<tr><td>Nick :</td><td>{$result_all['nick']}</td>";?>
                  <?php
                  $flag = 0;
                  foreach($result_all as $a=>$b)
                  {

                      if($b!= NULL && !is_int($a) && strcmp($a,'id'))
                      {

                              echo" <tr>";
                                        switch($a)
                                        {
                                           case "ph": echo "<td>phone number: </td>";break;
                                           case "age":echo "<td>Age: </td>";
                                                        if($b == 0)
                                                        {
                                                            $flag = 1;
                                                            echo "<td> Not Updated</td>";
                                                        }
                                                        break;

                                           case "sex":echo "<td>Sex: </td>";break;
                                           case "location":echo "<td>Location: </td>";break;
                                           default:$flag = 1;

                                        }

                                        if($flag == 0)
                                        {
                                             echo"   <td>$b</td>
                                            </tr>
                                           ";
                                        }
                                        $flag = 0;
                      }
                  }
                 ?>


               </table>

   
               <!--start of friends-->
               <p>Your friends</p>
      <?php

               $query = "select * from friends where id=$fid limit 5";
               $query_obj = $con1->query($query);

               while($res = $query_obj->fetch())
               {
              //  echo "pal id is {$res['palid']} <br/>";
                $query2 = "select nick,location from details where id={$res['palid']} ";
                $rs = execq($query2);

                echo "<p id='friends'><b>{$rs['nick']}</b> ";
                if(strlen($rs['location']) != 0)
                {
                    echo "from <i>{$rs['location']}</i> </p>";
                }

               }
      ?>




       
               <!-- start of rambles -->
               <h1> Your Rambles </h1>
               <table>
                   <tr>
                       <td>
                          Say something
                       </td>
                       <td>
                           <textarea id="txtarea" rows="2" cols="30" >

                           </textarea>
                       </td>
                   </tr>
                   <tr>
                       <td>
                          Where are you now?
                       </td>
                       <td>
                          <input type ="text" id="location" size="30" /><br/>
                       </td>
                   </tr>
               </table>

               <input type="button" value="tell now" onClick="ramble()"  />
               <div id="post_area">
                   <?php
                   $query = "select * from rambles where user_id=$fid or from_id=$fid order by time desc";
                   $query_obj = $con1->query($query);
                   while($res = $query_obj->fetch())
                   {
                      ?>
                               <div class="post" id="<?php echo $res['id']; ?>">
                               <?php
                                    if($res['user_id']!=$fid)
                                    {
                               ?>
                                        <p id='post_user_nick'><a href='/p1/profiles.php?id=<?php echo $res['user_id']?>'><?php echo "{$res['from_name']} > {$res['user_name']}"; ?>:</a></p>
                              <?php

                                    }
                                   else
                                   {
                               ?>
                                    <p id='post_user_nick'><a href='/p1/profiles.php?id=<?php echo $res['from_id']?>'><?php echo $res['from_name']; ?>:</a></p>
                             <?php }
                               ?>
                                    <p id ="post_user_pic"><img src="/p1/pics/pic.php?nick=<?php echo $res['from_nick']; ?>&id=<?php echo $res['from_id'] ?>" height="50px" width="50px"/></p>>
                                    <span id='post_content'><?php echo $res['content']; ?></span><br/>
                                    <?php          $time = date("m-d-Y G:i:s", $res['time']);
                                                echo "<span id='post_time'>at $time</span><br/>"; ?>

                                    <span id='post_location'><?php
                                                    if($res['location'])
                                                    echo "writing from '".$res['location']."'"; ?></span><br/>
                 </div>
                             <?php
                   }            ?>
                           </div>




            </body>
        </html>

