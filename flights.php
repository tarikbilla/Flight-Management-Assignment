<?php include 'header.php'; ?>
<?php
include('config.php');

// Fetch airlines for dropdown
$sql_airlines = "SELECT * FROM airlines";
$result_airlines = $conn->query($sql_airlines);

// Fetch airports for departure and arrival dropdowns
$sql_airports = "SELECT * FROM airports";
$result_airports = $conn->query($sql_airports);

// Insert new flight
if(isset($_POST['submitbtn'])){
    $airline_id = $_POST['airline_id'];
    $departure_airport_id = $_POST['departure_airport_id'];
    $arrival_airport_id = $_POST['arrival_airport_id'];
    $departure_time = $_POST['departure_time'];
    $arrival_time = $_POST['arrival_time'];
    $price = $_POST['price'];
    
    $sql = "INSERT INTO flights (airline_id, departure_airport_id, arrival_airport_id, departure_time, arrival_time, price) 
            VALUES ('$airline_id', '$departure_airport_id', '$arrival_airport_id', '$departure_time', '$arrival_time', '$price')";
    
    if ($conn->query($sql) === TRUE) {
        $message =  "New flight added successfully";
    } else {
        $message =  "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all flights
$sql = "SELECT * FROM flights";
$result = $conn->query($sql);
?>

<div class="container mx-auto p-4">
    <?php if(isset($message)){ echo "<h2 class='text-2xl mb-4 text-blue-700'>$message</h2>"; }?>
    <h1 class="text-2xl mb-4">Add Flight</h1>
    <form action="" method="POST">
        <div class="mb-4">
            <label for="airline_id" class="block text-gray-700">Airline:</label>
            <select id="airline_id" name="airline_id" class="form-select mt-1 p-2 border block w-full" required>
                <option value="">Select Airline</option>
                <?php while($row_airline = $result_airlines->fetch_assoc()) { ?>
                    <option value="<?php echo $row_airline['airline_id']; ?>"><?php echo $row_airline['airline_name']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-4">
            <label for="departure_airport_id" class="block text-gray-700">Departure Airport:</label>
            <select id="departure_airport_id" name="departure_airport_id" class="form-select mt-1 p-2 border block w-full" required>
                <option value="">Select Departure Airport</option>
                <?php while($row_departure_airport = $result_airports->fetch_assoc()) { ?>
                    <option value="<?php echo $row_departure_airport['airport_id']; ?>"><?php echo $row_departure_airport['airport_name']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-4">
            <label for="arrival_airport_id" class="block text-gray-700">Arrival Airport:</label>
            <select id="arrival_airport_id" name="arrival_airport_id" class="form-select mt-1 p-2 border block w-full" required>
                <option value="">Select Arrival Airport</option>
                <?php // Reset pointer for airports result set
                $result_airports->data_seek(0);
                while($row_arrival_airport = $result_airports->fetch_assoc()) { ?>
                    <option value="<?php echo $row_arrival_airport['airport_id']; ?>"><?php echo $row_arrival_airport['airport_name']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-4">
            <label for="departure_time" class="block text-gray-700">Departure Time:</label>
            <input type="datetime-local" id="departure_time" name="departure_time" class="form-input mt-1 p-2 border block w-full" required>
        </div>
        <div class="mb-4">
            <label for="arrival_time" class="block text-gray-700">Arrival Time:</label>
            <input type="datetime-local" id="arrival_time" name="arrival_time" class="form-input mt-1 p-2 border block w-full" required>
        </div>
        <div class="mb-4">
            <label for="price" class="block text-gray-700">Price:</label>
            <input type="number" id="price" name="price" class="form-input mt-1 p-2 border block w-full" required>
        </div>
        <button type="submit" name="submitbtn" class="bg-blue-500 text-white px-4 py-2 rounded">Add Flight</button>
    </form>

    <!-- Display table of flights -->
    <h2 class="text-2xl mt-8 mb-4">All Flights</h2>
    <table class="table-auto border-collapse border border-gray-600 w-full">
        <thead>
            <tr>
                <th class="border border-gray-600 px-4 py-2">Flight ID</th>
                <th class="border border-gray-600 px-4 py-2">Airline</th>
                <th class="border border-gray-600 px-4 py-2">Departure Airport</th>
                <th class="border border-gray-600 px-4 py-2">Arrival Airport</th>
                <th class="border border-gray-600 px-4 py-2">Departure Time</th>
                <th class="border border-gray-600 px-4 py-2">Arrival Time</th>
                <th class="border border-gray-600 px-4 py-2">Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='border border-gray-600 px-4 py-2'>" . $row["flight_id"] . "</td>";
                    echo "<td class='border border-gray-600 px-4 py-2'>" . $row["airline_id"] . "</td>";
                    echo "<td class='border border-gray-600 px-4 py-2'>" . $row["departure_airport_id"] . "</td>";
                    echo "<td class='border border-gray-600 px-4 py-2'>" . $row["arrival_airport_id"] . "</td>";
                    echo "<td class='border border-gray-600 px-4 py-2'>" . $row["departure_time"] . "</td>";
                    echo "<td class='border border-gray-600 px-4 py-2'>" . $row["arrival_time"] . "</td>";
                    echo "<td class='border border-gray-600 px-4 py-2'>" . $row["price"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7' class='border border-gray-600 px-4 py-2'>No flights found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
