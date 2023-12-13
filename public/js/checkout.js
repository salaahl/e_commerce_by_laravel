// This is your test publishable API key.
const stripe = Stripe(
    "pk_live_51OJQl9BWdqqNqzCqBphM4uRwqhDd6vkxVUDDDdh3DkE1WJVgouKASwhOfy3LYBR8PVoAZHXv1j3DPbago5ij0A1g00vDnHPFSM"
);

let user_email;
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
            "X-CSRF-TOKEN": document
                .querySelector('[name="csrf-token"]')
                .getAttribute("content"),
        },
    }).then((r) => r.json());

    const clientSecret = response.output.clientSecret;

    // Va être utilisé par la fonction handleSubmit
    user_email = response.output.email;

    // Customize the appearance of Elements using the Appearance API.
    const appearance = {
        theme: "flat",
    };

    // Enable the skeleton loader UI for the optimal loading experience.
    const loader = "auto";

    elements = stripe.elements({ clientSecret, appearance, loader });

    const addressOptions = {
        mode: "shipping",
        allowedCountries: ['FR'],
        contacts: [
            {
              name: 'response.output.name',
              address: {
                line1: response.output.address,
                city: 'Paris',
                state: 'Ile-de-France',
                postal_code: '75000',
                country: 'FR',
              },
            }
        ],
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
                    country: "FR",
                },
            },
            custom_text: {
                submit: {
                    message:
                        "We'll email you instructions on how to get started.",
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

    const error = await stripe.confirmPayment({
        elements,
        confirmParams: {
            // Make sure to change this to your payment completion page
            return_url: "http://localhost:8000/order/confirmation/",
            receipt_email: user_email,
        },
        redirect: 'if_required',
    });

    // This point will only be reached if there is an immediate error when
    // confirming the payment. Otherwise, your customer will be redirected to
    // your `return_url`. For some payment methods like iDEAL, your customer will
    // be redirected to an intermediate site first to authorize the payment, then
    // redirected to the `return_url`.
    if (error) {
        showMessage(error.message);
    } else {
        window.location = '/order';
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
