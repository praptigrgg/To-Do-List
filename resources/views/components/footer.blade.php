<footer class="text-center py-4 mt-5" style="background-color: #fceff1; color: #7a5d65;">
    <div class="container">
        <p class="mb-1">&copy; {{ now()->year }} ToDoList | Made with 💗 for gentle productivity </p>
    </div>
</footer>
<style>
    /* Footer Styling */
footer {
  background-color: #212529;
  position: fixed; /* Fix the footer at the bottom */
  bottom: 0; /* Position it at the bottom of the page */
  left: 0;
  width: 100%; /* Make it span the full width of the page */
  z-index: 1000; /* Ensure it stays on top of other elements */
  padding: 1px 0; /* Adjust padding to fit your design */
}

footer .container {
  text-align: center;
}

footer small {
  color: #ffffff; /* Light text color */
}

/* To ensure the content doesn't overlap with the footer */
body {
  padding-bottom: 100px; /* Adjust this to the height of your footer */
}

</style>
