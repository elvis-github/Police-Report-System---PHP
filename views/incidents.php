<?php
    include '../partials/header.php';
    include '../connection/connection.php';

    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $stmt = $pdo->query('SELECT * FROM incident');
    while($row = $stmt->fetch()){
        // var_dump($row);
        echo $row->Incident_Report . '<br>';
    }
?>
    <div class="container">
        <div class="text-center mt-3">
            <h1>Incidents</h1>
            <table class="table table-bordered mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>Incident ID#</th>
                        <th>Vehicle</th>
                        <th>Suspect</th>
                        <th>Date</th>
                        <th>Report</th>
                        <th>Offence</th>
                    </tr>
                </thead>
                <tr>
                    <td>Placeholder</td>
                    <td>Placeholder</td>
                    <td>Placeholder</td>
                    <td>Placeholder</td>
                    <td>Placeholder</td>
                    <td>Placeholder</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>

<?php
    include '../partials/footer.php'
?>