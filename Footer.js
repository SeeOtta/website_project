fetch("/Footer.html") // Haal de in te laden component op
  .then(response => {   // Vorm deze om naar tekst.
    return response.text()
  })
  .then(data => {       // Zet de tekst in een Custom Tag.
    document.querySelector("footer").innerHTML = data;
  });
