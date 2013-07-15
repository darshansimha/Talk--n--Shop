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
require "includes/funcs.php";
 require "includes/store.php";
 //require "includes/apc.php";
// http://www.w3schools.com/jquery/jquery.js
?>

 <script type="text/javascript" src="http://localhost/p1/jquery.min.js"></script>
  <script type="text/javascript" >

 function ramble()
 {

    <?php echo "var to_nick ="."'{$_SESSION['nick']}';"  ?>


   $(document).ready(function(){

       var ramble_content = $("#txtarea").val();
       var location_content =$("#location").val();
       $.ajax({
           url:"/p1/rambles.php",
           type:"GET",
           data:({ramble:ramble_content,location:location_content,to_nick:to_nick}),
           dataType:"json",
           success:function(result){
             //  alert("your ramble has been posted");
             //  alert("time is "+result.time);
             
             var str = "  <div class='post' id="+result.id+">";
                 str+= "  <p id='post_user_nick'>"+"<?php echo $_SESSION['nick']; ?>"+"</p>";
                 str+="<p id ='post_user_pic'><img src='/p1/pics/pic.php?nick="+"<?php echo $_SESSION['nick']; ?>&id=<?php echo $_SESSION['id'] ?>"+" height='50px' width='50px'/></p>>";
                 str+="<span id='post_content'>"+result.content+"</span><br/>";
                 str+="<span id='post_time'>at "+result.time+"</span><br/>";
                 if(result.location)
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

<?php echo "your session id is ".$_SESSION['id']."name is {$_SESSION['name']}"; ?>
 <?php

    if(isset($_POST['ph']))
    {
        $ph = $_POST['ph'];
        $query = "update details set ph='$ph' where id={$_SESSION['id']}";
        
        try
        {
        execq($query);
        $query = "update search_details set ph='$ph' where id={$_SESSION['id']}";
        execq($query);
        }
        catch(Exception $e)
        {
            $ok = 0;
        }
        if($ok == 1)
        {
            $user_obj->ph->$ph;
            apc_store($nick,$user_obj);
        }
    }
 ?>

<?php
             if(apc_exists($nick))
             {
                 goto sqllogin;
                 $user_obj = apc_fetch($nick);
                 $result_all = array();
                 $result_all['id'] = $user_obj->id;
                 $result_all['nick'] = $user_obj->nick;
                 $result_all['name'] = $user_obj->name;
                 echo "nick is ".$user_obj->nick;
                 $result_all['age'] = $user_obj->age;
                 $result_all['sex'] = $user_obj->sex;
                 $result_all['location'] = $user_obj->location;
                 $result_all['ph'] = $user_obj->ph;
                 require "includes/session_apc_store.php";                                // require used..
                 echo "THIS IS THE APC STORAGE...";
             }
             else
             {
                 sqllogin:
                 $query = "select *  from details where id={$_SESSION['id']}";       //NOTE: THIS WILL PROBABLY NEVER BE USED BECAUSE THE APC
                 $result_all = execq($query);                                        // IS ALWAYS SET IN THE PREV
             }
?>


        <html>
            <head>
            <link href="style.css" rel = "stylesheet" type = "text/css"></style>
          <title><?php echo $result_all['nick'] ?>'s bubble</title>
            </head>
            <body>


                <a href="/p1/logout.php" class ="top">Logout</a>
            <div class = "registerMoblie">
            <p>register  or update your phone number</p>
                <form action = '/p1/profile.php' method='POST'>
                    Phone-Number:
                      <input type='text' name = 'ph'>
                  <br/>
                                <input type='submit' name = 'update'><br/>
                              
            </form>
</div>
               <h1> <?php echo $result_all['name']."'s Profile"; ?> </h1>
               <div id="mypic"></div>
               <p>&nbsp;</p>
               <p><a href="/p1/profiledit.php">Edit your profile</a> <br/><br/>
               </p>
               <table>
               <?php echo "<tr><td>Nick :</td><td>{$result_all['nick']}</td>";?>
               <?php echo "<tr><td>Name :</td><td>{$result_all['name']}</td>";?>
                  <?php
                  $flag = 0;
                  foreach($result_all as $a=>$b)
                  {
                      if(strcmp($a,'ph') == 0)
                      {
                          if($b == NULL)
                          {
                              $_SESSION['updates'] = 0;
                          }
                          else
                              $_SESSION['updates'] = 1;
                      }

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
               <a href="/p1/updates.php">Your Updates</a>

               <!--start of friends-->
               <p><img src=<?php echo "/p1/pics/pic.php?"."id={$_SESSION['id']}" ?> alt="no image" height="150px" width="150px" /></p>
               <p>Your friends</p>
      <?php

               $query = "select * from friends where id=$id limit 5";
               $query_obj = $con1->query($query);

               while($res = $query_obj->fetch())
               {
              //  echo "pal id is {$res['palid']} <br/>";
                $query2 = "select nick,location from details where id={$res['palid']} ";
                $rs = execq($query2);

                echo "<a href='/p1/profiles?id={$res['palid']}'><p id='friends'><b>{$rs['nick']}</b></a> ";
                if(strlen($rs['location']) != 0)
                {
                    echo "from <i>{$rs['location']}</i> </p>";
                }

               }
      ?>
               <a href="/p1/search/search.php">Find more friends!</a>
               


               <!-- start of rambles -->
               <h1> Your Rambles </h1>
               <table>
                   <tr>
                       <td class="saysomething">
                        Say something                     </td>
                       <td>
                           <textarea id="txtarea" rows="2" cols="30" >

                           </textarea>
                       </td>
                   </tr>
                   <tr>
                       <td class="whrru">
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
                   $query = "select * from rambles where user_id={$_SESSION['id']} or from_id={$_SESSION['id']} order by time desc";
                   $query_obj = $con1->query($query);
                   while($res = $query_obj->fetch())
                   {
                      ?>
                               <div class="post" id="<?php echo $res['id']; ?>">
                               <?php
                                    if($res['user_id']!=$_SESSION['id'])
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

