document.addEventListener('DOMContentLoaded', function () {
  var boxes = document.querySelectorAll('.box');

  boxes.forEach(function (box) {
    box.addEventListener('click', function () {
      
      boxes.forEach(function (otherBox) {
        if (otherBox !== box) {
          otherBox.classList.remove('selected');
        }
      });

      this.classList.toggle('selected');
    });
  });
});