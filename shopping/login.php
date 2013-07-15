
<?php


    if(!isset($_POST['nick']) || !isset($_POST['name']) || $_POST['nick'] == '' || $_POST['name'] == '' ) // when i am logging in from the 'login' not register... then $_post['name'] is not set... so should'nt it always redirect..?
    {
   //     header("Location: /p1/index.php");
    }

    @session_start();
    require "includes/dbconn.php";
    require "includes/funcs.php";
    require "includes/apc.php";
    $con1 = $dbconn->db;


            $nick = $_POST['nick'];
            $name = $_POST['name'];

            echo "the parameters are [$nick] and [$name]";
            
      // registeration check...      
    if($_POST['nick']!='' && $_POST['name']!='') // can a not_defined_variable == '' can this return true?
      {
            echo "inside registeration..<br/>";
            $nick = addslashes($nick);
            $name = addslashes($name);
            $query = " select * from users where nick = '$nick' \n";
            $rs = execq($query);


            if(!$rs)
            {
                echo $_POST['password']."<br/>".$_POST['repassword'];
                
                if(strcmp($_POST['password'],$_POST['repassword'])!=0)
                {
                    $_SESSION['regis'] = 4;
                     header("Location: /p1/index.php");
                     exit(0);
                }
                
                $password =md5($_POST['password']);
                echo "inserting into users..<br/>";
                $query = " insert into users(nick,name,password) values('$nick','$name','$password'); \n";
                execq($query);
                $id = $_SESSION['id'] = $con1->lastInsertId();
                
                $img = file_get_contents("/var/www/p1/pics/default_img");
              
                $imginfo = getimagesize("/var/www/p1/pics/default_img");
                  echo "inserting into details..<br/>";
                $img = addslashes($img);
                $query = " insert into details(id,nick,name,pic,mime) values($id,'$nick','$name','$img','{$imginfo['mime']}'); \n";

          //      $query = " insert into details(id,nick) values({$rs['id']},'$nick'); \n";
                execq($query);
                $query = " insert into search_details(id,nick) values($id,'$nick'); \n";
                execq($query);
                echo "inserted into details...";
                 $_SESSION['auth'] = 1;
                 $_SESSION['nick'] = $nick;
                 $_SESSION['name'] = $name;
                header("Location: /p1/profile.php");
            }
            else{


                    $_SESSION['regis'] = 2;

                    header('Location: /p1/index.php');

            }


       }// end of registeration...
       //start of login check..                                                                            // start of login chekcs...
       else if(($_POST['nick']!='')&&($_POST['password']!=''))
           {
           
               $password = md5($_POST['password']);
               echo "checking for nick <br/>";
               $nick = $_POST['nick'];
               $rnick = $nick;
                                                                                    // check whether record exists in apc
               /*if(apc_exists($rnick))
               {
                  //** Making a correction here just for the time being...
                   goto sqllogin;
                   echo "the user being checked for is $rnick <br/> <br/>";
                   $user_obj = apc_fetch($rnick);
                  // var_dump($user_obj);
                   if(strcmp($password,$user_obj->password))
                   {
                                                                                       
                           $_SESSION['auth'] = 1;            
                           $_SESSION['id'] = $user_obj->id;
                           $_SESSION['name'] = $user_obj->name;

                           require "includes/session_apc_store.php";                                //Require used.. store_apc.php

                           echo "are u there <br/>";
                         //  var_dump($user_obj);
                           header("Location: /p1/profile.php");
                   }

               }
               else
               */{
                   sqllogin:
                    $nick = addslashes($nick);
                    $query = " select * from users where nick = '$nick'; \n";
                    $res = execq($query);
                    if(strlen($res['nick'])>0)
                    {
                        echo "database pass is ".$res['password']."<br/>";
                       echo "entered password is.. ".$password."<br/>";
                        
                        if(strcmp($res['password'],$password) == 0)
                        {
                            $_SESSION['id'] = $id = $res['id'];
                            $query = " select * from details where id = $id; \n";

                            $user_obj = new user();
                            $user_pic = new user_pic();
                            $rs = execq($query);
                            $_SESSION['name'] = $rs['name'];
							//
							$_SESSION['age'] = $rs['name'];
							$_SESSION['sex'] = $rs['name'];
							$_SESSION['location'] = $rs['name'];
							$_SESSION['ph'] = $rs['name'];
							//
                            foreach($rs as $a=>$b)
                            {
                                if(strcmp($a,'pic')!= 0)
                                $user_obj->$a = $b;

                            }
                             $_SESSION['user_obj'] = serialize($user_obj);
                             apc_store($rnick,$user_obj);

                             $user_pic->id = $rs['id'];
                             $user_pic->nick = $rs['nick'];
                             $user_pic->pic = $rs['pic'];
                             $user_pic->mime = $rs['mime'];

                             // store in apc the serialized object with the pic parameter...
                            
                             apc_store($rnick."pic",$user_pic);

             
             
                            $_SESSION['auth'] = 1;
                            $_SESSION['nick'] = $nick;

                            header("Location: /p1/profile.php");
                            //authorized..
                            
                        }
                        else
                        {
                            //invalid password
                            echo "invalid password..<br/>";
                        $_SESSION['regis'] = 3;
                        echo "redirecting...<br/>";
                        header('Location: /p1/index.php');
                            
                            
                        }
                    }

            //echo "checking if result is empty or not...<br/>";
           // var_dump($rs);

                    if(!($res))
                    {

                        echo "did not find any body with $nick..<br/>";
                        $_SESSION['regis'] = 1;
                        echo "redirecting...<br/>";
                        header('Location: /p1/index.php');
                    }
                   



            }

        }
        echo "end of login <br/>";

?>

