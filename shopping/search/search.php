<?php

    require "../includes/protect.php";
    require "../includes/dbconn.php";
    require "../includes/store.php";
    require "sphinx_search.php";

?>
<?php
        if(isset($_POST['query']))
        {
         //   echo "there is a POST query";
            $search_query = $_POST['query'];
            $sql_query = sphinx_query($search_query);

            $query_obj = $con1->query($sql_query);
        }
?>

<html>
    <head>
    <h1>Discover people and communities!</h1>
        <style type ="text/css">

    .top
    {
         position:absolute;
         top:0%;
         left:90%;

    }
    #age
    {
        color:blue;
    }
    .alert
    {
         color:red;
    }
    #friends
    {
         background-color:gainsboro;
    }
    #post_area
    {


    }
    #post_location
    {
        font-style: bold;
        font-size:4px;
    }
    .friend
    {   background-color:#42FF65;
        border:1px white;
    }
   #textarea
    {
       overflow:hidden;
    }

</style>
        <title>
            Explore the site!
        </title>
    </head>
    <body>
        <h3> Find Friends,people and more! </h3>
        <form method ="POST" action ="/p1/search/search.php">
            Explore<input type="text" name="query" />
                        <input type="submit" value="search" />
        </form>
        <?php

                if(isset($_POST['query']))
                {

                    $s = 0;
                  while($rs = $query_obj->fetch())
                  {
                //   var_dump($rs);
                   $s++;
        ?>

                        <div class="friend">
                            <p id="friend_nick"><?php echo "<a href='../profiles.php?id={$rs['id']}'>{$rs['nick']}</a>";?></p>
                            <img src="../pics/pic.php?id=<?php echo $rs['id'] ?>&<?php echo "nick=".$rs['nick'];?>" height="75px" width="75px" /><br/>
                            <span>
                            <?php
                             if($rs['age'])
                                echo "<b id='age'> {$rs['age']} yrs </b>";
                              if($rs['sex'])
                                 echo "<b>{$rs['sex']} </b>";
                              if($rs['location'])
                                 echo "from <b>{$rs['location']} </b>";
                             ?>
                            </span>
                        </div>



       <?php
                   }

                         if($s == 0)
                        {   echo "<p>search resulted in no items.. maybe you should try searching for something similar...</p>";
                            echo "<h2>Items related to you're search were not found :(</h2>";
                        }
                }

       ?>




    </body>
</html>
