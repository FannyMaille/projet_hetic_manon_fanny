"use strict";

// ------------------------ Profil.php
// Get all the elements
const modifyProfilButtons = document.getElementsByClassName('modifier-profil');
let previousChange;

modifyProfilButtons[0].addEventListener("click", changeProfilElement);

// functions
function changeProfilElement(){
  showOrHideElements('show');
  if(previousChange){
    showOrHideElements(previousChange, 'hide');
  }
}

function showOrHideElements(action){
  let hiddenElements = document.getElementsByClassName('hidden');
  let profilElement = document.getElementsByClassName('profil-element');
  for(let i = 0; i < profilElement.length; i++){
    profilElement[i].style.display = (action == 'show') ? 'none' : 'block';
  }
  for(let i = 0 ; i < hiddenElements.length ; i++){
    hiddenElements[i].style.display = (action == 'show') ? 'block' : 'none';
  }
} 

// ------------------------ ficheproduit.php
// Get all the elements
const miniatures = document.getElementsByClassName('second-produit-img');

// Add the listeners
for(let i = 0; i < miniatures.length; i++){
  miniatures[i].addEventListener("click", changePhoto);
}

// functions
function changePhoto(){
  let image_chemin = this.src;
  let photoprincipale = document.getElementsByClassName('main-produit-img')[0];
  photoprincipale.src = image_chemin;
}