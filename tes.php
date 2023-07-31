<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Input Terhubung</title>
</head>
<body>
  <form action="insinvoice.php" method="post">
    <!-- Form elements -->

    <div class="form-group row">
      <div class="col-md-6">
        <label for="fname" class="text-black">First Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="fname" name="fname" required>
      </div>
      <div class="col-md-6">
        <label for="lname" class="text-black">Last Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="lname" name="lname" required>
      </div>
    </div>

    <div class="form-group">
      <label for="address" class="text-black">Address <span class="text-danger">*</span></label>
      <textarea name="address" id="address" cols="30" rows="5" class="form-control" required></textarea>
    </div>

    <!-- The input fields that will be automatically filled -->
    <input type="text" name="firstname" id="firstname" required>
    <input type="text" name="lastname" id="lastname" required>
    <input type="text" name="lastname" id="address_hidden" required>

    <!-- Submit button -->
    <button type="submit">Submit</button>
  </form>

  <script>
    // Function to update the hidden fields
    function updateHiddenFields() {
      // Get the values from the first name, last name, and address inputs
      const firstNameInput = document.getElementById("fname");
      const lastNameInput = document.getElementById("lname");
      const addressInput = document.getElementById("address");

      // Update the values in the hidden fields
      document.getElementById("firstname").value = firstNameInput.value;
      document.getElementById("lastname").value = lastNameInput.value;
      document.getElementById("address_hidden").value = addressInput.value;
    }

    // Add event listeners to the first name, last name, and address inputs
    document.getElementById("fname").addEventListener("input", updateHiddenFields);
    document.getElementById("lname").addEventListener("input", updateHiddenFields);
    document.getElementById("address").addEventListener("input", updateHiddenFields);
  </script>
</body>
</html>
