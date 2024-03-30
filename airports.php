<?php include 'header.php'; ?>
<?php
include('config.php');

// Insert new airport
if(isset($_POST['submitbtn'])){
    $code = $_POST['code'];
    $name = $_POST['name'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    
    $sql = "INSERT INTO airports (airport_code, airport_name, city, country) 
            VALUES ('$code', '$name', '$city', '$country')";
    
    if ($conn->query($sql) === TRUE) {
        $message =  "New airport added successfully";
    } else {
        $message =  "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all airports
$sql = "SELECT * FROM airports";
$result = $conn->query($sql);
?>

<div class="container mx-auto p-4">
    <?php if(isset($message)){ echo "<h2 class='text-2xl mb-4 text-blue-700'>$message</h2>"; }?>
    <h1 class="text-2xl mb-4">Add Airport</h1>
    <form action="" method="POST">
        <div class="mb-4">
            <label for="code" class="block text-gray-700">Airport Code:</label>
            <input type="text" id="code" name="code" class="form-input mt-1 p-2 border block min-w-full" required>
        </div>
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Airport Name:</label>
            <input type="text" id="name" name="name" class="form-input mt-1 p-2 border block min-w-full" required>
        </div>
        <div class="mb-4">
            <label for="city" class="block text-gray-700">City:</label>
            <input type="text" id="city" name="city" class="form-input mt-1 p-2 border block min-w-full" required>
        </div>
        <div class="mb-4">
            <label for="country" class="block text-gray-700">Country:</label>
            <input type="text" id="country" name="country" class="form-input mt-1 p-2 border block min-w-full" required>
        </div>
        <button type="submit" name="submitbtn" class="bg-blue-500 text-white px-4 py-2 rounded">Add Airport</button>
    </form>

    <!-- Display table of airports -->
    <h2 class="text-2xl mt-8 mb-4">All Airports</h2>
    <table class="table-auto border-collapse border border-gray-600 w-full">
        <thead>
            <tr>
                <th class="border border-gray-600 px-4 py-2">Airport Code</th>
                <th class="border border-gray-600 px-4 py-2">Airport Name</th>
                <th class="border border-gray-600 px-4 py-2">City</th>
                <th class="border border-gray-600 px-4 py-2">Country</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='border border-gray-600 px-4 py-2'>" . $row["airport_code"] . "</td>";
                    echo "<td class='border border-gray-600 px-4 py-2'>" . $row["airport_name"] . "</td>";
                    echo "<td class='border border-gray-600 px-4 py-2'>" . $row["city"] . "</td>";
                    echo "<td class='border border-gray-600 px-4 py-2'>" . $row["country"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='border border-gray-600 px-4 py-2'>No airports found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
