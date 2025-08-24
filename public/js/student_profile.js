class StudentProfileManager {
    constructor() {
        this.initializeElements();
        this.bindEvents();
    }

    initializeElements() {
        // Edit button
        this.editBtn = document.getElementById("editBtn");

        // Notification container
        this.notificationContainer = document.getElementById(
            "notificationContainer"
        );
    }

    bindEvents() {
        // Edit button event - navigate to edit page
        if (this.editBtn) {
            this.editBtn.addEventListener("click", () =>
                this.navigateToEditPage()
            );
        }
    }

    navigateToEditPage() {
        // Navigate to the edit profile page
        window.location.href = "/student/profile/edit";
    }

    showNotification(title, message, type = "info") {
        // Create notification container if it doesn't exist
        if (!this.notificationContainer) {
            this.notificationContainer = document.createElement("div");
            this.notificationContainer.id = "notificationContainer";
            this.notificationContainer.className =
                "fixed top-4 right-4 z-50 space-y-2";
            document.body.appendChild(this.notificationContainer);
        }

        const notification = document.createElement("div");
        notification.className = `notification ${type}`;

        const icons = {
            success: `<svg class="notification-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #10b981;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>`,
            error: `<svg class="notification-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ef4444;">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>`,
            warning: `<svg class="notification-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #f59e0b;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                      </svg>`,
            info: `<svg class="notification-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #3b82f6;">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                   </svg>`,
        };

        notification.innerHTML = `
            <div class="notification-content">
                ${icons[type]}
                <div class="notification-text">
                    <div class="notification-title">${title}</div>
                    <div>${message}</div>
                </div>
                <button class="notification-close" onclick="this.parentElement.parentElement.remove()">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        `;

        this.notificationContainer.appendChild(notification);

        // Show notification
        setTimeout(() => {
            notification.classList.add("show");
        }, 100);

        // Auto remove after 5 seconds
        setTimeout(() => {
            notification.classList.remove("show");
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 300);
        }, 5000);
    }
}

// Initialize when DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
    new StudentProfileManager();
});
