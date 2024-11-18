document.addEventListener('DOMContentLoaded', function () {
  const homeSection = document.querySelector('.home-section');
  const images = [
      'imgs/restaarant.jpg',
      'imgs/rest2.jpg',
      'imgs/rest3.jpg',
      'imgs/rest4.jpg',
      'imgs/rest5.jpg'
  ];
  let currentIndex = 0;

  // Create two div elements for background images
  const bg1 = document.createElement('div');
  const bg2 = document.createElement('div');
  bg1.className = 'background-image visible';
  bg2.className = 'background-image';

  homeSection.appendChild(bg1);
  homeSection.appendChild(bg2);

  function changeBackgroundImage() {
      const currentBg = currentIndex % 2 === 0 ? bg1 : bg2;
      const nextBg = currentIndex % 2 === 0 ? bg2 : bg1;

      nextBg.style.backgroundImage = `url('${images[currentIndex]}')`;

      setTimeout(() => {
          currentBg.classList.remove('visible');
          nextBg.classList.add('visible');
      }, 10); // Slight delay to trigger the CSS transition

      currentIndex = (currentIndex + 1) % images.length;
  }

  changeBackgroundImage(); // Initial call
  setInterval(changeBackgroundImage, 7000); // Change image every 7 seconds
});


document.addEventListener('DOMContentLoaded', function () {
  const navbarLinks = document.querySelectorAll('#navbar a');

  navbarLinks.forEach(link => {
      link.addEventListener('click', function () {
          // Remove the active class from all links
          navbarLinks.forEach(navLink => navLink.classList.remove('active'));

          // Add the active class to the clicked link
          this.classList.add('active');
      });
  });
});
