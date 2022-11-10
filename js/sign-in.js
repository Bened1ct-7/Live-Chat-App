const form = document.querySelector('form');
const btn = form.querySelector('button');
const errorText = document.querySelector('.error-text');

form.onsubmit = (e) => {
  e.preventDefault();
}

btn.onclick = () => {
  let request= new XMLHttpRequest();
  request.open("POST", "php/signin.php", true);
  request.onreadystatechange = () => {
    if (request.readyState == 4 && request.status == 200) {
      const data = request.response;
      if (data == "success") {
        errorText.textContent = "Logged in successfully";
        errorText.classList.replace('alert-danger', 'alert-success');
        errorText.style.display = "block";
        window.location.href = "index.php";
      } else {
        errorText.textContent = data;
        errorText.style.display = "block";
      }
      window.scrollTo(0, 0);
    }
  }
  const formData = new FormData(form);
  request.send(formData);
}
