/**
 * Función para manejar la selección del menú
 */
function selectMenu(element) {
  // 1. Buscamos todos los elementos con la clase nav-item
  const items = document.querySelectorAll(".nav-item");

  // 2. Removemos la clase active de todos
  items.forEach((item) => {
    item.classList.remove("active");
  });

  // 3. Agregamos la clase active solo al elemento clickeado
  element.classList.add("active");
}

function abrirPerfil() {
  fetch("index.php?c=profile&a=modal")
    .then((res) => res.text())
    .then((html) => {
      document.getElementById("modalBody").innerHTML = html;
      document.getElementById("modalBody").style.display = "flex";
      document.getElementById("modalBody").style.justifyContent = "center";
      document.getElementById("modalPerfil").style.display = "flex";
    });
}

function cerrarPerfil() {
  document.getElementById("modalPerfil").style.display = "none";
}
