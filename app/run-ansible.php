<?php

switch ($_GET["action"]) {
    case "installAnsible":
        installAnsibleServer();
        break;
    case "setupTarget":
        targetSetup();
        break;
    case "setTarget":
        $ip = $_GET["ip"];
        $user = $_GET["user"];
        $pass = $_GET["pass"];
        setTarget($ip, $user, $pass);
        break;
    case "executeTest":
        $testid = $_GET["id"];
        executeTest($testid);
        break;
}

    function installAnsibleServer(){
        // Execute install_ansible.sh which launches server_setup ansible playbook
        $command = "/var/www/html/engine/install_ansible_server.sh > output.txt 2>&1 & echo $!";
        $pid = shell_exec($command);
        echo $pid;
    }

    function setTarget($ip, $user, $pass){ //parameters:  ansible_connection=ssh   ansible_ssh_user=centos    ansible_ssh_pass=centos
        // rewrite ansible host file
        $command = "echo '[target] \n$ip ansible_connection=ssh ansible_ssh_user=$user ansible_ssh_pass=$pass' > '/etc/ansible/hosts'";
        $pid = shell_exec($command);
        echo $pid;
    }

    function targetSetup(){ // prereq: set_target
        // download 
        $command = "ansible-playbook /var/www/html/engine/target_setup.yaml > output.txt 2>&1 & echo $!";
        $pid = shell_exec($command);
        echo $pid;
    }

    function executeTest($test){ //parameter: testID
        $command = "nohup ansible-playbook /var/www/html/engine/execute_test.yaml --extra-vars '{\"test\":\"$test\"}' > output.txt 2>&1 & echo $!";
        $pid = shell_exec($command);
        echo $pid;
    }

    
?>