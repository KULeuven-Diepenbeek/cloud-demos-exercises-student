### [Exercise 3](https://kuleuven-diepenbeek.github.io/cloud-course/applicatiecolleges/docker_basics/#exercise-3)

Idem aan 1 alleen even nadenken hoe we onze nieuwe site het juiste adres kunnen meegeven.

```html
<!-- index.html -->
<!DOCTYPE html>
<html>
</head>

<body>
  <button id="fetchButton">Fetch Data</button>
  <div id="result"></div>
  <script>
    document.getElementById('fetchButton').addEventListener('click', function () {
      console.log('PRESSED');
      fetch('http://host.docker.internal:9091', { mode: 'no-cors' }) // linux: http://172.17.0.1
        .then(response => {
          console.log(response);
          if (response.ok) {
            console.log('Request was successful');
            document.getElementById("result").innerHTML = 'Request was successful'
          } else {
            console.log('Request failed with status:', response.status);
            document.getElementById("result").innerHTML = 'Request failed with status:', response.status
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
    });

  </script>
</body>

</html>

``` 