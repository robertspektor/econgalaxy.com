<div class="text-gray-300">
    <!-- Portal Header -->
    <div class="border-b border-zinc-700 pb-2 mb-4">
        <pre class="text-cyan-400 text-sm animate-crt-flicker">
╔════════════════════╗
║  Galactic Federation  ║
║  Company Registration  ║
╚════════════════════╝
        </pre>
    </div>

    @if($isSubmitted)
        <div class="text-green-400 text-sm">
            Application submitted successfully! Your company "{{ $companyName }}" has been registered with the Galactic Federation.
        </div>
    @else
        <form wire:submit="submitApplication">
            <div class="space-y-4">
                <!-- Company Name -->
                <div>
                    <label class="block text-gray-400 text-sm">Company Name</label>
                    <input type="text" wire:model="companyName"
                           class="w-full bg-[#1a1a24] text-gray-300 border-zinc-700 p-2 rounded focus:ring-cyan-400 focus:border-cyan-400 placeholder-gray-500">
                    @error('companyName')
                    <span class="text-red-400 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Company Type -->
                <div>
                    <label class="block text-gray-400 text-sm">Company Type</label>
                    <select wire:model="companyType"
                            class="w-full bg-[#1a1a24] text-gray-300 border-zinc-700 p-2 rounded focus:ring-cyan-400 focus:border-cyan-400">
                        <option value="">Select a type</option>
                        <option value="Freelancer">Freelancer</option>
                        <option value="Corporation">Corporation</option>
                        <option value="Cooperative">Cooperative</option>
                    </select>
                    @error('companyType')
                    <span class="text-red-400 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                            class="bg-cyan-400 text-black px-4 py-2 rounded hover:bg-cyan-300 transition-all duration-300">
                        Submit Application
                    </button>
                </div>
            </div>
        </form>
    @endif
</div>
