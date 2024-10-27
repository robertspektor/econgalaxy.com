<div >
    <flux:modal class="min-w-[1000px] space-y-6" wire:model.self="welcomeModal">
        <form wire:submit.prevent="submit">

            <div>
                <flux:heading size="lg">Firmengründungsantrag</flux:heading>
                <flux:subheading>Willkommen in der Galaxie! Um dein Unternehmen zu gründen, musst du einen Antrag bei der Galaktischen Handelsbehörder stellen. Fülle die folgenden Felder aus, um deine vorläufige Genehmigung zu erhalten.</flux:subheading>
            </div>

            <div class="flex space-x-4">

                <div class="basis-1/2 space-y-2">
                    <flux:input wire:model="name" label="Firmennamen wählen" placeholder="Firmenname  " />

                    <flux:textarea wire:model="description" label="Beschreibung" placeholder="Beschreibe kurz, worum es in deinem Unternehmen geht (z.B. Handel, Produktion, Forschung)" />

                    <flux:select wire:model="selected_player_origin" :filter="false" label="Fraktion wählen">
                        @foreach ($player_origins as $player_origin)
                            <flux:option wire:key="{{ $player_origin->id }}" value="{{ $player_origin->id }}">
                                {{ $player_origin->name }}
                            </flux:option>
                        @endforeach
                    </flux:select>

                    <div class="flex">
    {{--                    <flux:spacer />--}}

                        <flux:button type="submit" variant="primary" class="mt-4">Save changes</flux:button>
                    </div>

                </div>
                <div class="basis-1/2 space-y-2">

                    @foreach($player_origins as $player_origin)

                        <x-player-origin
                            id="{{ $player_origin->id }}"
                            name="{{ $player_origin->name }}"
                            image="{{ $player_origin->image }}"
                            description="{{ $player_origin->description }}"
                            :benefits="$player_origin->benefits"
                            :drawbacks="$player_origin->drawbacks"
                            :selected="$selected_player_origin == $player_origin->id"
                        />
                    @endforeach
                </div>
            </div>
        </form>

    </flux:modal>
</div>
