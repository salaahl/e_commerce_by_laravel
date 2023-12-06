initialize();

async function initialize() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const sessionId =
        "cs_test_a1pUHcVFcJefoxoA5WAonV9dVy6CvyuJdJiePPoOpAGHT0FKqW6MkTQFPm";
    const response = await fetch("/status", {
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('[name="csrf-token"]')
                .getAttribute("content"),
        },
        method: "POST",
        body: JSON.stringify({ session_id: sessionId }),
    });
    const session = await response.json();

    if (session.status == "open") {
        window.replace("http://localhost:8000/checkout");
    } else if (session.status == "complete") {
        document.getElementById("success").classList.remove("hidden");
        document.getElementById("customer-email").textContent =
            session.customer_email;
    }
}
