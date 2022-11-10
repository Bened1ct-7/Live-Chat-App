const usersDiv = document.querySelector('.users');

setInterval(() => {
  let request = new XMLHttpRequest();
  request.open('POST', 'php/users.php', true);
  request.onreadystatechange = () => {
    if (request.readyState == 4 && request.status == 200) {
      const data = request.response;
      usersDiv.innerHTML = data;
    }
  }
  request.send();
}, 50)

