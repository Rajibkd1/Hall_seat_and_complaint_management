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

    // Initialize with animations
    initializeAnimations();

    // Load initial rooms
    loadRooms();

    // Event Listeners
    if (loadRoomsBtn) {
        loadRoomsBtn.addEventListener("click", function () {
            addButtonClickEffect(this);
            loadRooms();
        });
    }

    if (backToRoomsBtn) {
        backToRoomsBtn.addEventListener("click", function () {
            addButtonClickEffect(this);
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

    function initializeAnimations() {
        // Add entrance animations to existing elements
        if (roomGrid) {
            roomGrid.classList.add("animate-fade-in");
        }

        // Add hover effects to selects
        [floorSelect, blockSelect].forEach((select) => {
            if (select) {
                select.addEventListener("focus", function () {
                    this.classList.add("animate-glow");
                });
                select.addEventListener("blur", function () {
                    this.classList.remove("animate-glow");
                });
            }
        });
    }

    function addButtonClickEffect(button) {
        button.classList.add("animate-pulse");
        setTimeout(() => {
            button.classList.remove("animate-pulse");
        }, 600);
    }

    function loadRooms() {
        currentFloor = floorSelect ? floorSelect.value : 1;
        currentBlock = blockSelect ? blockSelect.value : "Front";

        if (gridTitle) {
            gridTitle.innerHTML = `
                <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white text-sm font-bold animate-float">${currentFloor}</div>
                Floor ${currentFloor} - ${currentBlock} Block
            `;
        }

        // Show enhanced loading state
        if (roomContainer) {
            roomContainer.innerHTML = `
                <div class="col-span-full flex flex-col items-center justify-center py-12">
                    <div class="loading-spinner mb-4"></div>
                    <div class="text-gray-500 animate-pulse">Loading rooms...</div>
                </div>
            `;
        }

        // Fetch rooms with enhanced error handling
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
        document.getElementById("occupiedCount").textContent =
            totalCounts.occupied || 0;
        document.getElementById("availableCount").textContent =
            totalCounts.vacant || 0;
        document.getElementById("maintenanceCount").textContent =
            totalCounts.maintenance || 0;
        document.getElementById("totalRooms").textContent = totalRooms || 0;
    }

    function getStatusClass(status) {
        switch (status) {
            case "Occupied":
                return "border-gray-800 shadow-lg";
            case "Available":
                return "border-gray-300 hover:border-gray-400";
            case "Maintenance":
                return "border-gray-500";
            case "Partially Occupied":
                return "border-gray-600";
            default:
                return "border-gray-200";
        }
    }

    function getStatusColor(status) {
        switch (status) {
            case "Occupied":
                return "bg-gray-900";
            case "Available":
                return "bg-gray-300";
            case "Maintenance":
                return "bg-gray-500";
            case "Partially Occupied":
                return "bg-gray-700";
            default:
                return "bg-gray-200";
        }
    }

    function getStatusIcon(status) {
        switch (status) {
            case "Occupied":
                return "●";
            case "Available":
                return "○";
            case "Maintenance":
                return "◐";
            case "Partially Occupied":
                return "◑";
            default:
                return "○";
        }
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
            const statusColor = getStatusColor(room.status);

            roomElement.className = `room-item cursor-pointer transition-all duration-300 hover:scale-105 animate-fade-in`;
            roomElement.style.animationDelay = `${index * 0.1}s`;

            roomElement.innerHTML = `
                <div class="room-box w-40 h-48 rounded-2xl border-2 ${statusClass} bg-white hover:shadow-2xl transition-all duration-500 relative overflow-hidden p-4 group">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-sm font-bold text-gray-900">Room</div>
                        <div class="text-lg font-bold ${
                            statusColor === "bg-gray-900"
                                ? "text-gray-900"
                                : "text-gray-600"
                        }">${getStatusIcon(room.status)}</div>
                    </div>
                    <div class="text-3xl font-black text-gray-900 mb-3 text-center">${
                        room.room_number
                    }</div>
                    <div class="text-xs font-medium text-gray-500 mb-4 text-center uppercase tracking-wider">${
                        room.status
                    }</div>
                    <div class="space-y-2">
                        <div class="flex justify-between text-xs text-gray-600">
                            <span class="font-medium">Occupied</span>
                            <span class="font-bold">${room.occupied}</span>
                        </div>
                        <div class="flex justify-between text-xs text-gray-600">
                            <span class="font-medium">Available</span>
                            <span class="font-bold">${room.vacant}</span>
                        </div>
                        ${
                            room.maintenance > 0
                                ? `<div class="flex justify-between text-xs text-gray-500"><span class="font-medium">Maintenance</span><span class="font-bold">${room.maintenance}</span></div>`
                                : ""
                        }
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-br from-transparent via-gray-50 to-transparent opacity-0 group-hover:opacity-50 transition-opacity duration-500"></div>
                    <div class="absolute bottom-0 left-0 right-0 h-1 ${statusColor} opacity-20 group-hover:opacity-40 transition-opacity duration-300"></div>
                </div>
            `;

            roomElement.addEventListener("click", () => {
                addClickRipple(roomElement);
                loadRoomSeats(room.room_number);
            });

            // Add hover effects
            roomElement.addEventListener("mouseenter", () => {
                roomElement.classList.add("animate-float");
            });

            roomElement.addEventListener("mouseleave", () => {
                roomElement.classList.remove("animate-float");
            });

            roomContainer.appendChild(roomElement);
        });
    }

    function loadRoomSeats(roomNumber) {
        currentRoom = roomNumber;

        if (seatGridTitle) {
            seatGridTitle.innerHTML = `
                <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-teal-600 rounded-lg flex items-center justify-center text-white text-sm font-bold">R</div>
                Room ${roomNumber} - Floor ${currentFloor} ${currentBlock}
            `;
        }

        // Show enhanced loading state
        if (seatContainer) {
            seatContainer.innerHTML = `
                <div class="col-span-full flex flex-col items-center justify-center py-12">
                    <div class="loading-spinner mb-4"></div>
                    <div class="text-gray-500 animate-pulse">Loading seats...</div>
                </div>
            `;
        }

        // Show seat grid with animation
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
                    <div class="text-8xl mb-6 animate-bounce">🪑</div>
                    <div class="text-gray-600 text-xl font-semibold mb-2">No seats found for this room</div>
                    <div class="text-gray-400 text-sm">This room might not be configured yet</div>
                </div>
            `;
            return;
        }

        seatContainer.innerHTML = "";

        seats.forEach((seat, index) => {
            const seatElement = document.createElement("div");
            seatElement.className =
                "seat-item cursor-pointer transition-all duration-700 hover:scale-110 animate-fade-in transform hover:-translate-y-2";
            seatElement.style.animationDelay = `${index * 0.1}s`;
            seatElement.dataset.seatId = seat.seat_id;
            seatElement.dataset.status = seat.status;

            let statusClass = "";
            let statusText = "";
            let statusIcon = "";
            let textColor = "";
            let glowEffect = "";
            let borderEffect = "";

            switch (seat.status) {
                case "occupied":
                    statusClass =
                        "bg-gradient-to-br from-slate-800 via-slate-900 to-black text-white shadow-2xl";
                    statusText = "Occupied";
                    statusIcon = "👤";
                    textColor = "text-slate-800";
                    glowEffect = "shadow-slate-500/50";
                    borderEffect = "border-slate-700 hover:border-slate-600";
                    break;
                case "maintenance":
                    statusClass =
                        "bg-gradient-to-br from-amber-500 via-orange-600 to-red-600 text-white shadow-2xl";
                    statusText = "Maintenance";
                    statusIcon = "🔧";
                    textColor = "text-amber-600";
                    glowEffect = "shadow-amber-500/50";
                    borderEffect = "border-amber-500 hover:border-amber-400";
                    break;
                default:
                    statusClass =
                        "bg-gradient-to-br from-white via-gray-50 to-gray-100 text-slate-800 shadow-xl hover:shadow-2xl";
                    statusText = "Available";
                    statusIcon = "✨";
                    textColor = "text-emerald-600";
                    glowEffect =
                        "shadow-gray-300/50 hover:shadow-emerald-200/50";
                    borderEffect = "border-gray-200 hover:border-emerald-300";
            }

            // Display bed name properly (Fifth instead of E)
            const bedDisplay =
                seat.bed_number === "Fifth" ? "Fifth" : seat.bed_number;

            seatElement.innerHTML = `
                <div class="seat-container flex flex-col items-center group">
                    <div class="seat-box w-28 h-32 rounded-3xl border-3 ${borderEffect} ${statusClass} ${glowEffect} flex flex-col items-center justify-center text-sm font-bold relative overflow-hidden transition-all duration-700 group-hover:scale-105">
                        <!-- Animated Background Pattern -->
                        <div class="absolute inset-0 opacity-10">
                            <div class="absolute top-2 left-2 w-2 h-2 bg-white rounded-full animate-pulse"></div>
                            <div class="absolute top-4 right-3 w-1 h-1 bg-white rounded-full animate-pulse" style="animation-delay: 0.5s;"></div>
                            <div class="absolute bottom-3 left-3 w-1.5 h-1.5 bg-white rounded-full animate-pulse" style="animation-delay: 1s;"></div>
                        </div>
                        
                        <!-- Seat Icon with Animation -->
                        <div class="seat-icon text-3xl mb-2 transition-all duration-500 group-hover:scale-125 group-hover:rotate-12 z-10">${statusIcon}</div>
                        
                        <!-- Bed Label with Elegant Typography -->
                        <div class="bed-label font-black text-lg mb-1 z-10 tracking-wide">${bedDisplay}</div>
                        
                        <!-- Seat ID with Subtle Styling -->
                        <div class="seat-id text-xs opacity-80 font-medium z-10 bg-black/10 px-2 py-1 rounded-full">${
                            seat.room_number
                        }-${bedDisplay}</div>
                        
                        <!-- Hover Overlay with Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-br from-white/20 via-transparent to-black/10 opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                        
                        <!-- Bottom Accent Line -->
                        <div class="absolute bottom-0 left-0 right-0 h-2 bg-gradient-to-r from-transparent via-current to-transparent opacity-30 group-hover:opacity-60 transition-all duration-500 rounded-b-3xl"></div>
                        
                        <!-- Floating Particles Effect -->
                        <div class="absolute inset-0 pointer-events-none">
                            <div class="absolute top-1/4 left-1/4 w-1 h-1 bg-white/40 rounded-full animate-ping" style="animation-delay: 0.2s;"></div>
                            <div class="absolute top-3/4 right-1/4 w-0.5 h-0.5 bg-white/30 rounded-full animate-ping" style="animation-delay: 0.8s;"></div>
                        </div>
                    </div>
                    
                    <!-- Status Label with Enhanced Design -->
                    <div class="seat-status text-xs text-center mt-4 font-bold ${textColor} uppercase tracking-widest relative">
                        <div class="absolute inset-0 bg-current opacity-10 rounded-lg transform scale-110"></div>
                        <span class="relative z-10 px-3 py-1">${statusText}</span>
                    </div>
                    
                    <!-- Subtle Status Indicator -->
                    <div class="status-dot w-2 h-2 rounded-full mt-2 transition-all duration-300 ${
                        seat.status === "occupied"
                            ? "bg-slate-800"
                            : seat.status === "maintenance"
                            ? "bg-amber-500"
                            : "bg-emerald-400"
                    } group-hover:scale-150 group-hover:animate-pulse"></div>
                </div>
            `;

            seatElement.addEventListener("click", () => {
                addClickRipple(seatElement);
                handleSeatClick(seat);
            });

            // Enhanced hover effects with multiple animations
            seatElement.addEventListener("mouseenter", () => {
                seatElement.classList.add("animate-float");
                const seatBox = seatElement.querySelector(".seat-box");

                if (seat.status === "occupied") {
                    seatBox.classList.add(
                        "ring-4",
                        "ring-slate-400",
                        "ring-opacity-50"
                    );
                } else if (seat.status === "maintenance") {
                    seatBox.classList.add(
                        "ring-4",
                        "ring-amber-400",
                        "ring-opacity-50"
                    );
                } else {
                    seatBox.classList.add(
                        "ring-4",
                        "ring-emerald-400",
                        "ring-opacity-50"
                    );
                }

                // Add shimmer effect
                seatBox.classList.add("animate-shimmer");
            });

            seatElement.addEventListener("mouseleave", () => {
                seatElement.classList.remove("animate-float");
                const seatBox = seatElement.querySelector(".seat-box");
                seatBox.classList.remove(
                    "ring-4",
                    "ring-slate-400",
                    "ring-amber-400",
                    "ring-emerald-400",
                    "ring-opacity-50",
                    "animate-shimmer"
                );
            });

            seatContainer.appendChild(seatElement);
        });

        // Add staggered entrance animation
        const seatItems = seatContainer.querySelectorAll(".seat-item");
        seatItems.forEach((item, index) => {
            setTimeout(() => {
                item.classList.add("animate-slideInUp");
            }, index * 100);
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

        // Add retry mechanism with exponential backoff
        let retryCount = 0;
        const maxRetries = 3;
        
        function attemptFetch() {
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
                        // Handle API-level errors (success: false)
                        if (data.message) {
                            showDetailedError(data.message, data.error || "Unknown error occurred");
                        } else {
                            showDetailedError("Failed to load seat details", "The server returned an unexpected response");
                        }
                    }
                })
                .catch((error) => {
                    console.error("Error loading seat details:", error);
                    retryCount++;
                    
                    if (retryCount <= maxRetries) {
                        // Show retry message with countdown
                        const retryDelay = Math.pow(2, retryCount) * 1000; // Exponential backoff
                        showRetryMessage(retryCount, maxRetries, retryDelay, seatId);
                        
                        // Retry after delay
                        setTimeout(attemptFetch, retryDelay);
                    } else {
                        // Max retries reached, show final error
                        showDetailedError(
                            "Unable to load seat details", 
                            error.message || "Network error or server unavailable",
                            seatId
                        );
                    }
                });
        }
        
        // Start the first attempt
        attemptFetch();
    }

    function showRetryMessage(retryCount, maxRetries, delay, seatId) {
        const modalContent = document.getElementById("modalContent");
        if (!modalContent) return;
        
        const seconds = delay / 1000;
        modalContent.innerHTML = `
            <div class="flex flex-col items-center justify-center py-8 text-center">
                <div class="text-4xl mb-4">🔄</div>
                <div class="text-blue-600 font-semibold mb-2">Connection Issue</div>
                <div class="text-gray-500 text-sm mb-3">
                    Attempt ${retryCount} of ${maxRetries}. Retrying in ${seconds} seconds...
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                    <div class="bg-blue-500 h-2 rounded-full transition-all duration-${delay}" style="width: ${(retryCount/maxRetries)*100}%"></div>
                </div>
                <button onclick="showSeatDetails(${seatId})" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 text-sm">
                    Retry Now
                </button>
            </div>
        `;
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
                    ${seatId ? `
                    <button onclick="showSeatDetails(${seatId})" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 text-sm">
                        Try Again
                    </button>
                    ` : ''}
                    <button onclick="closeSeatModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 text-sm">
                        Close
                    </button>
                </div>
                ${seatId ? `
                <div class="mt-4 text-xs text-gray-400">
                    Seat ID: ${seatId}
                </div>
                ` : ''}
            </div>
        `;
        
        showNotification(title, "error");
    }

    function displaySeatDetails(seat, allotment) {
        const modalContent = document.getElementById("modalContent");
        if (!modalContent) return;

        let content = `
            <div class="space-y-6">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-4 rounded-xl border border-blue-200">
                    <h4 class="font-semibold text-blue-900 mb-3 flex items-center gap-2">
                        <div class="w-6 h-6 bg-blue-500 rounded-lg flex items-center justify-center text-white text-xs">🏠</div>
                        Seat Information
                    </h4>
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div><span class="font-medium text-blue-800">Room:</span> <span class="text-blue-600">${seat.room_number}</span></div>
                        <div><span class="font-medium text-blue-800">Bed:</span> <span class="text-blue-600">${seat.bed_number}</span></div>
                        <div><span class="font-medium text-blue-800">Floor:</span> <span class="text-blue-600">${seat.floor}</span></div>
                        <div><span class="font-medium text-blue-800">Block:</span> <span class="text-blue-600">${seat.block}</span></div>
                    </div>
                </div>
        `;

        if (allotment && allotment.student) {
            content += `
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-4 rounded-xl border border-green-200">
                    <h4 class="font-semibold text-green-900 mb-3 flex items-center gap-2">
                        <div class="w-6 h-6 bg-green-500 rounded-lg flex items-center justify-center text-white text-xs">👤</div>
                        Student Information
                    </h4>
                    <div class="space-y-2 text-sm">
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
                </div>
                <div class="pt-2">
                    <button onclick="releaseSeat(${
                        seat.seat_id
                    })" class="w-full bg-gradient-to-r from-red-500 to-red-600 text-white py-3 px-4 rounded-xl hover:from-red-600 hover:to-red-700 transition-all duration-200 font-medium shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        Release Seat
                    </button>
                </div>
            `;
        }

        content += "</div>";
        modalContent.innerHTML = content;
    }

    function showAssignmentModal(seatId) {
        const assignmentContent = document.getElementById("assignmentContent");
        if (!assignmentContent) return;

        assignmentContent.innerHTML = `
            <form id="seatAssignmentForm" class="space-y-6">
                <input type="hidden" name="seat_id" value="${seatId}">
                
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-4 rounded-xl border border-purple-200">
                    <label class="block text-sm font-semibold text-purple-900 mb-3 flex items-center gap-2">
                        <div class="w-5 h-5 bg-purple-500 rounded-lg flex items-center justify-center text-white text-xs">👥</div>
                        Select Student from Approved Applications:
                    </label>
                    
                    <!-- Search Input -->
                    <div class="mb-4">
                        <div class="relative">
                            <input type="text" id="studentSearch" placeholder="Search students by name, email, or university ID..." 
                                class="w-full border-2 border-purple-200 rounded-xl px-4 py-3 pl-10 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-white shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Student List Container -->
                    <div id="studentListContainer" class="max-h-64 overflow-y-auto border-2 border-purple-200 rounded-xl bg-white">
                        <div class="p-4 text-center text-purple-600">
                            <div class="loading-spinner mb-2"></div>
                            Loading approved applications...
                        </div>
                    </div>
                    
                    <!-- Selected Student Display -->
                    <div id="selectedStudentDisplay" class="mt-4 p-3 bg-green-50 border border-green-200 rounded-xl hidden">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white text-sm">✓</div>
                            <div>
                                <div class="font-semibold text-green-900" id="selectedStudentName"></div>
                                <div class="text-sm text-green-600" id="selectedStudentDetails"></div>
                            </div>
                        </div>
                    </div>
                    
                    <input type="hidden" name="application_id" id="selectedApplicationId" required>
                    <div class="mt-2 text-xs text-purple-600">Click on a student to select them for seat assignment</div>
                </div>
                
                <div class="flex gap-3">
                    <button type="submit" id="assignSeatBtn" disabled class="flex-1 bg-gradient-to-r from-gray-400 to-gray-500 text-white py-3 px-4 rounded-xl transition-all duration-200 font-medium shadow-lg flex items-center justify-center gap-2 cursor-not-allowed">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Select a Student First
                    </button>
                    <button type="button" onclick="closeAssignmentModal()" class="flex-1 bg-gradient-to-r from-gray-400 to-gray-500 text-white py-3 px-4 rounded-xl hover:from-gray-500 hover:to-gray-600 transition-all duration-200 font-medium shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancel
                    </button>
                </div>
            </form>
        `;

        // Load available students
        loadAvailableStudents();

        if (assignmentModal) {
            assignmentModal.classList.remove("hidden");
        }

        // Handle form submission
        const form = document.getElementById("seatAssignmentForm");
        if (form) {
            form.addEventListener("submit", handleSeatAssignment);
        }

        // Handle search functionality
        const searchInput = document.getElementById("studentSearch");
        if (searchInput) {
            searchInput.addEventListener("input", function() {
                filterStudents(this.value);
            });
        }
    }

    // Global variable to store all students for filtering
    let allStudents = [];
    let selectedStudent = null;

    function loadAvailableStudents() {
        const studentListContainer = document.getElementById("studentListContainer");
        if (!studentListContainer) return;

        // Show loading state
        studentListContainer.innerHTML = `
            <div class="p-4 text-center text-purple-600">
                <div class="loading-spinner mb-2"></div>
                Loading approved applications...
            </div>
        `;

        fetch(`${baseUrl}/seats/available-students`)
            .then((response) => response.json())
            .then((data) => {
                if (data.success && data.students.length > 0) {
                    allStudents = data.students;
                    displayStudentList(allStudents);
                } else {
                    studentListContainer.innerHTML = `
                        <div class="p-8 text-center text-gray-500">
                            <div class="text-4xl mb-3">📋</div>
                            <div class="font-medium mb-1">No Approved Applications</div>
                            <div class="text-sm text-gray-400">There are no approved applications available for seat assignment.</div>
                        </div>
                    `;
                }
            })
            .catch((error) => {
                console.error("Error loading students:", error);
                studentListContainer.innerHTML = `
                    <div class="p-8 text-center text-red-500">
                        <div class="text-4xl mb-3">⚠️</div>
                        <div class="font-medium mb-1">Error Loading Students</div>
                        <div class="text-sm text-red-400">Please try again later.</div>
                    </div>
                `;
            });
    }

    function displayStudentList(students) {
        const studentListContainer = document.getElementById("studentListContainer");
        if (!studentListContainer) return;

        if (students.length === 0) {
            studentListContainer.innerHTML = `
                <div class="p-8 text-center text-gray-500">
                    <div class="text-4xl mb-3">🔍</div>
                    <div class="font-medium mb-1">No Students Found</div>
                    <div class="text-sm text-gray-400">Try adjusting your search criteria.</div>
                </div>
            `;
            return;
        }

        studentListContainer.innerHTML = "";

        students.forEach((student, index) => {
            const studentElement = document.createElement("div");
            studentElement.className = `student-item cursor-pointer p-4 border-b border-purple-100 hover:bg-purple-50 transition-all duration-200 animate-fade-in`;
            studentElement.style.animationDelay = `${index * 0.05}s`;
            studentElement.dataset.applicationId = student.application_id;

            studentElement.innerHTML = `
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="font-semibold text-purple-900 mb-1">${student.name}</div>
                        <div class="text-sm text-purple-600 mb-1">${student.email}</div>
                        <div class="text-xs text-purple-500">Application ID: ${student.application_id}</div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 text-sm font-medium">
                            ${student.name.charAt(0).toUpperCase()}
                        </div>
                    </div>
                </div>
            `;

            studentElement.addEventListener("click", () => {
                selectStudent(student, studentElement);
            });

            // Add hover effects
            studentElement.addEventListener("mouseenter", () => {
                studentElement.classList.add("transform", "scale-105", "shadow-md");
            });

            studentElement.addEventListener("mouseleave", () => {
                if (!studentElement.classList.contains("selected")) {
                    studentElement.classList.remove("transform", "scale-105", "shadow-md");
                }
            });

            studentListContainer.appendChild(studentElement);
        });
    }

    function selectStudent(student, element) {
        // Remove previous selection
        const previousSelected = document.querySelector(".student-item.selected");
        if (previousSelected) {
            previousSelected.classList.remove("selected", "bg-green-100", "border-green-300");
            previousSelected.classList.add("hover:bg-purple-50");
        }

        // Add selection to current element
        element.classList.add("selected", "bg-green-100", "border-green-300");
        element.classList.remove("hover:bg-purple-50");

        // Update selected student
        selectedStudent = student;

        // Update hidden input
        const applicationIdInput = document.getElementById("selectedApplicationId");
        if (applicationIdInput) {
            applicationIdInput.value = student.application_id;
        }

        // Show selected student display
        const selectedDisplay = document.getElementById("selectedStudentDisplay");
        const selectedName = document.getElementById("selectedStudentName");
        const selectedDetails = document.getElementById("selectedStudentDetails");

        if (selectedDisplay && selectedName && selectedDetails) {
            selectedName.textContent = student.name;
            selectedDetails.textContent = `${student.email} • Application ID: ${student.application_id}`;
            selectedDisplay.classList.remove("hidden");
        }

        // Enable assign button
        const assignBtn = document.getElementById("assignSeatBtn");
        if (assignBtn) {
            assignBtn.disabled = false;
            assignBtn.classList.remove("bg-gradient-to-r", "from-gray-400", "to-gray-500", "cursor-not-allowed");
            assignBtn.classList.add("bg-gradient-to-r", "from-green-500", "to-green-600", "hover:from-green-600", "hover:to-green-700", "transform", "hover:scale-105");
            assignBtn.innerHTML = `
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Assign Seat to ${student.name}
            `;
        }

        // Add success animation
        element.classList.add("animate-pulse");
        setTimeout(() => {
            element.classList.remove("animate-pulse");
        }, 1000);
    }

    function filterStudents(searchTerm) {
        if (!searchTerm.trim()) {
            displayStudentList(allStudents);
            return;
        }

        const filteredStudents = allStudents.filter(student => {
            const searchLower = searchTerm.toLowerCase();
            return (
                student.name.toLowerCase().includes(searchLower) ||
                student.email.toLowerCase().includes(searchLower) ||
                student.application_id.toString().includes(searchLower)
            );
        });

        displayStudentList(filteredStudents);
    }

    function handleSeatAssignment(e) {
        e.preventDefault();

        const formData = new FormData(e.target);
        const data = Object.fromEntries(formData);

        // Show loading state
        const submitBtn = e.target.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML =
            '<div class="loading-spinner"></div> Assigning...';
        submitBtn.disabled = true;

        fetch(`${baseUrl}/seats/assign`, {
            method: "POST",
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
                    closeAssignmentModal();
                    loadRoomSeats(currentRoom); // Refresh the seat display
                } else {
                    showNotification(data.message, "error");
                }
            })
            .catch((error) => {
                console.error("Error assigning seat:", error);
                showNotification("Error assigning seat", "error");
            })
            .finally(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
    }

    function addClickRipple(element) {
        const ripple = document.createElement("div");
        ripple.className =
            "absolute inset-0 bg-white opacity-30 rounded-xl animate-ping pointer-events-none";
        element.style.position = "relative";
        element.appendChild(ripple);

        setTimeout(() => {
            ripple.remove();
        }, 600);
    }

    function showRoomGrid() {
        if (seatGrid) {
            seatGrid.classList.add("hidden");
        }
        if (roomGrid) {
            roomGrid.classList.remove("hidden");
            roomGrid.classList.add("animate-fade-in");
        }
    }

    function showSeatGrid() {
        if (roomGrid) {
            roomGrid.classList.add("hidden");
        }
        if (seatGrid) {
            seatGrid.classList.remove("hidden");
            seatGrid.classList.add("animate-fade-in");
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
                <button onclick="location.reload()" class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-6 py-2 rounded-xl hover:from-blue-600 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
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
        notification.className = `notification ${type} fixed top-4 right-4 z-50 px-6 py-4 rounded-xl text-white font-medium shadow-2xl transform transition-all duration-300 max-w-sm`;

        let icon = "";
        let bgClass = "";

        switch (type) {
            case "success":
                icon = "✅";
                bgClass = "bg-gradient-to-r from-green-500 to-emerald-600";
                break;
            case "error":
                icon = "❌";
                bgClass = "bg-gradient-to-r from-red-500 to-red-600";
                break;
            case "info":
                icon = "ℹ️";
                bgClass = "bg-gradient-to-r from-blue-500 to-indigo-600";
                break;
            default:
                icon = "📢";
                bgClass = "bg-gradient-to-r from-gray-500 to-gray-600";
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
    window.releaseSeat = function (seatId) {
        if (
            confirm(
                "Are you sure you want to release this seat? This action cannot be undone."
            )
        ) {
            fetch(`${baseUrl}/seats/${seatId}/release`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN":
                        document
                            .querySelector('meta[name="csrf-token"]')
                            ?.getAttribute("content") || "",
                },
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
                });
        }
    };

    window.closeAssignmentModal = closeAssignmentModal;
});
