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

const isLoggedIN = !showLoginBtn && !showRegisterBtn;

if (showLoginBtn) {
    showLoginBtn.addEventListener('click', () => {
        loginModal.style.display = 'flex';
    })
}

if (showRegisterBtn) {
    showRegisterBtn.addEventListener('click', () => {
        registerModal.style.display = 'flex';
    });
}

if (closeLoginBtn) {
    closeLoginBtn.addEventListener('click', () => {
        loginModal.style.display = 'none';
    });
}

if (closeRegisterBtn) {
    closeRegisterBtn.addEventListener('click', () => {
        registerModal.style.display = 'none';
    });
}

if (switchToRegisterBtn) {
    switchToRegisterBtn.addEventListener('click', () => {
        loginModal.style.display = 'none';
        registerModal.style.display = 'flex';
    });
}

if (switchToLoginBtn) {
    switchToLoginBtn.addEventListener('click', () => {
        registerModal.style.display = 'none';
        loginModal.style.display = 'flex';
    });
}

if (startExamBtn) {
    startExamBtn.addEventListener('click', () => {
        if (isLoggedIN) {
            window.location.href = './pages/thi-bang-lai-xe-a1-online.php';
        } else {
            loginModal.style.display = 'flex';
        }
    });
}

protectedLinks.forEach(link => {
    link.addEventListener('click', (e) => {
        if (!isLoggedIN) {
            e.preventDefault();
            loginModal.style.display = 'flex';
        }
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