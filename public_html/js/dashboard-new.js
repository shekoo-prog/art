// ====================================
// Modern Dashboard JavaScript
// ====================================

document.addEventListener('DOMContentLoaded', function () {

    // ====================================
    // Sidebar Toggle for Mobile
    // ====================================
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.dashboard-sidebar');

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function () {
            sidebar.classList.toggle('active');
        });
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function (e) {
        if (window.innerWidth <= 1024) {
            if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                sidebar.classList.remove('active');
            }
        }
    });

    // ====================================
    // Section Navigation
    // ====================================
    const navItems = document.querySelectorAll('.nav-item[data-section]');
    const sections = document.querySelectorAll('.dashboard-section');

    navItems.forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault();

            const targetSection = this.getAttribute('data-section');

            // Remove active class from all nav items
            navItems.forEach(nav => nav.classList.remove('active'));

            // Add active class to clicked item
            this.classList.add('active');

            // Hide all sections
            sections.forEach(section => section.classList.remove('active'));

            // Show target section
            const target = document.getElementById(targetSection);
            if (target) {
                target.classList.add('active');
            }

            // Close sidebar on mobile after navigation
            if (window.innerWidth <= 1024) {
                sidebar.classList.remove('active');
            }
        });
    });

    // ====================================
    // Current Time Display
    // ====================================
    function updateTime() {
        const timeElement = document.getElementById('currentTime');
        if (timeElement) {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            timeElement.textContent = `${hours}:${minutes}:${seconds}`;
        }
    }

    // Update time every second
    updateTime();
    setInterval(updateTime, 1000);

    // ====================================
    // Modal Management
    // ====================================

    // Add Poem Modal
    const addModal = document.getElementById('addPoemModal');
    const openAddBtns = document.querySelectorAll('#openAddModal, #openAddModalFromPoems');
    const closeAddBtn = document.getElementById('closeAddModal');
    const cancelAddBtn = document.getElementById('cancelAddModal');

    openAddBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            addModal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        });
    });

    if (closeAddBtn) {
        closeAddBtn.addEventListener('click', function () {
            addModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    }

    if (cancelAddBtn) {
        cancelAddBtn.addEventListener('click', function () {
            addModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    }

    // Edit Poem Modal
    const editModal = document.getElementById('editPoemModal');
    const editBtns = document.querySelectorAll('.edit-btn');
    const closeEditBtn = document.getElementById('closeEditModal');
    const cancelEditBtn = document.getElementById('cancelEditModal');

    editBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const title = this.getAttribute('data-title');
            const content = this.getAttribute('data-content');

            document.getElementById('edit_id').value = id;
            document.getElementById('edit_title').value = title;
            document.getElementById('edit_content').value = content;

            editModal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        });
    });

    if (closeEditBtn) {
        closeEditBtn.addEventListener('click', function () {
            editModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    }

    if (cancelEditBtn) {
        cancelEditBtn.addEventListener('click', function () {
            editModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    }

    // Close modal when clicking on overlay
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        const overlay = modal.querySelector('.modal-overlay');
        if (overlay) {
            overlay.addEventListener('click', function () {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            });
        }
    });

    // Close modal with ESC key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            modals.forEach(modal => {
                if (modal.style.display === 'block') {
                    modal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });
        }
    });

    // ====================================
    // Smooth Animations
    // ====================================

    // Animate stats on load
    const statNumbers = document.querySelectorAll('.stat-details h3');
    statNumbers.forEach(stat => {
        const finalValue = parseInt(stat.textContent);
        let currentValue = 0;
        const increment = finalValue / 50;
        const duration = 1000;
        const stepTime = duration / 50;

        const counter = setInterval(() => {
            currentValue += increment;
            if (currentValue >= finalValue) {
                stat.textContent = finalValue;
                clearInterval(counter);
            } else {
                stat.textContent = Math.floor(currentValue);
            }
        }, stepTime);
    });

    // ====================================
    // Table Interactions
    // ====================================

    // Add hover effect to table rows
    const tableRows = document.querySelectorAll('.poems-table tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function () {
            this.style.transform = 'scale(1.01)';
        });
        row.addEventListener('mouseleave', function () {
            this.style.transform = 'scale(1)';
        });
    });

    // ====================================
    // Form Validation
    // ====================================

    const forms = document.querySelectorAll('.modal-form');
    forms.forEach(form => {
        form.addEventListener('submit', function (e) {
            const title = form.querySelector('input[name="title"]');
            const content = form.querySelector('textarea[name="content"]');

            if (title && title.value.trim() === '') {
                e.preventDefault();
                alert('الرجاء إدخال عنوان القصيدة');
                title.focus();
                return false;
            }

            if (content && content.value.trim() === '') {
                e.preventDefault();
                alert('الرجاء إدخال محتوى القصيدة');
                content.focus();
                return false;
            }
        });
    });

    // ====================================
    // Notifications (Optional Enhancement)
    // ====================================

    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
            <span>${message}</span>
        `;
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: ${type === 'success' ? '#10b981' : '#ef4444'};
            color: white;
            padding: 1rem 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: slideDown 0.3s ease;
        `;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.animation = 'slideUp 0.3s ease';
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 3000);
    }

    // Add notification animations to CSS
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideDown {
            from {
                transform: translateX(-50%) translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(-50%) translateY(0);
                opacity: 1;
            }
        }
        @keyframes slideUp {
            from {
                transform: translateX(-50%) translateY(0);
                opacity: 1;
            }
            to {
                transform: translateX(-50%) translateY(-100%);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);

    // ====================================
    // Search Functionality (Future Enhancement)
    // ====================================

    // You can add a search box to filter poems in the table
    function filterTable(searchTerm) {
        const rows = document.querySelectorAll('.poems-table tbody tr');
        rows.forEach(row => {
            const title = row.querySelector('.poem-title-cell').textContent.toLowerCase();
            const content = row.querySelector('.poem-content-cell').textContent.toLowerCase();

            if (title.includes(searchTerm.toLowerCase()) || content.includes(searchTerm.toLowerCase())) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // ====================================
    // Welcome Message
    // ====================================

    console.log('%c🎨 لوحة التحكم - ديوان الشعر', 'font-size: 20px; color: #7A3E10; font-weight: bold;');
    console.log('%cمرحباً بك في لوحة التحكم الحديثة!', 'font-size: 14px; color: #8F3C1F;');
});
