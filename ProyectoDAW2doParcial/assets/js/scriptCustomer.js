const input = document.getElementById("searchCustomer");
const tbody = document.querySelector(".table-customers tbody");

let timer = null;
/* autor: David Israel Sayay Quito */

input.addEventListener("keyup", () => {
  clearTimeout(timer);

  timer = setTimeout(() => {
    const value = input.value.trim();

    fetch(`index.php?c=CustomerAJAX&f=search&q=${encodeURIComponent(value)}`)
      .then((res) => res.json())
      .then((data) => {
        renderCustomers(Array.isArray(data) ? data : []);
      });
  }, 300);
});

function renderCustomers(customers) {
  tbody.innerHTML = "";

  if (customers.length === 0) {
    tbody.innerHTML = `
      <tr>
        <td colspan="9" style="text-align:center;">No se encontraron resultados</td>
      </tr>
    `;
    return;
  }

  customers.forEach((c) => {
    tbody.innerHTML += `
      <tr>
        <td>C${c.id}</td>
        <td>${c.cedula}</td>
        <td>${c.nombres}</td>
        <td>${c.direccion}</td>
        <td>${c.telefono}</td>
        <td>${c.correo}</td>
        <td>${c.cantMascotas}</td>
        <td class="text-center">
          <button type="button" onclick="EditarCliente(${c.id})">
            <i class="fa-solid fa-pencil action-icon"></i>
          </button>
        </td>
        <td class="text-center">
          <a href="index.php?c=Customer&f=EliminarCliente&id=${c.id}"
             onclick="return confirm('¿Estás seguro de eliminar este cliente?')">
            <i class="fa-solid fa-trash btn-delete"></i>
          </a>
        </td>
      </tr>
    `;
  });
}

function EditarCliente(idCliente) {
  fetch(`index.php?c=Customer&a=modal&f=CustomerEdit&id=${idCliente}`)
    .then((res) => res.text())
    .then((html) => {
      document.getElementById("modalBody").innerHTML = html;

      document.getElementById("modalPerfil").style.display = "flex";
    });
}
function CrearCliente() {
  fetch("index.php?c=Customer&a=modal&f=CutomerCreate")
    .then((res) => res.text())
    .then((html) => {
      document.getElementById("modalBody").innerHTML = html;

      document.getElementById("modalPerfil").style.display = "flex";
    });
}
function Cerrar() {
  document.getElementById("modalPerfil").style.display = "none";
}
