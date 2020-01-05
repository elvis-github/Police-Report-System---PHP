<?php
    include '../partials/header.php';
    include '../connection/connection.php';

    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $stmt = $pdo->query('SELECT * FROM incident');
    
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
                <?php
                    while($row = $stmt->fetch()){
                        echo '<tr>';
                        echo '<td>'. $row->Incident_ID . '</td>';
                        echo '<td>'. $row->Vehicle_ID . '</td>';
                        echo '<td>'. $row->People_ID . '</td>';
                        echo '<td>'. $row->Incident_Date . '</td>';
                        echo '<td>'. $row->Incident_Report . '</td>';
                        echo '<td>'. $row->Offence_ID . '</td>';
                        echo '</tr>';
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>

<?php
    include '../partials/footer.php'
?>