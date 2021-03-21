"use strict";

//Pour attendre le chargement de la page
document.addEventListener('DOMContentLoaded', (event) => {
  // Get all the elements
  const modifyProfilButtons = document.getElementById('modifier-profil');
  let previousChange;

  // Add the listeners
  modifyProfilButtons.addEventListener("click", changeProfilElement);
});