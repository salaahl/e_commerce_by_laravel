let quantity = document.querySelectorAll(".quantity");
let deleteProduct = document.querySelectorAll(".delete-product");

// Mettre à jour la quantité
if (quantity) {
    quantity.forEach((select) => {
        select.addEventListener("change", () => {
            document.querySelector("#total h3").style.filter = 'blur(10px)';
            const url = "/basket/update";

            let data = {
                reference: select.closest(".product").querySelector("form")
                    .lastElementChild.value,
                quantity: select.value,
            };

            let options = {
                method: "PATCH",
                body: JSON.stringify(data),
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'input[name="_token"]'
                    ).value,
                    "Content-Type": "application/json",
                },
            };

            fetch(url, options)
                .then((response) => response.json())
                .then((data) => {
                    let total = 0;
                    quantity.forEach((price) => {
                        total +=
                            parseInt(
                                price
                                    .closest(".product")
                                    .querySelector(".price").innerHTML
                            ) * price.value;
                    });
                    document.querySelector("#total h3").innerHTML =
                        "Total : " + total + "€";
                    document.querySelector("#total h3").style.filter = 'blur(0px)';
                })
                .catch((error) => {
                    alert(
                        "Une erreur est survenue. Veuillez contacter l'administrateur du site."
                    );
                });
        });
    });
}

// Supprimer un article
if (deleteProduct) {
    deleteProduct.forEach((product) => {
        product.addEventListener("submit", (e) => {
            e.preventDefault();
            const url = "/basket/destroy";
            let formData = new FormData(product);

            let data = {
                reference: formData.get("reference"),
            };

            let options = {
                method: "DELETE",
                body: JSON.stringify(data),
                headers: {
                    "X-CSRF-TOKEN": formData.get("_token"),
                    "Content-Type": "application/json",
                },
            };

            fetch(url, options)
                .then((data) => {
                    alert("L'article a bien été supprimé. Veuillez rafraîchir la page.");
                })
                .catch((error) => {
                    alert(
                        "Une erreur est survenue. Veuillez contacter l'administrateur du site."
                    );
                });
        });
    });
}
