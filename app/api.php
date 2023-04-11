<?php


    function getMitreData($select) {
        $dbHost = "db";
        $dbName = "module";
        $dbUser = "secmon";
        $dbPass = "326598";

        try {
            $db = new PDO("pgsql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
            
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            #$query = "SELECT id, name FROM mitre WHERE id NOT LIKE '%.%' ;" ; # WHERE ID='T1548';";
            $query = $select;
            $stmt = $db->prepare($query);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($result);
        } catch (PDOException $e) {
            return "Connection failed: " . $e->getMessage();
        }
    }

    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
          case 'startpage':
            $query = "SELECT id, name FROM mitre WHERE id NOT LIKE '%.%';";
            $result = getMitreData($query);
            echo $result;
            break;
      
          case 'specific':
            if (isset($_GET['id'])) {
              $id = $_GET['id'];
              $query = "SELECT id, name, description, url, tactics, platforms FROM mitre WHERE id LIKE '$id.%';";
              // secure against SQL injections
              $result = getMitreData($query, $params);
              echo $result;
            }
            break;
        }
      }


?>
