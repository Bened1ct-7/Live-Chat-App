const form = document.querySelector('form');
const btn = form.querySelector('button');
const msgInput = form.querySelector('#message');
const box = document.querySelector('.chatbox');
const chatBox = document.querySelector('.chatbox .container-md');

form.onsubmit = (e) => {
  e.preventDefault();
}

setTimeout(() => window.scrollTo(0, box.scrollHeight), 300);

btn.onclick = () => {
  let request = new XMLHttpRequest();
  request.open('POST', 'php/chat.php', true);
  request.onreadystatechange = () => {
    if (request.readyState == 4 && request.status == 200) {
      const data = request.response;
      if (data == "success") {
        window.scrollTo(0, box.scrollHeight);
      }
    }
  }
  const formData = new FormData(form);
  request.send(formData);
  msgInput.value = "";
}

setInterval(() => {
  let request = new XMLHttpRequest();
  request.open('POST', 'php/getchat.php', true);
  request.onreadystatechange = () => {
    if (request.readyState == 4 && request.status == 200) {
      const data = request.response;
      chatBox.innerHTML = data;
      if (!msgInput.classList.contains('active')) {
        
      }
    }
  }
  const formData = new FormData(form);
  request.send(formData);
}, 50)
