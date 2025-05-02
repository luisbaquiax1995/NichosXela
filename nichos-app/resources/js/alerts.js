const alertElement = document.querySelector('.pointer-events-auto.w-full.max-w-sm');
const closeButton = alertElement.querySelector('button');
function fadeOutAlert() {
    alertElement.classList.add('transition', 'ease-in', 'duration-100', 'opacity-0');
    setTimeout(() => {
        alertElement.remove();
    }, 100);
}
closeButton.addEventListener('click', fadeOutAlert);
setTimeout(fadeOutAlert, 5000);
