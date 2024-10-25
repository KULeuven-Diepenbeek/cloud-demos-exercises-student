<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SOAP Request Example</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }

    input {
      margin: 5px;
    }

    #result {
      margin-top: 20px;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <h1>Add Two Numbers Using SOAP</h1>
  <label for="num1">Number 1:</label>
  <input type="number" id="num1" value="1"><br>

  <label for="num2">Number 2:</label>
  <input type="number" id="num2" value="2"><br>

  <button id="addButton">Add</button>

  <div id="result"></div>

  <script>
    // Function to fetch users and populate the table
    function test(num1,num2) {
      var formData = {
        num1: 1,
        num2: 2,
      };
      // Hier doen we dus een oproep naar het lokale endpoint
      fetch(`/soapAdd?num1=${num1}&num2=${num2}`)
      .then(response => response.json())
      .then(data => {
        console.log(data.result)
        document.getElementById('result').innerHTML = data.result
      })
      .catch(error => {
        console.error('Error fetching users:', error)
        document.getElementById('result').innerHTML = error
      });
    }


    document.getElementById('addButton').addEventListener('click', () => {
      const num1 = parseInt(document.getElementById('num1').value, 10);
      const num2 = parseInt(document.getElementById('num2').value, 10);
      test(num1, num2);
    });
  </script>
</body>
</html>
