/* import login from "./modules/login.js";
login(); */
import translate from "./modules/translations.js";

if (!localStorage.getItem("lang")) {
  localStorage.setItem("lang", "ES");
  translate("ES");
} else {
  const language = localStorage.getItem("lang");
  console.log(language);
  translate(language);
}

if (document.getElementById("enHome")) {
  document.getElementById("enHome").addEventListener("click", (e) => {
    e.preventDefault();
    localStorage.setItem("lang", "EN");
    location.reload();
  });
}
if (document.getElementById("enTravel")) {
  document.getElementById("enTravel").addEventListener("click", (e) => {
    e.preventDefault();
    localStorage.setItem("lang", "EN");
    location.reload();
  });
}
if (document.getElementById("enProfile")) {
  document.getElementById("enProfile").addEventListener("click", (e) => {
    e.preventDefault();
    localStorage.setItem("lang", "EN");
    location.reload();
  });
}
if (document.getElementById("enAbout")) {
  document.getElementById("enAbout").addEventListener("click", (e) => {
    e.preventDefault();
    localStorage.setItem("lang", "EN");
    location.reload();
  });
}
if (document.getElementById("enServices")) {
  document.getElementById("enServices").addEventListener("click", (e) => {
    e.preventDefault();
    localStorage.setItem("lang", "EN");
    location.reload();
  });
}
if (document.getElementById("enContact")) {
  document.getElementById("enContact").addEventListener("click", (e) => {
    e.preventDefault();
    localStorage.setItem("lang", "EN");
    location.reload();
  });
}

if (document.getElementById("esHome")) {
  document.getElementById("esHome").addEventListener("click", (e) => {
    e.preventDefault();
    localStorage.setItem("lang", "ES");
    location.reload();
  });
}
if (document.getElementById("esTravel")) {
  document.getElementById("esTravel").addEventListener("click", (e) => {
    e.preventDefault();
    localStorage.setItem("lang", "ES");
    location.reload();
  });
}
if (document.getElementById("esProfile")) {
  document.getElementById("esProfile").addEventListener("click", (e) => {
    e.preventDefault();
    localStorage.setItem("lang", "ES");
    location.reload();
  });
}
if (document.getElementById("esAbout")) {
  document.getElementById("esAbout").addEventListener("click", (e) => {
    e.preventDefault();
    localStorage.setItem("lang", "ES");
    location.reload();
  });
}
if (document.getElementById("esServices")) {
  document.getElementById("esServices").addEventListener("click", (e) => {
    e.preventDefault();
    localStorage.setItem("lang", "ES");
    location.reload();
  });
}
if (document.getElementById("esContact")) {
  document.getElementById("esContact").addEventListener("click", (e) => {
    e.preventDefault();
    localStorage.setItem("lang", "ES");
    location.reload();
  });
}

if (document.getElementById("prHome")) {
  document.getElementById("prHome").addEventListener("click", (e) => {
    e.preventDefault();
    localStorage.setItem("lang", "PR");
    location.reload();
  });
}
if (document.getElementById("prTravel")) {
  document.getElementById("prTravel").addEventListener("click", (e) => {
    e.preventDefault();
    localStorage.setItem("lang", "PR");
    location.reload();
  });
}
if (document.getElementById("prProfile")) {
  document.getElementById("prProfile").addEventListener("click", (e) => {
    e.preventDefault();
    localStorage.setItem("lang", "PR");
    location.reload();
  });
}
if (document.getElementById("prAbout")) {
  document.getElementById("prAbout").addEventListener("click", (e) => {
    e.preventDefault();
    localStorage.setItem("lang", "PR");
    location.reload();
  });
}
if (document.getElementById("prServices")) {
  document.getElementById("prServices").addEventListener("click", (e) => {
    e.preventDefault();
    localStorage.setItem("lang", "PR");
    location.reload();
  });
}
if (document.getElementById("prContact")) {
  document.getElementById("prContact").addEventListener("click", (e) => {
    e.preventDefault();
    localStorage.setItem("lang", "PR");
    location.reload();
  });
}