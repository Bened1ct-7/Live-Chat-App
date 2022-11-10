const editIcons = document.querySelectorAll('.fa-pen');
const editForm = document.querySelector('.edit-form');
const xIcon = editForm.querySelector('.fa-x');
const userDetails = document.querySelector('.user-details');
const form = editForm.querySelector('form');
const btn = form.querySelector('button');
const errorText = editForm.querySelector('.error-text');
const formLabel = document.querySelector('.show-form');

editIcons.forEach(icon => {
  icon.onclick = () => {
    editForm.classList.add('show');
    xIcon.onclick = () => {
      editForm.classList.remove('show');
    }
  }
})

formLabel.onclick = () => {
  editForm.classList.add('show');
  xIcon.onclick = () => {
    editForm.classList.remove('show');
  }
}

editForm.onsubmit = (e) => {
  e.preventDefault();
}

btn.onclick = () => {
  let request = new XMLHttpRequest();
  request.open("POST", "php/profile.php", true);
  request.onreadystatechange = () => {
    if (request.readyState == 4 && request.status == 200) {
      const data = request.response;
      if (data == "success") {
        errorText.textContent = "Profile updated successfully";
        errorText.classList.replace('alert-danger', 'alert-success');
        errorText.style.display = "block";
        window.location.href = "profile.php";
      } else {
        errorText.textContent = data;
        errorText.style.display = "block";
      }
    }
  }
  const formData = new FormData(form);
  request.send(formData);
}