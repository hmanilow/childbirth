<form wire:submit="submit" class="mt-6 grid gap-4 md:grid-cols-2">
    <input type="text" wire:model="website" class="hidden" tabindex="-1" autocomplete="off">
    <label class="grid gap-1">
        <span>Имя</span>
        <input class="rounded border border-slate-300 px-3 py-2" type="text" wire:model="name">
    </label>
    <label class="grid gap-1">
        <span>Телефон</span>
        <input class="rounded border border-slate-300 px-3 py-2" type="tel" wire:model="phone">
    </label>
    <label class="grid gap-1">
        <span>Email</span>
        <input class="rounded border border-slate-300 px-3 py-2" type="email" wire:model="email">
    </label>
    <label class="grid gap-1">
        <span>Город</span>
        <input class="rounded border border-slate-300 px-3 py-2" type="text" wire:model="city">
    </label>
    <label class="grid gap-1 md:col-span-2">
        <span>Сообщение</span>
        <textarea class="rounded border border-slate-300 px-3 py-2" rows="4" wire:model="message"></textarea>
    </label>
    <button class="rounded bg-slate-900 px-4 py-2 text-white md:col-span-2">Отправить</button>
</form>
