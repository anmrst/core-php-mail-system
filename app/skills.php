<?php
    //database configuration
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'login_db';
    
    //connect with the database
    $db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
    
    //get search term
    $searchTerm = $_GET['term'];
    
    //get matched data from skills table
    $query = $db->query("SELECT email FROM users WHERE email LIKE '%".$searchTerm."%' ");
    while ($row = $query->fetch_assoc()) {
        $data[] = $row['email'];
    }
    
    //return json data
    echo json_encode($data);
?>