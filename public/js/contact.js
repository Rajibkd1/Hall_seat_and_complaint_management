// Contact Form Enhancement
document.addEventListener("DOMContentLoaded", function () {
    const contactForm = document.getElementById("contactForm");
    const submitBtn = contactForm?.querySelector('button[type="submit"]');
    const messageTextarea = contactForm?.querySelector("#message");

    if (!contactForm || !submitBtn) return;

    // Character counter for message textarea
    if (messageTextarea) {
        const maxLength = 2000;
        const charCounter = document.createElement("div");
        charCounter.className = "text-sm text-gray-500 mt-1 text-right";
        charCounter.innerHTML = `<span id="charCount">0</span>/${maxLength} characters`;
        messageTextarea.parentNode.appendChild(charCounter);

        const charCountSpan = charCounter.querySelector("#charCount");

        messageTextarea.addEventListener("input", function () {
            const currentLength = this.value.length;
            charCountSpan.textContent = currentLength;

            if (currentLength > maxLength * 0.9) {
                charCounter.className =
                    "text-sm text-orange-500 mt-1 text-right";
            } else if (currentLength > maxLength) {
                charCounter.className = "text-sm text-red-500 mt-1 text-right";
            } else {
                charCounter.className = "text-sm text-gray-500 mt-1 text-right";
            }
        });
    }

    // Form submission handling
    contactForm.addEventListener("submit", function (e) {
        const originalText = submitBtn.innerHTML;
        const originalClasses = submitBtn.className;

        // Disable form and show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML =
            '<i class="fas fa-spinner fa-spin mr-2"></i>Sending...';
        submitBtn.className = originalClasses.replace(
            "hover:bg-blue-700",
            "bg-blue-400 cursor-not-allowed"
        );

        // Re-enable form after 3 seconds (in case of network issues)
        setTimeout(() => {
            if (submitBtn.disabled) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
                submitBtn.className = originalClasses;
            }
        }, 3000);
    });

    // Auto-resize textarea
    if (messageTextarea) {
        messageTextarea.addEventListener("input", function () {
            this.style.height = "auto";
            this.style.height = this.scrollHeight + "px";
        });
    }

    // Form validation enhancement
    const inputs = contactForm.querySelectorAll(
        "input[required], textarea[required]"
    );
    inputs.forEach((input) => {
        input.addEventListener("blur", function () {
            validateField(this);
        });

        input.addEventListener("input", function () {
            // Remove error styling on input
            this.classList.remove("border-red-500");
            const errorMsg = this.parentNode.querySelector(".text-red-600");
            if (errorMsg) {
                errorMsg.remove();
            }
        });
    });

    function validateField(field) {
        const value = field.value.trim();
        const fieldName = field.name;
        let isValid = true;
        let errorMessage = "";

        // Basic validation
        if (!value) {
            isValid = false;
            errorMessage = `${
                fieldName.charAt(0).toUpperCase() + fieldName.slice(1)
            } is required.`;
        } else {
            // Specific validations
            switch (fieldName) {
                case "email":
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(value)) {
                        isValid = false;
                        errorMessage = "Please enter a valid email address.";
                    }
                    break;
                case "message":
                    if (value.length > 2000) {
                        isValid = false;
                        errorMessage =
                            "Message is too long. Please keep it under 2000 characters.";
                    }
                    break;
            }
        }

        if (!isValid) {
            field.classList.add("border-red-500");
            showFieldError(field, errorMessage);
        } else {
            field.classList.remove("border-red-500");
            removeFieldError(field);
        }

        return isValid;
    }

    function showFieldError(field, message) {
        removeFieldError(field);
        const errorDiv = document.createElement("p");
        errorDiv.className = "mt-1 text-sm text-red-600";
        errorDiv.textContent = message;
        field.parentNode.appendChild(errorDiv);
    }

    function removeFieldError(field) {
        const errorMsg = field.parentNode.querySelector(".text-red-600");
        if (errorMsg) {
            errorMsg.remove();
        }
    }

    // Auto-hide success/error messages after 5 seconds
    const alertMessages = document.querySelectorAll(
        ".bg-green-100, .bg-red-100"
    );
    alertMessages.forEach((alert) => {
        setTimeout(() => {
            alert.style.transition = "opacity 0.5s ease-out";
            alert.style.opacity = "0";
            setTimeout(() => {
                alert.remove();
            }, 500);
        }, 5000);
    });
});
