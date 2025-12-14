// dashboard.js
// التحكم في النوافذ المنبثقة لإضافة وتعديل الأشعار

// فتح نافذة إضافة شعر
const addBtn = document.querySelector('#openAddModal');
const addModal = document.querySelector('#addPoemModal');
const closeAdd = document.querySelector('#closeAddModal');

if (addBtn) {
    addBtn.addEventListener('click', (e) => {
        // anchors may cause a hash navigation — keep behaviour explicit
        if (e && typeof e.preventDefault === 'function') e.preventDefault();
        if (addModal) addModal.style.display = 'block';
    });
}

if (closeAdd) {
    closeAdd.addEventListener('click', () => {
        addModal.style.display = 'none';
    });
}

// فتح نافذة تعديل شعر
const editBtns = document.querySelectorAll('.edit-btn');
const editModal = document.querySelector('#editPoemModal');
const closeEdit = document.querySelector('#closeEditModal');

editBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
        // stop anchor default behavior (jump to #)
        e.preventDefault();

        // prefer getting values from nearby DOM elements (safer than raw data-attributes
        // because content might contain newlines/HTML entities)
        const poemItem = btn.closest('.poem-card');
        const id = btn.dataset.id || '';

        let title = btn.dataset.title || '';
        let content = btn.dataset.content || '';

        if (poemItem) {
            const h = poemItem.querySelector('h3');
            const p = poemItem.querySelector('p');
            if (h && h.innerText.trim().length) title = h.innerText.trim();
            if (p && p.innerText.trim().length) content = p.innerText.trim();
        }

        // populate the form fields
        const idEl = document.querySelector('#edit_id');
        const titleEl = document.querySelector('#edit_title');
        const contentEl = document.querySelector('#edit_content');

        if (idEl) idEl.value = id;
        if (titleEl) titleEl.value = title;
        if (contentEl) contentEl.value = content;

        // reveal the modal
        editModal.style.display = 'block';
    });
});

if (closeEdit) {
    closeEdit.addEventListener('click', () => {
        editModal.style.display = 'none';
    });
}

// إغلاق النوافذ عند الضغط خارجها
window.addEventListener('click', (e) => {
    // close if clicked directly on overlay only (overlay has class 'modal')
    if (!e || !e.target) return;
    if (e.target.classList && e.target.classList.contains('modal')) {
        // keep defensive checks in case modal variables are missing
        try {
            e.target.style.display = 'none';
        } catch (err) {
            if (addModal) addModal.style.display = 'none';
            if (editModal) editModal.style.display = 'none';
        }
    }
});

// close modals on ESC key for better UX
window.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' || e.key === 'Esc') {
        if (addModal && addModal.style.display === 'block') addModal.style.display = 'none';
        if (editModal && editModal.style.display === 'block') editModal.style.display = 'none';
    }
});
