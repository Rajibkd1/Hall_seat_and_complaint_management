document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("createNoticeForm");
    const titleInput = document.getElementById("title");
    const descriptionInput = document.getElementById("description");
    const descriptionHidden = document.getElementById("description-hidden");
    const titleCount = document.getElementById("titleCount");
    const descCount = document.getElementById("descCount");
    const submitBtn = document.getElementById("submitBtn");

    // Progress indicators
    const titleProgress = document.getElementById("titleProgress");
    const typeProgress = document.getElementById("typeProgress");
    const descProgress = document.getElementById("descProgress");
    const overallProgress = document.getElementById("overallProgress");
    const progressBar = document.getElementById("progressBar");

    // Character counting and progress tracking
    function updateProgress() {
        const title = titleInput.value.trim();
        const description = getEditorText().trim();
        const noticeType = document.getElementById("notice_type").value;

        titleCount.textContent = titleInput.value.length;
        descCount.textContent = getEditorText().length;

        // Update progress indicators
        titleProgress.className = title
            ? "w-4 h-4 rounded-full bg-green-500"
            : "w-4 h-4 rounded-full bg-gray-200";
        descProgress.className = description
            ? "w-4 h-4 rounded-full bg-green-500"
            : "w-4 h-4 rounded-full bg-gray-200";

        // Calculate overall progress (5 fields total: title, description, notice_type, date, status)
        let completedFields = 3; // date, status, and notice_type are pre-filled
        if (title) completedFields++;
        if (description) completedFields++;

        const percentage = (completedFields / 5) * 100;
        overallProgress.textContent = `${Math.round(percentage)}%`;
        progressBar.style.width = `${percentage}%`;

        // Enable/disable submit button
        submitBtn.disabled = !title || !description;
        if (submitBtn.disabled) {
            submitBtn.classList.add("opacity-50", "cursor-not-allowed");
        } else {
            submitBtn.classList.remove("opacity-50", "cursor-not-allowed");
        }
    }

    titleInput.addEventListener("input", updateProgress);

    // Initial progress update
    updateProgress();

    // Form validation
    form.addEventListener("submit", function (e) {
        const title = titleInput.value.trim();
        const description = getEditorText().trim();

        if (!title || !description) {
            e.preventDefault();
            showToast("Please fill in all required fields", "error");
            return;
        }

        // Update hidden textarea before submission
        updateHiddenTextarea();

        // Add loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Creating...
        `;
    });

    // Input focus effects
    const inputs = document.querySelectorAll("input, textarea, select");
    inputs.forEach((input) => {
        input.addEventListener("focus", function () {
            this.classList.add("input-focus");
        });

        input.addEventListener("blur", function () {
            this.classList.remove("input-focus");
        });
    });

    // Auto-save to localStorage
    function saveToLocalStorage() {
        const formData = {
            title: titleInput.value,
            description: getEditorHTML(),
            notice_type: document.getElementById("notice_type").value,
            date_posted: document.getElementById("date_posted").value,
            status: document.getElementById("status").value,
        };
        localStorage.setItem("notice_draft", JSON.stringify(formData));
    }

    // Load from localStorage
    function loadFromLocalStorage() {
        const saved = localStorage.getItem("notice_draft");
        if (saved) {
            const data = JSON.parse(saved);
            titleInput.value = data.title || "";
            setEditorContent(data.description || "");
            document.getElementById("date_posted").value =
                data.date_posted || "";
            document.getElementById("status").value = data.status || "active";
            document.getElementById("notice_type").value =
                data.notice_type || "announcement";
            updateProgress();
        }
    }

    // Auto-save on input
    form.addEventListener("input", saveToLocalStorage);

    // Load draft on page load
    loadFromLocalStorage();

    // Rich Text Editor Implementation
    initializeRichTextEditor();
});

// Rich Text Editor Functions
function initializeRichTextEditor() {
    const editor = document.getElementById("description");
    const hiddenTextarea = document.getElementById("description-hidden");
    const toolbar = document.querySelector(".toolbar");

    if (!editor || !hiddenTextarea || !toolbar) return;

    // Initialize editor content
    const oldContent = hiddenTextarea.value;
    if (oldContent) {
        editor.innerHTML = oldContent;
    }

    // Update character count
    updateCharacterCount();

    // Toolbar button event listeners
    toolbar.addEventListener("click", function (e) {
        if (e.target.closest(".toolbar-btn")) {
            e.preventDefault();
            const button = e.target.closest(".toolbar-btn");
            const command = button.dataset.command;

            if (command) {
                executeCommand(command);
                updateToolbarState();
            }
        }
    });

    // Editor event listeners
    editor.addEventListener("input", function () {
        updateCharacterCount();
        updateHiddenTextarea();
        updateProgress();
    });

    editor.addEventListener("keydown", function (e) {
        // Handle keyboard shortcuts
        if (e.ctrlKey || e.metaKey) {
            switch (e.key) {
                case "b":
                    e.preventDefault();
                    executeCommand("bold");
                    break;
                case "i":
                    e.preventDefault();
                    executeCommand("italic");
                    break;
                case "u":
                    e.preventDefault();
                    executeCommand("underline");
                    break;
                case "z":
                    if (e.shiftKey) {
                        e.preventDefault();
                        executeCommand("redo");
                    } else {
                        e.preventDefault();
                        executeCommand("undo");
                    }
                    break;
                case "y":
                    e.preventDefault();
                    executeCommand("redo");
                    break;
            }
        }
    });

    editor.addEventListener("paste", function (e) {
        e.preventDefault();
        const text = (e.clipboardData || window.clipboardData).getData(
            "text/plain"
        );
        document.execCommand("insertText", false, text);
    });

    // Focus management
    editor.addEventListener("focus", function () {
        updateToolbarState();
    });

    editor.addEventListener("blur", function () {
        updateHiddenTextarea();
    });

    // Initial toolbar state
    updateToolbarState();
}

function executeCommand(command) {
    const editor = document.getElementById("description");

    switch (command) {
        case "undo":
            document.execCommand("undo");
            break;
        case "redo":
            document.execCommand("redo");
            break;
        case "bold":
        case "italic":
        case "underline":
        case "strikeThrough":
        case "removeFormat":
            document.execCommand(command);
            break;
        case "insertUnorderedList":
        case "insertOrderedList":
            document.execCommand(command);
            break;
        case "justifyLeft":
        case "justifyCenter":
        case "justifyRight":
            document.execCommand(command);
            break;
        case "createLink":
            const url = prompt("Enter URL:");
            if (url) {
                document.execCommand("createLink", false, url);
            }
            break;
    }

    editor.focus();
    updateCharacterCount();
    updateHiddenTextarea();
}

function updateToolbarState() {
    const toolbar = document.querySelector(".toolbar");
    if (!toolbar) return;

    const buttons = toolbar.querySelectorAll(".toolbar-btn");
    buttons.forEach((button) => {
        const command = button.dataset.command;
        if (command) {
            const isActive = document.queryCommandState(command);
            button.classList.toggle("active", isActive);
        }
    });
}

function updateCharacterCount() {
    const editor = document.getElementById("description");
    const descCount = document.getElementById("descCount");

    if (editor && descCount) {
        const text = editor.textContent || editor.innerText || "";
        descCount.textContent = text.length;
    }
}

function updateHiddenTextarea() {
    const editor = document.getElementById("description");
    const hiddenTextarea = document.getElementById("description-hidden");

    if (editor && hiddenTextarea) {
        hiddenTextarea.value = editor.innerHTML;
    }
}

function getEditorText() {
    const editor = document.getElementById("description");
    return editor ? editor.textContent || editor.innerText || "" : "";
}

function getEditorHTML() {
    const editor = document.getElementById("description");
    return editor ? editor.innerHTML : "";
}

function setEditorContent(html) {
    const editor = document.getElementById("description");
    if (editor) {
        editor.innerHTML = html;
        updateCharacterCount();
        updateHiddenTextarea();
    }
}

// Preview functionality
function previewNotice() {
    const title = document.getElementById("title").value;
    const description = getEditorText();
    const descriptionHTML = getEditorHTML();
    const datePosted = document.getElementById("date_posted").value;
    const status = document.getElementById("status").value;
    const noticeType = document.getElementById("notice_type").value;

    if (!title || !description) {
        showToast("Please fill in the title and description first", "warning");
        return;
    }

    document.getElementById("previewTitle").textContent = title;
    document.getElementById("previewDate").textContent = new Date(
        datePosted
    ).toLocaleDateString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
    });
    document.getElementById("previewDescription").innerHTML = descriptionHTML;

    const statusBadge =
        status === "active"
            ? '<span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800"><div class="w-2 h-2 bg-green-500 rounded-full mr-1"></div>Active</span>'
            : '<span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800"><div class="w-2 h-2 bg-gray-500 rounded-full mr-1"></div>Inactive</span>';

    const typeBadge =
        noticeType === "announcement"
            ? '<span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-2">Announcement</span>'
            : noticeType === "event"
            ? '<span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 mr-2">Event</span>'
            : '<span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 mr-2">Deadline</span>';

    document.getElementById("previewStatus").innerHTML =
        typeBadge + statusBadge;

    const modal = document.getElementById("previewModal");
    const content = document.getElementById("previewContent");

    if (modal && content) {
        modal.classList.remove("hidden");
        modal.classList.add("flex");

        setTimeout(() => {
            content.classList.add("modal-enter");
        }, 10);
    }
}

function closePreview() {
    const modal = document.getElementById("previewModal");
    const content = document.getElementById("previewContent");

    content.classList.remove("modal-enter");
    content.classList.add("modal-exit");

    setTimeout(() => {
        modal.classList.add("hidden");
        modal.classList.remove("flex");
        content.classList.remove("modal-exit");
    }, 300);
}

// Clear form
function clearForm() {
    if (
        confirm(
            "Are you sure you want to clear the form? All data will be lost."
        )
    ) {
        const form = document.getElementById("createNoticeForm");
        if (form) {
            form.reset();
        }

        // Reset date to today
        const dateInput = document.getElementById("date_posted");
        if (dateInput) {
            dateInput.value = new Date().toISOString().split("T")[0];
        }

        // Reset character counts
        const titleCount = document.getElementById("titleCount");
        const descCount = document.getElementById("descCount");
        if (titleCount) titleCount.textContent = "0";
        if (descCount) descCount.textContent = "0";

        // Clear rich text editor
        setEditorContent("");

        // Clear localStorage
        localStorage.removeItem("notice_draft");
        showToast("Form has been cleared", "info");

        // Reset progress indicators
        const titleProgress = document.getElementById("titleProgress");
        const typeProgress = document.getElementById("typeProgress");
        const descProgress = document.getElementById("descProgress");
        const overallProgress = document.getElementById("overallProgress");
        const progressBar = document.getElementById("progressBar");

        if (titleProgress)
            titleProgress.className = "w-4 h-4 rounded-full bg-gray-200";
        if (typeProgress)
            typeProgress.className = "w-4 h-4 rounded-full bg-green-500";
        if (descProgress)
            descProgress.className = "w-4 h-4 rounded-full bg-gray-200";
        if (overallProgress) overallProgress.textContent = "60%";
        if (progressBar) progressBar.style.width = "60%";

        // Reset submit button
        const submitBtn = document.getElementById("submitBtn");
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.classList.add("opacity-50", "cursor-not-allowed");
        }
    }
}

// Save as draft
function saveAsDraft() {
    const title = document.getElementById("title").value;
    const description = getEditorText();
    const descriptionHTML = getEditorHTML();
    const noticeType = document.getElementById("notice_type").value;
    const datePosted = document.getElementById("date_posted").value;

    if (!title && !description) {
        showToast("Nothing to save as draft", "warning");
        return;
    }

    // Save to localStorage
    const formData = {
        title: title,
        description: descriptionHTML,
        notice_type: noticeType,
        date_posted: datePosted,
        status: "inactive", // Save drafts as inactive
    };
    localStorage.setItem("notice_draft", JSON.stringify(formData));

    showToast("Draft saved successfully", "success");
}

// Toast notification function
function showToast(message, type = "success") {
    const toast = document.createElement("div");
    const bgColor =
        type === "error"
            ? "bg-red-500"
            : type === "warning"
            ? "bg-yellow-500"
            : type === "info"
            ? "bg-blue-500"
            : "bg-green-500";

    toast.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300`;
    toast.textContent = message;

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.classList.remove("translate-x-full");
    }, 100);

    setTimeout(() => {
        toast.classList.add("translate-x-full");
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 300);
    }, 3000);
}

// Close modal when clicking outside
document.addEventListener("DOMContentLoaded", function () {
    const previewModal = document.getElementById("previewModal");
    if (previewModal) {
        previewModal.addEventListener("click", function (e) {
            if (e.target === this) {
                closePreview();
            }
        });
    }
});

// Close modal with Escape key
document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
        closePreview();
    }
});
