<?php
$pass='';
$hash='';

if(array_key_exists('P2H', $_POST)) 
//pokud byl formular odeslan
{  
        $pass=$_POST['pass'];
        $options = [
          'cost' => 11
        ];
        $hash=password_hash($pass, PASSWORD_BCRYPT, $options);     
}
?>
<h1>Hash generator:</h1>
<form action="" method="POST">
    <table> 
        <tr>
            <td><label>password: <input type="text" name="pass" size="50" value="<?php echo htmlspecialchars($pass); ?>"/></label></td>
        </tr>
        <tr>   
            <td><label>hash: <input type="text" name="hash" size="100" value="<?php echo htmlspecialchars($hash); ?>"/></label></td>
        </tr>
        <tr>
            <td><input type="submit" value="generate" name="P2H"></td>
        </tr>
    </table>
</form>