<?php
    include '../partials/header.php';
    include '../connection/connection.php';

    $stmt = $pdo->query('SELECT incident.*, vehicle.Vehicle_type AS Vehicle, people.People_name AS Suspect, offence.Offence_description AS Report
                        FROM incident 
                        JOIN vehicle
                        ON incident.Vehicle_ID = vehicle.Vehicle_ID
                        JOIN people 
                        ON incident.People_ID = people.People_ID
                        JOIN offence
                        ON incident.Offence_ID = offence.Offence_ID'
                        );

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
                        echo '<td>'. $row->Vehicle . '</td>';
                        echo '<td>'. $row->Suspect . '</td>';
                        echo '<td>'. $row->Incident_Date . '</td>';
                        echo '<td>'. $row->Incident_Report . '</td>';
                        echo '<td>#'. $row->Offence_ID . '. ' . $row->Report . '</td>';
                        echo '</tr>';
                    }
                ?>
            </table>
            <a class="btn btn-outline-success" href="#">Add New Incident</a>
        </div>
    </div>
</body>
</html>

<?php
    include '../partials/footer.php'
?>