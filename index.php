<?php include 'header.php' ?>
<?php
include('config.php');

// Insert new airline
if(isset($_POST['submitbtn'])){
    $name = $_POST['name'];
    
    $sql = "INSERT INTO airlines (airline_name) VALUES ('$name')";
    
    if ($conn->query($sql) === TRUE) {
        $message =  "New record created successfully";
    } else {
        $message =  "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all airlines
$sql = "SELECT * FROM airlines";
$result = $conn->query($sql);
?>

<div class="container mx-auto p-4">
    <?php if(isset($message)){ echo "<h2 class='text-2xl mb-4 text-blue-700'>$message</h2>"; }?>
    <h1 class="text-2xl mb-4">Add Airline</h1>
    <form action="" method="POST">
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Airline Name:</label>
            <input type="text" id="name" name="name" class="form-input mt-1 p-2 border block min-w-full" required>
        </div>
        <button type="submit" name="submitbtn" class="bg-blue-500 text-white px-4 py-2 rounded">Add Airline</button>
    </form>

    <!-- Display table of airlines -->
    <h2 class="text-2xl mt-8 mb-4">All Airlines</h2>
    <table class="table-auto border-collapse border border-gray-600 w-80">
        <thead>
            <tr>
                <th class="border border-gray-600 px-4 py-2">ID</th>
                <th class="border border-gray-600 px-4 py-2">Airline Name</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='border border-gray-600 px-4 py-2'>" . $row["airline_id"] . "</td>";
                    echo "<td class='border border-gray-600 px-4 py-2'>" . $row["airline_name"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2' class='border border-gray-600 px-4 py-2'>No airlines found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php' ?>
