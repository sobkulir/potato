<?php

    function getMitreData() {
        $dbHost = "db";
        $dbName = "module";
        $dbUser = "secmon";
        $dbPass = "326598";

        try {
            $db = new PDO("pgsql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
            
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM mitre ;" ; # WHERE ID='T1548';";
            $stmt = $db->prepare($query);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($result);
        } catch (PDOException $e) {
            return "Connection failed: " . $e->getMessage();
        }
    }

?>
