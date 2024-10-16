<?php

require '../helpers/init_conn_db.php';

if(!$conn){
    die("Connection Failed");
}

$sql = "SELECT * FROM aerolinea";
                $query = $conn->query($sql);

                echo "$query->num_rows";
?><!-- Visit codeastro.com for more projects -->