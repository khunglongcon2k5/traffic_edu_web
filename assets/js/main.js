// Modal functionality
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

// Show modals
showLoginBtn.addEventListener('click', () => {
    loginModal.style.display = 'flex';
});

showRegisterBtn.addEventListener('click', () => {
    registerModal.style.display = 'flex';
});

// Close modals
closeLoginBtn.addEventListener('click', () => {
    loginModal.style.display = 'none';
});

closeRegisterBtn.addEventListener('click', () => {
    registerModal.style.display = 'none';
});

// Switch between modals
switchToRegisterBtn.addEventListener('click', () => {
    loginModal.style.display = 'none';
    registerModal.style.display = 'flex';
});

switchToLoginBtn.addEventListener('click', () => {
    registerModal.style.display = 'none';
    loginModal.style.display = 'flex';
});

// Start exam button (shows login if not authenticated)
startExamBtn.addEventListener('click', () => {
    // For demo purposes, always show login modal
    loginModal.style.display = 'flex';
});

protectedLinks.forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        loginModal.style.display = 'flex';
    })
});

// Close modals when clicking outside
window.addEventListener('click', (e) => {
    if (e.target === loginModal) {
        loginModal.style.display = 'none';
    }
    if (e.target === registerModal) {
        registerModal.style.display = 'none';
    }
});