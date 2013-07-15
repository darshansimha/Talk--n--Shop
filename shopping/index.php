<html>
    <head>
    
    <link rel="stylesheet" href="basic.css" type="text/css" />;
        <title>The online store..</title>
    </head>
    <?php
        @session_start();
		
        $err = $_SESSION['regis'];
        
            switch($err)
            {
                case 1: echo "<p>invalid login... please register..<p><br/>"; break;
                case 2: echo "<p>aww..nick name already taken.... please select a different one...<p><br/>"; break;
                case 3: echo "<p>Invalid password... no hacking please :p :p..<p><br/>"; break;
                case 4: echo "<p>think you're pretty smart eh? enable your javascript..<p><br/>"; break;
            }

            $_SESSION['regis'] = 0;
        

    ?>



    <body>
    <p>
               
    <div class = "login">
                 <p>&nbsp;</p> 
      <form method ="post" action="/p1/login.php"/>
        <p>Login</p>
        <p>Username :
          <input type ="text" name ="nick" /><br/><br/>
          
          Password :
          <input type='password' name ="password" /><br/>
          <input type="submit" value="login" />
        </p>
                    </form>
               </div>
    <td width="10" bgcolor="grey"></td></p><tr><td width="10" bgcolor="grey"></td>
                <td width="306">
                    <div class = "RegisterNew">
                    <form method ="post" action="/p1/login.php"/>                    
                    
                    <p>Register an account here....</p><br/>
                   Your Full Name :
                   <input type ="text" name ="name" /><br/>
                   Choose your username...:<input type ="text" name ="nick" /><br/>
                   Enter password   <input type ="password" name ="password" /><br/>
                   Re-Enter password    
				   <input type="submit" value="register" />
                   <input type ="password" name ="repassword" /><br/>
                   </form>
                   
      </div></td>
    </tr>
       
    </body>
</html>

