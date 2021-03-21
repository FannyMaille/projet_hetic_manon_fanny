"use strict";

// ------------------------ Profil.php
// Get all the elements
const modifyProfilButtons = document.getElementsByClassName('modifier-profil');
let previousChange;

modifyProfilButtons[0].addEventListener("click", changeProfilElement);

// functions
function changeProfilElement(){
  civilCheck();
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


function civilCheck(){
  //element qui a le N° de la civilité dans sa value
  let numciv = document.getElementById('civnum');
  //Check la civilité qui a comme id civ eet le numéro de civilité
  document.getElementById('civ'+numciv.value).checked=true;
}


function civilCheckfanny(){
  let civilite = document.getElementsByClassName('radiocivil');
  let motcivil = document.getElementById('civnum');
  for(let i = 0; i < civilite.length; i++){
    if(motcivil.value == civilite[i].value){
      civilite[i].setAttribute("checked", "true");
      break;
    }
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