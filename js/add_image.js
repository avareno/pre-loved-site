function previewImage(event) {
  var input = event.target;
  var reader = new FileReader();

  reader.onload = function () {
    var dataURL = reader.result;
    var imgElement = document.getElementById("profile-image");
    imgElement.src = dataURL;
  };

  reader.readAsDataURL(input.files[0]);
}
