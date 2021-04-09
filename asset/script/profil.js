"use strict";

//Pour attendre le chargement de la page
document.addEventListener('DOMContentLoaded', (event) => {
  // Get all the elements
  const modifyProfilButtons = document.getElementById('modifier-profil');
  const modifyStockButtons = document.getElementsByClassName('modify-stock');
  const undoModify = document.getElementsByClassName('undo-modify');

  // Add the listeners
  modifyProfilButtons.addEventListener("click", changeProfilElement);

  for(let i = 0 ; i < modifyStockButtons.length ; i++){
    modifyStockButtons[i].addEventListener("click", changeProfilElement);
    undoModify[i].addEventListener("click", changeProfilElement);
    event.preventDefault();
  }
});




// Drag n Drop pictures
const dropSpace = document.getElementsByClassName('drop-space')[0];
const addProductForm = document.getElementsByClassName('add-produit-form')[0];
const imagePreviewSpace = document.getElementById("image-preview");
// let imageInput = document.getElementsByName('imagesurl')[0];
// imageInput.accept = "image/*";

// Enlever les evenements par défaut au drop
dropSpace.addEventListener('dragenter', preventDefault, false);
dropSpace.addEventListener('dragleave', preventDefault, false);
dropSpace.addEventListener('dragover', preventDefault, false);
dropSpace.addEventListener('drop', preventDefault, false);

// Ajouter les écouteurs
dropSpace.addEventListener('drop', handleDrop, false);
dropSpace.addEventListener("click", function() {
  fakeInput.click();
});

let fakeInput = document.createElement('input');
fakeInput.accept = "image/*";
fakeInput.type = 'file';
fakeInput.multiple = 'true';

// let fakeInput = addProductForm.appendChild(document.createElement("input"));
// fakeInput.type = "file";
// fakeInput.classList.add('hidden');
// fakeInput.accept = "image/*";
// fakeInput.multiple = true;
// fakeInput.name = "jenaimarre";

let formData, ajax, files;
let allFiles = [], j = 0;

//functions
function preventDefault(e) {
  e.preventDefault();
  e.stopPropagation();
}

// fakeInput.addEventListener("change", function() {
//   let files = fakeInput.files;
//   handleFiles(files);
// });

fakeInput.addEventListener("change", function() {
  // allFiles.push(this.files[0]);
  files = this.files;
  handleFiles(files);
});

function handleDrop(e) {
  let data = e.dataTransfer, files = data.files;
  handleFiles(files)      
}

// function handleFiles(files) {
//   for (let i = 0, len = files.length; i < len; i++) {
//     if (validateImage(files[i])) previewAnduploadImage(files[i]);
//   }
// }


function handleFiles(files) {
  for (let i = 0 ; i < files.length; i++) {
    if (validateImage(files[i])){ 
      previewAnduploadImage(files[i]);
      let newInput = document.createElement('input');
      newInput.type = 'file';
      newInput.accept = "image/*";
      newInput.classList.add('hidden');
      newInput.name = 'image-url-' + j;
      newInput.files = files;
      j++;
      addProductForm.appendChild(newInput);
    };
  }
}

function validateImage(image) {
  // check the type
  let validTypes = ['image/jpeg', 'image/png'];
  if (validTypes.indexOf( image.type ) === -1) {
    return false;
  }

  // check the size
  var maxSizeInBytes = 10e6; // 10MB
  if (image.size > maxSizeInBytes) {
    return false;
  }

  return true;
}

function previewAnduploadImage(image) {
 
  // container
  let imgView = document.createElement("div");
  imgView.className = "image-view";
  imagePreviewSpace.appendChild(imgView);

  let img = document.createElement("img");
  imgView.appendChild(img);

  let overlay = document.createElement("div");
  overlay.className = "overlay";
  imgView.appendChild(overlay);

  // read the pic
  let reader = new FileReader();
  reader.onload = function(e) {
    img.src = e.target.result;
  }
  reader.readAsDataURL(image); 
}
