const loginModal = document.getElementById('loginModal');
const registerModal = document.getElementById('registerModal');
const showLoginBtn = document.getElementById('showLogin');
const showRegisterBtn = document.getElementById('showRegister');
const closeLoginBtn = document.getElementById('closeLogin');
const closeRegisterBtn = document.getElementById('closeRegister');
const switchToRegisterBtn = document.getElementById('switchToRegister');
const switchToLoginBtn = document.getElementById('switchToLogin');
const startExamBtn = document.getElementById('startExam');
const protectedLinks = document.querySelectorAll('.required-login');

showLoginBtn.addEventListener('click', () => {
    loginModal.style.display = 'flex';
});

showRegisterBtn.addEventListener('click', () => {
    registerModal.style.display = 'flex';
});

closeLoginBtn.addEventListener('click', () => {
    loginModal.style.display = 'none';
});

closeRegisterBtn.addEventListener('click', () => {
    registerModal.style.display = 'none';
});

switchToRegisterBtn.addEventListener('click', () => {
    loginModal.style.display = 'none';
    registerModal.style.display = 'flex';
});

switchToLoginBtn.addEventListener('click', () => {
    registerModal.style.display = 'none';
    loginModal.style.display = 'flex';
});

startExamBtn.addEventListener('click', () => {
    loginModal.style.display = 'flex';
});

protectedLinks.forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        loginModal.style.display = 'flex';
    })
});

window.addEventListener('click', (e) => {
    if (e.target === loginModal) {
        loginModal.style.display = 'none';
    }
    if (e.target === registerModal) {
        registerModal.style.display = 'none';
    }
});