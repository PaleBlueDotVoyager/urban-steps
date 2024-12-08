<?php
function loadUsers() {
    $jsonFile = 'path/to/users.json'; // Update with your actual path
    if (!file_exists($jsonFile)) {
        return []; // Return empty array if the file doesn't exist
    }

    $jsonData = file_get_contents($jsonFile);
    return json_decode($jsonData, true); // Decode JSON into an associative array
}
?>
