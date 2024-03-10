function showFullText(card) {
  var title = card.querySelector(".card-title");
  var fullText = title.innerText;
  title.setAttribute("data-title", fullText);
  title.innerText = "";
  var fullTitle = document.createTextNode(fullText);
  title.appendChild(fullTitle);
}

function hideFullText(card) {
  var title = card.querySelector(".card-title");
  var shortText = title.getAttribute("data-title");
  title.innerText = "";
  var shortTitle = document.createTextNode(shortText);
  title.appendChild(shortTitle);
}