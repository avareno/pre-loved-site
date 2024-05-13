function showSection(sectionId) {
  // Hide all sections
  var sections = document.getElementsByClassName("section");
  for (var i = 0; i < sections.length; i++) {
    sections[i].classList.remove("active");
  }

  // Show the selected section
  document.getElementById(sectionId).classList.add("active");
}
