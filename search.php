
<?php include 'header.php'; ?>
<?php
include('config.php');

if(isset($_POST['searchbtn'])){
    $departure_airport_id = $_POST['departure_airport_id'];
    $arrival_airport_id = $_POST['arrival_airport_id'];
    $departure_date = $_POST['departure_date'];

    $sql = "SELECT * FROM flights WHERE departure_airport_id = '$departure_airport_id' AND arrival_airport_id = '$arrival_airport_id' AND DATE(departure_time) = '$departure_date'";
    $result = $conn->query($sql);
}
?>

<div class="container mx-auto p-4">
    <h1 class="text-2xl mb-4">Search Flights</h1>
    <form action="" method="POST">
        <div class="mb-4">
            <label for="departure_airport_id" class="block text-gray-700">Departure Airport:</label>
            <select id="departure_airport_id" name="departure_airport_id" class="form-select mt-1 p-2 border block w-full" required>
                <option value="">Select Departure Airport</option>
                <?php
                $sql_departure_airports = "SELECT * FROM airports";
                $result_departure_airports = $conn->query($sql_departure_airports);
                while($row_departure_airport = $result_departure_airports->fetch_assoc()) {
                    echo "<option value='".$row_departure_airport['airport_id']."'>".$row_departure_airport['airport_name']."</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-4">
            <label for="arrival_airport_id" class="block text-gray-700">Arrival Airport:</label>
            <select id="arrival_airport_id" name="arrival_airport_id" class="form-select mt-1 p-2 border block w-full" required>
                <option value="">Select Arrival Airport</option>
                <?php
                $sql_arrival_airports = "SELECT * FROM airports";
                $result_arrival_airports = $conn->query($sql_arrival_airports);
                while($row_arrival_airport = $result_arrival_airports->fetch_assoc()) {
                    echo "<option value='".$row_arrival_airport['airport_id']."'>".$row_arrival_airport['airport_name']."</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-4">
            <label for="departure_date" class="block text-gray-700">Departure Date:</label>
            <input type="date" id="departure_date" name="departure_date" class="form-input mt-1 p-2 border block w-full" required>
        </div>
        <button type="submit" name="searchbtn" class="bg-blue-500 text-white px-4 py-2 rounded">Search Flights</button>
    </form>

    <?php if(isset($result)) { ?>
    <h2 class="text-2xl mt-8 mb-4">Available Flights</h2>
    <table class="table-auto border-collapse border border-gray-600 w-full">
        <thead>
            <tr>
                <th class="border border-gray-600 px-4 py-2">Flight ID</th>
                <th class="border border-gray-600 px-4 py-2">Airline ID</th>
                <th class="border border-gray-600 px-4 py-2">Departure Airport ID</th>
                <th class="border border-gray-600 px-4 py-2">Arrival Airport ID</th>
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
    <?php } ?>
</div>

<?php include 'footer.php'; ?>
