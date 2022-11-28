@php
    $limitFiles = $attributes['limit_files'] ?? null;
    $preview = $attributes['preview'] ?? false;
@endphp

@push('scripts')
    <script>
        const labels_pt_BR = {
            labelIdle: 'Arraste e solte os arquivos ou <span class="filepond--label-action"> Clique aqui </span>',
            labelInvalidField: 'Arquivos inválidos',
            labelFileWaitingForSize: 'Calculando o tamanho do arquivo',
            labelFileSizeNotAvailable: 'Tamanho do arquivo indisponível',
            labelFileLoading: 'Carregando',
            labelFileLoadError: 'Erro durante o carregamento',
            labelFileProcessing: 'Enviando',
            labelFileProcessingComplete: 'Envio finalizado',
            labelFileProcessingAborted: 'Envio cancelado',
            labelFileProcessingError: 'Erro durante o envio',
            labelFileProcessingRevertError: 'Erro ao reverter o envio',
            labelFileRemoveError: 'Erro ao remover o arquivo',
            labelTapToCancel: 'clique para cancelar',
            labelTapToRetry: 'clique para reenviar',
            labelTapToUndo: 'clique para desfazer',
            labelButtonRemoveItem: 'Remover',
            labelButtonAbortItemLoad: 'Abortar',
            labelButtonRetryItemLoad: 'Reenviar',
            labelButtonAbortItemProcessing: 'Cancelar',
            labelButtonUndoItemProcessing: 'Desfazer',
            labelButtonRetryItemProcessing: 'Reenviar',
            labelButtonProcessItem: 'Enviar',
            labelMaxFileSizeExceeded: 'Arquivo é muito grande',
            labelMaxFileSize: 'O tamanho máximo permitido: {filesize}',
            labelMaxTotalFileSizeExceeded: 'Tamanho total dos arquivos excedido',
            labelMaxTotalFileSize: 'Tamanho total permitido: {filesize}',
            labelFileTypeNotAllowed: 'Tipo de arquivo inválido',
            fileValidateTypeLabelExpectedTypes: 'Tipos de arquivo suportados são {allButLastType} ou {lastType}',
            imageValidateSizeLabelFormatError: 'Tipo de imagem inválida',
            imageValidateSizeLabelImageSizeTooSmall: 'Imagem muito pequena',
            imageValidateSizeLabelImageSizeTooBig: 'Imagem muito grande',
            imageValidateSizeLabelExpectedMinSize: 'Tamanho mínimo permitida: {minWidth} × {minHeight}',
            imageValidateSizeLabelExpectedMaxSize: 'Tamanho máximo permitido: {maxWidth} × {maxHeight}',
            imageValidateSizeLabelImageResolutionTooLow: 'Resolução muito baixa',
            imageValidateSizeLabelImageResolutionTooHigh: 'Resolução muito alta',
            imageValidateSizeLabelExpectedMinResolution: 'Resolução mínima permitida: {minResolution}',
            imageValidateSizeLabelExpectedMaxResolution: 'Resolução máxima permitida: {maxResolution}'
        };
    </script>
    @if($preview)
        <script src="{{ asset('plugins/filepond/filepond-plugin-image-preview.min.js') }}"></script>
    @endif
    <script src="{{ asset('plugins/filepond/filepond.min.js') }}"></script>
    <script>
        @if($preview)
            FilePond.registerPlugin(FilePondPluginImagePreview);
        @endif
        const inputElement = document.querySelector('input[type="file"]');
        const pond = FilePond.create( inputElement );
        pond.setOptions({
            ...labels_pt_BR,
        });
    </script>
@endpush

@push('styles')
    @if($preview)
        <link href="{{ asset('plugins/filepond/filepond-plugin-image-preview.min.css') }}" rel="stylesheet" />
    @endif
    <link href="{{ asset('plugins/filepond/filepond.min.css') }}" rel="stylesheet" />
@endpush

<input
    type="file"
    name="file[]"
    id="{{ $attributes->id ?? 'file' }}"
    {!! $limitFiles ? "multiple data-max-files='$limitFiles'" : '' !!}
    {!! $attributes->merge([]) !!}
/>

@if($limitFiles)
    <small>Limite de arquivos: {{ $limitFiles }}</small>
@endif
