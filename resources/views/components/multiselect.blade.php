<div>
    <select class="hidden" id="x-{{ $attributes->get('id') }}-select">
        {{ $slot }}
    </select>

    <div
        x-data="dropdown()"
        x-init="loadOptions()"
        x-on:multiselect-refresh="loadOptions();"
        {{ $attributes->merge(['class' => "flex flex-col"]) }}
    >
        <template x-for="option in selectedValues()" :key="option">
            <input name="{{ $name }}" type="hidden" x-bind:value="option">
        </template>

        <div class="inline-block relative">
            <div class="flex flex-col relative">

                <div @click="open" class="w-full">
                    <div class="my-2 p-1 flex border border-gray-200 bg-white rounded">
                        <div class="flex flex-auto flex-wrap">
                            {{-- Options Selected in Input--}}
                            <div>
                                <template x-for="(option,index) in selected" :key="options[option].value">
                                    <div class="flex justify-center items-center m-1 font-medium py-1 px-2 bg-white rounded-full text-blue-700 bg-blue-100 border border-blue-300">

                                        <div
                                            class="text-xs font-normal leading-none max-w-full flex-initial"
                                            x-model="options[option]"
                                            x-text="options[option].text"
                                        >
                                        </div>

                                        <div class="flex flex-auto flex-row-reverse">
                                            <div @click="remove(index,option)">
                                                <x-icons.close />
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                            {{-- Input with options --}}
                            <div x-show="selected.length == 0" class="flex-1">
                                <input
                                    placeholder="Selecione uma opção"
                                   class="bg-transparent p-1 px-2 appearance-none outline-none h-full w-full text-gray-800"
                                   x-bind:value="selectedValues()"
                                />
                            </div>

                            <div x-show="selected.length != 0" class="self-center ml-auto">
                                <div @click="removeAll()">
                                    <x-icons.close />
                                </div>
                            </div>

                        </div>

                        {{-- Switch Open/Close button --}}
                        <div class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200">
                            <button
                                type="button"
                                class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none"
                                x-show="isOpen() === true"
                                @click="open"
                            >
                                <x-icons.arrow-down />
                            </button>

                            <button
                                type="button"
                                class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none"
                                x-show="isOpen() === false"
                                @click="close"
                            >
                                <x-icons.arrow-up />
                            </button>
                        </div>
                    </div>
                </div>

                <div class="w-full px-4">
                    <div
                        x-show.transition.origin.top="isOpen()"
                        class="absolute shadow top-100 bg-white z-50 w-full left-0 rounded max-h-52 overflow-y-auto"
                        @click.away="close"
                    >
                        <div class="flex flex-col w-full">
                            {{-- Options in List --}}
                            <template x-for="(option,index) in options" :key="option">
                                <div class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-blue-100"
                                     @click="select(index,$event)">
                                    <div
                                        x-bind:class="{ 'border-blue-600 text-blue-500 bg-blue-100': option.selected }"
                                        class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative"
                                    >
                                        <div class="w-full items-center flex">
                                            <div class="mx-2 leading-6" x-model="option" x-text="option.text"></div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @once
        @push('scripts')
            <script>
                function dropdown() {
                    return {
                        options: [],
                        selected: [],
                        show: false,
                        open() { this.show = true },
                        close() { this.show = false },
                        isOpen() { return this.show === true },
                        select(index, event) {
                            if (!this.options[index].selected) {
                                this.options[index].selected = true;
                                this.options[index].element = event.target;
                                this.selected.push(index);
                            } else {
                                this.selected.splice(this.selected.lastIndexOf(index), 1);
                                this.options[index].selected = false
                            }
                        },
                        remove(index, option) {
                            this.options[option].selected = false;
                            this.selected.splice(index, 1);
                        },
                        loadOptions() {
                            const options = document.getElementById("x-{{ $attributes->get('id') }}-select").options;
                            for (let i = 0; i < options.length; i++) {
                                this.options.push({
                                    value: options[i].value,
                                    text: options[i].innerText,
                                    selected: options[i].hasAttribute('selected'),
                                });

                                if (options[i].hasAttribute('selected')) {
                                    this.selected.push(i);
                                }
                            }
                        },
                        selectedValues(){
                            return this.selected.map((option)=>{
                                return this.options[option].value;
                            })
                        },
                        removeAll() {
                          this.selected = [];
                          this.options.forEach(option => option.selected = false);
                        }
                    }
                }
            </script>
        @endpush
    @endonce
</div>
