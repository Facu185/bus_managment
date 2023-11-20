const burger = document.getElementById("burgerdiv");
burger.addEventListener("click", () => {
  const sidebar = document.querySelector(".admin__sidebar");
  if (sidebar.classList.contains("active")) {
    sidebar.classList.remove("active");
    const title = document.querySelector(".sidebar__title");
    title.style.justifyContent = "space-between";
    document.querySelector(".logoHead").style.display = "block";
    document.getElementById("dashboard").innerHTML =
      '<i class="fa-solid fa-chart-column"></i> Estadisticas';
    document.getElementById("users").innerHTML =
      '<i class="fa-solid fa-user"></i> Usuarios';
    document.getElementById("units").innerHTML =
      '<i class="fa-solid fa-bus"></i> Unidades';
    document.getElementById("section").innerHTML =
      '<i class="fa-solid fa-road"></i> Tramos';
    document.getElementById("stops").innerHTML =
      '<i class="fa-solid fa-building"></i> Paradas';
    document.getElementById("routes").innerHTML =
      '<i class="fa-solid fa-route"></i> Recorridos';
    document.getElementById("logout").innerHTML =
      '<i class="fa-solid fa-right-from-bracket"></i> Cerrar sesion';
    if (
      document.getElementById("registerAdmin") ||
      document.getElementById("eliminarUsuarios") ||
      document.getElementById("manageReservations")
    ) {
      document.getElementById("registerAdmin").innerHTML =
        "<i class='fa-solid fa-star'></i> Registrar admin";
      document.getElementById("eliminarUsuarios").innerHTML =
        "<i class='fa-solid fa-screwdriver-wrench'></i> Administrar usuario";
      document.getElementById("manageReservations").innerHTML =
        "<i class='fa-solid fa-list-check'></i> Gestionar reservas";
    }
    if (
      document.getElementById("addUnit") ||
      document.getElementById("updateBus") ||
      document.getElementById("deleteBus")
    ) {
      document.getElementById("addUnit").innerHTML =
        "<i class='fa-solid fa-plus'></i> Agregar unidades";
      document.getElementById("updateBus").innerHTML =
        "<i class='fa-solid fa-screwdriver-wrench'></i> Modificar unidades";
      document.getElementById("deleteBus").innerHTML =
        "<i class='fa-solid fa-eraser'></i> Eliminar unidades";
    }
    if (
      document.getElementById("addSection") ||
      document.getElementById("updateSection") ||
      document.getElementById("deleteSection")
    ) {
      document.getElementById("addSection").innerHTML =
        "<i class='fa-solid fa-plus'></i> Agregar tramos";
      document.getElementById("updateSection").innerHTML =
        "<i class='fa-solid fa-screwdriver-wrench'></i> Modificar tramos";
      document.getElementById("deleteSection").innerHTML =
        "<i class='fa-solid fa-eraser'></i> Eliminar tramo";
    }
    if (
      document.getElementById("addStops") ||
      document.getElementById("updateStops") ||
      document.getElementById("deleteStops")
    ) {
      document.getElementById("addStops").innerHTML =
        "<i class='fa-solid fa-plus'></i> Agregar paradas";
      document.getElementById("updateStops").innerHTML =
        "<i class='fa-solid fa-screwdriver-wrench'></i> Modificar paradas";
      document.getElementById("deleteStops").innerHTML =
        "<i class='fa-solid fa-eraser'></i> Eliminar parada";
    }
    if (
      document.getElementById("addRoutes") ||
      document.getElementById("updateRoutes") ||
      document.getElementById("updateLine") ||
      document.getElementById("deleteLine") ||
      document.getElementById("addNewRoutes")
    ) {
      document.getElementById("addRoutes").innerHTML =
        "<i class='fa-solid fa-plus'></i> Agregar recorrido";
      document.getElementById("updateRoutes").innerHTML =
        "<i class='fa-solid fa-screwdriver-wrench'></i> Modificar o eliminar";
      document.getElementById("updateLine").innerHTML =
        "<i class='fa-solid fa-screwdriver-wrench'></i> Modificar linea";
      document.getElementById("deleteLine").innerHTML =
        "<i class='fa-solid fa-eraser'></i> Eliminar linea";
      document.getElementById("addNewRoutes").innerHTML =
        "<i class='fa-solid fa-plus'></i> Agregar a un recorrido";
    }
  } else {
    sidebar.classList.add("active");
    const title = document.querySelector(".sidebar__title");
    title.style.display = "flex";
    title.style.alignItems = "center";
    title.style.justifyContent = "center";
    title.style.width = "100%";
    document.querySelector(".logoHead").style.display = "none";
    document.getElementById("dashboard").innerHTML =
      '<i class="fa-solid fa-chart-column"></i>';
    document.getElementById("users").innerHTML =
      '<i class="fa-solid fa-user"></i>';
    document.getElementById("units").innerHTML =
      '<i class="fa-solid fa-bus"></i>';
    document.getElementById("section").innerHTML =
      '<i class="fa-solid fa-road"></i>';
    document.getElementById("stops").innerHTML =
      '<i class="fa-solid fa-building"></i>';
    document.getElementById("routes").innerHTML =
      '<i class="fa-solid fa-route"></i>';
    document.getElementById("logout").innerHTML =
      '<i class="fa-solid fa-right-from-bracket"></i>';
    if (
      document.getElementById("registerAdmin") ||
      document.getElementById("eliminarUsuarios") ||
      document.getElementById("manageReservations")
    ) {
      document.getElementById("registerAdmin").innerHTML =
        "<i class='fa-solid fa-star'></i>";
      document.getElementById("eliminarUsuarios").innerHTML =
        "<i class='fa-solid fa-screwdriver-wrench'></i>";
      document.getElementById("manageReservations").innerHTML =
        "<i class='fa-solid fa-list-check'></i>";
    }
    if (
      document.getElementById("addUnit") ||
      document.getElementById("updateBus") ||
      document.getElementById("deleteBus")
    ) {
      document.getElementById("addUnit").innerHTML =
        "<i class='fa-solid fa-plus'></i>";
      document.getElementById("updateBus").innerHTML =
        "<i class='fa-solid fa-screwdriver-wrench'></i>";
      document.getElementById("deleteBus").innerHTML =
        "<i class='fa-solid fa-eraser'></i>";
    }
    if (
      document.getElementById("addSection") ||
      document.getElementById("updateSection") ||
      document.getElementById("deleteSection")
    ) {
      document.getElementById("addSection").innerHTML =
        "<i class='fa-solid fa-plus'></i>";
      document.getElementById("updateSection").innerHTML =
        "<i class='fa-solid fa-screwdriver-wrench'></i>";
      document.getElementById("deleteSection").innerHTML =
        "<i class='fa-solid fa-eraser'></i>";
    }
    if (
      document.getElementById("addStops") ||
      document.getElementById("updateStops") ||
      document.getElementById("deleteStops")
    ) {
      document.getElementById("addStops").innerHTML =
        "<i class='fa-solid fa-plus'></i>";
      document.getElementById("updateStops").innerHTML =
        "<i class='fa-solid fa-screwdriver-wrench'></i>";
      document.getElementById("deleteStops").innerHTML =
        "<i class='fa-solid fa-eraser'></i>";
    }
    if (
        document.getElementById("addRoutes") ||
        document.getElementById("updateRoutes") ||
        document.getElementById("updateLine") ||
        document.getElementById("deleteLine") ||
        document.getElementById("addNewRoutes")
      ) {
        document.getElementById("addRoutes").innerHTML =
          "<i class='fa-solid fa-plus'></i>";
        document.getElementById("updateRoutes").innerHTML =
          "<i class='fa-solid fa-screwdriver-wrench'></i>";
        document.getElementById("updateLine").innerHTML =
          "<i class='fa-solid fa-screwdriver-wrench'></i>";
        document.getElementById("deleteLine").innerHTML =
          "<i class='fa-solid fa-eraser'></i>";
        document.getElementById("addNewRoutes").innerHTML =
          "<i class='fa-solid fa-plus'></i>";
      }
  }
});

const users = document.getElementById("users");
const usersList = document.getElementById("usersList");
users.addEventListener("click", () => {
  if (!usersList.querySelector("#registerAdmin")) {
    let registerAdmin = document.createElement("a");
    let liregisterAdmin = document.createElement("li");
    registerAdmin.id = "registerAdmin";
    registerAdmin.innerHTML =
      "<i class='fa-solid fa-star'></i> Registrar admin";
    registerAdmin.setAttribute("href", "../pages/register_admin.php");
    liregisterAdmin.appendChild(registerAdmin);
    usersList.appendChild(liregisterAdmin);
  }

  if (!usersList.querySelector("#eliminarUsuarios")) {
    let eliminarUsuarios = document.createElement("a");
    let lieliminarUsuarios = document.createElement("li");
    eliminarUsuarios.id = "eliminarUsuarios";
    eliminarUsuarios.innerHTML =
      "<i class='fa-solid fa-screwdriver-wrench'></i> Administrar usuario";
    eliminarUsuarios.setAttribute("href", "../pages/clients.php");
    lieliminarUsuarios.appendChild(eliminarUsuarios);
    usersList.appendChild(lieliminarUsuarios);
  }

  if (!usersList.querySelector("#manageReservations")) {
    let manageReservations = document.createElement("a");
    let limanage = document.createElement("li");
    manageReservations.id = "manageReservations";
    manageReservations.innerHTML =
      "<i class='fa-solid fa-list-check'></i> Gestionar reservas";
    manageReservations.setAttribute("href", "../pages/manageReservations.php");
    limanage.appendChild(manageReservations);
    usersList.appendChild(limanage);
  }
});
const units = document.getElementById("units");
const unitsList = document.getElementById("unitsList");
units.addEventListener("click", () => {
  if (!unitsList.querySelector("#addUnit")) {
    let addUnit = document.createElement("a");
    let liunits = document.createElement("li");
    addUnit.id = "addUnit";
    addUnit.innerHTML = "<i class='fa-solid fa-plus'></i> Agregar unidades";
    addUnit.setAttribute("href", "../pages/add_bus.php");
    liunits.appendChild(addUnit);
    unitsList.appendChild(liunits);
  }

  if (!unitsList.querySelector("#updateBus")) {
    let updateBus = document.createElement("a");
    let liupdateBus = document.createElement("li");
    updateBus.id = "updateBus";
    updateBus.innerHTML =
      "<i class='fa-solid fa-screwdriver-wrench'></i> Modificar unidades";
    updateBus.setAttribute("href", "../pages/modifyBus.php");
    liupdateBus.appendChild(updateBus);
    unitsList.appendChild(liupdateBus);
  }

  if (!unitsList.querySelector("#deleteBus")) {
    let deleteBus = document.createElement("a");
    let lideleteBus = document.createElement("li");
    deleteBus.id = "deleteBus";
    deleteBus.innerHTML =
      "<i class='fa-solid fa-eraser'></i> Eliminar unidades";
    deleteBus.setAttribute("href", "../pages/deleteBus.php");
    lideleteBus.appendChild(deleteBus);
    unitsList.appendChild(lideleteBus);
  }
});

const section = document.getElementById("section");
const sectionList = document.getElementById("sectionList");

section.addEventListener("click", () => {
  if (!sectionList.querySelector("#addSection")) {
    let addSection = document.createElement("a");
    let liaddSection = document.createElement("li");
    addSection.id = "addSection";
    addSection.innerHTML = "<i class='fa-solid fa-plus'></i> Agregar tramos";
    addSection.setAttribute("href", "../pages/addSection.php");
    liaddSection.appendChild(addSection);
    sectionList.appendChild(liaddSection);
  }

  if (!sectionList.querySelector("#updateSection")) {
    let updateSection = document.createElement("a");
    let liupdateSection = document.createElement("li");
    updateSection.id = "updateSection";
    updateSection.innerHTML =
      "<i class='fa-solid fa-screwdriver-wrench'></i> Modificar tramos";
    updateSection.setAttribute("href", "../pages/modifySection.php");
    liupdateSection.appendChild(updateSection);
    sectionList.appendChild(liupdateSection);
  }

  if (!sectionList.querySelector("#deleteSection")) {
    let deleteSection = document.createElement("a");
    let lideleteSection = document.createElement("li");
    deleteSection.id = "deleteSection";
    deleteSection.innerHTML =
      "<i class='fa-solid fa-eraser'></i> Eliminar tramo";
    deleteSection.setAttribute("href", "../pages/deleteSection.php");
    lideleteSection.appendChild(deleteSection);
    sectionList.appendChild(lideleteSection);
  }
});

const stops = document.getElementById("stops");
const stopsList = document.getElementById("stopsList");
stops.addEventListener("click", () => {
  if (!stopsList.querySelector("#addStops")) {
    let addStops = document.createElement("a");
    let liaddStops = document.createElement("li");
    addStops.id = "addStops";
    addStops.innerHTML = "<i class='fa-solid fa-plus'></i> Agregar paradas";
    addStops.setAttribute("href", "../pages/addBusStop.php");
    liaddStops.appendChild(addStops);
    stopsList.appendChild(liaddStops);
  }

  if (!stopsList.querySelector("#updateStops")) {
    let updateStops = document.createElement("a");
    let liupdateStops = document.createElement("li");
    updateStops.id = "updateStops";
    updateStops.innerHTML =
      "<i class='fa-solid fa-screwdriver-wrench'></i> Modificar paradas";
    updateStops.setAttribute("href", "../pages/modifyBusStop.php");
    liupdateStops.appendChild(updateStops);
    stopsList.appendChild(liupdateStops);
  }

  if (!stopsList.querySelector("#deleteStops")) {
    let deleteStops = document.createElement("a");
    let lideleteStops = document.createElement("li");
    deleteStops.id = "deleteStops";
    deleteStops.innerHTML =
      "<i class='fa-solid fa-eraser'></i> Eliminar parada";
    deleteStops.setAttribute("href", "../pages/deleteBusStop.php");
    lideleteStops.appendChild(deleteStops);
    stopsList.appendChild(lideleteStops);
  }
});

const routes = document.getElementById("routes");
const routesList = document.getElementById("routesList");
routes.addEventListener("click", () => {
  if (!routesList.querySelector("#addRoutes")) {
    let addRoutes = document.createElement("a");
    let liaddRoutes = document.createElement("li");
    addRoutes.id = "addRoutes";
    addRoutes.innerHTML = "<i class='fa-solid fa-plus'></i> Agregar recorrido";
    addRoutes.setAttribute("href", "../pages/addRoutes.php");
    liaddRoutes.appendChild(addRoutes);
    routesList.appendChild(liaddRoutes);
  }

  if (!routesList.querySelector("#updateRoutes")) {
    let updateRoutes = document.createElement("a");
    let liupdateRoutes = document.createElement("li");
    updateRoutes.id = "updateRoutes";
    updateRoutes.innerHTML =
      "<i class='fa-solid fa-screwdriver-wrench'></i> Modificar o eliminar";
    updateRoutes.setAttribute("href", "../pages/modifyRoute.php");
    liupdateRoutes.appendChild(updateRoutes);
    routesList.appendChild(liupdateRoutes);
  }
  if (!routesList.querySelector("#updateLine")) {
    let updateLine = document.createElement("a");
    let liupdateLine = document.createElement("li");
    updateLine.id = "updateLine";
    updateLine.innerHTML =
      "<i class='fa-solid fa-screwdriver-wrench'></i> Modificar linea";
    updateLine.setAttribute("href", "../pages/modifyLine.php");
    liupdateLine.appendChild(updateLine);
    routesList.appendChild(liupdateLine);
  }
  if (!routesList.querySelector("#deleteLine")) {
    let deleteLine = document.createElement("a");
    let lideleteLine = document.createElement("li");
    deleteLine.id = "deleteLine";
    deleteLine.innerHTML = "<i class='fa-solid fa-eraser'></i> Eliminar linea";
    deleteLine.setAttribute("href", "../pages/deleteLine.php");
    lideleteLine.appendChild(deleteLine);
    routesList.appendChild(lideleteLine);
  }
  if (!routesList.querySelector("#addNewRoutes")) {
    let addNewRoutes = document.createElement("a");
    let liaaddNewRoutes = document.createElement("li");
    addNewRoutes.id = "addNewRoutes";
    addNewRoutes.innerHTML =
      "<i class='fa-solid fa-plus'></i> Agregar a un recorrido";
    addNewRoutes.setAttribute("href", "../pages/addNewRoute.php");
    liaaddNewRoutes.appendChild(addNewRoutes);
    routesList.appendChild(liaaddNewRoutes);
  }
});
const hideAllLists = () => {
  usersList.style.display = "none";
  unitsList.style.display = "none";
  sectionList.style.display = "none";
  stopsList.style.display = "none";
  routesList.style.display = "none";
};
users.addEventListener("click", () => {
  hideAllLists();
  usersList.style.display = "block";
});

units.addEventListener("click", () => {
  hideAllLists();
  unitsList.style.display = "block";
});

section.addEventListener("click", () => {
  hideAllLists();
  sectionList.style.display = "block";
});

stops.addEventListener("click", () => {
  hideAllLists();
  stopsList.style.display = "block";
});

routes.addEventListener("click", () => {
  hideAllLists();
  routesList.style.display = "block";
});
