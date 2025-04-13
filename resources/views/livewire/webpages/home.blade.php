<div class="text-gray-300">
    <div class="text-sm mb-4">
        Willkommen im föderalen Informationsnetzwerk! Wählen Sie eine Option aus der Navigation, um fortzufahren.
    </div>
    <div class="space-y-2">
        <div>
            <a href="javascript:void(0)" wire:click="$parent.loadPage('factions')"
               class="text-cyan-400 hover:text-cyan-300 underline">
                Fraktionen anzeigen
            </a>
        </div>
        <div>
            <a href="javascript:void(0)" wire:click="$parent.loadPage('companies')"
               class="text-cyan-400 hover:text-cyan-300 underline">
                Unternehmensverzeichnis anzeigen
            </a>
        </div>
        <div>
            <a href="javascript:void(0)" wire:click="$parent.loadPage('forms')"
               class="text-cyan-400 hover:text-cyan-300 underline">
                Antrag auf Unternehmensgründung
            </a>
        </div>
        <div>
            <a href="javascript:void(0)" wire:click="$parent.loadPage('news')"
               class="text-cyan-400 hover:text-cyan-300 underline">
                Nachrichtenfeed anzeigen
            </a>
        </div>
    </div>
</div>
