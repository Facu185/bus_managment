export async function fetchData() {
    try {
      const response = await fetch("../controllers/showBus.php");
      const data = await response.json(); // Obtén el conjunto de resultados completo
        console.log(data);
      const opcionesSelect1 = document.getElementById("matricula");
      

      data.forEach((row) => {
        const option1 = document.createElement("option");
        option1.value = row["ID_unidad"];
        option1.textContent = row["ID_unidad"];
        opcionesSelect1.appendChild(option1);

      });
    } catch (error) {
      console.error("Error al obtener datos:", error);
    }
}

fetchData();