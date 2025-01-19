const editBtn = document.querySelectorAll(".editBtn");
const modals = document.querySelectorAll(".modal");
const blurContainer = document.querySelector(".blur-container");

editBtn.forEach((item) => {
    item.addEventListener("click", () => {
        const id = item.getAttribute("data-id");
        const modal = document.querySelector(`.modal[data-id="${id}"]`);
        if (modal) {
            modal.classList.remove("hidden");
            blurContainer.classList.add("blur");
        }
    });
});

document.querySelectorAll(".closeModal").forEach((button) => {
    button.addEventListener("click", () => {
        const modal = button.closest(".modal");
        if (modal) {
            modal.classList.add("hidden");
            blurContainer.classList.remove("blur");
        }
    });
});

const closeMsg = document.querySelector(".closeMsg");
const messageMdl = document.querySelector(".messageMdl");
closeMsg.addEventListener("click", function () {
    messageMdl.classList.toggle("hidden");
});
