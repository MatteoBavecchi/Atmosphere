<?php
include_once("include/config.php");
if(isset($_GET['success'])) {
    echo changePassword($_POST['old_password'],$_POST['new_password'])? 
    "<center><h1>password cambiata</h1></center>" : "<center><h1>errore<h1><center>";
	 header("Refresh: 5;URL=login.php");

}
else{
if(isset($_GET['password'])){
	?>
    <form action="recover.php?success=ok" method="post">
<input type="text" name="old_password" placeholder="password di recupero" required>
<input type="password" name="new_password" placeholder="nuova password" required>
<input type="submit" value="cambia">
</form>
    <?php }else{
if(isset($_POST['email'])){
	echo recoverPassword($_POST['email'])? "<center><h1>Ti abbiamo inviato una mail!</h1></center>" : "<center><h1> l' email inserita non è associata a nessun account";
	    header("Refresh: 5;URL=login.php");
}
	else{
?>
<form action="recover.php" method="post">
<input type="text" name="email" placeholder="inserisci mail">
<input type="submit" value="avanti">
</form>

<?php } }}?>
