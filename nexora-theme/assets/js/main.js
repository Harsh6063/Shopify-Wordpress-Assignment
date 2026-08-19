document.addEventListener("DOMContentLoaded", function () {
 const counters = document.querySelectorAll(".counter");

    const observer = new IntersectionObserver(function (entries) {

        entries.forEach(function (entry) {

            if (!entry.isIntersecting) return;

            const counter = entry.target;
            const target = parseInt(counter.getAttribute("data-target"));
            let current = 0;

            const duration = 1500;
            const increment = Math.max(1, target / 100);

            function updateCounter() {

                current += increment;

                if (current < target) {

                    counter.textContent = Math.floor(current);

                    requestAnimationFrame(updateCounter);

                } else {

                    counter.textContent = target;

                }

            }

            updateCounter();

            observer.unobserve(counter);

        });

    }, {
        threshold: 0.4
    });

    counters.forEach(function (counter) {
        observer.observe(counter);
    });

    const menuButton = document.querySelector(".mobile-menu-toggle");
    const navigation = document.querySelector(".desktop-nav");

    if (menuButton && navigation) {

        menuButton.addEventListener("click", function () {

            navigation.classList.toggle("active");

            const isOpen =
                navigation.classList.contains("active");

            menuButton.setAttribute(
                "aria-expanded",
                isOpen
            );

            menuButton.innerHTML = isOpen ? "✕" : "☰";

        });

    }

});
