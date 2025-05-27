document.addEventListener("DOMContentLoaded", function () {
  const swiperContainers = document.querySelectorAll(".swiper-container")

  swiperContainers.forEach((container) => {
    new Swiper(container, {
      slidesPerView: 1,
      navigation: true,
      pagination: {
        clickable: true,
        el: container.querySelector(".swiper-pagination"),
      },
      autoplay: {
        delay: 5000, // Adjust the autoplay delay as needed
      },
      loop: true, // Infinite loop
    })
  })
})
