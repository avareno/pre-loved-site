function showSection(sectionId) {
  // Hide all sections
  const sections = document.getElementsByClassName("section");
  for (const i = 0; i < sections.length; i++) {
    sections[i].classList.remove("active");
  }

  // Show the selected section
  document.getElementById(sectionId).classList.add("active");
}
