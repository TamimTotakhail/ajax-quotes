<!DOCTYPE html>
<html>
  <head>
    <title>AJAX Quotes</title>
    <style>
      /* Importing Google Fonts */
      @import url('https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Tulpen+One&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Qwitcher+Grypen:wght@700&display=swap');

      /* Styling for header and body */
      body {
        margin: 0;
        padding: 0;
        background-color: #f0f0f0;
        font-family: 'Arial', sans-serif;
        color: #333;
      }

      /* Header styling */
      header {
        background-color: #3498db;
        text-align: center;
        padding: 1rem;
      }

      h1 {
        margin: 0;
        font-family: 'Shadows Into Light', cursive;
        color: #fff;
      }

      /* Container styling */
      .container {
        text-align: center;
        padding: 2rem;
        background-color: #fff;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        max-width: 600px;
        margin: 0 auto;
      }

      /* Styling for the quote itself */
      #quoteContainer {
        display: none;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        font-size: 1.5rem;
        margin-top: 1.5rem;
      }

      /* Styling for paragraphs */
      p {
        font-size: 1.2rem;
        line-height: 1.5;
        color: #666;
      }
    </style>
  </head>
  <body>
    <header>
      <h1>AJAX Quotes</h1>
    </header>
    <div class="container">
      <p>Get inspired with a new quote every 5 seconds!</p>
      <div id="quoteContainer">Quote goes here</div>
      <p>This page retrieves random quotes from a server using AJAX. A quote is displayed on page load and updates every few seconds.</p>
    </div>
    
    <script>
      var counter = 0;
      var quotes = [
        "The only way to do great work is to love what you do. - Steve Jobs",
        "In the middle of every difficulty lies opportunity. - Albert Einstein",
        "Success is not final, failure is not fatal: It is the courage to continue that counts. - Winston Churchill",
        "The journey of a thousand miles begins with one step. - Lao Tzu",
        "Believe you can and you're halfway there. - Theodore Roosevelt",
        "Don't watch the clock; do what it does. Keep going. - Sam Levenson"
      ];

      function getRandomQuote() {
        var fonts = ["Qwitcher Grypen", "Tulpen One", "Shadows Into Light"];
        
        var xhr = new XMLHttpRequest();
        
        xhr.open('GET', 'random_quotes.php', true);
        
        xhr.onload = function() {
          if (xhr.status >= 200 && xhr.status < 300) { // Successful response
            var quoteContainer = document.querySelector("#quoteContainer");
            quoteContainer.innerText = xhr.responseText;
            quoteContainer.style.display = 'block';
            quoteContainer.style.fontFamily = fonts[counter];
            counter = (counter + 1) % fonts.length; // Loop through fonts
            
            quoteContainer.classList.add("fade-in");

            setTimeout(function() {
              quoteContainer.classList.remove("fade-in");
            }, 1000);
    
          } else { // Error response
            document.querySelector("#quoteContainer").innerText = "Failed to fetch quote: " + xhr.status;
          }
        };
        
        xhr.onerror = function() {
          alert("Oh oh! An error occurred while fetching the quote.");
        };
        
        xhr.send(); // Send request to server
      }

      function displayRandomQuote() {
        getRandomQuote(); // Load a random quote initially
        setInterval(getRandomQuote, 5000); // Fetch a new quote at intervals
      }

      displayRandomQuote(); // Call the function on page load
    </script>
   
  </body>
</html>
