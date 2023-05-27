(() => {

  let d = document;

  d.addEventListener('click', (e) => {
    if (e.target.matches('.item-test-dimensions')) {
      alert('DAAAAAAAAAM, ITS WORKSSSSS !!!');
    }
  });

  const fadeTarget = d.querySelector('.item-dimensions');

  const fadeOutEffect = () => {
    let fadeEffect = setInterval(() => {
      if (!fadeTarget.style.opacity) {
        fadeTarget.style.opacity = 1;
      }
      if (fadeTarget.style.opacity > 0) {
        fadeTarget.style.opacity -= 0.1;
      } else {
        clearInterval(fadeEffect);
      }
    }, 50)
  }

  fadeTarget.addEventListener('click', fadeOutEffect);

})()
