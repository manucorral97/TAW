/*Se encarga de la función de la hamburguesa*/
/*Cambia las clases seleccionadas por las nuevas realizando los pasos indicados en estilo.css*/
const navSlide = () => {
  const burger = document.querySelector('.burger');
  const nav = document.querySelector('.nav-links');
  const navLinks = document.querySelectorAll('.nav-links li');

  burger.addEventListener("click", () => {
    nav.classList.toggle("nav-active");
    burger.classList.toggle('toggle');

    /*Controlamos la velocidad con la que aparecen los enlaces*/
    navLinks.forEach((link, index) => {
      if(link.style.animation) {
        link.style.animation = '';
      } else {
        link.style.animation = `navLinkFade 0.5s ease forwards ${index/7}s`;
      }
    });

  });
}

navSlide();
