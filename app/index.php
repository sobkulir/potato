<!DOCTYPE html>
<html>
<head>
    <title>Hello, world!</title>
</head>
<body>
  <p><button onclick="getStartpageData()">Print techniques</button></p>
  <p>___</p>
  <p><input type="text" id="test" name="test" placeholder="test id" size="15"></p>
  <p><button onclick="getSpecificData()">Print Tech detail</button></p>

  <script>
    function getStartpageData(){
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var response = JSON.parse(this.responseText);
          console.log(response);
        }
      };
      xhttp.open("GET", "api.php?action=startpage", true);
      xhttp.send();
    }

    function getSpecificData(){
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var response = JSON.parse(this.responseText);
          console.log(response);
        }
      };
      var test = document.getElementById("test").value;
      xhttp.open("GET", "api.php?action=specific&id=" + encodeURIComponent(test), true);
      xhttp.send();
    }
  </script>
</body>
</html>