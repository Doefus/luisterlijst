<?php include "templates/header.php"; ?>

<h2>Voeg een nummer toe</h2>

<form method="post">
    <label for="Titel">Titel</label>
    <input type="text" name="Titel" id="Titel">
    <label for="Artiest">Artiest</label>
    <input type="text" name="Artiest" id="Artiest">
    <label for="Album">Album</label>
    <input type="text" name="Album" id="Album">
    <label for="Jaar">Jaar</label>
    <input type="number" name="Jaar" id="Jaar"><br><br>
    <input type="submit" name="submit" value="Voeg toe">
</form>

<?php
if (isset($_POST['submit'])) {
    require "../config.php";
    require "../common.php";

    try {
        $connection = new PDO($dsn, $username, $password, $options);

        if ($_POST['Jaar']) {
            $jaar = preg_replace("/[^0-9]/", "", $_POST['Jaar']);
            if ($jaar === '') {
                $jaar = 9999;
            }
        } else {
            $jaar = 9999;
        }

        if ($_POST['Titel']) {
            $new_nummer = array(
                "Titel" => $_POST['Titel'],
                "Artiest" => $_POST['Artiest'],
                "Album" => $_POST['Album'],
                "Jaar" => $jaar
            );

            $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "nummers",
                implode(", ", array_keys($new_nummer)),
                ":" . implode(", :", array_keys($new_nummer))
            );

            $statement = $connection->prepare($sql);
            $statement->execute($new_nummer);
            if (isset($_POST['submit']) && $statement) { ?>
                <br><?php echo $_POST['Titel']; ?> successvol toegevoegd.
<?php }
        } else {
            echo "<br>Vul in ieder geval de titel in.";
        }

        $connection = null;
        $sql = null;
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
        die();
    }
}
?>

<?php require "templates/footer.php"; ?>