export async function fetchData() {
    try {
      const response = await fetch("../controllers/stopRoutes.php");
      const data = await response.json(); 

      const opcionesSelect1 = document.getElementById("numeroParadaOrigenTramo");

      data.forEach((row) => {
        const option1 = document.createElement("option");
        option1.value = row["ID_tramo"];
        option1.textContent = row["Numero_parada_1"]+" - "+row["Numero_parada_2"];
        opcionesSelect1.appendChild(option1);

      });
      if(document.getElementById("numeroParadaOrigenTramo2")){
        const opcionesSelect2 = document.getElementById("numeroParadaOrigenTramo2");
        data.forEach((row) => {
          const option2 = document.createElement("option");
          option2.value = row["ID_tramo"];
          option2.textContent = row["Numero_parada_1"]+" - "+row["Numero_parada_2"];
          opcionesSelect2.appendChild(option2);
  
        });
      }
    } catch (error) {
      console.error("Error al obtener datos:", error);
    }
}

fetchData();
