export async function fetchData() {
  try {
    const response = await fetch("../controllers/numberBusStop.php");
    const opciones = await response.json();

    const opcionesSelect1 = document.getElementById("numeroParadaOrigen");
    const opcionesSelect2 = document.getElementById("numeroParadaDestino");

    opciones.forEach((opcion) => {
      const option1 = document.createElement("option");
      option1.value = opcion;
      option1.textContent = opcion;
      opcionesSelect1.appendChild(option1);
      

      const option2 = document.createElement("option");
      option2.value = opcion;
      option2.textContent = opcion;
      opcionesSelect2.appendChild(option2);
    });
  } catch (error) {
    console.error("Error al obtener datos:", error);
  }
}

fetchData();