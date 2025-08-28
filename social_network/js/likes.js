document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".post__like-button").forEach(button => {
        button.addEventListener("click", async () => {
            const post = button.closest(".post");
            const postId = post.dataset.postId;
            const counter = button.querySelector(".post__like-counter");

            const hasLiked = button.classList.contains("liked");
            const action = hasLiked ? "remove" : "add";

            try {
                const formData = new FormData();
                formData.append("post_id", postId);
                formData.append("action", action);

                const response = await fetch("/api/like.php", {
                    method: "POST",
                    body: formData
                });

                if (!response.ok) throw new Error("HTTP " + response.status);

                const result = await response.json();

                if (result.success) {
                    counter.textContent = result.likes;
                    button.classList.toggle("liked", action === "add");
                } else {
                    showError(post, result.error || "Ошибка");
                }
            } catch (e) {
                showError(post, "Сеть недоступна: " + e.message);
            }
        });
    });
});

function showError(post, text) {
    let err = post.querySelector(".post__error");
    if (!err) {
        err = document.createElement("p");
        err.className = "post__error";
        err.style.color = "red";
        post.appendChild(err);
    }
    err.textContent = text;
}
