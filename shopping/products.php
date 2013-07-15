
<?php
@session_start();

require "includes/dbconn.php";
require "includes/funcs.php";

$id = addslashes($_GET['id']);
$query = "select * from product_details where id=$id";
$res = execq($query);

?>
<html>
    <head>
            <link href="style_products.css" rel="stylesheet" type="text/css"/>
             <script type="text/javascript" src="http://localhost/p1/jquery.js"></script>
              <script type="text/javascript" >

             function comment()
             {

                <?php echo "var to_object ="."'{$id}';"  ?>


               $(document).ready(function(){

                   var comment_content = $("#txtarea").val();
                   var location_content =$("#location").val();
                   $.ajax({
                       url:"/p1/comments.php",
                       type:"GET",
                       data:({comment:comment_content,location:location_content,to_object:to_object}),
                       dataType:"json",
                       success:function(result){
                         //  alert("your comment has been posted");
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
                          //  alert("you're comment has been posted nick:"+result.nick+" content:"+result.content+"time:"+result.time+"location:"+result.location);


                       }

                   })
               })

             }

            </script>
            
        <title>
            Products:
        </title>
    </head>
    <body>
        
        <h1> <?php echo $res['name']; ?> </h1>
                       <div id="mypic">
                           <img src=<?php echo "/p1/pics/pro_pic.php?"."id={$_GET['id']}"; ?> alt="no image" height="350px" width="350px" />
                       </div>
                       <br/>
              <p class="products">Description</p>
              <?php echo $res['description']; ?><br/>
              Cost:<?php echo $res['cost']; ?>

              
              <!-- start of comments -->
               <h1> Comments </h1>
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
               
               <input type="button" value="tell now" onClick="comment()"  />
               <div id="post_area">
                   <?php
                   $query = "select * from comments inner join details on comments.user_id=details.id where object_id=$id order by time desc";
                   $query_obj = $con1->query($query);
                   while($res = $query_obj->fetch())
                   {
                      ?>
                               <div class="post" id="<?php echo $res['comment_id']; ?>">
                              
                                    <p id='post_user_nick'><a href='/p1/profiles.php?id=<?php echo $res['user_id']?>'><?php echo $res['name']; ?>:</a></p>
                             <?php 
                               ?>
                                    <p id ="post_user_pic"><img src="/p1/pics/pic.php?nick=<?php echo $res['nick']; ?>&id=<?php echo $res['user_id'] ?>" height="50px" width="50px"/></p>>
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
