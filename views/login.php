<!DOCTYPE HTML>
<html>
    <body>

        <!-- Menu left -->
        <div id="menuLeft">

        </div>
        
        
        <!-- Ganze Seite -->
        <div class="page">
            
            <h1>Login</h1>
            
            <form method='post' action=''>
                <div>
                    <table>
                        <tr>
                            <td><label for='username'>Username:</label></td>
                            <td><input type='text' name='username' placeholder='Username' required /></td>
                        </tr>
                        <tr>
                            <td><label for='password'>Passwort:</label></td>
                            <td><input type='password' name='password' placeholder='Passwort' required /></td>
                        </tr>
                        <tr>
                            <td colspan='2' style='text-align: right;'><input type='submit' value='Login' name='login' /></td>
                        </tr>
                    </table>
                </div>
            </form>
            
            <form method='post' action=''>
                <div style='margin-top: 50px;'>
                    <h2>Register</h2>
                    <table>
                        <tr>
                            <td><label for='username'>Username:</label></td>
                            <td><input type='text' name='username' placeholder='Username' required /></td>
                        </tr>
                        <tr>
                            <td><label for='email'>Email:</label></td>
                            <td><input type='email' name='email' placeholder='Email' required /></td>
                        </tr>
                        <tr>
                            <td><label for='password'>Passwort:</label></td>
                            <td><input type='password' name='password' placeholder='Passwort' required /></td>
                        </tr>
                        <tr>
                            <td><label for='password2'>Passwort:</label></td>
                            <td><input type='password' name='password2' placeholder='Passwort wiederholen' required /></td>
                        </tr>
                        <tr>
                            <td colspan='2' style='text-align: right;'><input type='submit' value='Register' name='register' /></td>
                        </tr>
                    </table>
                </div>
            </form>
            
        </div>
        
    </body>
</html>