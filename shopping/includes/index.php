<html>
    <head>
        <title>Real time updates Tool!</title>
    </head>
    <?php
        @session_start();

        $err = $_SESSION['regis'];
        
            switch($err)
            {
                case 1: echo "<p>invalid login... please register..<p><br/>"; break;
                case 2: echo "<p>aww..nick name already taken.... please select a different one...<p><br/>"; break;
            }


            $_SESSION['regis'] = 0;
        

    ?>



    <body>
        <table>
            <tr>
                <td><p>Login</p> <br/>
                    <form method ="post" action="/p1/login.php"/>
                    Nick:<input type ="text" name ="nick" /><br/>
                    <input type="submit" value="login" />
                    </form>
                </td>
                <td width="2" bgcolor="grey"></td>
                <td>
                    <form method ="post" action="/p1/login.php"/>
                    <p>Register an account here....</p>
                    Name:<input type ="text" name ="name" /><br/>
                    Nick..:<input type ="text" name ="nick" /><br/>
                    <input type="submit" value="register" />
                    </form>
                </td>
            </tr>
        </table>

    </body>
</html>
