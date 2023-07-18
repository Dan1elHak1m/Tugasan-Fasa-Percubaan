<!DOCTYPE html>
<html>
<head>
    <title>Electricity Consumption Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn-primary {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            text-align: center;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .result {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .result h3 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Electricity Rates Calculator</h2>
        <form method="POST">
            <div class="form-group">
                <label for="voltage">Voltage :</label>
                <input type="text" class="form-control" id="voltage" name="voltage" onkeypress="enforceDotSeparator(event)" required>
                <label for="voltage">Voltage (V)</label>
            </div>
            <div class="form-group">
                <label for="current">Current :</label>
                <input type="text" class="form-control" id="current" name="current" onkeypress="enforceDotSeparator(event)" required>
                <label for="current">Current (A):</label>
            </div>
            <div class="form-group">
                <label for="rate">Current Rate:</label>
                <input type="text" class="form-control" id="rate" name="rate" onkeypress="enforceDotSeparator(event)" required>
                <label for="rate">sen/kWh:</label>
            </div>
            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $voltage = (float) $_POST['voltage'];
            $current = (float) $_POST['current'];
            $rate = (float) $_POST['rate'];

            // Calculate power (Wh)
            $power = ($voltage * $current)/1000;

            echo "<h3>Results:</h3>";
            echo "<p>Power: " . $power . " kWh</p>";
            echo "<p>Rates: " . $rate/100 . " Wh</p>";

            // Calculate energy (kWh) and total charge for each hour
            echo "<h3>Energy Consumption:</h3>";
            echo "<ul>";
            for ($hour = 1; $hour <= 24; $hour++) {
                $energy = $power * $hour;
                $totalCharge = ($energy * ($rate / 100));
                $roundedTotalCharge = number_format($totalCharge, 2); // Round to two decimal places

                echo "<li>Hour: $hour | Energy: " . $energy . " | Total Charge: RM " . $roundedTotalCharge . "</li>";
            }
            echo "</ul>";
        }
        ?>
    </div>
</body>
</html>