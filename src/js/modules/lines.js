  export async function fetchData() {
    try {
      const response = await fetch("../controllers/showLines.php");
      const data = await response.json();
        console.log(data);
      const opcionesSelect1 = document.getElementById("lines");
      

      data.forEach((row) => {
        const option1 = document.createElement("option");
        option1.value = row["ID_linea"];
        option1.textContent = row["nombre_linea"];
        opcionesSelect1.appendChild(option1);

      });
    } catch (error) {
      console.error("Error al obtener datos:", error);
    }
}

fetchData();