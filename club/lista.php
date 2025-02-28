<!DOCTYPE html>
<html>
<head>
    <title>Iscritti Club Giochi</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h1>Iscritti al Club Giochi</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Data di Nascita</th>
            <th>Email</th>
            <th>Telefono</th>
            <th>Data di Iscrizione</th>
            <th>Livello Gioco</th>
            <th>Giochi Preferiti</th>
            <th>Note</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include '../db/database.php'; // Includi il file di configurazione

        
        $query = "
        SELECT *
        FROM iscritti
        ";
    
        $check = $pdo->prepare($query);
        //$check->bindParam(':username', $username, PDO::PARAM_STR);
        $check->execute();
        
        $iscritti = $check->fetchAll(PDO::FETCH_ASSOC);


        if (count($iscritti) > 0) { //ci sono risultati
            foreach ($iscritti as $iscritto) { //per ogni riga dell'array dei risultati
                echo "<tr>";
                echo "<td>" . $iscritto["ID_Iscritto"]. "</td>";
                echo "<td>" . $iscritto["Nome"]. "</td>";
                echo "<td>" . $iscritto["Cognome"]. "</td>";
                echo "<td>" . $iscritto["DataNascita"]. "</td>";
                echo "<td>" . $iscritto["Email"]. "</td>";
                echo "<td>" . $iscritto["Telefono"]. "</td>";
                echo "<td>" . $iscritto["DataIscrizione"]. "</td>";
                echo "<td>" . $iscritto["LivelloGioco"]. "</td>";
                echo "<td>" . $iscritto["GiochiPreferiti"]. "</td>";
                echo "<td>" . $iscritto["Note"]. "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='10'>Nessun iscritto trovato.</td></tr>";
        }
        ?>
    </tbody>
</table>
    <a href="../index.html">home</a>
</body>
</html>