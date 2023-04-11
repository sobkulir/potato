<?php

// Define constants for configuration parameters
define('ANSIBLE_PLAYBOOK_PATH', '/var/www/html/engine/');
define('ANSIBLE_HOSTS_PATH', '/etc/ansible/hosts');

// Install Ansible Server
function installAnsibleServer() {
  $command = "bash /var/www/html/engine/install_ansible_server.sh";
  execInBackground($command);
}

// Set target host for Ansible
function setTargetHost($ip, $user, $pass) {
  $hostsContent = "[target]\n".$ip." ansible_connection=ssh ansible_ssh_user=".$user." ansible_ssh_pass=".$pass."\n";
  file_put_contents(ANSIBLE_HOSTS_PATH, $hostsContent);
}

// Setup target host prerequisites
function setupTargetHost() {
  $command = "ansible-playbook ".ANSIBLE_PLAYBOOK_PATH."target_setup.yaml";
  execInBackground($command);
}

// Execute Ansible test
function executeAnsibleTest($testId) {
  $command = "ansible-playbook ".ANSIBLE_PLAYBOOK_PATH."execute_test.yaml --extra-vars '{\"test\":\"".$testId."\"}'";
  execInBackground($command);
}

// Execute command in the background and return process ID
function execInBackground($command) {
  $pid = shell_exec($command." > output.txt 2>&1 & echo $!");
  return $pid;
}

// Handle incoming requests
if (isset($_GET["action"])) {
  switch ($_GET["action"]) {
    case "installAnsible":
      installAnsibleServer();
      break;
    case "setTarget":
      setTargetHost($_GET["ip"], $_GET["user"], $_GET["pass"]);
      break;
    case "setupTarget":
      setupTargetHost();
      break;
    case "executeTest":
      executeAnsibleTest($_GET["id"]);
      break;
    default:
      // Invalid action
      http_response_code(400);
      exit;
  }
} else {
  // No action specified
  http_response_code(400);
  exit;
}

?>
