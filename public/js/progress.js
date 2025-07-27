document.addEventListener('DOMContentLoaded', function () {
  const form = document.querySelector('.form');
  const formSteps = document.querySelectorAll('.form-step');
  const progress = document.querySelector('.progress');
  const progressSteps = document.querySelectorAll('.progress-step');

  let currentStep = 0;

  function updateProgress() {
    const percent = ((currentStep + 1) / formSteps.length) * 100;
    progress.style.width = percent + '%';
  }

  function updateStepVisibility() {
    formSteps.forEach((step, index) => {
      if (index === currentStep) {
        step.classList.add('form-step-active');
      } else {
        step.classList.remove('form-step-active');
      }
    });

    progressSteps.forEach((step, index) => {
      if (index <= currentStep) {
        step.classList.add('progress-step-active');
      } else {
        step.classList.remove('progress-step-active');
      }

      if (index < currentStep) {
        step.classList.add('progress-step-completed');
      } else {
        step.classList.remove('progress-step-completed');
      }
    });
  }

  function nextStep() {
    if (currentStep < formSteps.length - 1) {
      currentStep++;
      updateStepVisibility();
      updateProgress();
    }
  }

  function prevStep() {
    if (currentStep > 0) {
      currentStep--;
      updateStepVisibility();
      updateProgress();
    }
  }

  document.querySelectorAll('.btn-next').forEach(button => {
    button.addEventListener('click', function (e) {
      e.preventDefault();
      nextStep();
    });
  });

  document.querySelectorAll('.btn-prev').forEach(button => {
    button.addEventListener('click', function (e) {
      e.preventDefault();
      prevStep();
    });
  });
});

