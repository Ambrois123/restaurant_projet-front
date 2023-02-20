<?php
    ob_start();
?>
<?php 

?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
      <th scope="col">Email</th>
      <th scope="col">Téléphone</th>
      <th scope="col">Role</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr class="table-success">
      <th scope="row">Success</th>
      <td>Column content</td>
      <td>Column content</td>
      <td>Column content</td>
      <td>Column content</td>
      <td>Column content</td>
      <td>column content</td>
      <td>
        <button type="button" class="btn btn-warning">Modifier</button>
        <button type="button" class="btn btn-danger">Supprimer</button>
      </td>
    </tr>
  </tbody>
</table>


<?php
$titre = "<h1>Gestion des clients</h1>";
$content = ob_get_clean();
require_once './adminTemplate.php';

?>