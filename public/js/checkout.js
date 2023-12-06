const stripe = Stripe(
    "pk_test_51OJQl9BWdqqNqzCqIMxdVqwvnp6vtgIauO9UKLkVThKIvPj5NCtIz8LqHkIge0bfZS7oMY6exjhgCuRkP3jyGcBQ00zuUp5Q6q"
);

initialize();

// Create a Checkout Session as soon as the page loads
async function initialize() {
    const response = await fetch("/checkout", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('[name="csrf-token"]')
                .getAttribute("content"),
        },
    }).then(response => response.json())
    .then(result => {
      console.log(result)
    })
    .catch((error) => {
        console.log(error.message)
    });
}
