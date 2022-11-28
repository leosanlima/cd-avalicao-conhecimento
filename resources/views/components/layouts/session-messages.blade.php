@if (session()->has('layout.success-message'))
    <div
        class="fixed bottom-10 ml-3 p-3 bg-white rounded-lg border-gray-300 border shadow-lg cursor-pointer"
        role="alertdialog"
        aria-describedby="layout.success-message"
        x-data="{ layoutSuccessMessage: true }"
        x-show="layoutSuccessMessage"
        x-init="setTimeout(() => layoutSuccessMessage = false, 4000)"
        @click="layoutSuccessMessage = false"
    >
        <div class="flex flex-row">
            <div class="px-2">
                <x-icons.check-ok />
            </div>
            <div class="ml-2 mr-6">
                <h1 id="layout.success-message" class="font-semibold">
                    {{ session()->get('layout.success-message', 'Operação realizada com sucesso') }}
                </h1>
            </div>
        </div>
    </div>
@endif

@if (session()->has('layout.error-message'))
    <div
        class="fixed bottom-10 ml-3 p-3 bg-white rounded-lg border-gray-300 border shadow-lg cursor-pointer"
        role="alertdialog"
        aria-describedby="layout.error-message"
        x-data="{ layoutErrorMessage: true }"
        x-show="layoutErrorMessage"
        x-init="setTimeout(() => layoutErrorMessage = false, 4000)"
        @click="layoutErrorMessage = false"
    >
        <div class="flex flex-row">
            <div class="px-2 text-red-500">
                <x-icons.exclamation-circle width="24" height="24" />
            </div>
            <div class="ml-2 mr-6">
                <h1 id="layout.error-message" class="font-semibold">
                    {{ session()->get('layout.error-message', 'Ocorreu um erro inesperado, tente novamente mais tarde ou entre em contato com os administratores') }}
                </h1>
            </div>
        </div>
    </div>
@endif
