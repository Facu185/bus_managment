let contador = 0;
function agregar() {
    contador++;
    const divOriginal = document.getElementById("tramo_original");
    const divDestino = document.getElementById("nuevo_tramo");
    const elementosAInsertar = divOriginal.children;
    const divNuevo = document.createElement("div");

    Array.from(elementosAInsertar).forEach((elemento) => {
        if ( elemento.tagName.toLowerCase() === "select" || elemento.tagName.toLowerCase() === "input") {
          const clonedElement = elemento.cloneNode(true);
          clonedElement.name = `${clonedElement.name}${contador}`;
          clonedElement.id = `${clonedElement.id}${contador}`;
          divDestino.appendChild(clonedElement);
        }
      });
      divDestino.appendChild(divNuevo);
}
    const showForm = document.getElementById("showTramoButton").addEventListener("click", agregar);
