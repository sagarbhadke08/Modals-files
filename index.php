<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Preview</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="style.css">
  <script src="jquery/jquery.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <div class="container mt-4">
    <div class="card">
      <div class="card-body">
        <div class="container">
          <div class="col-md-6">
            <form action="upload_certificates.php" method="post" id="submit_form" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="user" class="form-label">User</label>
                <input type="text" id="user_id" name="user_id" class="form-control" required />
              </div>

              <div class="">
                <label for="certificate" class="form-label">Upload Certificates</label>
              </div>

              <!-- <div class="input-group mb-3">
                <input type="file" class="form-control" id="file" onchange="javascript:updateList()" name="attachment[]" multiple required>
                <button class="btn btn-outline-secondary" name="submit" type="submit" id="inputGroupFileAddon04">Upload</button>
              </div>
               -->
              <div class="input-group mb-3">
                <input type="file" class="form-control" id="file" onchange="updateList()" name="attachment[]" multiple required>
                <button class="btn btn-outline-secondary" name="submit" type="submit" id="inputGroupFileAddon04">Upload</button>
              </div>
              <div id="fileList">
              <!-- File names will be displayed here -->
            </div>
            </form>
           
            <button class="btn btn-primary show-certificates-btn" id="showButton">Show</button>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Attachment Modal -->
  <div class="modal fade" id="attachmentModal" tabindex="-1" role="dialog" aria-labelledby="attachmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="attachmentModalLabel">Attachments</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- The latest images and PDFs from the database will be displayed here -->
        </div>
      </div>
    </div>

  </div>

  <script src="script.js"></script>
  <script>
      function updateList() {
    var fileInput = document.getElementById('file');
    var files = fileInput.files;
    var fileList = document.getElementById('fileList');
    fileList.innerHTML = '';

    for (var i = 0; i < files.length; i++) {
        var fileName = files[i].name;
        var listItem = document.createElement('div');
        listItem.textContent = fileName;
        fileList.appendChild(listItem);
    }
}
  </script>
</body>

</html>