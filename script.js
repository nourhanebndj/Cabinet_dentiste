let menu=document.querySelector('#menu-btn');
let navbar=document.querySelector('.header .nav');

menu.onclick=()=>{
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
}
window.onscroll=()=>{
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
     
    if(window.scrollY>0){
        Headers.classList.add('active');
    }else{
        Headers.classList.remove('active');
    }
    }


  /*rating*/
  // script.js
function submitRating() {
    const ratingElements = document.getElementsByName('rating');
    let selectedRating = 0;

    for (const ratingElement of ratingElements) {
        if (ratingElement.checked) {
            selectedRating = parseInt(ratingElement.value);
            break;
        }
    }

    if (selectedRating > 0) {
        // Afficher le message de remerciement dans la div avec l'ID "message"
        const messageElement = document.getElementById('message');
        messageElement.textContent = `Merci de donner votre avis avec ${selectedRating} étoile(s) !`;
    } else {
        alert('Veuillez sélectionner une évaluation.');
    }
}
/*annonce*/
// JavaScript to start the animation after page load
document.addEventListener('DOMContentLoaded', function() {
    const announcementSlider = document.getElementById("announcementSlider");
    announcementSlider.style.animation = "slideLeft 15s"; // Adjust the animation duration as needed
  });
  