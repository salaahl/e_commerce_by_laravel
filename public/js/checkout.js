const stripe = Stripe(
    "pk_live_51OJQl9BWdqqNqzCqBphM4uRwqhDd6vkxVUDDDdh3DkE1WJVgouKASwhOfy3LYBR8PVoAZHXv1j3DPbago5ij0A1g00vDnHPFSM"
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
    });

    const { clientSecret } = await response.json();

    const checkout = await stripe.initEmbeddedCheckout({
        clientSecret,
    });

    // Mount Checkout
    checkout.mount("#checkout");
}
