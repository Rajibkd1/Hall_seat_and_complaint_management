document.addEventListener("DOMContentLoaded", function () {
    // Get base URL from global config, fallback to '/admin' if not set
    const baseUrl = window.seatManagementConfig?.baseUrl || "/admin";

    // Elements
    const floorSelect = document.getElementById("floor");
    const blockSelect = document.getElementById("block");
    const loadRoomsBtn = document.getElementById("loadRooms");
    const gridTitle = document.getElementById("gridTitle");
    const roomContainer = document.getElementById("roomContainer");
    const roomGrid = document.getElementById("roomGrid");
    const seatGrid = document.getElementById("seatGrid");
    const seatGridTitle = document.getElementById("seatGridTitle");
    const seatContainer = document.getElementById("seatContainer");
    const backToRoomsBtn = document.getElementById("backToRooms");

    // Modals
    const seatModal = document.getElementById("seatModal");
    const assignmentModal = document.getElementById("assignmentModal");
    const closeModalBtn = document.getElementById("closeModal");
    const closeAssignmentModalBtn = document.getElementById(
        "closeAssignmentModal"
    );

    let currentFloor = 1;
    let currentBlock = "Front";
    let currentRoom = null;

    // Load initial rooms
    loadRooms();

    // Event Listeners
    if (loadRoomsBtn) {
        loadRoomsBtn.addEventListener("click", function () {
            loadRooms();
        });
    }

    if (backToRoomsBtn) {
        backToRoomsBtn.addEventListener("click", function () {
            showRoomGrid();
            loadRooms();
        });
    }

    if (closeModalBtn) {
        closeModalBtn.addEventListener("click", closeSeatModal);
    }

    if (closeAssignmentModalBtn) {
        closeAssignmentModalBtn.addEventListener("click", closeAssignmentModal);
    }

    // Close modals when clicking outside
    if (seatModal) {
        seatModal.addEventListener("click", function (e) {
            if (e.target === seatModal) {
                closeSeatModal();
            }
        });
    }

    if (assignmentModal) {
        assignmentModal.addEventListener("click", function (e) {
            if (e.target === assignmentModal) {
                closeAssignmentModal();
            }
        });
    }

    // Add keyboard navigation
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            closeSeatModal();
            closeAssignmentModal();
        }
    });

    function loadRooms() {
        currentFloor = floorSelect ? floorSelect.value : 1;
        currentBlock = blockSelect ? blockSelect.value : "Front";

        if (gridTitle) {
            gridTitle.innerHTML = `
                <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center text-gray-600 text-sm font-bold">${currentFloor}</div>
                Floor ${currentFloor} - ${currentBlock} Block
            `;
        }

        // Show loading state
        if (roomContainer) {
            roomContainer.innerHTML = `
                <div class="col-span-full flex flex-col items-center justify-center py-12">
                    <div class="loading-spinner mb-4"></div>
                    <div class="text-gray-500">Loading rooms...</div>
                </div>
            `;
        }

        // Fetch rooms
        fetch(
            `${baseUrl}/seats/rooms?floor=${currentFloor}&block=${currentBlock}`
        )
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then((data) => {
                if (data.success) {
                    displayRooms(data.rooms);
                    updateStatusCounts(data.totalCounts, data.rooms.length);
                } else {
                    showNotification("Failed to load rooms", "error");
                }
            })
            .catch((error) => {
                console.error("Error loading rooms:", error);
                showNotification(
                    "Error loading rooms. Please try again.",
                    "error"
                );
                displayErrorState("rooms");
            });
    }

    function updateStatusCounts(totalCounts, totalRooms) {
        const occupiedCount = document.getElementById("occupiedCount");
        const availableCount = document.getElementById("availableCount");
        const maintenanceCount = document.getElementById("maintenanceCount");
        const totalRoomsElement = document.getElementById("totalRooms");

        if (occupiedCount)
            occupiedCount.textContent = totalCounts.occupied || 0;
        if (availableCount)
            availableCount.textContent = totalCounts.vacant || 0;
        if (maintenanceCount)
            maintenanceCount.textContent = totalCounts.maintenance || 0;
        if (totalRoomsElement) totalRoomsElement.textContent = totalRooms || 0;
    }

    function getStatusClass(status) {
        switch (status) {
            case "Occupied":
                return "border-gray-800";
            case "Available":
                return "border-green-500";
            case "Maintenance":
                return "border-yellow-500";
            case "Partially Occupied":
                return "border-blue-500";
            default:
                return "border-gray-300";
        }
    }

    function createPieChart(occupied, vacant, maintenance) {
        const total = occupied + vacant + maintenance;
        if (total === 0)
            return '<div class="pie-chart" style="background: #e5e7eb;"></div>';

        const occupiedAngle = (occupied / total) * 360;
        const vacantAngle = occupiedAngle + (vacant / total) * 360;

        return `
            <div class="pie-chart" style="--available-angle: ${occupiedAngle}deg; --occupied-angle: ${vacantAngle}deg;"></div>
            <div class="pie-chart-legend">
                ${
                    vacant > 0
                        ? `<div class="legend-item"><div class="legend-color legend-available"></div><span>${vacant}</span></div>`
                        : ""
                }
                ${
                    occupied > 0
                        ? `<div class="legend-item"><div class="legend-color legend-occupied"></div><span>${occupied}</span></div>`
                        : ""
                }
                ${
                    maintenance > 0
                        ? `<div class="legend-item"><div class="legend-color legend-maintenance"></div><span>${maintenance}</span></div>`
                        : ""
                }
            </div>
        `;
    }

    function displayRooms(rooms) {
        if (!roomContainer) return;

        if (rooms.length === 0) {
            roomContainer.innerHTML = `
                <div class="col-span-full text-center py-12">
                    <div class="text-6xl mb-4">🏢</div>
                    <div class="text-gray-500 text-lg">No rooms found for this floor and block.</div>
                    <div class="text-gray-400 text-sm mt-2">Try selecting a different floor or block.</div>
                </div>
            `;
            return;
        }

        roomContainer.innerHTML = "";

        rooms.forEach((room, index) => {
            const roomElement = document.createElement("div");
            const statusClass = getStatusClass(room.status);

            roomElement.className = `room-item cursor-pointer transition-all duration-200 animate-fade-in`;
            roomElement.style.animationDelay = `${index * 0.1}s`;

            const pieChart = createPieChart(
                room.occupied,
                room.vacant,
                room.maintenance
            );

            roomElement.innerHTML = `
                <div class="room-box border-2 ${statusClass} bg-white hover:shadow-lg transition-all duration-200 p-4">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-sm font-semibold text-gray-700">Room</div>
                        <div class="w-3 h-3 rounded-full ${getStatusColor(
                            room.status
                        )}"></div>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 mb-3 text-center">${
                        room.room_number
                    }</div>
                    
                    <div class="flex justify-center mb-3">
                        ${pieChart}
                    </div>
                    
                    <div class="text-xs font-medium text-gray-500 mb-3 text-center uppercase">${
                        room.status
                    }</div>
                    <div class="space-y-1">
                        <div class="flex justify-between text-xs text-gray-600">
                            <span>Available</span>
                            <span class="font-semibold text-green-600">${
                                room.vacant
                            }</span>
                        </div>
                        <div class="flex justify-between text-xs text-gray-600">
                            <span>Occupied</span>
                            <span class="font-semibold text-gray-800">${
                                room.occupied
                            }</span>
                        </div>
                        ${
                            room.maintenance > 0
                                ? `
                        <div class="flex justify-between text-xs text-gray-600">
                            <span>Maintenance</span>
                            <span class="font-semibold text-orange-600">${room.maintenance}</span>
                        </div>`
                                : ""
                        }
                    </div>
                </div>
            `;

            roomElement.addEventListener("click", () => {
                loadRoomSeats(room.room_number);
            });

            roomContainer.appendChild(roomElement);
        });
    }

    function getStatusColor(status) {
        switch (status) {
            case "Occupied":
                return "bg-gray-800";
            case "Available":
                return "bg-green-500";
            case "Maintenance":
                return "bg-yellow-500";
            case "Partially Occupied":
                return "bg-blue-500";
            default:
                return "bg-gray-300";
        }
    }

    function loadRoomSeats(roomNumber) {
        currentRoom = roomNumber;

        if (seatGridTitle) {
            seatGridTitle.innerHTML = `
                <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center text-gray-600 text-sm font-bold">R</div>
                Room ${roomNumber} - Floor ${currentFloor} ${currentBlock}
            `;
        }

        // Show loading state
        if (seatContainer) {
            seatContainer.innerHTML = `
                <div class="col-span-full flex flex-col items-center justify-center py-12">
                    <div class="loading-spinner mb-4"></div>
                    <div class="text-gray-500">Loading seats...</div>
                </div>
            `;
        }

        // Show seat grid
        showSeatGrid();

        // Fetch room seats
        fetch(
            `${baseUrl}/seats/room-seats?floor=${currentFloor}&block=${currentBlock}&room_number=${roomNumber}`
        )
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then((data) => {
                if (data.success) {
                    displaySeats(data.seats);
                } else {
                    showNotification("Failed to load seats", "error");
                }
            })
            .catch((error) => {
                console.error("Error loading seats:", error);
                showNotification(
                    "Error loading seats. Please try again.",
                    "error"
                );
                displayErrorState("seats");
            });
    }

    function displaySeats(seats) {
        if (!seatContainer) return;

        if (seats.length === 0) {
            seatContainer.innerHTML = `
                <div class="col-span-full text-center py-16">
                    <div class="text-6xl mb-4">🪑</div>
                    <div class="text-gray-600 text-lg font-semibold mb-2">No seats found for this room</div>
                    <div class="text-gray-400 text-sm">This room might not be configured yet</div>
                </div>
            `;
            return;
        }

        seatContainer.innerHTML = "";

        seats.forEach((seat, index) => {
            const seatElement = document.createElement("div");
            seatElement.className =
                "seat-item cursor-pointer transition-all duration-200 animate-fade-in";
            seatElement.style.animationDelay = `${index * 0.05}s`;
            seatElement.dataset.seatId = seat.seat_id;
            seatElement.dataset.status = seat.status;

            let statusClass = "";
            let statusText = "";
            let textColor = "";

            switch (seat.status) {
                case "occupied":
                    statusClass = "seat-occupied";
                    statusText = "Occupied";
                    textColor = "text-gray-800";
                    break;
                case "maintenance":
                    statusClass = "seat-maintenance";
                    statusText = "Maintenance";
                    textColor = "text-yellow-600";
                    break;
                default:
                    statusClass = "seat-available";
                    statusText = "Available";
                    textColor = "text-green-600";
            }

            // Display bed name properly (Fifth instead of E)
            const bedDisplay =
                seat.bed_number === "Fifth" ? "Fifth" : seat.bed_number;

            seatElement.innerHTML = `
                <div class="seat-container flex flex-col items-center">
                    <div class="seat-box ${statusClass} flex items-center justify-center text-sm font-bold">
                        ${bedDisplay}
                    </div>
                    <div class="seat-status text-xs text-center mt-2 font-medium ${textColor} uppercase">
                        ${statusText}
                    </div>
                </div>
            `;

            seatElement.addEventListener("click", () => {
                handleSeatClick(seat);
            });

            seatContainer.appendChild(seatElement);
        });
    }

    function handleSeatClick(seat) {
        if (seat.status === "occupied") {
            showSeatDetails(seat.seat_id);
        } else if (seat.status === "vacant") {
            // Redirect to seat assignment page instead of showing modal
            window.location.href = `${baseUrl}/seats/${seat.seat_id}/assign`;
        } else {
            showNotification(
                "This seat is under maintenance and cannot be assigned.",
                "info"
            );
        }
    }

    function showSeatDetails(seatId) {
        // Show loading in modal
        const modalContent = document.getElementById("modalContent");
        if (modalContent) {
            modalContent.innerHTML = `
                <div class="flex flex-col items-center justify-center py-8">
                    <div class="loading-spinner mb-4"></div>
                    <div class="text-gray-500">Loading seat details...</div>
                </div>
            `;
        }

        if (seatModal) {
            seatModal.classList.remove("hidden");
        }

        fetch(`${baseUrl}/seats/${seatId}/details`)
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then((data) => {
                if (data.success) {
                    displaySeatDetails(data.seat, data.allotment);
                } else {
                    showDetailedError(
                        data.message || "Failed to load seat details",
                        data.error || "Unknown error occurred"
                    );
                }
            })
            .catch((error) => {
                console.error("Error loading seat details:", error);
                showDetailedError(
                    "Unable to load seat details",
                    error.message || "Network error or server unavailable",
                    seatId
                );
            });
    }

    function showDetailedError(title, message, seatId = null) {
        const modalContent = document.getElementById("modalContent");
        if (!modalContent) return;

        modalContent.innerHTML = `
            <div class="flex flex-col items-center justify-center py-8 text-center">
                <div class="text-6xl mb-4">⚠️</div>
                <div class="text-red-600 font-semibold mb-2">${title}</div>
                <div class="text-gray-500 text-sm mb-4 max-w-md">${message}</div>
                <div class="flex gap-2">
                    ${
                        seatId
                            ? `
                    <button onclick="showSeatDetails(${seatId})" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 text-sm">
                        Try Again
                    </button>
                    `
                            : ""
                    }
                    <button onclick="closeSeatModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 text-sm">
                        Close
                    </button>
                </div>
            </div>
        `;

        showNotification(title, "error");
    }

    function displaySeatDetails(seat, allotment) {
        const modalContent = document.getElementById("modalContent");
        if (!modalContent) return;

        let content = `
            <div class="space-y-4">
                <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                    <h4 class="font-semibold text-blue-900 mb-3">Seat Information</h4>
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div><span class="font-medium text-blue-800">Room:</span> <span class="text-blue-600">${seat.room_number}</span></div>
                        <div><span class="font-medium text-blue-800">Bed:</span> <span class="text-blue-600">${seat.bed_number}</span></div>
                        <div><span class="font-medium text-blue-800">Floor:</span> <span class="text-blue-600">${seat.floor}</span></div>
                        <div><span class="font-medium text-blue-800">Block:</span> <span class="text-blue-600">${seat.block}</span></div>
                    </div>
                </div>
        `;

        if (allotment && allotment.student) {
            // Generate profile image HTML
            let profileImageHtml = "";
            if (allotment.student.profile_image) {
                profileImageHtml = `
                    <img src="/storage/${allotment.student.profile_image}" 
                         alt="Profile Image" 
                         class="w-24 h-32 rounded-lg object-cover border-2 border-green-300">
                `;
            } else {
                const initials = (allotment.student.name || "N")
                    .charAt(0)
                    .toUpperCase();
                profileImageHtml = `
                    <div class="w-24 h-32 bg-green-500 rounded-lg flex items-center justify-center text-white text-2xl font-bold border-2 border-green-300">
                        ${initials}
                    </div>
                `;
            }

            // Check if current user is provost or admin to show release button
            const userRole = window.seatManagementConfig?.userRole;
            const canReleaseSeat =
                userRole === "provost" || userRole === "admin";
            const releaseButtonHtml = canReleaseSeat
                ? `
                <div class="pt-4">
                    <button onclick="showReleaseModal(${seat.seat_id}, '${allotment.student.name}', '${allotment.student.email}')" class="w-full bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition-colors duration-200 font-medium">
                        Release Seat
                    </button>
                </div>
            `
                : "";

            content += `
                <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                    <h4 class="font-semibold text-green-900 mb-3">Student Information</h4>
                    <div class="flex items-start gap-4">
                        <div class="flex-1 space-y-2 text-sm">
                            <div><span class="font-medium text-green-800">Name:</span> <span class="text-green-600">${
                                allotment.student.name || "N/A"
                            }</span></div>
                            <div><span class="font-medium text-green-800">Email:</span> <span class="text-green-600">${
                                allotment.student.email || "N/A"
                            }</span></div>
                            <div><span class="font-medium text-green-800">Phone:</span> <span class="text-green-600">${
                                allotment.student.phone || "N/A"
                            }</span></div>
                            <div><span class="font-medium text-green-800">Start Date:</span> <span class="text-green-600">${new Date(
                                allotment.start_date
                            ).toLocaleDateString()}</span></div>
                        </div>
                        <div class="flex-shrink-0">
                            ${profileImageHtml}
                        </div>
                    </div>
                </div>
                ${releaseButtonHtml}
            `;
        }

        content += "</div>";
        modalContent.innerHTML = content;
    }

    function showRoomGrid() {
        if (seatGrid) {
            seatGrid.classList.add("hidden");
        }
        if (roomGrid) {
            roomGrid.classList.remove("hidden");
        }
    }

    function showSeatGrid() {
        if (roomGrid) {
            roomGrid.classList.add("hidden");
        }
        if (seatGrid) {
            seatGrid.classList.remove("hidden");
        }
    }

    function closeSeatModal() {
        if (seatModal) {
            seatModal.classList.add("hidden");
        }
    }

    function closeAssignmentModal() {
        if (assignmentModal) {
            assignmentModal.classList.add("hidden");
        }
    }

    function displayErrorState(type) {
        const container = type === "rooms" ? roomContainer : seatContainer;
        if (!container) return;

        container.innerHTML = `
            <div class="col-span-full text-center py-12">
                <div class="text-6xl mb-4">⚠️</div>
                <div class="text-gray-500 text-lg mb-2">Oops! Something went wrong</div>
                <div class="text-gray-400 text-sm mb-4">We couldn't load the ${type}. Please try again.</div>
                <button onclick="location.reload()" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-200">
                    Retry
                </button>
            </div>
        `;
    }

    function showNotification(message, type = "info") {
        // Remove existing notifications
        const existingNotifications =
            document.querySelectorAll(".notification");
        existingNotifications.forEach((notification) => notification.remove());

        const notification = document.createElement("div");
        notification.className = `notification ${type} fixed top-4 right-4 z-50 px-6 py-4 rounded-lg text-white font-medium shadow-lg transform transition-all duration-300 max-w-sm`;

        let icon = "";
        let bgClass = "";

        switch (type) {
            case "success":
                icon = "✅";
                bgClass = "bg-green-500";
                break;
            case "error":
                icon = "❌";
                bgClass = "bg-red-500";
                break;
            case "info":
                icon = "ℹ️";
                bgClass = "bg-blue-500";
                break;
            default:
                icon = "📢";
                bgClass = "bg-gray-500";
        }

        notification.className += ` ${bgClass}`;
        notification.innerHTML = `
            <div class="flex items-center gap-3">
                <span class="text-xl">${icon}</span>
                <span>${message}</span>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-2 text-white hover:text-gray-200 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        `;

        document.body.appendChild(notification);

        // Animate in
        setTimeout(() => {
            notification.style.transform = "translateX(0)";
        }, 10);

        // Auto remove after 5 seconds
        setTimeout(() => {
            notification.style.transform = "translateX(100%)";
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 5000);
    }

    // Global functions for inline event handlers
    window.showReleaseModal = function (seatId, studentName, studentEmail) {
        const modalContent = document.getElementById("modalContent");
        if (!modalContent) return;

        modalContent.innerHTML = `
            <div class="space-y-4">
                <div class="bg-red-50 p-4 rounded-lg border border-red-200">
                    <h4 class="font-semibold text-red-900 mb-3">Release Seat Confirmation</h4>
                    <p class="text-red-800 text-sm mb-4">
                        You are about to release the seat for <strong>${studentName}</strong>. 
                        Please provide a reason that will be sent to the student via email.
                    </p>
                </div>
                
                <form id="releaseSeatForm" class="space-y-4">
                    <input type="hidden" name="seat_id" value="${seatId}">
                    <input type="hidden" name="student_email" value="${studentEmail}">
                    <input type="hidden" name="student_name" value="${studentName}">
                    
                    <div>
                        <label for="release_reason" class="block text-sm font-bold text-gray-700 mb-2">
                            Reason for Release <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            name="release_reason" 
                            id="release_reason" 
                            rows="4" 
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 resize-none" 
                            placeholder="Please explain why this seat is being released. This message will be sent to the student."
                            required
                        ></textarea>
                        <p class="mt-2 text-xs text-gray-500">This message will be included in the email notification to ${studentName}</p>
                    </div>
                    
                    <div class="flex gap-3 pt-4">
                        <button 
                            type="button" 
                            onclick="closeSeatModal()" 
                            class="flex-1 bg-gray-500 hover:bg-gray-600 text-white py-3 px-4 rounded-lg transition-colors duration-200 font-medium"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="flex-1 bg-red-500 text-white py-3 px-4 rounded-lg hover:bg-red-600 transition-colors duration-200 font-medium"
                        >
                            Release Seat & Send Email
                        </button>
                    </div>
                </form>
            </div>
        `;

        // Handle form submission
        const form = document.getElementById("releaseSeatForm");
        if (form) {
            form.addEventListener("submit", function (e) {
                e.preventDefault();

                const formData = new FormData(e.target);
                const data = Object.fromEntries(formData);

                // Show loading state
                const submitBtn = e.target.querySelector(
                    'button[type="submit"]'
                );
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML =
                    '<div class="loading-spinner"></div> Releasing...';
                submitBtn.disabled = true;

                fetch(`${baseUrl}/seats/${seatId}/release`, {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN":
                            document
                                .querySelector('meta[name="csrf-token"]')
                                ?.getAttribute("content") || "",
                    },
                    body: JSON.stringify(data),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            showNotification(data.message, "success");
                            closeSeatModal();
                            loadRoomSeats(currentRoom); // Refresh the seat display
                        } else {
                            showNotification(data.message, "error");
                        }
                    })
                    .catch((error) => {
                        console.error("Error releasing seat:", error);
                        showNotification("Error releasing seat", "error");
                    })
                    .finally(() => {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    });
            });
        }
    };

    window.closeAssignmentModal = closeAssignmentModal;
    window.closeSeatModal = closeSeatModal;
    window.showSeatDetails = showSeatDetails;
});
