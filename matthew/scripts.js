document.addEventListener('DOMContentLoaded', function() {
    // Auth Form Toggle
    const toggleRegister = document.getElementById('toggle-register');
    const toggleLogin = document.getElementById('toggle-login');
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    
    if (toggleRegister && toggleLogin && loginForm && registerForm) {
        toggleRegister.addEventListener('click', function() {
            loginForm.classList.add('hidden');
            registerForm.classList.remove('hidden');
            toggleRegister.classList.add('hidden');
            toggleLogin.classList.remove('hidden');
        });
        
        toggleLogin.addEventListener('click', function() {
            registerForm.classList.add('hidden');
            loginForm.classList.remove('hidden');
            toggleLogin.classList.add('hidden');
            toggleRegister.classList.remove('hidden');
        });
    }

    // Login Simulation
    const authContainer = document.getElementById('auth-container');
    const dashboardContainer = document.getElementById('dashboard-container');
    
    if (authContainer && dashboardContainer) {
        const loginForm = document.getElementById('login-form');
        if (loginForm) {
            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();
                authContainer.classList.add('hidden');
                dashboardContainer.classList.remove('hidden');
            });
        }
    }

    // Logout
    const logoutBtn = document.getElementById('logout-btn');
    if (logoutBtn && authContainer && dashboardContainer) {
        logoutBtn.addEventListener('click', function() {
            dashboardContainer.classList.add('hidden');
            authContainer.classList.remove('hidden');
            resetAllContentSections();
            resetNavigation();
        });
    }

    // Main Navigation
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.id.replace('-link', '-content');
            showContentSection(targetId);
            setActiveNav(this);
        });
    });

    // Sub Navigation (Manage User and Manage Survey)
    const subNavLinks = document.querySelectorAll('.nav-sub-link');
    subNavLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.id.replace('-link', '-content');
            showContentSection(targetId);
            setActiveSubNav(this);
        });
    });

    // Survey Navigation
    const nextBtn = document.getElementById('next-btn');
    const prevBtn = document.getElementById('prev-btn');
    const submitBtn = document.getElementById('submit-btn');
    const surveySections = document.querySelectorAll('.survey-section');
    let currentSection = 0;

    if (nextBtn && prevBtn && submitBtn && surveySections.length > 0) {
        updateSurveyNavigation();

        nextBtn.addEventListener('click', function() {
            if (currentSection < surveySections.length - 1) {
                surveySections[currentSection].classList.add('hidden');
                currentSection++;
                surveySections[currentSection].classList.remove('hidden');
                updateSurveyNavigation();
                updateProgressBar();
            }
        });

        prevBtn.addEventListener('click', function() {
            if (currentSection > 0) {
                surveySections[currentSection].classList.add('hidden');
                currentSection--;
                surveySections[currentSection].classList.remove('hidden');
                updateSurveyNavigation();
                updateProgressBar();
            }
        });
    }

    // Show issue details when "Yes" is selected for product issues
    const productIssueRadios = document.querySelectorAll('input[name="product-issues"]');
    const issueDetails = document.getElementById('issue-details');
    
    if (productIssueRadios.length > 0 && issueDetails) {
        productIssueRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'Yes') {
                    issueDetails.classList.remove('hidden');
                } else {
                    issueDetails.classList.add('hidden');
                }
            });
        });
    }

    // Show promo details when "Yes" is selected for promo participation
    const promoParticipationRadios = document.querySelectorAll('input[name="promo-participation"]');
    const promoDetails = document.getElementById('promo-details');
    
    if (promoParticipationRadios.length > 0 && promoDetails) {
        promoParticipationRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'Yes') {
                    promoDetails.classList.remove('hidden');
                } else {
                    promoDetails.classList.add('hidden');
                }
            });
        });
    }

    // Helper Functions
    function showContentSection(sectionId) {
        // Hide all content sections
        const contentSections = document.querySelectorAll('[id$="-content"]');
        contentSections.forEach(section => {
            section.classList.add('hidden');
        });

        // Show the selected section
        const targetSection = document.getElementById(sectionId);
        if (targetSection) {
            targetSection.classList.remove('hidden');
        }
    }

    function setActiveNav(activeLink) {
        // Remove active class from all nav links
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.classList.remove('text-white', 'bg-blue-600');
            link.classList.add('text-gray-600', 'hover:text-gray-900', 'hover:bg-gray-200');
        });

        // Add active class to clicked link
        activeLink.classList.add('text-white', 'bg-blue-600');
        activeLink.classList.remove('text-gray-600', 'hover:text-gray-900', 'hover:bg-gray-200');
    }

    function setActiveSubNav(activeLink) {
        // Remove active class from all sub nav links
        const subNavLinks = document.querySelectorAll('.nav-sub-link');
        subNavLinks.forEach(link => {
            link.classList.remove('text-white', 'bg-blue-600');
            link.classList.add('text-gray-600', 'hover:text-gray-900', 'hover:bg-gray-200');
        });

        // Add active class to clicked link
        activeLink.classList.add('text-white', 'bg-blue-600');
        activeLink.classList.remove('text-gray-600', 'hover:text-gray-900', 'hover:bg-gray-200');
    }

    function resetAllContentSections() {
        const contentSections = document.querySelectorAll('[id$="-content"]');
        contentSections.forEach(section => {
            section.classList.add('hidden');
        });

        // Show dashboard content by default
        const dashboardContent = document.getElementById('dashboard-content');
        if (dashboardContent) {
            dashboardContent.classList.remove('hidden');
        }
    }

    function resetNavigation() {
        // Reset main nav
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.classList.remove('text-white', 'bg-blue-600');
            link.classList.add('text-gray-600', 'hover:text-gray-900', 'hover:bg-gray-200');
        });

        // Set dashboard as active
        const dashboardLink = document.getElementById('dashboard-link');
        if (dashboardLink) {
            dashboardLink.classList.add('text-white', 'bg-blue-600');
            dashboardLink.classList.remove('text-gray-600', 'hover:text-gray-900', 'hover:bg-gray-200');
        }

        // Reset sub nav
        const subNavLinks = document.querySelectorAll('.nav-sub-link');
        subNavLinks.forEach(link => {
            link.classList.remove('text-white', 'bg-blue-600');
            link.classList.add('text-gray-600', 'hover:text-gray-900', 'hover:bg-gray-200');
        });
    }

    function updateSurveyNavigation() {
        if (currentSection === 0) {
            prevBtn.classList.add('hidden');
        } else {
            prevBtn.classList.remove('hidden');
        }

        if (currentSection === surveySections.length - 1) {
            nextBtn.classList.add('hidden');
            submitBtn.classList.remove('hidden');
        } else {
            nextBtn.classList.remove('hidden');
            submitBtn.classList.add('hidden');
        }
    }

    function updateProgressBar() {
        const progressBar = document.getElementById('survey-progress');
        const progressText = document.getElementById('progress-text');
        
        if (progressBar && progressText) {
            const totalQuestions = 30; // Total questions in the survey
            const questionsPerSection = totalQuestions / surveySections.length;
            const completedQuestions = Math.ceil((currentSection + 1) * questionsPerSection);
            
            const progressPercentage = (completedQuestions / totalQuestions) * 100;
            progressBar.style.width = `${progressPercentage}%`;
            progressText.textContent = `${completedQuestions}/${totalQuestions}`;
        }
    }

    // Initialize the dashboard with dashboard content visible
    if (dashboardContainer && !dashboardContainer.classList.contains('hidden')) {
        resetAllContentSections();
        resetNavigation();
    }
});