const form = document.querySelector('form');
const btn = form.querySelector('button');
const errorText = document.querySelector('.error-text');
const email = form.querySelector('#email');
const password = form.querySelector('#password');
const username = form.querySelector('#username');
const emailErr = form.querySelector('.js-email');
const passErr = form.querySelector('.js-password');
const userErr = form.querySelector('.js-uname');



form.onsubmit = (e) => {
  e.preventDefault();
}

btn.onclick = () => {
  let request= new XMLHttpRequest();
  request.open("POST", "php/signup.php", true);
  request.onreadystatechange = () => {
    if (request.readyState == 4 && request.status == 200) {
      const data = request.response;
      if (data == "success") {
        errorText.textContent = "Registered Successfully. You will be redirected shortly";
        errorText.classList.replace('alert-danger', 'alert-success');
        errorText.style.display = "block";
        window.location.href = "signin.php";
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

email.onchange = () => {
  let request = new XMLHttpRequest();
  let userEmail = email.value;
  request.open("POST", "php/form.php", true);
  request.onreadystatechange = () => {
    if (email.value != "") {
      if (request.readyState === 4 && request.status === 200) {
        const data = request.response;
        if (data == "email success") {
          emailErr.textContent = "Looks good";
          emailErr.classList.replace('text-danger', 'text-success');
        } else {
          if (emailErr.classList.contains('text-success')) {
            emailErr.classList.replace('text-success', 'text-danger')
          }
          emailErr.textContent = data;
        }
      }
    } else {
      emailErr.textContent = "";
    }
  }
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send("userEmail=" + userEmail);
}

password.onchange = () => {
  let request = new XMLHttpRequest();
  let userpass = password.value;
  request.open("POST", "php/form.php", true);
  request.onreadystatechange = () => {
    if (password.value != "") {
      if (request.readyState === 4 && request.status === 200) {
        const data = request.response;
        if (data == "password success") {
          passErr.textContent = "Looks good";
          passErr.classList.replace('text-danger', 'text-success');
        } else {
          if (passErr.classList.contains('text-success')) {
            passErr.classList.replace('text-success', 'text-danger')
          }
          passErr.textContent = data;
        }
      }
    } else {
      passErr.textContent = "";
    }
  }
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send("userPass=" + userpass);
}

username.onchange = () => {
  let request = new XMLHttpRequest();
  let userName = username.value;
  request.open("POST", "php/form.php", true);
  request.onreadystatechange = () => {
    if (username.value != "") {
      if (request.readyState === 4 && request.status === 200) {
        const data = request.response;
        if (data == "username success") {
          userErr.textContent = `${userName} is available`;
          userErr.classList.replace('text-danger', 'text-success');
        } else {
          if (userErr.classList.contains('text-success')) {
            userErr.classList.replace('text-success', 'text-danger')
          }
          userErr.textContent = data;
        }
      }
    } else {
      userErr.textContent = "";
    }
  }
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send("userName=" + userName);
}
