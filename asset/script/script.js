"use strict";

// ------------------------ Profil.php
// Get all the elements
const modifyProfilButtons = document.getElementsByClassName('modifier-profil');
let previousChange;

// Add the listeners
for(let i = 0; i < modifyProfilButtons.length; i++){
  modifyProfilButtons[i].addEventListener("click", changeProfilElement);
}

// functions
function changeProfilElement(){
  let buttonValue = this.value;
  let form = document.getElementsByClassName(buttonValue)[0];

  showOrHideElements(form, 'show');
  if(previousChange){
    showOrHideElements(previousChange, 'hide');
  }

  previousChange = form;
}

function showOrHideElements(form, action){
  let hiddenElements = form.getElementsByClassName('hidden');
  let profilElement = form.getElementsByClassName('profil-element')[0];
  profilElement.style.display = (action == 'show') ? 'none' : 'block';

  for(let i = 0 ; i < hiddenElements.length ; i++){
    hiddenElements[i].style.display = (action == 'show') ? 'block' : 'none';
  }
}