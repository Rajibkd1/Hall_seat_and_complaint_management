<!-- Profile Validation Modal -->
<div id="profileValidationModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden opacity-0 transition-opacity duration-300">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 transform transition-all duration-300 scale-95">
        <div class="p-6">
            <!-- Modal Header -->
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-red-600">
                    <svg class="w-6 h-6 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    Profile Incomplete
                </h3>
                <button id="closeProfileModal" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="mb-6">
                <p class="text-gray-700 mb-4">
                    Please complete your profile before applying for a seat. The following information is missing:
                </p>
                
                <ul class="list-disc list-inside text-red-600 space-y-2">
                    @if(in_array('profile_image', $missingFields))
                    <li>Profile Image</li>
                    @endif
                    @if(in_array('id_card_front', $missingFields))
                    <li>Varsity ID Card (Front Side)</li>
                    @endif
                    @if(in_array('id_card_back', $missingFields))
                    <li>Varsity ID Card (Back Side)</li>
                    @endif
                    @if(in_array('phone', $missingFields))
                    <li>Mobile Number</li>
                    @endif
                    @if(in_array('university_id', $missingFields))
                    <li>University ID Number</li>
                    @endif
                </ul>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end space-x-3">
                <button id="cancelProfileModal" class="px-4 py-2 text-gray-600 hover:text-gray-800 font-medium">
                    Cancel
                </button>
                <a href="{{ route('student.profile.edit') }}" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition-colors duration-200">
                    Complete Profile
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    #profileValidationModal {
        backdrop-filter: blur(4px);
    }
    
    #profileValidationModal .bg-white {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
</style>
