document.addEventListener("DOMContentLoaded", () => {
    const stars = document.querySelectorAll(".reviewStar");

    stars.forEach((star, index) => {
        star.addEventListener("change", () => {
            if (star.checked) {
                for (let i = 0; i <= index; i++) {
                    stars[i].checked = true;
                }
            } else {
                for (let i = index; i < stars.length; i++) {
                    stars[i].checked = false;
                }
            }
        });
    });
});
