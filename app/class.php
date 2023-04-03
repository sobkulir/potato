<html>
<head>
  <script>
  function installAnsible() {
    // Start Ansible execution
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "run-ansible.php?action=installAnsible", true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        console.log("Ansible process started with PID " + xhr.responseText);
        // Periodically check if Ansible execution has finished and update output
        var interval = setInterval(function() {
          var xhr2 = new XMLHttpRequest();
          xhr2.open("GET", "output.txt", true);
          xhr2.onreadystatechange = function() {
            if (xhr2.readyState === 4 && xhr2.status === 200) {
              document.getElementById("output").innerHTML = xhr2.responseText;
              if (xhr2.responseText.includes("PLAY RECAP")) {
                console.log("Ansible process finished");
                clearInterval(interval);
              }
            }
          }
          xhr2.send();
        }, 1000);
      }
    };
    xhr.send();
  }

  function setTarget(){
    var ip = document.getElementById("ip").value;
    var user = document.getElementById("user").value;
    var pass = document.getElementById("password").value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "run-ansible.php?action=setTarget&ip=" + ip + "&user=" + user + "&pass=" + pass, true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        console.log("Process started with PID " + xhr.responseText);
      }
    }
    xhr.send();
}

function executeTest(){
    var testid = document.getElementById("testid").value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "run-ansible.php?action=executeTest&id=" + testid, true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        console.log("Ansible process started with PID " + xhr.responseText);
        // Periodically check if Ansible execution has finished and update output
        var interval = setInterval(function() {
          var xhr2 = new XMLHttpRequest();
          xhr2.open("GET", "output.txt", true);
          xhr2.onreadystatechange = function() {
            if (xhr2.readyState === 4 && xhr2.status === 200) {
              document.getElementById("output").innerHTML = xhr2.responseText;
              if (xhr2.responseText.includes("PLAY RECAP")) {
                console.log("Ansible process finished");
                clearInterval(interval);
              }
            }
          }
          xhr2.send();
        }, 1000);
      }
    };
    xhr.send();
  }

  function setupTarget(){
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "run-ansible.php?action=setupTarget", true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        console.log("Ansible process started with PID " + xhr.responseText);
        // Periodically check if Ansible execution has finished and update output
        var interval = setInterval(function() {
          var xhr2 = new XMLHttpRequest();
          xhr2.open("GET", "output.txt", true);
          xhr2.onreadystatechange = function() {
            if (xhr2.readyState === 4 && xhr2.status === 200) {
              document.getElementById("output").innerHTML = xhr2.responseText;
              if (xhr2.responseText.includes("PLAY RECAP")) {
                console.log("Ansible process finished");
                clearInterval(interval);
              }
            }
          }
          xhr2.send();
        }, 1000);
      }
    };
    xhr.send();
  }


  </script>
</head>
<body>
  <p><button onclick="installAnsible()">Install Ansible</button></p>
  <p>___________</p>
  <p><input type="text" id="ip" name="ip" placeholder="Target IP"size="15"></p>
  <p><input type="text" id="user" name="user" placeholder="username"size="15"></p>
  <p><input type="text" id="password" name="password" placeholder="password"size="15"></p>
  <p><button onclick="setTarget()">Set Target</button><p>
  <p>___________</p>
  <p><input type="text" id="testid" name="testid" placeholder="Test ID"size="15"></p>
  <p><button onclick="executeTest()">Execute Test</button><p>
  <p>___________</p>
  <p><button onclick="setupTarget()">Setup Target</button><p>

    <div id="output">Loading...</div>
  </body>
</html>