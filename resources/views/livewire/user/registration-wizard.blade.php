<div class="bg-primary min-h-screen text-white font-sans py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-10">
            <a href="{{ route('home') }}" class="inline-block hover:scale-105 transition-transform duration-300">
                <h1
                    class="text-3xl md:text-5xl font-heading font-black text-white drop-shadow-md tracking-wider uppercase">
                    CAPEU 2026 Registration
                </h1>
                <p class="mt-2 text-highlight font-medium">Complete your application below</p>
            </a>
        </div>

        <!-- Progress Indicator -->
        <div class="mb-12 relative px-2 sm:px-4">
            <!-- Background & Progress Track -->
            <div
                class="absolute top-4 sm:top-5 left-6 sm:left-9 right-6 sm:right-9 h-1 bg-white/10 rounded-full overflow-hidden">
                <!-- Active Progress Line -->
                <div class="h-full bg-accent rounded-full transition-all duration-500 shadow-[0_0_15px_rgba(202,255,0,0.8)]"
                    style="width: {{ (($currentStep - 1) / ($totalSteps - 1)) * 100 }}%">
                </div>
            </div>

            <!-- Steps -->
            <div class="relative flex justify-between">
                @for ($i = 1; $i <= $totalSteps; $i++)
                    <div class="flex flex-col items-center">
                        <div
                            class="w-8 h-8 sm:w-10 sm:h-10 rounded-full flex items-center justify-center {{ $currentStep >= $i ? 'bg-accent text-primary ring-4 ring-primary' : 'bg-primary border-2 border-white/10 text-white/50' }} text-xs sm:text-base font-black shadow-xl transition-all duration-300 z-10">
                            {{ $i }}
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        <!-- Form Card -->
        <div
            class="bg-white/5 backdrop-blur-lg border border-white/10 p-6 md:p-10 rounded-[2rem] shadow-2xl relative overflow-hidden">
            <form wire:submit.prevent="submit">

                @php
                    $inputClass =
                        'w-full bg-primary border border-white/20 rounded-xl px-4 py-3 text-white focus:border-highlight focus:ring-1 focus:ring-highlight outline-none transition font-sans placeholder-white/30';
                    $selectClass =
                        "w-full bg-primary border border-white/20 rounded-xl px-4 py-3 text-white focus:border-highlight focus:ring-1 focus:ring-highlight outline-none transition font-sans [&>option]:bg-primary appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2024%2024%22%20stroke%3D%22%23CAFF00%22%3E%3Cpath%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20stroke-width%3D%222%22%20d%3D%22M19%209l-7%207-7-7%22%2F%3E%3C%2Fsvg%3E')] bg-[length:1.25rem_1.25rem] bg-[right_1rem_center] bg-no-repeat pr-10";
                    $checkboxClass =
                        "appearance-none w-5 h-5 bg-white/10 rounded-full border-2 border-white/30 checked:bg-accent checked:border-accent focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 focus:ring-offset-primary cursor-pointer transition relative checked:after:content-[''] checked:after:absolute checked:after:left-[5px] checked:after:top-[2px] checked:after:w-[6px] checked:after:h-[10px] checked:after:border-primary checked:after:border-r-2 checked:after:border-b-2 checked:after:rotate-45";
                @endphp

                <!-- Step 1: Personal Information -->
                @if ($currentStep == 1)
                    <div class="space-y-6">
                        <h2 class="text-2xl font-heading font-bold text-accent border-b border-white/10 pb-2">Account &
                            Personal Information</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div
                                class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6 p-4 bg-white/5 rounded-2xl border border-white/10">
                                <div>
                                    <label class="block font-heading font-bold text-sm mb-2 text-white/80">Email
                                        Address</label>
                                    <input type="email" wire:model.blur="personal_info.email" class="{{ $inputClass }}"
                                        placeholder="john@example.com">
                                    @error('personal_info.email')
                                        <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block font-heading font-bold text-sm mb-2 text-white/80">WhatsApp
                                        Number</label>
                                    <input type="tel" wire:model.blur="personal_info.whatsapp"
                                        class="{{ $inputClass }}" placeholder="+62...">
                                    @error('personal_info.whatsapp')
                                        <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div x-data="{ show: false }">
                                    <label
                                        class="block font-heading font-bold text-sm mb-2 text-white/80">Password</label>
                                    <div class="relative group">
                                        <input :type="show ? 'text' : 'password'" wire:model.blur="password"
                                            class="{{ $inputClass }} pr-12" placeholder="••••••••">
                                        <button type="button" @click="show = !show"
                                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-white/40 hover:text-highlight transition-colors duration-200 focus:outline-none">
                                            <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor"
                                                stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                            <svg x-show="show" x-cloak class="w-5 h-5" fill="none"
                                                stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                            </svg>
                                        </button>
                                    </div>
                                    @error('password')
                                        <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div x-data="{ show: false }">
                                    <label class="block font-heading font-bold text-sm mb-2 text-white/80">Confirm
                                        Password</label>
                                    <div class="relative group">
                                        <input :type="show ? 'text' : 'password'" wire:model.blur="password_confirmation"
                                            class="{{ $inputClass }} pr-12" placeholder="••••••••">
                                        <button type="button" @click="show = !show"
                                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-white/40 hover:text-highlight transition-colors duration-200 focus:outline-none">
                                            <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor"
                                                stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                            <svg x-show="show" x-cloak class="w-5 h-5" fill="none"
                                                stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="md:col-span-2 pt-4">
                                <label class="block font-heading font-bold text-sm mb-2 text-white/80">Full Name (as in
                                    Passport)</label>
                                <input type="text" wire:model.blur="personal_info.full_name" class="{{ $inputClass }}"
                                    placeholder="John Doe">
                                @error('personal_info.full_name')
                                    <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block font-heading font-bold text-sm mb-2 text-white/80">Gender</label>
                                <select wire:model.blur="personal_info.gender" class="{{ $selectClass }}">
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Prefer not to say">Prefer not to say</option>
                                </select>
                                @error('personal_info.gender')
                                    <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block font-heading font-bold text-sm mb-2 text-white/80">Date of
                                    Birth</label>
                                <input type="date" wire:model.blur="personal_info.dob"
                                    class="{{ $inputClass }} [color-scheme:dark]">
                                @error('personal_info.dob')
                                    <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label
                                    class="block font-heading font-bold text-sm mb-2 text-white/80">Nationality</label>
                                <input type="text" wire:model.blur="personal_info.nationality"
                                    class="{{ $inputClass }}" placeholder="Indonesian">
                                @error('personal_info.nationality')
                                    <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block font-heading font-bold text-sm mb-2 text-white/80">Passport Number
                                    / ID Card</label>
                                <input type="text" wire:model.blur="personal_info.passport_id"
                                    class="{{ $inputClass }}">
                                @error('personal_info.passport_id')
                                    <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Step 2: Academic Information -->
                @if ($currentStep == 2)
                    <div class="space-y-6">
                        <h2 class="text-2xl font-heading font-bold text-accent border-b border-white/10 pb-2">Academic
                            Information</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block font-heading font-bold text-sm mb-2 text-white/80">University
                                    Name</label>
                                <input type="text" wire:model.blur="academic_info.university_name"
                                    class="{{ $inputClass }}">
                                @error('academic_info.university_name')
                                    <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block font-heading font-bold text-sm mb-2 text-white/80">Country of
                                    University</label>
                                <input type="text" wire:model.blur="academic_info.country"
                                    class="{{ $inputClass }}">
                                @error('academic_info.country')
                                    <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block font-heading font-bold text-sm mb-2 text-white/80">Study Program /
                                    Major</label>
                                <input type="text" wire:model.blur="academic_info.major" class="{{ $inputClass }}">
                                @error('academic_info.major')
                                    <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block font-heading font-bold text-sm mb-2 text-white/80">Year of Study /
                                    Semester</label>
                                <select wire:model.blur="academic_info.year_semester" class="{{ $selectClass }}">
                                    <option value="">Select Year</option>
                                    <option value="1st Year">1st Year</option>
                                    <option value="2nd Year">2nd Year</option>
                                    <option value="3rd Year">3rd Year</option>
                                    <option value="4th Year">4th Year</option>
                                    <option value="Others">Others</option>
                                </select>
                                @error('academic_info.year_semester')
                                    <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block font-heading font-bold text-sm mb-2 text-white/80">Student ID
                                    Number</label>
                                <input type="text" wire:model.blur="academic_info.student_id"
                                    class="{{ $inputClass }}">
                                @error('academic_info.student_id')
                                    <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block font-heading font-bold text-sm mb-2 text-white/80">Current GPA</label>
                                <input type="number" step="0.01" wire:model.blur="academic_info.gpa"
                                    class="{{ $inputClass }}" placeholder="e.g. 3.75">
                                @error('academic_info.gpa')
                                    <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Step 3: Participation Details -->
                @if ($currentStep == 3)
                    <div class="space-y-6">
                        <h2 class="text-2xl font-heading font-bold text-accent border-b border-white/10 pb-2">
                            Participation Details</h2>

                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label class="block font-heading font-bold text-sm mb-2 text-white/80">Type of
                                    Participant</label>
                                <select wire:model.blur="participant_type" class="{{ $selectClass }}">
                                    <option value="">Select Type</option>
                                    <option value="CAPEU Member ($130 USD)">CAPEU Member ($130 USD)</option>
                                    <option value="Non-CAPEU Member ($150 USD)">Non-CAPEU Member ($150 USD)</option>
                                </select>
                                @error('participant_type')
                                    <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block font-heading font-bold text-sm mb-2 text-white/80">Motivation to
                                    Join (100–200 words)</label>
                                <textarea wire:model.blur="participation_details.motivation" rows="4" class="{{ $inputClass }}"></textarea>
                                @error('participation_details.motivation')
                                    <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block font-heading font-bold text-sm mb-2 text-white/80">Relevant
                                    Experience (Optional)</label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-2">
                                    @foreach (['Organization', 'Volunteering', 'International Program', 'Others'] as $exp)
                                        <label class="flex items-center space-x-3 cursor-pointer group">
                                            <input type="checkbox"
                                                wire:model.blur="participation_details.relevant_experience"
                                                value="{{ $exp }}" class="{{ $checkboxClass }}">
                                            <span
                                                class="font-sans text-sm group-hover:text-accent transition">{{ $exp }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div>
                                <label class="block font-heading font-bold text-sm mb-2 text-white/80">Description of
                                    Experience (if any)</label>
                                <textarea wire:model.blur="participation_details.experience_description" rows="3" class="{{ $inputClass }}"></textarea>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Step 4: Health & Emergency -->
                @if ($currentStep == 4)
                    <div class="space-y-6">
                        <h2 class="text-2xl font-heading font-bold text-accent border-b border-white/10 pb-2">Health &
                            Emergency</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block font-heading font-bold text-sm mb-2 text-white/80">Medical
                                    Conditions (Optional)</label>
                                <input type="text" wire:model.blur="health_emergency.medical_conditions"
                                    class="{{ $inputClass }}">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block font-heading font-bold text-sm mb-2 text-white/80">Allergies
                                    (food/medicine) (Optional)</label>
                                <input type="text" wire:model.blur="health_emergency.allergies"
                                    class="{{ $inputClass }}">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block font-heading font-bold text-sm mb-2 text-white/80">Dietary
                                    Preference</label>
                                <select wire:model.blur="health_emergency.dietary_preference" class="{{ $selectClass }}">
                                    <option value="">Select Preference</option>
                                    <option value="Halal">Halal</option>
                                    <option value="Vegetarian">Vegetarian</option>
                                    <option value="Vegan">Vegan</option>
                                    <option value="No restriction">No restriction</option>
                                </select>
                                @error('health_emergency.dietary_preference')
                                    <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div
                                class="md:col-span-2 mt-4 pt-4 border-t border-white/10 font-heading font-bold text-lg">
                                Emergency Contact</div>

                            <div>
                                <label class="block font-heading font-bold text-sm mb-2 text-white/80">Contact
                                    Name</label>
                                <input type="text" wire:model.blur="health_emergency.emergency_contact"
                                    class="{{ $inputClass }}">
                                @error('health_emergency.emergency_contact')
                                    <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label
                                    class="block font-heading font-bold text-sm mb-2 text-white/80">Relationship</label>
                                <input type="text" wire:model.blur="health_emergency.emergency_relationship"
                                    class="{{ $inputClass }}">
                                @error('health_emergency.emergency_relationship')
                                    <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block font-heading font-bold text-sm mb-2 text-white/80">Phone
                                    Number</label>
                                <input type="tel" wire:model.blur="health_emergency.emergency_phone"
                                    class="{{ $inputClass }}" placeholder="+62...">
                                @error('health_emergency.emergency_phone')
                                    <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Step 5: Document Upload -->
                @if ($currentStep == 5)
                    <div class="space-y-6">
                        <h2 class="text-2xl font-heading font-bold text-accent border-b border-white/10 pb-2">Document
                            Uploads</h2>
                        
                        <div class="flex items-center gap-2 p-3 bg-highlight/5 border border-highlight/10 rounded-xl">
                            <svg class="w-4 h-4 text-highlight" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-[10px] font-black text-white/60 uppercase tracking-widest">
                                Supported: PDF, JPG, PNG • Max Size: 2MB per file
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            @foreach ([
        'passport_path' => 'Passport / ID Card',
        'student_card_path' => 'Student Card',
        'formal_photo_path' => 'Formal Photo',
        'cv_path' => 'CV (Optional)',
        'motivation_letter_path' => 'Motivation Letter (Optional)',
    ] as $key => $label)
                                <div
                                    class="bg-white/5 p-5 rounded-2xl border border-white/10 transition-all hover:bg-white/10 group">
                                    <label
                                        class="block font-heading font-bold text-sm mb-3 text-white/80">{{ $label }}</label>

                                    <div class="relative">
                                        <input type="file" wire:model.blur="{{ $key }}" class="hidden"
                                            id="file_{{ $key }}">
                                        <label for="file_{{ $key }}"
                                            class="w-full flex items-center justify-center gap-2 bg-primary/50 border-2 border-dashed border-white/20 rounded-xl py-8 cursor-pointer group-hover:border-highlight transition group-hover:bg-primary/80">
                                            @if ($this->$key)
                                                <div class="text-highlight font-bold flex flex-col items-center">
                                                    <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    <span class="text-xs">File Selected</span>
                                                </div>
                                            @else
                                                <div
                                                    class="text-white/40 flex flex-col items-center group-hover:text-highlight">
                                                    <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                        </path>
                                                    </svg>
                                                    <span class="text-xs uppercase tracking-widest font-black">Click to
                                                        Upload</span>
                                                </div>
                                            @endif
                                        </label>
                                    </div>

                                    <div wire:loading wire:target="{{ $key }}"
                                        class="text-[10px] text-highlight mt-2 animate-pulse">Uploading file...
                                    </div>
                                    @error($key)
                                        <span class="text-red-400 text-[10px] mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Step 6: Payment -->
                @if ($currentStep == 6)
                    <div class="space-y-6">
                        <h2 class="text-2xl font-heading font-bold text-accent border-b border-white/10 pb-2">Payment
                            Verification</h2>

                        <div class="flex items-center gap-2 p-3 bg-highlight/5 border border-highlight/10 rounded-xl">
                            <svg class="w-4 h-4 text-highlight" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-[10px] font-black text-white/60 uppercase tracking-widest">
                                Supported: PDF, JPG, PNG • Max Size: 2MB per file
                            </p>
                        </div>

                        <div class="bg-primary/50 border border-highlight/30 rounded-2xl p-6 text-center shadow-inner">
                            <h3 class="font-heading font-black text-xl mb-2">Total Registration Fee</h3>
                            <div class="text-4xl font-black text-highlight drop-shadow-md">
                                @if ($participant_type == 'CAPEU Member ($130 USD)')
                                    $130 USD
                                @elseif($participant_type == 'Non-CAPEU Member ($150 USD)')
                                    $150 USD
                                @else
                                    -
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6">
                            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 space-y-4 animate-fadeIn">
                                <div class="flex items-center justify-between border-b border-white/5 pb-2">
                                    <h4 class="font-heading font-black text-sm text-highlight uppercase tracking-widest">Bank Transfer Details</h4>
                                    <span class="text-[10px] font-black bg-highlight text-primary px-2 py-0.5 rounded uppercase">Official Account</span>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="space-y-1">
                                        <p class="text-[10px] font-black text-white/40 uppercase tracking-widest">Bank Name</p>
                                        <p class="text-sm font-bold text-white">BANK BNI</p>
                                    </div>
                                    <div class="space-y-1">
                                        <p class="text-[10px] font-black text-white/40 uppercase tracking-widest">Account Name</p>
                                        <p class="text-sm font-bold text-white uppercase">Universitas Majalengka</p>
                                    </div>
                                    <div class="space-y-1" x-data="{ copied: false }">
                                        <p class="text-[10px] font-black text-white/40 uppercase tracking-widest">Account Number</p>
                                        <div class="flex items-center gap-2">
                                            <p class="text-sm font-bold text-white tracking-widest">2014201823</p>
                                            <button type="button" 
                                                @click="navigator.clipboard.writeText('2014201823'); copied = true; setTimeout(() => copied = false, 2000)"
                                                class="text-highlight hover:text-accent transition-colors outline-none focus:outline-none"
                                                title="Copy Account Number">
                                                <svg x-show="!copied" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                                                </svg>
                                                <svg x-show="copied" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                            <span x-show="copied" class="text-[9px] font-black text-accent uppercase tracking-widest" x-cloak x-transition>Copied!</span>
                                        </div>
                                    </div>
                                    <div class="space-y-1">
                                        <p class="text-[10px] font-black text-white/40 uppercase tracking-widest">Swift Code</p>
                                        <p class="text-sm font-bold text-white">BNINIDJAXXX</p>
                                    </div>
                                </div>
                                <div class="pt-2">
                                    <p class="text-[10px] text-white/40 italic">*Please make sure to upload the transfer receipt below after completing the payment.</p>
                                </div>
                            </div>

                            <div class="bg-white/5 p-6 rounded-2xl border border-white/10 group">
                                <label class="block font-heading font-bold text-sm mb-3 text-white/80">Proof of
                                    Payment</label>
                                <div class="relative">
                                    <input type="file" wire:model.blur="proof_of_payment_path" class="hidden"
                                        id="file_proof">
                                    <label for="file_proof"
                                        class="w-full flex items-center justify-center gap-2 bg-primary/50 border-2 border-dashed border-white/20 rounded-xl py-12 cursor-pointer group-hover:border-highlight transition">
                                        @if ($proof_of_payment_path)
                                            <div class="text-highlight font-bold flex flex-col items-center">
                                                <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span>Proof Uploaded</span>
                                            </div>
                                        @else
                                            <div
                                                class="text-white/30 flex flex-col items-center group-hover:text-highlight">
                                                <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                                    </path>
                                                </svg>
                                                <span class="text-xs uppercase tracking-widest font-black">Upload
                                                    Receipt</span>
                                            </div>
                                        @endif
                                    </label>
                                </div>
                                <div wire:loading wire:target="proof_of_payment_path"
                                    class="text-xs text-highlight mt-2">Uploading receipt...</div>
                                @error('proof_of_payment_path')
                                    <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Step 7: Declaration -->
                @if ($currentStep == 7)
                    <div class="space-y-6">
                        <h2 class="text-2xl font-heading font-bold text-accent border-b border-white/10 pb-2">
                            Declaration</h2>

                        <div class="bg-primary/50 border border-white/10 rounded-2xl p-6 space-y-5">
                            <h3 class="font-heading font-bold text-lg mb-4">Agreement</h3>

                            @foreach ([
        'accurate_info' => 'I confirm that all information provided is accurate',
        'follow_rules' => 'I agree to follow all program rules and activities',
        'use_media' => 'I allow the committee to use my photos/videos for documentation',
    ] as $key => $label)
                                <label class="flex items-start space-x-3 cursor-pointer group">
                                    <input type="checkbox" wire:model.blur="declaration.{{ $key }}"
                                        class="{{ $checkboxClass }} mt-1">
                                    <span
                                        class="font-sans text-sm text-white/90 group-hover:text-accent transition">{{ $label }}</span>
                                </label>
                                @error('declaration.' . $key)
                                    <span class="block text-red-400 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Step 8: Optional (Advanced) -->
                @if ($currentStep == 8)
                    <div class="space-y-6">
                        <h2 class="text-2xl font-heading font-bold text-accent border-b border-white/10 pb-2">Optional
                            (Advanced)</h2>

                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label class="block font-heading font-bold text-sm mb-2 text-white/80">Short Video
                                    Introduction (YouTube Link) (Optional)</label>
                                <input type="url" wire:model.blur="advanced_info.video_url"
                                    class="{{ $inputClass }}" placeholder="https://www.youtube.com/watch?v=...">
                                @error('advanced_info.video_url')
                                    <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block font-heading font-bold text-sm mb-2 text-white/80">Program
                                    Expectations (Optional)</label>
                                <textarea wire:model.blur="advanced_info.expectations" rows="3" class="{{ $inputClass }}"></textarea>
                            </div>

                            <div>
                                <label class="block font-heading font-bold text-sm mb-2 text-white/80">Talent for
                                    Cultural Night (Optional)</label>
                                <input type="text" wire:model.blur="advanced_info.cultural_talent"
                                    class="{{ $inputClass }}" placeholder="e.g. Traditional Dance, Singing">
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Navigation Buttons -->
                <div class="mt-10 flex justify-between items-center pt-6 border-t border-white/10">
                    @if ($currentStep > 1)
                        <button type="button" wire:click="previousStep"
                            class="font-heading font-bold text-white px-6 py-3 rounded-full border border-white/20 hover:bg-white/10 transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Back
                        </button>
                    @else
                        <div></div>
                    @endif

                    @if ($currentStep < $totalSteps)
                        <button type="button" wire:click="nextStep"
                            class="font-heading font-bold text-primary bg-accent hover:bg-highlight px-8 py-3 rounded-full transition shadow-lg shadow-highlight/20 flex items-center gap-2"
                            wire:loading.attr="disabled"
                            wire:target="passport_path, student_card_path, formal_photo_path, proof_of_payment_path, cv_path, motivation_letter_path">
                            Next Step
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    @else
                        <button type="submit"
                            class="font-heading font-black text-primary bg-highlight hover:bg-accent px-8 py-3 rounded-full transition shadow-[0_0_15px_rgba(202,255,0,0.4)] flex items-center gap-2 text-lg"
                            wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="submit">Submit Registration</span>
                            <span wire:loading wire:target="submit">Processing...</span>
                            <svg wire:loading.remove wire:target="submit" class="w-5 h-5" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                    @endif
                </div>

            </form>
        </div>
    </div>
</div>
