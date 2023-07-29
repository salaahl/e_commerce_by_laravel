if (document.querySelector("#add-basket")) {
    this.addEventListener("submit", (e) => {
        e.preventDefault();
        const url = "/basket/store";

        let data = {
            reference: document.getElementById("reference").value,
            quantity: document.getElementById("quantity").value,
        };

        let options = {
            method: "POST",
            body: JSON.stringify(data),
            headers: {
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                "Content-Type": "application/json",
            },
        };

        fetch(url, options)
            .then((response) => {
                console.log(response)
                alert("L'article a bien été ajouté au panier !");
            })
            .catch((error) => {
                console.log(error);
                alert(
                    "Une erreur est survenue. Veuillez contacter l'administrateur du site."
                );
            });
    });
}
