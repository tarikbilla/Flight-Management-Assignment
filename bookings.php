<?php include 'header.php'; ?>
<?php
include('config.php');

// Fetch flights for dropdown
$sql_flights = "SELECT * FROM flights";
$result_flights = $conn->query($sql_flights);

// Fetch passengers for dropdown
$sql_passengers = "SELECT * FROM passengers";
$result_passengers = $conn->query($sql_passengers);

// Insert new booking
if(isset($_POST['submitbtn'])){
    $flight_id = $_POST['flight_id'];
    $passenger_id = $_POST['passenger_id'];
    $booking_date = date('Y-m-d H:i:s');
    
    $sql = "INSERT INTO bookings (flight_id, passenger_id, booking_date) 
            VALUES ('$flight_id', '$passenger_id', '$booking_date')";
    
    if ($conn->query($sql) === TRUE) {
        $message =  "New booking added successfully";
    } else {
        $message =  "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all bookings
$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);
?>

<div class="container mx-auto p-4">
    <?php if(isset($message)){ echo "<h2 class='text-2xl mb-4 text-blue-700'>$message</h2>"; }?>
    <h1 class="text-2xl mb-4">Add Booking</h1>
    <form action="" method="POST">
        <div class="mb-4">
            <label for="flight_id" class="block text-gray-700">Flight:</label>
            <select id="flight_id" name="flight_id" class="form-select mt-1 p-2 border block w-full" required>
                <option value="">Select Flight</option>
                <?php while($row_flight = $result_flights->fetch_assoc()) { ?>
                    <option value="<?php echo $row_flight['flight_id']; ?>"><?php echo $row_flight['flight_id']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-4">
            <label for="passenger_id" class="block text-gray-700">Passenger:</label>
            <select id="passenger_id" name="passenger_id" class="form-select mt-1 p-2 border block w-full" required>
                <option value="">Select Passenger</option>
                <?php while($row_passenger = $result_passengers->fetch_assoc()) { ?>
                    <option value="<?php echo $row_passenger['passenger_id']; ?>"><?php echo $row_passenger['first_name'] . ' ' . $row_passenger['last_name']; ?></option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" name="submitbtn" class="bg-blue-500 text-white px-4 py-2 rounded">Add Booking</button>
    </form>

    <!-- Display table of bookings -->
    <h2 class="text-2xl mt-8 mb-4">All Bookings</h2>
    <table class="table-auto border-collapse border border-gray-600 w-full">
        <thead>
            <tr>
                <th class="border border-gray-600 px-4 py-2">Booking ID</th>
                <th class="border border-gray-600 px-4 py-2">Flight ID</th>
                <th class="border border-gray-600 px-4 py-2">Passenger ID</th>
                <th class="border border-gray-600 px-4 py-2">Booking Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='border border-gray-600 px-4 py-2'>" . $row["booking_id"] . "</td>";
                    echo "<td class='border border-gray-600 px-4 py-2'>" . $row["flight_id"] . "</td>";
                    echo "<td class='border border-gray-600 px-4 py-2'>" . $row["passenger_id"] . "</td>";
                    echo "<td class='border border-gray-600 px-4 py-2'>" . $row["booking_date"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='border border-gray-600 px-4 py-2'>No bookings found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
