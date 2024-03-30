<?php include 'header.php'; ?>
<?php
include('config.php');

// Insert new passenger
if(isset($_POST['submitbtn'])){
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    
    $sql = "INSERT INTO passengers (first_name, last_name, email) 
            VALUES ('$firstName', '$lastName', '$email')";
    
    if ($conn->query($sql) === TRUE) {
        $message =  "New passenger added successfully";
    } else {
        $message =  "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all passengers
$sql = "SELECT * FROM passengers";
$result = $conn->query($sql);
?>

<div class="container mx-auto p-4">
    <?php if(isset($message)){ echo "<h2 class='text-2xl mb-4 text-blue-700'>$message</h2>"; }?>
    <h1 class="text-2xl mb-4">Add Passenger</h1>
    <form action="" method="POST">
        <div class="mb-4">
            <label for="first_name" class="block text-gray-700">First Name:</label>
            <input type="text" id="first_name" name="first_name" class="form-input mt-1 p-2 border block min-w-full" required>
        </div>
        <div class="mb-4">
            <label for="last_name" class="block text-gray-700">Last Name:</label>
            <input type="text" id="last_name" name="last_name" class="form-input mt-1 p-2 border block min-w-full" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email:</label>
            <input type="email" id="email" name="email" class="form-input mt-1 p-2 border block min-w-full" required>
        </div>
        <button type="submit" name="submitbtn" class="bg-blue-500 text-white px-4 py-2 rounded">Add Passenger</button>
    </form>

    <!-- Display table of passengers -->
    <h2 class="text-2xl mt-8 mb-4">All Passengers</h2>
    <table class="table-auto border-collapse border border-gray-600 w-full">
        <thead>
            <tr>
                <th class="border border-gray-600 px-4 py-2">Passenger ID</th>
                <th class="border border-gray-600 px-4 py-2">First Name</th>
                <th class="border border-gray-600 px-4 py-2">Last Name</th>
                <th class="border border-gray-600 px-4 py-2">Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='border border-gray-600 px-4 py-2'>" . $row["passenger_id"] . "</td>";
                    echo "<td class='border border-gray-600 px-4 py-2'>" . $row["first_name"] . "</td>";
                    echo "<td class='border border-gray-600 px-4 py-2'>" . $row["last_name"] . "</td>";
                    echo "<td class='border border-gray-600 px-4 py-2'>" . $row["email"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='border border-gray-600 px-4 py-2'>No passengers found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
