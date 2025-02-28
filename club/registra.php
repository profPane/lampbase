<?php
include '../db/database.php'; // Includi il file di configurazione

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = "
        INSERT INTO iscritti
        VALUES (0, :nome, :cognome, :data_nascita, :email, :telefono, :data_iscrizione, :livello_gioco, :giochi_preferiti, :note)
    ";

    $check = $pdo->prepare($query);
    $check->bindParam(':nome', $_POST["nome"], PDO::PARAM_STR);
    $check->bindParam(':cognome', $_POST["cognome"], PDO::PARAM_STR);
    $check->bindParam(':data_nascita', $_POST["data_nascita"], PDO::PARAM_STR);
    $check->bindParam(':email', $_POST["email"], PDO::PARAM_STR);
    $check->bindParam(':telefono', $_POST["telefono"], PDO::PARAM_STR);
    $check->bindParam(':livello_gioco', $_POST["livello_gioco"], PDO::PARAM_STR);
    $check->bindParam(':giochi_preferiti', $_POST["giochi_preferiti"], PDO::PARAM_STR);
    $check->bindParam(':note', $_POST["note"], PDO::PARAM_STR);
    $data = date("Y-m-d");
    $check->bindParam(':data_iscrizione', $data, PDO::PARAM_STR); // Data di iscrizione corrente
    $check->execute();

    if ($check->rowCount() > 0) {
        $msg = 'Registrazione eseguita con successo %s';
    } else {
        $msg = 'Problemi con l\'inserimento dei dati %s';
    }

} else { //se non arrivo già da un POST allora visualizzo il modulo
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrati</title>
</head>
<body>

<h1>Registrati al nostro sito</h1>
<br>In breve tempo un amministratore verificherà la tua identità e attiverà l'account, fornendoti nome utente e password</br>

<form action="registra.php" method="post">
    <label for="nome">Nome:</label><br>
    <input type="text" id="nome" name="nome" required><br><br>

    <label for="cognome">Cognome:</label><br>
    <input type="text" id="cognome" name="cognome" required><br><br>

    <label for="data_nascita">Data di Nascita:</label><br>
    <input type="date" id="data_nascita" name="data_nascita"><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="telefono">Telefono:</label><br>
    <input type="tel" id="telefono" name="telefono"><br><br>

    <label for="livello_gioco">Livello di Gioco:</label><br>
    <select id="livello_gioco" name="livello_gioco">
        <option value="Principiante">Principiante</option>
        <option value="Intermedio">Intermedio</option>
        <option value="Esperto">Esperto</option>
    </select><br><br>

    <label for="giochi_preferiti">Giochi Preferiti (separati da virgola):</label><br>
    <input type="text" id="giochi_preferiti" name="giochi_preferiti"><br><br>

    <label for="note">Note:</label><br>
    <textarea id="note" name="note"></textarea><br><br>

    <input type="submit" value="Registra">
</form>
<a href="../index.html">home</a>

</body>
</html>

<?
} // fine dell'else sul controllo POST
?>