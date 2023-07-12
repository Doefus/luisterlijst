<?php

if (isset($_POST['submit'])) {
    try {
        require "../config.php";
        require "../common.php";

        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "SELECT * FROM nummers WHERE Artiest = :Artiest";

        $Artiest = $_POST['Artiest'];

        $statement = $connection->prepare($sql);
        $statement->bindParam(':Artiest', $Artiest, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();

        $connection = null;
        $sql = null;
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
        die();
    }
}

include "templates/header.php";

?>

<h2>Zoek nummers van een bepaalde artiest</h2>

<form method="post">
    <label for="Artiest">Artiest</label>
    <input type="text" id="Artiest" name="Artiest">
    <input type="submit" name="submit" value="Bekijk resultaten">
</form>

<?php

if (isset($_POST['submit'])) {
    if ($result && $statement->rowCount() > 0) { ?>
        <h2>Resultaten</h2>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Titel</th>
                    <th>Artiest</th>
                    <th>Album</th>
                    <th>Jaar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row) { ?>
                    <tr>
                        <td><?php echo escape($row["id"]); ?></td>
                        <td><?php echo escape($row["Titel"]); ?></td>
                        <td><?php echo escape($row["Artiest"]); ?></td>
                        <td><?php echo escape($row["Album"]); ?></td>
                        <td><?php echo escape($row["Jaar"]); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <br>Geen resultaten gevonden voor <?php echo escape($_POST['Artiest']); ?>.
<?php }
}

include "templates/footer.php"; ?>