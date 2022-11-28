<div class="col-span-full sm:col-span-12 mt-5">
    <div class="block mt-3">
        @foreach($attaches as $attach)
            <div class="block mb-2">
                <strong>{{ $attach->filename }}</strong>:
                <a href="{{ asset($attach->path) }}" class="text-blue-300 hover:text-blue-300" download>Download</a>
                @if(!auth()->user()->isTechnicalEmployee())
                    <a href="#" class="text-red-300 hover:text-red-600" x-data @click="$dispatch('open-remove{{ $attach->id }}', null)">Remover</a>
                @endif
            </div>

            @if(!auth()->user()->isTechnicalEmployee())
                <x-modals.danger
                    title="Remover Anexo"
                    message="Tem certeza que deseja remover o anexo:
                    <br />
                    <br />
                    <small>{{ $attach->filename  }}</small>?
                    <br />
                    <br />
                    <p class='text-red-600'>Após excluído, não será possível recuperar o anexo.</p>"
                    show="remove{{ $attach->id }}"
                    visible="false"
                >
                    <form action="{{ route('anexos.destroy', ['anexo' => $attach->id] ) }}" method="POST" novalidate>
                        @csrf
                        @method('DELETE')
                        <x-button kind="danger" class="inline-flex ml-3">
                            Confirmar
                        </x-button>
                        <x-button
                            type="button"
                            class="w-full inline-flex sm:ml-3"
                            @click="remove{{ $attach->id }} = false"
                        >
                            Cancelar
                        </x-button>
                    </form>
                </x-modals.danger>
            @endif
        @endforeach
    </div>
</div>
