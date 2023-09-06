// let currentIndex = 0;
// const items = document.querySelectorAll('.twm-h1-bnr-carousal .item');

// function showSlide(index) {
//   items.forEach((item, i) => {
//     console.log('item', item);
//     item.style.transform = `translateX(${100 * (i - index)}%)`;
//   });
// }

// function nextSlide() {
//   const numItems = items.length;
//   if (currentIndex < numItems - 1) {
//     currentIndex++;
//   } else {
//     currentIndex = 0; // Reset to the first slide when reaching the end
//   }
//   showSlide(currentIndex);
// }

// // Initial slide and set interval for automatic transition
// showSlide(currentIndex);
// setInterval(nextSlide, 3000); // Change slide every 3 seconds (adjust as needed)


function jobCategoriesCarousel() {
    const container = document.querySelector('.job-categories-carousel-container');
    const carousel = document.querySelector('.job-categories-carousel');
    const items = document.querySelectorAll('.job-categories-carousel .item');
    const numItems = items.length;
    const itemWidth = items[0].offsetWidth;
    let currentIndex = 0;

    function showSlide(index) {
        carousel.style.transform = `translateX(-${index * itemWidth}px)`;
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % numItems;
        showSlide(currentIndex);
    }

    // Set initial slide and interval for automatic transition
    showSlide(currentIndex);
    setInterval(nextSlide, 3000); // Change slide every 3 seconds (adjust as needed)
}

jobCategoriesCarousel();
