<?php
    include '../partials/header.php';
    
    if(!isset($_SESSION["loggedIn"])){
        header("location: ../index.php");
        exit;
    }

    require_once '../connection/connection.php';
    $stmt = $pdo->query('SELECT incident.*, vehicle.Vehicle_type AS Vehicle, people.People_name AS Suspect, offence.Offence_description AS Report, fines.Fine_Amount AS Fine
                        FROM incident 
                        JOIN vehicle
                        ON incident.Vehicle_ID = vehicle.Vehicle_ID
                        JOIN people 
                        ON incident.People_ID = people.People_ID
                        JOIN offence
                        ON incident.Offence_ID = offence.Offence_ID
                        LEFT JOIN fines
                        ON incident.Incident_ID = fines.Incident_ID
                        GROUP BY incident.Incident_Date DESC'
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
                        <th>Fine</th>
                    </tr>
                </thead>
                <?php
                    while($row = $stmt->fetch()){
                        echo '<tr>' . 
                         '<td>'. $row->Incident_ID . '</td>' .
                         '<td>'. $row->Vehicle . '</td>' .
                         '<td>'. $row->Suspect . '</td>' . 
                         '<td>'. $row->Incident_Date . '</td>' . 
                         '<td>'. $row->Incident_Report . '</td>' .
                         '<td>#'. $row->Offence_ID . '. ' . $row->Report . '</td>' .
                         '<td>'. $row->Fine . '</td>' .
                         '</tr>';
                    }
                    unset($stmt);
                    unset($pdo);
                ?>
            </table>
            <a class="btn btn-outline-success" href="../new/incident.php">Add New Incident</a><br>
            <a class="btn btn-sm btn-primary mt-2 mb-3" href="main.php">Go Back To Main</a>
        </div>
    </div>

<?php
    include '../partials/footer.php'
?>