<?php // creo un utente con i dati ricevuti 
session_start(); //ripristino sessione

require_once("../db/database.php");

if (isset($_POST['register'])) { //
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $livello = $_POST['livello'] ?? ''; //livello di accesso
    
    $isUsernameValid = filter_var(
        $username,
        FILTER_VALIDATE_REGEXP, [
            "options" => [
                "regexp" => "/^[a-z\d_]{3,20}$/i"
            ]
        ]
    );

    $pwdLenght = mb_strlen($password);
    
    if (empty($username) || empty($password)) {
        $msg = 'Compila tutti i campi %s';
    } elseif (false === $isUsernameValid) {
        $msg = 'Lo username non è valido. Sono ammessi solamente caratteri 
                alfanumerici e l\'underscore. Lunghezza minina 3 caratteri.
                Lunghezza massima 20 caratteri';
    } elseif ($pwdLenght < 8 || $pwdLenght > 20) {
        $msg = 'Lunghezza minima password 8 caratteri.
                Lunghezza massima 20 caratteri';
    } else {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $query = "
            SELECT id
            FROM users
            WHERE username = :username
        ";
        
        $check = $pdo->prepare($query);
        $check->bindParam(':username', $username, PDO::PARAM_STR);
        $check->execute();
        
        $user = $check->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($user) > 0) {
            $msg = 'Username già in uso %s';
        } else {
            $query = "
                INSERT INTO users
                VALUES (0, :username, :password, :livello)
            ";
        
            $check = $pdo->prepare($query);
            $check->bindParam(':username', $username, PDO::PARAM_STR);
            $check->bindParam(':password', $password_hash, PDO::PARAM_STR);
            $check->bindParam(':livello', $livello, PDO::PARAM_STR);
            $check->execute();
            
            if ($check->rowCount() > 0) {
                $msg = 'Registrazione eseguita con successo %s';
            } else {
                $msg = 'Problemi con l\'inserimento dei dati %s';
            }
        }
    }
    printf($msg, '<br><a href="../index.html">torna indietro</a>');
} else { //se non arrivo da un post allora visualizzo il form! Ma solo se autorizzato
    $livello = -1; //-1 == non loggato 
    if (isset($_SESSION['session_id'])) {
        $session_user = htmlspecialchars($_SESSION['session_user'], ENT_QUOTES, 'UTF-8');
        $session_id = htmlspecialchars($_SESSION['session_id']);
        if (isset($_SESSION['livello'])==TRUE) { //se sono passato per il login
            $livello = $_SESSION['livello']; //allora trovo livello in $_SESSION e lo prelevo
        } else {
            //altrimenti lo imposto a -1 valore che usero per "utente non loggato" 
            $livello=-1; 
        }
        echo "<br>";
        switch ($livello) {
        /*    case '-1':
                printf("Benvenuto Ospite, puoi registrarti per un account");
                break;
            case '0':
                printf("Benvenuto %s, il tuo session ID è %s puoi registrare un altro ospite", $session_user, $session_id);
                break; */  
            case '8':
                printf("Benvenuto %s, il tuo session ID è %s e hai i poteri di amministrazione", $session_user, $session_id);
                break;
            case '9':
                printf("Benvenuto %s, il tuo session ID è %s e hai i poteri della supermucca", $session_user, $session_id);
                break;
            default:
                printf("Benvenuto %s, non dovresti essere qui", $session_user, $session_id);
                printf("Effettua il %s per accedere all'area riservata", '<a href="../login.html">login</a>');
                //die();
                break;
        } //non arrivo da POST ma sono autorizzato allora visualizzo il form
        if ($livello>7) { //sono amministratore? ?>
            <!DOCTYPE html>
            <html>
                <head>
                    <title>Registrazione</title>
                    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
                    <link rel="stylesheet" href="/css/style.css">
                </head>
                <body>
                    <form method="post" action="/auth/register.php">
                        <h1>Registrazione</h1>
                        <input type="text" id="username" placeholder="Username" name="username" maxlength="50" required>
                        <input type="password" id="password" placeholder="Password" name="password" required>
                        <?php    
                        //logica per "stampare" o meno il campo select
                            if ($livello>7) {  //sono almeno SU stampo la scelta livello 
                                $scelte='<label for="livello">Livello utente</label>
                                <select name="livello" id="livello">
                                <option value=0>Ospite</option>
                                <option value=1>Utente base</option>
                                <option value=7>superuser</option>s
                                <option value=8>admin</option>
                                <option value=9>root</option>
                                </select>';
                            } else { 
                                $scelte=$scelte='<label for="livello">Livello utente</label>
                                <select name="livello" id="livello">
                                <option value=0>Ospite</option>
                                </select>';;
                            }
                            printf("%s",$scelte);
                        ?>
                        <button type="submit" name="register">Registrati</button>
                    </form>
                </body>
            </html>
        <? }//fine form           
        printf("%s", '<br><a href="auth/logout.php">logout</a><br><a href="index.html">homepage</a><br>');
    } else { //non c'è una sessione attiva
                printf("Utente non autorizzato, non dovresti essere qui<br>");
                printf("Effettua il %s per accedere all'area riservata", '<a href="../login.html">login</a>');
                die();        
    }
} // fine else della verifica arrivo da POST o meno
?>