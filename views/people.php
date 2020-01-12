<?php
    include '../partials/header.php';
    include '../connection/connection.php';

    $stmt = $pdo->query('SELECT * FROM people');

?>
    <div class="container">
        <div class="text-center mt-3">
            <h1>People</h1>
            <input type="text" id="search" onkeyup="filter()" placeholder="Search for names...">
            <table id="table" class="table table-bordered mt-3">
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

    <script>
        function filter() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("table");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
<?php
    include '../partials/footer.php'
?>