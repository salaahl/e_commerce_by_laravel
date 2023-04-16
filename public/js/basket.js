let quantity = document.querySelectorAll(".quantity");
let deleteArticle = document.querySelectorAll(".delete-article");

if (quantity) {
    quantity.forEach((select) => {
        select.addEventListener("change", () => {
            const url = "/basket/update";

            let data = {
                reference: select.closest(".article").querySelector("form")
                    .lastElementChild.value,
                quantity: select.value,
            };

            let options = {
                method: "POST",
                body: JSON.stringify(data),
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'input[name="_token"]'
                    ).value,
                    "Content-Type": "application/json",
                },
            };

            fetch(url, options)
                .then((response) => {})
                .catch((error) => {
                    alert(
                        "Une erreur est survenue. Veuillez contacter l'administrateur du site."
                    );
                });
        });
    });
}

if (deleteArticle) {
    deleteArticle.forEach((article) => {
        article.addEventListener("submit", (e) => {
            e.preventDefault();
            const url = "/basket/destroy";
            let formData = new FormData(article);

            let data = {
                reference: formData.get("reference"),
            };

            let options = {
                method: "POST",
                body: JSON.stringify(data),
                headers: {
                    "X-CSRF-TOKEN": formData.get("_token"),
                    "Content-Type": "application/json",
                },
            };

            fetch(url, options)
                .then((data) => {
                    console.log(data);
                    alert("L'article a bien été supprimé.");
                })
                .catch((error) => {
                    alert(
                        "Une erreur est survenue. Veuillez contacter l'administrateur du site."
                    );
                });
        });
    });
}
