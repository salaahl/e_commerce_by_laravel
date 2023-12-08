// This is your test publishable API key.
const stripe = Stripe(
    "pk_test_51OJQl9BWdqqNqzCqIMxdVqwvnp6vtgIauO9UKLkVThKIvPj5NCtIz8LqHkIge0bfZS7oMY6exjhgCuRkP3jyGcBQ00zuUp5Q6q"
);

// The items the customer wants to buy
const items = [{ reference: "bleu_de_chanel" }];

let elements;

initialize();
checkStatus();

document
    .querySelector("#payment-form")
    .addEventListener("submit", handleSubmit);

// Fetches a payment intent and captures the client secret
async function initialize() {
    const response = await fetch("/checkout", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({ items }),
    }).then((r) => r.json());

    const clientSecret = response.output.clientSecret;

    // Customize the appearance of Elements using the Appearance API.
    const appearance = {
        theme: "flat",
    };

    // Enable the skeleton loader UI for the optimal loading experience.
    const loader = "auto";

    // Create an elements group from the Stripe instance, passing the clientSecret (obtained in step 2), loader, and appearance (optional).
    const elements = stripe.elements({ clientSecret, appearance, loader });

    const addressOptions = {
        mode: "shipping",
        defaultValues: {
            firstname: response.output.name,
            lastname: response.output.surname,
            address: {
                line1: response.output.address,
                country: "FR",
            },
        },
    };
    const paymentOptions = {
        defaultValues: {
            billingDetails: {
                name: response.output.name,
                email: response.output.email,
                address: {
                    line1: response.output.address,
                    country: 'FR',
                },
            },
        },
        layout: {
            type: "tabs",
            defaultCollapsed: false,
            radios: false,
            spacedAccordionItems: true,
        },
    };

    // Create Element instances
    const addressElement = elements.create("address", addressOptions);
    // Passing in defaultValues is optional, but useful if you want to prefill consumer information to
    // ease consumer experience.
    const paymentElement = elements.create("payment", paymentOptions);

    // Mount the Elements to their corresponding DOM node
    addressElement.mount("#address-element");
    paymentElement.mount("#payment-element");

    addressElement.focus();
}

async function handleSubmit(e) {
    e.preventDefault();
    setLoading(true);

    const { error } = await stripe.confirmPayment({
        elements,
        confirmParams: {
            // Make sure to change this to your payment completion page
            return_url: "/checkout",
            receipt_email: response.output.email,
        },
    });

    // This point will only be reached if there is an immediate error when
    // confirming the payment. Otherwise, your customer will be redirected to
    // your `return_url`. For some payment methods like iDEAL, your customer will
    // be redirected to an intermediate site first to authorize the payment, then
    // redirected to the `return_url`.
    if (error.type === "card_error" || error.type === "validation_error") {
        showMessage(error.message);
    } else {
        showMessage("An unexpected error occurred.");
    }

    setLoading(false);
}

// Fetches the payment intent status after payment submission
async function checkStatus() {
    const clientSecret = new URLSearchParams(window.location.search).get(
        "payment_intent_client_secret"
    );

    if (!clientSecret) {
        return;
    }

    const { paymentIntent } = await stripe.retrievePaymentIntent(clientSecret);

    switch (paymentIntent.status) {
        case "succeeded":
            showMessage("Payment succeeded!");
            break;
        case "processing":
            showMessage("Your payment is processing.");
            break;
        case "requires_payment_method":
            showMessage("Your payment was not successful, please try again.");
            break;
        default:
            showMessage("Something went wrong.");
            break;
    }
}

// ------- UI helpers -------

function showMessage(messageText) {
    const messageContainer = document.querySelector("#payment-message");

    messageContainer.classList.remove("hidden");
    messageContainer.textContent = messageText;

    setTimeout(function () {
        messageContainer.classList.add("hidden");
        messageContainer.textContent = "";
    }, 4000);
}

// Show a spinner on payment submission
function setLoading(isLoading) {
    if (isLoading) {
        // Disable the button and show a spinner
        document.querySelector("#submit").disabled = true;
        document.querySelector("#spinner").classList.remove("hidden");
        document.querySelector("#button-text").classList.add("hidden");
    } else {
        document.querySelector("#submit").disabled = false;
        document.querySelector("#spinner").classList.add("hidden");
        document.querySelector("#button-text").classList.remove("hidden");
    }
}
