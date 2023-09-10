// Get the form element
const expenseForm = document.getElementById("expense-form");

// Add an event listener for form submission
expenseForm.addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent the default form submission behavior

    // Get the input values
    const expenseName = document.getElementById("expense-name").value;
    const expenseAmount = parseFloat(document.getElementById("expense-amount").value);

    // Validate the input
    if (!expenseName || isNaN(expenseAmount) || expenseAmount <= 0) {
        alert("Please enter a valid expense name and amount.");
        return;
    }

    // You can now process the expense data as needed, e.g., save it to a database or display it on the dashboard.

    // Reset the form
    expenseForm.reset();
});
