$(document).ready(function () {
  $("#showButton").attr("disabled", true);

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


  $(document).on("click", ".delete-image", function () {
    var imageId = $(this).data("image-id");

    $.ajax({
      url: "deleteimage.php",
      type: "POST",
      data: {
        imageId: imageId,
      },
      success: function (response) {
        console.log(response);
        $(".show-certificates-btn").click();
      },
    });
  });

  $("#submit_form").on("submit", function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
      url: "upload_certificates.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        console.log(response);
        $("#user_id").val("");
        $("#file").val("");
        $("#fileList").empty();
        $("#uploaded_cards_container").empty();
        alert("Form submitted successfully!");
        // Show button after successful form submission
        $("#showButton").attr("disabled", false);
      },
    });
  });

  $(".show-certificates-btn").click(function (e) {
    e.preventDefault();

    $.ajax({
      url: "getimages_download.php",
      type: "GET",
      success: function (response) {
        // Display the images in the popup modal
        $("#attachmentModal .modal-body").html(response);
        $("#attachmentModal").modal("show");
      },
    });
  });
});
