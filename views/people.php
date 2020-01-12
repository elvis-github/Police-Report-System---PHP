<?php
    include '../partials/header.php';
    include '../connection/connection.php';

    $stmt = $pdo->query('SELECT * FROM people');

?>
    <div class="container">
        <div class="text-center mt-3">
            <h1>People</h1>
            <table class="table table-bordered mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>People ID#</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Licence</th>
                    </tr>
                </thead>
                <?php
                    while($row = $stmt->fetch()){
                        echo '<tr> 
                          <td>'. $row->People_ID . '</td>' .
                         '<td>'. $row->People_name . '</td>' .
                         '<td>'. $row->People_address . '</td>' . 
                         '<td>'. $row->People_licence . '</td>' . 
                         '</tr>';
                    }
                    unset($stmt);
                    unset($pdo);
                ?>
            </table>
            <a class="btn btn-outline-success" href="#">Add New Person</a><br>
            <a class="btn btn-sm btn-primary mt-2" href="main.php">Go Back To Main</a>
        </div>
    </div>

<?php
    include '../partials/footer.php'
?>