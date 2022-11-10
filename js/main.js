const searchIcon = document.querySelector('.search-icon');
const searchDiv = document
  .querySelector('.search');
const closeSearch = document.querySelector('.close-search');
const toggleBtn = document.querySelector('.toggle-menu');
const subMenu = document.querySelector('.sub-menu');

searchIcon.onclick = () => {
  searchDiv.classList.add('show');
  closeSearch.onclick = () => {
    searchDiv.classList.remove('show');
    searchDiv.querySelector('input').value = "";
  }
}

toggleBtn.onclick = () => {
  subMenu.classList.toggle('show');
  document.onclick = (e) => {
    if (e.target !== toggleBtn && subMenu.classList.contains('show')) {
      subMenu.classList.remove('show');
    }
  }
}

