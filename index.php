<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Тестовое</title>
  <style type="text/css">
    body {
      text-align: center;
    }
  </style>
</head>
<body>
  <form id="myForm">
    <label for="name">Имя:</label><br>
    <input type="text" id="name" name="name"><br><br>

    <label for="phone">Телефон:</label><br>
    <input type="tel" id="phone" name="phone"><br><br>

    <label for="email">E-mail:</label><br>
    <input type="email" id="email" name="email"><br><br>

    <label for="message">Сообщение:</label><br>
    <textarea id="message" name="message"></textarea><br><br>

    <button type="button" id="sentForm">Отправить комментарий</button>
  </form>

  <div id="result">
    <p></p>
  </div>    
  <div id="result2">
    <p></p>
  </div>
  <div id="result3">
    <p></p>
  </div>

  <script>
   const sentFormButton = document.getElementById('sentForm');

   function checkFields() {
    let request = new XMLHttpRequest();
    request.open("POST", "check_email.php");

    request.onreadystatechange = function() {
      if(this.readyState === 4 && this.status === 200) {
        if (this.responseText == 1) {
          document.getElementById("result").innerHTML = "Норм почта";
          sentFormButton.disabled = false;
        } else {
          document.getElementById("result").innerHTML = "🟥 Почта уже имеется";
          sentFormButton.disabled = true;
        }

        const name = document.getElementById('name').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const email = document.getElementById('email').value.trim();
        const message = document.getElementById('message').value.trim();

        if (!name || !phone || !email || !message || this.responseText == 0) {
          document.getElementById("result2").innerHTML = "🟥 Пустые поля";
          sentFormButton.disabled = true;
        } else {
          document.getElementById("result2").innerHTML = "Норм поля";
          sentFormButton.disabled = false;
        }
      }
    };

    let myForm = document.getElementById("myForm");
    let formData = new FormData(myForm);

    request.send(formData);
  }

  const nameField = document.getElementById('name');
  const phoneField = document.getElementById('phone');
  const emailField = document.getElementById('email');
  const messageField = document.getElementById('message');
  const submitButton = document.getElementById('submitForm');

  nameField.addEventListener('input', checkFields);
  phoneField.addEventListener('input', checkFields);
  emailField.addEventListener('input', checkFields);
  messageField.addEventListener('input', checkFields);

  function sentForm() {
    let request = new XMLHttpRequest();
    request.open("POST", "process_form.php");

    request.onreadystatechange = function() {
      if(this.readyState === 4 && this.status === 200) {
        document.getElementById("result3").innerHTML = this.responseText;
      }
    };

    let myForm = document.getElementById("myForm");
    let formData = new FormData(myForm);

    request.send(formData);
  }

  document.addEventListener('DOMContentLoaded', function() {
    const button = document.getElementById('sentForm');

    button.addEventListener('click', function() {
      checkFields();
      sentForm();
    });
  });

</script>

</body>
</html>
