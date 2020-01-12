<?php
    include '../partials/header.php';
    include '../connection/connection.php';

    $stmt = $pdo->query('SELECT vehicle.*, people.People_name AS Owner
                        FROM ownership
                        RIGHT JOIN vehicle ON vehicle.Vehicle_ID = ownership.Vehicle_ID
                        LEFT JOIN people ON ownership.People_ID = people.People_ID
                        UNION
                        SELECT vehicle.*, people.People_name AS Owner
                        FROM ownership
                        RIGHT JOIN vehicle ON vehicle.Vehicle_ID = ownership.Vehicle_ID
                        RIGHT JOIN people ON ownership.People_ID = people.People_ID'
                        );

?>
    <div class="container">
        <div class="text-center mt-3">
            <h1>People</h1>
            <input class="pl-1" type="text" id="search" onkeyup="filter()" size="33" placeholder="Search by name or licence number">
            <table id="table" class="table table-bordered mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>Vehicle</th>
                        <th>Colour</th>
                        <th>Licence</th>
                        <th>Owner</th>
                    </tr>
                </thead>
                <?php
                    while($row = $stmt->fetch()){
                        echo '<tr> 
                          <td>'. $row->Vehicle_type . '</td>' .
                         '<td>'. $row->Vehicle_colour . '</td>' .
                         '<td>'. $row->Vehicle_licence . '</td>' . 
                         '<td>'. $row->Owner . '</td>' . 
                         '</tr>';
                    }
                    unset($stmt);
                    unset($pdo);
                ?>
            </table>
            <p class="d-none" id="noRecords"><strong class="text-danger">No records found</strong></p>
            <a class="btn btn-outline-success" href="#">Add New Person</a><br>
            <a class="btn btn-sm btn-primary mt-2" href="main.php">Go Back To Main</a>
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
                tdName = tr[i].getElementsByTagName("td")[1];
                tdLicence = tr[i].getElementsByTagName("td")[3];
                if (tdName || tdLicence) {
                    txtValueName = tdName.textContent || tdName.innerText;
                    txtValueLicence = tdLicence.textContent || tdLicence.innerText;
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