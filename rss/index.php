<!DOCTYPE html>
<html lang="en">
<head>
    <title>RSS Feed Reader | GWSC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f8f8f8;
        }

        #container {
            max-width: 600px;
            width: 100%;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        form {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        label {
            font-weight: bold;
            margin-right: 10px;
        }

        select {
            padding: 5px;
        }

        #rss-output {
            border: 1px solid #ccc;
            padding: 10px;
            min-height: 200px;
            max-width: 100%;
            overflow-y: auto;
        }

        .rss-item {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f8f8f8;
        }

        .rss-item h3 {
            margin: 0;
            font-size: 18px;
        }

        .rss-item p {
            margin-top: 5px;
            color: #333;
        }

        #clear-rss {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        #clear-rss:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div id="container">
    <form>
        <label>
        <select id="rss-input">
            <option value="">Select an rss feed</option>
            <option>Google</option>
            <option>NBC</option>
        </select>
        
        <button id="clear-rss" type="button">Clear Feed</button>
    </form>
    <div id="rss-output"></div>

    <script>

    document.getElementById('rss-input').addEventListener('change', function() {
        showRSS(this.value);
    });


    function showRSS(token) {
        var rssOutput = document.getElementById('rss-output');
        if (token.length == 0) {
            rssOutput.innerHTML = "";
            return;
        }

        if (XMLHttpRequest) {
            var xhr = new XMLHttpRequest();
        } else {
            var xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                rssOutput.innerHTML = this.responseText;
            } else {
                rssOutput.innerHTML = 'Fetching RSS feed from ' + token.toUpperCase() + ', please wait...';
            }
        }

        xhr.open('GET', 'getrssfeed.php?q=' + token, true);
        xhr.send();
    }

    document.getElementById('clear-rss').addEventListener('click', function() {
       document.getElementById('rss-output').innerHTML = ""; 
    });
    </script>
    <script src="../js/script.js"></script>
    </div>
</body>
</html>
