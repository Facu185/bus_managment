let contador = 0;
async function showNewForm() {
  contador++;
  const divOriginal = document.getElementById("form");
  const divDestino = document.getElementById("additionalForms");
  const elementosAInsertar = divOriginal.children;
  const divNuevo = document.createElement("div");

  let cont = contador - 1;
  if (cont == 0) {
    cont = "";
  }
  Array.from(elementosAInsertar).forEach((elemento) => {
    if (elemento.tagName.toLowerCase() === "select" || elemento.tagName.toLowerCase() === "input") {
      const clonedElement = elemento.cloneNode(true);
      clonedElement.name = `${clonedElement.name}${contador}`;
      clonedElement.id = `${clonedElement.id}${contador}`;
      if (clonedElement.id == `numeroParadaOrigen${contador}`) {
        let origen = document.getElementById(`numeroParadaDestino${cont}`);
        clonedElement.value = origen.value;
      } else {
        clonedElement.value = "";
      }

      divDestino.appendChild(clonedElement);
    }
  });
  divDestino.appendChild(divNuevo);
}

const showForm = document.getElementById("showFormButton").addEventListener("click", showNewForm);
