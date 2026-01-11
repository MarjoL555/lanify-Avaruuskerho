// Pieni vaihtuva api, jossa tähtitiede faktoja, koska etusivu näytti tyhjältä.
// Tämän ideoinnissa on käytettä apuna tekoälyä.  


// Array lista tähtitiede faktoista
const facts = [
  "Aurinko on keltainen kääpiötähti.",
  "Universumissa on enemmän tähtiä kuin hiekanjyviä kaikilla Maan rannoilla yhteensä.",
  "Venuksen 'päivä' on pidempi kuin sen 'vuosi'.",
  "Aurinkokuntamme suurin tulivuori sijaitsee Marsissa (Olympus Mons).",
  "Jupiterin Suuri Punainen Pilkku on jättimäinen myrsky, joka on suurempi kuin Maa.",
  "Linnunradan galaksin arvioidaan sisältävän 100 - 400 miljardia tähteä."
];

// Näyttää sivulla satunnaisen faktan
function displayRandomFact() {

  // Haetaan kohta, johon fakta kirjoitetaan
  const factDisplay = document.getElementById('astronomy-fact');

  // Varmistetaan, että elementti löytyy
  if (factDisplay) {

    // Valitaan satunnainen fakta listasta
    const randomIndex = Math.floor(Math.random() * facts.length);

    // Asetetaan valittu fakta sivulle
    factDisplay.textContent = facts[randomIndex];
  }
}

// Suoritetaan funktio, kun sivu on ladattu
window.onload = displayRandomFact;