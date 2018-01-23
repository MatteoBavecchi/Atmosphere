
<?php

//funzione che serve per loggarsi, ritorna TRUE se va a buon fine, altrimenti ritorna FALSE
function login($mail, $password){
$mysql= new mysqli('localhost','u790033170_user','atmosphere','u790033170_1');
    $mysql->autocommit(true);
    
    $Sql = "SELECT COD_USR, ATTIVO FROM UTENTE WHERE (EMAIL = '".$mail."' OR USERNAME = '".$mail."') 
	AND PASSWORD = '".sha1($password)."';";
    $Query=$mysql->query($Sql);

    $mysql->close();
    $num= $Query->num_rows;
    if($num==1){
         $Dati = $Query -> fetch_assoc();
		 if($Dati['ATTIVO']==0) return "NOT_ACTIVATED";
		 
         setcookie("LOGIN_ATMOSPHERE", $Dati['COD_USR'], time()+60*60);
         return "SUCCESS";
      }
     else return "NOT_EXIST";
    }


function logout(){
	if(isset($_COOKIE['LOGIN_ATMOSPHERE'])){
	setcookie("LOGIN_ATMOSPHERE", "", time()-60*60);
    return true;
	}
	else return false;
    }
	
	
function addUser($username,$mail,$password, $mac){
$mysql= new mysqli('localhost','u790033170_user','atmosphere','u790033170_1');
    $mysql->autocommit(true);
    $Sql = "SELECT COD_USR FROM UTENTE WHERE (EMAIL='$mail' OR USERNAME='$username') AND MAC_ADDR_DEVICE = '$mac';";
    $Query=$mysql->query($Sql);
    $num= $Query->num_rows;
    if($num>0) return false;
    $Sql1 = "INSERT INTO UTENTE (COD_USR, USERNAME, PASSWORD, EMAIL, MAC_ADDR_DEVICE, ATTIVO) 
	VALUES(NULL, '$username', '".sha1($password)."', '$mail', '$mac', 0);";
    $Query1=$mysql->query($Sql1);
    $mysql->close();
	return $Query1 ? true:false;
	}
	
	
function getUtente($id){
$mysql= new mysqli('localhost','u790033170_user','atmosphere','u790033170_1');
    $mysql->autocommit(true);
	
	$Sql = "SELECT USERNAME FROM UTENTE WHERE COD_USR ='$id';";
    $Query=$mysql->query($Sql);
	$mysql->close();
	$Dati = $Query -> fetch_assoc();
	return $Dati['USERNAME'];
}

	
function mailto($mail){
	echo "<h1>Controlla la tua casella email!</h1>";
	$url= createActivationLink();
	$messaggio= "Per confermare l account clicca sul link seguente $url";
	mail($mail, 'Registrazione avvenuta con successo!', $messaggio);
	}
	
function createActivationLink(){
$mysql= new mysqli('localhost','u790033170_user','atmosphere','u790033170_1');
    $mysql->autocommit(true);
	$Sql="SELECT max(COD_USR) as id FROM UTENTE";
	$Query=$mysql->query($Sql);
	$Dati = $Query -> fetch_assoc();
	$Sql1="INSERT INTO ATTIVAZIONI (COD_ATT, COD_USR) VALUES (NULL,".$Dati['id'].");";
	$Query1=$mysql->query($Sql1);
	$mysql->close();
	
	
	return "http://atmosphere.96.lt/activation.php?id=".$Dati['id'];
	
	}

function recoverPassword($mail){
    $mysql= new mysqli('localhost','u790033170_user','atmosphere','u790033170_1'); //ci colleghiamo al DB
    $mysql->autocommit(true);
    $Sql = "SELECT COD_USR FROM UTENTE WHERE EMAIL='$mail';"; //selezioniamo il codice utente corrispondente alla mail 
    $Query=$mysql->query($Sql);
    $num= $Query->num_rows;
    if($num==0) return 0; //se non ci sono corrispondenze si esce dalla funzione
	
	$psw = createRandomString(); //si crea una stringa randomica con la funzione createRandomString()
	$Sql1="UPDATE UTENTE SET PASSWORD='$psw' WHERE EMAIL='$mail'"; //si mette la nuova password al posto di quella dimenticata
	$Query1=$mysql->query($Sql1);
	
	$mysql->close(); //si chiude il collegamento con il DB
	$messaggio= "ecco la password di recupero : $psw\n
	 Inseriscila nel campo di questa pagina http://atmosphere.96.lt/recover.php?password=change per cambiarla!";
	mail($mail, 'Password di recupero!', $messaggio); //si invia l' email con all' interno i dati di recupero
	return 1;
	} 


function createRandomString($length = 20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!&/()';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) 
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    return sha1($randomString);
}
function unactive($id){
$mysql= new mysqli('localhost','u790033170_user','atmosphere','u790033170_1');
    $mysql->autocommit(true);
    $Sql = "SELECT COD_ATT FROM ATTIVAZIONI WHERE COD_USR='$id';";
    $Query=$mysql->query($Sql);
    $num= $Query->num_rows;
	$mysql->close();
    if($num>0) return 1;
	else return 0;
}
function setActive($id){
$mysql= new mysqli('localhost','u790033170_user','atmosphere','u790033170_1');
    $mysql->autocommit(true);
	$Sql="DELETE FROM ATTIVAZIONI WHERE COD_USR = $id";
	$Query=$mysql->query($Sql);
	$Sql1="UPDATE UTENTE SET ATTIVO=1 WHERE COD_USR=$id";
	$Query1=$mysql->query($Sql1);
	$mysql->close();
	
}

function changePassword($old,$new){
$mysql= new mysqli('localhost','u790033170_user','atmosphere','u790033170_1');
    $mysql->autocommit(true);
    $Sql = "UPDATE UTENTE SET PASSWORD='".sha1($new)."' WHERE PASSWORD='$old';";
    $Query=$mysql->query($Sql);
	$mysql->close();
    return $Query? 1:0;

}
      
function createTable($id){
	$mysql= new mysqli('localhost','u790033170_user','atmosphere','u790033170_1');
    $mysql->autocommit(true);
	$Query="SELECT MAX(ID_RILEVAZIONE) AS ID_RILEVAZIONE FROM RILEVAZIONE WHERE COD_USR = $id";
	$a = $mysql->query($Query);
	
	$tab = $a -> fetch_assoc();
	$n=$tab['ID_RILEVAZIONE'];
	
	$Query3="SELECT * FROM RILEVAZIONE WHERE ID_RILEVAZIONE BETWEEN '".($n-14)."' AND '".$n."' ORDER BY ID_RILEVAZIONE DESC;";
	$tabella = $mysql->query($Query3);
	 
	$mysql->close();
	return $tabella;
	
}
         


?>