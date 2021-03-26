"use strict";

//Pour attendre le chargement de la page
document.addEventListener('DOMContentLoaded', (event) => {
  // Get all the elements
  const modifyProfilButtons = document.getElementById('modifier-profil');
  const modifyStockButtons = document.getElementsByClassName('modify-stock');

  // Add the listeners
  modifyProfilButtons.addEventListener("click", changeProfilElement);

  for(let i = 0 ; i < modifyStockButtons.length ; i++){
  modifyStockButtons[i].addEventListener("click", changeProfilElement);
  event.preventDefault();
  }
});

