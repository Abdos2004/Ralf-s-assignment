// Toggle 'active' class on service when clicked

let services = document.querySelectorAll('.service');

services.forEach(service => {
  service.addEventListener('click', () => {
    service.classList.toggle('active');
  });
});
