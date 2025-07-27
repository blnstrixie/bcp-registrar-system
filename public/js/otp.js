let timer = 60;
let interval;

function updateTimer() {
  const timerElement = document.getElementById('timer');
  const resendText = document.getElementById('resendText');

  if (timer === 0) {
    resendText.innerHTML = 'Resend';
    clearInterval(interval);
  } else {
    resendText.innerHTML = `Wait <span id="timer">${timer}</span>s`;
    timer--;
  }
}

function handleResendClick() {
  clearInterval(interval);
  timer = 60;
  updateTimer();
  interval = setInterval(updateTimer, 1000);
}

document.getElementById('resendText').addEventListener('click', handleResendClick);

const resendText = document.getElementById('resendText');

resendText.addEventListener('mouseover', function() {
  this.style.fontWeight = 'bold';
  this.style.cursor = 'pointer';
});

resendText.addEventListener('mouseout', function() {
  this.style.fontWeight = 'normal';
  this.style.cursor = 'auto';
});

updateTimer();
interval = setInterval(updateTimer, 1000);

function moveToNext(input) {
  const nextInput = input.nextElementSibling;
  if (nextInput) {
    nextInput.focus();
  }

  checkCodeInputs();
}

function checkCodeInputs() {
  const codeInputs = document.querySelectorAll('.codeBox');
  const verifyButton = document.getElementById('verifyButton');

  for (let input of codeInputs) {
    if (input.value === '') {
      verifyButton.disabled = true;
      verifyButton.classList.remove('active');
      return;
    }
  }

  verifyButton.disabled = false;
  verifyButton.classList.add('active');
}
