<!DOCTYPE html>
<html>
  <head>
    <title>AJAX Quotes</title>
    <style>
      /* Importing Google Fonts */
      @import url('https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Tulpen+One&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Qwitcher+Grypen:wght@700&display=swap');

      /* Styling for quote container and animation */
      #quoteContainer {
        display: none;
        text-shadow: 4px 4px 4px #aaa;
      }

      body {
        background-color: #f5f5dc;
        font-family: Arial, sans-serif;
      }

      .fade-in {
        animation: fadeIn 1s ease;
      }

      @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
      }

      /* Additional styling for the header and quote */
      h1 {
        color: #8e44ad; /* Change header color */
        font-family: 'Shadows Into Light', cursive; /* Change header font */
      }

      /* Styling for the quote itself */
      #quoteContainer {
        /* ... (existing styles) ... */
        color: #34495e; /* Change quote color */
      }

      /* Styling for paragraphs */
      p {
        color: #666;
      }
    </style>
  </head>
  <body>
    <h1>Welcome to AJAX Quotes</h1>
    <p>Enjoy a new inspiring quote every 5 seconds!</p>
    <div id="quoteContainer">Quote goes here</div>
    <p>This page retrieves random quotes from a PHP server using AJAX. A quote is displayed on page load and updates every few seconds.</p>
    
    <script>
      var counter = 0;
      var quotes = [
        "The only way to do great work is to love what you do. - Steve Jobs",
        "In the middle of every difficulty lies opportunity. - Albert Einstein",
        "Success is not final, failure is not fatal: It is the courage to continue that counts. - Winston Churchill"
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
            counter++;
            
            if (counter >= fonts.length) {
              counter = 0;
            }
            
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
