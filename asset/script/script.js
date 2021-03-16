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
  let hiddenElements = form.getElementsByClassName('hidden');
  let profilElement = form.getElementsByClassName('profil-element')[0];
  profilElement.style.display = 'none';

  for(let i = 0 ; i < hiddenElements.length ; i++){
    hiddenElements[i].style.display = "block";
  }

  if(previousChange){
    console.log('ok');
    let previousHiddenElements = previousChange.getElementsByClassName('hidden');
    let previousProfilElement = previousChange.getElementsByClassName('profil-element')[0];
    previousProfilElement.style.display = 'block';
    for(let i = 0 ; i < previousHiddenElements.length ; i++){
      previousHiddenElements[i].style.display = "none";
    }
  }

  previousChange = form;
}