const input = document.getElementById("searchPet");
const tbody = document.querySelector(".table-pets tbody");

let currentDate = new Date();

function renderCalendar() {
  const dataDiv = document.getElementById("calendarData");
  const citas = dataDiv ? JSON.parse(dataDiv.dataset.citas) : {};

  const grid = document.getElementById("calendarGrid");
  const monthLabel = document.getElementById("currentMonth");

  grid.innerHTML = "";

  const year = currentDate.getFullYear();
  const month = currentDate.getMonth();

  monthLabel.textContent = currentDate.toLocaleDateString("es-ES", {
    month: "long",
    year: "numeric",
  });

  const firstDay = new Date(year, month, 1).getDay();
  const startDay = firstDay === 0 ? 6 : firstDay - 1;
  const totalDays = new Date(year, month + 1, 0).getDate();

  // Espacios vacíos
  for (let i = 0; i < startDay; i++) {
    const empty = document.createElement("div");
    empty.className = "day-empty";
    grid.appendChild(empty);
  }

  // Días
  for (let day = 1; day <= totalDays; day++) {
    const dateKey = `${year}-${String(month + 1).padStart(2, "0")}-${String(day).padStart(2, "0")}`;
    const dayDiv = document.createElement("div");

    dayDiv.className = "day-number";
    if (citas[dateKey]) {
      dayDiv.classList.add("has-event");
      dayDiv.classList.add("day-active");
    }

    dayDiv.textContent = day;
    grid.appendChild(dayDiv);
  }
}

function changeMonth(delta) {
  currentDate.setMonth(currentDate.getMonth() + delta);
  renderCalendar();
}

let timer = null;
// autor: Cadena Herrera Samuel
input.addEventListener("keyup", () => {
  clearTimeout(timer);

  timer = setTimeout(() => {
    const value = input.value.trim();

    fetch(`index.php?c=PetsAJAX&f=search&q=${encodeURIComponent(value)}`)
      .then((res) => res.json())
      .then((data) => {
        renderPets(data);
      });
  }, 300);
});

function renderPets(pets) {
  tbody.innerHTML = "";

  if (pets.length === 0) {
    tbody.innerHTML = `
            <tr>
                <td colspan="12" style="text-align:center;">No se encontraron resultados</td>
            </tr>
        `;
    return;
  }

  pets.forEach((p) => {
    tbody.innerHTML += `
            <tr>
                <td>${p.id}</td>
                <td class="mascota-avatar">
                    <img class="icons" src="assets/images/icons/${p.tipo.icono}">
                </td>
                <td>${p.nombre}</td>
                <td>${p.especie}</td>
                <td>${p.raza}</td>
                <td>${p.sexo}</td>
                <td>${p.peso} Kg</td>
                <td>${p.edad} años</td>
                <td>${p.dueno}</td>
                <td class="text-center"> <button type="button" onclick="VerFicha(${p.id})"> <i
                                        class="fa-solid fa-eye action-icon"></i></button></td>
                            <td class="text-center"><button type="button" onclick="VerHistorial(${p.id})"><i
                                        class="fa-solid fa-clipboard-list action-icon"></i></button></td>
                <td class="text-center"><a href="index.php?c=Pets&f=EliminarMascota&id=${p.id}"
                                        onclick="return confirm('¿Estás seguro de eliminar esta mascota?')">
                                        <i class="fa-solid fa-trash btn-delete"></i>
                                    </a></td>
            </tr>
        `;
  });
}
document.addEventListener("input", function (event) {
  if (event.target && event.target.id === "clienteInput") {
    const inputVisual = event.target;
    const inputOculto = document.getElementById("input-id-oculto");
    const datalist = document.getElementById("clientesList");

    const opcionSeleccionada = Array.from(datalist.options).find(
      (opt) => opt.value === inputVisual.value,
    );

    if (opcionSeleccionada) {
      inputOculto.value = opcionSeleccionada.getAttribute("data-id");
    } else {
      inputOculto.value = "";
    }
  }
});
const btnGuardar = document.getElementById("btnGuardar");

function habilitarEdicion() {
  document
    .querySelectorAll('input[name="Nombre"], textarea[name="observaciones"]')
    .forEach((el) => (el.disabled = false));

  const btnGuardar = document.getElementById("btnGuardar");
  if (btnGuardar) {
    btnGuardar.disabled = false;
  }
}

function NuevoPet() {
  fetch("index.php?c=Pets&f=PetsCreate&a=modal")
    .then((res) => res.text())
    .then((html) => {
      document.getElementById("modalBody").innerHTML = html;

      document.getElementById("modalPerfil").style.display = "flex";
    });
}

function VerFicha(idMascota) {
  fetch(`index.php?c=Pets&f=Records&a=modal&id=${idMascota}`)
    .then((res) => res.text())
    .then((html) => {
      document.getElementById("modalBody").innerHTML = html;

      document.getElementById("modalPerfil").style.display = "flex";
    });
}
function VerHistorial(idMascota) {
  fetch(`index.php?c=Pets&f=HistoryPet&a=modal&id=${idMascota}`)
    .then((res) => res.text())
    .then((html) => {
      document.getElementById("modalBody").innerHTML = html;

      document.getElementById("modalPerfil").style.display = "flex";
      renderCalendar();
    })
    .catch((err) => console.error(err));
}

function AgendarCita(idMascota) {
  fetch(`index.php?c=Pets&a=modal&f=AddQuotesPet&id=${idMascota}`)
    .then((res) => res.text())
    .then((html) => {
      document.getElementById("modalBody").innerHTML = html;

      document.getElementById("modalPerfil").style.display = "flex";
    });
}
function EditarCita(idMascota, IdCita) {
  fetch(
    `index.php?c=Pets&f=EditCitasMascotas&a=modal&idm=${idMascota}&idc=${IdCita}`,
  )
    .then((res) => res.text())
    .then((html) => {
      document.getElementById("modalBody").innerHTML = html;

      document.getElementById("modalPerfil").style.display = "flex";
    });
}
function EditarVacuna(idMascota, IdVacuna) {
  fetch(
    `index.php?c=Pets&f=ControlEditPets&a=modal&id=${idMascota}&idv=${IdVacuna}&tipo=vacuna`,
  )
    .then((res) => res.text())
    .then((html) => {
      document.getElementById("modalBody").innerHTML = html;

      document.getElementById("modalPerfil").style.display = "flex";
    });
}
function EditarCarta(idMascota, IdVacuna) {
  fetch(
    `index.php?c=Pets&f=ControlEditPets&a=modal&id=${idMascota}&idv=${IdVacuna}&tipo=carta`,
  )
    .then((res) => res.text())
    .then((html) => {
      document.getElementById("modalBody").innerHTML = html;

      document.getElementById("modalPerfil").style.display = "flex";
    });
}
function AgendarVacuna(idMascota) {
  fetch(` index.php?c=Pets&a=modal&f=AddCardVaccine&id=${idMascota}`)
    .then((res) => res.text())
    .then((html) => {
      document.getElementById("modalBody").innerHTML = html;

      document.getElementById("modalPerfil").style.display = "flex";
    });
}
function Cerrar() {
  document.getElementById("modalPerfil").style.display = "none";
}
document.addEventListener("DOMContentLoaded", () => {
  const badges = document.querySelectorAll(".estado");

  const clasesPorEstado = {
    Pagado: "estado-ok",
    Completado: "estado-ok",
    Pendiente: "estado-pendiente",
    Esperando: "estado-pendiente",
    "No Asistió": "estado-error",
  };

  badges.forEach((badge) => {
    const texto = badge.textContent.trim();

    const claseColor = clasesPorEstado[texto];

    if (claseColor) {
      badge.classList.add(claseColor);
    }
  });
});
