<?php
    
    include_once(__DIR__ . '/../app/start_connect.php');

    $where = "TRUE";
    $fields = [
        'name',
        'address',
    ];

    foreach ($fields as $field) {
        if (isset($_GET[$field])) {
            $value = mysqli_real_escape_string($conn, $_GET[$field]);
            $where .= " AND $field LIKE '%{$value}%'";
        }
    }

    $sql = "
        SELECT P.name, P.address, P.pid
        FROM Pharmacy P
        WHERE $where
        ORDER BY P.pid
    ";

    $result = $conn->query($sql);
    if (!$result) {
        echo mysqli_error($conn);
        mysqli_close($conn);
        include_once(__DIR__ . '/../app/end.php');
        exit();
    }

?>
    <head>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>
    <h2>DEMO: Search for Pharmacies (With Autocomplete)</h2>
    <h3>
        Filter
    </h3>

    <form method='GET' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" />
        <br/>
        <br/>

        <button type="submit">
            Filter
        </button>
    </form>

    <!--The autocomplete JS Script-->
    <script>
        var tags = [

        <?php
            $autocompletesql = "SELECT P.name FROM Pharmacies P";

            $autocompleteresult = $conn->query($sql);
            if (!$autocompleteresult) {
                echo mysqli_error($conn);
                mysqli_close($conn);
                include_once(__DIR__ . '/../app/end.php');
                exit();
            }

            if($autocompleteresult->num_rows > 0) {
                while($autocompleterow = $autocompleteresult->fetch_assoc()) {
                ?>
                "<?=$autocompleterow['name']?>" ,
                <?php
                }
            }

        ?>
        
        ];
        $( "#name" ).autocomplete({
          source: function( request, response ) {
                        var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
                                  response( $.grep( tags, function( item ){
                                                    return matcher.test( item );
                                                              }));
          },
          search: "",
          minLength: 0
        }).focus(function() {
            $(this).autocomplete("search", "");
        });
    </script>

    <br />
    <br />
    <?php
        if ($result->num_rows > 0) { 
    ?>
    <table>
        <thead>
            <tr style='text-align: center;'>
                <th>Name</th>
                <th>Address</th>
                <th>Pharmacie ID</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td>
                    <a href="<?=ROOT?>search/pharmacie.php?pid=<?=$row['pid']?>">
                        <?=$row['name']?>
                    </a> 
                </td>
                <td><?=$row['address']?></td>
                <td><?=$row['pid']?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php
    } else {
?>
    <h2>No Entries</h2>
<?php
    }

    mysqli_close($conn);
    include_once(__DIR__ . '/../app/end.php');
?>
