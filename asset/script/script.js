"use strict";

// ------------------------ Profil.php
const stockForm = document.getElementsByClassName('stock-form')[0];

// functions
function changeProfilElement(){
  if(this.parentNode != stockForm){
    civilCheck();
  }
  showOrHideElements(this.parentNode, 'show');
}

function showOrHideElements(form, action){
  let hiddenElements = form.getElementsByClassName('hidden');
  let profilElement = form.getElementsByClassName('profil-element');
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


// ------------------------ ficheproduit.php
// functions
function changePhoto(){
  let image_chemin = this.src;
  let photoprincipale = document.getElementsByClassName('main_produit_img')[0];
  photoprincipale.src = image_chemin;
}