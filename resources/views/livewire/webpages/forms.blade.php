<div class="text-gray-300">
    <div class="text-sm mb-4">
        Antrag auf Unternehmensgründung
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
                    <label class="block text-gray-400 text-sm">Firmenname</label>
                    <input type="text" wire:model="companyName"
                           class="w-full bg-[#1a1a24] text-gray-300 border-zinc-700 p-2 rounded focus:ring-cyan-400 focus:border-cyan-400 placeholder-gray-500">
                    @error('companyName')
                    <span class="text-red-400 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Faction -->
                <div>
                    <label class="block text-gray-400 text-sm">Fraktion</label>
                    <select wire:model="faction"
                            class="w-full bg-[#1a1a24] text-gray-300 border-zinc-700 p-2 rounded focus:ring-cyan-400 focus:border-cyan-400">
                        <option value="">Wählen Sie eine Fraktion</option>
                        <option value="Galactic Federation">Galactic Federation</option>
                        <option value="Rebel Alliance">Rebel Alliance</option>
                    </select>
                    @error('faction')
                    <span class="text-red-400 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-gray-400 text-sm">Unternehmensbeschreibung</label>
                    <textarea wire:model="description"
                              class="w-full bg-[#1a1a24] text-gray-300 border-zinc-700 p-2 rounded focus:ring-cyan-400 focus:border-cyan-400 placeholder-gray-500"
                              rows="4"></textarea>
                    @error('description')
                    <span class="text-red-400 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                            class="bg-cyan-400 text-black px-4 py-2 rounded hover:bg-cyan-300 transition-all duration-300">
                        [✔ Einreichen]
                    </button>
                </div>
            </div>
        </form>
    @endif
</div>
