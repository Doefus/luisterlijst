<?php

require "../config.php";
require "../common.php";

$success = null;

if (isset($_GET["id"])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $id = $_GET["id"];

    $sql = "DELETE FROM nummers WHERE id = :id";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $success = "Nummer succesvol verwijderd";
  } catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM nummers";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch (PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "templates/header.php"; ?>

<h2>Luisterlijst</h2>

<?php
if ($result) {
?>
  <table>
    <thead>
      <tr>
        <th>Id</th>
        <th>Titel</th>
        <th>Artiest</th>
        <th>Album</th>
        <th>Jaar</th>
        <th>Verwijder</th>
      </tr>
    </thead>
    <tbody><?php
            foreach ($result as $row) : ?>
        <tr>
          <td><?php echo escape($row["id"]); ?></td>
          <td><?php echo escape($row["Titel"]); ?></td>
          <td><?php echo escape($row["Artiest"]); ?></td>
          <td><?php echo escape($row["Album"]); ?></td>
          <td><?php echo escape($row["Jaar"]); ?></td>
          <td><a href="read.php?id=<?php echo escape($row["id"]); ?>">Verwijder</a></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table><?php } else {
    echo "Er zijn geen nummers gevonden";
    }?>

<?php
if ($success) {
  echo "<br>" . $success;
}

require "templates/footer.php"; ?>