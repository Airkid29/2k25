
<?php 

$servername = "localhost";
$database = "login";
$username = "root";
$password = "";
try{
    $bdd = new PDO("mysql:host=$servername;dbname=$database",$username);
    $bdd->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    

    if(isset($_POST['OK'])){
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email']; 
        $mdp = sha1($_POST['mdp']); 
        $mdp1 = sha1($_POST['mdp1']);
        if (strlen ($nom > 4)){
            if (strlen ($prenom > 4)){
                if ($mdp == $mdp1){
                    $requeteEmail = $bdd -> prepare("SELECT * FROM clients WHERE email = ?");
                    $requeteEmail -> execute(
                        array($email)
                    );
                    $resultat = $requeteEmail -> rowCount();
                    if ($resultat == 0){
                        $requete = $bdd -> prepare("INSERT INTO clients VALUES (0,?,?,?,?)");
                        $requete -> execute(

                        array($nom, $prenom, $email, $mdp)
                    ); 
                    header("location:login.php");
                    }else {
                        echo("email already found");
                    }
                    
                }else{
                    echo("MDP NON CONFAM");
                }
            }else {
                echo ("DOHII TALAA!");
            }
        } else{
            echo ("DOHII TALA!");
        }
    }
}
catch(PDOException $e){
    echo "Erreur".$e->getMessage();
}



?>
<!DOCTYPE html>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SIGNUP FORM</title>
    <link rel="stylesheet" href="login.css">
  </head>
  <body>
    <div class="center">
      <h1>SIGNIN</h1>
      <form method="post">
        <div class="txt_field">
          <input type="text" required name="nom">
          <span></span>
          <label>First name</label>
        </div>
        <div class="txt_field">
            <input type="text" required name="prenom">
            <span></span>
            <label>Last name</label>
          </div>
          <div class="txt_field">
            <input type="text" required name="email">
            <span></span>
            <label>Email</label>
          </div>
        <div class="txt_field">
          <input type="password" required name="mdp" id="psw">
          <span></span>
          <label>Create password</label>
        </div>
        <div class="txt_field">
          <input type="password" required name="mdp1" id="psw">
          <span></span>
          <label>Create password</label>
        <div class="pass">Already got an account?</div>
        <input type="submit" value="Login">
        <div class="signup_link">
            Already got an account? <a href="login.html">Login!</a>
        </div>
      </form>
    </div>

  </body>
</html>
