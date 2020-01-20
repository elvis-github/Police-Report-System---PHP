<?php
    include '../partials/header.php';
    
    if(!isset($_SESSION["loggedIn"])){
        header("location: ../index.php");
        exit;
    }

    require_once '../connection/connection.php';
    $sql = 'SELECT i.*, v.Vehicle_type, p.People_Name, o.Offence_description, f.Fine_Amount
    FROM incident AS i
    JOIN vehicle AS v
    ON i.Vehicle_ID = v.Vehicle_ID
    JOIN people AS p 
    ON i.People_ID = p.People_ID
    JOIN offence AS o 
    ON i.Offence_ID = o.Offence_ID
    LEFT JOIN fines AS f
    ON i.Incident_ID = f.Incident_ID
    GROUP BY i.Incident_ID DESC';
    
    
    $stmt = $pdo->query($sql);

?>
    <div class="container">
        <div class="text-center mt-3">
            <h1>Incidents</h1>
            <input class="pl-1" type="text" id="search" onkeyup="filter()" size="33" placeholder="Search by date or name">
            <table id="table" class="table table-bordered mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>Date</th>
                        <th>Vehicle</th>
                        <th>Suspect</th>
                        <th>Report</th>
                        <th>Offence</th>
                        <th>Fine</th>
                        <th></th>
                    </tr>
                </thead>
                <?php
                    while($row = $stmt->fetch()){
                        echo '<tr>' . 
                         '<td>'. $row->Incident_Date . '</td>' .
                         '<td>'. $row->Vehicle_type . '</td>' .
                         '<td>'. $row->People_Name . '</td>' . 
                         '<td>'. $row->Incident_Report . '</td>' .
                         '<td>#'. $row->Offence_ID . '. ' . $row->Offence_description . '</td>' .
                         '<td>'. ($row->Fine_Amount ? $row->Fine_Amount : '---') . '</td>' .
                         '<td><a href="../new/incident.php?edit='. $row->Incident_ID .'" class="text-success">Edit</a></td>' . 
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

<script>
    var tr = table.getElementsByTagName("tr");
    var trCount = tr.length - 1;
    function filter() {
        // Declare variables
        var input, filter, table, td, i, txtValue, hiddenCount;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.getElementById("table");
        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            tdDate = tr[i].getElementsByTagName("td")[0];
            tdName = tr[i].getElementsByTagName("td")[2];
            if (tdDate || tdName) {
                txtValueName = tdDate.textContent || tdDate.innerText;
                txtValueLicence = tdName.textContent || tdName.innerText;
                if (txtValueName.toUpperCase().indexOf(filter) > -1 || txtValueLicence.toUpperCase().indexOf(filter) > -1) {
                    if(tr[i].style.display == "none"){
                        tr[i].style.display = "";
                    }
                } else {
                    tr[i].style.display = "none";
                }
            }
            if($('tr[style*="display: none"]').length == trCount){
                $('#noRecords').removeClass("d-none");
            } else {
                $('#noRecords').addClass("d-none");
            }
        }
    }
</script>

<?php
    include '../partials/footer.php'
?>