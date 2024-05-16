<?php
function executeQuery($db, $query, $params = []) {
    try {
        $stmt = $db->prepare($query);
        $success = $stmt->execute($params);
        return $success;
    } catch (PDOException $e) {
        // Handle the exception (e.g., log the error, display a message, etc.)
        // For simplicity, we'll just echo the error message here
        echo "Error executing query: " . $e->getMessage();
        return false;
    }
}
?>