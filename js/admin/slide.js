var swiper = new Swiper(".mySwiper", {
    slidesPerView: 4.2,
    breakpoints: {
        320: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            370: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            425: {
                slidesPerView: 1.1,
                spaceBetween: 20,
            },

            640: {
                slidesPerView: 1.7,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2.1,
                spaceBetween: 20,
            },

            1024: {
                slidesPerView: 4.2,
                spaceBetween: 10,
            },
    },
    spaceBetween: 25,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
});